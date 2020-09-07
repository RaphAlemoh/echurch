@extends('layouts.admin.app')
@section('title', 'Show User')
@section('content')
<div class="container-fluid">
        <h1 class="mt-2">Dashboard</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Show User</li>
        </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header text-center"> <b> {{ $user->name }} </b> User</div>
                <div class="card-body">
                    <a href="{{ url('users/') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('users/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    @if(Auth::user()->hasRole('admin'))
                    <form method="POST" action="{{ url('users/'. $user->id) }}" role="form" style="display:inline;">
                        {{ method_field('DELETE') }}
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete User" onclick= "return confirm('Confirm delete?')">
                                <i class="fa fa-trash-o" aria-hidden="true"> {{ __('Delete') }} </i>
                        </button>
                    </form>
                    @endif
                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $user->id }}</td>
                                </tr>
                                <tr><th> Name </th><td> {{ $user->name }} </td></tr>
                                <tr><th> Email </th><td> {{ $user->email }} </td></tr>
                                <tr><th> Phone </th><td> {{ $user->phone }} </td></tr>
                                <tr><th> Verification </th>
                                    @if($user->email_verified_at == NULL)
                                    <td>{{ ('Not Verified') }}</td>
                                    @else
                                    <td>{{ ('Verified') }}</td>
                                    @endif
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
