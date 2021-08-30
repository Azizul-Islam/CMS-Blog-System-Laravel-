<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index',compact('users'));
    }
    public function show(User $user)
    {
        $roles = Role::latest()->get();
        return view('admin.user.profile',compact('user','roles'));
    }

    public function update(User $user)
    {
       $data = request()->validate([
            'username' => 'required|string|max:255|alpha_dash',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'avatar' => 'file'
        ]);

        $user->username = $data['username'];
        $user->name = $data['name'];
        $user->email = $data['email'];

        if(request('avatar')){
            $data['avatar'] = request('avatar')->store('images');
            $user->avatar = $data['avatar'];
        }

        $user->save();
        return back()->with('info','Successfully update your profile.');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('warning','User has been deleted.');
    }

    public function attachRole(Request $request,User $user)
    {
        $user->roles()->attach($request->role);
        return back()->with('success','Role attach success');
    }

    public function detachRole(Request $request,User $user)
    {
        $user->roles()->detach($request->role);
        return back()->with('success','Role detach success');
    }
}
