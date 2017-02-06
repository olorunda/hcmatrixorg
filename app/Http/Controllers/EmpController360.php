<?php

namespace App\Http\Controllers;

use App\Mail\SendNotification;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;

class EmpController360 extends Controller
{
	protected $employee;
	
	public function __construct(EmployeeRepository $employee){
		
		$this->middleware('auth');
		$this->employee=$employee;
	}
	
	//employee list disp
	public function emplist(){
		
	$employee=$this->employee->allemployee(4);
	
	$querytype=$this->employee->querytypes();
	
	$linemanager=$this->employee->allemployee(1);
	
	return view('empreview360.360review',['employees'=>$employee,'lms'=>$linemanager]);
	
	}
	
	public function savereview(Request $request){
		
		try {
		$savereview=\App\emp_review::create(['emp_id'=>$request->empid,'reviewer_id'=>$request->user()->id,'review'=>$request->review,'reviewername'=>\Auth::user()->name]);
		
		$getlmid=\App\User::where('id',$request->lmid)->select('name','email')->first();
		$message=\Auth::user()->name." Just Reviewed ".$request->reviewee. "<br> <b>Review :</b><p>".$request->review."</p> Click <a href='".\Url('lm/rate?isemp='.$request->empid)."' >here</a> to view review ";
		session(['notifymessage22'=>$message]);
		//send notify email
		\Mail::to($getlmid['email'])->send(new SendNotification($getlmid['name'],$request->user()->email,$message));
	
		return response()->json('Success',200);
		}
		catch(\Exception $ex){
			\Log::error($request->review.$ex);
			return response()->json('Error:'.$ex,404);
		}
		
		
		
	}
	
	//get individual rating
	public function getrate($empid,$reviewerid){
			if(session()->has('FY')||session('FY')!=""){
			
			$date=session('FY');
		}
		else{
			$date=date('Y');
		}
		$getrate=\App\emp360rating::where('emp_id',$empid)
								->where('created_at','LIKE','%'.$date.'%')
								->select('rate')
								->first();
			if($getrate==""){
				$getrate=0;	
			}	
				else{
					$countrate=\App\emp360rating::where('emp_id',$empid)
								->where('created_at','LIKE','%'.$date.'%')
								->select('rate')
								->count('id');
					$getrate=$getrate['rate'];
				}
		$rated=\App\emp360rated::where('emp_id',$empid)
								->where('rater_id',$reviewerid)
								->where('created_at','LIKE','%'.$date.'%')
								->select('rater_id')
								->first();
					if($rated==""){
					
					$packrate=["rating"=>$getrate,"rated"=>0];
					return $packrate;
					}
				$packrate=["rating"=>$getrate,"rated"=>1];
			
				return $packrate;
		
		
		
	}
	//rate employee
	public function rateemployee(Request $request){
		try{
		$checkstar=\App\emp360rating::where('emp_id',$request->empid)->first();
		if($checkstar==""){
			$createstart=\App\emp360rating::create(['emp_id'=>$request->empid,'rate'=>$request->score]);
		}
		else{
			
			$aggrscore=($checkstar['rate']+$request->score)/2;
			$createstart=\App\emp360rating::where('emp_id',$request->empid)
											->update(['rate'=>$aggrscore]);
		}
		$lograted=\App\emp360rated::create(['rater_id'=>\Auth::user()->id,'emp_id'=>$request->empid]);
		//send mail
		$getlmid=\App\User::where('id',$request->lmid)->select('name','email')->first();
		
		$message=\Auth::user()->name." Just Rated  ".$request->empname."";
		session(['notifymessage22'=>$message]);
		//send notify email
		\Mail::to($getlmid['email'])->send(new SendNotification($getlmid['name'],$request->user()->email,$message));
		return response('Success',200);
		}
		catch(\Exception $ex){
		return response('Error:'.$ex,404);
		}
	}
	
	
	//employee 360
	public function getreview(Request $request){
		
		$skip=$request->skip;
		if(session()->has('FY')||session('FY')!=""){
			
			$date=session('FY');
		}
		else{
			$date=date('Y');
		}
		if(\Auth::user()->role==2):
		$getreview=\DB::table('emp_reviews')
				->join('users','emp_reviews.emp_id','=','users.id')
				 ->where('emp_id',$request->empid)
				 ->where('users.linemanager_id',\Auth::user()->id)
				 ->orWhere('users.id',\Auth::user()->id)
				 ->where('emp_reviews.created_at','LIKE','%'.$date.'%')
				 ->skip($skip)->take(5)
				 ->select('emp_reviews.*')
				 ->get();
		elseif(\Auth::user()->role==3):
		
	$getreview=\App\emp_review::where('emp_id',$request->empid)
			
								->where('created_at','LIKE','%'.$date.'%')
								->skip($skip)->take(5)
								->get();
		
		else:
	$getreview=\App\emp_review::where('emp_id',$request->empid)
								->where('reviewer_id',$request->reviewerid)
								->where('created_at','LIKE','%'.$date.'%')
								->skip($skip)->take(5)
								->get();
		endif;
				return $getreview;
	}
	
	public function countreview(Request $request){
		
		if(session()->has('FY')||session('FY')!=""){
			
			$date=session('FY');
		}
		else{
			$date=date('Y');
		}
		
		if(\Auth::user()->role==2):
		$getreview=\DB::table('emp_reviews')
				->join('users','emp_reviews.emp_id','=','users.id')
				 ->where('emp_id',$request->empid)
				 ->where('users.linemanager_id',\Auth::user()->id)
				 ->orWhere('users.id',\Auth::user()->id)
				 ->where('emp_reviews.created_at','LIKE','%'.$date.'%')
				 ->count('users.id');
		elseif(\Auth::user()->role==3):
		
	$getreview=\App\emp_review::where('emp_id',$request->empid)
								->where('created_at','LIKE','%'.$date.'%')->count('id');
		
		else:
	$getreview=\App\emp_review::where('emp_id',$request->empid)
								->where('reviewer_id',\Auth::user()->id)
								->where('created_at','LIKE','%'.$date.'%')
								->count('id');
		endif;
		
		return $getreview;
			
	}
}
