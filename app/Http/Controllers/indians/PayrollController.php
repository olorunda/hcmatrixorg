<?php
namespace App\Http\Controllers\indians;
use Session;
use DateTime;
use Illuminate\Http\Request;
use DB;
use Auth;
use Config;
use App\Http\Requests;
use Response;
use Input;
use App\Item;
use Excel;
use Carbon\Carbon;
use PDF;
use APP;
//use App\Http\Controllers\Controller;
//use App\Http\Controllers\Session;

class PayrollController extends  \App\Http\Controllers\Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
        
    /***************************Week End Functions Start*******************************/
    //fill in the week_end updation form
    public function fill_weekend_form()
    {
        $week_end_details = DB::table(Config::get('constants.tables.WEEKEND_DAYS'))
            ->select('*')           
            ->get()->toArray();

           // print_r($week_end_details); die;
/*
            $html = '';
            foreach ($week_end_details as $week_end_det) {
                $chked = '';
                if($week_end_det->weekend_status==1)
                    $chked = "checked=checked";

               $html.="<p><input type='checkbox' name='weekend_day[]' id='".strtolower($week_end_det->weekend_day)."_chk' ".$chked." value='".$week_end_det->weekend_day."'>&nbsp;<label>".$week_end_det->weekend_day."</label> </p>"; 
            }*/

        return view('payroll/weekend_days')->with('week_end_details', $week_end_details);

    //    return json_encode(array('Success'=>1, 'week_end_details'=>$html));
    }

    //update the weekends
    public function update_weekend_form(Request $request){

        $weekend_day = $request->input('weekend_day');

        //Set all the selection to 0
        DB::table(Config::get('constants.tables.WEEKEND_DAYS'))->update(['weekend_status' =>0]);

         if(count($weekend_day)>0)
        {
            foreach ($weekend_day as $key => $dayname) {
             DB::table(Config::get('constants.tables.WEEKEND_DAYS'))
                ->where('weekend_day', $dayname)
                ->update(['weekend_status' => 1]);
            }
        }
        
        $request->session()->flash('success', 'Weekend days updated successfully!');
        
        return redirect('edit-weekend_days');  

           
        //return json_encode(array("Success" => 1, "session" => $request->session()->get('success')));   
    }

    /***************************Week End Functions end*******************************/


    /***************************Casual Leave Functions Start*******************************/
    //fill in the casual leave updation form
    public function fill_casual_leaves()
    {
        $casual_leaves_details = DB::table(Config::get('constants.tables.CL_DETAILS'))
            ->select('*')           
            ->get()->toArray();

        return view('payroll/edit-casual_leaves')->with('casual_leaves_details', $casual_leaves_details);

        /*    $html = '';
            foreach ($casual_leaves_details as $casual_leaves_det) {
                $html.='<div class="form-group col-xs-12">
                            <div class="col-xs-4"><label>';
                if($casual_leaves_det->job_role==Config::get('constants.roles.Admin_User'))
                    $html.='Admin';
                if($casual_leaves_det->job_role==Config::get('constants.roles.People_Manager'))
                    $html.='People Manager';
                if($casual_leaves_det->job_role==Config::get('constants.roles.Employee'))
                    $html.='Employee';
                if($casual_leaves_det->job_role==Config::get('constants.roles.Doctor'))
                    $html.='Doctor';
                if($casual_leaves_det->job_role==Config::get('constants.roles.Factory_Employee'))
                    $html.='Factory Employee';
                $html.='</label>
                </div>
                <div class="col-xs-8">
                    <input id="job_role" class="form-control" name="job_role[]" type="hidden" value="'.$casual_leaves_det->job_role.'">
                    <input id="num_of_leaves" class="form-control" name="num_of_leaves'.$casual_leaves_det->job_role.'" type="text" value="'.$casual_leaves_det->num_of_leaves.'">
                    <div id="num_of_leaves'.$casual_leaves_det->job_role.'_err"></div>
                </div>

                </div>';
            }

        return json_encode(array('Success'=>1, 'casual_leaves_details'=>$html));*/
    }

    //update the casual leave
    public function update_casual_leaves(Request $request){

        $num_of_leaves = $request->input('num_of_leaves');

            $arr = array();
            $rule = array();
            $cnt=0;
            foreach($request->input('job_role') as $val)
            {
                $cnt++;
                $arr['num_of_leaves'.$val] = 'required|integer';
                $rule['num_of_leaves'.$val.'.required'] = 'The casual leaves / month field is required.';  
                $rule['num_of_leaves'.$val.'.integer'] = 'The casual leaves / month must be an integer.';  
            }

     $this->validate($request, $arr,$rule);

        $casual_leaves = DB::table(Config::get('constants.tables.CL_DETAILS'))
            ->select('*')           
            ->get()->toArray();


         foreach ($casual_leaves as $casual_leave) {
             DB::table(Config::get('constants.tables.CL_DETAILS'))
                ->where('job_role', $casual_leave->job_role)
                ->update(['num_of_leaves' => $request->input('num_of_leaves'.$casual_leave->job_role)]);
        }
        Session::flash('success', 'Casual Leaves / Month updated successfully!');

        return redirect('edit-casual_leaves');  
           
        return json_encode(array("Success" => 1, "session" => $request->session()->get('success')));   
    }

    /***************************Casual Leave Functions end*******************************/

    /***************** Leave calendar start ****************/
    function holiday_cal_list()
    {
        $holidays = DB::table(Config::get('constants.tables.HOLIDAYS'))   
            ->select(Config::get("constants.tables.HOLIDAYS.").'*')
            ->where(Config::get("constants.tables.HOLIDAYS").'.status',1)          
            ->get()->toArray();
          
       /* $holidays = DB::table(Config::get('constants.tables.WEEKEND_DAYS'))   
            ->select(Config::get("constants.tables.WEEKEND_DAYS.").'*')
            ->where(Config::get("constants.tables.WEEKEND_DAYS").'.weekend_status',1)          
            ->get()->toArray();*/
          
            $res_arr = array();

            $cnt=0;
            foreach ($holidays as $temp_holidays)
            {     
                //single day holiday
                if($temp_holidays->multiple_days==0)
                {
                    $strt = $temp_holidays->single_day;
                    $res_arr[$cnt]['holiday_id'] = $temp_holidays->id;
                    $res_arr[$cnt]['start'] = $temp_holidays->single_day;
                    $res_arr[$cnt]['title'] = $temp_holidays->reason;
                }
                //multiple days holiday
                else
                {
                    $strt = $temp_holidays->from_date;
                    $res_arr[$cnt]['holiday_id'] = $temp_holidays->id;
                    $res_arr[$cnt]['start'] = $temp_holidays->from_date;
                    $res_arr[$cnt]['end'] = $temp_holidays->to_date;
                    $res_arr[$cnt]['title'] = $temp_holidays->reason;
                }
                    
                //If past holiday
                if($strt < date("Y-m-d"))
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['red_clr'];

                //If current day holiday
                if($strt == date("Y-m-d"))
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['cyan_clr'];

                //If future holiday
                if($strt == date("Y-m-d"))
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['green_clr'];

                $strt = date("Y-m-d",strtotime("+1 day", strtotime($strt)));
                $cnt++;
            }
            echo json_encode($res_arr);
            exit;
    }

    public function holiday_calendar()
    {
        return view('payroll/leave_calendar');
    }

    //Holiday List
    public function holiday_list()
    {
         $holidays = DB::table(Config::get('constants.tables.HOLIDAYS'))   
            ->select(Config::get("constants.tables.HOLIDAYS.").'*') 
            ->orderBy('id', 'DESC')
            ->get()->toArray();

        return view('payroll/holiday_list',['holidays'=>$holidays]);    

        //return view('payroll/holiday_list');
    }


    //Add Holiday Form
    public function add_holiday_form()
    {
        
        return view('holiday/add_holiday');
    }

    //Adding Holiday
    public function add_holiday(Request $request){       
        $now = new DateTime();

        $multiple_days = $request->input('multiple_days');
        $single_day = $request->input('single_day');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $reason = $request->input('reason');    

        $arr = array('reason' => 'required');
        $rule = array();

        if($multiple_days==1)
        {
            $arr['from_date'] = 'required|date|after:yesterday';
            $rule['from_date.required'] = 'The from date field is required.';
            $rule['from_date.after'] = 'The from date must be today or later.';
            $arr['to_date'] = 'required|date|after:from_date';
            $rule['to_date.required'] = 'The to date field is required.';
            $rule['to_date.after'] = 'The to date must be after from date.';
        }
        else
        {
            $arr['single_day'] = 'required|date|after:yesterday';
            $rule['single_day.required'] = 'The leave day field is required.';
            $rule['single_day.after'] = 'The leave day must be today or later.';
        }


        $this->validate($request,$arr,$rule);

        $insert_arr = array();

        if($multiple_days=='')
        {
            $insert_arr['single_day'] = date('Y-m-d',strtotime($single_day));
        }
        else
        {
            $insert_arr['multiple_days'] = $multiple_days;
            $insert_arr['from_date'] = date('Y-m-d',strtotime($from_date));
            $insert_arr['to_date'] = date('Y-m-d',strtotime($to_date));
        }
        $insert_arr['reason'] = $reason;
        $insert_arr['created_by'] = Auth::id();
        $insert_arr['created_date'] = $now;


        DB::table(Config::get('constants.tables.HOLIDAYS'))->insert($insert_arr);
        $request->session()->flash('success', 'Holiday added successfully!');
        
        return json_encode(array("Success" => 1));
        //return redirect('holiday-list');        
    }  

    //Update holiday
    public function update_holiday_form(Request $request){
        $id = $request->input('id');
        $multiple_days = $request->input('multiple_days');
        $single_day = $request->input('single_day');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $reason = $request->input('reason');    

        $arr = array('reason' => 'required');
        $rule = array();

        if($multiple_days==1)
        {
            $arr['from_date'] = 'required|date|after:yesterday';
            $rule['from_date.required'] = 'The from date field is required.';
            $rule['from_date.after'] = 'The from date must be today or later.';
            $arr['to_date'] = 'required|date|after:from_date';
            $rule['to_date.required'] = 'The to date field is required.';
            $rule['to_date.after'] = 'The to date must be after from date.';
        }
        else
        {
            $arr['single_day'] = 'required|date';
            $rule['single_day.required'] = 'The day field is required.';
        }


        $this->validate($request,$arr,$rule);

        $update_arr = array();

        if($multiple_days=='')
        {
            $update_arr['single_day'] = date('Y-m-d',strtotime($single_day));
        }
        else
        {
            $update_arr['multiple_days'] = $multiple_days;
            $update_arr['from_date'] = date('Y-m-d',strtotime($from_date));
            $update_arr['to_date'] = date('Y-m-d',strtotime($to_date));
        }
        $update_arr['reason'] = $reason;

        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.HOLIDAYS')." WHERE id='". $id . "'");

        if(count($successor)==1) {
            DB::table(Config::get('constants.tables.HOLIDAYS'))
                ->where('id', $id)
                ->update($update_arr);
            $request->session()->flash('success', 'Holiday updated successfully!');
        } else {
            $request->session()->flash('error', 'No record Found. Please try again!');
        }        
        return json_encode(array("Success" => 1));       
        //return redirect('holiday-list');
    }

    //List of all the holidays - Current Admin User
    public function holidays_list()
    {
        $holidays = DB::table(Config::get('constants.tables.HOLIDAYS'))
            ->select('*')
            ->get();
        
        return view('holiday/holidaylist',['holidays'=>$holidays]);        
    }

    //Fill the edit holiday form
    public function fill_holiday_form($id)
    {
        $holiday_details = DB::table(Config::get('constants.tables.HOLIDAYS'))
            ->select('*')
            ->where('id', '=' , $id)            
            ->first();

        if($holiday_details->multiple_days ==1)
        {
            $holiday_details->single_day = '';
            $holiday_details->from_date = date("M d, Y", strtotime($holiday_details->from_date));
            $holiday_details->to_date = date("M d, Y", strtotime($holiday_details->to_date));
        }
        else
        {
            $holiday_details->single_day = date("M d, Y", strtotime($holiday_details->single_day));
            $holiday_details->from_date = '';
            $holiday_details->to_date = '';
        }
        return json_encode(array('holiday_details'=>$holiday_details, 'id' => $id));
    }

    //Status Change
    public function holiday_status_change(Request $request)
    {
        $id = $request->id;
        $old_status = $request->status;
        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.HOLIDAYS')." WHERE id='". $id . "'");

        if(count($successor)==1) {
            $new_status=1;
            $icon = "";
            $btn_clr = "btn-success";
            $btn_title = "Make Inactive";

            if($old_status==1)
            {
                $new_status = 0;
                $icon = "-slash";
                $btn_clr = "btn-warning";
                $btn_title = "Make Active";
            }
            DB::table(Config::get('constants.tables.HOLIDAYS'))
                ->where('id', $id)
                ->update(['status' => $new_status]);
            $status_div = '<a onclick="fnStatusChange('.$id.','.$new_status.')"><i class="btn btn-sm '.$btn_clr.' waves-effect icon fa-eye'.$icon.'" aria-hidden="true" title="'.$btn_title.'"></i></a>';
            return json_encode(array("Success" => "1", "status_div" => $status_div));
        }
    }

    //Delete holiday
    public function delete_holiday($arg)
    {
        $tbl_holiday = Config::get('constants.tables.HOLIDAYS');
       
            //delete holiday
            DB::table($tbl_holiday)
            ->where('id', '=', $arg)
            ->delete();
            
            session()->flash('success', 'Holiday deleted successfully!');
        
        return redirect('holiday-list');

    }

    function validateDate($date)
    {   
        $d = Carbon::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    /***************** Leave calendar end ****************/

    //Get all the employees for basicpay in list view
    public function basicpay_list()
    {
        $tbl_basicpay = Config::get('constants.tables.BASICPAY');
        $tbl_user = Config::get('constants.tables.USER');
        
        $employees = DB::table($tbl_user)
            ->select(DB::raw("DISTINCT $tbl_user.grade, $tbl_basicpay.basicpay"))
            ->leftJoin($tbl_basicpay, "$tbl_user.grade", '=', "$tbl_basicpay.emp_grade")
            ->where("$tbl_user.grade",'!=',0)
            ->get();         

        /*$employees = DB::table($tbl_user)
            ->select("$tbl_user.*", "$tbl_basicpay.basicpay")
            ->leftJoin($tbl_basicpay, "$tbl_user.emp_num", '=', "$tbl_basicpay.emp_num")
            ->where("$tbl_user.role", '!=',  Config::get('constants.roles.Admin_User'))
            ->orderBy("$tbl_basicpay.id", 'desc')
            ->orderBy("$tbl_user.role", 'desc')
            ->get();*/
        
        //echo '<pre>'; print_r($employees); exit();
        return view('payroll/employeelist',['employees'=>$employees]);
        
    }
    
    //Get selective employee to add / update the basicpay
    public function basicpay_update(Request $request){ 
        $employee_grade = $request->input('grade');
        $action_button = $request->input('action');
        $basicpay = $request->input('basicpay');
		
        $this->validate($request,[
        'basicpay'=>'required|integer',
        ],['basicpay.required' => 'The Basic pay field is Required.']);
        
        if($action_button == "add"){
            DB::table(Config::get('constants.tables.BASICPAY'))->insert(
                ['emp_grade' => $employee_grade, 'basicpay' => $basicpay]
            );
            $request->session()->flash('success', 'Basicpay added successfully!');
            
        } elseif($action_button == "update") {
            
            DB::table(Config::get('constants.tables.BASICPAY'))
                ->where('emp_grade', $employee_grade)
                ->update(['basicpay' => $basicpay]);
            $request->session()->flash('success', 'Basicpay updated successfully!');
        }
		return json_encode(array("Success" => 1));
        //return redirect('basicpay-list');
        
    }
    
    //Get all the employees for payroll in list view
    public function payroll_list()
    {
        //$month_year = date("M-Y", strtotime(' -1 month'));
        $tbl_basicpay = Config::get('constants.tables.BASICPAY');
        $tbl_user = Config::get('constants.tables.USER');
        $tbl_payroll = Config::get('constants.tables.PAYROLL');
        /*$employees = DB::table($tbl_user)
            ->select("$tbl_user.*", "$tbl_basicpay.basicpay", "$tbl_payroll.id as payroll_id", "$tbl_payroll.ps_issued", "$tbl_payroll.ps_file")
            ->join($tbl_basicpay, "$tbl_user.emp_num", '=', "$tbl_basicpay.emp_num")
            ->leftJoin($tbl_payroll, "$tbl_user.emp_num", '=', "$tbl_payroll.emp_num")
            //->where("$tbl_payroll.month_year",  $month_year)
            ->whereIn("$tbl_user.role", [Config::get('constants.roles.People_Manager'), Config::get('constants.roles.Employee')])
            ->orderBy("$tbl_user.role", 'desc')
            ->get();*/
        $employees = DB::table($tbl_user)
            ->select("$tbl_user.*", "$tbl_basicpay.basicpay", "$tbl_payroll.id as payroll_id", "$tbl_payroll.ps_issued", "$tbl_payroll.ps_file")
            ->join($tbl_basicpay, "$tbl_user.grade", '=', "$tbl_basicpay.emp_grade")
            ->leftJoin($tbl_payroll, function ($join) {
                $join->on(Config::get('constants.tables.USER').".id", '=', Config::get('constants.tables.PAYROLL').".emp_id")
                ->where(Config::get('constants.tables.PAYROLL').".month_year", date("M-Y", strtotime(' -1 month')));
            })
            //->where("$tbl_payroll.month_year",  $month_year)
            ->whereIn("$tbl_user.role", [Config::get('constants.roles.People_Manager'), Config::get('constants.roles.Employee'), Config::get('constants.roles.Factory_Employee')])
            ->orderBy("$tbl_basicpay.id", 'desc')
            ->orderBy("$tbl_user.role", 'desc')
            ->get();
        //echo '<pre>'; print_r($employees); exit();
        return view('payroll/payroll_list',['employees'=>$employees]);
        
    }
    
    //payslip list view of previous months for admin
    public function view_previous_payslip(Request $request)
    {
        $employees = array();
        if(!empty($request->selectmonth)) { //echo $request->selectmonth; //exit();
            //$month_year = date("M-Y", strtotime($request->selectmonth)); echo $month_year;
            $tbl_basicpay = Config::get('constants.tables.BASICPAY');
            $tbl_user = Config::get('constants.tables.USER');
            $tbl_payroll = Config::get('constants.tables.PAYROLL');
            $employees = DB::table($tbl_user)
                ->select("$tbl_user.*", "$tbl_basicpay.basicpay", "$tbl_payroll.id as payroll_id", "$tbl_payroll.ps_issued", "$tbl_payroll.ps_file", "$tbl_payroll.month_year")
                ->join($tbl_basicpay, "$tbl_user.grade", '=', "$tbl_basicpay.emp_grade")
                ->leftJoin($tbl_payroll, "$tbl_user.id", '=', "$tbl_payroll.emp_id")
                ->where("$tbl_payroll.month_year",  $request->selectmonth)
                ->whereIn("$tbl_user.role", [Config::get('constants.roles.People_Manager'), Config::get('constants.roles.Employee'), Config::get('constants.roles.Factory_Employee')])
                ->orderBy("$tbl_user.role", 'desc')
                ->get();
            
            //echo '<pre>'; print_r($employees); exit();
        }
        return view('payroll/payroll_selection_list',['employees'=>$employees]);
        
    }
    
    //Get the employee payroll details in list view
    public function emp_payroll_list()
    {
        //$month_year = date("M-Y");
        $tbl_basicpay = Config::get('constants.tables.BASICPAY');
        $tbl_user = Config::get('constants.tables.USER');
        $tbl_payroll = Config::get('constants.tables.PAYROLL');

        $trainings = DB::table(Config::get('constants.tables.TRAINING'))
            ->select('*')
            ->orderBy('id', 'DESC')
            ->get();

        $employees = DB::table($tbl_basicpay)
            ->select($tbl_user.'.*', $tbl_basicpay.'.basicpay', $tbl_payroll.'.id as payroll_id', $tbl_payroll.'.ps_issued', $tbl_payroll.'.month_year', $tbl_payroll.'.ps_file')
            ->join($tbl_user, $tbl_user.'.grade', '=', $tbl_basicpay.'.emp_grade')
            ->leftJoin($tbl_payroll, $tbl_user.'.id', '=', $tbl_payroll.'.emp_id')
            //->where("$tbl_payroll.month_year",  $month_year)
            ->where($tbl_user.'.id', Auth::id())
            ->orderBy($tbl_payroll.'.id', 'DESC')
            ->get();
        //echo '<pre>'; print_r($employees); exit();
        return view('payroll/emp_payroll_list',['employees'=>$employees]);
        
    }
	
    //Function to calculate the total number of working days
    public function getWorkingDays($startDate,$endDate,$holidays,$leavedays){

    $endDate = strtotime($endDate);
    $startDate = strtotime($startDate);
    $days = ($endDate - $startDate) / 86400 + 1;

    $no_full_weeks = floor($days / 7);
    //$no_remaining_days = fmod($days, 7);
    $no_remaining_days = $days;

    //It will return 1 if it's Monday,.. ,7 for Sunday
    $the_first_day_of_week = date("N", $startDate);
    $the_last_day_of_week = date("N", $endDate);
    
    //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
    //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
    /*if ($the_first_day_of_week <= $the_last_day_of_week) {
        
        foreach ($leavedays as $leaveday)
        {
            if ($the_first_day_of_week <= $leaveday && $leaveday <= $the_last_day_of_week)
            {
                $no_remaining_days--;                
            }
        }
    }
    else {
        // (edit by Tokes to fix an edge case where the start day was a Sunday
        // and the end day was NOT a Saturday)

        // the day of the week for start is later than the day of the week for end
        if (in_array($the_first_day_of_week, $leavedays)) {
            // if the start date is a Sunday, then we definitely subtract 1 day
            $no_remaining_days--;

            if (in_array($the_last_day_of_week, $leavedays)) {
                // if the end date is a Saturday, then we subtract another day
                $no_remaining_days--;
            }
        }
        else {
            // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
            // so we skip an entire weekend and subtract 2 days
            $no_remaining_days -= count($leavedays);
        }
    }*/

   //$workingDays = $no_full_weeks * (7-count($leavedays));
    

    /*if ($no_remaining_days > 0 )
    {
      $workingDays += $no_remaining_days;
    }*/
    for ( $i = $startDate; $i <= $endDate; $i = $i + 86400 )
    {
        if (in_array(date( 'N', $i ), $leavedays))
            $no_remaining_days--;
    }

    $workingDays = $no_remaining_days;

    //We subtract the holidays
    foreach($holidays as $holiday){
        $time_stamp=strtotime($holiday);
        //If the holiday doesn't fall in weekend
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

    public function fnConvertFormula($str, $basic_pay = 0, $housing_allowance = 0, $transport_allowance = 0, $gross_salary = 0)
    {
        $str_temp = str_replace("[[", '$', $str);
        $formula = str_replace("]]", "", $str_temp);
        eval( '$result = (' . $formula. ');' );
        //echo $result; exit();
        return $result;
        
    }

    //Fill the payroll form to save by admin
    public function fill_payroll_form($id)
    {
        //Get the list of holidays
        $holiday_details = DB::select("SELECT * FROM ".Config::get('constants.tables.HOLIDAYS')." WHERE (Month(single_day) = ".date('m', strtotime(' -1 month'))." || (Month(from_date) = ".date('m', strtotime(' -1 month'))." || Month(to_date) = ".date('m', strtotime(' -1 month')).")) and status=1");

        $holidays = array();
        foreach ($holiday_details as $holiday)
        {
            if($holiday->multiple_days==1)
            {
                $monthenddate = $holiday->to_date;
                if($holiday->to_date > date("Y-m-t", strtotime(' -1 month')))
                    $monthenddate = date("Y-m-t", strtotime(' -1 month'));
                $holidays = array_merge($holidays,$this->createDateRangeArray($holiday->from_date,$monthenddate));
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


        $startDate = date("Y-m-01", strtotime(' -1 month'));
        $endDate = date("Y-m-t", strtotime(' -1 month'));
        $workingdays = $this->getWorkingDays($startDate,$endDate,$holidays,$weekends);

// GET employee details        
        $tbl_basicpay = Config::get('constants.tables.BASICPAY');
        $tbl_user = Config::get('constants.tables.USER');
        $employees = DB::table($tbl_user)
            ->select("$tbl_user.*", "$tbl_basicpay.basicpay")
            ->join($tbl_basicpay, "$tbl_user.grade", '=', "$tbl_basicpay.emp_grade")
            ->where("$tbl_user.id",  $id)
            ->get();
//Getting the total no. of avaialble leaves per month
        $casual_leaves = DB::table(Config::get('constants.tables.CL_DETAILS'))
            ->select('*')    
            ->where('job_role', $employees[0]->role)       
            ->get()->first();
        $daily_attendance_query = DB::select("SELECT * FROM ".Config::get('constants.tables.DAILY_ATTENDANCE')." WHERE Month(date) = ".date('m', strtotime(' -1 month'))."  AND emp_id=".$employees[0]->id . " AND clock_out IS NOT NULL");
        $daily_attendance_days = count($daily_attendance_query);
        //echo '<pre>'; Print_r($daily_attendance_query); exit();
		
                // Get leave details
        $leaves_query = DB::select("SELECT * FROM ".Config::get('constants.tables.EMPLOYEE_LEAVES')." WHERE (Month(from_date) = ".date('m', strtotime(' -1 month'))." || Month(to_date) = ".date('m', strtotime(' -1 month')).") AND leave_status=2 AND emp_id=".$employees[0]->id);
                
            
        //echo '<pre>'; Print_r($leaves_query); exit();
        $leaves = array();
        foreach ($leaves_query as $leave) {
            //echo "$leave->from_date && ".date("Y-m-01", strtotime(' -1 month')); exit();
            $leavefromdate = $leave->from_date;
            $leavetodate = $leave->to_date;
            if($leave->from_date < date("Y-m-01", strtotime(' -1 month'))) {
                $leavefromdate = date("Y-m-01", strtotime(' -1 month'));
            }
            if($leave->to_date > date("Y-m-t", strtotime(' -1 month'))) {
                $leavetodate = date("Y-m-t", strtotime(' -1 month'));
            }
            $leaves = array_merge($leaves,$this->createDateRangeArray($leavefromdate,$leavetodate));
            //echo "outside if"; exit();
        }
        //echo '<pre>'; print_r($leaves); //exit();
        foreach ($leaves as $key=>$leave) {
            //echo $key; exit();
            $date_to_day = date("N", strtotime($leave));
            if(in_array($date_to_day, $weekends)) 
                unset($leaves[$key]);            
        }
        
		//GET employee working day list        
        $lop_leave =0;
        $leaves_taken  = count($leaves);
        if($daily_attendance_days != ($workingdays - $leaves_taken)){
            $leaves_taken = $workingdays - $daily_attendance_days;
        }
        $emp_workingdays = $daily_attendance_days;
		$cl = 0;
        if(count($leaves) < $casual_leaves->num_of_leaves) {
            $cl = count($leaves);
        } else {
            $cl = $casual_leaves->num_of_leaves;
        }
        
		
        if($leaves_taken != 0) {
            if($leaves_taken >= $cl) {
                $emp_workingdays = $daily_attendance_days + $cl;
                $lop_leave = $leaves_taken - $cl;
            } else {
                $emp_workingdays = $daily_attendance_days;
                $cl = $leaves_taken;
            }            
        }
		
        //$emp_workingdays = $workingdays - count($leaves);
        
        //echo '<pre>'; Print_r($leaves); print_r($weekends); exit();
        //Get allowance and deduction details for the payroll
        $emp_role = $employees[0]->role;
        $basic_pay = ($employees[0]->basicpay / $workingdays) * $emp_workingdays;
        $basic_pay = number_format((float)$basic_pay, 2, '.', '');
	$housing_allowance = $transport_allowance = $gross_salary = 0 ;
		
        $allowances_query = DB::table(Config::get('constants.tables.ALLOWANCE_DEDUCTION'))   
            ->select(Config::get("constants.tables.ALLOWANCE_DEDUCTION.").'*') 
            ->where("job_role",  $emp_role)
            ->where("is_allowance",  1)
            ->where("status", 1)
            ->get()->toArray();

        $allowances_name = "";
        $allowances_total = $allowances_formula = 0;
        $all_allowances = "";
        foreach($allowances_query as $allowance) {
            if ($allowance->charge_formula){
                $allowances_name .= $allowance->name. " - Formula, ";   
                $allowances_temp_value = $this->fnConvertFormula($allowance->charge_formula, $basic_pay);
                $all_allowances.=$allowance->name.'||||'.number_format(($allowances_temp_value),2, '.', '').'^^^^';
                $allowances_formula += $allowances_temp_value;
                
                // this section to store each allowance in its variable        
                if($allowance->name == 'Housing Allowance') {
                    $housing_allowance = $allowances_temp_value;
                } elseif($allowance->name == 'Transport Allowance') {
                    $transport_allowance = $allowances_temp_value;
                } 
            } else {
                $allowances_name .= $allowance->name. " - ".$allowance->charge_percentage."%, ";            
                $allowances_total += $allowance->charge_percentage;
               // $all_allowances .= '<tr><td>'.$allowance->name.'</td><td style="text-align:right">(+) '.number_format(($basic_pay * $allowance->charge_percentage)/100,2).'</td></tr>';
                $all_allowances.=$allowance->name.'||||'.number_format(($basic_pay * $allowance->charge_percentage)/100,2, '.', '').'^^^^';
            }
        }

        $all_allowances = substr($all_allowances, 0, -4);
        $allowances_name = empty($allowances_name)? "": substr($allowances_name, 0, -2); // to remove last two characters
        //echo '<pre>'; Print_r($allowances_total); exit();
        $allowances_value = (float)(($basic_pay * $allowances_total) / 100) + $allowances_formula;

	//123456 when salary component includes formula gross salary is needed
        $gross_salary = $basic_pay + $allowances_value;
        //Get the details of the approved expenses which are not claimed
        $expenses_query = DB::table(Config::get('constants.tables.EXPENSES'))   
            ->select('*') 
            ->where('emp_id',$employees[0]->id)
            ->where("is_approved",  1)
            ->where("is_claimed", 0)
            ->get()->toArray();

        $expenses_name = "";
        $expenses_total = 0;
        $all_expenses = "";

        foreach($expenses_query as $expense) {
            $expenses_name .= $expense->expense_details. " - ".$expense->expense_charge.", ";            
            $expenses_total += $expense->expense_charge;
           // $all_allowances .= '<tr><td>'.$allowance->name.'</td><td style="text-align:right">(+) '.number_format(($basic_pay * $allowance->charge_percentage)/100,2).'</td></tr>';
            $all_expenses.=$expense->expense_details.'||||'.number_format($expense->expense_charge,2, '.', '').'^^^^';
        }
        if($all_expenses!='')
            $all_expenses = substr($all_expenses, 0, -4);
        $expenses_name = empty($expenses_name)? "": substr($expenses_name, 0, -2);
        
        //Get Deductions
        $deductions_query = DB::table(Config::get('constants.tables.ALLOWANCE_DEDUCTION'))   
            ->select(Config::get("constants.tables.ALLOWANCE_DEDUCTION.").'*') 
            ->where("job_role",  $emp_role)
            ->where("is_allowance",  0)
            ->where("status", 1)
            ->get()->toArray();

        $deductions_name = "";
        $deductions_total = $deductions_formula = 0;
        $all_deductions = "";
        foreach($deductions_query as $deductions) {
            if ($deductions->charge_formula){
                $deductions_name .= $deductions->name. " - Formula, ";
                $deductions_temp_value = $this->fnConvertFormula($deductions->charge_formula, $basic_pay, $housing_allowance, $transport_allowance, $gross_salary);
                $all_deductions.=$deductions->name.'||||'.number_format(($deductions_temp_value),2, '.', '').'^^^^';  
                $deductions_formula += $deductions_temp_value;
            } else {
                $deductions_name .= $deductions->name. " - ".$deductions->charge_percentage."%, ";
                $deductions_total += $deductions->charge_percentage;
                //$all_deductions .= '<tr><td>'.$deductions->name.'</td><td style="text-align:right">(+) '.number_format(($basic_pay * $deductions->charge_percentage)/100,2).'</td></tr>';
                $all_deductions.=$deductions->name.'||||'.number_format(($basic_pay * $deductions->charge_percentage)/100,2, '.', '').'^^^^';
            }
        }
        $all_deductions = substr($all_deductions, 0, -4);
        $deductions_name = empty($deductions_name)? "": substr($deductions_name, 0, -2); // to remove last two characters
        //echo '<pre>'; Print_r($deductions_name); exit();
        $deductions_value = (float)(($basic_pay * $deductions_total) / 100) + $deductions_formula;
        
        $allowance_array = array(
            'allowance_name' => $allowances_name,
            'allowances_value' => $allowances_value
        );
        
        $deduction_array = array(
            'deductions_name' => $deductions_name,
            'deductions_value' => $deductions_value
        );

        $expense_array = array(
            'expenses_name' => $expenses_name,
            'expenses_value' => $expenses_total
        );
        
        $consolidated_allowance = 0;
        $consolidated_allowance_query = DB::table(Config::get('constants.tables.TAX_SLAB'))   
            ->select('*') 
            ->where("name",  "consolidated_allowances")
            ->orderBy('id', 'ASC')
            ->get()->toArray();
        //echo '<pre>'; print_r($consolidated_allowance_query); echo '</pre>'; //exit();
        foreach($consolidated_allowance_query as $consolidated_allowances) { 
            //echo '<br>'.$consolidated_allowances->amount; 
            //echo '<br>'. ($gross_salary * 1/100); exit();
            if ($consolidated_allowances->max == 0) {
                $consolidated_allowance = number_format($consolidated_allowances->amount +($gross_salary * $consolidated_allowances->charge_percentage/100),2,'.','');
                break;
            }                
            if(($gross_salary * 1/100) < $consolidated_allowances->max){
                $consolidated_allowance = number_format($consolidated_allowances->amount +($gross_salary * $consolidated_allowances->charge_percentage/100),2,'.','');
                break;
            }
        }
        
        //echo '<br>'.$consolidated_allowance; exit();
        $total_reliefs = $consolidated_allowance + $deductions_value ;
        $taxable_income = $gross_salary - $total_reliefs;
               
        // tax payable calculation
        $cal_tax_pay = 0;
        $cal_tax_pay_query = DB::table(Config::get('constants.tables.TAX_SLAB'))   
            ->select('*') 
            ->where("name",  "tax_payable")
            ->orderBy('id', 'ASC')
            ->get()->toArray();
        foreach($cal_tax_pay_query as $cal_tax_pays) { 
            //echo '<br>'.$cal_tax_pays->amount; exit();
            if ($cal_tax_pays->max == 0) {
                $cal_tax_pay = number_format($cal_tax_pays->amount +(($taxable_income - $cal_tax_pays->min) * $cal_tax_pays->charge_percentage/100),2,'.','');
                break;
            }
            if(($taxable_income > $cal_tax_pays->min) && ($taxable_income < $cal_tax_pays->max)){
                $cal_tax_pay = number_format($cal_tax_pays->amount +(($taxable_income - $cal_tax_pays->min) * $cal_tax_pays->charge_percentage/100),2,'.','');
                break;
            }
        }
        
        // minimum tax payable calculation
        $minimum_tax_payable = number_format($gross_salary*1/100,2,'.','');
        $tax_payable = ($cal_tax_pay < $minimum_tax_payable) ? $minimum_tax_payable : $cal_tax_pay;
        //$gross_salary = $basic_pay + $allowances_value + $expenses_total;
        //$netsalary = $basic_pay + $allowances_value + $expenses_total - $deductions_value;
        $netsalary =  $basic_pay + $allowances_value + $expenses_total - $tax_payable;
        //Get the month and year for the payroll
        $month_year = date("M-Y", strtotime(' -1 month'));
		//Calculating the LOP for the daily late entrance
        $startDate = date("Y-m-01", strtotime(' -1 month'));
        $endDate = date("Y-m-t", strtotime(' -1 month'));

        $tbl_attendance = Config::get('constants.tables.DAILY_ATTENDANCE');
        $sql = "SELECT sum(daily_deduction_percentage) as tot_late_deduction FROM ".$tbl_attendance." WHERE emp_id = '".$id."' and date >= '".$startDate."' and date <= '".$endDate."'";                      
        $attendance_details = DB::select($sql);


        //Late coming deduction
        $late_coming_deduction = 0;
        if(count($attendance_details)>0)
        {
            $single_day_pay = ($employees[0]->basicpay / $workingdays);
            $late_coming_deduction = $single_day_pay * ($attendance_details[0]->tot_late_deduction / 100);
        }

        $netsalary = $netsalary - $late_coming_deduction;
        return json_encode(array(
        'employee_details'=>$employees,
        'attendance_day' => $workingdays,
        'working_day' => $emp_workingdays, 
        'month_year'=>$month_year, 
        'num_of_leaves' => $cl,
		'num_of_lop_leaves' => $lop_leave,
        'allowance_details' => $allowance_array, 
        'deduction_details' => $deduction_array, 
		'late_coming_deduction' => $late_coming_deduction,
        'basic_pay' => $basic_pay, 
        'netsalary' => $netsalary,
        'gross_salary' => $gross_salary,
        'all_allowances' => $all_allowances,
        'all_deductions' => $all_deductions,        
        'expense_details' => $expense_array, 
        'all_expenses' => $all_expenses,
        'consolidated_allowance' => $consolidated_allowance,
        'total_reliefs' => $total_reliefs,
        'taxable_income' => $taxable_income,
        'cal_tax_pay' => $cal_tax_pay,
        'minimum_tax_payable' => $minimum_tax_payable,
        'tax_payable' => $tax_payable,
        ));
        
    }



    //Fill the saved payroll form to view by admin
    public function fill_payroll_view($id)
    {
        $tbl_basicpay = Config::get('constants.tables.BASICPAY');
        
        
        $tbl_user = Config::get('constants.tables.USER');
        $tbl_payroll = Config::get('constants.tables.PAYROLL');
        $tbl_payroll_details = Config::get('constants.tables.PAYROLL_DETAILS');
        $payroll = DB::table($tbl_payroll)
            ->select("$tbl_payroll.*", "$tbl_user.name")
            ->join($tbl_user, "$tbl_user.id", '=', "$tbl_payroll.emp_id")
            ->where("$tbl_payroll.id",  $id)
            ->get()->toarray();
        //echo '<pre>'; print_r($payroll); exit();
        $payroll_details = DB::table($tbl_payroll_details)
            ->select("*")
            ->where("payroll_id",  $payroll[0]->id)
            ->get()->toarray();
        //echo '<pre>'; print_r($payroll); print_r($payroll_details); exit();
		
		//get employee details
		$employees = DB::table($tbl_user)
            ->select("$tbl_user.*", "$tbl_basicpay.basicpay")
            ->join($tbl_basicpay, "$tbl_user.grade", '=', "$tbl_basicpay.emp_grade")
            ->where("$tbl_user.id",  $payroll[0]->emp_id)
            ->get();
	
		$emp_role = $employees[0]->role;
		
		//get allowence details
		$allowances_query = DB::table(Config::get('constants.tables.ALLOWANCE_DEDUCTION'))   
            ->select(Config::get("constants.tables.ALLOWANCE_DEDUCTION.").'*') 
            ->where("job_role",  $emp_role)
            ->where("is_allowance",  1)
            ->where("status", 1)
            ->get()->toArray();

        /*$allowances_name = "";
        $allowances_total = 0;
        foreach($allowances_query as $allowance) {
			$payroll_allowance = DB::table($tbl_payroll_details)
            ->select("*")
            ->where("payroll_id",  $payroll[0]->id)
            ->where("allowance_id",  $allowance->id)
            ->get()->first();
			
            $allowances_name .= $allowance->name. " - ".$payroll_allowance->percentage."%, ";
            $allowances_total += $allowance->charge_percentage;
        }
        $allowances_name = empty($allowances_name)? "": substr($allowances_name, 0, -2); // to remove last two characters
        //echo '<pre>'; Print_r($allowances_total); exit();
        $allowances_value = (float)(($payroll[0]->basic_pay * $allowances_total) / 100);
*/

        //Get Expenses
        $expenses_query = DB::table(Config::get('constants.tables.EXPENSES'))   
            ->select(Config::get("constants.tables.EXPENSES.").'*') 
            ->where('emp_id',$payroll[0]->emp_id)
            ->where("is_approved",  1)
            ->where("is_claimed",  1)
            ->where("claimed_date",  $payroll[0]->created_date)
            ->get()->toArray();

        $expenses_name = "";
        $expenses_total = 0;
        foreach($expenses_query as $expense) {
            $payroll_expense = DB::table($tbl_payroll_details)
            ->select("*")
            ->where("payroll_id",  $payroll[0]->id)
            ->where("allowance_id",  $expense->id)
            ->get()->first();
            
            $expenses_name .= $payroll_expense->name. " - ".$payroll_expense->charge.", ";
            $expenses_total += $payroll_expense->charge;
        }
        $expenses_name = empty($expenses_name)? "": substr($expenses_name, 0, -2); // to remove last two characters
        //echo '<pre>'; Print_r($expenses_total); exit();
        $expenses_value = (float)($expenses_total);
        
        /*
        //Get Deductions
        $deductions_query = DB::table(Config::get('constants.tables.ALLOWANCE_DEDUCTION'))   
            ->select(Config::get("constants.tables.ALLOWANCE_DEDUCTION.").'*') 
            ->where("job_role",  $emp_role)
            ->where("is_allowance",  0)
            ->where("status", 1)
            ->get()->toArray();

        $deductions_name = "";
        $deductions_total = 0;
        foreach($deductions_query as $deductions) {
			$payroll_deduction = DB::table($tbl_payroll_details)
            ->select("*")
            ->where("payroll_id",  $payroll[0]->id)
            ->where("allowance_id",  $deductions->id)
            ->get()->first();
            $deductions_name .= $deductions->name. " - ".$payroll_deduction->percentage."%, ";
            $deductions_total += $deductions->charge_percentage;

        }
        $deductions_name = empty($deductions_name)? "": substr($deductions_name, 0, -2); // to remove last two characters
	*/	
        $payroll_display = "";        
        $payroll_display .= '<p><b>Employee Name &nbsp; : &nbsp; </b>'.$payroll[0]->name.'</p>';
        $payroll_display .= '<p><b>Employee Number &nbsp; : &nbsp; </b>'.$payroll[0]->emp_num.'</p>';
        $payroll_display .= '<p><b>Monthly Basic Pay &nbsp; : &nbsp; </b>'.number_format($payroll[0]->basicpay,2).'</p>';
        $payroll_display .= '<table data-toggle="table" class="table table-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">';
        $payroll_display .= '<tr>';
        $payroll_display .= '<th><b>Basic Pay</b></th>';
        $payroll_display .= '<td style="text-align:right">'.$payroll[0]->basic_pay.'</td>';
        $payroll_display .= '</tr>';
        /*$payroll_display .= '<tr>';
        $payroll_display .= '<th colspan="2"><b>Allowances Details</b></th>';        
        $payroll_display .= '</tr>';
		$payroll_display .= '<tr>';
        $payroll_display .= '<td colspan="2">'.$allowances_name.'</td>';        
        $payroll_display .= '</tr>';
		$payroll_display .= '<tr>';*/
        $payroll_display .= '<th colspan="2"><b>Allowances</b></th>';        
        $payroll_display .= '</tr>';
        foreach($payroll_details as $details) {
            if($details->type==1) {
                $payroll_display .= '<tr>';
                $payroll_display .= '<td>'.$details->name.'</td>';
                $payroll_display .= '<td style="text-align:right">(+) '.number_format($details->charge,2) .'</td>';       
                $payroll_display .= '</tr>';
            }
        }
        if(count($expenses_query)>0)
        {
            $payroll_display .= '<tr>';
            $payroll_display .= '<th colspan="2"><b>Expenses</b></th>';        
            $payroll_display .= '</tr>';
            foreach($payroll_details as $details) {
                if($details->type==2) {
                    $payroll_display .= '<tr>';
                    $payroll_display .= '<td>'.$details->name.'</td>';
                    $payroll_display .= '<td style="text-align:right">(+) '.number_format($details->charge,2) .'</td>';       
                    $payroll_display .= '</tr>';
                }
            }
        }
		$payroll_display .= '<tr>';
        $payroll_display .= '<th><b>Gross Pay</b></th>';
        $payroll_display .= '<td style="text-align:right">'.number_format($payroll[0]->grosssalary,2).'</td>';
        $payroll_display .= '</tr>';
		$payroll_display .= '<tr>';
        $payroll_display .= '<th colspan="2"><b>Deductions Details</b></th>';        
        $payroll_display .= '</tr>';
	/*	$payroll_display .= '<tr>';
        $payroll_display .= '<td colspan="2">'.$deductions_name.'</td>';        
        $payroll_display .= '</tr>';
        $payroll_display .= '<th colspan="2"><b>Deductions</b></th>';        
        $payroll_display .= '</tr>';*/
        foreach($payroll_details as $details) {
            if($details->type==0) {
                $payroll_display .= '<tr>';
                $payroll_display .= '<td>'.$details->name.'</td>';
                $payroll_display .= '<td style="text-align:right">(-) '.number_format($details->charge,2) .'</td>';
                $payroll_display .= '</tr>';
            }
        }
        $payroll_display .= '<tr>';
        $payroll_display .= '<td colspan="2">Tax Calculation</td>';        
        $payroll_display .= '</tr>';
        $payroll_display .= '<tr>';
        $payroll_display .= '<td>Consolidated Allowance</td>';
        $payroll_display .= '<td style="text-align:right">'.number_format($payroll[0]->consolidated_allowance,2).'</td>';        
        $payroll_display .= '</tr>';
        $payroll_display .= '<tr>';
        $payroll_display .= '<td>Total Reliefs</td>';
        $payroll_display .= '<td style="text-align:right">'.number_format($payroll[0]->total_reliefs,2).'</td>';        
        $payroll_display .= '</tr>';
        $payroll_display .= '<tr>';
        $payroll_display .= '<td>Taxable Income</td>';
        $payroll_display .= '<td style="text-align:right">'.number_format($payroll[0]->taxable_income,2).'</td>';        
        $payroll_display .= '</tr>';
        $payroll_display .= '<tr>';
        $payroll_display .= '<td>Calculated Tax Payable</td>';
        $payroll_display .= '<td style="text-align:right">'.number_format($payroll[0]->cal_tax_pay,2).'</td>';        
        $payroll_display .= '</tr>';
        $payroll_display .= '<tr>';
        $payroll_display .= '<td>Minimum Tax Payable</td>';
        $payroll_display .= '<td style="text-align:right">'.number_format($payroll[0]->minimum_tax_payable,2).'</td>';        
        $payroll_display .= '</tr>';
        $payroll_display .= '<tr>';
        $payroll_display .= '<td>tax_payable</td>';
        $payroll_display .= '<td style="text-align:right">'.number_format($payroll[0]->tax_payable,2).'</td>';        
        $payroll_display .= '</tr>';
		$payroll_display .= '<tr>';
		$payroll_display .= '<td>Late Coming Deduction</td>';
        $payroll_display .= '<td style="text-align:right">(-) '.number_format($payroll[0]->late_coming_deduction,2).'</td>';        
        $payroll_display .= '</tr>';
        $payroll_display .= '<tr>';
        $payroll_display .= '<th colspan="2"><h3 ><b class="pull-right">';
        $payroll_display .= 'NET PAY : '.number_format($payroll[0]->netsalary,2);
        $payroll_display .= '</b></h3></th>';
        $payroll_display .= '</tr>';
        $payroll_display .= '';
        $payroll_display .= '</table>';
        
        return json_encode(array('payroll'=>$payroll_display));
        
    }
    
    
    //Get selective employee to add / update the basicpay
    public function payroll_update(Request $request){ 
        $employee_id = $request->input('id');
        $employee_num = $request->input('num');
        $basicpay = $request->input('basicpay');
        $attendance_days = $request->input('attendance_days');
        $working_days = $request->input('working_days');
        $leave_days = $request->input('leave_days');
        $lop_leave_days = $request->input('lop_leave_days');
        $late_coming_deduction = $request->input('late_coming_deduction');
        $basic_pay = $request->input('basic_pay');
        $salary = $request->input('salary');
        $gross_salary = $request->input('gross_salary');
        $month_year = $request->input('month_year');
        
        $all_allowances = $request->input('all_allowances');
        $all_deductions = $request->input('all_deductions');
        $consolidated_allowance = $request->input('consolidated_allowance');
        $total_reliefs = $request->input('total_reliefs');
        $taxable_income = $request->input('taxable_income');
        $cal_tax_pay = $request->input('cal_tax_pay');
        $minimum_tax_payable = $request->input('minimum_tax_payable');
        $tax_payable = $request->input('tax_payable');
        $now = new DateTime();
        
            DB::table(Config::get('constants.tables.PAYROLL'))->insert(
                ['emp_id' => $employee_id, 'emp_num' => $employee_num, 'basicpay' => $basicpay, 'attendance_days' => $attendance_days, 'working_days' => $working_days, 'leave_days' => $leave_days, 'lop_leave_days' => $lop_leave_days, 'late_coming_deduction' => $late_coming_deduction, 'month_year' => $month_year, 'basic_pay' => $basic_pay, 'netsalary' => $salary, 'grosssalary' =>$gross_salary, 'created_by' => Auth::id(), 'created_date' => $now, 'consolidated_allowance' => $consolidated_allowance, 'total_reliefs' => $total_reliefs, 'taxable_income' => $taxable_income, 'cal_tax_pay' => $cal_tax_pay, 'minimum_tax_payable' => $minimum_tax_payable, 'tax_payable' => $tax_payable]
            );
        
            $payroll_id = DB::getPdo()->lastInsertId();
            /*$job_role_query = DB::table(Config::get('constants.tables.USER'))   
            ->select('role') 
            ->where("id",  $employee_id )
            ->get()->toArray();
            //echo '<pre>'; print_r($payroll_id); exit();
            $emp_role = $job_role_query[0]->role;
            $allowances_query = DB::table(Config::get('constants.tables.ALLOWANCE_DEDUCTION'))   
            ->select('*') 
            ->where("job_role",  $emp_role)
            ->where("status", 1)
            ->get()->toArray();*/

        
        //Adding the $allowances in the payroll
        $allowances = explode('^^^^', $all_allowances);
        foreach($allowances as $allowance) {
            $allow = explode('||||', $allowance);
            //echo '<pre>'; print_r($allowance); exit();
            DB::table(Config::get('constants.tables.PAYROLL_DETAILS'))->insert(
                ['payroll_id' => $payroll_id, 'type' => 1, 'allowance_id' => 0, 'name' => $allow[0], 'charge' => $allow[1]]
            );

        }
        //Adding the deductions in the payroll
        $deductions = explode('^^^^', $all_deductions);
        foreach($deductions as $deduction) {
            $deduc = explode('||||', $deduction);
            //echo '<pre>'; print_r($allowance); exit();
            DB::table(Config::get('constants.tables.PAYROLL_DETAILS'))->insert(
                ['payroll_id' => $payroll_id, 'type' => 0, 'allowance_id' => 0, 'name' => $deduc[0], 'charge' => $deduc[1]]
            );

        }

        //Adding the expenses claimed in the payroll
        $expenses_query = DB::table(Config::get('constants.tables.EXPENSES'))   
            ->select('*') 
            ->where('emp_id',$employee_id)
            ->where("is_approved",  1)
            ->where("is_claimed", 0)
            ->get()->toArray();

        foreach($expenses_query as $expenses) {
            DB::table(Config::get('constants.tables.PAYROLL_DETAILS'))->insert(
                ['payroll_id' => $payroll_id, 'type' => 2, 'allowance_id' => $expenses->id, 'name' => $expenses->expense_details, 'charge' => $expenses->expense_charge]
            );

            //Updating the claim status of the expenses claimed in the payroll
            DB::table(Config::get('constants.tables.EXPENSES'))
                ->where('id', $expenses->id)
                ->update(['is_claimed' => 1, 'claimed_date' => $now]);

        }


            $request->session()->flash('success', 'Payroll added successfully!');
       
        return redirect('payroll-list');
        
    }
    
    
    
    //Generating payslip by admin
    public function create_ps($id)
    {
        $now = new DateTime();
        $ps_file = strtotime("now").".pdf";

       $tbl_employee = Config::get('constants.tables.USER');
       $tbl_admin = Config::get('constants.tables.USER');
       $tbl_payroll = Config::get('constants.tables.PAYROLL');
       $tbl_settings = Config::get('constants.tables.SETTINGS');

        $certificate = DB::table($tbl_payroll)
            ->join($tbl_employee, $tbl_employee.'.id', '=',$tbl_payroll.'.emp_id')
            ->leftJoin($tbl_admin.' as adm', 'adm.id', '=',$tbl_payroll.'.created_by')
            ->select($tbl_payroll.'.*', $tbl_employee.".name as employee_name",$tbl_employee.".role", "adm.name as admin_name")
            ->where($tbl_payroll.'.id', '=', $id)
            ->first();

        $payroll_details = DB::table(Config::get('constants.tables.PAYROLL_DETAILS'))
            ->select("*")
            ->where("payroll_id",  $id)
            ->get()->toarray(); 
        $settings = DB::table($tbl_settings)
            ->select("*")
            ->where("id",  1)
            ->first(); 
        $certificate_details = array(
            'certificate' => $certificate,
            'payroll_details' => $payroll_details,
            'settings' => $settings
        );

        
        //return view('payslip_certificate',['certificate_details'=>$certificate_details]);
        $view =  \View::make('payslip_certificate', compact('certificate_details'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setWatermarkText($settings->watermark_text, '100px', '0.4', '30deg', '45%');
        $pdf->setPaper('A3');
        //$pdf->loadHTML($view);

        $mc_file_uploaded = $pdf->loadHTML($view)->save('psc'.'/'.$ps_file);
        if($mc_file_uploaded)
        {
            //Deleting the existing payslip file if present
            $pay_slip = DB::table($tbl_payroll)
            ->select('*')
            ->where('id', '=', $id)
            ->first();
            $old_ps_file = $pay_slip->ps_file;

            if($old_ps_file!='' && file_exists("public/psc/".$old_ps_file))
                unlink("public/psc/".$old_ps_file);

            DB::table($tbl_payroll)
                    ->where('id', $id)
                    ->update(['ps_issued' => 1, 'ps_file' => $ps_file, 'ps_issued_by' => Auth::id(), 'ps_issued_on' => $now]);
                    Session::flash('success', 'Payslip issued successfully!');

             
                return json_encode(array("Success" => 1));
        }

//return view('payslip_certificate',['certificate_details'=>$certificate_details]);

    $view =  \View::make('payslip_certificate', compact('certificate_details'))->render();

    $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

         return PDF::load($view)->output();


        /*if($file->move(public_path('psc'), $ps_file))     
            return $pdf->download($ps_file);*/
    }
    
/***************** Allowances / Deductions start **************************/

    //Allowance List
    public function allowance_list()
    {
        $roles = DB::table(Config::get('constants.tables.USER'))
            ->select('role')->distinct('role')
            ->get(); 
         $allowances = DB::table(Config::get('constants.tables.ALLOWANCE_DEDUCTION'))   
            ->select(Config::get("constants.tables.ALLOWANCE_DEDUCTION.").'*') 
            ->orderBy('id', 'DESC')
            ->get()->toArray();

        return view('payroll/allowance_list',['allowances'=>$allowances])->with('roles', $roles);   
    }


    //Add Allowance Form
    public function add_allowance_form()
    {
        $roles = DB::table(Config::get('constants.tables.USER'))
            ->select('role')->distinct('role')
            ->get(); 
        return view('allowance/add_allowance')->with('roles', $roles);
    }

    //Adding Allowance
    public function add_allowance(Request $request){       
        $now = new DateTime();

        $job_role = $request->input('job_role');
        $is_allowance = $request->input('is_allowance');
        $is_formula = $request->input('is_formula');
        $name = $request->input('name');
        $charge_percentage = $request->input('charge_percentage');
        $charge_formula = $request->input('charge_formula');
        if($is_formula==1)
            $charge_percentage = '';
        else
            $charge_formula = '';

        if($is_formula==0)
        {
            $arr['job_role'] = array('required');
            $arr['is_allowance'] = array('required');
            $arr['name'] = array('required');
            $arr['is_formula'] = array('required');
            $arr['charge_percentage'] = array('required','regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/');
        }
        else
        {
            $arr['job_role'] = array('required');
            $arr['is_allowance'] = array('required');
            $arr['name'] = array('required');
            $arr['is_formula'] = array('required');
            $arr['charge_formula'] = array('required');
        }

        $this->validate($request,$arr);


        /*$this->validate($request,[
        'job_role'=>array('required'),
        'is_allowance'=>array('required'),
        'name'=>array('required'),
        'charge_percentage'=>array('required', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/')
        ]);*/

        if($is_allowance==1)
            $type = "Allowance";
        else
            $type = "Deduction";


        DB::table(Config::get('constants.tables.ALLOWANCE_DEDUCTION'))->insert(['job_role' => $job_role, 'is_allowance' => $is_allowance, 'name' => $name, 'charge_percentage' => $charge_percentage, 'created_by' => Auth::id(), 'created_date' => $now, 'is_formula' => $is_formula, 'charge_formula' => $charge_formula]);
        $request->session()->flash('success', $type.' added successfully!');

        //Adding the new allowance / deduction to tha existing payrolls
        $allowance_id = DB::getPdo()->lastInsertId();

        $payrolls = DB::table(Config::get('constants.tables.PAYROLL'))   
            ->select('id') 
            ->orderBy('id')
            ->get()->toArray();

        foreach ($payrolls as $payroll)
        {
             DB::table(Config::get('constants.tables.PAYROLL_DETAILS'))->insert(
                ['payroll_id' => $payroll->id, 'type' => $is_allowance, 'allowance_id' => $allowance_id, 'name' => $name, 'percentage' => 0]
            );            
        }

        
        return json_encode(array("Success" => 1));
        //return redirect('allowance-list');        
    }   

    //Update allowance
    public function update_allowance_form(Request $request){
        $id = $request->input('id');
        
        $job_role = $request->input('job_role');
        $is_allowance = $request->input('is_allowance');
        $is_formula = $request->input('is_formula');
        $name = $request->input('name');
        $charge_percentage = $request->input('charge_percentage');
        $charge_formula = $request->input('charge_formula');
        if($is_formula==1)
            $charge_percentage = '';
        else
            $charge_formula = '';

        if($is_formula==0)
        {
            $arr['job_role'] = array('required');
            $arr['is_allowance'] = array('required');
            $arr['name'] = array('required');
            $arr['is_formula'] = array('required');
            $arr['charge_percentage'] = array('required','regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/');
        }
        else
        {
            $arr['job_role'] = array('required');
            $arr['is_allowance'] = array('required');
            $arr['name'] = array('required');
            $arr['is_formula'] = array('required');
            $arr['charge_formula'] = array('required');
        }

        $this->validate($request,$arr);
        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.ALLOWANCE_DEDUCTION')." WHERE id='". $id . "'");

        if(count($successor)==1) {
            DB::table(Config::get('constants.tables.ALLOWANCE_DEDUCTION'))
                ->where('id', $id)
                ->update(['job_role' => $job_role, 'is_allowance' => $is_allowance, 'name' => $name, 'charge_percentage' => $charge_percentage, 'is_formula' => $is_formula, 'charge_formula' => $charge_formula]);
        if($is_allowance==1)
            $type = "Allowance";
        else
            $type = "Deduction";
            $request->session()->flash('success', $type.' updated successfully!');
        } else {
            $request->session()->flash('error', 'No record Found. Please try again!');
        }        
        return json_encode(array("Success" => 1));       
        //return redirect('allowance-list');
    }

    //List of all the allowances - Current Admin User
    public function allowances_list()
    {
        $allowances = DB::table(Config::get('constants.tables.ALLOWANCE_DEDUCTION'))
            ->select('*')
            ->get();
        
        return view('allowance/allowancelist',['allowances'=>$allowances]);        
    }

    //Fill the edit allowance form
    public function fill_allowance_form($id)
    {
        $roles = DB::table(Config::get('constants.tables.USER'))
            ->select('role')->distinct('role')
            ->get(); 

        $allowance_details = DB::table(Config::get('constants.tables.ALLOWANCE_DEDUCTION'))
            ->select('*')
            ->where('id', '=' , $id)            
            ->first();        
        
        return json_encode(array('allowance_details'=>$allowance_details, 'roles'=>$roles, 'id' => $id));
    }

    //Status Change
    public function allowance_status_change(Request $request)
    {
        $id = $request->id;
        $old_status = $request->status;
        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.ALLOWANCE_DEDUCTION')." WHERE id='". $id . "'");

        if(count($successor)==1) {
            $new_status=1;
            $icon = "";
            $btn_clr = "btn-success";
            $btn_title = "Make Inactive";

            if($old_status==1)
            {
                $new_status = 0;
                $icon = "-slash";
                $btn_clr = "btn-warning";
                $btn_title = "Make Active";
            }
            DB::table(Config::get('constants.tables.ALLOWANCE_DEDUCTION'))
                ->where('id', $id)
                ->update(['status' => $new_status]);
            $status_div = '<a onclick="fnStatusChange('.$id.','.$new_status.')"><i class="btn btn-sm '.$btn_clr.' waves-effect icon fa-eye'.$icon.'" aria-hidden="true" title="'.$btn_title.'"></i></a>';
            return json_encode(array("Success" => "1", "status_div" => $status_div));
        }
    }

    //Delete allowance
    public function delete_allowance($arg)
    {
        $successor = DB::table(Config::get('constants.tables.ALLOWANCE_DEDUCTION'))
            ->select('*')
            ->where('id', '=' , $arg)            
            ->first();

        if($successor->is_allowance==1)
            $type = "Allowance";
        else
            $type = "Deduction";

        $tbl_allowance = Config::get('constants.tables.ALLOWANCE_DEDUCTION');
        
            DB::table($tbl_allowance)
            ->where('id', '=', $arg)
            ->delete();
            
            session()->flash('success', $type.' deleted successfully!');
        
        return redirect('allowance-list');

    }

    /***************** Allowances / Deductions end ****************************/

    /***************** Daily Attendance start ****************************/
    
    
    //Daily attendance by employee view page
    public function daily_attendance()
    {
        $now = new DateTime();
        $condition = "";
        $daily_records = array();
        
        $tbl_user = Config::get('constants.tables.USER');
        $employee = DB::table($tbl_user)
            ->select("*")
            ->where("id", Auth::id())
            ->get()->first();
        
        //to check current day is a weekend or not
        $current_day = date("N");
        $weekend_details = DB::table(Config::get('constants.tables.WEEKEND_DAYS'))   
            ->select('*') 
            ->where('weekend_status',1)
            ->get()->toArray();

            $weekends = array();
            foreach($weekend_details as $weekend)
                array_push($weekends,date('N', strtotime($weekend->weekend_day)));
        if(in_array($current_day, $weekends)) {
            $condition="weekend";
        }
        
        
        //to check current date is a holiday or not
        if(empty($condition)) {
            $current_day = date("Y-m-d");
            $holiday_details = DB::select("SELECT * FROM ".Config::get('constants.tables.HOLIDAYS')." WHERE (Month(single_day) = ".date('m')." || (Month(from_date) = ".date('m')." || Month(to_date) = ".date('m').")) and status=1");

            $holidays = array();
            foreach ($holiday_details as $holiday)
            {
                if($holiday->multiple_days==1)
                {
                    $monthenddate = $holiday->to_date;
                    if($holiday->to_date > date("Y-m-t"))
                        $monthenddate = date("Y-m-t");
                    $holidays = array_merge($holidays,$this->createDateRangeArray($holiday->from_date,$monthenddate));
                }
                else
                {
                    array_push($holidays,$holiday->single_day);
                }
            }
            if(in_array($current_day, $holidays)) {
                $condition="holiday";
            }
            //print_r($holidays); exit();
        }
        
        //to check current date leave approved or not
        $leaves_query = DB::select("SELECT * FROM ".Config::get('constants.tables.EMPLOYEE_LEAVES')." WHERE (Month(from_date) = ".date('m')." || Month(to_date) = ".date('m').") AND leave_status=2 AND emp_id=".Auth::id());
        
        foreach ($leaves_query as $leave) {
            if($leave->from_date < date("Y-m-d") && $leave->to_date > date("Y-m-d")){
                $condition="leaveapproved";
                break;
            }
        }
        //echo '<pre>'; print_r($leaves_query); exit();
        
        //to check current date is already punched or not
        if(empty($condition)) {
            $tbl_daily_attendance = Config::get('constants.tables.DAILY_ATTENDANCE');
            $daily_records = DB::table($tbl_daily_attendance)
                ->select("*")
                ->where("emp_id", Auth::id())
                ->where("date", date("Y-m-d"))
                ->get();


            foreach($daily_records as $daily_record) {
                if(!empty($daily_record->clock_out)) {
                    $condition="fullrecordexists";
                } elseif (!empty($daily_record->clock_in)){
                    $condition="halfrecordexists";
                    //echo 'inside if'; exit();
                }
                //echo $daily_record->clock_out; exit();
            }
        }
        return view('payroll/daily_attendance',['employee'=>$employee,'condition'=>$condition])->with('daily_records', $daily_records);
        
    }
    
    //Get selective employee to add / update the basicpay
    public function daily_attendance_update(Request $request){ 
        $employee_id = Auth::id();
        $employee_num = $request->input('num');
        $now = new DateTime();

        //Default Start Time
        $default_start_time = date("Y-m-d 09:00");
        //return $default_start_time;
        $record_id = $request->input('record_id');
        if(empty($record_id)){

            $daily_deduction_percentage = 0;
            $late_time = '';
           // return strtotime($default_start_time).' - '.strtotime(date("Y-m-d H:i:s")).' = '.$default_start_time.' - '.date("Y-m-d H:i:s");
            //If Late Coming
            if(strtotime($default_start_time) < strtotime(date("Y-m-d H:i:s")))
            {
                $late = strtotime(date("Y-m-d H:i:s")) - strtotime($default_start_time);
                $late_min = date("i", $late);
                $late_time = date("i:s", $late);
                //return $late_min;

                $tbl_late_coming = Config::get('constants.tables.DAILY_ATTENDANCE_SETTINGS');

                $sql = "select * from ".$tbl_late_coming." where late_minute >= ".$late_min." and status=1 and role = ".Auth::user()->role." order by late_minute limit 1";
                
                $late_deduct = DB::select($sql);
                if(count($late_deduct)<=0)
                {
                    $sql = "select * from ".$tbl_late_coming." where late_minute = (select max(late_minute) from ".$tbl_late_coming." where status = 1 and role = ".Auth::user()->role.") order by late_minute limit 1";
                    $late_deduct = DB::select($sql);
                }
                if(count($late_deduct)>0)
                    $daily_deduction_percentage = $late_deduct[0]->late_percentage;
                
            }

            DB::table(Config::get('constants.tables.DAILY_ATTENDANCE'))->insert(
                ['emp_id' => $employee_id, 'emp_num' => $employee_num, 'date' => $now, 'clock_in' => $now, 'late_time' => $late_time, 'daily_deduction_percentage' => $daily_deduction_percentage]
            );
            $request->session()->flash('success', 'Attendance In-Time added successfully!');
        } else {
            DB::table(Config::get('constants.tables.DAILY_ATTENDANCE'))
                ->where('id', $record_id)
                ->update(['clock_out' => $now]);
            $request->session()->flash('success', 'Attendance Out-Time added successfully!');
        }
        return redirect('daily-attendance');
        
    }
	
 //Updating daily attendance in the database by people manager of employee
    public function daily_attendance_emp_update(Request $request){ 
        $att_id = $request->input('id');
        $new_intime = $request->input('intime');
        $existing_intime = date("g:i A",strtotime($request->input('ex_intime')));
        $existing_date = date("Y-m-d",strtotime($request->input('ex_intime')));
        $now = new DateTime();
        $diff = round(abs(strtotime($existing_intime) - strtotime($new_intime))/60,2);
        
        $str_fulltime = strtotime("-$diff minutes",strtotime($request->input('ex_intime')));
        $new_fulltime = date("Y-m-d H:i:s",$str_fulltime);
        
        /*echo 'new intime - '.$new_intime;
        echo '<br> existing intime - '. $existing_intime;        
        echo '<br> existing date - '. $existing_date;
        echo '<br> in table - '.$request->input('ex_intime');
        echo '<br> diff - '. $diff;        
        echo '<br> existing strtotime - '. strtotime($request->input('ex_intime'));
        echo '<br> new strtotime      - '. $str_fulltime;
        echo '<br> for db - '. $new_fulltime;
        exit();*/

        //Default Start Time
        $default_start_time = date("Y-m-d 09:00",strtotime($new_fulltime));
        //return $default_start_time;
        

            $daily_deduction_percentage = 0;
            $late_time = '';
            //return strtotime($default_start_time).' - '.strtotime(date("Y-m-d H:i:s",strtotime($new_fulltime))).' = '.$default_start_time.' - '.date("Y-m-d H:i:s");
            //If Late Coming
            if(strtotime($default_start_time) < strtotime(date("Y-m-d H:i:s",strtotime($new_fulltime))))
            {
                $late = strtotime(date("Y-m-d H:i:s",strtotime($new_fulltime))) - strtotime($default_start_time);
                $late_min = date("i", $late);
                $late_time = date("i:s", $late);
                //return $late_min;

                $tbl_late_coming = Config::get('constants.tables.DAILY_ATTENDANCE_SETTINGS');

                $sql = "select * from ".$tbl_late_coming." where late_minute >= ".$late_min." and status=1 and role = ".Auth::user()->role." order by late_minute limit 1";
                
                $late_deduct = DB::select($sql);
                if(count($late_deduct)<=0)
                {
                    $sql = "select * from ".$tbl_late_coming." where late_minute = (select max(late_minute) from ".$tbl_late_coming." where status = 1 and role = ".Auth::user()->role.") order by late_minute limit 1";
                    $late_deduct = DB::select($sql);
                }
                if(count($late_deduct)>0)
                    $daily_deduction_percentage = $late_deduct[0]->late_percentage;
                
            }
            //return '<br><br> deduction - '.$daily_deduction_percentage;
           
            DB::table(Config::get('constants.tables.DAILY_ATTENDANCE'))
                ->where('id', $att_id)
                ->update(['clock_in' => $new_fulltime, 'daily_deduction_percentage' => $daily_deduction_percentage]);
            $request->session()->flash('success', 'Employee Attendance Updated successfully!');
        return json_encode(array("Success" => 1));
        //return redirect('day-att-emp-list');
        
    }
    
     ///Updating daily attendance in the database by people manager of employee
    public function daily_attendance_emp_save(Request $request){ 
        $employee_id = $request->input('save_emp_id');
        $employee_num = $request->input('save_emp_num');
        $att_date = $request->input('save_att_date');
        
//print_r($request); exit();
        //Default Start Time
		$getstartclose=\App\workinghours::first();
        $intime = date("Y-m-d ".$getstartclose['sob'],strtotime($att_date));
		$outtime = date("Y-m-d ".$getstartclose['cob'],strtotime($att_date));
        //return $default_start_time;
        $daily_deduction_percentage = 0;
        $late_time = '';
        DB::table(Config::get('constants.tables.DAILY_ATTENDANCE'))->insert(
                ['emp_id' => $employee_id, 'emp_num' => $employee_num, 'date' => $att_date, 'clock_in' => $intime, 'clock_out' => $outtime, 'late_time' => $late_time, 'daily_deduction_percentage' => $daily_deduction_percentage]
            );
		$request->session()->flash('success', 'Employee Attendance Saved successfully!');            
            
        return json_encode(array("Success" => 1));
        //return redirect('day-att-emp-list');
        
    }
    
    //Get Daily attendance individual view for admin
    public function view_daily_attendance($id='')
    {
        if($id!='')
            $sql = "SELECT * FROM ".Config::get('constants.tables.DAILY_ATTENDANCE')." WHERE (Month(date) = ".date('m', strtotime(' -1 month'))." OR Month(date) = ".date('m').")  AND emp_id=".$id. " ORDER BY id DESC";
        else
            $sql = "SELECT * FROM ".Config::get('constants.tables.DAILY_ATTENDANCE')." WHERE (Month(date) = ".date('m', strtotime(' -1 month'))." OR Month(date) = ".date('m').")  AND emp_id=".Auth::id()." ORDER BY id DESC";
        $daily_attendances = DB::select($sql);         
      
        return view('payroll/view_daily_attendance',['daily_attendances'=>$daily_attendances]);
        
    }
    
    //Daily attendance calendar view of employee for admin and poeple manager
    function view_emp_daily_attendance(Request $request)
    {
        $id = $request->input('id');
         //echo '<pre>'; print_r($id); exit();
        return view('payroll/daily_attendance_emp_calendar',['emp_id'=>$id]);
    }
    
    //calendar function to Get Daily attendance individual view of employee for admin and poeple manager
    public function view_emp_daily_attendance_calendar(Request $request)
    {
        $id = $request->input('emp_id');
        
            $daily_attendances = DB::select("SELECT * FROM ".Config::get('constants.tables.DAILY_ATTENDANCE')." WHERE (Month(date) = ".date('m', strtotime(' -1 month'))." OR Month(date) = ".date('m').")  AND emp_id=".$id . " AND clock_out IS NOT NULL ORDER BY date ASC");         
      //echo '<pre>'; print_r($daily_attendances); exit();
      if(!empty($daily_attendances)) {
          $emp_num = $daily_attendances[0]->emp_num;
      } else {
          $employees = DB::table(Config::get('constants.tables.USER'))
            ->select("*")
            ->where("id", $id)            
            ->get();
          $emp_num = $employees[0]->emp_num;
      }
            
        //Get the list of holidays
        //query for last month
        $holiday_details = DB::select("SELECT * FROM ".Config::get('constants.tables.HOLIDAYS')." WHERE (Month(single_day) = ".date('m', strtotime(' -1 month'))." || (Month(from_date) = ".date('m', strtotime(' -1 month'))." || Month(to_date) = ".date('m', strtotime(' -1 month')).")) and status=1");       
        
        $holidays = array();
        foreach ($holiday_details as $holiday)
        {
            if($holiday->multiple_days==1)
            {
                $monthenddate = $holiday->to_date;
                if($holiday->to_date > date("Y-m-t", strtotime(' -1 month')))
                    $monthenddate = date("Y-m-t", strtotime(' -1 month'));
                $holidays = array_merge($holidays,$this->createDateRangeArray($holiday->from_date,$monthenddate));
            }
            else
            {
                array_push($holidays,$holiday->single_day);
            }
        }
        //query for current month
        $holiday_details = DB::select("SELECT * FROM ".Config::get('constants.tables.HOLIDAYS')." WHERE (Month(single_day) = ".date('m')." || (Month(from_date) = ".date('m')." || Month(to_date) = ".date('m').")) and status=1");   
        foreach ($holiday_details as $holiday)
        {
            if($holiday->multiple_days==1)
            {
                $monthenddate = $holiday->to_date;
                if($holiday->to_date > date("Y-m-t"))
                    $monthenddate = date("Y-m-t");
                $holidays = array_merge($holidays,$this->createDateRangeArray($holiday->from_date,$monthenddate));
            }
            else
            {
                array_push($holidays,$holiday->single_day);
            }
        }
        //echo '<pre>'; print_r($holidays); exit();
        //Get the weekend details
        $weekend_details = DB::table(Config::get('constants.tables.WEEKEND_DAYS'))   
            ->select('*') 
            ->where('weekend_status',1)
            ->get()->toArray();

            $weekends = array();
            foreach($weekend_details as $weekend)
                array_push($weekends,date('N', strtotime($weekend->weekend_day)));
        //echo '<pre>'; print_r($weekends); exit();
        $res_arr = array();

            $cnt = $j =0;
            $strt = date("Y-m-01", strtotime(' -1 month'));
            $i = date("Y-m-d");
            while ( $i >= $strt)
            {   
			  if($strt == date("Y-m-d")) {
                  break;
              }
              
                //echo $strt .'  ' . $daily_attendances[$j]->date . '<br>';
              if(in_array($strt, $holidays)) {              
                  $res_arr[$cnt]['attendance_id'] = '';
                  $res_arr[$cnt]['full_clock_in'] = '';
                    $res_arr[$cnt]['clock_in'] = '';
                    $res_arr[$cnt]['clock_out'] = '';
                    $res_arr[$cnt]['date'] = $strt;
                    $res_arr[$cnt]['title'] = 'Holiday';
                    $res_arr[$cnt]['emp_id'] = $id;
                    $res_arr[$cnt]['emp_num'] = $emp_num;
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['cyan_clr'];
                  
              } else if(in_array(date( 'N', strtotime($strt) ), $weekends)) {
                    $res_arr[$cnt]['attendance_id'] = '';
                  $res_arr[$cnt]['full_clock_in'] = '';
                    $res_arr[$cnt]['clock_in'] = '';
                    $res_arr[$cnt]['clock_out'] = '';
                    $res_arr[$cnt]['date'] = $strt;
                    $res_arr[$cnt]['title'] = 'Weekend';
                    $res_arr[$cnt]['emp_id'] = $id;
                    $res_arr[$cnt]['emp_num'] = $emp_num;
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['cyan_clr'];
                  
              } else if(!empty($daily_attendances) && $strt == $daily_attendances[$j]->date && $daily_attendances[$j]->clock_out != null) {
                  
                    $res_arr[$cnt]['attendance_id'] = $daily_attendances[$j]->id;
                  $res_arr[$cnt]['full_clock_in'] = $daily_attendances[$j]->clock_in != null ? $daily_attendances[$j]->clock_in : '';
                    $res_arr[$cnt]['clock_in'] = $daily_attendances[$j]->clock_in != null ? date("g:i a", strtotime($daily_attendances[$j]->clock_in)) : '';;
                    $res_arr[$cnt]['clock_out'] = $daily_attendances[$j]->clock_out != null ? date("g:i a", strtotime($daily_attendances[$j]->clock_out )): '';
                    $res_arr[$cnt]['date'] = $daily_attendances[$j]->date;
                    $res_arr[$cnt]['title'] = 'Present';
                    $res_arr[$cnt]['emp_id'] = $id;
                    $res_arr[$cnt]['emp_num'] = $emp_num;
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['green_clr'];
                    $j++;
                    if($j == count($daily_attendances))
                        $j--;
               } else {
                   $res_arr[$cnt]['attendance_id'] = '';
                  $res_arr[$cnt]['full_clock_in'] = '';
                    $res_arr[$cnt]['clock_in'] = '';
                    $res_arr[$cnt]['clock_out'] = '';
                    $res_arr[$cnt]['date'] = $strt;
                    $res_arr[$cnt]['title'] = 'Absent';
                    $res_arr[$cnt]['emp_id'] = $id;
                    $res_arr[$cnt]['emp_num'] = $emp_num;
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['red_clr'];
               }
               
               
                   $strt = date("Y-m-d",strtotime("+1 day", strtotime($strt)));
                   $cnt++;
               
            }
            //krsort($res_arr);
            //echo '<pre>'; print_r($res_arr); exit();
        //return view('payroll/view_daily_attendance',['daily_attendances'=>$res_arr]);
        echo json_encode($res_arr);
            exit;
    }
    
    //Daily attendance calendar view for employee
    function view_daily_attendance_calendar(Request $request)
    {
        $id = $request->id;
		if(\Auth::user()->id==$id){
			
		}
		else{
			$id=\Auth::user()->id;
		}
         //echo '<pre>'; print_r($id); exit();
        return view('payroll/daily_attendance_calendar',['emp_id'=>$id]);
    }
	
    
    
    //calendar function for Daily attendance calendar view of employee
    function daily_attendance_calendar(Request $request) 
    {
        $id = $request->input('emp_id');//$id = Auth::id();
        $daily_attendances = DB::select("SELECT * FROM ".Config::get('constants.tables.DAILY_ATTENDANCE')." WHERE (Month(date) = ".date('m').")  AND emp_id=".$id . " AND clock_out IS NOT NULL ORDER BY date ASC");
        
        //echo '<pre>'; print_r($daily_attendances); exit();
        
        //Get the list of holidays
        $holiday_details = DB::select("SELECT * FROM ".Config::get('constants.tables.HOLIDAYS')." WHERE (Month(single_day) = ".date('m')." || (Month(from_date) = ".date('m')." || Month(to_date) = ".date('m').")) and status=1");

        $holidays = array();
        foreach ($holiday_details as $holiday)
        {
            if($holiday->multiple_days==1)
            {
                $monthenddate = $holiday->to_date;
                if($holiday->to_date > date("Y-m-t"))
                    $monthenddate = date("Y-m-t");
                $holidays = array_merge($holidays,$this->createDateRangeArray($holiday->from_date,$monthenddate));
            }
            else
            {
                array_push($holidays,$holiday->single_day);
            }
        }
        //echo '<pre>'; print_r($holidays); exit();
        
        //Get the weekend details
        $weekend_details = DB::table(Config::get('constants.tables.WEEKEND_DAYS'))   
            ->select('*') 
            ->where('weekend_status',1)
            ->get()->toArray();

            $weekends = array();
            foreach($weekend_details as $weekend)
                array_push($weekends,date('N', strtotime($weekend->weekend_day)));
        //echo '<pre>'; print_r($weekends); exit();
        
        $res_arr = array();

            $cnt = $j =0;
            $strt = date("Y-m-01");
            for ($i=0; $i <= 31; $i++)
            {   
			  if($strt == date("Y-m-d")) {
                  break;
              }
              
                //echo $strt .'  ' . $daily_attendances[$j]->date . '<br>';
              if(in_array($strt, $holidays)) {              
                  $res_arr[$cnt]['attendance_id'] = '';
                    $res_arr[$cnt]['clock_in'] = '';
                    $res_arr[$cnt]['clock_out'] = '';
                    $res_arr[$cnt]['date'] = $strt;
                    $res_arr[$cnt]['title'] = 'Holiday';
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['cyan_clr'];
                  
              } else if(in_array(date( 'N', strtotime($strt) ), $weekends)) {
                    $res_arr[$cnt]['attendance_id'] = '';
                    $res_arr[$cnt]['clock_in'] = '';
                    $res_arr[$cnt]['clock_out'] = '';
                    $res_arr[$cnt]['date'] = $strt;
                    $res_arr[$cnt]['title'] = 'Weekend';
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['cyan_clr'];
                  
              } else if(!empty($daily_attendances) && $strt == $daily_attendances[$j]->date && $daily_attendances[$j]->clock_out != null) {
                  
                    $res_arr[$cnt]['attendance_id'] = $daily_attendances[$j]->id;
                    $res_arr[$cnt]['clock_in'] = $daily_attendances[$j]->clock_in != null ? $daily_attendances[$j]->clock_in : '';;
                    $res_arr[$cnt]['clock_out'] = $daily_attendances[$j]->clock_out != null ? $daily_attendances[$j]->clock_out : '';
                    $res_arr[$cnt]['date'] = $daily_attendances[$j]->date;
                    $res_arr[$cnt]['title'] = 'Present';
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['green_clr'];
                    $j++;
                    if($j == count($daily_attendances))
                        $j--;
               } else {
                   $res_arr[$cnt]['attendance_id'] = '';
                    $res_arr[$cnt]['clock_in'] = '';
                    $res_arr[$cnt]['clock_out'] = '';
                    $res_arr[$cnt]['date'] = $strt;
                    $res_arr[$cnt]['title'] = 'Absent';
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['red_clr'];
               }
              
               
                   $strt = date("Y-m-d",strtotime("+1 day", strtotime($strt)));
                   $cnt++;
               
            }
            echo json_encode($res_arr);
            exit;
    }
    
    //Get Daily attendance list view for admin
    public function daily_attendance_list()
    {
        $tbl_user = Config::get('constants.tables.USER');
        $employees = DB::table($tbl_user)
            ->select("*")
			->where("$tbl_user.role", '!=',  Config::get('constants.roles.Admin_User'))
            //->whereIn("$tbl_user.role", [Config::get('constants.roles.People_Manager'), Config::get('constants.roles.Employee')])
            ->orderBy("$tbl_user.id", 'desc')
            ->get();
        
        //echo '<pre>'; print_r($employees); exit();
        return view('payroll/daily_attendance_list',['employees'=>$employees]);
        
        
    }
    
    //Get Daily attendance list view for people manager
    public function day_att_emp_list()
    {
        $tbl_user = Config::get('constants.tables.USER');
        
        $user_id = DB::select("SELECT * FROM $tbl_user WHERE id='".Auth::id()."'");
        //echo '<pre>'; print_r($user_id[0]->id); exit();
        $employees = DB::table($tbl_user)
            ->select("*")
            ->where("$tbl_user.linemanager_id", '=', $user_id[0]->id)
            //->whereIn("$tbl_user.role", [Config::get('constants.roles.People_Manager'), Config::get('constants.roles.Employee')])
            ->orderBy("$tbl_user.id", 'desc')
            ->get();
        
        //echo '<pre>'; print_r($employees); exit();
        return view('payroll/daily_attendance_list',['employees'=>$employees]);
        
        
    }
    
    //Get Daily attendance settings by admin
    public function daily_attendance_settings()
    {
        $tbl_daily_settings = Config::get('constants.tables.DAILY_ATTENDANCE_SETTINGS');
        $settings = DB::table($tbl_daily_settings)
            ->select("*")
            ->get();
			
		$roles = DB::table(Config::get('constants.tables.USER'))
            ->select('role')->distinct('role')
            ->get();

         //   return $roles;
        
        //echo '<pre>'; print_r($settings); exit();
        return view('payroll/daily_attendance_settings',['settings'=>$settings])->with('roles', $roles);
   
    }
    
    //update Daily attendance settings by admin
    public function daily_attendance_settings_update(Request $request)
    {
        
        $this->validate($request,[
            'job_role' => 'required',
            'late_min' =>'required|integer',
            'late_percent' =>'required|numeric',
        ],[
            'late_min.required' => 'The late by minutes field is Required.',
            'late_min.integer' => 'The late by minutes field must be integer.',
            'late_percent.required' => 'The late charge percentage field is Required.',
            'late_percent.numeric' => 'The late charge percentage must be numeric.'
        ]);
        
        $late_minute = $request->input('late_min');
        $job_role = $request->input('job_role');
        $id = $request->input('id');
        $late_percentage = $request->input('late_percent');
        $now = new DateTime();
            DB::table(Config::get('constants.tables.DAILY_ATTENDANCE_SETTINGS'))
                    ->where('id', $id)
                    ->update(['late_minute' => $late_minute, 'late_percentage' => $late_percentage, 'role' => $job_role, 'modify_date' => $now, 'modify_by' => Auth::id()]);
        
        $request->session()->flash('success', 'Daily Attendance Settings Updated successfully!');
        //return redirect('daily-attendance-settings');
        return json_encode(array("Success" => 1));
    }

    //Status Change
    public function daily_attendance_settings_status_change(Request $request)
    {
        $id = $request->id;
        $old_status = $request->status;
        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.DAILY_ATTENDANCE_SETTINGS')." WHERE id='". $id . "'");

        if(count($successor)==1) {
            $new_status=1;
            $icon = "";
            $btn_clr = "btn-success";
            $btn_title = "Make Inactive";

            if($old_status==1)
            {
                $new_status = 0;
                $icon = "-slash";
                $btn_clr = "btn-warning";
                $btn_title = "Make Active";
            }
            DB::table(Config::get('constants.tables.DAILY_ATTENDANCE_SETTINGS'))
                ->where('id', $id)
                ->update(['status' => $new_status]);
            $status_div = '<a onclick="fnStatusChange('.$id.','.$new_status.')"><i class="btn btn-sm '.$btn_clr.' waves-effect icon fa-eye'.$icon.'" aria-hidden="true" title="'.$btn_title.'"></i></a>';
            return json_encode(array("Success" => "1", "status_div" => $status_div));
        }
    }

    //Delete Daily attendance settings
    public function delete_daily_attendance_settings($arg)
    {
        
       
            //delete Daily attendance settings
            DB::table(Config::get('constants.tables.DAILY_ATTENDANCE_SETTINGS'))
            ->where('id', '=', $arg)
            ->delete();
            
            session()->flash('success', 'Daily attendance settings deleted successfully!');
        
        return redirect('daily-attendance-settings');

    }
    
    //add new Daily attendance settings by admin
    public function daily_attendance_settings_add(Request $request)
    {
        
        $this->validate($request,[
            'job_role' => 'required',
            'late_min' =>'required|integer',
            'late_percent' =>'required|numeric',
        ],[
            'late_min.required' => 'The late by minutes field is Required.',
            'late_min.integer' => 'The late by minutes field must be integer.',
            'late_percent.required' => 'The late charge percentage field is Required.',
            'late_percent.numeric' => 'The late charge percentage must be numeric.'
        ]);
        
        $late_minute = $request->input('late_min');
        $job_role = $request->input('job_role');        
        $late_percentage = $request->input('late_percent');
        $now = new DateTime();
        
            DB::table(Config::get('constants.tables.DAILY_ATTENDANCE_SETTINGS'))->insert([
                'role' => $job_role,
                'late_minute' => $late_minute,
                'late_percentage' => $late_percentage,
                'status' => 1,
                'created_date' => $now,
                'created_by' => Auth::id()
            ]);
        
        $request->session()->flash('success', 'Daily Attendance Settings Added successfully!');
        //return redirect('daily-attendance-settings');
        return json_encode(array("Success" => 1));
    }
    
    //Daily attendance settings individual for edit by admin
    public function daily_attendance_settings_edit($id)
    {
        $tbl_daily_settings = Config::get('constants.tables.DAILY_ATTENDANCE_SETTINGS');
        $settings_details = DB::table($tbl_daily_settings)
            ->select("*")
            ->where('id', '=' , $id) 
            ->first();
        
        $roles = DB::table(Config::get('constants.tables.USER'))
            ->select('role')->distinct('role')
            ->get();         
        return json_encode(array('settings_details'=>$settings_details, 'id' => $id, 'roles'=> $roles));
        //return view('payroll/daily_attendance_settings',['settings'=>$settings])->with('roles', $roles);
   
    }
    
    /***************** Daily Attendance end ****************************/

    /***************************Payslip logo / watermark Functions Start*******************************/
    //fill in the payslip logo / watermark form
    public function fill_payslip_details()
    {
        $payslip_details = DB::table(Config::get('constants.tables.SETTINGS'))
            ->select('*')           
            ->first();

        return view('payroll/payslip_details')->with('payslip_details', $payslip_details);;

        //return json_encode(array('Success'=>1, 'payslip_details'=>$payslip_details));
    }

    //update the payslip logo / watermark
    public function update_payslip_details(Request $request){

        $this->validate($request,[
        'watermark_text'=>'required',
        'payslip_logo'=>'mimes:jpg,jpeg,png,gif|max:2048' //2048 = 2 MB
        ]);

        $watermark_text = $request->input('watermark_text');


        $successor = $training_materials = DB::table(Config::get('constants.tables.SETTINGS'))
            ->select('*')
            ->where('id', '1')
            ->first();
            $payslip_logo = $successor->payslip_logo;

        if($request -> file('payslip_logo'))
        {
            $file = $request -> file('payslip_logo');
            $original_file_name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $payslip_logo = strtotime("now").".".$extension;

            if($successor->payslip_logo!='' && file_exists("public/payslip_logo/".$successor->payslip_logo))
                unlink("public/payslip_logo/".$successor->payslip_logo);
            //move uploaded file
            $file->move(public_path('payslip_logo'), $payslip_logo);
        }

        if(count($successor)==1) {
            DB::table(Config::get('constants.tables.SETTINGS'))
                ->where('id', 1)
                ->update(['watermark_text' => $watermark_text, 'payslip_logo' => $payslip_logo]);
            $request->session()->flash('success', 'Payslip logo / watermark updated successfully!');
        } else {
            $request->session()->flash('error', 'No record Found. Please try again!');
        }  

        
        return redirect('edit-payslip-details');  

        //return json_encode(array("Success" => 1));  
    }

    /***************************Payslip logo / watermark Functions end*******************************/

    /***************************Employee Expenses Functions start*******************************/
    //Employee Expenses List
    public function my_expenses_list()
    {
         $expense_list = DB::table(Config::get('constants.tables.EXPENSES'))   
            ->select('*')
                ->where('emp_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->get()->toArray();

        return view('payroll/employee_expenses_list')->with('expense_list', $expense_list);    
    }

    //Adding expense
    public function add_expense(Request $request){       
        $now = new DateTime();

        $expense_details = $request->input('expense_details');
        $expense_charge = $request->input('expense_charge');
        $expense_date = date("Y-m-d", strtotime($request->input('expense_date')));

        $this->validate($request,[
        'expense_details'=>array('required'),
        'expense_charge'=>array('required', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'),
        'expense_date'=>array('required', 'date')
        ]);

        //To save the track of status change we can save the created date and status
        $status_tracks = Config::get('constants.expense_status.APPLIED');
        $status_track_dates = $now;   
        $status_track_by  = Auth::id();


        DB::table(Config::get('constants.tables.EXPENSES'))->insert(['expense_details' => $expense_details,'expense_charge' => $expense_charge,'expense_date' => $expense_date,'created_date' => $now, 'emp_id' => Auth::id(), 'status_tracks' => $status_tracks, 'status_track_dates' => $status_track_dates, 'status_track_by' => $status_track_by]);
        $request->session()->flash('success', 'Expense added successfully!');
        
        return json_encode(array("Success" => 1));
    } 


    //Delete expense
    public function delete_expense($arg)
    {
        $tbl_holiday = Config::get('constants.tables.EXPENSES');
       
            //delete holiday
            DB::table($tbl_holiday)
            ->where('id', '=', $arg)
            ->delete();
            
            session()->flash('success', 'Expense deleted successfully!');
        
        return redirect('my-expenses');

    } 

    //Fill the edit expense form
    public function fill_expense_form($id)
    {
        $expense_details = DB::table(Config::get('constants.tables.EXPENSES'))
            ->select('*')
            ->where('id', '=' , $id)            
            ->first();

        $expense_details->expense_date = date("M d, Y", strtotime($expense_details->expense_date));

        
        return json_encode(array('expense_det'=>$expense_details, 'id' => $id));
    }


    //Update expense
    public function update_expense(Request $request){
        $id = $request->input('id');
        $now = new DateTime();
        $expense_details = $request->input('expense_details');
        $expense_charge = $request->input('expense_charge');
        $expense_date = date("Y-m-d", strtotime($request->input('expense_date')));
        $revise_expense = $request->input('revise_expense');

        $this->validate($request,[
        'expense_details'=>array('required'),
        'expense_charge'=>array('required', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'),
        'expense_date'=>array('required', 'date')
        ]);

        
        
        $successor = DB::table(Config::get('constants.tables.EXPENSES'))
            ->where('id', $id)
            ->first();

        if(count($successor)==1) {
            $status_tracks = $successor->status_tracks;  
            $status_track_dates = $successor->status_track_dates;  
            $status_track_by = $successor->status_track_by;  
            $expense_status = $successor->expense_status;
            $status_updated_by = $successor->status_updated_by;
            $status_updated_on = $successor->status_updated_on; 
            //If Status changed from revise to revised
            if($revise_expense==1)
            {
                $expense_status = Config::get('constants.expense_status.REVISED');
                $status_tracks = $successor->status_tracks.'||||'.$expense_status;
                $status_track_dates = $successor->status_track_dates.'||||'.date("Y-m-d H:i:s");
                $status_track_by = $successor->status_track_by.'||||'.Auth::id();

                $status_updated_by = Auth::id();
                $status_updated_on = $now; 
            }


            DB::table(Config::get('constants.tables.EXPENSES'))
                ->where('id', $id)
                ->update(['expense_details' => $expense_details, 'expense_charge' => $expense_charge, 'expense_date' => $expense_date, 'expense_status' => $expense_status, 'status_updated_by' => $status_updated_by, 'status_updated_on' => $status_updated_on, 'status_tracks' => $status_tracks, 'status_track_dates' => $status_track_dates, 'status_track_by' => $status_track_by]);
            $request->session()->flash('success', 'Expense updated successfully!');
        } else {
            $request->session()->flash('error', 'No record Found. Please try again!');
        }        
        return json_encode(array("Success" => 1));  
    }

    //Admin all employee Expenses List
    public function employee_expenses_list()
    {
        $tbl_expenses = Config::get('constants.tables.EXPENSES');
        $tbl_user = Config::get('constants.tables.USER');   

         $expense_list = DB::table($tbl_expenses)   
            ->select($tbl_expenses.'.*', $tbl_user.'.name as user_name')
            ->join($tbl_user, $tbl_user.'.id', '=', $tbl_expenses.'.emp_id')
            ->orderBy($tbl_expenses.'.id', 'DESC')
            ->get()->toArray();

        
        $sql = "SELECT ".$tbl_expenses.".*, ".$tbl_user.".name as user_name FROM ".$tbl_expenses." join ".$tbl_user." on (".$tbl_user.".id = ".$tbl_expenses.".emp_id)";
        //If the logged in user is admin
        if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
            $sql.=" where (".$tbl_user.".linemanager_id = ".Auth::id()." || ".$tbl_user.".linemanager_id = 0)";
        else
            $sql.=" where ".$tbl_user.".linemanager_id = ".Auth::id();
        $sql.= " order by ".$tbl_expenses.".id desc";

        $expense_list = DB::select($sql);


        return view('payroll/all_employee_expenses_list')->with('expense_list', $expense_list);    
    }

    //Expense Status Change
    public function expense_status_change(Request $request)
    {
        $id = $request->input('expense_id');
        $now = new DateTime();
        $today = Date('Y-m-d');
        $expense_status = $request->input('expense_status');  

        $successor = DB::table(Config::get('constants.tables.EXPENSES'))
            ->where('id', $id)
            ->first();  

        if(count($successor)==1)
        {
            //If admin added any internal diagnosis
            if(Auth::user()->role==Config::get('constants.roles.Admin_User') || Auth::user()->role==Config::get('constants.roles.People_Manager'))
            {
                $this->validate($request,[
                'expense_status'=>'required'
                ]);

                $status_updated_by =$successor->status_updated_by;
                $status_updated_on =$successor->status_updated_on;  
                $status_tracks = $successor->status_tracks;  
                $status_track_dates = $successor->status_track_dates;     
                $status_track_by =  $successor->status_track_by;       

                //If expense status updated
                if($expense_status!=$successor->expense_status)
                {
                    $status_updated_by = Auth::id();
                    $status_updated_on = $now;
                    $status_tracks = $successor->status_tracks.'||||'.$expense_status;
                    $status_track_dates = $successor->status_track_dates.'||||'.date("Y-m-d H:i:s");
                    $status_track_by = $successor->status_track_by.'||||'.Auth::id();
                }   

                $is_approved = 0;
                $approved_by = '';
                $approved_on = '';
                
                //Approved
                if($expense_status==Config::get('constants.expense_status.APPROVED'))
                {
                    $is_approved = 1;
                    $approved_by = Auth::id();
                    $approved_on = $now;                    
                }
            
                DB::table(Config::get('constants.tables.EXPENSES'))
                    ->where('id', $id)
                    ->update(['expense_status' => $expense_status, 'status_updated_by' => $status_updated_by, 'status_updated_on' => $status_updated_on, 'is_approved' => $is_approved, 'approved_by' => $approved_by, 'approved_on' => $approved_on, 'status_tracks' => $status_tracks, 'status_track_dates' => $status_track_dates, 'status_track_by' => $status_track_by]);
                $request->session()->flash('success', 'Expense status updated successfully!');
            }  
        }
        else
        {
            $request->session()->flash('error', 'No record Found. Please try again!');
        }      
       
            if($expense_status==Config::get('constants.expense_status.APPLIED'))
            {
                $icon = "fa-exclamation-circle";
                $clr= "warning";
                $title="Applied";
            }
            else if($expense_status==Config::get('constants.expense_status.APPROVED'))
            {
                $icon = "fa-check";
                $clr= "success";
                $title="Approved";
            }
            else if($expense_status==Config::get('constants.expense_status.REVISE'))
            {
                $icon = "fa-file-text-o";
                $clr= "warning";
                $title="Revise";
            }
            else if($expense_status==Config::get('constants.expense_status.REVISED'))
            {
                $icon = "fa-copy";
                $clr= "success";
                $title="Revised";
            }
            else if($expense_status==Config::get('constants.expense_status.REJECTED'))
            {
                $icon = "fa-close";
                $clr= "danger";
                $title="Rejected";
            }

                 $status_div = '<a onclick="fnStatusChange('.$id.','.$expense_status.')"><i class="btn btn-sm btn-'.$clr.' waves-effect icon '.$icon.'" aria-hidden="true" title="'.$title.'"></i></a>';

            return json_encode(array("Success" => "1", "status_div" => $status_div));
    }


    /***************************Employee Expenses Functions end*******************************/
}