<?php
namespace App\Http\Controllers\indians;
use DB;
use Auth;
use Config;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class ValidationController extends  \App\Http\Controllers\Controller
{

	public function __construct()
	{
    	$this->middleware('auth', ['except' => ['login', 'logout']]);
	}


	public function showform()
	{
		return view('login');
	}

	public function checklogin()
	{
		return view('dashboard');
	}

	public function logout()
	{
		Auth::logout();
		Session::flush();
    	return Redirect::route('home');
	}
	
	public function viewprofile()
        {
            $employee = DB::select("SELECT * FROM ".Config::get('constants.tables.USER')." WHERE id='".Auth::id()."'");
        
        return view('viewprofile',['employee'=>$employee]);
        }
}