<?php

namespace App\Repositories;

use App\job;

use App\User;

use App\Goal;

use Auth;

use Mail;

use App\Mail\notifyemployee;
use App\Mail\NotifyMail;

use DB;

use App\Rating;

use App\Fiscal;

use App\Comment;

use App\absencetype;

use App\absencerequest;

use App\absencesetting;

use App\PublicHoliday;

class EmployeeRepository{
	
	
	public function setsession(){
		
			if(session()->has('FY') && session('FY') != "")
		{
			return $date = session('FY');
		}
	   return $date=date('Y');  
	    
	}
	//get job details
	public function getjobdetail($jobid){
		$getjobdetail=job::where('id',$jobid)->first();
		
		return $getjobdetail;
		
	}
	//get all work type
	public function worktype(){
		
		$jobtype=\App\work_type::select('id','work_type')->get();
		return $jobtype;
	}
	
	//gel all work spec
	public function workspec(){
		
		$workspec=\App\job_dep::select('spec','id')->get();
		return $workspec;
		
	}
	//all employess
	public function allemployee($type=0){
		
		if($type==1){
		$allemployee=\App\User::where('role',2)->paginate(10);
		return $allemployee;	
		}
		if(Auth::user()->role==2){
			
		$allemployee=\App\User::where('linemanager_id',\Auth::user()->id)->paginate(10)	;
		return $allemployee;
		}
		else{
				$allemployee=\App\User::where('linemanager_id','!=',0)->paginate(10);
		return $allemployee;
			
		}
		
		
		
	}
	//clock in
	public function clockin($type){
		
		try{
		//check exist
		if($type==0){
		$checkexist=\App\attendance::where('user_id',\Auth::user()->emp_num)->where('created_at','like','%'.date('Y-m-d').'%')->first();
		if($checkexist['user_id']!=""){
			$msg='You have already clocked in';
		}
		else{
			
		\App\attendance::create(['user_id'=>\Auth::user()->emp_num]);
		
		$msg='Clock In successfull';
		
		
		}
		}
		//clockout
		else{
			$checkexist=\App\attendance::where('user_id',\Auth::user()->emp_num)->where('created_at','like','%'.date('Y-m-d').'%')->first();
		if($checkexist['clockout_time']!=Null){
			$msg='You have already clocked out , Try Again Tomorrow';
		}
		else{
			
		\App\attendance::where('user_id',\Auth::user()->emp_num)
		   ->where('created_at',$checkexist['created_at'])
		   ->update(['clockout_time'=>date('Y-m-d H:i:s')]);
		
		$msg='Clock Out successful';
		
		
		}
			
		}
		return response()->json($msg,200);
	}
	catch(\Exception $ex){
		
		return response()->json("Error:$ex",404);
	}
		
	}
	
	public function manager($id){
		
		return \App\user::where('id',$id)->select('name')->first();
	}
	
	//set the query status to read on employee side
	public function setreadquery($qid){
		
		$querythreads=\App\query::where('id',$qid)->update(['empnew'=>0]);	
		return response()->json('success',200);
	}
	//get query thread
	public function querythread($qid,$type=0){
		
		try{
			if($type==0){
			if(Auth::user()->role>1){
		$querythreads=\App\query::where('id',$qid)->update(['lmnew'=>0]);	
			}
			else{
			$querythreads=\App\query::where('id',$qid)->update(['empnew'=>0]);	
			
			}
			}
			
		$querythread=\App\query_thread::where('query_id',$qid)->get();
		if($type==0){
		return response()->json($querythread,200);
		}
		else{
			return $querythread;
		}
		}
		catch(\Exception $ex){
			
			return response()->json("failure:$ex",404);
		}
	}
	
	public function savelisting(array $data,$type){
	try{
			if($type==1){
			$savelisting=\App\available_job::create($data);
			}
			else{
			$savelisting=\App\available_job::where('job_ref',$data['job_ref'])
			->update($data);
			}
			return response()->json('success',200);
			
			
			
		}
		catch(\Exception $ex){
			return response()->json("failure:$ex",404);
			
		} 
		
	}
	//approve or reject applicant
	public function appdisp(array $data){
		
		try{
		$decide=\App\user::where('id',$data['empid'])
						->update(['status'=>$data['decide']]);
		
		//send an email  
		
		
		return response()->json('success',200);
		}
		catch(\Exception $ex){
			
			return response()->json("Failled:$ex");
		}
	}
	
	//send mail to applicant individualy
	public function sendmail($id,$name,$email,$message){
		
		try{
		session(['appname'=>$name]);
		session(['appmessage'=>$message]);
		Mail::to($email)->send(new NotifyMail());
		
		return response()->json('success',200);
		
		}
		catch(\Exception $ex){
			
			return response()->json('Failure:'.$ex,404);
			
		}
		
	}
	//get applied for job applicants
	public function jobapp($jobid,$type=0,$startscore=0,$endscore=0){
			if($type===0){
		$jobapp=\App\user::where('job_app_id',$jobid)->paginate(10);
			}
			else{
				if($type=="s"){
					$jobapp=DB::table('users')
					->join('testscores','users.id','=','testscores.user_id')
					->whereBetween('testscores.score',[$startscore,$endscore])
					->where('users.job_app_id','=',$jobid)
					->paginate(10);
					if(count($jobapp)==0){
						$jobapp=\App\user::where('job_app_id',$jobid)->paginate(10);
		
					}
				}
				else{
				$convert=self::decodestatus($type);
				$jobapp=\App\user::where('status',$convert)->where('job_app_id','=',$jobid)->paginate(10);
				}
		
				
			}
		return $jobapp;
		
	}
	//decode status
	public function decodestatus($jobid){
		
		if($jobid=='p'){
			
			return "0";
		}
		
		if($jobid=='a'){
			
			return "1";
		}
		if($jobid=='r'){
			
			return "2";
		}
		
	}
	//getjob app for
	public function getappdetail($jobid){
	
		$jobit=\App\available_job::select('title')->where('id',$jobid)->first();
		return $jobit['title'];
		
	}
	
	//get job
	public function alljob(){
		$date=self::setsession();
		$alljob=\App\available_job::where('updated_at','like',$date.'%')->orderBy('id','desc')->paginate(5);
		return $alljob;
		
	}
	
	//get applicant document
	public function getdoc($id){
		
		$alldoc=DB::table('document_types')
				->join('documents', 'documents.type_id','=','document_types.id')
				->where('documents.user_id',$id)
				->get();
				return $alldoc;
	}
	//get all staate 
	public function allstate(){
		
		$allstate=\App\state::select('state','id')->get();
		return $allstate;	
		
	}
	
	//all levels
	public function allevel(){
		
		$allevel=\App\job_level::select('level','id')->get();
		return $allevel;
	}
	
	
	//show leave catch
	public function leavecat($type){
		if($type=='all'){
		$allcat=\App\absencetype::all();
		}
		else{
			$allcat=\App\absencetype::where('id',$type)->select('name')->first();
			$allcat=$allcat['name'];
		}
		return $allcat;
	}
	
	//approve/reject leave
	public function approvereject(array $data,$id,$email){
		
		try{
			$name=explode('@',$email);
			
			$approvereject=\App\absencerequest::where('id',$id)
					->update($data);
					
			//get absence request type id for getting absenc e name to be included in the mail being sent		
			$getabesnceid=\App\absencerequest::where('id',$id)->select('absencetypes_id')->first();
			
			$getabsencename=\App\absencetype::where('id',$getabesnceid['absencetypes_id'])
											  ->select('name')->first();		
			//send email here 
			if(\Auth::user()->role==2){
			if($data['lm_approve']==1){
				session(['notmessage'=>"Your ".$getabsencename['name']." Leave Request have beeen approved by your Line Manager for the following reason :".$data['lm_comments']]);
				session(['reciever'=>$name[0]]);
			}
		else{
			
				session(['notmessage'=>"Your".$getabsencename['name']."Leave Request have beeen rejected by your Line Manager for the following reason :".$data['lm_comments']]);
				session(['reciever'=>$name[0]]);
		}
			}
			else{
				
			if($data['admin_approve']==1){
				
				session(['notmessage'=>'Your Leave Request have been approved by The AdminHr for the following reason :'.$data['admin_comments']]);
				session(['reciever'=>$name[0]]);
			}
			else{
			
				session(['notmessage'=>'Your Leave Request have beeen rejected by the AdminHr for the following reason :'.$data['admin_comments']]);
				session(['reciever'=>$name[0]]);
		}	
	}
	
	
	
          Mail::to($email)->send(new notifyemployee());
		//$email
//email			
			return response()->json('success',200);
		}
		catch(\Exception $ex){
			
			return response()->json('Error'.$ex,404);
		}
	}
	
	public function reformatdate($date){
	
	$dateref=explode('-',$date);
	return date('Y').'-'.$dateref[1].'-'.$dateref[2];
    }
	
	//get leave dates calender
	public function getleave($lmid,$type=0){
		
		
		
		
		$date=self::setsession();
		
		if($type==1){
			
			$emps=\App\public_holiday::all();
					foreach($emps as $emphols):
					
					$holsdate[]=['title'=>$emphols->title,'start'=>self::reformatdate($emphols->start_date),'end'=>self::reformatdate($emphols->end_date)];
					endforeach;
				return response()->json($holsdate);
		}
		
		$emps=DB::table('users')
						->join('absencerequests','users.id','=','absencerequests.emp_id')
						->select('users.id','users.name','absencerequests.startdate','absencerequests.enddate',
						'absencerequests.priority','absencerequests.status')
						->where('users.linemanager_id','=',\Auth::user()->id)
						->where('absencerequests.status','!=',2)
						->where('absencerequests.created_at','like',$date.'%')
						->get();
	
			foreach($emps as $empleave):
			
			$leavedate[]=['title'=>"$empleave->name( ".self::getstatus($empleave->status)." )",'start'=>$empleave->startdate,'className'=>self::getclass($empleave->priority)];
			
			endforeach;
			return response()->json($leavedate);
		
		
		
	}
	//getcounts
	
	public function getcount(){
		
		$date=self::setsession();
		$requests=DB::table('users')
						->join('absencerequests','users.id','=','absencerequests.emp_id')
						->select('users.id','users.name','absencerequests.startdate','absencerequests.enddate',
						'absencerequests.priority','absencerequests.status')
						->where('users.linemanager_id','=',\Auth::user()->id)
						->where('absencerequests.created_at','like',$date.'%')
						->count('absencerequests.id');
						
		$leavetype=\App\absencetype::count('id');
		
		$countleave=\App\User::where('linemanager_id',\Auth::user()->id)->count('id');
		$allleaves=DB::table('absencetypes')
					->select(DB::raw('SUM(days) as days'))->get();
		$publichols=\App\public_holiday::all();
		//calc date diff
		       $interval3='';
				foreach($publichols as $hols){	

					$startdate = new \DateTime($hols->start_date);
					$enddate = new \DateTime($hols->end_date);
					$interval = $startdate->diff($enddate);
					$interval2 = $interval->format('%a');
					$interval3 +=(int) $interval2;
				}
			//return $interval3;	
		//session(['tt'=>$allleaves]);
		foreach($allleaves as $crazy):
		$allleaves=$crazy->days;
		endforeach;
		
		$allleave=$countleave * $allleaves;
		
	    return ['request'=>$requests,'leavetype'=>$leavetype,'totalleave'=>$allleave,'holscount'=>$interval3];
		
		
	}
	
	//get querylist
	public function querytypes($id=0){
		
		if($id==0){
		$querylist=\App\query_type::all();
		}
		else{
			$querylist=\App\query_type::where('id',$id)->first();
		}
		return $querylist;
		
	}
	//search reset
	public function searchemp($searchstring){
		
		if(\Auth::user()->role==2){
		$dispres=\App\User::where('name','like',"%$searchstring%")
		->where('linemanager_id',\Auth::user()->id)->paginate(10);
		}
		else{
			$dispres=\App\User::where('name','like',"%$searchstring%")->where('linemanager_id','!=',0)->paginate(10);
		}
		return $dispres;
		
	}
	
	public function replyquery(array $data){
		try{
			if(\Auth::user()->role>1){
			$setnew=\App\query::where('id',$data['query_id'])->update(['empnew'=>1]);
			}
			else{
				
			$setnew=\App\query::where('id',$data['query_id'])->update(['lmnew'=>1]);
			}
		$addqcomment=\App\query_thread::create($data);
		return response()->json('success',200);
		}
		catch(\Exception $ex){
			return response()->json("failure:$ex",404);
		}
	}
	
	public function getuserdetails($id){
		
		$userdetails=\App\User::where('id',$id)->first();
		return $userdetails;
	}
	public function allqueries($id=909090){
		
		$date=self::setsession();
		if($id==909090){
			if(\Auth::user()->role==2){
				
		$allqueries=DB::table('queries')
		->join('users','users.id','=','queries.user_id')
		->select('users.name','users.id','users.email','users.image','queries.*')
		->where('users.linemanager_id',\Auth::user()->id)
		->orderBy('queries.created_at','desc')
		->where('queries.created_at','like',"%$date%")
		->paginate(50);
			}
			else{
			$allqueries=DB::table('queries')
		->join('users','users.id','=','queries.user_id')
		->select('users.name','users.id','users.email','users.image','queries.*')
		//->where('queries.lm_id',\Auth::user()->id)
		->orderBy('queries.created_at','desc')
		->where('queries.created_at','like',"%$date%")
		->paginate(50);	
				
			}
		}
		else{
			
			if(\Auth::user()->role==2){
		$allqueries=DB::table('queries')
		->join('users','users.id','=','queries.user_id')
		->select('users.name','users.id','users.email','users.image','queries.*')
		->where('users.linemanager_id',\Auth::user()->id)
		->where('queries.query_type_id',$id)
		->orderBy('queries.created_at','desc')
		->where('queries.created_at','like',"%$date%")
		->paginate(50);	
			}
			else{
				$allqueries=DB::table('queries')
		->join('users','users.id','=','queries.user_id')
		->select('users.name','users.id','users.email','users.image','queries.*')
		//->where('users.linemanager_id',\Auth::user()->id)
		->where('queries.query_type_id',$id)
		->orderBy('queries.created_at','desc')
		->where('queries.created_at','like',"%$date%")
		->paginate(50);		
				
			}
		}
		return $allqueries;
			
	}
	
	//view query
	public function myquery(){
		$date=self::setsession();
		$myquery=\App\query::where('user_id',\Auth::user()->id)
		->where('created_at','like',"%$date%")
		->orderBy('id','desc')
		->get();
		return $myquery;
	}
	
	//issue query
	
	public function issuequery(array $data){
		
		try{
		$issuequery=\App\query::create($data);
		return response()->json('success',200);
		}
		catch(\Exception $ex){
			
			return response()->json("Failure:$ex");
		}
	}
	
	//leave stat
	public function leavestat(){

		$date=self::setsession();
		
	$gettype=\App\absencetype::all();
			if(\Auth::user()->role==3){
					$oprand=">";
					$lmid=0;
					
				}
					
				else{
					
					$oprand="=";
					$lmid=\Auth::user()->id;
				}
				
			foreach($gettype as $types){
		$getcount=DB::table('users')
				->join('absencerequests','absencerequests.emp_id','=','users.id')
				->where('users.linemanager_id',$oprand,$lmid)
				->where('absencerequests.created_at','like',$date.'%')
				->where('absencerequests.absencetypes_id',$types->id)
				->count('users.id');
		
		
		$finaldata[]=['x'=>$types->name,'y'=>$getcount];
				
			}
			return $finaldata;
		
	}
	//set priority 
	public function getclass($priority){
		
		if($priority==0){
			return "alert alert-success";
		}
		if($priority==1){
			return "alert alert-warning";
		}
		if($priority==2){
			return "alert alert-danger";
		}
		
	}
	
	public function getstatus($status){
		
		if($status==0){
			return "Pending";
		}
		if($status==1){
			return "Approved";
		}
		if($status==2){
			return "Rejected";
		}
		
	}
	
	//line manager by deji
	public function lmemployee($id, $chunk,$type=0)
	{
		if(\Auth::user()->role==3){
					$oprand=">";
					$lmid=0;
					
				}
					
				else{
					
					$oprand="=";
					$lmid=\Auth::user()->id;
				}
				
				
		$emps;
		try {
			$date=self::setsession();
			
		
				
			if(is_numeric($chunk)){
				
				if($chunk==5){
						$emps=DB::table('users')
						->join('absencerequests','users.id','=','absencerequests.emp_id')
						->select('users.id','users.email','users.name','users.job_id','users.sex','users.image','users.emp_num','absencerequests.absencetypes_id','absencerequests.*')
						->where('users.linemanager_id','=',\Auth::user()->id)
						->where('absencerequests.created_at','like',$date.'%')
						->distinct()
						->paginate(10);
				}
				
			else{
				if($chunk>=3){
					if($chunk==3){
						$chunk=1;
					}
					else{
						$chunk=2;
					}
					
					$emps=DB::table('users')
						->join('absencerequests','users.id','=','absencerequests.emp_id')
						->select('users.id','users.email','users.name','users.job_id','users.sex','users.image','users.emp_num','absencerequests.absencetypes_id','absencerequests.*')
						->where('absencerequests.status','=',$chunk)
						
						->where('users.linemanager_id','=',\Auth::user()->id)
						->where('absencerequests.created_at','like',$date.'%')
						->distinct()
						->paginate(10);	
				}
				else{
			$emps=DB::table('users')
						->join('absencerequests','users.id','=','absencerequests.emp_id')
						->select('users.id','users.email','users.name','users.job_id','users.sex','users.image','users.emp_num','absencerequests.absencetypes_id','absencerequests.*')
						->where('absencerequests.priority','=',$chunk)
						
						->where('users.linemanager_id','=',\Auth::user()->id)
						->where('absencerequests.created_at','like',$date.'%')
						->distinct()
						->paginate(10);	
				}
				}
			}		
			
			elseif($chunk=='leave'){
					
				
				$emps=DB::table('users')
						->join('absencerequests','users.id','=','absencerequests.emp_id')
						->select('users.id','users.email','users.name','users.job_id','users.sex','users.image','users.emp_num','absencerequests.absencetypes_id','absencerequests.*')
						->where('users.linemanager_id',$oprand,$lmid)
						->where('absencerequests.created_at','like',$date.'%')
						->distinct()
						->paginate(10);
			}
			elseif($chunk=='search'){
				
					$emps=DB::table('users')
						->join('absencerequests','users.id','=','absencerequests.emp_id')
						->select('users.id','users.email','users.name','users.job_id','users.sex','users.image','users.emp_num','absencerequests.absencetypes_id','absencerequests.*')
						->where('users.linemanager_id',$oprand,$lmid)
						->where('users.name','like', '%'.$type.'%')
						->where('absencerequests.created_at','like',$date.'%')
						->distinct()
						->paginate(10);
				
			
				
			}
			elseif($chunk=='type'){
				$emps=DB::table('users')
						->join('absencerequests','users.id','=','absencerequests.emp_id')
						->select('users.id','users.email','users.name','users.job_id','users.sex','users.image','users.emp_num','absencerequests.absencetypes_id','absencerequests.*')
						->where('users.linemanager_id',$oprand,$lmid)
						->where('absencerequests.absencetypes_id','=',$type)
						->where('absencerequests.created_at','like',$date.'%')
						->distinct()
						->paginate(10);
			}
				
			
			elseif($chunk=='all')
			{
				
				$emps = User::where('linemanager_id', $id)->paginate(10);
			}
			else
			{
				$emps = User::where('linemanager_id', $id)->paginate(10);
			}
		
		} catch(\Exception $ex) {
			return $ex;
		}
		return $emps;
	}
	public function getemployee($id)
	{
		
		try {
			$employee = User::where('id', $id)->first();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $employee;
	}
	
	public function getGoal($eid, $goalcat)
	{
		$goals;
		if(session()->has('FY') && session('FY') != "")
		{
			$date = session('FY');
		}
		else {  $date=date('Y');   } 
		try {
			if($eid=='pilot')
			{
				$goals = Goal::where('goal_cat', $goalcat)->where('created_at','like',$date.'%')->get();
			}
			else
			{
				$goals = Goal::where('emp_id', $eid)->where('goal_cat', $goalcat)->where('created_at','like',$date.'%')->get();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $goals;
	}

	public function getGoalTo($lmid, $empid, $goalcat)
	{
		$goals;
		$date=self::setsession();
		try {
			if($lmid==0 && $empid==0)
			{
				$goals = Goal::where('goal_cat', $goalcat)->where('created_at','like',$date.'%')->get();
			}
			else
			{
				$goals = Goal::where('emp_id', $lmid)->where('assigned_to', $empid)->where('goal_cat', $goalcat)->where('created_at','like',$date.'%')->get();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $goals;
	}

	public function getCommentd($id, $goalid)
	{
		$comments;
		$date=self::setsession();
		try {
			$comments = Comment::where('goal_id', $goalid)->where('user_id', $id)->where('created_at','like',$date.'%')->first();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $comments;
	}

	public function fiscalYear()
	{
		$fiscal;
		try {
			$fiscal = Fiscal::first();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $fiscal;
	}

	public function updateLMComments($goalid, $empid, $comments)
	{
		$update;
		$date=self::setsession();
		try {
			$update = Comment::where('goal_id', $goalid)->where('user_id', $empid)->update(['lm_comment'=>$comments]);
			if($update == 0)
			{
				$update = Comment::create([
					'lm_comment' 	=> $comments,
					'emp_comment' 	=> NULL,
					'goal_id' 		=> $goalid,
					'user_id' 		=> $empid
					]);
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $update;
	}

	public function setGoal(array $data)
	{
		$goal;
		try {
			$goal = Goal::firstOrCreate($data);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $goal;
	}

	public function getRating($id, $goalid)
	{
		$rating;
		$date=self::setsession();
		try {
			$rating = Rating::where('emp_id', $id)->where('goal_id', $goalid)->where('created_at','like',$date.'%')->first();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $rating;
	}

	public function setRating($goalid, $empid, $score, $comment)
	{
		$rate;
		$date=self::setsession();
		try {
			$rate = Rating::where('emp_id', $empid)->where('goal_id', $goalid)->where('created_at','like',$date.'%')->first();
			if(count($rate) > 0)
			{
				$rate = Rating::where('emp_id', $empid)->where('goal_id', $goalid)
				->update([
					'lm_rate' 		=> $score,
					'lm_id'			=> Auth::user()->id,
					'lm_comment'	=> $comment
					]);
			}
			else
			{
				$data = array(
					'emp_id'		=> $empid,
					'goal_id'		=> $goalid,
					'lm_rate'		=> $score,
					'lm_id'			=> Auth::user()->id,
					'lm_comment'	=> $comment,
					'admin_id'		=> NULL,
					'admin_rate'	=> 0,
					'admin_comment'	=> NULL
					);
				$rate = Rating::firstOrCreate($data);
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $rate;
	}

	public function totalPilot()
	{
		$total;$date;
		$date=self::setsession();
		try {
			$total = Goal::where('goal_cat', 2)->where('created_at','like',$date.'%')->count();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $total;
	}

	//get general
	
	public function lmgoal($type){
		if(session()->has('FY') && session('FY')!=""){
			$date=session('FY');
		}
		else{
			$date=date('Y');
		}
		if($type==3){
			$displaylmgoal=\App\goal::where('goal_cat',$type)->where('created_at','like',$date.'%')
			->where('emp_id',\Auth::user()->id)->get();
		}
	//added line manager
		elseif($type==1){
			$displaylmgoal=\App\goal::where('goal_cat',$type)
			->where('assigned_to',\Auth::user()->id)
			->where('created_at','like',$date.'%')->get();

		}
		elseif($type==0){
			$displaylmgoal=\App\goal::where('goal_cat',2)
			->where('created_at','like',$date.'%')->get();

		}
		else{
			$displaylmgoal=\App\goal::where('goal_cat',$type)
			->where('created_at','like',$date.'%')->get();
		}
		return $displaylmgoal;
	}
	//jobspec get
	public function jobspec(){
		
		$alldep=\App\job_dep::all();
		return $alldep;
	
	
	}
	
	public function getcomment($id,$type){
		if($type!='emp_comment'){
		$comment=\App\comment::where('goal_id',$id)->where('user_id',$type)->select('lm_comment','emp_comment')->first();
		return $comment;	
		}
		$comment=\App\comment::where('goal_id',$id)->where('user_id',\Auth::user()->id)->select($type)->first();
		return $comment;
		
	} 
	
	
	public function addcomment(array $data){
		
		$addcomment=\App\comment::create($data);
		return 'success';
	}
	
	//show statistics
	public function showstatistics($id){
		if(session()->has('FY') && session('FY')){

			$date=session('FY');
		}
		else{
			$date=date('Y');
		}

		
		$ratingtable= \DB::table('ratings')
		->join('goals','ratings.goal_id','=','goals.id')
		->where('goals.goal_cat',2)
		->where('ratings.created_at','like',$date.'%')
		->where('ratings.emp_id',$id)
		->get();
		
		foreach($ratingtable as $rate){
			$objective=explode(' ',$rate->objective);
			$aggr[]=['y'=>strtoupper($objective[0]),'a'=>$rate->lm_rate,'b'=>$rate->admin_rate];
		}						

		return $aggr;	

	}
	
	public function creategoal(array $data){
		try{
			$creategoal=\App\goal::create($data);
			return response()->json('success',200);	
		}
		catch(\Exception $ex){
			
			return response()->json($ex,404);
		}
	}
	
	public static function getrate($goalid){
		if(session()->has('FY') && session('FY')){

			$date=session('FY');
		}
		else{
			$date=date('Y');
		}
		$rating=\App\rating::where('goal_id',$goalid)
		->where('emp_id',Auth::user()->id)
		->where('created_at','like',$date.'%')
		->first();

		return $rating;	
	}

	public function lmcategory($filter, $type, $id)
	{
		$category;
		$date=self::setsession();
		try {
			if($filter=='sex')
			{
				if($type=='a')
				{
					$category = User::where('linemanager_id', $id)->get();
				}
				else
				{
					$category = User::where('linemanager_id', $id)->where('sex', $type)->get();
				}
			}
			else 
			{
				if($type=='a')
				{
					$category = User::where('linemanager_id', $id)->get();
				}
				else
				{
					$category = User::where('linemanager_id', $id)->where('created_at','like',$date.'%')->get();
				}
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $category;
	}
	
	/**
	 *Start of Code For Absenge Mgt.
	 *
	 */

	public function getHolidays()
	{
		$holidays;
		if(session()->has('FY') && session('FY') != "")
		{
			$date = session('FY');
		}
		try {
			$holidays = PublicHoliday::all();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $holidays;
	}
	
	public function getLeaveDue($role)
	{
		$leaves;
		try{
			$leaves = absencetype::where('cat', 0)->orWhere('cat', $role)->get();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $leaves;
	}

	public function getLeaveRequest($empid)
	{
		$leaves;
		if(session()->has('FY') && session('FY') != "")
		{
			$date = session('FY');
		}
		try {
			$leaves = absencerequest::where('emp_id', $empid)->where('created_at','like','%'.$date.'%')->get();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $leaves;
	}

	public function totalLeaveFiscal($role)
	{
		$total;
		$date=self::setsession();
		try {
			$total = absencesetting::where('role', $role)->where('created_at','like','%'.$date.'%')->first();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $total;
	}

	public function submitRequest(array $data)
	{
		$submit;
		try {
			$submit = absencerequest::firstOrCreate($data);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $submit;
	}

	public function modifyRequest($startdate, $enddate, $id)
	{
		$modify;
		try {
			$modify = absencerequest::where('id', $id)->update([
				'startdate' => $startdate,
				'enddate' 	=> $enddate
			]);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $modify;
	}

	public function dropRequest($id)
	{
		$drop;
		try {
			$drop = absencerequest::where('id', $id)->delete();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $drop;
	}

	public function deleteGoal($id)
	{
		$delete;
		try {
			$delete = Goal::where('id', $id)->delete();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $delete;
	}
	
	//display all questions
	public function allquestions(){

		$questions=DB::table('questions')

		->join('options','questions.id','=','options.question_id')

		->join('corrects','questions.id','=','corrects.question_id')

		->select('questions.*','options.*','corrects.*')

		->orderBy('questions.id','asc')

        //->take(5)

        ->paginate(10);

		return $questions;

	}
	
	//get emp score
	public function getscore($id,$jobappid){
		
		$empid=\App\testscore::where('user_id',$id)->where('job_app_id',$jobappid)->select('score')->get();
		
		if(count($empid)>0)
		{
			return $empid['score'];

			
		}	
		return "0";
			
	}

	public function updateGoal($id, $obj, $comm)
	{
		$update;
		try {
			$update = Goal::where('id', $id)->update([
				'commitment' => $comm,
				'objective'  => $obj
			]);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $update;
	}

	public function getAbsenceType($id)
	{
		$absence;
		try {
			$absence = absencetype::where('id', $id)->first();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $absence;
	}
	
	public function getOrganogramData($id)
	{
		$dataSource;
		try {
			
			$getdetail=\DB::table('users')
			->select('users.id as id','users.name as name', 'jobs.title as title' ,'users.linemanager_id as relationship')
			->leftJoin('jobs', 'users.job_id', '=', 'jobs.id')
			->where('users.id', $id)
			->first();
			
			
			$dataSource = \DB::table('users')
			->select('users.id as id','users.name as name', 'jobs.title as title' ,'users.linemanager_id as relationship')
			->leftJoin('jobs', 'users.job_id', '=', 'jobs.id')
			->where('users.linemanager_id', $id)
			->get();
			
			
			foreach($dataSource as $source){
				
			$dataSources[]=['id'=>"$source->id",'name'=>"$source->name",'title'=>"$source->title",'relationship'=>"$source->relationship"];	
			}
			
			
			$dataSources=['id'=>$id,'name'=>$getdetail->name,'title'=>$getdetail->title,'relationship'=>"$getdetail->relationship",'children'=>$dataSources];
				return $dataSources;
				
		} catch(\Exception $ex) {
			return $ex;
		}
		
	
		
	}
	
}

