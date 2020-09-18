@extends('layouts.admin.app')
@section('title', 'Admin  Settings')
@section('content')
@if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff') )
<main role="main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 mb-4">
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="card-header"><h3 class="font-weight-light my-2">Admin Settings</h3></div>
                    <div class="card-body">
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
                        <form action="{{ url('/admin/update-pwd') }}" method="post" role="form" name="password_validate" id="password_validate">
                            @csrf
                                <hr>
                                <b>Update your password</b>
                                <hr>

                            <div class="form-group">
                                <label class="small mb-1" for="current_pwd">Current Password</label>
                                    <input class="form-control py-4"  type="password" placeholder="Enter current password" name="current_pwd"  id="current_pwd" />
                                    <span id="chkPwd"></span>
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="password">Password</label>
                                <input class="form-control py-4" type="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password" required />
                            </div>
    
                            <div class="form-group">
                                <label class="small mb-1" for="password_confirm">Confirm Password</label>
                                <input class="form-control py-4" id="password_confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required/>
                            </div>
    
                        <div class="form-group d-flex align-items-center justify-content-between mt-2 mb-0">
                        <button type="submit" class="btn btn-style admin-password-update-btn" style="display:none;">Update password</button>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    </div>
    </main>
@else
@include('errors.419')
@endif 
@endsection
