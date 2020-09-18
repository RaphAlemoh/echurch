@extends('layouts.app')
@section('title', 'eChurch Blog')
@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
                <h4>eChurch Blog</h4>
                <hr>
                @foreach ($posts as $post)
                <a href="{{ url('show/post', $post->id) }}" class="nav-link m-0 p-0">
                <div class="card mt-4 ">
                  <img class="card-img-top img-fluid lazyload blur-up" src=" {{ asset('images/streaming.jpg') }}" alt="">
                  <div class="card-body">
                      <h4 class="card-title">{{ $post->title }}</h4>
                      <p class="card-text">
                        {{ str_limit($post->body, 50) }}
                      </p>
                  </div>
                  <div class="card-footer text-muted border-0 border-botttom-1">
                    Posted by<a href="#">{{ $post->user->name }}</a> on September 24, 2017
                </div>

                <div class="text-center post-action p-2">
                 <span><a href="#" class="pr-3"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like </a></span>
                 <span><a href=" {{ url('show/post', $post->id) }} " class="pr-3"><i class="fa fa-comment" aria-hidden="true"></i> Comments </a></span>
                 <span><a href="#" class="pr-3"><i class="fa fa-share" aria-hidden="true"></i> Share</a></span>
                </div>
              </div>
                </a>
              @endforeach
                              

              <div class="pagination justify-content-center mt-4">  {{ $posts->links() }} </div>

        </div>
    </div>
</div>


@endsection
@section('footer')
@include('partials.__footer')       
@endsection