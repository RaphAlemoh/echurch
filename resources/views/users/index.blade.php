@extends('layouts.admin.app')
@section('title', 'All Users')
@section('content')
<div class="container-fluid">
        <h1 class="mt-2">Dashboard</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Users</li>
        </ol>
   <div class="row">
     <div class="flex justify-center mt-20">
     @if (session('notice'))
         <h3 class="alert alert-success text-center" role="alert">
             {{ session('notice') }}
         </h3>
     @endif  
     </div>   
       <div class="col-md-12">
           <div class="card mb-4"> 
               <div class="card-header text-center text-success"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Users</div>
               <div class="card-body">
                   <a href="{{ url('users/create') }}" class="btn btn-success btn-sm" title="Add New User">
                       <i class="fa fa-plus" aria-hidden="true"></i> Add User
                   </a>

                   <br/>
                   <br/>
                   <div class="table-responsive mt-4">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='10'>
                           <thead>
                               <tr>
                                   <th>#</th>
                                   <th>Name</th>
                                   <th>Email</th>
                                   <th>Verification</th>
                                   <th>Actions</th>
                               </tr>
                           </thead>
                           <tbody>
                           @foreach($users as $item)
                               <tr>
                                   <td>{{ $loop->iteration }}</td>
                                   <td>{{ $item->name }}</td>
                                   <td>{{ $item->email }}</td>
                                   @if($item->email_verified_at == NULL)
                                   <td>{{ ('Not Verified') }}</td>
                                   @else
                                   <td>{{ ('Verified') }}</td>
                                   @endif
                                  
                                   <td>
                                       <a href="{{ url('users/' . $item->id ) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                       <a href="{{ url('users/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                       @if(Auth::user()->hasRole('admin'))
                                       <form method="POST" action="{{ url('users/'. $item->id) }}" role="form" style="display:inline;">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                           <button type="submit" class="btn btn-danger btn-sm" title="Delete User" onclick= "return confirm('Confirm delete?')">
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
