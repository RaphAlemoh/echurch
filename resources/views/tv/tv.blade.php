@extends('layouts.app')
@section('title', 'eChurch TV')
@section('content')
<div class="container">
    <div class="row p-0 m-0 justify-content-center mt-2">
        <div class="col-12 col-lg-8">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
            </div>            
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 mt-5">
            <div class="text">
                Information of the ongoing broadcast.....
            </div>
        </div>
    </div>
</div>


@endsection
@section('footer')
@include('partials.__footer')       
@endsection