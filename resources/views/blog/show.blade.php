@extends('layouts.app')
@section('title', $post->title)
@section('content')
<div class="container mt-4"> 
    <h4>eChurch Blog</h4>
    <hr>
    <div class="row mt-2">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
            <div class="card mt-2 border-0">
                <img class="card-img-top img-fluid lazyload blur-up" src=" {{ asset('images/streaming.jpg') }}" alt="{{ $post->title }}">
                <div class="card-body">
                    <h4 class="card-title">{{ $post->title }}</h4>
                    <p class="card-text text-justify">
                      {{ str_limit($post->body) }}
                    </p>
                </div>
                <div class="card-footer text-muted border-0">
                Posted by <a href="#"> {{ $post->user->name }} </a> on  {{ formatDate($post->created_at) }}
              </div>
            </div>
        </div>

        <div class="col-12 col-md-10 col-lg-8 mx-auto mt-4">
            <div>
                <span class="header-text nav-link active pl-0 mb-0 text-dark">Comments</span>
                <hr class="mt-0">
            </div>
            
            @forelse ($post->comments as $comment)
                <ul class="list-group mt-1">
                    <li class="list-group-item border-1 border-bottom-1 mb-3 bg-light">
                        {{  show_name($comment) }}
                        <div class="text-justify mb-1 mt-1">
                            {{ $comment->comment }}
                        </div>

                        <div class="ml-0 mt-2">
                            @if (Auth::user())
                            <span class="nav-link inline-anchor reply" data-id="{{ $comment->id }}" > <i class="fa fa-backward fa-lg" aria-hidden="true"></i> Reply</span>                            
                            @if (Auth::user()->id == $comment->user_id )
                            <span class="nav-link inline-anchor edit-comment" data-id="{{ $comment->id }}" data-userid="{{ Auth::user()->id }}" > <i class="fa fa-pencil fa-lg" aria-hidden="true"></i> Edit</span>                            
                            <a href="{{ url('delete/comment', $comment->id) }}" class="nav-link inline-anchor" onclick= "return confirm('Confirm delete?')" ><i class="fa fa-trash fa-lg" aria-hidden="true" ></i> Delete</a>                            
                            @endif
                            @endif
                        </div>

                        <div class="text ml-2">
                            @if (count($comment->replies) > 0)
                            <div class="bg-white p-2 mb-4">
                                @foreach ($comment->replies as $reply)
                                {{  show_name($reply) }}

                            <div class="text-justify">
                              {{ $reply->reply }}  
                            </div>
                            
                                    <div class="text pl-0 mt-1">
                                        @if (Auth::user())
                                        @if (Auth::user()->id == $reply->user_id )
                                        <span class="nav-link inline-anchor edit-reply" data-id="{{ $reply->id }}" data-userid="{{ Auth::user()->id }}" > <i class="fa fa-pencil fa-lg" aria-hidden="true"></i> Edit</span>                            
                                        <a href="{{ url('delete/reply', $reply->id) }}" class="nav-link inline-anchor" onclick= "return confirm('Confirm delete?')"><i class="fa fa-trash fa-lg" aria-hidden="true" ></i> Delete</a>                            
                                        @endif
                                        @endif
                                    </div>
                                @endforeach   
                            </div>
                            @endif 

                        <div class="show-reply mt-4" style="display:none;" id="default">
                            <form action="{{ url('reply/comment', $comment->id) }}" method="post" novalidate="false" role="form">
                                @csrf
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    <div class="form-group">
                                        <textarea class="form-control" name="reply" id="reply" rows="2" required></textarea>
                                    </div>                            
                                    <button type="submit" class="btn btn-success">Reply</button>
                                    <span class="btn btn-danger ml-2 hide-reply">Cancel</span>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            @empty
                <div class="text-center">
                    No comments on this post!
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
        <form action=" {{ url('/post/comment', $post->id) }}" method="post" role="form" novalidate="false" class="mt-4">
            @csrf
                @if (!Auth::user())
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="Enter your email" required>
                  </div>

                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" aria-describedby="helpId" required>
                  </div>
                @endif
                
                <div class="form-group">
                  <textarea class="form-control" name="comment" id="comment" rows="3" required></textarea>
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
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="edit-comment_group"  style="display:none;">
                <form action="{{ url('update/comment') }} " method="post" class="comment_update">
                    @csrf
                <div class="form-group">
                    <textarea class="form-control edit-comment-text" name="comment" id="comment" rows="3" required></textarea>
                  </div>
                  <input type="hidden" name="comment_id" value="" class="comment_id">
  
                  <button type="submit" class="btn btn-success">Update</button>
                </form>
                </div>   
                
                <div class="edit-reply_group" style="display:none;">
                    <form action="{{ url('update/reply') }}" method="post">
                        @csrf
                    <div class="form-group">
                        <textarea class="form-control edit-reply-text" name="reply" id="reply" rows="3" required></textarea>
                      </div>
                      <input type="hidden" name="reply_id" value="" class="reply_id">
      
                      <button type="submit" class="btn btn-success">Update</button>
                    </form>
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
$(document).ready(function(){

$('.edit-comment').click(function(){
    var comment_id = $(this).data('id');
    var user_id = $(this).data('userid');
        $.ajax({
            url: "{{ url('edit/comment/') }}",
            method:"GET",
            data:{user_id:user_id, comment_id:comment_id},
            dataType:'json', 
            success:function(data){
                let m = $('#modelId');
                m.find('.modal-title').html('Edit Comment');
                m.find('.edit-reply_group').css("display", "none").hide("fast");
                if(data.status !== 'undefined' && data.status == 1){
                    m.find('.edit-comment_group').css("display", "block").show("fast");
                    m.find('.edit-comment-text').html(data.message);
                    m.find('.comment_id').val(data.id);
                    m.modal('toggle');
                } 

                if(data.status !== 'undefined' && data.status == 0){
                    m.find('.edit-comment_group').hide("fast");
                    m.find('.modal-body').html(data.message);
                    m.modal('toggle'); 
                } 
            },
        error: function(data){

        }

        }) 
    });



    $(document).on('click', '.reply', function(){
        $('.show-reply').css('display', 'block').fadeIn("fast");
    });


    $(document).on('click', '.hide-reply', function(){
        $('.show-reply').css('display', 'none').fadeOut("fast");
    });



    $('.edit-reply').click(function(){
    var reply_id = $(this).data('id');
    var user_id = $(this).data('userid');
        $.ajax({
            url: "{{ url('edit/reply') }}",
            method:"GET",
            data:{user_id:user_id, reply_id:reply_id},
            dataType:'json', 
            success:function(data){
                let m = $('#modelId');
                m.find('.edit-comment_group').css("display", "none").hide("fast");
                m.find('.modal-title').html('Edit Reply');
                if(data.status !== 'undefined' && data.status == 1){
                    m.find('.edit-reply_group').css("display", "block").show("fast");
                    m.find('.edit-reply-text').html(data.message);
                    m.find('.reply_id').val(data.id);
                    m.modal('toggle');
                } 

                if(data.status !== 'undefined' && data.status == 0){
                    m.find('.edit-reply_group').hide("fast");
                    m.find('.modal-body').html(data.message);
                    m.modal('toggle'); 
                } 
            },
        error: function(data){

        }

        }) 
    });
});
</script>
@endsection
