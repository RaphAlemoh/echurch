@extends('layouts.app')
@section('title', 'eChurch Media')
@section('content')
<div class="container">
    <div class="row p-0 m-0 justify-content-center mt-2">
        <div class="col-12 col-lg-8">
            Display of Messages from eChurch in order.....
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 mt-5">
            <div class="text">
               Series
            </div>
        </div>
    </div>
</div>


@endsection
@section('footer')
@include('partials.__footer')       
@endsection