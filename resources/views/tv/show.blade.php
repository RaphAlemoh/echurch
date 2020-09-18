@extends('layouts.admin.app')
@section('title', 'Show Stream')
@section('content')
<div class="container-fluid">
        <h1 class="mt-2">Dashboard</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Show Stream Information</li>
        </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header text-center"> <b> {{ $tv->title }} </b> stream</div>
                <div class="card-body">
                    <a href="{{ url('tvs/') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('tvs/' . $tv->id . '/edit') }}" title="Edit tv"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    @if(Auth::user()->hasRole('admin'))
                    <form method="POST" action="{{ url('tvs/'. $tv->id) }}" role="form" style="display:inline;">
                        {{ method_field('DELETE') }}
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete tv" onclick= "return confirm('Confirm delete?')">
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
                                    <th>ID</th><td>{{ $tv->id }}</td>
                                </tr>
                                <tr><th> Title </th><td> {{ $tv->title }} </td></tr>
                                <tr><th> Author </th><td> {{  show_name($tv) }} </td></tr>
                                <tr><th> URL </th><td> {{ $tv->url }} </td></tr>
                                <tr><th> Information </th>
                                    <td> <div class="text-justify">
                                        {{ $tv->information }}    
                                    </div> </td>
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
