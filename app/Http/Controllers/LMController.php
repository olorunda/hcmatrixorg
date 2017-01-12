<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\EmployeeRepository;

use App\Mail\newQuerynotification;

use Auth;

class LMController extends Controller
{
	protected $employee;
    public function __construct(EmployeeRepository $employee)
    {
        $this->middleware('auth');
		$this->employee=$employee;
		 
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

	//save listing
	public function savelisting(Request $request,$type){
				
		
		
		$savelisting=$this->employee->savelisting([
		
		'title'=>$request->title,
		'job_desc'=>$request->description,
		'required_exp'=>$request->required_exp,
		'job_ref'=>$request->job_ref,
		'min_sal'=>$request->froms,
		'max_sal'=>$request->to,
		'min_exp'=>$request->min_exp,
		'max_exp'=>$request->max_exp,
		'level_id'=>$request->levelid,
		'type_id'=>$request->type_id,
		'location_id'=>$request->state,
		'spec_id'=>$request->spec_id,
		'qualification'=>$request->requirement,
		'date_expire'=>$request->exp_date,
		'otherskill'=>$request->otherskill,
		'taketest'=>$request->taketest,
		'dept_id'=>$request->departid
		
		],$type);
		
		return $savelisting;
	}
	
	//executiv view
	
	
	//jobapp
	
	public function jobapp(Request $request){
	
	
	if(isset($request->type)){
	if($request->type=="s"){
		$appbyjobtype=$this->employee->jobapp($request->id,$request->type,$request->startscore,$request->endscore);
	
	}
	else{
	
	$appbyjobtype=$this->employee->jobapp($request->id,$request->type);
	}
	}
	else{
		session(['jobid'=>$request->id]);
	$appbyjobtype=$this->employee->jobapp($request->id);
	}
	
	$availablejobs=$this->employee->alljob();
	return view('employee.applicant',['applicants'=>$appbyjobtype,'availablejobs'=>$availablejobs]);	
		
	}
	
	//approve reject
	public function appdisp(Request $request){
	
		$decide=$this->employee->appdisp(['empid'=>$request->empid,'email'=>$request->email,'decide'=>$request->decide,'name'=>$request->name,'jobtitle'=>$request->jobtitle]);
		
		return $decide;
		
		
		
	}
	
	public function sendmail(Request $request){
			
		$mail=$this->employee->sendmail($request->id,$request->name,$request->email,$request->message);	
		
		return $mail;
			
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

        if($request->ajax())
        {
            $response;
            $type = $request->type;

            if($type==1)
            {
                $comments = strip_tags($request->comments);
                $goalid = $request->goalid;
                $empid = $request->empid;
                $response = app('App\Repositories\EmployeeRepository')->updateLMComments($goalid, $empid, $comments);
            }
            else if($type == 2)
            {
                $data = array(
                    'objective'     => $request->objective, 
                    'commitment'    => $request->commitment, 
                    'emp_id'        => Auth::user()->id, 
                    'assigned_to'   => $request->assignedto, 
                    'goal_cat'      => 1
                    );

                $response = app('App\Repositories\EmployeeRepository')->setGoal($data);
            }
            else if($type == 3)
            {
                $goalid     = $request->goalid;
                $empid      = $request->empid;
                $score      = $request->rating;
                $comment    = $request->comment;

                $response = app('App\Repositories\EmployeeRepository')->setRating($goalid, $empid, $score, $comment);
            }
			
			else if($type == 4)
            {
                $empid = $request->id;

                $response = app('App\Repositories\EmployeeRepository')->getOrganogramData($empid);
            }

            return response()->json($response);
        }
    }
	
	public function org(Request $request)
	{
		$empid = $request->id;

                $response = app('App\Repositories\EmployeeRepository')->getOrganogramData($empid);
				
		return response()->json($response);
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 
	 public function querytype($id){
		 
		 $querytypes=$this->employee->querytypes();
			$allqueries=$this->employee->allqueries($id);
			
			return view('employee.query',['querytypes'=>$querytypes,'allqueries'=>$allqueries]);
	
		 
	}
	//search employees
	public function searchemp(Request $request){
	     
    		 
		
	}
	//more emp
	public function moreemp($skip,$take){
		
		//mm
		$allemployee=$this->employee->allemployee($skip,$take);
		return response()->json($allemployee,200);
		
	}
	//disp detail
	public function dispdetail($id){
		
		$empdetail=\App\User::find($id);
		return response()->json($empdetail);
		
	}
	
	//issuequery
	
	public function issuequery(Request $request){
		//template='+template+'&qtypeid='+qtypeid'
		if($request->file('file')){
		$path = $request->file('file')->store('queries');
		
		$issuequery=$this->employee->issuequery(['content'=>'doc','query_type_id'=>$request->qtypeid,'user_id'=>$request->userid,'empnew'=>1,'lm_id'=>\Auth::user()->id,'document'=>$path]);
		

		}
		else{
		$issuequery=$this->employee->issuequery(['content'=>$request->template,'query_type_id'=>$request->qtypeid,'user_id'=>$request->userid,'empnew'=>1,'lm_id'=>\Auth::user()->id]);
		
	
			
		}
		return $issuequery;	
	}
	
	//disable employee
	public function disable($empid){
		
		try{
			$checkstatus=\App\User::where('id',$empid)->select('locked')->first();
			if($checkstatus['locked']==1){
			$type=0;	
			}
			else{
			$type=1;	
			}
		$disable=\App\User::where('id',$empid)->update(['locked'=>$type]);
		return response()->json($type,200);
		}
		catch(\Exception $ex){
			
			return response()->json("failure:$ex");
		}
		
	}
	
	public function querythread(Request $request){
		
		$getthread=$this->employee->querythread($request->qid);
		
		return $getthread;
		
	}
	
	public function replyquery(Request $request){

	//SEND Notification MAil HAndle LATER
	$email=$request->email;
	$qtype=$request->title;
	$name=explode('@',$email);

	session(['reciever'=>$name[0]]);
	if(\Auth::user()->role==1) {
		$setanswered=\App\query::where('id',$request->id)->update(['status'=>1]);
	session(['notmessage'=>\Auth::user()->name." just replied to the $qtype query you issue"]);
	session(['urllink'=>'lm/query']);
		
		
	}
	else{
	session(['notmessage'=>"You Have a New $qtype query from ". \Auth::user()->name]);
	session(['urllink'=>'employee/myquery']);
	}
	\Mail::to($request->email)->send(new newQuerynotification());
	
	$createquery=$this->employee->replyquery(['comment'=>$request->comment,'query_id'=>$request->id,'emp_id'=>$request->empid]);
	return $createquery;
	
	
	}
	 
    public function show(Request $request, $route)
    {
		if($route=='query'){
			$querytypes=$this->employee->querytypes();
			$allqueries=$this->employee->allqueries();
			return view('employee.query',['querytypes'=>$querytypes,'allqueries'=>$allqueries]);
		}
		
        //
        if($route=='objectives_c')
        {            
            $directemps = app('App\Repositories\EmployeeRepository')->lmemployee(Auth::user()->id, 'chunk');
			
            return view('employee.lm_employee', ['directemps'=> $directemps]);
        }
        else if ($route=='objectives_a')
        {
            $id                 = $request->isemp;
            $lmgoals            = app('App\Repositories\EmployeeRepository')->getGoalTo(Auth::user()->id, $id, 1);
            $employee           = app('App\Repositories\EmployeeRepository')->getemployee($id);
            $fiscal             = app('App\Repositories\EmployeeRepository')->fiscalYear();
            $directemps         = app('App\Repositories\EmployeeRepository')->lmemployee(Auth::user()->id, 'all');
            return view(
                'employee.lm_employee_goal', 
                [
                'employee'          => $employee, 
                'lmgoals'           => $lmgoals, 
                'fiscal'            => $fiscal,
                'directemps'        => $directemps
                ]
                );
        }
        else if($route == 'rate')
        {
            $id                 = $request->isemp;
            $employee           = app('App\Repositories\EmployeeRepository')->getemployee($id);
            $fiscal             = app('App\Repositories\EmployeeRepository')->fiscalYear();
            $directemps         = app('App\Repositories\EmployeeRepository')->lmemployee(Auth::user()->id, 'all');
            $pilot              = app('App\Repositories\EmployeeRepository')->getGoalTo(0, 0, 2);
            return view('employee.performance_rating', 
                [
                'employee'          => $employee, 
                'fiscal'            => $fiscal,
                'directemps'        => $directemps,
                'pilots'            => $pilot
                ]);
        }
        else if($route == 'goals')
        {
            $type = $request->type;

            
            if($type=='idp')
            {
                return $type;
            }
			$directemps          = app('App\Repositories\EmployeeRepository')->lmemployee(Auth::user()->id, 'all');
                $pilots              = app('App\Repositories\EmployeeRepository')->getGoalTo(0, 0, 2);
                return view('employee.goals_cat', ['cat'=>$type, 'directemps'=>$directemps, 'pilots'=>$pilots]);
        }
        else if($route == 'searchCat')
        {
            $type = $request->type;
            $category = app('App\Repositories\EmployeeRepository')->lmcategory('sex', $type, Auth::user()->id);
            foreach($category as $cat)
            {
                $job = app('App\Repositories\EmployeeRepository')->getjobdetail($cat->job_id);
                $cat->job_id =  $job->title;
            }
            return $category;
        }
        else if($route == 'search')
        {
            $type = $request->type;
            $search = $request->q;
            $found = app('App\Repositories\EmployeeRepository')->lmcategory('search', $search, Auth::user()->id);
            return $found;
        }
		
		
        else if($route == 'job')
        {
            $id = $request->id;
            $jobrole = app('App\Repositories\EmployeeRepository')->getjobdetail($id);
            return $jobrole->title;
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
		  $comm = $request->commitment;
        $obj = $request->objective;
        $update = app('App\Repositories\EmployeeRepository')->updateGoal($id, $obj, $comm);
        return $update;
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
		  $delete = app('App\Repositories\EmployeeRepository')->deleteGoal($id);
        return $delete;
    }

    public function getCommentd($id, $goalid)
    {
        $goal = app('App\Repositories\EmployeeRepository')->getCommentd($id, $goalid);

        return $goal;
    }
 public  function month($id)
{
	$retVal;
	switch($id)
	{
		case 1:
		$retVal = "Jan";
		break;
		case 2:
		$retVal = "Feb";
		break;
		case 3:
		$retVal = "Mar";
		break;
		case 4:
		$retVal = "Apr";
		break;
		case 5:
		$retVal = "May";
		break;
		case 6:
		$retVal = "Jun";
		break;
		case 7:
		$retVal = "Jul";
		break;
		case 8:
		$retVal = "Aug";
		break;
		case 9:
		$retVal = "Sep";
		break;
		case 10:
		$retVal = "Oct";
		break;
		case 11:
		$retVal = "Nov";
		break;
		case 12:
		$retVal = "Dec";
		break;
	}
	return $retVal;
}
 
    public function checkDeadline()
    {		
		$deadline = 'open';
		$getfiscal=app('App\Http\Controllers\EmployeeController')->getfiscal();
		
		$startyear = date("Y", strtotime($getfiscal['created_at']));
	
	    $startmonth=$getfiscal['start_month'];
		  
	    $endmonth=$getfiscal['end_month'];
		  
	    $grace=$getfiscal['grace'];
		
		$fiscalstart = "" . $startyear . "-" . $startmonth . "-01";
		$fiscalstart = date("Y-m-d", strtotime($fiscalstart));
		$ff=date("Y-m-d",strtotime( "$fiscalstart + $grace week"));
		
		if(date("Y-m-d") > $ff)
		{
			$deadline = 'closed';
		}

        return $deadline;
    }
 public function review()
  {
      $review = 'open';
      $getfiscal=app('App\Http\Controllers\EmployeeController')->getfiscal();
		
		$startyear = date("Y", strtotime($getfiscal['created_at']));
	
	    $startmonth=$getfiscal['start_month'];
		  
	    $endmonth=$getfiscal['end_month'];
		  
	    $grace=$getfiscal['grace'];
		
		$fiscalstart = "" . $startyear . "-" . $startmonth . "-01";
		$fiscalstart = date("Y-m-d", strtotime($fiscalstart));
		$ff=date("Y-m-d",strtotime( "$fiscalstart + $grace week"));
		
		
      for($i=$endmonth; $i <=12; $i +=$endmonth) 
      {

		$quarter = date("Y-m-d", strtotime("$fiscalstart + $i Months"));
        $monthreview = date("Y-m-d", strtotime("$quarter + $i week"));
		$current = date("Y-m-d");
		
		if($current > $monthreview)
		{
			$review = 'closed';
		}
	  }

    return $review;

}


  /**  public function review()
    {
		$getfiscal=app('App\Http\Controllers\EmployeeController')->getfiscal();
	
	      $startmonth=self::month($getfiscal['start_month']);
		  
	      $endmonth=$getfiscal['end_month'];
		  
	      $grace=$getfiscal['grace'];

        $review = 'closed';
        $startmonth .= " 1";
		
        $start = strtotime($startmonth);

        $end = strtotime("+" . $grace . " weeks", $start);

        $endtime = strtotime(date("M d", $end));

        $q1 = strtotime("+3 Months",  $endtime);
        $q2 = strtotime("+6 Months",  $endtime);
        $q3 = strtotime("+9 Months",  $endtime);
        $q4 = strtotime("+12 Months", $endtime);

        $currnt = strtotime(date("Y-m-d"));

        $currntend = strtotime(date("M d", $currnt));

        if($currntend == $q1 || $currntend == $q2 || $currntend == $q3 || $currntend == $q4)
        {
            $review = 'open';
        }
    }
**/
    public function getRating($id, $goalid)
    {
        $rating = app('App\Repositories\EmployeeRepository')->getRating($id, $goalid);

        return $rating;
    }
}
