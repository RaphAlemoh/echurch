@extends('layouts.admin.app')
@section('title', 'Upload Media')
@section('content')
<div class="container-fluid">
        <h1 class="mt-2">Dashboard</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Upload Media</li>
        </ol>
  <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card mb-4">
              <div class="card-header text-center"><b> {{ __('Upload Media') }} </b></div>
              <div class="card-body">
                      <a href="{{ url('/medias') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                      <br />
                      <br />
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

   <form method="POST" action="{{ url('tvs') }}" role="form">
          @csrf
        <div class="form-group">
        <label for="title">Title: </label>
        <input type="text"
            class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="eg. program theme or title" required>
        </div>

        <div class="form-group">
          <label for="title">Minister: </label>
          <input type="text"
              class="form-control" name="minister" id="minister" aria-describedby="helpId" placeholder="eg. minister of the message" required>
          </div>

        <div class="form-group">
          <label for="">Media: </label>
          <select class="form-control" name="" id="">
            <option></option>
            <option></option>
            <option></option>
          </select>
        </div>

        <div class="form-group">
          <label for="">Media Type:</label>
          <select class="form-control" name="" id="">
            <option></option>
            <option></option>
            <option></option>
          </select>
        </div>


        <div class="form-group file_upload" style="display:none;">
          <label for="">Upload</label>
          <input type="file" class="form-control-file" name="" id="" placeholder="" aria-describedby="fileHelpId">
          <small id="fileHelpId" class="form-text text-muted">Help text</small>
        </div>


        <div class="form-group url_upload"  style="display:none;">
            <label for="url">URL:</label>
            <input type="url" class="form-control" name="url" id="url" aria-describedby="helpId" placeholder="eg. youtube or facebook streaming url" required>
        </div>
    

        <div class="form-group">
          <label for="body">Information:</label>
          <textarea class="form-control" name="information" id="information" rows="5" required></textarea>
        </div>


        <div class="form-group">
            <button class="form-control btn btn-success" type="submit">Upload</button>
        </div>
    </form>
  </form>
</div>
</div>
</div>
</div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {


    });

</script>
    
@endsection