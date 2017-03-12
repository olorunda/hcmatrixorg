<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendNotification;
use Hash;
class ProfileController extends Controller
{
    //
	public function  __construct(){
		
		if(session('locale')==""){
			session(['locale'=>'en']); 
	
		}
	 		 
	}
	
	public function updateprofile(Request $request){
		
		try{
			
			$updateprofile=\App\User::where('id',$request->user()->id)
								->update([
						 'kin_relationship'=>$request->kinrel,
						'kin_phonenum'=>$request->kinphone,
						'kin_address'=>$request->kinaddr,
						'next_of_kin'=>$request->nextkin,
						'phone_num'=>$request->phone,
						'email'=>$request->email,
						'address'=>$request->addr,
						'marital_status'=>$request->maritalstat
					]);
					
				return  response()->json('success',200);	
			
		}
		catch(\Exception $ex){
			
			\Log::error("Error:$ex");
			return response()->json("Error:$ex",404);
		}  
		
		
	}
	
	//changepassword
	public function changepassword(Request $request){
		 
                  if(!Hash::check($request->oldpass,$request->user()->password)){
                       
                      \Auth::logout();
                      return response()->json('incorrect',200);
                    
                       
                         
                }

		$changepassword=app('App\Repositories\EmployeeRepository')->changepassword($request->user()->id,bcrypt($request->oldpass),bcrypt($request->newpass));
                 
			$data=['email'=>$request->user()->email,'name'=>$request->user()->name,'newpass'=>$request->newpass];
			
			 $message="Your Password have been Successfully Changed , Click <a href='".\URL::to('/login')."'>here</a> to login";
			 session(['notifymessage22'=>$message]);
			\Mail::to($data['email'])->send(new SendNotification($data['name'],$data['email'],$message));
		 
		return $changepassword;
		 
		
	}
	//changepicture
	public function changepicture(Request $request){
		
		$this->validate($request,['file' => 'required']);
		try{
	/*if($request->file('file')->getClientOriginalExtension() !='csv'){

		return response()->json('Only Csv Allowed',404);
	  }*/
	  	$allowableext=['jpg','png','jpeg'];	
			if(!in_array($request->file('file')->extension(),$allowableext)){
				
				return response()->json("Error:file extension not valid",404);
				
			}
			
			if ($request->file('file')->isValid()) {
    //		$name\
	
		   // $name=$request->name.'.'.$request->file('file')->extension();
			
			$path = $request->file('file')->store('storage/upload/'.\Auth::user()->id,'public');
			$updatepic=\App\User::where('id',\Auth::user()->id)
								->update(['image'=>$path]);
			if($updatepic==1){
				
				return response()->json("Success",200);
			}					
				return response()->json("Error",404);
			}
				return response()->json("File Not Valid",404);
		}
		catch(\Exception $ex){
			
			
				return response()->json($ex,404);
	
		}
 
	

	}
	
	public function adddependant(Request $request,$id){
		
		
		
		$this->validate($request,['dep_email'=>'required|email']);
		try{
			
			$dob=date('Y-m-d',strtotime($request->dep_dob));
			//return $dob;
			if($id==0){
			$adddependant=\App\emp_dependants::create(['name'=>$request->dep_name,'dob'=>$dob,'email'=>$request->dep_email,'phone_num'=>$request->phone_num,'emp_id'=>\Auth::user()->id,'relationship'=>$request->relationship]);
			}
			else{
				
			$updateependant=\App\emp_dependants::where('id',$id)->update(['name'=>$request->dep_name,'dob'=>$dob,'email'=>$request->dep_email,'phone_num'=>$request->phone_num,'emp_id'=>\Auth::user()->id,'relationship'=>$request->relationship]);
			}
			return response()->json("Success",200);
		}
		catch(\Exception $ex){
			
			return response()->json("Error:$ex",404);
		}
		
		
	}
	

	
	public function displaydependant($id){
		
		$dispdependant=\App\emp_dependants::where('emp_id',$id)
										   ->get();
										   
		return  $dispdependant;
		
	}
	//ACADEMICS MANIPULATION
	
	 
 
	//PAST EXPERIENCES MANIPULATION ENDS
	public function displayexperiences($id){
		
		$dispexp=\App\emp_past_emp::where('emp_id',$id)
										   ->get();
										   
		return  $dispexp;
		
	}
	
	public function addexperiences(Request $request,$id){
		
		try{
			$from=date('Y-m-d',strtotime($request->froms));
			$to=date('Y-m-d',strtotime($request->to));
			 //return $dob;
			if($id==0){
			$addexp=\App\emp_past_emp::create(['organization'=>$request->organization,'role'=>$request->role,'emp_id'=>\Auth::user()->id,'from'=>$from,'to'=>$to]);
			
			
			}
			else{
				
			$updateexp=\App\emp_past_emp::where('id',$id)->update(['organization'=>$request->organization,'role'=>$request->role,'from'=>$from,'to'=>$to]);
			}
			return response()->json("Success",200);
		}
		catch(\Exception $ex){
			
			return response()->json("Error:$ex",404);
		}
		
		
	}
	
	public function deleteexperiences($id){
		
		try{
			$deleteexp=\App\emp_past_emp::where('id',$id)
											->delete();
			return response()->json('Success',200);								
		}
		catch(\Exception $ex){
			
			return response()->json('Error'.$ex,404);
		}
		
	}
	

	//PAST EXPERIENCES MANIPULATION ENDS
	
	public function displayacademics($id){
		
		$dispacademics=\App\emp_academics::where('emp_id',$id)
										   ->get();
										   
		return  $dispacademics;
		
	}
	
	public function addacademics(Request $request,$id){
		
		try{
			$year=date('Y-m-d',strtotime($request->year));
			 //return $dob;
			if($id==0){
			$addskill=\App\emp_academics::create(['qualification'=>$request->qualification,'year'=>$year,'institution'=>$request->institution,'grade'=>$request->grade,'course'=>$request->course,'emp_id'=>\Auth::user()->id]);
			
			
			}
			else{
				
			$updateskill=\App\emp_academics::where('id',$id)->update(['qualification'=>$request->qualification,'year'=>$year,'institution'=>$request->institution,'grade'=>$request->grade,'course'=>$request->course]);
			}
			return response()->json("Success",200);
		}
		catch(\Exception $ex){
			
			return response()->json("Error:$ex",404);
		}
		
		
	}
	
	public function deleteacademics($id){
		
		try{
			$deleteskill=\App\emp_academics::where('id',$id)
											->delete();
			return response()->json('Success',200);								
		}
		catch(\Exception $ex){
			
			return response()->json('Error'.$ex,404);
		}
		
	}
	
	//SKILL MANIPULATION
	public function displayskill($id){
		
		$dispskill=\App\emp_skill::where('emp_id',$id)
										   ->get();
										   
		return  $dispskill;
		
	}
	
	public function addskills(Request $request,$id){
		
		try{
			
			 //return $dob;
			if($id==0){
			$addskill=\App\emp_skill::create(['skill'=>$request->skill,'experience'=>$request->experience,'rating'=>$request->rating,'remarks'=>$request->remark,'emp_id'=>\Auth::user()->id]);
			}
			else{
				
			$updateskill=\App\emp_skill::where('id',$id)->update(['skill'=>$request->skill,'experience'=>$request->experience,'rating'=>$request->rating,'remarks'=>$request->remark,'emp_id'=>\Auth::user()->id]);
			}
			return response()->json("Success",200);
		}
		catch(\Exception $ex){
			
			return response()->json("Error:$ex",404);
		}
		
		
	}
	
	public function deleteskills($id){
		
		try{
			$deleteskill=\App\emp_skill::where('id',$id)
											->delete();
			return response()->json('Success',200);								
		}
		catch(\Exception $ex){
			
			return response()->json('Error'.$ex,404);
		}
		
	}
	//END SKILL MANIPULATION
	
	public function deletedependant($id){
		
		try{
			$deletedependnt=\App\emp_dependants::where('id',$id)
											->delete();
			return response()->json('Success',200);								
		}
		catch(\Exception $ex){
			
			return response()->json('Error'.$ex,404);
		}
		
	}

	
	

}
