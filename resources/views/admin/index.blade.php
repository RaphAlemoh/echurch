@extends('layouts.admin.app')
@section('title', 'Super Admin')
@section('content')
@if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff') )
<div class="container-fluid">
        <h1 class="mt-2">Dashboard</h1>
        <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}" class="nav-link text-dark">Dashboard</a></li>
        </ol>
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

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                        <div class="card-header">Users</div>
                    <div class="card-body">Total Users: {{ $users }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url('users') }}">View All</a>
                        <div class="small text-white"><i class="fa fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-dark text-white mb-4">
                        <div class="card-header">Media</div>
                <div class="card-body">Total Media: {{ $media }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url('media') }}">View More</a>
                        <div class="small text-white"><i class="fa fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                        <div class="card-header">Chat</div>
                <div class="card-body">Total Chat: {{ $chats }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url('chats') }}">View More</a>
                        <div class="small text-white"><i class="fa fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-header">Subscribers</div>
                    <div class="card-body">Total Subscribers: {{ $subscribers }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url('subscribers') }}">View All</a>
                        <div class="small text-white"><i class="fa fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header"><i class="fa fa-table mr-1"></i>Recent Orders</div>
            <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @forelse ($new_messages as $new_message)
                                    <tr>
                                        @php
                                            $name = $new_message->user['name'];
                                        @endphp
                                    <td> {{ $name }}</td>
                                        @if ($new_message->status == '1')
                                        <td class="success"> {{ __('Read')}} </td>
                                        @else
                                        <td class="danger"> {{ __('Not Read')}} </td>
                                         @endif
                                        <td>{{ $new_message->updated_at }}</td>
                                        
                                        <td>
                                            <a href="{{ url('message/' . $new_message->id ) }}" title="View this message"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        </td>
                                    </tr>                                        
                                    @empty
                                        <div class="text text-center text-danger">
                                            <p>No New Messages!</p>
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
            </div>
        </div>
    </div>
@else
@include('errors.419')
@endif   
@endsection
