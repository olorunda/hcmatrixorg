<?php

namespace App\Repositories;

use DB;

use Auth;

use Mail;

use App\job;

use App\User;

use App\Goal;

use App\Skill;

use App\State;

use App\JobDep;

use App\Rating;

use App\School;

use App\Fiscal;

use App\Subject;

use App\Comment;

use App\Contact;

use App\Country;

use App\Document;

use App\WorkType;

use App\JobLevel;

use App\JobSkill;

use App\Reference;

use App\EmpHistory;

use App\TrainingAtt;

use App\absencetype;

use App\ProfHistory;

use App\Institution;

use App\AvailableJob;

use App\DocumentType;

use App\JobSkillComp;

use App\SubjectTaken;

use App\SubjectGrade;

use App\JobAppliedFor;

use App\absencerequest;

use App\absencesetting;

use App\PublicHoliday;

use App\Mail\notifyemployee;

use App\Repositories\Interfaces\JobInterface;

class JobRepository implements JobInterface
{	
	public function getLocations($id)
	{
		$states;
		try {
			if($id == 'all')
			{
				$states = State::all();	
			}
			else
			{
				$states = State::where('id', $id)->first();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $states;
	}

	public function getCountries($id)
	{
		$countries;
		try {
			if($id == 'all')
			{
				$countries = Country::all();
			}
			else
			{
				$countries = Country::where('id', $id)->first();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $countries;
	}

	public function getJobs($cat)
	{
		$jobs;
		try {
			if($cat == 'all')
			{
				$jobs = AvailableJob::paginate(5);
			}
			else
			{
				if(is_array($cat))
				{

				}
				else
				{
					$jobs = AvailableJob::where('id', $cat)->first();
				}
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $jobs;
	}

	public function getDepartment($id)
	{
		$dept;
		try {
			if($id == 'all')
			{
				$dept = JobDep::all();
			}
			else
			{
				$dept = JobDep::where('id', $id)->first();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $dept;
	}

	public function getLevel($id)
	{
		$level;
		try {
			if($id == 'all')
			{
				$level = JobLevel::all();
			}
			else
			{
				$level = JobLevel::where('id', $id)->first();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $level;
	}

	public function getLocation($id)
	{
		$location;
		try {
			if($id == 'all')
			{
				$location = State::all();
			}
			else
			{
				$location = State::where('id', $id)->first();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $location;
	}

	public function getJobType($id)
	{
		$jobType;
		try {
			if($id == 'all')
			{
				$jobType = WorkType::all();
			}
			else
			{
				$jobType = WorkType::where('id', $id)->first();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $jobType;
	}

	public function registration(array $data, $stage)
	{
		$retVal;
		switch($stage)
		{
			case 1:
			try {
				$retVal = User::firstOrCreate($data);
				session(['stage2'=>2]);
			} catch(\Exception $ex) {
				return $ex;
			}
			break;
		}
		return $retVal;
	}

	public function updateReg(array $data)
	{
		$retVal;
		try {
			$retVal = User::where('id', $data['id'])->update([
				'sex'				=>  $data['sex'],
				'marital_status'	=> 	$data['marital_status'],
				'dob'				=> 	$data['dob'],
				'age'				=> 	$data['age'],
				'phone_num'			=> 	$data['phone_num'],
				'state_origin_id'	=> 	$data['state_origin_id'],
				'lga'				=> 	$data['lga'],
				]);
			session(['stage3'=>3]);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $retVal;
	}

	
	public function getappliedjobs(){
		
	 $getapplied=\DB::table('job_applied_fors')
				->join('available_jobs','available_jobs.id','=','job_applied_fors.job_id')
				->select('available_jobs.*','job_applied_fors.created_at as appdate')
				->where('job_applied_fors.user_id',\Auth::user()->id)
				->orderBy('job_applied_fors.created_at','desc')
				->paginate(10);
				
	  return $getapplied;
		
		
	}
	
	public function correspondence(array $data, $opcode)
	{
		$correspondence;
		try {
			if($opcode == 1)
			{
				$correspondence = Contact::firstOrCreate($data);
			}
			else
			{
				$correspondence = Contact::where('user_id', Auth::user()->id)->update($data);
			}
			
			session(['stage4'=>4]);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $correspondence;
	}

	public function educationSecondary(array $data, $opcode, $id = null)
	{
		$educationSecondary;
		try {
			if($opcode == 1)
			{
				$educationSecondary = School::firstOrCreate($data);
			}
			else
			{
				$educationSecondary = School::where('id', $id)->update($data);
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $educationSecondary;
	}

	public function results(array $data, $opcode, $id, $selected = null)
	{
		$results;
		try {
			if($opcode == 1)
			{
				//read
				if($id == 'all')
				{
					$results = SubjectTaken::all();
				}
				else
				{
					$results = SubjectTaken::where('user_id', $id)->get();
				}
			}
			elseif($opcode == 2)
			{
				$results = SubjectTaken::where('user_id', $id)->where('exam_id', $selected)->update($data);
			}
			elseif($opcode == 3)
			{
				//special
				$results = SubjectTaken::where('user_id', $id)->where('exam_id', $selected)->get();
			}
			elseif($opcode == 4)
			{
				//write
				$results = SubjectTaken::firstOrCreate($data);
			}
			elseif($opcode == 33)
			{
				//another special
				$results = DB::table('subject_takens')->select('exam_id')->where('user_id', $id)->distinct('exam_id')->get();
			}
			else
			{
				$results = SubjectTaken::where('user_id', $id)->where('exam_id', $data['exam_id'])->update($data);
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $results;
	}

	public function educationInstitution(array $data, $opcode, $id = null)
	{
		$educationInstitution;
		try {
			if($opcode == 1)
			{
				$educationInstitution = Institution::firstOrCreate($data);
			}
			else
			{
				$educationInstitution = Institution::where('id', $id)->update($data);
			}
			session(['stage4'=>4]);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $educationInstitution;
	}

	public function employementHistory(array $data, $opcode, $id = null)
	{
		$employementHistory;
		try {
			if($opcode == 1)
			{
				$employementHistory = EmpHistory::firstOrCreate($data);
			}
			else
			{
				$employementHistory = EmpHistory::where('id', $id)->update($data);
			}
			session(['stage5'=>5]);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $employementHistory;
	}

	public function professionalhistory(array $data, $opcode, $id = null)
	{
		$professionalhistory;
		try {
			if($opcode == 1)
			{
				$professionalhistory = ProfHistory::firstOrCreate($data);
			}
			else
			{
				$professionalhistory = ProfHistory::where('id', $id)->update($data);
			}
			session(['stage6'=>6]);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $professionalhistory;
	}

	public function applicantSkills(array $data, $opcode, $id = null)
	{
		$applicantSkills;
		try {
			if($opcode == 1)
			{
				$applicantSkills = Skill::firstOrCreate($data);
			}
			else
			{
				$applicantSkills = Skill::where('id', $id)->update($data);
			}
			session(['stage7'=>7]);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $applicantSkills;
	}

	public function applicantTraining(array $data, $opcode, $id = null)
	{
		$applicantTraining;
		try {
			if($opcode == 1)
			{
				$applicantTraining = TrainingAtt::firstOrCreate($data);
			}
			else
			{
				$applicantTraining = TrainingAtt::where('id', $id)->update($data);
			}
			session(['stage7'=>7]);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $applicantTraining;
	}

	public function applicantReferences(array $data, $opcode, $id = null)
	{
		$applicantReferences;
		try {
			if($opcode == 1)
			{
				$applicantReferences = Reference::firstOrCreate($data);
			}
			else
			{
				$applicantReferences = Reference::where('id', $id)->update($data);
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $applicantReferences;
	}

	public function jobAppFor(array $data)
	{
		$applied;
		try {
			$applied = JobAppliedFor::where('user_id', $data['user_id'])->where('job_id', $data['job_id'])->first();
			if(count($applied) > 0)
			{
				$applied = 'applied';
			}
			else
			{
				$applied = JobAppliedFor::create($data);
			}
			
		} catch(\Exception $ex) {
			return $ex;
		}
		return $applied;
	}

	public function getDocumentTypes($id)
	{
		$documents;
		try {
			if($id == 'all')
			{
				$documents = DocumentType::all();
			}
			else
			{
				$documents = DocumentType::where('id', $id)->first();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $documents;
	}

	public function getJobSkills($id)
	{
		$skills;
		try {
			if($id == 'all')
			{
				$skills = JobSkill::all();
			}
			else
			{
				$skills = JobSkill::where('id', $id)->first();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $skills;
	}

	public function getJobSkillCompetence($id)
	{
		$comptencies;
		try {
			if($id == 'all')
			{
				$comptencies = JobSkillComp::all();
			}
			else
			{
				$comptencies = JobSkillComp::where('id', id);
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $comptencies;
	}

	public function getBio($id)
	{
		$bio;
		try {
			if($id == 'all')
			{
				$bio = User::all();
			}
			else
			{
				$bio = User::where('id', $id)->first();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $bio;
	}

	public function getCorrespondence($id)
	{
		$corrs;
		try {
			if($id == 'all')
			{
				$corrs = Contact::all();
			}
			else
			{
				$corrs = Contact::where('user_id', $id)->first();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return  $corrs;
	}

	public function getSecEducation($id)
	{
		$secs;
		try {
			if($id == 'all')
			{
				$secs = School::all();
			}
			else
			{
				$secs = School::where('user_id', $id)->get();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $secs;
	}

	public function getHigherEducation($id)
	{
		$highers;
		try {
			if($id == 'all')
			{
				$highers = Institution::all();
			}
			else
			{
				$highers = Institution::where('user_id', $id)->get();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $highers;
	}

	public function getEmployment($id)
	{
		$emps;
		try {
			if($id == 'all')
			{
				$emps = EmpHistory::all();
			}
			else
			{
				$emps = EmpHistory::where('user_id', $id)->get();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $emps;
	}

	public function getProfessionalHistory($id)
	{
		$profs;
		try {
			if($id == 'all')
			{
				$profs = ProfHistory::all();
			}
			else
			{
				$profs = ProfHistory::where('user_id', $id)->get();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $profs;
	}

	public function getSkill($id)
	{
		$skiils;
		try {
			if($id == 'all')
			{
				$skills = Skill::all();
			}
			else
			{
				$skills = Skill::where('user_id', $id)->get();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $skills;
	}

	public function getTraining($id)
	{
		$trainings;
		try {
			if($id == 'all')
			{
				$trainings = TrainingAtt::all();
			}
			else
			{
				$trainings = TrainingAtt::where('user_id', $id)->get();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $trainings;
	}

	public function getReference($id)
	{
		$refs;
		try {
			if($id == 'all')
			{
				$refs = Reference::all();
			}
			else
			{
				$refs = Reference::where('user_id', $id)->get();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $refs;
	}

	public function subjects(array $data, $opcode, $id)
	{
		$subjects;
		try {
			if($opcode == 1)
			{
				//read
				if($id == 'all')
				{
					$subjects = Subject::all();
				}
				else
				{
					$subjects = Subject::where('id', $id)->get();
				}
			}
			else
			{
				//write
				$subjects = Subject::firstOrCreate($data);
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $subjects;
	}

	public function grades(array $data, $opcode, $id)
	{
		$grades;
		try {
			if($opcode == 1)
			{
				//read
				if($id == 'all')
				{
					$grades = SubjectGrade::all();
				}
				else
				{
					$grades = SubjectGrade::where('id', $id)->get();
				}
			}
			else
			{
				//write
				$grades = SubjectGrade::firstOrCreate($data);
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $grades;
	}

	public function additionalInfo(array $data, $opcode, $id)
	{
		$additionalInfo = null;
		try {
			if($opcode == 1)
			{
				//read
				if($id == 'all')
				{
					$additionalInfo = Document::all();
				}
				else
				{
					$additionalInfo = Document::where('user_id', $id)->get();
				}
			}
			else
			{
				$additionalInfo = Document::firstOrCreate($data);
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $additionalInfo;
	}

	public function destroyDoc($id)
	{
		$destroyDoc;
		try {
			$destroyDoc = Document::where('id', $id)->delete();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $destroyDoc;
	}

	public function destroySec($id)
	{
		$destroySec;
		try {
			$destroySec = School::where('id', $id)->delete();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $destroySec;
	}

	public function destroy($id, $type)
	{
		$destroy;
		try {
			if($type == 4)
			{
				$destroy = School::where('id', $id)->delete();
			}
			elseif($type == 5)
			{
				$destroy = Institution::where('id', $id)->delete();
			}
			elseif($type == 6)
			{
				$destroy = EmpHistory::where('id', $id)->delete();
			}
			elseif($type == 7)
			{
				$destroy = ProfHistory::where('id', $id)->delete();
			}
			elseif($type == 8)
			{
				$destroy = Skill::where('id', $id)->delete();
			}
			elseif($type == 9)
			{
				$destroy = TrainingAtt::where('id', $id)->delete();
			}
			elseif($type == 10)
			{
				$destroy = Reference::where('id', $id)->delete();
			}
			elseif($type == 11)
			{
				$destroy = Document::where('id', $id)->delete();
			}
			elseif($type == 12)
			{
				$destroy = SubjectTaken::where('exam_id', $id)->where('user_id', Auth::user()->id)->delete();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $destroy;
	}

	public function editolevelsubject($oldValue, $newValue, $examType)
	{
		$retVal;
		try {
			$retVal = SubjectTaken::where('user_id', Auth::user()->id)->where('exam_id', $examType)->where('subject_id', $oldValue)->update(['subject_id' => $newValue]);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $retVal;
	}

	public function editolevelgrade($subject, $oldValue, $newValue, $examType)
	{
		$retVal;
		try {
			$retVal = SubjectTaken::where('user_id', Auth::user()->id)->where('exam_id', $examType)->where('subject_id', $subject)->where('grade_id', $oldValue)->update(['grade_id' => $newValue]);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $retVal;
	}

	public function completeRegistration($id, $jobid)
	{
		$retVal;
		try {
			$retVal = User::where('id', $id)->update(['job_reg_status'=>1]);
			$retVal = \App\JobAppliedFor::where('user_id', $id)->where('job_id', $jobid)->update(['status' => 1]);
		} catch(\Exception $ex) {
			return $ex;
		}
		return $retVal;
	}
	
	public function checkJobComplete($jobid, $uid)
	{
		$retVal;
		try {
			$retVal = \App\JobAppliedFor::where('job_id', $jobid)->where('user_id', $uid)->first();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $retVal;
	}

	public function jobFilter($experience, $jobtype, $emptype, $deptfil, $dateposted, $location)
	{
		$retVal;
		$op1;$op2;$op3;$op4;$op5;$op6;$op7;
		try {
			if($experience == 0 && $jobtype == 0 && $emptype == 0 && $deptfil == 0 && $dateposted == 0 && $location == 0)
			{
				//select all
				$retVal = AvailableJob::paginate(10);
			}
			else
			{
				if($experience == 0)
				{
					$op1 = "!=";
				}
				else
				{
					$op1 = "=";
				}
				if($jobtype == 0)
				{
					$op2 = "!=";
				}
				else
				{
					$op2 = "=";
				}
				if($emptype == 0)
				{
					$op3 = "!=";
				}
				else
				{
					$op3 = "=";
				}
				if($deptfil == 0)
				{
					$op4 = "!=";
				}
				else
				{
					$op4 = "=";
				}
				if($dateposted == 0)
				{
					$dateposted = "!=";
				}
				elseif($dateposted == 1)
				{
					$dateposted = date("Y-m-d");
				}
				elseif($dateposted == 2)
				{
					$dateposted = date("Y-m-d", strtotime("yesterday"));
				}
				elseif($dateposted == 3)
				{
					$dateposted = date("Y-m-d", strtotime("last week"));
				}
				elseif($dateposted == 4)
				{
					$dateposted = date("Y-m-d", strtotime("-2 Weeks"));
				}
				elseif($dateposted == 5)
				{
					$dateposted = date("Y-m-d", strtotime("-1 Months"));
				}
				if($location == 0)
				{
					$op5 = "!=";
				}
				else 
				{
					$op5 = "=";
				}
				$retVal = DB::table('available_jobs')
				->where('min_exp', $op1, $experience)
				->Where('type_id', $op2, $jobtype)
				->orWhere('level_id', $op3, $emptype)
				->Where('created_at', 'like', '%'.$dateposted)
				->Where('location_id', $op4, $location)
				->paginate(10);
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $retVal;
	}

	public function getJobLevel($id)
	{
		$joblevels;
		try {
			if($id == 'all')
			{
				$joblevels = \App\job_level::all();
			}
			else
			{
				$joblevels = \App\job_level::where('id', $id)->first();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $joblevels;
	}

	public function getJobTypes($id)
	{
		$jobtypes;
		try {
			if($id == 'all')
			{
				$jobtypes = \App\WorkType::all();
			}
			else
			{
				$jobtypes = \App\WorkType::where('id', $id)->first();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $jobtypes;
	}

	public function getJobDept($id)
	{
		$jobdepts;
		try {
			if($id == 'all')
			{
				$jobdepts = \App\JobDep::all();
			}
			else
			{
				$jobdepts = \App\JobDep::where('id', $id)->first();
			}
		} catch(\Exception $ex) {
			return $ex;
		}
		return $jobdepts;
	}
	
	public function testTaken($userid, $jobid)
	{
		$testtaken;
		try {
			$testtaken = \App\TestTaken::where('user_id', $userid)->where('job_id', $jobid)->first();
		} catch(\Exception $ex) {
			return $ex;
		}
		return $testtaken;
	}
	
	public function checktexttake($jobid){
		
		$checktexttake= \App\TestTaken::where('job_id',$jobid)
										->where('user_id',\Auth::user()->id)
										->first();
										
		return $checktexttake['test_taken'];
		
	}
	
	public function gettestscore($jobid){
		
			$checktexttake=\App\testscore::where('job_app_id',$jobid)
										->where('user_id',\Auth::user()->id)
										->first();
										
		return $checktexttake['score'];
		
	}
	public function countquestion(){
		
		$questioncount=\App\testsetting::select('dispques')->first();
		
		return response()->json($questioncount['dispques']);
	}
	
	public function displayquestionjson($skip){
		
		$questionall=DB::table('questions')
		->join('options','questions.id','=','options.question_id')
		->join('corrects','questions.id','=','corrects.question_id')
		->select('questions.*','options.*','corrects.*')
		//->orderBy(DB::raw('RAND()'))
		->skip($skip)->take(1)
		->get();
		
		
		return response()->json($questionall);
	}
	
		//get current users score
	public function getscore($userid,$jobid){
		$myscore=\App\testscore::where('user_id',$userid)
						->where('job_app_id',$jobid)
					->first();
		//foreach($score as $myscore){
			
		return $myscore['score'];
	//	}
		
	}
	
		public function getcorrect($questionid){
		
	 $getcorrect=\App\correct::where('question_id',$questionid)
				->first();
		
				
				return $getcorrect['correctoption'];
			
	
	}
	
	public function submitanswer(array $data,$questionid,$selectedoption,$userid,$jobid){
		
		try{
				if(\Auth::user()->locked==1){
				
				return	response()->json('banned');
			
			}
			 if(time()>session('endtime')){
			return	response()->json('expired');
			
			} 
			
			
			$checkcorrect=self::getcorrect($questionid);
			$getscore=self::getscore($userid,$jobid);
			
			if($checkcorrect==$selectedoption){
				
				
				
				if($getscore==""){
					
					$createresult=\App\testscore::create(['score'=>1,'job_app_id'=>$jobid,'user_id'=>$userid]);
					
				
				}
				elseif($getscore==0){
					
					$createresult=\App\testscore::where('user_id',$userid)
							->where('job_app_id',$jobid)
					->update(['score'=>1]);
						
				}
				else {
					
				$myscore=$getscore+1;
				$updateresult=\App\testscore::where('user_id',$userid)
							->where('job_app_id',$jobid)
							->update(['textscore'=>$myscore]);
				}
			}
		
			
		$submitanswer=\App\applicantanswer::create($data);
			return response()->json(['message'=>'success']);
		}
		catch(\Exception $e){
		try{
				//already exist so do some manipulation	
			$updateanswer=\App\applicantanswer::where('question_id',$questionid)
			->update($data);
					return response()->json(['message'=>'success']);
			}
			catch(\Exception $e){
			response()->json(['message'=>'failure']);
			}
		}
	}
	

		public function setexpired($type=0){
		
		 if(session()->has('starttime') || session('starttime')!=""){
			
		 }
		 else{
			 session(['starttime'=>time()]);
		 }
		
		 	 $time=\App\testsetting::select('duration')
								->first();
  

     $newtime=session('starttime')+($time['duration']*60);
	 session(['endtime'=>$newtime]);
	 if($type==0){
		 
	 
	 return $time['duration'];
	 }
	 else{
		 $timeinsec=ceil($newtime-time())/60;
					if($timeinsec <=0){
						$timeinsec=0;
					}
		 return $timeinsec;
	 }
		
	}
}

