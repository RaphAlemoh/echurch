@extends('layouts.admin.app')
@section('title', 'Publish Post')
@section('content')
<div class="container-fluid">
        <h1 class="mt-2">Dashboard</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Create Post</li>
        </ol>
  <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card mb-4">
              <div class="card-header text-center"><b> {{ __('Create Post') }} </b></div>
              <div class="card-body">
                      <a href="{{ url('/posts') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                      <br />
                      <br />
                      @if ($errors->any())
                          <ul class="alert alert-danger">
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      @endif

                      @if(session()->has('success_msg'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{ session()->get('success_msg') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">×</span>
                          </button>
                      </div>
                      @endif

   <form method="POST" action="{{ url('posts') }}" role="form">
          @csrf
        <div class="form-group">
        <label for="title">Title:</label>
        <input type="text"
            class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="eg. Salvation" required>
        </div>
        <div class="form-group">
        <label for="slug">Slug:</label>
        <input type="text"
            class="form-control" name="slug" id="slug" aria-describedby="helpId" placeholder="eg. salvation-post" required>
        </div>
        <div class="form-group">
          <label for="body">Body:</label>
          <textarea class="form-control" name="body" id="body" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <button class="form-control btn btn-success" type="submit">Publish Post</button>
        </div>
    </form>
  </form>
</div>
</div>
</div>
</div>
</div>
@endsection