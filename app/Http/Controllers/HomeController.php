<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		if(session('locale')==""){
			session(['locale'=>'en']); 
	
		}
		 		 
        $this->middleware('auth');
        $this->middleware('rights');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
	public function changelang(Request $request,$locale){
		
		 session(['locale'=>$locale]); 
		$url= explode('/',request()->headers->get('referer'));
		if(isset($url[3]) && strlen($url[3])==2){
			
		return redirect(str_replace($url[3],$locale,request()->headers->get('referer')));
		}
		else{
			return redirect('/'.$locale.'/home');
		}
		 // return str_replace($url[3],$locale,"request()->headers->get('referer')");
	//return \Redirect::back();
	}
	public function logout(){
		\Auth::logout();
		return redirect('/login');
		
	}
}
