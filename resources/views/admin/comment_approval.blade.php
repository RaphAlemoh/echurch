@extends('layouts.admin.app')
@section('title', 'Comment Approval')
@section('content')
<div class="container-fluid">
        <h1 class="mt-2">Dashboard</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Comment Approval</li>
        </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header text-center"> <b> Approve </b> comment</div>
                <div class="card-body">
                    <a href="{{ url('/admin/dashboard') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br/>
                    <br/>
                    @if(session()->has('success_msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success_msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $comment->id }}</td>
                                </tr>
                                <tr><th> Author </th><td> {{ show_name($comment)}} </td></tr>
                                <tr><th> Body </th><td> {{ $comment->comment }} </td></tr>
                                <tr><th> Action </th>
                                    <td>
                                        @if (!$comment->status)
                                        <a href="{{ url('approve/comment', $comment->id) }}" class="nav-link p-0 m-0" onclick= "return confirm('Confirm approval?')"><i class="fa fa-folder-open fa-lg" aria-hidden="true" ></i> Approve</a>                                                                        
                                        @else
                                        {{ __('Approved') }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
