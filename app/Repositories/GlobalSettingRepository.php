<?php


namespace App\Repositories;

use Excel;

use DB;

class GlobalSettingRepository{
	
	
	
	//returns all job titles in an oraganisation
	public function getjob($type){
		if($type==0){
	$getjobs=\App\job::all();
		}
			else{
				
				$getjobs=\App\job_dep::all();	
			}
	return $getjobs;	
		
		
	}
	
	//get apptitude settings
	public function appsett(){
		
		$app=\App\testsetting::first();
		return $app;
	}
	
	//modify template
	public function modifytemplate(array $data,$qid){
		
		try{
			
			$queryupdate=\App\query_type::where('id',$qid)->update($data);
			return response()->json('success',200);
			
		}
		catch(\Exception $ex){
			
			return response()->json("Error:$ex");
		}
		
		
	}
	
	//get holiday
	public function getholiday(){
		
	return \App\public_holiday::all();

	}
	//modify holiday
	 public function modholiday(array $data,$holid){
	   
	   try{
		   
	   $modify=\App\public_holiday::where('id',$holid)->update($data);
	   
	   return response()->json("success",200);
	   
	   }
	   catch(\Exception $ex){
		   
		   return response()->json("Error:$ex",404);
	   }
   }
	
	//create cbt question option
	public function createoption(array $option){

		

		

		$option=\App\option::create($option);

		if($option){

		  return 'success';

			

		}else{

			

			return 'failure';

		}

		

	}

	
	
	//APPTITUDE TEST UPLOAD 
	public function createcorrect(array $correct){

		$correct=\App\correct::create($correct);

		if($correct){

			return 'success';

		}

		else{

			return 'failure';

			

		}

	}
	
	//delete question
	public function deletequestion($id){

		
	try{
		$question=\App\Questions::find($id);

		$question->delete();

		$option=\App\option::where('question_id',$id);

		$option->delete();

		$correct=\App\correct::where('question_id',$id);

		$correct->delete();

		

		return response()->json('success',200);
	}
	catch(\Exception $ex){
		
		return response()->json("Error:$ex");
	}

	}


	//update question
		public function updatequestion(array $data1, array $data2,array $data3 ,$questionid){

		try{
		$updatequestion=DB::table('questions')

					->where('id',$questionid)

					->update($data1);

					

		$updateoption=DB::table('options')

					->where('question_id',$questionid)

					->update($data2);

					

		$updatecorrect=DB::table('corrects')

					->where('question_id',$questionid)

					->update($data3);

					

		if($updatequestion||$updatecorrect||$updateoption){

			

			return response()->json('You have successfully updated Question',200);

			

		}

		else{

			return response()->json('0',200);	

		}
		
		}
		catch(\Exception $ex){
			return response()->json("Error:$ex",404);
		}

		

	}

	
	public function createquestion(array $question){

		$questionid=DB::table('questions')->insertGetId($question);

		

	    return $questionid;

	}

	
	//APPTITUDE TEST UPLOAD ENDS
	public function getdept($depid){
		
		$getdepartment=\App\job_dep::where('id',$depid)
		->select('spec')
		->first();
		
		return $getdepartment;
	}
	
	//upload employee
	public function uploademp(array $data){
		
		$uploademp=DB::table('users')->insertGetId($data);

		return $uploademp;
	}
	
	public function createstate(array $data){
		
		$uploadstate=\App\contact::create($data);
		
	}
	//manage pilot
	public function managepilot($type,$id,$objective,$commitment){
		try{
			
		if($type==1){
			
			$savepilot=\App\goal::create(['objective'=>$objective,'commitment'=>$commitment,'goal_cat'=>2]);
			
		}
		else{
			$savepilot=\App\goal::where('id',$id)->update(['objective'=>$objective,'commitment'=>$commitment]);
		}
		return response()->json('success',200);
		}
		catch(\Exception $ex){
			\Log::error("$ex");
			return response()->json("Error:$x",404);
		}
		
	}
	//upload job bulk
	public function uploadjob(array $data){
		
	try{
		$jobupload=\App\job::create($data);
		
		return 1;
		
	}
	
	catch(\Exception $ex){
		
		\Log::error("Sql Error:$ex");
			
		
	}
		
	}
	
	
	
	//get attendance
	public function attendance($type=0,$startdate=0,$enddate=0,$empname=0,$restype=0){
		
		//ADMIN-HR CONDITION
		if(\Auth::user()->role==3){
			if($type==='datesearch'){
				$getattendance=\DB::table('users')
							->join('attendances','users.emp_num','=','attendances.user_id')
							->select('attendances.created_at','attendances.id as ids ','attendances.clockout_time','attendances.status','users.name','users.id','users.emp_num')
							->where('users.linemanager_id','!=',0)
							
							->whereBetween('attendances.created_at',[$startdate,$enddate])
							
							->paginate(30);		
			}
			 elseif($type==='empsearch'){
				$getattendance=\DB::table('users')
							->join('attendances','users.emp_num','=','attendances.user_id')
							->select('attendances.created_at','attendances.id as ids','attendances.clockout_time','attendances.status','users.name','users.id','users.emp_num')
							->where('users.linemanager_id','!=',0)
							->where('users.name','like','%'.$empname.'%')
							->whereBetween('attendances.created_at',[$startdate,$enddate])
							->paginate(30);
				
			} 
			else{
			$getattendance=\DB::table('users')
							->join('attendances','users.emp_num','=','attendances.user_id')
							->select('attendances.created_at','attendances.id as ids','attendances.clockout_time','attendances.status','users.name','users.id','users.emp_num')
							->where('attendances.created_at','like','%'.date('Y-m-d').'%')
							->where('users.linemanager_id','!=',0)
							->paginate(30);
			}
		}
			//LINE MANAGER CONDITION
		else{
						if($type==="datesearch"){
				$getattendance=\DB::table('users')
							->join('attendances','users.emp_num','=','attendances.user_id')
							->select('attendances.created_at','attendances.id as ids','attendances.clockout_time','attendances.status','users.name','users.id','users.emp_num')
							
							->whereBetween('attendances.created_at',[$startdate,$enddate])
							
							->paginate(30);	
				
				
			}
			elseif($type==="empsearch"){
				$getattendance=\DB::table('users')
							->join('attendances','users.emp_num','=','attendances.user_id')
							->select('attendances.created_at','attendances.id as ids','attendances.clockout_time','attendances.status','users.name','users.id','users.emp_num')
							->whereBetween('attendances.created_at',[$startdate,$enddate])
							->where('users.linemanager_id','=',\Auth::user()->id)
						
							->where('users.name','like','%'.$empname.'%')
								
								
							->paginate(30);
				
			} 
			
		
			else{
			$getattendance=\DB::table('users')
							->join('attendances','users.emp_num','=','attendances.user_id')
							->select('attendances.created_at','attendances.id as ids','attendances.clockout_time','attendances.status','users.name','users.id','users.emp_num')
							->where('attendances.created_at','like','%'.date('Y-m-d').'%')
							->where('users.linemanager_id','=',\Auth::user()->id)
							->paginate(30);
			}	
		}
		if($restype==0){
		return $getattendance;
		}
		else{
			
		//repository
		foreach($getattendance as $data){

			$result[]=['ID'=>$data->emp_num,'First Name'=>$data->name,'ClockIn Time'=>$data->created_at,'Clock Out Time'=>$data->clockout_time,'Status'=>$data->status];

		}

		if(!isset($result)){

			$data=["Empty"=>"No Result Found"];

		}

		else{

	$data=$result;

		}

	Excel::create('attendance', function($excel) use($data) {



    $excel->sheet('attendancedata', function($sheet) use($data) {



        $sheet->fromArray($data);



    });



		})->export('xls');

    
	  
	  
	  
		}
		
	}
	
	//saveholiday
	public function saveholiday(array $data){
		
		try{
			
			$saveholiday=\App\public_holiday::create($data);
			
			return response()->json("success",200);

		}
		catch(\Exception $ex){
			
			\Log::error("Error:$ex");
			return response()->json("Error:$ex",200);
		}
		
		
		
		
	}
	
	//gettotal employee 
	public function emplatestat($role){
		
		if($role==3){
			$users=\App\user::where('linemanager_id','!=',0)->count('id');	
			$countearly=\DB::table('users')
					->join('attendances','users.emp_num','=','attendances.user_id')
					->where('users.linemanager_id','!=',0)
					->where('attendances.created_at','like','%'.date('Y-m-d').'%')
					->where('attendances.status','Early')
					->count('attendances.id');
			
			$countlate=\DB::table('users')
					->join('attendances','users.emp_num','=','attendances.user_id')
					->where('users.linemanager_id','!=',0)
					->where('attendances.created_at','like','%'.date('Y-m-d').'%')
					->where('attendances.status','Late')
					->count('attendances.id');
					
		}
		else{
			$users=\App\user::where('linemanager_id','=',\Auth::user()->id)->count();
				$countearly=\DB::table('users')
					->join('attendances','users.emp_num','=','attendances.user_id')
					->where('users.linemanager_id','=',\Auth::user()->id)
					->where('attendances.created_at','like','%'.date('Y-m-d').'%')
					->where('attendances.status','Early')
					->count('attendances.id');	
			    
				$countlate=\DB::table('users')
					->join('attendances','users.emp_num','=','attendances.user_id')
					->where('users.linemanager_id','=',\Auth::user()->id)
					->where('attendances.created_at','like','%'.date('Y-m-d').'%')
					->where('attendances.status','Late')
					->count('attendances.id');
		}
		return ['early'=>$countearly,'late'=>$countlate,'total'=>$users];
		
	}
	//format date well
	public function processdate($date){
		
		$source = $date;
		$date = new \DateTime($source);
		
		return $date->format('Y-m-d H:i:s'); 
		
		
	}
	
	//get working hours
	public function getworkinghours(){
		$getbuinesshours=\App\workinghours::first();
		return $getbuinesshours;
	}
	//check early
	public function checkearly($clockintime,$updatedearly,$empid,$attendanceid){

					$getbuinesshours=\App\workinghours::first();
					
						$clockedin=$clockintime;
						$splitclockin=explode(' ',$clockedin);
						$clocktime=$splitclockin[1];
						
						if (strtotime($clocktime) < strtotime($getbuinesshours['sob'])) {
					if($updatedearly==""){
						\App\attendance::where('id',$attendanceid)
								->update(['status'=>'Early']);
					}
							return "Early";
							}
							
						else{
							if($updatedearly==""){
						\App\attendance::where('id',$attendanceid)->update(['status'=>'Late']);
					}
							return "Late";
						}
						
	
	}
	
	//save fiscal
	public function savefiscal(array $data){
		try{
			$check=\App\fiscal::select('id')->first();
			if($check['id']==""){
	  $savefiscal=\App\fiscal::create($data);
			}
			else{
			 $savefiscal=\App\fiscal::where('id',$check['id'])->update($data);
		
			}
		return response()->json('success',200);
		}
		catch(\Exception $ex){
			
			\Log::error("Error:$ex");
			return response()->json("Error:$ex",404);
		}
		
	}
	
	public function getlmcount($role){
		if($role==5){
		return \App\user::where('linemanager_id','!=',0)->count('id');
			
		}
		return \App\user::where('role',$role)->count('id');
		
	}
	//modify job
	public function modifyjob(array $data,$jobid){
		
		$modifyjob=\App\job::where('id',$jobid)
					->update($data);
		
	}
	//upload dept bulk
	public function uploaddep(array $data){
		
		try{
		$deptupload=\App\job_dep::create($data);
		return 1;
		
		}
		catch(\Exception $ex){
			
			\Log::error("Sql error:$ex");
			
			
		}
	}
	
	// get fiscal
	public function getfiscal(){
		
		
		$getfiscal=\App\fiscal::orderBy('created_at','desc')->first();
		
		return $getfiscal;
		
	}
	
	
	
}