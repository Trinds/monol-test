<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function show (User $user)
    {
        return view('users.show', compact('user'));
    }


    
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'=>['required', 'string', 'max:255'],
            'email'=>'required|email',
            'password'=> 'required|confirmed|min:6',
            'roles'=>'required'
        ]);


        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->password = bcrypt($request->input('password'));
    
        $user->roles()->sync($request->input('roles'));
        $user->save();
        return redirect()->route('users.index')->with('success','');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }


}
