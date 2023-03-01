<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;



class SessionsController extends Controller
{
    public function create() {
       
        return view('sessions.create'); 
    }

    public function store() {
       $credentials = request()->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required'
       ]);
       if(auth()->attempt($credentials)){
        //regenerar um users session ID
        session()->regenerate();
            redirect("/")->with('success','Welcome Back!');
       }
       //ou
       throw ValidationException::withMessages([
        'email' => 'Your provided credentials could not be verified'
       ]);
        //return back()->withInput()->withErrors(['email' =>'Your provided credentials could not be verified']); //$errors
    }

    public function destroy() {
       auth()->logout();
       return redirect('/')->with('success','Goodbye!');
    }
}
