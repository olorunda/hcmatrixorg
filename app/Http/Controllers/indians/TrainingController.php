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
use Carbon\Carbon ;
//use App\Http\Controllers\Controller;
//use App\Http\Controllers\Session;

class TrainingController extends \App\Http\Controllers\Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
        
    /***************************Training Functions Start*******************************/
    //Add Training Form
    public function add_training_form()
    {
        $roles = DB::table(Config::get('constants.tables.USER'))
            ->select('role')->distinct('role')
            ->get();         

        return view('training/add_training')->with('roles', $roles);
    }

    //Adding Training
    public function add_training(Request $request){       
        $now = new DateTime();

        $job_role = $request->input('job_role');
        $training_name = $request->input('training_name');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $location = $request->input('location');
        $capacity = $request->input('capacity');       

        $this->validate($request,[
        'job_role'=>'required',
        'training_name'=>'required',
        'start_date'=>'required|date|after:yesterday',
        'end_date'=>'required|date|after:yesterday',
        'location'=>'required',
        'capacity'=>'required|integer'
        ],['start_date.after' => 'The start date must be today or later.','end_date.after' => 'The end date must be today or later.']);

        DB::table(Config::get('constants.tables.TRAINING'))->insert(
            ['job_role' => $job_role, 'training_name' => $training_name, 'start_date' => date('Y-m-d',strtotime($start_date)), 'end_date' => date('Y-m-d',strtotime($end_date)), 'location' => $location, 'capacity' => $capacity, 'created_by' => Auth::id(), 'created_date' => $now]
        );
        $request->session()->flash('success', 'Training added successfully!');
        
        return json_encode(array("Success" => 1));
        //return redirect('trainings-list');        
    }  

    //Update training
    public function update_training_form(Request $request){
        $id = $request->input('id');
        $job_role = $request->input('job_role');
        $training_name = $request->input('training_name');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $location = $request->input('location');
        $capacity = $request->input('capacity');

        $this->validate($request,[
        'job_role'=>'required',
        'training_name'=>'required',
        'start_date'=>'required|date|after:yesterday',
        'end_date'=>'required|date|after:yesterday',
        'location'=>'required',
        'capacity'=>'required|integer'
        ],['start_date.after' => 'The start date must be today or later.','end_date.after' => 'The end date must be today or later.']);
        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.TRAINING')." WHERE id='". $id . "'");

        if(count($successor)==1) {
            DB::table(Config::get('constants.tables.TRAINING'))
                ->where('id', $id)
                ->update(['job_role' => $job_role, 'training_name' => $training_name, 'start_date' => date('Y-m-d',strtotime($start_date)), 'end_date' => date('Y-m-d',strtotime($end_date)), 'location' => $location, 'capacity' => $capacity]);
            $request->session()->flash('success', 'Training updated successfully!');
        } else {
            $request->session()->flash('error', 'No record Found. Please try again!');
        }        
        return json_encode(array("Success" => 1));       
        //return redirect('trainings-list');
    }

    //List of all the trainings - Current Admin User
    public function trainings_list()
    {
        $trainings = DB::table(Config::get('constants.tables.TRAINING'))
            ->select('*')
            ->orderBy('id', 'DESC')
            ->get();
        $roles = DB::table(Config::get('constants.tables.USER'))
            ->select('role')->distinct('role')
            ->get();  
        return view('training/traininglist',['trainings'=>$trainings])->with('roles', $roles);        
    }

    //Fill the edit training form
    public function fill_training_form($id)
    {
        $training_details = DB::table(Config::get('constants.tables.TRAINING'))
            ->select('*')
            ->where('id', '=' , $id)            
            ->first();

         $roles = DB::table(Config::get('constants.tables.USER'))
            ->select('role')->distinct('role')
            ->get();  
        //return view('training/add_training',['training_details'=>$training_details])->with('roles', $roles)->with('id', $id);
        $training_details->start_date = date("M d, Y", strtotime($training_details->start_date));
        $training_details->end_date = date("M d, Y", strtotime($training_details->end_date));
        return json_encode(array('training_details'=>$training_details, 'roles' => $roles, 'id' => $id));
    }

    //Status Change
    public function status_change(Request $request)
    {
        $id = $request->id;
        $old_status = $request->status;
        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.TRAINING')." WHERE id='". $id . "'");

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
            DB::table(Config::get('constants.tables.TRAINING'))
                ->where('id', $id)
                ->update(['status' => $new_status]);
            $status_div = '<a onclick="fnStatusChange('.$id.','.$new_status.')"><i class="btn btn-sm '.$btn_clr.' waves-effect icon fa-eye'.$icon.'" aria-hidden="true" title="'.$btn_title.'" ></i></a>';
            return json_encode(array("Success" => "1", "status_div" => $status_div));
        }
    }

    //Delete training
    public function delete_training($arg)
    {
        $tbl_training = Config::get('constants.tables.TRAINING');
		$tbl_training_material = Config::get('constants.tables.TRAINING_MATERIAL');
		$tbl_training_members = Config::get('constants.tables.APPLY_TRAINING');
		$tbl_survey = Config::get('constants.tables.SURVEY');
		
        //checking if any employee registered for the training
		$training_members_count = DB::table($tbl_training_members)
			->select('*')
			->where('training_id', '=', $arg)
			->get()
			->count();
		if($training_members_count > 0)
		{
			session()->flash('error', 'Training cannot be deleted since employees registered for this survey!');
		}
		else
		{
			//delete training
			DB::table($tbl_training)
			->where('id', '=', $arg)
			->delete();
			
			//delete training material
			DB::table($tbl_training_material)
			->where('training_id', '=', $arg)
			->delete();
			
			//delete training survey
			DB::table($tbl_survey)
			->where('training_id', '=', $arg)
			->delete();
			
			session()->flash('success', 'Training deleted successfully!');
		}
		
		return redirect('trainings-list');

    }

    function validateDate($date)
    {   
        $d = Carbon::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }


    //Import Training
    public function import_training(Request $request)
    {
        $this->validate($request,[
        'file_import'=>'required|mimes:xls,xlsx,csv|max:2048'
        ]);

        $file_import = '';
        if($request -> file('file_import'))
        {
            $file = $request -> file('file_import');
            $original_file_name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $file_import = strtotime("now").".".$extension;

            //move uploaded file
            if($file->move(public_path('training_files'), $file_import))
            {

            $path = public_path('training_files/'.$file_import);

            $results = Excel::selectSheetsByIndex(0)->load($path, function($reader)  //selectSheetByIndex(0) to get the first sheet alone
            {            })->toArray();


            $tot_inserted = 0;
            for($i=0;$i<count($results);$i++)
            {
                $valid = "yes";
                //validating the values
                $role = '';

                if(strtolower($results[$i]['role'])=="admin")
                    $role = Config::get('constants.roles.Admin_User');
                if(strtolower($results[$i]['role'])=="people manager")
                    $role = Config::get('constants.roles.People_Manager');
                if(strtolower($results[$i]['role'])=="employee")
                    $role = Config::get('constants.roles.Employee');
                if(strtolower($results[$i]['role'])=="doctor")
                    $role = Config::get('constants.roles.Doctor');
                if(strtolower($results[$i]['role'])=="factory Employee")
                    $role = Config::get('constants.roles.Factory_Employee');
                if($role=='')
                    $valid = "no";

                
                $training_name = $results[$i]['training_name'];
                $location = $results[$i]['location'];
                if($this->validateDate(date("Y-m-d",strtotime($results[$i]['start_date']))))
                    $start_date = date("Y-m-d",strtotime($results[$i]['start_date']));
                else
                    $valid = "no";
                if($this->validateDate(date("Y-m-d",strtotime($results[$i]['end_date']))))
                    $end_date = date("Y-m-d",strtotime($results[$i]['end_date']));
                else
                    $valid = "no";
                //Comparing start and end dates
                if(strtotime($results[$i]['start_date']) >= strtotime($results[$i]['end_date']))
                    $valid = "no";

                if(is_numeric($results[$i]['capacity']))
                    $capacity = $results[$i]['capacity'];
                else
                    $valid = "no";
                
                $status = NULL;
                if(strtolower($results[$i]['status'])=="active")
                    $status = '1';
                if(strtolower($results[$i]['status'])=="inactive")
                    $status = '0';
                if($status==NULL)
                {
                    $valid = "no";
                }

                //Inserting the valid entries
                if($valid == "yes")
                {
                    $now = new DateTime();

                    DB::table(Config::get('constants.tables.TRAINING'))->insert(
            ['job_role' => $role, 'training_name' => $training_name, 'start_date' => $start_date, 'end_date' => $end_date, 'location' => $location, 'capacity' => $capacity, 'created_by' => Auth::id(), 'created_date' => $now]);
                    $tot_inserted++;        
                }                             
            }
            if($tot_inserted>0)
            {
                if($tot_inserted==count($results))
                    $request->session()->flash('success', 'All the trainings are imported successfully!');
                else if($tot_inserted<count($results))
                    $request->session()->flash('success', 'Some of the trainings are imported successfully!');
            }
            else
                $request->session()->flash('error', 'None of the trainings are imported! Please check the values in the excel');
        }
    }
        return redirect('trainings-list'); 
    }
    /***************************Training Functions End*******************************/

    /***************************Training Materials Functions Start*******************************/
    //Add Training Material Form
    public function add_training_material_form()
    {
        $trainings = DB::table(Config::get('constants.tables.TRAINING'))
            ->select('*')->where('status', '=' , 1)     
            ->get();   

        return view('training/add_training_material')->with('trainings', $trainings);
    }

    //Adding Training Material
    public function add_training_material(Request $request){       
        $now = new DateTime();

        $this->validate($request,[
        'training_id'=>'required',
        'reading_type'=>'required',
        'training_material_name'=>'required',
        'training_material'=>'required|mimes:doc,docx,pdf|max:2048' //2048 = 2 MB
        ],
        ['training_id.required' => 'The training name field is required.']);

        $training_material = '';
        if($request -> file('training_material'))
        {
            $file = $request -> file('training_material');
            $original_file_name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $training_material = strtotime("now").".".$extension;
            //move uploaded file
            $file->move(public_path('uploads'), $training_material);


            $training_id = $request->input('training_id');
            $reading_type = $request->input('reading_type');
            $training_material_name = $request->input('training_material_name');
        }

        DB::table(Config::get('constants.tables.TRAINING_MATERIAL'))->insert(
            ['training_id' => $training_id, 'reading_type' => $reading_type, 'training_material_name' => $training_material_name, 'training_material' => $training_material, 'created_by' => Auth::id(), 'created_on' => $now]
        );
        $request->session()->flash('success', 'Training material added successfully!');
        
        return json_encode(array("Success" => 1));
        //return redirect('training-material-list');        
    }  

    //Update training material
    public function update_training_material_form(Request $request){
        $id = $request->input('id');
        $now = new DateTime();
        $training_id = $request->input('training_id');
        $reading_type = $request->input('reading_type');
        $training_material_name = $request->input('training_material_name');

        $this->validate($request,[
        'training_id'=>'required',
        'reading_type'=>'required',
        'training_material_name'=>'required',
        'training_material'=>'mimes:doc,docx,pdf|max:2048' //2048 = 2 MB
        ]);

        
        $successor = $training_materials = DB::table(Config::get('constants.tables.TRAINING_MATERIAL'))
            ->select('*')
            ->where('id', '=', $id)
            ->first();
        $training_material = $successor->training_material;
            
        if($request -> file('training_material'))
        {
            $file = $request -> file('training_material');
            $original_file_name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $training_material = strtotime("now").".".$extension;
           // echo $successor->training_material; die;

            if(file_exists("public/uploads/".$successor->training_material))
                unlink("public/uploads/".$successor->training_material);
            //move uploaded file
            $file->move(public_path('uploads'), $training_material);


            $training_id = $request->input('training_id');
            $reading_type = $request->input('reading_type');
            $training_material_name = $request->input('training_material_name');
        }
        
        

        if(count($successor)==1) {
            DB::table(Config::get('constants.tables.TRAINING_MATERIAL'))
                ->where('id', $id)
                ->update(['training_id' => $training_id, 'reading_type' => $reading_type, 'training_material_name' => $training_material_name, 'training_material' => $training_material]);
            $request->session()->flash('success', 'Training material updated successfully!');
        } else {
            $request->session()->flash('error', 'No record Found. Please try again!');
        }        
        return json_encode(array("Success" => 1));
        //return redirect('training-material-list');
    }

    //List of all the training materials
    public function training_material_list()
    {
        $training_materials = DB::table(Config::get('constants.tables.TRAINING_MATERIAL'))
            ->select('*')
            ->get();
        $trainings = DB::table(Config::get('constants.tables.TRAINING'))
            ->select('*')->where('status', '=' , 1)     
            ->get();  

            $training_materials = DB::table(Config::get('constants.tables.TRAINING_MATERIAL'))
            ->join(Config::get('constants.tables.TRAINING'), Config::get("constants.tables.TRAINING").'.id', '=', Config::get("constants.tables.TRAINING_MATERIAL").'.training_id')
            ->select(Config::get("constants.tables.TRAINING_MATERIAL").'.*', Config::get("constants.tables.TRAINING").'.training_name')
			->orderBy('id', 'DESC')
            ->get();
            //print_r($training_materials); die;

        return view('training/training_material_list',['training_materials'=>$training_materials])->with('trainings', $trainings);        
    }

    //Fill the edit training material form
    public function fill_training_material_form($id)
    {
        $training_materials = DB::table(Config::get('constants.tables.TRAINING_MATERIAL'))
            ->select('*')
            ->where('id', '=' , $id)            
            ->first();

         $trainings = DB::table(Config::get('constants.tables.TRAINING'))
            ->select('*')->where('status', '=' , 1)     
            ->get();  
       // return view('training/add_training_material',['training_materials'=>$training_materials])->with('trainings', $trainings)->with('id', $id);
        return json_encode(array('training_materials'=>$training_materials, 'trainings' => $trainings, 'id' => $id));
    }

    //MaterialStatus Change
    public function material_status_change(Request $request)
    {
        $id = $request->id;
        $old_status = $request->status;
        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.TRAINING_MATERIAL')." WHERE id='". $id . "'");

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
            DB::table(Config::get('constants.tables.TRAINING_MATERIAL'))
                ->where('id', $id)
                ->update(['status' => $new_status]);
            $status_div = '<a onclick="fnStatusChange('.$id.','.$new_status.')"><i class="btn btn-sm '.$btn_clr.' waves-effect icon fa-eye'.$icon.'" aria-hidden="true" title="'.$btn_title.'"></i></a>';
            return json_encode(array("Success" => "1", "status_div" => $status_div));
        }
    }

    //Delete training material
    public function delete_training_material($arg)
    {
       
		$tbl_training_material = Config::get('constants.tables.TRAINING_MATERIAL');
		
        $successor = $training_materials = DB::table(Config::get('constants.tables.TRAINING_MATERIAL'))
            ->select('*')
            ->where('id', '=', $arg)
            ->first();
        if(file_exists("public/uploads/".$successor->training_material))
            unlink("public/uploads/".$successor->training_material);

			//delete training material
			DB::table($tbl_training_material)
			->where('id', '=', $arg)
			->delete();
			
			session()->flash('success', 'Training Material deleted successfully!');
		
		return redirect('training-material-list');

    }

    /***************************Training Materials Functions End*******************************/
    /******************Employee training module************/

    //List of all the trainings for employee
    public function emp_trainings_list()
    {
        $tbl_training = Config::get('constants.tables.TRAINING');
        $tbl_applied = Config::get('constants.tables.APPLY_TRAINING');

        /*$trainings = DB::table(Config::get('constants.tables.TRAINING'))
            ->select('*')
            ->where('job_role', '=' ,Config::get('constants.roles.Employee') )
            ->get();*/

            $sql = "SELECT trainings.* FROM trainings WHERE trainings.id NOT IN (SELECT training_members.training_id FROM training_members where training_members.emp_id=2)";

          /*  $sub_qry = "SELECT ".$tbl_applied.".training_id FROM ".$tbl_applied." where ".$tbl_applied.".emp_id=".Auth::id();
            $sql1 = "SELECT ".$tbl_training.".* FROM ".$tbl_training." WHERE ".$tbl_training.".id NOT IN (".$sub_qry.);*/

            $trainings = DB::select("SELECT $tbl_training.* FROM $tbl_training WHERE $tbl_training.id NOT IN (SELECT $tbl_applied.training_id FROM $tbl_applied where $tbl_applied.emp_id=".Auth::id().") and $tbl_training.job_role = ".Auth::user()->role." ORDER BY $tbl_training.id DESC");


          //$trainings =DB::select("SELECT $tbl_training.* FROM $tbl_training WHERE $tbl_training.id NOT IN (SELECT $tbl_applied.training_id FROM $tbl_applied) and $tbl_applied.emp_id=".Auth::id());

            //echo $trainings; die;

            /*$trainings = DB::table($tbl_training)
            ->select($tbl_training.'.*')
            ->whereNotIn($tbl_training.'.id',($tbl_applied)
            ->select($tbl_applied.'.training_id')
            ->where($tbl_training.'.emp_id', Auth::id()))
            ->where('job_role', '=' ,Config::get('constants.roles.Employee') )
            ->get();*/

            

/*

        $trainings = DB::table($tbl_training)
        ->join ("$tbl_applied", "$tbl_applied."."training_id", '!=', "$tbl_training."."id")
            ->select($tbl_training.'.*')
            ->where($tbl_training.'.job_role', '=' ,Auth::user()->role )
            ->get();*/


          
        return view('emp_training/traininglist',['trainings'=>$trainings]);
        
    }
    
    //Appling for Training by employee
    public function emp_apply_training(Request $request){       
        $now = new DateTime();

        $training_id = $request->input('id'); 
       $already = DB::table(Config::get('constants.tables.APPLY_TRAINING'))            
            ->select('*')
            ->where('emp_id', Auth::id())
            ->where('training_id', $training_id)
            ->get();
       //print_r(count($already)); exit();
       if (count($already) == 1){
           $request->session()->flash('error', 'Training Already Applied');
       }else {
        DB::table(Config::get('constants.tables.APPLY_TRAINING'))->insert(
                 ['emp_id' => Auth::id(), 'training_id' => $training_id, 'status' => 1, 'created_date' => $now]
            );
            $request->session()->flash('success', 'Training Applied successfully!');
       }
        return redirect('emp-trainings-status');
        
    }

    //List of all the trainings for employee
    public function emp_trainings_status()
    {
        $tbl_training = Config::get('constants.tables.TRAINING');
        $tbl_applied = Config::get('constants.tables.APPLY_TRAINING');
        $tbl_material = Config::get('constants.tables.TRAINING_MATERIAL');
        $trainings = DB::table($tbl_applied)
            ->join($tbl_training, $tbl_training.'.id', '=', $tbl_applied.'.training_id')
            ->leftJoin ("$tbl_material", "$tbl_material."."training_id", '=', "$tbl_training."."id")
            ->select("$tbl_applied.*", "$tbl_training.job_role", "$tbl_training.training_name", "$tbl_training.start_date", "$tbl_training.end_date", "$tbl_training.location", "$tbl_training.capacity", "$tbl_training.created_date as training_created_date", "$tbl_training.status as training_status", DB::raw("GROUP_CONCAT($tbl_material.training_material_name) as material_name"), DB::raw("GROUP_CONCAT($tbl_material.training_material) as materials"))
            ->where($tbl_applied.'.emp_id', '=' ,Auth::id() )
            ->orderBy($tbl_applied.'.id', 'DESC')
            ->groupBy("$tbl_training."."id")
            ->get();
          //print_r($trainings); exit();
        return view('emp_training/trainingappliedlist',['trainings'=>$trainings]);
        
    }
    
    //List of all the trainings applied by employee
    public function trainings_applied()
    {
        $tbl_training = Config::get('constants.tables.TRAINING');
        $tbl_applied = Config::get('constants.tables.APPLY_TRAINING');
        $tbl_user = Config::get('constants.tables.USER');
        $trainings = DB::table($tbl_applied)
            ->select("$tbl_applied.*", "$tbl_training.job_role", "$tbl_training.training_name", "$tbl_training.start_date", "$tbl_training.end_date", "$tbl_training.location", "$tbl_training.capacity", "$tbl_training.created_date as training_created_date", "$tbl_training.status as training_status","$tbl_user.emp_num","$tbl_user.name as emp_name","$tbl_user.age")
            ->join($tbl_training, $tbl_training.'.id', '=', $tbl_applied.'.training_id')
            ->join($tbl_user, $tbl_user.'.id', '=', $tbl_applied.'.emp_id')
            ->where($tbl_user.'.linemanager_id', '=' ,Auth::id() )
            ->where($tbl_applied.'.status', '=' ,Config::get('constants.training_status.APPLIED'))            
            ->get();
          //print_r($trainings); exit();
        return view('training/trainingapplied',['trainings'=>$trainings]);
        
    }  

    //Update training applied by employee to another status
    public function applied_status_change(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        $status_id = Config::get('constants.training_status.APPLIED');
        if($status == 'Disapproved'){
            $status_id = Config::get('constants.training_status.NOT_APPROVED');
        } elseif($status == 'Waitlisted') {
            $status_id = Config::get('constants.training_status.WAITING');
        } elseif($status == 'Approve') {
            $status_id = Config::get('constants.training_status.APPROVED');
        }

         $now = new DateTime();
                
            DB::table(Config::get('constants.tables.APPLY_TRAINING'))
                ->where('id', $id)
                ->update(['status' => $status_id, 'approved_by' => Auth::id(), 'approved_date' => $now]);
            $request->session()->flash('success', 'Training updated successfully!');
        
        
        //return redirect('trainings-applied');
          return redirect('enrollments-all');
    }

   //List of training registrations filtered by status passed in parameter
    public function enrollment_list($status)
    {
		$condition = '=';
		if ( $status=='all')	
		{
			//$enr_status = Config::get('constants.training_status.NOT_APPROVED');
            $enr_status = '';
			$title = 'Enrolled Training Status';
            //            $condition = '!=';
		}
		else if( $status=='not-approved')	
		{
			$enr_status = "status = ".Config::get('constants.training_status.NOT_APPROVED');
			$title = 'Not Approved Enrollments';
		}
		else if ( $status=='waiting-list')	
		{
			$enr_status = "status = ".Config::get('constants.training_status.WAITING');
			$title = 'Waiting List Enrollments';
		}
		else if ( $status=='approved')	
		{
			$enr_status = "status = ".Config::get('constants.training_status.APPROVED');
			$title = 'Approved Enrollments';
		}
			
        $tbl_training = Config::get('constants.tables.TRAINING');
        $tbl_applied = Config::get('constants.tables.APPLY_TRAINING');
        $tbl_user = Config::get('constants.tables.USER');
       /* $trainings = DB::table($tbl_applied)
            ->join($tbl_training, $tbl_training.'.id', '=', $tbl_applied.'.training_id')
            ->join($tbl_user, $tbl_user.'.id', '=', $tbl_applied.'.emp_id')
            ->select("$tbl_applied.*", "$tbl_training.job_role", "$tbl_training.training_name", "$tbl_training.start_date", "$tbl_training.end_date", "$tbl_training.location", "$tbl_training.capacity", "$tbl_training.created_date as training_created_date", "$tbl_training.status as training_status", "$tbl_user.name as emp_name", "$tbl_user.emp_num")
			->where($tbl_user.'.linemanager_id', '=' ,Auth::id())
            ->where($tbl_applied.'.status', $condition, $enr_status)
            ->get();*/

            $sql = "select ".$tbl_applied.".*, ".$tbl_training.".`job_role`, ".$tbl_training.".`training_name`, ".$tbl_training.".`start_date`, ".$tbl_training.".`end_date`, ".$tbl_training.".`location`, ".$tbl_training.".`capacity`, ".$tbl_training.".`created_date` as `training_created_date`, ".$tbl_training.".`status` as `training_status`, ".$tbl_user.".`name` as `emp_name`, ".$tbl_user.".`emp_num` from ".$tbl_applied." inner join ".$tbl_training." on ".$tbl_training.".`id` = ".$tbl_applied.".`training_id` inner join ".$tbl_user." on ".$tbl_user.".`id` = ".$tbl_applied.".`emp_id` where ".$tbl_applied.".id!='' ";
            if($enr_status)
                $sql.= $enr_status;

            if(Auth::user()->role==Config::get('constants.roles.People_Manager'))
                $sql.= "and ".$tbl_user.".`linemanager_id` = ".Auth::id()."";
            $sql .= " ORDER BY $tbl_applied.id DESC";
           // return $sql; die;
            $trainings =  DB::select($sql);

               

        //echo '<pre>'; print_r($trainings); exit();
        return view('training/trainingappliedlist-status-filtered',['trainings'=>$trainings, 'title'=>$title]);
        
    }
    
    //sycing training in mail calendar
    public function sync_calendar(Request $request)
    {
		
		
		$tbl_training = Config::get('constants.tables.TRAINING');
        $tbl_applied = Config::get('constants.tables.APPLY_TRAINING');
        $tbl_user = Config::get('constants.tables.USER');
		
		$traning_details = DB::table($tbl_applied)
			->join($tbl_training, $tbl_training.'.id', '=', $tbl_applied.'.training_id')
            ->join($tbl_user, $tbl_user.'.id', '=', $tbl_applied.'.emp_id')
            ->select("$tbl_applied.*", "$tbl_training.job_role", "$tbl_training.training_name", "$tbl_training.start_date", "$tbl_training.end_date", "$tbl_training.location", "$tbl_training.capacity", "$tbl_training.created_date as training_created_date", "$tbl_training.status as training_status", "$tbl_user.name as emp_name", "$tbl_user.emp_num", "$tbl_user.email")
			->where($tbl_applied.'.id', '=' ,$request->id)
            ->get();
		$startdate= strtotime($traning_details[0]->start_date);
		$enddate= strtotime($traning_details[0]->end_date);
		
			
		$from_name='HCM';
		$from_address='noreply@vaiha.in';
		$to_name=$traning_details[0]->emp_name;
		$to_address=$traning_details[0]->email;
		$startTime=date("Y-m-d", $startdate);
		//date('Y-m-d H:i:s', strtotime('+1 day', $startDate));
		$endTime=date("Y-m-d", $enddate);
		$subject=$traning_details[0]->training_name;
		$description='Your training schedule has been synced to your calendar!';
		$location=$traning_details[0]->location;
		
		$result = $this->sendIcalEvent($from_name, $from_address, $to_name, $to_address,  $startTime,  $endTime, $subject, $description, $location);
		
		if($result)
		{
			DB::table($tbl_applied)
                ->where('id', $request->id)
                ->update(['sync_status' => 1]);
            $request->session()->flash('success', 'Training synced successfully!');
			echo json_encode(array('Success' => 1, 'sync_div' => '<span class="btn-sm btn-success" style="padding: 0 5px;"><i class="fa fa-check"></i>Synced</span>'));
		}
		else
		{
			echo json_encode(array('Success' => 0));
		}
	}
    /******************Employee training module************/


    function emp_trainings_calendar()
    {
        return view('emp_training/training_schedule');
    }

    function emp_trainings_schedule()
    {

       // return $_POST['blue_clr']; die;
        /*$schedule = DB::table(Config::get('constants.tables.APPLY_TRAINING'))            
        ->join(Config::get('constants.tables.TRAINING'), Config::get("constants.tables.TRAINING").'.id', '=', Config::get("constants.tables.APPLY_TRAINING").'.training_id')        
            ->select(Config::get("constants.tables.TRAINING.").'training_name as title', Config::get("constants.tables.TRAINING").'.id as tr_id', Config::get("constants.tables.TRAINING").'.location as tr_location', Config::get("constants.tables.TRAINING").'.capacity as tr_capacity', Config::get("constants.tables.TRAINING.").'start_date', Config::get("constants.tables.TRAINING.").'end_date')
            ->where(Config::get("constants.tables.APPLY_TRAINING").'.status', Config::get('constants.training_status.APPROVED'))
            ->where(Config::get("constants.tables.APPLY_TRAINING").'.emp_id', Auth::id())            
            ->get()->toArray();*/

        $schedule = DB::table(Config::get('constants.tables.APPLY_TRAINING'))            
        ->join(Config::get('constants.tables.TRAINING'), Config::get("constants.tables.TRAINING").'.id', '=', Config::get("constants.tables.APPLY_TRAINING").'.training_id')        
            ->select(Config::get("constants.tables.TRAINING.").'training_name as title', Config::get("constants.tables.TRAINING").'.id as tr_id', Config::get("constants.tables.TRAINING").'.location as tr_location', Config::get("constants.tables.TRAINING").'.capacity as tr_capacity', Config::get("constants.tables.TRAINING.").'start_date', Config::get("constants.tables.TRAINING.").'end_date', Config::get("constants.tables.APPLY_TRAINING").'.status as training_status')
            ->where(Config::get("constants.tables.APPLY_TRAINING").'.emp_id', Auth::id())            
            ->get()->toArray();
          
          
            $res_arr = array();

            $cnt=0;
            foreach ($schedule as $temp_schedule)
            {     
                $strt=$temp_schedule->start_date;   
                
               while($strt<=$temp_schedule->end_date)
               {
                    $res_arr[$cnt]['training_id'] = $temp_schedule->tr_id;
                    $res_arr[$cnt]['training_location'] = $temp_schedule->tr_location;
                    $res_arr[$cnt]['training_capacity'] = $temp_schedule->tr_capacity;
                    if($temp_schedule->training_status  == Config::get('constants.training_status.APPLIED'))
                        $res_arr[$cnt]['training_status'] = 'Applied';
                    if($temp_schedule->training_status  == Config::get('constants.training_status.WAITING'))
                        $res_arr[$cnt]['training_status'] = 'Waiting List';
                    if($temp_schedule->training_status  == Config::get('constants.training_status.NOT_APPROVED'))
                        $res_arr[$cnt]['training_status'] = 'Not Approved';
                    if($temp_schedule->training_status  == Config::get('constants.training_status.APPROVED'))
                        $res_arr[$cnt]['training_status'] = 'Approved';
                    $res_arr[$cnt]['title'] = $temp_schedule->title;
                    $res_arr[$cnt]['start'] = $strt;
                    $res_arr[$cnt]['training_period'] = "From <b>".date("M d, Y", strtotime($temp_schedule->start_date))."</b> to <b>".date("M d, Y", strtotime($temp_schedule->end_date))."</b>";

                   
                    /*//If past event
                    if($strt < date("Y-m-d"))
                        $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['red_clr'];

                    //If current day event
                    if($strt == date("Y-m-d"))
                        $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['cyan_clr'];

                    //If future event
                    if($strt == date("Y-m-d"))
                        $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['green_clr'];*/

                    //If training enrollment applied
                    if($temp_schedule->training_status == Config::get('constants.training_status.APPLIED'))
                        $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['blue_clr'];

                    //If training enrollment in waiting list
                    if($temp_schedule->training_status == Config::get('constants.training_status.WAITING'))
                        $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['orange_clr'];

                    //If training enrollment rejected
                    if($temp_schedule->training_status == Config::get('constants.training_status.NOT_APPROVED'))
                        $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['red_clr'];

                    //If training enrollment approved
                    if($temp_schedule->training_status == Config::get('constants.training_status.APPROVED'))
                        $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['green_clr'];


                    $strt = date("Y-m-d",strtotime("+1 day", strtotime($strt)));
                    $cnt++;
               }
            }
            echo json_encode($res_arr);
            exit;
    }
    
    /***** send calendar event to email ******/
	function sendIcalEvent($from_name, $from_address, $to_name, $to_address, $startTime, $endTime, $subject, $description, $location)
	{
    $domain = 'vaiha.in';

    //Create Email Headers
    $mime_boundary = "----Meeting Booking----".MD5(TIME());

    $headers = "From: ".$from_name." <".$from_address.">\n";
    $headers .= "Reply-To: ".$from_name." <".$from_address.">\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
    $headers .= "Content-class: urn:content-classes:calendarmessage\n";
    
    //Create Email Body (HTML)
    $message = "--$mime_boundary\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\n";
    $message .= "Content-Transfer-Encoding: 8bit\n\n";
    $message .= "<html>\n";
    $message .= "<body>\n";
    $message .= '<p>Dear '.$to_name.',</p>';
    $message .= '<p>'.$description.'</p>';
    $message .= "</body>\n";
    $message .= "</html>\n";
    $message .= "--$mime_boundary\r\n";

    $ical = 'BEGIN:VCALENDAR' . "\r\n" .
    'PRODID:-//Microsoft Corporation//Outlook 10.0 MIMEDIR//EN' . "\r\n" .
    'VERSION:2.0' . "\r\n" .
    'METHOD:REQUEST' . "\r\n" .
    'BEGIN:VTIMEZONE' . "\r\n" .
    'TZID:Eastern Time' . "\r\n" .
    'BEGIN:STANDARD' . "\r\n" .
    'DTSTART:20091101T020000' . "\r\n" .
    'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=1SU;BYMONTH=11' . "\r\n" .
    'TZOFFSETFROM:-0400' . "\r\n" .
    'TZOFFSETTO:-0500' . "\r\n" .
    'TZNAME:EST' . "\r\n" .
    'END:STANDARD' . "\r\n" .
    'BEGIN:DAYLIGHT' . "\r\n" .
    'DTSTART:20090301T020000' . "\r\n" .
    'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=2SU;BYMONTH=3' . "\r\n" .
    'TZOFFSETFROM:-0500' . "\r\n" .
    'TZOFFSETTO:-0400' . "\r\n" .
    'TZNAME:EDST' . "\r\n" .
    'END:DAYLIGHT' . "\r\n" .
    'END:VTIMEZONE' . "\r\n" .	
    'BEGIN:VEVENT' . "\r\n" .
    'ORGANIZER;CN="'.$from_name.'":MAILTO:'.$from_address. "\r\n" .
    'ATTENDEE;CN="'.$to_name.'";ROLE=REQ-PARTICIPANT;RSVP=TRUE:MAILTO:'.$to_address. "\r\n" .
    'LAST-MODIFIED:' . date("Ymd\TGis") . "\r\n" .
    'UID:'.date("Ymd\TGis", strtotime($startTime)).rand()."@".$domain."\r\n" .
    'DTSTAMP:'.date("Ymd\TGis"). "\r\n" .
    'DTSTART;TZID="Eastern Time":'.date("Ymd\THis", strtotime($startTime)). "\r\n" .
    'DTEND;TZID="Eastern Time":'.date("Ymd\THis", strtotime($endTime)). "\r\n" .
    'TRANSP:OPAQUE'. "\r\n" .
    'SEQUENCE:1'. "\r\n" .
    'SUMMARY:' . $subject . "\r\n" .
    'LOCATION:' . $location . "\r\n" .
    'CLASS:PUBLIC'. "\r\n" .
    'PRIORITY:5'. "\r\n" .
    'BEGIN:VALARM' . "\r\n" .
    'TRIGGER:-PT15M' . "\r\n" .
    'ACTION:DISPLAY' . "\r\n" .
    'DESCRIPTION:Reminder' . "\r\n" .
    'END:VALARM' . "\r\n" .
    'END:VEVENT'. "\r\n" .
    'END:VCALENDAR'. "\r\n";
    $message .= 'Content-Type: text/calendar;name="meeting.ics";method=REQUEST'."\n";
    $message .= "Content-Transfer-Encoding: 8bit\n\n";
    $message .= $ical;

    if(mail($to_address, $subject, $message, $headers))
    	return true;
    else
    	return false;
    	
	}//end of sendIcalEvent() function
}