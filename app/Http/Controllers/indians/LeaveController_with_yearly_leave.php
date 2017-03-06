<?php
namespace App\Http\Controllers\indians;
use Session;
use DateTime;
use Illuminate\Http\Request;
use DB;
use Auth;
use Config;
use App\Http\Requests;
//use App\Http\Controllers\Controller;
//use App\Http\Controllers\Session;

class LeaveController extends  \App\Http\Controllers\Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /***************************Employee Casual Leave Functions Start*******************************/

    //Leaves applied by the employee List
    public function cl_list()
    {
         $leaves = DB::table(Config::get('constants.tables.EMPLOYEE_LEAVES'))   
            ->select(Config::get("constants.tables.EMPLOYEE_LEAVES.").'*') 
            ->where('emp_id',Auth::id())
            ->get()->toArray();

        return view('employee_leave/employee_leave_list',['leaves'=>$leaves]); 
    }

    //Function to calculate the total number of working days
    public function getWorkingDays($startDate,$endDate,$holidays,$leavedays)
    {
    $endDate = strtotime($endDate);
    $startDate = strtotime($startDate);
    $days = ($endDate - $startDate) / 86400 + 1;
    $no_full_weeks = floor($days / 7);
    //$no_remaining_days = fmod($days, 7);
    $no_remaining_days = $days;
    $the_first_day_of_week = date("N", $startDate);
    $the_last_day_of_week = date("N", $endDate);

       
    /*if ($the_first_day_of_week <= $the_last_day_of_week)
    {  
        foreach ($leavedays as $leaveday)
        {
            if ($the_first_day_of_week <= $leaveday && $leaveday <= $the_last_day_of_week)
            {
                $no_remaining_days--;                
            }
        }
    }
    else
    {        
        if (in_array($the_first_day_of_week, $leavedays))
        {
            //return 'df';
            $no_remaining_days--;
            
        }
        else if (in_array($the_last_day_of_week, $leavedays))
            {
                $no_remaining_days--;
            }
        else
        {
           // return 'hi';
            $no_remaining_days -= count($leavedays);
        }
    }*/
   // return count($leavedays);
   /*$workingDays = $no_full_weeks * (7-count($leavedays));
   //return $no_remaining_days;    
    if ($no_remaining_days > 0 )
    {
        $workingDays += $no_remaining_days;
    }*/
    for ( $i = $startDate; $i <= $endDate; $i = $i + 86400 )
    {
        if (in_array(date( 'N', $i ), $leavedays))
            $no_remaining_days--;
    }

    $workingDays = $no_remaining_days;
    foreach($holidays as $holiday)
    {
        $time_stamp=strtotime($holiday);
        if ($startDate <= $time_stamp && $time_stamp <= $endDate && !(in_array(date("N",$time_stamp),$leavedays)))
            $workingDays--;
    }
    return $workingDays;    
}

//get the dates in mutiple days leave
public function createDateRangeArray($strDateFrom,$strDateTo)
{    
    $aryRange=array();
    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}

//Get the total working days between the selected date range
    /*public function fnGetLeaves(Request $request)
    {
        //Get the list of holidays within the selected duration
        $from_month = date("m",strtotime($request->input('from_date')));
        $to_month = date("m",strtotime($request->input('to_date')));

        $holiday_details = DB::select("SELECT * FROM ".Config::get('constants.tables.HOLIDAYS')." WHERE (Month(single_day) = ".$from_month." || (Month(from_date) = ".$from_month." || Month(to_date) = ".$to_month.")) and status=1");

        $holidays = array();
        foreach ($holiday_details as $holiday)
        {
            if($holiday->multiple_days==1)
            {
                $monthenddate = $holiday->to_date;
                $holidays = array_merge($holidays,$this->createDateRangeArray($holiday->from_date,$holiday->to_date));
            }
            else
            {
                array_push($holidays,$holiday->single_day);
            }
        }

        //Get the weekend details
        $weekend_details = DB::table(Config::get('constants.tables.WEEKEND_DAYS'))   
            ->select('*') 
            ->where('weekend_status',1)
            ->get()->toArray();

            $weekends = array();
            foreach($weekend_details as $weekend)
                array_push($weekends,date('N', strtotime($weekend->weekend_day)));


        $startDate = date("Y-m-d",strtotime($request->input('from_date')));
        $endDate = date("Y-m-d",strtotime($request->input('to_date')));
        
        $workingdays = $this->getWorkingDays($startDate,$endDate,$holidays,$weekends);
        //return $workingdays;

        //Getting the total no. of avaialble leaves per month
        $casual_leaves = DB::table(Config::get('constants.tables.CL_DETAILS'))
            ->select('*')    
            ->where('job_role', Auth::user()->role)       
            ->get()->first();

            $cas_lv = $casual_leaves->num_of_leaves;
            $lv_mnth = 1;
            
            $ts1 = strtotime($request->input('from_date'));
            $ts2 = strtotime($request->input('to_date'));

            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);

            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);

            $lv_mnth = (($year2 - $year1) * 12) + ($month2 - $month1)+1;

            $cas_lv = $lv_mnth*($casual_leaves->num_of_leaves);
            
            //Total number of approved leaves in that selected duration


            $approved_leaves = DB::select("SELECT * FROM ".Config::get('constants.tables.EMPLOYEE_LEAVES')." WHERE ((Month(from_date) = ".date('m')." || Month(to_date) = ".date('m').")) and leave_status=".Config::get('constants.apply_leave_status.APPROVED')." and emp_id = ".Auth::id());

           // return $approved_leaves;
            $app_lv = 0;
            if(count($approved_leaves)>0)
            {
                foreach ($approved_leaves as $app_leave)
                {
                    $app_lv = $app_lv+$app_leave->total_no_of_leave_days;
                }
            }

        $tot_working = (int)$cas_lv - (int)$workingdays - (int)$app_lv;
       
        //If LOP
        if($tot_working<0)
            $bal_leave = (int)$cas_lv - (int)$app_lv."<br/><span style='color:#ff0000;'>Loss of Pay for ".abs($tot_working)." days</span>";
        else
            $bal_leave = (int)$cas_lv - (int)$app_lv."<br/><span>Remaining ".(int)$tot_working." days after taking this leave</span>";

        return json_encode(array("Success" => 1, "total_no_of_leave_days" => (int)$workingdays, "bal_leave" => $bal_leave));
    }*/

    public function fnGetLeaves(Request $request)
    {
        $start_date = $request->input('from_date');
        $end_date = $request->input('to_date');

        //Get the list of holidays within the selected duration
        $from_month = date("m",strtotime($start_date));
        $to_month = date("m",strtotime($end_date));
        $from_year = date("Y",strtotime($start_date));
        $to_year = date("Y",strtotime($end_date));

        $from_date = date("Y-m-d",strtotime($start_date));
        $to_date = date("Y-m-d",strtotime($end_date));

        $holiday_details = DB::select("SELECT * FROM ".Config::get('constants.tables.HOLIDAYS')." WHERE ((single_day >='".$start_date."' and single_day <='".$end_date."') || (from_date >='".$start_date."' and to_date <='".$end_date."'))  and status=1");


        $holidays = array();
        foreach ($holiday_details as $holiday)
        {
            if($holiday->multiple_days==1)
            {
                $monthenddate = $holiday->to_date;                
                $holidays = array_merge($holidays,$this->createDateRangeArray($holiday->from_date,$holiday->to_date));
            }
            else
            {
                array_push($holidays,$holiday->single_day);
            }
        }        

        //Get the weekend details
        $weekend_details = DB::table(Config::get('constants.tables.WEEKEND_DAYS'))   
            ->select('*') 
            ->where('weekend_status',1)
            ->get()->toArray();

        $weekends = array();
        foreach($weekend_details as $weekend)
            array_push($weekends,date('N', strtotime($weekend->weekend_day)));

        //Getting the total no. of avaialble leaves per year
        $casual_leaves = DB::table(Config::get('constants.tables.CL_DETAILS'))
            ->select('*')    
            ->where('job_role', Auth::user()->role)       
            ->get()->first();

            $cas_lv = $casual_leaves->num_of_leaves;


        $startDate = date("Y-m-d",strtotime($start_date));
        $endDate = date("Y-m-d",strtotime($end_date));

        $ts1 = strtotime($start_date);
        $ts2 = strtotime($end_date);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);


        //If the leave present between two years
        $yr_diff = $to_year - $from_year;
        $approved_cls = array();
        $workingdays = $this->getWorkingDays($startDate,$endDate,$holidays,$weekends);

        if($yr_diff>0)
        {
            //Getting all the leaves of the starting year
            $strt_yr_cls = 0;


            $strt_yr_cls_qry = DB::select("SELECT * FROM ".Config::get('constants.tables.EMPLOYEE_LEAVES')." WHERE ((Year(from_date) = ".$from_year." || Year(to_date) = ".$from_year.")) and leave_status=".Config::get('constants.apply_leave_status.APPROVED')." and emp_id = ".Auth::id());

            $app_lv = 0;
            if(count($strt_yr_cls_qry)>0)
            {
               foreach ($strt_yr_cls_qry as $strt_app_leave)
                {
                    $to_dt = $strt_app_leave->to_date;

                    if((date("Y",strtotime($strt_app_leave->to_date))) > (date("Y",strtotime($strt_app_leave->from_date))))
                        $to_dt = date("Y",strtotime($strt_app_leave->from_date)).'-12-31';
                    $temp_workingdays = $this->getWorkingDays($strt_app_leave->from_date,$to_dt,$holidays,$weekends);
                    
                    $strt_yr_cls = $strt_yr_cls+$temp_workingdays;
                }
            } 
            

            //Getting all the leaves of the ending year
            $end_yr_cls = 0;

            $end_yr_cls_qry = DB::select("SELECT * FROM ".Config::get('constants.tables.EMPLOYEE_LEAVES')." WHERE ((Year(from_date) = ".$to_year." || Year(to_date) = ".$to_year.")) and leave_status=".Config::get('constants.apply_leave_status.APPROVED')." and emp_id = ".Auth::id());

            $app_lv = 0;
            if(count($end_yr_cls_qry)>0)
            {
               foreach ($end_yr_cls_qry as $end_app_leave)
                {
                    $frm_dt = $end_app_leave->from_date;

                    if((date("Y",strtotime($end_app_leave->to_date))) > (date("Y",strtotime($end_app_leave->from_date))))
                        $frm_dt = date("Y",strtotime($end_app_leave->to_date)).'-01-01';
                    $temp_workingdays = $this->getWorkingDays($frm_date,$end_app_leave->to_date,$holidays,$weekends);
                   
                    $end_yr_cls = $end_yr_cls+$temp_workingdays;
                }
            }  
            //Remaining Casual Leaves in both Years
            $strt_cas_lv = $cas_lv - $strt_yr_cls;
            $end_cas_lv = $cas_lv - $end_yr_cls;     

            $strt_workingdays = $this->getWorkingDays($startDate,$year1."-12-31",$holidays,$weekends);
            $end_workingdays = $this->getWorkingDays($year2."-01-01",$endDate,$holidays,$weekends);


            //If LOP
            //For First Year

            //echo $end_workingdays.' = '.$end_cas_lv .'- '.$end_workingdays;
            if($strt_workingdays>0 && $strt_cas_lv<$strt_workingdays)
            {
                $tot_bal = (int)$strt_cas_lv.' (in '.$year1.')';
                $bal_leave_ctnt = "<br/><span style='color:#ff0000;'>Loss of Pay for ".abs((int)$strt_cas_lv - (int)$strt_workingdays)." days in ".$year1."</span><br/>";
            }
            else
            {
                $tot_bal = (int)$strt_workingdays.' (in '.$year1.')';
                $bal_leave_ctnt = "<br/><span>Remaining ".abs((int)$strt_cas_lv - (int)$strt_workingdays)." days after taking this leave in ".$year1."</span>";
            }

            //For Second Year
            if($end_workingdays>0 && $end_cas_lv<$end_workingdays)
            {
                $tot_bal.= ', ' .(int)$end_cas_lv.' (in '.$year2.')';
                $bal_leave_ctnt.= "<br/><span style='color:#ff0000;'>Loss of Pay for ".abs((int)$end_cas_lv - (int)$end_workingdays)." days in ".$year2."</span><br/>";
            }
            else
            {
                $tot_bal.=', ' .(int)$end_workingdays.' (in '.$year2.')';

                $bal_leave_ctnt.= "<br/><span>Remaining ".abs((int)$end_cas_lv - (int)$end_workingdays)." days after taking this leave in ".$year2."</span>";
            }

            $bal_leave = $tot_bal.$bal_leave_ctnt;
        }
        //For current year leaves alone
        else
        {
                $ts1 = strtotime($start_date);
                $ts2 = strtotime($end_date);

                $year1 = date('Y', $ts1);
                $year2 = date('Y', $ts2);

                $month1 = date('m', $ts1);
                $month2 = date('m', $ts2);

                
                //Total number of approved leaves in that selected duration

                $approved_leaves = DB::select("SELECT * FROM ".Config::get('constants.tables.EMPLOYEE_LEAVES')." WHERE ((Year(from_date) = ".$year1." || Year(to_date) = ".$year1.")) and leave_status=".Config::get('constants.apply_leave_status.APPROVED')." and emp_id = ".Auth::id());


               // return $approved_leaves;
                $app_lv = 0;
                if(count($approved_leaves)>0)
                {
                    foreach ($approved_leaves as $app_leave)
                    {
                        $app_lv = $app_lv+$app_leave->total_no_of_leave_days;
                    }
                }


            $tot_working = (int)$cas_lv - (int)$workingdays - (int)$app_lv;
           
            //If LOP
            if($tot_working<0)
                $bal_leave = (int)$cas_lv - (int)$app_lv."<br/><span style='color:#ff0000;'>Loss of Pay for ".abs($tot_working)." days</span>";
            else
                $bal_leave = (int)$cas_lv - (int)$app_lv."<br/><span>Remaining ".(int)$tot_working." days after taking this leave</span>";
        }
        return json_encode(array("Success" => 1, "total_no_of_leave_days" => (int)$workingdays, "bal_leave" => $bal_leave));
    }

    //Apply Leave
    public function add_leave(Request $request){       
        $now = new DateTime();

        $from_date = date('Y-m-d',strtotime($request->input('from_date')));
        $to_date = date('Y-m-d',strtotime($request->input('to_date')));
        $leave_comment = $request->input('leave_comment');  
        $total_no_of_leave_days = $request->input('total_no_of_leave_days')  ;
        $is_casual_leave = $request->input('is_casual_leave'); 
        
        $arr = array('is_casual_leave' => 'required', 'from_date' => 'required|date|after:yesterday', 'to_date' => 'required|date|after:yesterday','leave_comment' => 'required');
        $rule = array('from_date.after' => 'The from date must be today or later.','to_date.after' => 'The to date must be today or later.','leave_comment.required' => 'The comment field is required.','is_casual_leave.required' => 'The leave type field is required.');

        $this->validate($request,$arr);

        DB::table(Config::get('constants.tables.EMPLOYEE_LEAVES'))->insert(['from_date' => $from_date, 'to_date' => $to_date, 'leave_comment' => $leave_comment, 'total_no_of_leave_days' => $total_no_of_leave_days, 'emp_id' => Auth::id(), 'applied_on' => $now, 'is_casual_leave' => $is_casual_leave]);
        $request->session()->flash('success', 'Leave applied successfully!');
        
        return json_encode(array("Success" => 1));
    }  

    //Cancel leave by the employee who applied
    public function cancel_leave(Request $request)
    {
        $now = new DateTime();
        $id = $request->id;
        $old_status = $request->status;
        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.EMPLOYEE_LEAVES')." WHERE id='". $id . "'");

        if(count($successor)==1) {
            
            
            DB::table(Config::get('constants.tables.EMPLOYEE_LEAVES'))
                ->where('id', $id)
                ->update(['leave_status' => Config::get('constants.apply_leave_status.CANCELLED'), 'status_changed_by' => Auth::id(), 'status_changed_on' => $now]);
            $status_div = '';

        session()->flash('success', 'Leave canceled successfully!');

        $leaves = DB::table(Config::get('constants.tables.EMPLOYEE_LEAVES'))   
            ->select(Config::get("constants.tables.EMPLOYEE_LEAVES.").'*') 
            ->get()->toArray();

        //Getting the total no. of avaialble leaves per month
        $casual_leaves = DB::table(Config::get('constants.tables.CL_DETAILS'))
            ->select('*')    
            ->where('job_role', Auth::user()->role)       
            ->get()->first();

        return redirect('my-leaves');

        }
    }

    /***************************Employee Casual Leave Functions start*******************************/
    
    //List all the leaves applied by the clients and their status to admin
    public function all_cl_list()
    {
        $tbl_user = Config::get('constants.tables.USER');
        $tbl_applied = Config::get('constants.tables.EMPLOYEE_LEAVES');
        
        $leaves = DB::table($tbl_applied) 
            ->join($tbl_user, $tbl_user.'.id', '=', $tbl_applied.'.emp_id')
            ->select("$tbl_applied.*", "$tbl_user.name as emp_name", "$tbl_user.emp_num") 
            ->orderBy($tbl_applied.'.id', 'DESC')
            ->get()->toArray();

        return view('employee_leave/leave_list',['leaves'=>$leaves]); 
    }

    //Status Change
    public function status_change(Request $request)
    {
        $id = $request->input('leave_id');
        $now = new DateTime();
        $today = Date('Y-m-d');
        $leave_status = $request->input('leave_status');  

        $successor = DB::table(Config::get('constants.tables.EMPLOYEE_LEAVES'))
            ->where('id', $id)
            ->first();  

        if(count($successor)==1)
        {
            //If admin added any internal diagnosis
            if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
            {
                $this->validate($request,[
                'leave_status'=>'required'
                ]);

                $status_changed_by =$successor->status_changed_by;
                $status_changed_on =$successor->status_changed_on;            

                //If leave status updated
                if($leave_status!=$successor->leave_status)
                {
                    $status_changed_by = Auth::id();
                    $status_changed_on = $now;
                }   
            
                DB::table(Config::get('constants.tables.EMPLOYEE_LEAVES'))
                    ->where('id', $id)
                    ->update(['leave_status' => $leave_status, 'status_changed_by' => $status_changed_by, 'status_changed_on' => $status_changed_on]);
                $request->session()->flash('success', 'Leave status updated successfully!');
            }  
        }
        else
        {
            $request->session()->flash('error', 'No record Found. Please try again!');
        }      
       
            if($leave_status==2)
            {
                $icon = "fa-exclamation-circle";
                $clr= "warning";
                $title="Pending";
            }
            else if($leave_status==0)
            {
                $icon = "fa-close";
                $clr= "danger";
                $title="Cancelled";
            }
            else
            {
                $icon = "fa-check";
                $clr= "success";
                $title="Approved";
            }

                 $status_div = '<a onclick="fnStatusChange('.$id.','.$leave_status.')"><i class="btn btn-sm btn-'.$clr.' waves-effect icon '.$icon.'" aria-hidden="true" title="'.$title.'"></i></a>';

            return json_encode(array("Success" => "1", "status_div" => $status_div));
    }


    /***************************Admin Casual Leave Functions end*******************************/

}