@extends('layouts.admin.app')
@section('title', 'Video Streaming')
@section('content')
<div class="container-fluid">
        <h1 class="mt-2">Dashboard</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Tv streaming</li>
        </ol>
   <div class="row">  
       <div class="col-md-12">
           <div class="card mb-4"> 
               <div class="card-header text-center text-success"><i class="fa fa-television" aria-hidden="true"></i>Tv Streams</div>
               <div class="card-body">
                   <a href="{{ url('tvs/create') }}" class="btn btn-success btn-sm" title="Stream new video">
                       <i class="fa fa-plus" aria-hidden="true"></i> Add Streaming
                   </a>

                   <br/>
                   <br/>
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
                   <div class="table-responsive mt-4">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='10'>
                           <thead>
                               <tr>
                                   <th>#</th>
                                   <th>Author</th>
                                   <th>Title</th>
                                   <th>URL</th>
                                   <th>Actions</th>
                               </tr>
                           </thead>
                           <tbody>
                           @foreach($tvs as $item)
                               <tr>
                                   <td>{{ $loop->iteration }}</td>
                                   <td>{{ $item->user->name }}</td>                                  
                                   <td>{{ $item->title }}</td>                                  
                                   <td>{{ $item->url }}</td>                                  
                                   <td>
                                       <a href="{{ url('tvs/' . $item->id ) }}" title="View Stream"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                       <a href="{{ url('tvs/' . $item->id . '/edit') }}" title="Edit Stream"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                       @if(Auth::user()->hasRole('admin'))
                                       <form method="POST" action="{{ url('tvs/'. $item->id) }}" role="form" style="display:inline;">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                           <button type="submit" class="btn btn-danger btn-sm" title="Delete Stream" onclick= "return confirm('Confirm delete?')">
                                                   <i class="fa fa-trash-o" aria-hidden="true"> {{ __('Delete') }} </i>
                                           </button>
                                       </form>
                                       @endif
                                   </td>
                               </tr>
                           @endforeach
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
