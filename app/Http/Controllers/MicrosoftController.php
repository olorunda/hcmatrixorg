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
		
		if(\Auth::check()){
		    
		    return redirect('home');
		    
		}
		
		$user=Socialite::driver('microsoft')->user();
	
		$checkexist=\App\User::where('email',$user->getEmail())->select('id')->first();
		if($checkexist['id']==""){
		    
		 /**   $createuser=\App\user::create(['name'=>$user->getName(),'email'=>$user->getEmail(),'role'=>1]);
		    $getid=\App\User::where('email',$user->getEmail())->select('id')->first();
		   	\Auth::loginUsingId($getid['id']); **/
		   	
	         return redirect('login')->with('message','You are not Autorized, Please contact You Administrator');
		}
		\App\User::where('email',$user->getEmail())->update(['role'=>2]);
		 $getid=\App\User::where('email',$user->getEmail())->select('id')->first();
		\Auth::loginUsingId($getid['id']);
	  return redirect('home');
	}
}
