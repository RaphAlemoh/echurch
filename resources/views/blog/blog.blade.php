@extends('layouts.app')
@section('title', 'eChurch TV')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="">
                <h4>eChurch Blog</h4>

                <div class="card">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    THis could be an image or text or audio or video that's been uploaded to appear on the blog section
                    <div class="card-body">
                        <h4 class="card-title">Salvation</h4>
                        <p class="card-text">The description of this topic</p>
                    </div>

                    Below we could have comment section based on this,....
                </div>

            </div>
        </div>
    </div>
</div>


@endsection
@section('footer')
@include('partials.__footer')       
@endsection