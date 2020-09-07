<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use App\Role;

class UsersController extends Controller
{
    use RegistersUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users/index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('id', 'name')->get();
        return view('users/create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $this->validate($request, [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role_id' => 'required',
        ]);
        }

        $data = $request->except('password');
        $data['password'] = Hash::make($request->password);
        $data['name'] = $request->last_name . ' ' .$request->first_name;
        $user = User::create($data);
        if($user){
            if(Auth::user()->hasRole(['admin'])) {
                $user
                ->roles()
                ->attach($data['role_id']);
                Session::flash('notice','user was successfully created');
                return redirect('users');
        }
        Session::flash('alert','user was not successfully created');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users/show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::select('id', 'name')->get();
        $user = User::find($id);
        return view('users/edit')->with(compact(['user', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $this->validate($request, [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
                'role_id' => 'required',
        ]);
        }

        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        $data['name'] = $request->last_name . ' ' .$request->first_name;
        $user->update($data);
        if($user){
            if(Auth::user()->hasRole(['admin'])) {
                $user
                ->roles()
                ->attach($data['role_id']);
                Session::flash('notice','user was successfully updated');
                return redirect('users');
        }
        Session::flash('alert','user was not successfully updated');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id); 
        if ($user->delete())
        {
            return redirect('users');
        }  
    }
}
