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

class HealthController extends  \App\Http\Controllers\Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    function validateDate($date)
    {   
        $d = Carbon::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }    
        
    /***************************Diagnosis Functions for doctor Start*******************************/
    
    //Adding Diagnosis
    public function add_diagnosis(Request $request){       
        $now = new DateTime();
        $today = Date('Y-m-d');

        $user_id = $request->input('user_id');
        $diagnosis_description = $request->input('diagnosis_description');
        $prescribed_drugs = $request->input('prescribed_drugs');
        $doctor_recommendation = $request->input('doctor_recommendation');
        $total_leave_days = $request->input('total_leave_days');
        $leave_from = $request->input('leave_from');       
        $leave_to = $request->input('leave_to');  
        $leave_status = $request->input('leave_status');  

        //If doctor added any internal diagnosis
        if(Auth::user()->role==Config::get('constants.roles.Doctor'))
        {
            $startDate = strtotime($request->input('leave_from'));
            $endDate = strtotime($request->input('leave_to'));            

            $temp_val = 'required|integer';
            if($startDate!='' && $endDate!='')
            {
                $days = ($endDate - $startDate) / 86400 + 1;
                $temp_val.='|in:'.$days;
            }

            $arr = array('user_id'=>'required',
            'diagnosis_description'=>'required',
            'prescribed_drugs'=>'required',
            'doctor_recommendation'=>'required','leave_from'=>'required|date|after:yesterday',
                'leave_to'=>'required|date|after:yesterday',
                'leave_status'=>'required');
            $arr['total_leave_days'] = $temp_val;

            $rule = array('leave_from.required' => 'The from date field is required.','leave_to.required' => 'The to date field is required.','leave_from.after' => 'The from date must be today or later.','leave_to.after' => 'The to date must be today or later.','total_leave_days.in' => 'The leave days and duration must match.');

          

          /*  $this->validate($request,[
            'user_id'=>'required',
            'diagnosis_description'=>'required',
            'prescribed_drugs'=>'required',
            'doctor_recommendation'=>'required',
            'total_leave_days'=>'required|integer|same:2',
            'leave_from'=>'required|date|after:yesterday',
                'leave_to'=>'required|date|after:yesterday',
                'leave_status'=>'required'
                ],['leave_from.required' => 'The from date field is required.','leave_to.required' => 'The to date field is required.','leave_from.after' => 'The from date must be today or later.','leave_to.after' => 'The to date must be today or later.']);*/

            $this->validate($request,$arr,$rule);

            DB::table(Config::get('constants.tables.DIAGNOSIS'))->insert(
                ['user_id' => $user_id, 'diagnosis_date' => $today, 'diagnosis_description' => $diagnosis_description, 'prescribed_drugs' => $prescribed_drugs, 'doctor_recommendation' => $doctor_recommendation, 'total_leave_days' => $total_leave_days, 'leave_from' => date('Y-m-d',strtotime($leave_from)), 'leave_to' => date('Y-m-d',strtotime($leave_to)), 'leave_status' => $leave_status, 'external_leave_type' => '0', 'doctor_id' => Auth::id(), 'created_by' => Auth::id(), 'created_date' => $now]
            );
        }
        $request->session()->flash('success', 'Diagnosis added successfully!');
        
        return json_encode(array("Success" => 1)); 
    }  

    //Update diagnosis
    public function update_diagnosis_form(Request $request){
        $id = $request->input('id');
        $now = new DateTime();
        $today = Date('Y-m-d');

        $successor = DB::table(Config::get('constants.tables.DIAGNOSIS'))
            ->where('id', $id)
            ->first();  

        if(count($successor)==1)
        {

            $user_id = $request->input('user_id');
            $diagnosis_description = $request->input('diagnosis_description');
            $prescribed_drugs = $request->input('prescribed_drugs');
            $doctor_recommendation = $request->input('doctor_recommendation');
            $total_leave_days = $request->input('total_leave_days');
            $leave_from = $request->input('leave_from');       
            $leave_to = $request->input('leave_to');  
            $leave_status = $request->input('leave_status');  

            //If doctor added any internal diagnosis
            if(Auth::user()->role==Config::get('constants.roles.Doctor'))
            {
                $startDate = strtotime($request->input('leave_from'));
                $endDate = strtotime($request->input('leave_to'));            

                $temp_val = 'required|integer';
                if($startDate!='' && $endDate!='')
                {
                    $days = ($endDate - $startDate) / 86400 + 1;
                    $temp_val.='|in:'.$days;
                }

                $arr = array('user_id'=>'required',
                'diagnosis_description'=>'required',
                'prescribed_drugs'=>'required',
                'doctor_recommendation'=>'required','leave_from'=>'required|date|after:yesterday',
                    'leave_to'=>'required|date|after:yesterday',
                    'leave_status'=>'required');
                $arr['total_leave_days'] = $temp_val;

                $rule = array('leave_from.required' => 'The from date field is required.','leave_to.required' => 'The to date field is required.','leave_from.after' => 'The from date must be today or later.','leave_to.after' => 'The to date must be today or later.','total_leave_days.in' => 'The leave days and duration must match.');

                /*$this->validate($request,[
                'user_id'=>'required',
                'diagnosis_description'=>'required',
                'prescribed_drugs'=>'required',
                'doctor_recommendation'=>'required',
                'total_leave_days'=>'required|integer',
                'leave_from'=>'required|date|after:yesterday',
                'leave_to'=>'required|date|after:yesterday',
                'leave_status'=>'required'
                ],['leave_from.required' => 'The from date field is required.','leave_to.required' => 'The to date field is required.','leave_from.after' => 'The from date must be today or later.','leave_to.after' => 'The to date must be today or later.']);*/


                $status_updated_by =$successor->status_updated_by;
                $status_updated_on =$successor->status_updated_on;            

                //If leave status updated
                if($leave_status!=$successor->leave_status)
                {
                    $status_updated_by = Auth::id();
                    $status_updated_on = $now;
                }  
            
                DB::table(Config::get('constants.tables.DIAGNOSIS'))
                    ->where('id', $id)
                    ->update(['user_id' => $user_id, 'diagnosis_description' => $diagnosis_description, 'prescribed_drugs' => $prescribed_drugs, 'doctor_recommendation' => $doctor_recommendation, 'total_leave_days' => $total_leave_days, 'leave_from' => date('Y-m-d',strtotime($leave_from)), 'leave_to' => date('Y-m-d',strtotime($leave_to)), 'leave_status' => $leave_status, 'status_updated_by' => $status_updated_by, 'status_updated_on' => $status_updated_on]);
                $request->session()->flash('success', 'Diagnosis updated successfully!');
            }  
        }
        else
        {
            $request->session()->flash('error', 'No record Found. Please try again!');
        }      
        return json_encode(array("Success" => 1));       
    }

    //List of all the diagnosis
    public function diagnosis_list()
    {
        $tbl_employee = Config::get('constants.tables.USER');
        $tbl_doctor = Config::get('constants.tables.USER');
        $tbl_diagnosis = Config::get('constants.tables.DIAGNOSIS');

        $diagnosis = DB::table($tbl_diagnosis)
            ->join($tbl_employee, $tbl_employee.'.id', '=',$tbl_diagnosis.'.user_id')
            ->leftJoin($tbl_doctor.' as d', 'd.id', '=',$tbl_diagnosis.'.doctor_id')
            ->select($tbl_diagnosis.'.*', $tbl_employee.".name as employee_name", "d.name as doctor_name")
            ->get();
        $employees = DB::table(Config::get('constants.tables.USER'))
            ->select('id', 'name')
            ->where('id', '!=',Auth::id())
            ->get();  
        return view('health/employeehealth',['diagnosis'=>$diagnosis])->with('employees', $employees);        
    }

    //List of all the diagnosis of all employees and their status for admin login
    public function sick_leave_request()
    {
        $tbl_employee = Config::get('constants.tables.USER');
        $tbl_doctor = Config::get('constants.tables.USER');
        $tbl_diagnosis = Config::get('constants.tables.DIAGNOSIS');

        $diagnosis = DB::table($tbl_diagnosis)
            ->join($tbl_employee, $tbl_employee.'.id', '=',$tbl_diagnosis.'.user_id')
            ->leftJoin($tbl_doctor.' as d', 'd.id', '=',$tbl_diagnosis.'.doctor_id')
            ->select($tbl_diagnosis.'.*', $tbl_employee.".name as employee_name", "d.name as doctor_name")
            ->get();
       
        return view('health/sickleave',['diagnosis'=>$diagnosis]);        
    }

    //Fill the edit diagnosis form
    public function fill_diagnosis_form($id)
    {
        $diagnosis_details = DB::table(Config::get('constants.tables.DIAGNOSIS'))
            ->select('*')
            ->where('id', '=' , $id)            
            ->first();

         $roles = DB::table(Config::get('constants.tables.USER'))
            ->select('role')->distinct('role')
            ->get();  
        $diagnosis_details->leave_from = date("M d, Y", strtotime($diagnosis_details->leave_from));
        $diagnosis_details->leave_to = date("M d, Y", strtotime($diagnosis_details->leave_to));
        return json_encode(array('diagnosis_details'=>$diagnosis_details, 'roles' => $roles, 'id' => $id));
    }

    //Status Change
    public function status_change(Request $request)
    {
        $id = $request->input('diag_id');
        $now = new DateTime();
        $today = Date('Y-m-d');
        $leave_status = $request->input('leave_status');  

        $successor = DB::table(Config::get('constants.tables.DIAGNOSIS'))
            ->where('id', $id)
            ->first();  

        if(count($successor)==1)
        {
            //If doctor added any internal diagnosis
            if(Auth::user()->role==Config::get('constants.roles.Doctor'))
            {
                $this->validate($request,[
                'leave_status'=>'required'
                ]);

                

                $status_updated_by =$successor->status_updated_by;
                $status_updated_on =$successor->status_updated_on;            

                //If leave status updated
                if($leave_status!=$successor->leave_status)
                {
                    $status_updated_by = Auth::id();
                    $status_updated_on = $now;
                }           

            
            
                DB::table(Config::get('constants.tables.DIAGNOSIS'))
                    ->where('id', $id)
                    ->update(['leave_status' => $leave_status, 'status_updated_by' => $status_updated_by, 'status_updated_on' => $status_updated_on]);
                $request->session()->flash('success', 'Diagnosis status updated successfully!');
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

    public function create_mc($id)
    {
        $now = new DateTime();
        $mc_file = strtotime("now").".pdf";

       $tbl_employee = Config::get('constants.tables.USER');
        $tbl_doctor = Config::get('constants.tables.USER');
        $tbl_diagnosis = Config::get('constants.tables.DIAGNOSIS');

        $certificate_details = DB::table($tbl_diagnosis)
            ->join($tbl_employee, $tbl_employee.'.id', '=',$tbl_diagnosis.'.user_id')
            ->leftJoin($tbl_doctor.' as d', 'd.id', '=',$tbl_diagnosis.'.doctor_id')
            ->select($tbl_diagnosis.'.*', $tbl_employee.".name as employee_name", "d.name as doctor_name")
            ->where($tbl_diagnosis.'.id', '=', $id)
            ->first();

        $pdf = PDF::loadView('medical_certificate', compact('certificate_details'));

        $mc_file_uploaded = PDF::loadView('medical_certificate', compact('certificate_details'))->save(public_path('mcs').'/'.$mc_file);
        if($mc_file_uploaded)
        {
            DB::table(Config::get('constants.tables.DIAGNOSIS'))
                    ->where('id', $id)
                    ->update(['mc_issued' => 1, 'mc_file' => $mc_file, 'mc_issued_by' => Auth::id(), 'mc_issued_on' => $now]);
                    Session::flash('success', 'Medical certificate issued successfully!');

             
                return json_encode(array("Success" => 1));
        }



    $view =  \View::make('medical_certificate', compact('certificate_details'))->render();

    $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

         return PDF::load($view)->output();


        if($file->move(public_path('training_files'), $mc_file))     
            return $pdf->download($mc_file);
    }

    
    /***************************Diagnosis Functions for doctor End*******************************/

    /***************************Diagnosis Functions for employee Start*******************************/
    
    //Adding Diagnosis
    public function add_my_diagnosis(Request $request){       
        $now = new DateTime();
        $today = Date('Y-m-d');

        $diagnosis_description = $request->input('diagnosis_description');
        $prescribed_drugs = $request->input('prescribed_drugs');
        $doctor_recommendation = $request->input('doctor_recommendation');
        $total_leave_days = $request->input('total_leave_days');
        $leave_from = $request->input('leave_from');       
        $leave_to = $request->input('leave_to');  
        $medical_report = $request->input('medical_report');  
        $external_leave_type = $request->input('external_leave_type');

        $startDate = strtotime($request->input('leave_from'));
        $endDate = strtotime($request->input('leave_to'));            

        $temp_val = 'required';
        $days =0;
        if($startDate!='' && $endDate!='')
        {
            $days = ($endDate - $startDate) / 86400 + 1;
            $temp_val.='|in:'.$days;
        }

        $arr = array('diagnosis_description'=>'required',
        'prescribed_drugs'=>'required',
        'doctor_recommendation'=>'required',          
        'leave_from'=>'required|date|after:yesterday',
        'leave_to'=>'required|date|after:yesterday',
        'external_leave_type'=>'required',
        'medical_report'=>'max:2048');
        $arr['total_leave_days'] = $temp_val;

        $rule = array('leave_from.required' => 'The from date field is required.','leave_to.required' => 'The to date field is required.','leave_from.after' => 'The from date must be today or later.','leave_to.after' => 'The to date must be today or later.','total_leave_days.in' => 'The leave days and duration must match.');
        

        //If employee added any of his own diagnosis
        if(Auth::user()->role==Config::get('constants.roles.Employee') || Auth::user()->role==Config::get('constants.roles.Factory_Employee'))
        {
            /*$this->validate($request,[            
            'diagnosis_description'=>'required',
            'prescribed_drugs'=>'required',
            'doctor_recommendation'=>'required',
            'total_leave_days'=>'required|integer',            
            'leave_from'=>'required|date|after:yesterday',
            'leave_to'=>'required|date|after:yesterday',
            'external_leave_type'=>'required',
            'medical_report'=>'max:2048' //2048 = 2 MB
                ],['leave_from.required' => 'The from date field is required.','leave_to.required' => 'The to date field is required.','leave_from.after' => 'The from date must be today or later.','leave_to.after' => 'The to date must be today or later.'] );*/
            $this->validate($request,$arr,$rule);

            $medical_report = '';
            if($request -> file('medical_report'))
            {
                $file = $request -> file('medical_report');
                $original_file_name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                $medical_report = strtotime("now").".".$extension;
                //move uploaded file
                $file->move(public_path('medical_reports'), $medical_report);
            }

            DB::table(Config::get('constants.tables.DIAGNOSIS'))->insert(
                ['user_id' => Auth::id(), 'diagnosis_date' => $today, 'diagnosis_description' => $diagnosis_description, 'prescribed_drugs' => $prescribed_drugs, 'doctor_recommendation' => $doctor_recommendation, 'total_leave_days' => $total_leave_days, 'leave_from' => date('Y-m-d',strtotime($leave_from)), 'leave_to' => date('Y-m-d',strtotime($leave_to)), 'external_leave_type' => $external_leave_type, 'medical_report' => $medical_report, 'leave_status' => 2, 'created_by' => Auth::id(), 'created_date' => $now]
            );
        }
        $request->session()->flash('success', 'Diagnosis added successfully!');
        
        return json_encode(array("Success" => 1));  
    }  

    //Update diagnosis
    public function update_my_diagnosis_form(Request $request){
        $id = $request->input('id');
        $now = new DateTime();
        $today = Date('Y-m-d');

        $successor = DB::table(Config::get('constants.tables.DIAGNOSIS'))
            ->where('id', $id)
            ->first();  

        if(count($successor)==1)
        {
            //If doctor added any internal diagnosis
            if(Auth::user()->role==Config::get('constants.roles.Employee'))
            {

                $diagnosis_description = $request->input('diagnosis_description');
                $prescribed_drugs = $request->input('prescribed_drugs');
                $doctor_recommendation = $request->input('doctor_recommendation');
                $total_leave_days = $request->input('total_leave_days');
                $leave_from = $request->input('leave_from');       
                $leave_to = $request->input('leave_to');  
                $medical_report = $request->input('medical_report');  
                $external_leave_type = $request->input('external_leave_type');    

                $medical_report = $successor->medical_report;

                $startDate = strtotime($request->input('leave_from'));
                $endDate = strtotime($request->input('leave_to'));            

                $temp_val = 'required|integer';
                if($startDate!='' && $endDate!='')
                {
                    $days = ($endDate - $startDate) / 86400 + 1;
                    $temp_val.='|in:'.$days;
                }

                $arr = array('diagnosis_description'=>'required',
                'prescribed_drugs'=>'required',
                'doctor_recommendation'=>'required',          
                'leave_from'=>'required|date|after:yesterday',
                'leave_to'=>'required|date|after:yesterday',
                'external_leave_type'=>'required',
                'medical_report'=>'max:2048');//2048 = 2 MB
                $arr['total_leave_days'] = $temp_val;

                $rule = array('leave_from.required' => 'The from date field is required.','leave_to.required' => 'The to date field is required.','leave_from.after' => 'The from date must be today or later.','leave_to.after' => 'The to date must be today or later.','total_leave_days.in' => 'The leave days and duration must match.');
        

            
                $this->validate($request,$arr,$rule);

            /*    $this->validate($request,[            
            'diagnosis_description'=>'required',
            'prescribed_drugs'=>'required',
            'doctor_recommendation'=>'required',
            'total_leave_days'=>'required|integer',
            'leave_from'=>'required|date|after:yesterday',
            'leave_to'=>'required|date|after:yesterday',
            'external_leave_type'=>'required',
            'medical_report'=>'max:2048' //2048 = 2 MB
                ],['leave_from.required' => 'The from date field is required.','leave_to.required' => 'The to date field is required.','leave_from.after' => 'The from date must be today or later.','leave_to.after' => 'The to date must be today or later.']);*/

            
            
            if($request -> file('medical_report'))
            {
                $file = $request -> file('medical_report');
                $original_file_name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                $medical_report = strtotime("now").".".$extension;
               // echo $successor->medical_report; die;

                if($successor->medical_report!='' && file_exists("public/medical_reports/".$successor->medical_report))
                    unlink("public/medical_reports/".$successor->medical_report);
                //move uploaded file
                $file->move(public_path('medical_reports'), $medical_report);
            }


              
                DB::table(Config::get('constants.tables.DIAGNOSIS'))
                    ->where('id', $id)
                    ->update(['diagnosis_description' => $diagnosis_description, 'prescribed_drugs' => $prescribed_drugs, 'doctor_recommendation' => $doctor_recommendation, 'total_leave_days' => $total_leave_days, 'leave_from' => date('Y-m-d',strtotime($leave_from)), 'leave_to' => date('Y-m-d',strtotime($leave_to)), 'external_leave_type' => $external_leave_type, 'medical_report' => $medical_report]);
                $request->session()->flash('success', 'Diagnosis updated successfully!');
            }  
        }
        else
        {
            $request->session()->flash('error', 'No record Found. Please try again!');
        }      
        return json_encode(array("Success" => 1));    
    }

    //List of all the diagnosis
    public function my_diagnosis_list()
    {
        $tbl_doctor = Config::get('constants.tables.USER');
        $tbl_diagnosis = Config::get('constants.tables.DIAGNOSIS');

        $diagnosis = DB::table($tbl_diagnosis)
            ->where($tbl_diagnosis.'.user_id', '=',Auth::id())
            ->leftJoin($tbl_doctor.' as d', 'd.id', '=',$tbl_diagnosis.'.doctor_id')
            ->select($tbl_diagnosis.'.*', "d.name as doctor_name")
            ->get();
       
        return view('health/employeeowndiagnosis',['diagnosis'=>$diagnosis]);        
    }

    //Fill the edit diagnosis form
    public function fill_my_diagnosis_form($id)
    {
        $diagnosis_details = DB::table(Config::get('constants.tables.DIAGNOSIS'))
            ->select('*')
            ->where('id', '=' , $id)            
            ->first();

         $roles = DB::table(Config::get('constants.tables.USER'))
            ->select('role')->distinct('role')
            ->get();  
        $diagnosis_details->leave_from = date("M d, Y", strtotime($diagnosis_details->leave_from));
        $diagnosis_details->leave_to = date("M d, Y", strtotime($diagnosis_details->leave_to));
        return json_encode(array('diagnosis_details'=>$diagnosis_details, 'roles' => $roles, 'id' => $id));
    }

    //Delete own diagnosis before approval
    //Delete training material
    public function delete_diagnosis($arg)
    {
       
        $tbl_training_material = Config::get('constants.tables.DIAGNOSIS');
        
        $successor = $training_materials = DB::table(Config::get('constants.tables.DIAGNOSIS'))
            ->select('*')
            ->where('id', '=', $arg)
            ->first();
        if($successor->medical_report!='' && file_exists("public/medical_reports/".$successor->medical_report))
            unlink("public/medical_reports/".$successor->medical_report);

            //delete training material
            DB::table($tbl_training_material)
            ->where('id', '=', $arg)
            ->delete();
            
            session()->flash('success', 'Diagnosis deleted successfully!');
        
        return redirect('my-diagnosis-details');

    }


    
    /***************************Diagnosis Functions for employee End*******************************/

}