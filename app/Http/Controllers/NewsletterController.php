<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        $request= request()->validate(['email' => 'required|email']);
    //  $response = $mailchimp->lists->getAllLists();
    //  dd($response);
    try{
        $newsletter->subscribe(request('email'));  
    }catch(\Exception $e){
        throw \Illuminate\Validation\ValidationException::withMessages([
        'email' => 'This email could not be added to our newsletter list.'
        ]);
        }
        return redirect('/')->with('success','You re are now subscribed to our newsletter');
    }
}
