@extends('layouts.admin.app')
@section('title', 'Show Post')
@section('content')
<div class="container-fluid">
        <h1 class="mt-2">Dashboard</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Show Post</li>
        </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header text-center"> <b> {{ $post->title }} </b> post</div>
                <div class="card-body">
                    <a href="{{ url('posts/') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('posts/' . $post->id . '/edit') }}" title="Edit post"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    @if(Auth::user()->hasRole('admin'))
                    <form method="POST" action="{{ url('posts/'. $post->id) }}" role="form" style="display:inline;">
                        {{ method_field('DELETE') }}
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete post" onclick= "return confirm('Confirm delete?')">
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
                                    <th>ID</th><td>{{ $post->id }}</td>
                                </tr>
                                <tr><th> Title </th><td> {{ $post->title }} </td></tr>
                                <tr><th> Author </th><td> {{ $post->user->name }} </td></tr>
                                <tr><th> Body </th><td> {{ $post->body }} </td></tr>
                                <tr><th> Comments </th>
                                    <td>10</td>
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
