<?php

namespace App\Http\Controllers;
use Mail;

use Auth;

use App\Mail\AbsenceRequest;

use Illuminate\Http\Request;

use App\Repositories\EmployeeRepository;

class EmployeeController extends Controller
{
    //
	protected $employee;
	
	public function __construct(EmployeeRepository $employee){
       $this->middleware('auth');
       $this->employee=$employee;
    
   }

	//get employee job details
   public function getjobdetail($jobid){

      $getjob=$this->employee->getjobdetail($jobid);
      return $getjob;
  }

  public function index()
  {
    return 'profile';
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
      if(isset($request->create)){
       if($request->create=='ca'){
        $type=4;
    }
    else{

        $type=3;
    }

    $individualgoal=$this->employee->creategoal(['objective'=>$request->objective,'commitment'=>$request->commitment,'goal_cat'=>$type,'emp_id'=>\Auth::user()->id]);

    return $individualgoal;

}

			//check if comment exist
$checkexist=\App\comment::where('goal_id',$request->goalid)
->where('user_id',$request->id)
->select('id')
->first();

if($checkexist==""){
   $empcomment=$this->employee->addcomment(['emp_comment'=>$request->emp_comment,'user_id'=>$request->id,'goal_id'=>$request->goalid]);
   return $empcomment;
}


			//update if comment exist
$empcomment=\App\comment::where('goal_id',$request->goalid)
->where('user_id',$request->id)
->update(['emp_comment'=>$request->emp_comment]);
return 'success';	

}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($route)
    {
      if($route=='time'){
       return date('h:i:s a');
   }
   if($route=='goalsview'){
       return view('employee.goalsview');
   }

   if($route == 'objective')
   {
    return view('lm.objdashboard');
}
if($route=='performance'){


   $lmgoal=$this->employee->lmgoal(0);

   return view('employee.performance',['lmgoal'=>$lmgoal]);
}
elseif($route=='clock'){
	
	$checkexist=$this->employee->clockin(0);
	return $checkexist;
	
}
else if($route=="uploadapptitude"){
	
	
	$questions=$this->employee->allquestions();

	return view('adminsettings.uploadapptitude',['questions'=>$questions]);

	
}
elseif($route=='clockout'){
	
	$checkexist=$this->employee->clockin(1);
	return $checkexist;
}
else if($route=='absence')
{
  $holidays 	= $this->employee->getHolidays();
            //return $expectedEnd = $this->addPublicHoliday($holidays[0]->start_date, $holidays[0]->end_date);
  return view('employee.absence', ['holidays'=>$holidays]);
}
elseif($route=='list'){
	$employee=$this->employee->allemployee();
	$querytype=$this->employee->querytypes();
	$linemanager=$this->employee->allemployee(1);
	
	return view('employee.emplist',['employees'=>$employee,'querytype'=>$querytype,'lms'=>$linemanager]);
}
  elseif($route=='linemanager'){
	  
  $employee=$this->employee->allemployee(1);
	$querytype=$this->employee->querytypes();
	$linemanager=$employee;
	
	return view('employee.emplist',['employees'=>$employee,'querytype'=>$querytype,'lms'=>$linemanager]);	
  }

elseif($route=='myquery'){
	$queries=$this->employee->myquery();
	return view('employee.myquery',['query'=>$queries]);
	
}
		$directemps          = app('App\Repositories\EmployeeRepository')->lmemployee(Auth::user()->id, 'all');
		$pilots              = app('App\Repositories\EmployeeRepository')->getGoalTo(0, 0, 2);
	return view('employee.profile', ['directemps'=>$directemps, 'pilots'=>$pilots]);
}

public function setreadquery(Request $request){
	
	return $this->employee->setreadquery($request->qid);
}
public function empsearchres(Request $request){
		
	
	$employee=$this->employee->searchemp($request->search);
	$querytype=$this->employee->querytypes();
	
	$linemanager=$this->employee->allemployee(1);
	
	return view('employee.emplist',['employees'=>$employee,'querytype'=>$querytype,'lms'=>$linemanager]);
	
}
	//set fiscal year
public function setfy($year){
  session(['FY'=>$year]);
  return response()->json('ok',200);
  
}

	//get fiscal
public function getfiscal(){
	
	$getfiscal=\App\fiscal::first();
	return $getfiscal;
	
}	

public function getgoal($type){

   $lmgoal=$this->employee->lmgoal($type);
   return view('employee.lmgoal',['lmgoal'=>$lmgoal]);

}


public function getperformance($id)

{

   $statistics=$this->employee->showstatistics($id);
   return  $statistics;
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
	  /**
     *Start Code for Employee Leave
     *
     *
     */

    public function daysBetween($startdate, $enddate)
    {
     $startdate = strtotime($startdate);
     $enddate = strtotime($enddate);
    	//$total = date_diff($enddate, $startdate);
     $total = $enddate - $startdate;
     $total = floor($total / (60 * 60 * 24));
    	//$total = $total->format('%d');
     return $total;
 }

 public function getLeaveDue($role)
 {
     return $this->employee->getLeaveDue($role);
 }

 public function getLeaveRequest($empid)
 {
     return $this->employee->getLeaveRequest($empid);
 }

 public function submitrequest(Request $request)
 {
    $data = 0;$xp;
    $expectedEnd = $this->addPublicHoliday($request->startdate, $request->enddate);
    $start 		= $request->startdate;
    $end 		= $request->enddate;
    $pay 		= $request->pay;
    $priority 	= $request->priority;
    $type 		= $request->type;
    $reason 	= $request->reason;
    $total 		= $request->total;
    $filename;

    if($expectedEnd > 0)
    {
        $xp = strtotime($end) + $expectedEnd;
        $add = strtotime("+" . $expectedEnd . " Days", $xp);
        $xp = date("Y-m-d", $add);
    }
    else
    {
        $xp = $end;
    }

    	//get total number of leaves due;
    $totalDue = $this->employee->totalLeaveFiscal(Auth::user()->role);
    $totalDue = $totalDue['day_num'];
    	//add current start and end date the employee is applying for
    $current = $this->daysBetween($start, $end);

    $total += $current;

    if($totalDue == $total || $totalDue > $total)
    {
      try {
        $file =  $request->file('file');
        if(!$file)
        {
            $filename = "";
        }
        else
        {
            $filename=time().'.'.$request->file('file')->getClientOriginalExtension();
            $request->file('file')->move('upload/support', $filename);
        }
        $data = array(
            'emp_id'			=> Auth::user()->id,
            'startdate' 		=> $start,
            'enddate'			=> $end,
            'pay'				=> $pay,
            'priority'			=> $priority,
            'absencetypes_id'	=> $type,
            'reason'			=> $reason,
            'file'				=> $filename,
            'lm_approve'		=> 0,
            'admin_approve'		=> 0,
            'board_approve'		=> 0,
            'lm_comments'		=> NULL,
            'admin_comments'	=> NULL,
            'board_comments'	=> NULL,
            'status'			=> 0,
            'expected_end'      => $xp,
            );
    }catch(\Exception $ex) {
     return $ex;
 }

 /*$lmData = $this->employee->getemployee(Auth::user()->linemanager_id);
 $absenceData = $this->employee->getAbsenceType($type);
 $lmmail = $lmData['email'];
 Mail::to($lmmail)->send(new AbsenceRequest($data, Auth::user()->name, $lmData->name, $absenceData->name));*/

 $data = $this->employee->submitRequest($data);
         //send mail to line manager;

}
else if($totalDue > $total)
{
  if($pay == '1')
  {
     $data = 0;
 }
 else
 {
     try {
        $file =  $request->file('file');
        if(!$file)
        {
            $filename = "";
        }
        else
        {
            $filename=time().'.'.$request->file('file')->getClientOriginalExtension();
            $request->file('file')->move('upload/support', $filename);
        }
        $data = array(
           'emp_id'			  => Auth::user()->id,
           'startdate' 		  => $start,
           'enddate'		  => $end,
           'pay'			  => $pay,
           'priority'		  => $priority,
           'absencetypes_id'  => $type,
           'reason'			  => $reason,
           'file'			  => $filename,
           'lm_approve'		  => 0,
           'admin_approve'	  => 0,
           'board_approve'	  => 0,
           'lm_comments'	  => NULL,
           'admin_comments'	  => NULL,
           'board_comments'	  => NULL,
           'status'			  => 0,
           'expected_end'     => $xp,
           );
    }catch(\Exception $ex) {
        return $ex;
    }
    $data = $this->employee->submitRequest($data);
        //send mail to line manager;
        /*$lmData = $this->employee->getemployee(Auth::user()->linemanager_id);
        $absenceData = $this->employee->getAbsenceType($type);
        $lmmail = $lmData->email;
        Mail::to($lmmail)->send(new AbsenceRequest($data, Auth::user()->name, $lmData->name, $absenceData->name));*/
    }
}
return $data;
}

public function modifyRequest(Request $request)
{
   $type = $request->type;
   if($type == 1)
   {
      $startdate = $request->startdate;
      $enddate = $request->enddate;
      $id = $request->id;

      return $this->employee->modifyRequest($startdate, $enddate, $id);
  }
  else if($type == 2)
  {
      $id = $request->id;
      return $this->employee->dropRequest($id);
  }
}

public function totalLeaveFiscal($role)
{
    $data = $this->employee->totalLeaveFiscal($role);

    return $data;
}

public function addPublicHoliday($startdate, $enddate)
{
    $retVal;
    $publicHolidays = $this->employee->getHolidays();
    if(count($publicHolidays) <= 0)
    {
        //no public holidays set, allow absence request wwithout adding multiple days
        $retVal = 0;
    }
    else
    {
        //loop through public holidays to see if there is any match with the entered start and end date.
        $sum = 0;
        $bank;$sample;
        foreach($publicHolidays as $publicHoliday)
        {
            for($i = $publicHoliday->start_date; $i <= $publicHoliday->end_date; $i++)
            {
                $bank[] =  $i;
            }
        }
        for($i = $startdate; $i <= $enddate; $i++)
        {
            $sample[] = $i;
        }
        for($i = 0; $i < count($bank); $i++)
        {
            for($j = 0; $j < count($sample); $j++)
            {
                if($sample[$j] == $bank[$i])
                {
                    $sum += 1;
                }
            }
        }
        $retVal = $sum;
    }
    return $retVal;
}

}
