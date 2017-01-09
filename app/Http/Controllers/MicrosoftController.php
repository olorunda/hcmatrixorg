<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Http\Requests;

class MicrosoftController extends Controller
{
    //redirect to p[rovider]
	
	public function redirectToProvider(){
		
		return Socialite::driver('microsoft')->redirect();
	}
	
	   //get details from callback
	public function callbackurl(){
		
		
		$user=Socialite::driver('microsoft')->user();
		
		\Auth::loginUsingId(\App\User::where('email',$user->getEmail())->select('id')->first());
	  return redirect('home');
	}
}
