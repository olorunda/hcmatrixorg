<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use League\Csv\Reader;

use App\Repositories\GlobalSettingRepository;

class GlobalSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	protected $settings;
	
	public function __construct(GlobalSettingRepository $settings){
		$this->middleware('auth');
		$this->settings=$settings;
	}
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
   //delete job
   public function deletejob($id,$division){
	   
	   try{
		   if($division==1){
			 $deletedepartment=\App\job_dep::where('id',$id)->delete();
		   
		   }
		   else{
	   $deletejob=\App\job::where('id',$id)->delete();
		   }
	   return response()->json('success',200);
	   }
	   catch(\Exception $ex){
		   
		   return response()->json("Error: $ex");
	   }
   }
   
   //pilot goal management
   public function managepilot(Request $request){
	   
	   $managepilot=$this->settings->managepilot($request->type,$request->id,$request->objective,$request->commitment);
	   return $managepilot; 
   }
   //delete pilot goal 
   public function deletepilot($id){
	   
	   try{
			\App\goal::where('id',$id)->delete();
			return response()->json('success',200);
		   
	   }
	   catch(\Exception $ex){
		   
		   return response()->json("Error:$ex",404);
	   }
   }
   //set wrkhrs
   public function setwrkhrs(Request $request){
	   $check=\App\workinghours::first();
	   if($check['id']!=""){
		$update=\App\workinghours::where('id',$check['id'])->update(['sob'=>$request->start,'cob'=>$request->end]);
			return response()->json('Working Hours Updated Successfully');
	   }
	   else{
		 $create=\App\workinghours::create(['sob'=>$request->start,'cob'=>$request->end]);
		 
		 return response()->json('Settings Successfully Saved');
	   }
   }
   
   //assign role
   public function assignerole(Request $request){
	   
	   try{
		 $assignrole=\App\user::where('id',$request->empid)->update(['role'=>$request->role]);  
		return response()->json("Success :",200);
	   }
	   catch(\Exception $ex){
		   \Log::error("Error:$ex");
		   return response()->json("Error:$ex",404);
	   }
	  
   }
   
   //mod holiday
   public function modholiday(Request $request){
	   
	$modifyhol=$this->settings->modholiday(['end_date'=>$request->modto,'start_date'=>$request->modfrom,'title'=>$request->modholname],$request->holid); 

    return $modifyhol;	
	   
	   
   }
   
   //saveleave
 //getleave day per role
  public function getleaveday(Request $request){
	  
	  try{
	  $getjobrole=\App\absencesetting::where('role',$request->jobrole)
										->select('day_num')
										->first();
										
		if($getjobrole['day_num']==""){
			return response()->json("",200);
		
		}
			return response()->json($getjobrole['day_num'],200);
										
	  }
	  catch(\Exception $ex){
		  
		  return response()->json("Error:$ex",404);
	  }
  }
  
  //attachleave
  public function attachleave(Request $request){
	  try {
		  
		  $checkexist=\App\absencesetting::where('role',$request->jobrole)->select('id')->first();
		  if($checkexist['id']==""){
		  
		  $attactleave=\App\absencesetting::create(['day_num'=>$request->leaveday,'role'=>$request->jobrole]);
		  
		  }
		  else{
			  
			  $attactleave=\App\absencesetting::where('role',$request->jobrole)->update(['day_num'=>$request->leaveday]); 
		  }
		  
		  return response()->json("Success",200);
	  }
	  
	  catch(\Exception $ex){
		  
		  return response()->json("Error:$ex",404);
		  
	  }
	  
  }
   //assign emp
   public function assignemp($empid,$lmid){
	   
	   try{
		   
	 $mapemp=\App\User::where('id',$empid)->update(['linemanager_id'=>$lmid]); 
	 
	 return response()->json('success',200);
	 
	   }
	   catch(\Exception $ex){
		   
		   \Log::error("Error:$ex");
		   
		   return response()->json("Error:$ex",404);
		   
	   }
   }
   //manually adding jobs
   public function addjobdeptmanal(Request $request,$type){
	  try{
		if($type==1){
		$modifydepartment=\App\job_dep::where('id',$request->depid)
							->update(['spec'=>$request->department]);
		}
		else{
			
		if($request->type==1){
			if($request->action==0){
			$addjob=$this->settings->uploadjob(['title'=>$request->title,'description'=>$request->description,'jobdep_id'=>$request->jobdepid]);
			}
			else{
				//modify
			$modifyjob=$this->settings->modifyjob(['title'=>$request->title,'description'=>$request->description,'jobdep_id'=>$request->jobdepid],$request->jobid);
			
			}
		}
		else{
			$addjob=$this->settings->uploaddep(['spec'=>$request->departspec]);
		}
		
		}
	   
	   return response()->json('success',200);
	  }
	  catch(\Exception $ex){
		  
		  \Log::error("Error:$ex");
		  return response()->json("Error:$ex ",404);
	  }
   }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($route)
    {
       if($route=="jobdepsettings"){
		   
		  $getjob=$this->settings->getjob(0);
		  $getdept=$this->settings->getjob(1);
		  
		return view('adminsettings.jobdepsettings',['alljobs'=>$getjob,'dept'=>$getdept]);
	   } 
	   
	   if($route=="settings"){
		   
		    $getfiscal=$this->settings->getfiscal();
			$leavecat=app('App\Repositories\EmployeeRepository')->leavecat('all');
	       $querytype=app('App\Repositories\EmployeeRepository')->querytypes();
			return view('adminsettings.setting',['fiscal'=>$getfiscal,'querytype'=>$querytype,'leaves'=>$leavecat]);
	   } 
	   
	   if($route=="leavestting"){
		   
		   
	   } 
	   if($route=='executiveview'){
			
			
			return view('adminsettings.excutiveview');
		}
	   if($route=="querysetting"){
		   
		   
	   } 
	   
	   if($route=="pilotgoalsetting"){
		   
		   
	   }
	   if($route=="setrole"){
		   
		// return view()  
	   }
	   if($route=="attendance"){
		   
		   $getattendance=$this->settings->attendance();
		   $attstat=$this->settings->emplatestat(\Auth::user()->role);
		   	$querytype=app('App\Repositories\EmployeeRepository')->querytypes();
		   //return $getattendance;
		   return view('adminsettings.attendance',['attendances'=>$getattendance,'querytype'=>$querytype,'attstat'=>$attstat]);
		   
	   }
	   
    }
	
	//delete question
		public function deletequestion($id)
	{

		$deletequestion=$this->settings->deletequestion($id);

		return $deletequestion;

	}
	//
	public function attendancetimesearch(Request $request){
		
		$attstat=$this->settings->emplatestat(\Auth::user()->role);
		$startdate=$this->settings->processdate($request->startdate.' '.$request->starttime);
		$enddate=$this->settings->processdate($request->enddate.' '.$request->enddtime);
		if(isset($request->q)){
		
		$type='empsearch';	
		$empname=$request->q;
		}
		else{
		$type='datesearch';
		$empname=0;
		}
		$restype=$request->type;
		$getattendance=$this->settings->attendance($type,$startdate,$enddate,$empname,$restype);
		$querytype=app('App\Repositories\EmployeeRepository')->querytypes();
		return view('adminsettings.attendance',['attendances'=>$getattendance,'attstat'=>$attstat,'querytype'=>$querytype]);
		
		
	}
    
	//save setting
	public function savesetting(Request $request){
		
		try{
			
		$savesettings=\App\testsettings::first();
		if($savesettings['id']!=""){
			
			$savesettings=\App\testsettings::where('id',1)->update(['duration'=>$request->duration,'dispques'=>$request->quesnum]);
		}
		else{
			$savesettings=\App\testsettings::create(['duration'=>$request->duration,'dispques'=>$request->quesnum]);
		}
			return response()->json("Success",200);
		}
		catch(\Exception $ex){
			
			\Log::error("Error:$ex");
			return response()->json("Error:$ex",404);
		}
			}
	//modify query
		public function modifyquery(Request $request){
		
		$modifytemplate=$this->settings->modifytemplate(['title'=>$request->title,'template'=>$request->template],$request->qtypeid);
		
		return $modifytemplate;
		
	}
	
	//update question
		       public function updatequestion(Request $request){

//	 return $request->answer;

			$data1=['content'=>$request->question];

			$data2=['option1'=>$request->option1,'option2'=>$request->option2,'option3'=>$request->option3,'option4'=>$request->option4,'correctoption'=>$request->answer];

			$data3=['correctoption'=>$request->answer];

			


		$modifiedquest=$this->settings->updatequestion($data1,$data2,$data3,$request->id);		

		return $modifiedquest;
	}
	//import employee
	public function importemployee(Request $request){
		$this->validate($request,['file' => 'required']);

	if($request->file('file')->getClientOriginalExtension() !='csv'){

		return response()->json('Only Csv Allowed',404);
	  }

 

		try{
			
		$reader = Reader::createFromPath($request->file('file')->getRealPath());

		// 1 for jobs,2 for department

			$keys = ['emp_num','name','sex','dob','age','email','phone_num','marital_status','workdept_id','job_id','hiredate','role','last_promoted','address','next_of_kin','kin_address','kin_phonenum','kin_relationship','state_origin_id','lga','street','city','state_id'];

			$results = $reader->fetchAssoc($keys);

			foreach ($results as $newemp) {

				
		$createemp=$this->settings->uploademp(
		[
		'emp_num'=>$newemp['emp_num'],
		'name'=>$newemp['name'],
		'sex'=>$newemp['sex'],
		'dob'=>$newemp['dob'],
		'age'=>$newemp['age'],
		'email'=>$newemp['email'],
		'phone_num'=>$newemp['phone_num'],
		'marital_status'=>$newemp['marital_status'],
		'workdept_id'=>$newemp['workdept_id'],
		'job_id'=>$newemp['job_id'],
		'hiredate'=>$newemp['hiredate'],
		'role'=>$newemp['role'],
		'last_promoted'=>$newemp['last_promoted'],
		'address'=>$newemp['address'],
		'next_of_kin'=>$newemp['next_of_kin'],
		'kin_address'=>$newemp['kin_address'],
		'kin_phonenum'=>$newemp['kin_phonenum']
		,'kin_relationship'=>$newemp['kin_relationship']
		/**,'linemanager_id'=>$newemp['linemanager_id']
		,'job_app_id'=>$newemp['job_app_id'] **/
		,'state_origin_id'=>$newemp['state_origin_id']
		,'lga'=>$newemp['lga']
		]);
		
		$uploadstate=$this->settings->createstate(['user_id'=>$createemp,'street'=>$newemp['street']
		,'city'=>$newemp['city']
		,'state_id'=>$newemp['state_id']]);
		
		
			}
			return response()->json('success',200);

		}

		catch(\Exception $ex){

		return response()->json("Error:$ex",404);
		
		}

	}
	//save leave
	public function saveleave(Request $request){
		
		try{
			
			$saveleave=\App\absencetype::create(['days'=>$request->daynum,'name'=>$request->title]);
			
			return response()->json("Success",200);
		}
		catch(\Exception $ex){
			\Log::error("Error:$ex");
			return response()->json("Error:$ex",404);
	
		}

	}
	
	//modify leave
	public function modifyleave(Request $request){
		
		try{
			
			$modify=\App\absencetype::where('id',$request->qtypeidl)
			->update(['days'=>$request->daynum,'name'=>$request->title]);
			return response()->json('success',200);
			
		}
		catch(\Exception $ex){
			
			\Log::error("Error:$ex");
			return response()->json("Error:$ex",404);
		}
		
		
	}
	
	//save query template handler
			public function savequery(Request $request){
				try{
				$savequery=\App\query_type::create(['title'=>$request->title,'template'=>$request->template]);
				return response()->json("success",200);
				}
				catch(\Exception $ex){
					
					return response()->json("Error:$ex",404);
				}
			}
	public function uploadjobcsv(Request $request){
		
		
		
		
	}
	
	//upload apptitude test question
	
	public function csvquesupload(Request $request){

	//validate input

	$this->validate($request,['file' => 'required']);


	//manage upload of csv question

	if($request->file('file')->getClientOriginalExtension() !='csv'){

		return response()->json("File Not allowed",404);

	  }

 

		try{

		

	        $reader = Reader::createFromPath($request->file('file')->getRealPath());

			$keys = ['question', 'option1','option2','option3','option4','answer'];



			$results = $reader->fetchAssoc($keys);

			foreach ($results as $newquestion) {

				$createandgetid=$this->settings->createquestion(['content'=>$newquestion['question']]);

		$optioncreate=$this->settings->createoption(['question_id'=>$createandgetid,
		'option1'=>$newquestion['option1'],
		'option2'=>$newquestion['option2'],
		'option3'=>$newquestion['option3'],
		'option4'=>$newquestion['option4'],
		'correctoption'=>$newquestion['answer']]);

		$correctoptioncreate=$this->settings->createcorrect(['question_id'=>$createandgetid,'correctoption'=>$newquestion['answer']]);

			}

		return response()->json("Question Uploaded Successfully",200);

			}

		catch(\PDOException $ex){

			\Log::error("Error:$ex");
			
		return response()->json("Error:Question Already Exist",404);

			

		}

	

}

	//save holiday
	public function saveholiday(Request $request){
		
		$datestart=$this->settings->processdate($request->holfrom);
		$dateend=$this->settings->processdate($request->holto);
			
			$saveholiday=$this->settings->saveholiday(['title'=>$request->holname,'start_date'=>$datestart,'end_date'=>$dateend]);
		
			return $saveholiday;
		
	}
	
	
	//save fiscal
	public function savefiscal(Request $request){
		  $savefiscal=$this->settings->savefiscal(['start_month'=>$request->startmont,
									'grace'=>$request->grace,'end_month'=>$request->endmonth]);
			return $savefiscal;	
	}
	
	//get fiscal
	public function getfiscal(){
		
		$getfiscal=\App\fiscal::first();
		return response()->json($getfiscal,200);
		
	}
	//upload job csv
 public function csvupload(Request $request){

	//validate input

	$this->validate($request,['file' => 'required']);

	if($request->file('file')->getClientOriginalExtension() !='csv'){

		return response()->json('Only Csv Allowed',404);
	  }

 

		try{
			
		$reader = Reader::createFromPath($request->file('file')->getRealPath());

		// 1 for jobs,2 for department
			if($request->type==1){
	       
			$keys = ['title', 'description'];



			$results = $reader->fetchAssoc($keys);

			foreach ($results as $newjob) {

				
		$createjob=$this->settings->uploadjob(['title'=>$newjob['title'],'description'=>$newjob['description'],'jobdep_id'=>$request->jobdepid]);
			}
		}
		else{
			
			if($request->type==2){
	       
			$keys = ['department'];



			$results = $reader->fetchAssoc($keys);

			foreach ($results as $newdep) {

				
		$createdep=$this->settings->uploaddep(['spec'=>$newdep['department']]);
			}
			
			
		}
		return response()->json('success',200);

			}
		}

		catch(\Exception $ex){

		return response()->json("Error:$ex",404);

			

		}

}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
