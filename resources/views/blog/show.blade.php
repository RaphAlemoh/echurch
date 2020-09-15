@extends('layouts.app')
@section('title', $post->title)
@section('content')
<div class="container mt-4"> 
    <h4>eChurch Blog</h4>
    <hr>
    <div class="row mt-2">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
            <div class="card mt-2 border-0">
                <img class="card-img-top img-fluid lazyload blur-up" src=" {{ asset('images/streaming.jpg') }}" alt="">
                <div class="card-body">
                    <h4 class="card-title">{{ $post->title }}</h4>
                    <p class="card-text text-justify">
                      {{ str_limit($post->body) }}
                    </p>
                </div>
                <div class="card-footer text-muted border-0">
                  Posted by <a href="#"> {{ $post->user->name }} </a> on September 24, 2017
              </div>
            </div>
        </div>

        <div class="col-12 col-md-10 col-lg-8 mx-auto mt-4">
            <div class="text-left">Comments</div>
            
            @forelse ($post->comments as $comment)
                <ul class="list-group">
                    <li class="list-group-item border-0 border-bottom-1 mt-1">
                        @if ($comment->user_id == '')
                            {{ $comment->user }}
                        @else
                            {{ __('Anonymous') }}
                        @endif

                        <div class="text-justify mb-1 mt-1">
                            {{ $comment->comment }}
                        </div>

                        @if (Auth::user())
                        @if (Auth::user()->id == $comment->user_id )
                        <div class="text-right">
                        {{-- <a href="#" class="nav-link inline-anchor edit-comment" data-id="{{ $comment->id }}" data-userid="{{ Auth::user()->id }}" > <i class="fa fa-eraser fa-lg" aria-hidden="true"></i>Edit</a> --}}
                        <span href="#" class="nav-link inline-anchor edit-comment" data-id="{{ $comment->id }}" data-userid="{{ Auth::user()->id }}" > <i class="fa fa-eraser fa-lg" aria-hidden="true"></i>Edit</span>
                            
                        <a href="{{ url('delete/comment/'.$comment->id.'') }}" class="nav-link inline-anchor" ><i class="fa fa-trash fa-lg" aria-hidden="true" ></i>Delete</a>                            
                        </div>
                        @endif
                        @endif
                    </li>
                </ul>
            @empty
                <div class="text-center">
                    No Comments on this post!
                </div>
            @endforelse

            {{-- <div class="pagination justify-content-center mt-4">  {{ $post->comments->links() }} </div> --}}
        </div>

        <div class="col-12 col-md-10 col-lg-8 mx-auto mt-3 mb-0">
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
            @endif
            @if(session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif
        <form action=" {{ url('/post/comment/'.$post->id.'') }}" method="post" role="form" novalidate="false" class="mt-4">
            @csrf
                @if (!Auth::user())
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="Enter your email" required>
                  </div>

                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId">
                  </div>
                @endif
                
                <div class="form-group">
                  <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Comment</button>
            </form>
        </div>
    </div>

</div>
 <!-- Modal -->
 <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Comment</h5>
            </div>
            <div class="modal-body">
                <div class="edit-comment_group">
                <div class="form-group">
                    <textarea class="form-control edit-comment-text" name="comment" id="comment" rows="3"></textarea>
                  </div>
  
                  <button type="submit" class="btn btn-success">Comment</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
@include('partials.__footer')       
@endsection
@section('scripts')
<script>

$('.edit-comment').click(function(){
    var comment_id = $(this).data('id');
    var user_id = $(this).data('userid');
        $.ajax({
            url: "{{ url('edit/comment/') }}",
            method:"GET",
            data:{user_id:user_id, comment_id:comment_id},
            dataType:'json', 
            success:function(data){
                if(data.status !== 'undefined' && data.status == 1){
                    let m = $('#modelId');
                    m.find('.edit-comment-text').html(data.message);
                    m.modal('toggle');
                    // $(document).on('click', 'comment', function(){
                    //     location.reload(true);
                    // })
                } 

                if(data.status !== 'undefined' && data.status == 0){
                    let m = $('#modelId');
                    m.find('.edit-comment_group').hide("fast");
                    m.find('.modal-body').html(data.message);
                    m.modal('toggle'); 
                } 
            },
        error: function(data){

        }

        }) 
    })


</script>
@endsection
