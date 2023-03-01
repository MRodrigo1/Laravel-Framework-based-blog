<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create() {
       return view('register.create'); 
    }
    public function store() {
        var_dump(request()->all());

        $attributes = request()->validate([
        'name' => 'required|max:255|min:3',
        'username' => 'required|max:255|min:3|unique:users,username',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|max:255|min:7'
        //Ou utilizar formato ['example','examplev2',Rule:unique('table','field')];
       ]);
       //$attributes['password'] = bcrypt($attributes['password']);
       $user = User::create($attributes);

       //Log the user in
       auth()->login($user);

       return redirect('/')->with('success','Your account has been created');

    }
}
