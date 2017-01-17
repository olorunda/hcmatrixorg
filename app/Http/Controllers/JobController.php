<?php

namespace App\Http\Controllers;

use Auth;

use Validator;

use Illuminate\Http\Request;

use App\Repositories\Interfaces\JobInterface;

class JobController extends Controller
{
    protected $job;
    public function __construct(JobInterface $job)
    {
        $this->middleware('auth');
        $this->middleware('rights');
        $this->job = $job;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

	 public function checkexpired(){
		
		 if(time()>session('endtime')){
			return	response()->json('expired');
			}
		 
		 
	 }
	 
	  public function countquestion(){
		 $questcount=$this->job->countquestion();
		 return $questcount;
		 
	 }
	 public function timer(){
		 
		 return view('jobs.timer');
		 
		 
	 }
	public function submittest($userid,$questionid,$selectedoption,$jobid){
		//return $userid.' '.$questionid.' '.$selectedoption;
  $submitanswer=$this->job->submitanswer(['user_id'=>$userid,'question_id'=>$questionid,'selectedoption'=>$selectedoption,'job_id'=>$jobid],$questionid,$selectedoption,$userid,$jobid);
	return $submitanswer;

	}
	
	public function seton(){
		
		session(['on'=>1]);	
	}
	
		public function displayquestionjson($num)
	{
		$getallquestion=$this->job->displayquestionjson($num);
		return $getallquestion;
	}
	
	public function completed(Request $request){
	$date=date('Y-m-d H:i:s');
	$jobid=$request->jobid;
	//come here 

	$complete=\App\TestTaken::create(['user_id'=>\Auth::user()->id,'job_id'=>$jobid,'test_taken'=>1,'created_at'=>$date]);
	\Session::forget('starttime');
	return response()->json('success',200);
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
        $retVal;
        if($request->ajax())
        {
            $type   = $request->type;
            $opcode = $request->opcode;
            if($type == 1)
            {
                $email              = $request->email;
                $password           = $request->password;
                $cpassword          = $request->password_confirmation;
                $job_app_id         = $request->jobid;

                $requestObject = array(
                    'email'                 => $email,
                    'password'              => $password,
                    'password_confirmation' => $cpassword,
                    'jobid'                 => $job_app_id,
                    );

                $validator = Validator::make($requestObject, [
                    'email'         =>  'required|email|max:255|unique:users', 
                    'password'      =>  'required|min:8|confirmed', 
                    'jobid'         =>  'required|integer', 
                    ]);

                if($validator->fails())
                {
                    return $validator->errors();
                }

                /*$email              = $request->email;
                $password           = $request->password;
                $job_app_id         = $request->jobid;*/

                $data = array(
                    'emp_num'           =>  NULL,
                    'name'              =>  '',
                    'sex'               =>  '',
                    'dob'               =>  date('Y-m-d'),
                    'age'               =>  0,
                    'email'             =>  $email,
                    'phone_num'         =>  '',
                    'marital_status'    =>  '',
                    'password'          =>  bcrypt($password),
                    'workdept_id'       =>  0,
                    'job_id'            =>  0,
                    'hiredate'          =>  date('Y-m-d'),
                    'role'              =>  0,
                    'EDLEVEL'           =>  0,
                    'image'             =>  '',
                    'last_promoted'     =>  date('Y-m-d'),
                    'address'           =>  '',
                    'next_of_kin'       =>  '',
                    'kin_address'       =>  '',
                    'kin_phonenum'      =>  0,
                    'kin_relationship'  =>  '',
                    'twitter'           =>  '',
                    'facebook'          =>  '',
                    'dribble'           =>  '',
                    'instagram'         =>  '',
                    'linemanager_id'    =>  0,
                    'job_app_id'        =>  $job_app_id,
                    'state_origin_id'   =>  0,
                    'lga'               =>  '',
                    );
                $retVal = $this->job->registration($data, $type);
                return $retVal;
            }
            else if($type == 2)
            {
                $sex        = $request->sex;
                $mstatus    = $request->marital_status;
                $maiden     = $request->maiden_name;
                $dob        = $request->date_of_birth;
                $phone      = $request->phone_number;
                $origin     = $request->state_of_origin;
                $lga        = $request->local_government_area;

                $requestData = array(
                    'sex'                   => $sex,
                    'marital_status'        => $mstatus,
                    'maiden_name'           => $maiden,
                    'date_of_birth'         => $dob,
                    'phone_number'          => $phone,
                    'state_of_origin'       => $origin,
                    'local_government_area' => $lga
                    );

                $validator = Validator::make($requestData, [
                    'sex'                   =>  'required|string|max:1',
                    'marital_status'        =>  'required|string|max:7',
                    'date_of_birth'         =>  'required|date_format:Y-m-d',
                    'phone_number'          =>  'required|max:13',
                    'state_of_origin'       =>  'required|integer',
                    'local_government_area' =>  'required|string|max:255'
                    ]);

                if($validator->fails())
                {
                    return $validator->errors();
                }

                $year = date('Y');

                $year_birth = explode('-', $dob);

                $age = (int) $year - (int) $year_birth[0];

                $data = array(
                    'sex'               => $sex,
                    'marital_status'    => $mstatus,
                    'dob'               => $dob,
                    'age'               => $age,
                    'phone_num'         => $phone,
                    'state_origin_id'   => $origin,
                    'lga'               => $lga,
                    'id'                => Auth::user()->id,  
                    );

                $retVal = $this->job->updateReg($data);
                return $retVal;
            }
            else if($type == 3)
            {
                $address = $request->address;
                $city = $request->city;
                $state = $request->state;
                $user_id = Auth::user()->id;

                $requestData = array(
                    'street' => $address,
                    'city'   => $city,
                    'state_id'  => $state,
                    'user_id' => $user_id
                    );

                $validator = Validator::make($requestData, [
                    'street' => 'required|string|max:1000',
                    'city'   => 'required|string|max:200'
                    ]);

                if($validator->fails())
                {
                    return $validator->errors();
                }

                $retVal = $this->job->correspondence($requestData, $opcode);
                return $retVal;
            }
            else if($type == 4)
            {
                $id;
                $name = $request->secname;
                $secstart = $request->secstart;
                $secend = $request->secend;
                $secdegree = $request->secdegree;

                $requestData = array(
                    'name'          => $name,
                    'start_year'    => $secstart,
                    'end_year'      => $secend,
                    'degree'        => $secdegree,
                    'user_id'       => Auth::user()->id
                    );

                $validator = Validator::make($requestData, [
                    'name'  => 'required|string|max:200',
                    'start_year' => 'required|date_format:Y',
                    'end_year'  =>  'required|date_format:Y'
                    ]);

                if($validator->fails())
                {
                    return $validator->errors();
                }

                if($opcode == 1)
                {
                    $retVal = $this->job->educationSecondary($requestData, $opcode);
                }
                else
                {
                    $id = $request->id;
                    $retVal = $this->job->educationSecondary($requestData, $opcode, $id);
                }
                return $retVal;
            }
            else if($type == 5)
            {
                $id;
                $country = $request->country;
                $name = $request->name;
                $course = $request->course;
                $start_year = $request->start_year;
                $end_year = $request->end_year;
                $degree = $request->degree;
                $degreeClass = $request->degreeClass;

                $requestData = array(
                    'name' => $name,
                    'course' => $course,
                    'degree' => $degree,
                    'degree_class' => $degreeClass,
                    'start_year' => $start_year,
                    'end_year' => $end_year,
                    'country_id' => $country,
                    'user_id' => Auth::user()->id
                    );

                $validator = Validator::make($requestData, [
                    'name' => 'required|string|max:200',
                    'course' => 'required|string|max:200',
                    'start_year' => 'required|date_format:Y',
                    'end_year'  => 'required|date_format:Y',
                    ]);

                if($validator->fails())
                {
                    return $validator->errors();
                }

                if($opcode == 1)
                {
                    $retVal = $this->job->educationInstitution($requestData, $opcode);
                }
                else
                {
                    $id = $request->id;
                    $retVal = $this->job->educationInstitution($requestData, $opcode, $id);
                }
                return $retVal;
            }
            else if($type == 6)
            {
                $orgname = $request->orgname;
                $position = $request->position;
                $dateemp = $request->dateemp;
                $datetill = $request->datetill;

                $requestData = array(
                    'organization' => $orgname,
                    'position' => $position,
                    'start_date' => $dateemp,
                    'end_date' => $datetill,
                    'user_id' =>  Auth::user()->id
                    );

                $validator = Validator::make($requestData, [
                    'organization' => 'required|string|max:200',
                    'position' => 'required|string|max:100',
                    'start_date' => 'required|date_format:Y-m-d',
                    'end_date' => 'required|date_format:Y-m-d'
                    ]);

                if($validator->fails())
                {
                    return $validator->errors();
                }

                if($opcode == 1)
                {
                    $retVal = $this->job->employementHistory($requestData, $opcode);
                }
                else
                {
                    $id = $request->id;
                    $retVal = $this->job->employementHistory($requestData, $opcode, $id);
                }
                return $retVal;
            }
            else if($type == 7)
            {
                $name = $request->org_name;
                $date_joined = $request->date_joined;
                $date_left = $request->date_left;
                $mem_num = $request->mem_num;
                $mode = $request->org_membership_type;

                $requestData = array(
                    'user_id' => Auth::user()->id,
                    'body'    => $name,
                    'date_joined'   => $date_joined,
                    'till'          => $date_left,
                    'mode'          => $mode,
                    'prof_number'   => $mem_num
                    );

                $validator = Validator::make($requestData, [
                    'body'  => 'required|string|max:200',
                    'date_joined'   => 'required|date_format:Y-m-d',
                    'till'          => 'required|date_format:Y-m-d',
                    'mode'          => 'required|integer'
                    ]);

                if($validator->fails())
                {
                    return $validator->errors();
                }

                if($opcode == 1)
                {
                    $filename=Auth::user()->id .rand(00000,99999). '.' .$request->file('file')->getClientOriginalExtension();

                    $request->file('file')->move('upload/support', $filename);

                    $requestData = array(
                        'user_id'       => Auth::user()->id,
                        'body'          => $name,
                        'date_joined'   => $date_joined,
                        'till'          => $date_left,
                        'mode'          => $mode,
                        'prof_number'   => $mem_num,
                        'certificate'   => $filename
                        );

                    $retVal = $this->job->professionalhistory($requestData, $opcode);
                }
                else
                {
                     $requestData = array(
                        'user_id'       => Auth::user()->id,
                        'body'          => $name,
                        'date_joined'   => $date_joined,
                        'till'          => $date_left,
                        'mode'          => $mode,
                        'prof_number'   => $mem_num
                        );

                     $id = $request->id;
                    $retVal = $this->job->professionalhistory($requestData, $opcode, $id);
                }
                return $retVal;
            }
            else if($type == 8)
            {
                $requestData = array(
                    'skill_id'          => $request->skill,
                    'proficiency_id'    => $request->comp,
                    'user_id'           => Auth::user()->id,
                    );

                if($opcode == 1)
                {
                    $retVal = $this->job->applicantSkills($requestData, $opcode);
                }
                else
                {
                    $id = $request->id;
                    $retVal = $this->job->applicantSkills($requestData, $opcode, $id);
                }
                return $retVal;
            }
            else if($type == 9)
            {
                $requestData = array(
                    'training_name' => $request->name,
                    'start_date'    => $request->start,
                    'end_date'      => $request->end,
                    'institution'   => $request->institution,
                    'location'      => $request->location,
                    'user_id'       => Auth::user()->id
                    );

                $validator = Validator::make($requestData, [
                    'training_name'     => 'required|string|max:255',
                    'start_date'        => 'required|date_format:Y-m-d',
                    'end_date'          => 'required|date_format:Y-m-d',
                    'institution'       => 'required|string|max:200',
                    'location'          => 'required|string|max:255'
                    ]);

                if($validator->fails())
                {
                    return $validator->errors();
                }

                if($opcode == 1)
                {
                    $retVal = $this->job->applicantTraining($requestData, $opcode);
                }
                else
                {
                    $id = $request->id;
                    $retVal = $this->job->applicantTraining($requestData, $opcode, $id);
                }
                return $retVal;
            }
            else if($type == 10)
            {
                $requestData = array(
                    'ref_title'         => $request->title,
                    'ref_name'          => $request->name,
                    'ref_prof'          => $request->prof,
                    'ref_addr'          => $request->addr,
                    'ref_city'          => $request->city,
                    'ref_state_id'      => $request->state,
                    'ref_country_id'    => $request->country, 
                    'ref_email'         => $request->mail,
                    'ref_phone'         => $request->phone,
                    'user_id'           => Auth::user()->id
                    );

                $validator = Validator::make($requestData, [
                    'ref_name'      => 'required|string|max:255',
                    'ref_prof'      => 'required|string|max:255',
                    'ref_addr'      => 'required|string',
                    'ref_city'      => 'required|string',
                    'ref_phone'     => 'required',
                    'ref_email'     => 'required|email'
                    ]);

                if($validator->fails())
                {
                    return $validator->errors();
                }

                if($opcode == 1)
                {
                    $retVal = $this->job->applicantReferences($requestData, $opcode);
                }
                else
                {
                    $id = $request->id;
                    $retVal = $this->job->applicantReferences($requestData, $opcode, $id);
                }
                return $retVal;
            }
            else if($type == 11)
            {
                $requestData = array(
                    'subject1'  => $request->subject1,
                    'grade1'    => $request->grade1,
                    'subject2'  => $request->subject2,
                    'grade2'    => $request->grade2,
                    'subject3'  => $request->subject3,
                    'grade3'    => $request->grade3,
                    'subject4'  => $request->subject4,
                    'grade4'    => $request->grade4,
                    'subject5'  => $request->subject5,
                    'grade5'    => $request->grade5,
                    'subject6'  => $request->subject6,
                    'grade6'    => $request->grade6,
                    'exam_id' 	=> $request->examType
                    );

                $retVal = $this->job->results($data = array('subject_id'=>$requestData['subject1'], 'grade_id'=>$requestData['grade1'], 'user_id'=>Auth::user()->id, 'exam_id'=>$requestData['exam_id']), $opcode, Auth::user()->id);

                $retVal = $this->job->results($data = array('subject_id'=>$requestData['subject2'], 'grade_id'=>$requestData['grade2'], 'user_id'=>Auth::user()->id, 'exam_id'=>$requestData['exam_id']), $opcode, Auth::user()->id);

                $retVal = $this->job->results($data = array('subject_id'=>$requestData['subject3'], 'grade_id'=>$requestData['grade3'], 'user_id'=>Auth::user()->id, 'exam_id'=>$requestData['exam_id']), $opcode, Auth::user()->id);

                $retVal = $this->job->results($data = array('subject_id'=>$requestData['subject4'], 'grade_id'=>$requestData['grade4'], 'user_id'=>Auth::user()->id, 'exam_id'=>$requestData['exam_id']), $opcode, Auth::user()->id);

                $retVal = $this->job->results($data = array('subject_id'=>$requestData['subject5'], 'grade_id'=>$requestData['grade5'], 'user_id'=>Auth::user()->id, 'exam_id'=>$requestData['exam_id']), $opcode, Auth::user()->id);

                $retVal = $this->job->results($data = array('subject_id'=>$requestData['subject6'], 'grade_id'=>$requestData['grade6'], 'user_id'=>Auth::user()->id, 'exam_id'=>$requestData['exam_id']), $opcode, Auth::user()->id);

                /*for($i = 1; $i <= 6; $i++)
                {
                    $subject = "subject".$i;
                    $grade   = "grade".$i;
                    $requestData = array(
                        'subject_id' => $requestData[$subject],
                        'grade_id'   => $requestData[$grade],
                        'user_id'    => Auth::user()->id
                    );
                    $retVal = $this->job->results($requestData, 2, Auth::user()->id);
                    if(!$retVal->id)
                    {
                        return $retVal;
                    }
                }
                check this block later. This failed after the first insertion. Why?
                */
                //$retVal = 1;
                return $retVal;
            }
            else if($type == 12)
            {
                $retVal;
                $docType = $request->doctype;
                $doc     = $request->file;

                if ($request->hasFile('file')) 
                {
                    if ($request->file('file')->isValid())
                    {
                        $path = $request->file('file')->store('documents', 'locale');
                        $retVal = $this->job->additionalInfo($requestData = array('document'=>$path, 'type_id'=>$docType, 'user_id'=>Auth::user()->id), 2, Auth::user()->id);
                        $retVal = $path;
                    }
                    else
                    {
                        $retVal = "invalid";
                    }
                }
                else
                {
                    $retVal = "nofile";
                }
                return $retVal;
            }
            elseif($type == 13)
            {
                $retVal;
                $oldValue = $request->oldValue;
                $newValue = $request->newValue;
                $examType = $request->examType;
                $retVal   = $this->job->editolevelsubject($oldValue, $newValue, $examType);
                return $retVal; 
            }
            elseif($type == 14)
            {
                $retVal;
                $subject  = $request->subject_id;
                $oldValue = $request->oldValue;
                $newValue = $request->newValue;
                $examType = $request->examType;
                $retVal   = $this->job->editolevelgrade($subject, $oldValue, $newValue, $examType);
                return $retVal; 
            }
            elseif($type == 15)
            {
				$jobid = $request->jobid;
                $retVal = $this->job->completeRegistration(Auth::user()->id, $jobid);
                return $retVal;
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        if($id == 'joblist')
        {
            $states = $this->job->getLocations('all');
            $jobs = $this->job->getJobs('all');
            return view('jobs.joblisting', ['states'=>$states, 'jobs'=> $jobs]);
        }
        elseif($id == 'jobs')
        {
            $id = $request->id;
            return view('jobs.job', ['jobid'=>$id]);
        }
        elseif($id == 'default')
        {
            $id = $request->job_id;
			$jobInfo = $this->job->getJobs($id);
			if(strtotime(date('Y-m-d H:i:s')) > strtotime($jobInfo['date_expire']))
			{
				return redirect('available_jobs/jobs?id=' . $id)->withErrors(['msg', 'expired']);
			}
            $applied;
            //if(Auth::user()->linemanager_id == 0)
            //{
                $appliedData = array(
                    'user_id'   =>  Auth::user()->id,
                    'job_id'    =>  $id,
					'status' 	=>  0
                    );
				$jobComp = $this->job->checkJobComplete(Auth::user()->id, $id);
                $applied = $this->job->jobAppFor($appliedData);
				$testTaken = $this->job->testTaken(Auth::user()->id, $id);
				if($jobComp['status'] == 1 && $testTaken['test_taken'] == 1)
				{
					return redirect('job/already-applied');
				}
				else
				{
					
				}
                /*if($applied == 'applied' && Auth::user()->job_reg_status == 1)
                {
                    return redirect('job/already-applied');
                }*/
                session(['applied'=>1]);
            //}

            session(['preview_job'=>$id]);
            $states         = $this->job->getLocations('all');
            $countries      = $this->job->getCountries('all');
            $gradeDocs      = $this->job->getDocumentTypes('all');
            $jobskills      = $this->job->getJobSkills('all');
            $competencies   = $this->job->getJobSkillCompetence('all');
            $bios           = $this->job->getBio(Auth::user()->id);
            $corrs          = $this->job->getCorrespondence(Auth::user()->id);
            $eds            = $this->job->getSecEducation(Auth::user()->id);
            $edIs           = $this->job->getHigherEducation(Auth::user()->id);
            $emps           = $this->job->getEmployment(Auth::user()->id);
            $profs          = $this->job->getProfessionalHistory(Auth::user()->id);
            $skills         = $this->job->getSkill(Auth::user()->id);
            $trainings      = $this->job->getTraining(Auth::user()->id);
            $refs           = $this->job->getReference(Auth::user()->id);
            $olevel         = $this->job->results($data = array(), 1, Auth::user()->id);
            $xamolevel      = $this->job->results($data = array(), 33, Auth::user()->id);
            $subjects       = $this->job->subjects($data = array(), 1, 'all');
            $grades         = $this->job->grades($data = array(), 1, 'all');
            $adds           = $this->job->additionalInfo($data = array(), 1, Auth::user()->id);

            //return $xamolevel;
            //return $this->job->getDocumentTypes($xamolevel[0]);

            return view('jobs.default', [
                'states'        => $states, 
                'countries'     => $countries, 
                'jobid'         => $id, 
                'gradeDocs'     => $gradeDocs, 
                'jobskills'     => $jobskills, 
                'competencies'  => $competencies,
                'bios'          => $bios,
                'corrs'         => $corrs,
                'eds'           => $eds,
                'edIs'          => $edIs,
                'emps'          => $emps,
                'profs'         => $profs,
                'skills'        => $skills,
                'trainings'     => $trainings,
                'refs'          => $refs,
                'olevel'        => $olevel,
                'subjects'      => $subjects,
                'grades'        => $grades,
                'adds'          => $adds,
                'xamolevel'     => $xamolevel,
				'app_job' 		=> $id
                ]);
        }
        elseif ($id == 'get-images') 
        {
            $retVal = $this->job->additionalInfo($data = array(), 1, Auth::user()->id);
            return response()->json($retVal);
        }
        elseif($id == 'docType')
        {
            $retVal = $this->job->getDocumentTypes('all');
            return $retVal;
        }
        elseif($id == 'subjects')
        {
            $selected = $request->selected;
            $retVal = $this->job->results($data = array(), 3, Auth::user()->id, $selected);
            return $retVal;
        }
        elseif($id == 'already-applied')
        {
            return view('jobs.applied');
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
    public function destroy(Request $request, $id)
    {
        //
        $type = $request->type;
        $retVal = $this->job->destroy($id, $type);

        return $retVal;
    }
}
