@extends('layouts.app')
@section('title', 'eChurch')
@section('content')
<div class="jumbotron text-center">
    <div class="container bold jumbroton-text">
        <h1 class="jumbotron-heading">Online Church</h1>
        <p class="lead">
            A place of online encounter for God is not restrained by space and location. 
        </p>
    </div>
</div>
<div class="main">
<div class="container mt-2">
    <div class="row mt-4">
        <div class="col-12 col-lg-6">
            <div>
                <a class="header-text nav-link active pl-0 mb-0" href="#">Salvation</a>
                <hr class="mt-0">
            </div>
            <div class="text-justify">
                Jesus is transforming souls everyday. 
                Join us for a supernatural shift and encounter with the truth of God's word.
                There is power in the name of Jesus. Salvation is in the Lord!
                Salvation is in the Lord!! Salvation is in the Lord!!!
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <img src=" {{ asset('images/transformation_image.jpg') }} " data-src="{{ asset('images/transformation_image.jpg') }}" alt="worship testimony" 
            class="img img-fluid rounded m-0 image_hover_effect lazyload blur-up" width="500" height="300">
        </div>
    </div>



    <div class="row mt-4">
        <div class="col-12 col-lg-6">
            <div>
                <a class="header-text nav-link active pl-0" href="#">Live Streaming</a>
                <hr class="mt-0">
            </div>
            Our livestreaming services are blessing souls across the nation. 
            Join us every sunday for a live transforming ministration..
            Our streaming cover both audio and video. Location is not barrier.
        </div>


        <div class="col-12 col-lg-6">
        <img src=" {{ asset('images/streaming.jpg') }}" data-src=" {{ asset('images/streaming.jpg') }} " alt="worship testimony" 
        class="img img-fluid rounded m-0 image_hover_effect lazyload blur-up" width="500" height="300">
        </div>
    </div>

</div>
</div> 
@include('partials.__testimonies')       
@endsection
@section('footer')
@include('partials.__footer')       
@endsection