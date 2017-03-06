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

class SuccessorController extends  \App\Http\Controllers\Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
        
    //Get list of all the employees under the current people manager
    public function index()
    {
        $employees = DB::select("SELECT * FROM ".Config::get('constants.tables.USER')." WHERE role='".Config::get('constants.roles.Employee')."' and linemanager_id = ".Auth::id()." ORDER BY id DESC");

        $vacancies = DB::table(Config::get('constants.tables.VACANCIES'))
            ->select('*')
            ->where('status',1)
            ->where('is_filled',0)
            ->orderBy('id', 'DESC')
            ->get();

        
        return view('successor/successornominate',['vacancies'=>$vacancies])->with('employees',$employees);
        
    }
    
    public function insert(Request $request){       
        $employee_id = $request->input('employee_id');
        $vacancy_id = $request->input('vacancy_id');
        $comments = $request->input('comments');
        $now = new DateTime();


        $this->validate($request,[
        'vacancy_id'=>'required',
        'employee_id'=>'required']);

        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.SUCCESSOR_NOMINATION')." WHERE employee_id='". $employee_id . "' && vacancy_id = '".$vacancy_id."' ");
        
        if(count($successor)==0) {
            DB::table(Config::get('constants.tables.SUCCESSOR_NOMINATION'))->insert(
                ['people_manager_id' => Auth::id(), 'employee_id' => $employee_id, 'vacancy_id' => $vacancy_id, 'approval_status' => 0, 'nominated_on' => $now, 'candidate_type' => 0, 'comments' => $comments]
            );
            $request->session()->flash('success', 'Successor nominated successfully!');
        } else {
            $request->session()->flash('error', 'Successor already nominated!');
        }
        
        return json_encode(array("Success" => 1));
        //echo "Record inserted successfully.<br/>";
        //echo '<a href="/insert">Click Here</a> to go back.';
    }
    
    public function approve(){   
        $tbl_people_manager = Config::get('constants.tables.USER');
        $tbl_successor = Config::get('constants.tables.SUCCESSOR_NOMINATION');    

        $successors = DB::table($tbl_successor)
            ->join(Config::get('constants.tables.USER').' as u', 'u.id', '=', $tbl_successor.'.employee_id')
            ->join($tbl_people_manager, $tbl_people_manager.'.id', '=', 'u.linemanager_id')
            
            ->select($tbl_successor.'.*', 'u.name as emp_name', 'u.emp_num', 'u.id as employee_id', 'u.dob', 'u.age', 'u.email', $tbl_people_manager.'.name as manager_name')
            ->where($tbl_successor.'.approval_status', '=', 0)
            ->get();


        
        return view('successor/successorapprove',['successors'=>$successors]);
    }
    
    public function update(Request $request){ //12345 this function is used for admin panel to update the successor how are nominated by people manager           
        $id = $request->input('id');
        $now = new DateTime();
        
        $successor =DB::table(Config::get('constants.tables.SUCCESSOR_NOMINATION'))
            ->select('*')
            ->where('id', '=', $id)
            ->first();
        
        if(count($successor)==1) {
            //Need to change the approved vacancy as filled
            $vacancy =DB::table(Config::get('constants.tables.VACANCIES'))
            ->select('*')
            ->where('id', '=', $successor->vacancy_id)
            ->first();

            if(count($vacancy)==1) 
                DB::table(Config::get('constants.tables.VACANCIES'))
                ->where('id', $vacancy->id)
                ->update(['is_filled' => 1, 'filled_on' => $now]);


            DB::table(Config::get('constants.tables.SUCCESSOR_NOMINATION'))
                ->where('id', $id)
                ->update(['approval_status' => 1]);
            $request->session()->flash('success', 'success');
        } else {
            $request->session()->flash('error', 'error');
        }
        
        return redirect('successor-list');
    }

    public function successor_list()
    {
        $tbl_people_manager = Config::get('constants.tables.USER');
        $tbl_successor = Config::get('constants.tables.SUCCESSOR_NOMINATION');
        $tbl_vacancy = Config::get('constants.tables.VACANCIES');

        //If Admin all the nominations will be shown
        if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
            $successors = DB::table($tbl_successor)
            ->join(Config::get('constants.tables.USER').' as u', 'u.id', '=', $tbl_successor.'.employee_id')
            ->join($tbl_people_manager, $tbl_people_manager.'.id', '=', 'u.linemanager_id')
            ->join($tbl_vacancy, $tbl_vacancy.'.id', '=', $tbl_successor.'.vacancy_id')
            ->select($tbl_successor.'.*', 'u.name', 'u.emp_num', $tbl_people_manager.'.name as people_manager', $tbl_vacancy.'.vacant_position', $tbl_vacancy.'.instead_of_whom', $tbl_vacancy.'.is_filled')
            ->orderBy($tbl_successor.'.id', 'DESC')
            ->get();
        //If the people manager logged in then need to show only the employee under them
        else if(Auth::user()->role==Config::get('constants.roles.People_Manager'))
            $successors = DB::table($tbl_successor)
            ->join(Config::get('constants.tables.USER').' as u', 'u.id', '=', $tbl_successor.'.employee_id')
            ->join($tbl_people_manager, $tbl_people_manager.'.id', '=', 'u.linemanager_id')
            ->join($tbl_vacancy, $tbl_vacancy.'.id', '=', $tbl_successor.'.vacancy_id')
            ->select($tbl_successor.'.*', 'u.name', 'u.emp_num', $tbl_people_manager.'.name as people_manager', $tbl_vacancy.'.vacant_position', $tbl_vacancy.'.instead_of_whom', $tbl_vacancy.'.is_filled')
            ->where('u.linemanager_id',Auth::id())
            ->orderBy($tbl_successor.'.id', 'DESC')
            ->get();

        

        //echo '<pre>'; print_r($successors); exit();
        return view('successor/successorlist',['successors'=>$successors]);
        //return view('successorlist');
        
    }
    
    //Get all the employees in hierarchy view
    public function emp_hierarchy()
    {
        
       //Admin Query
        $admins = DB::select("SELECT * FROM ".Config::get('constants.tables.USER')." WHERE role='".Config::get('constants.roles.Admin_User')."'");
        $result_array = array();
        if(count($admins) >= 1) {
            
            foreach($admins as $admin){
                //People Manager Query
                $people_mgrs = DB::select("SELECT * FROM ".Config::get('constants.tables.USER')." WHERE role='".Config::get('constants.roles.People_Manager')."' and linemanager_id = ".$admin->id."");
                
                if(count($people_mgrs) >= 1) {
                    unset($mgr_array);
                    $mgr_array = array();
                    foreach($people_mgrs as $people_mgr){
                        
                        //Employess under the people manager
                        $employees = DB::select("SELECT * FROM ".Config::get('constants.tables.USER')." WHERE role='".Config::get('constants.roles.Employee')."' and linemanager_id = ".$people_mgr->id." ORDER BY emp_num ASC");
                        unset($d_array);
                        $d_array = array();
                        foreach($employees as $employee){
                            
                            //Employee Array
                            $d_array[] = array(                                
                                    'name' =>$employee->name,
                                    'emp_no'=>$employee->emp_num,
                                    'email'=>$employee->email,                                
                            );
                            
                        }
                        //People Manager Array
                        $mgr_array[] = array(                                                                
                                'name' =>$people_mgr->name,
                                'emp_no'=>$people_mgr->emp_num,
                                'employee' => $d_array
                            );
                    }
                    $result_array[$admin->id] = array(
                                'admin' => array(
                                  'name' =>$admin->name,  
                                ),
                                'people_mgr' => $mgr_array
                            );
                }
            }
        }   
        $arr = json_encode(array(array('name' => 'Test','title' => 'Admin',
        'children' => array('name'=> 'Test1 PM', 'title'=> 'pepole manager',
          'children'=> array(array('name'=> 'empone', 'title'=> 'employee' ),
            array( 'name'=> 'emptwo', 'title'=> 'employee'),
              'children'=> array(array('name'=> 'emp3', 'title'=> 'employee' ),
                array('name'=> 'emp4', 'title'=> 'employee' )
              )
            )
          )
        ),

        array('name' => 'test pm',
         'title'=> 'pepole manager' , 

     'children'=> array(array('name'=> 'Tie empone', 'title'=> 'employee' ),
            array( 'name'=> 'Hei emptwo', 'title'=> 'employee',
              'children'=> array(array( 'name'=> 'Pang emp3', 'title'=> 'employee' ),
                array( 'name'=> 'Xiang emp4', 'title'=> 'employee' )
              )
            )
          )
        )));

        

    //)  
        //echo '<pre>'; print_r($result_array); exit();
        //return view('successor/emphierarchy',['employees'=>$result_array]);        
        return view('successor/emphierarchy')->with('employees_arr', $arr);        
    }

    public function emp_hierarchy_json()
    {

        //Admin Query
        $admins = DB::select("SELECT * FROM ".Config::get('constants.tables.USER')." WHERE role='".Config::get('constants.roles.Admin_User')."'");
        $result_array = array();
        if(count($admins) >= 1) {

            $result_array["name"] = "HCMatrix";
            $result_array["title"] = "Employee Hierarchy";

            $admin_array = array();
            $admin_cnt = 0;
            
            foreach($admins as $admin){

                $admin_array[$admin_cnt]["name"] = $admin->name;
                $admin_array[$admin_cnt]["title"] = "Admin";                

                //People Manager Query
                $people_mgrs = DB::select("SELECT * FROM ".Config::get('constants.tables.USER')." WHERE role='".Config::get('constants.roles.People_Manager')."' and linemanager_id = ".$admin->id."");
                if(count($people_mgrs) >= 1) {
                    $mgr_array = array();
                    $pm_array = array();
                    $mgr_cnt=0;
                    foreach($people_mgrs as $people_mgr){
                        //Employess under the people manager
                        $employees = DB::select("SELECT * FROM ".Config::get('constants.tables.USER')." WHERE role='".Config::get('constants.roles.Employee')."' and linemanager_id = ".$people_mgr->id." ORDER BY emp_num ASC");

                        $mgr_array[$mgr_cnt]["name"] = $people_mgr->name;
                        $mgr_array[$mgr_cnt]["people_mgr_id"] = $people_mgr->id;
                        $mgr_array[$mgr_cnt]["title"] = "People Manager";

                        $pm_array[$mgr_cnt]["name"] = $people_mgr->name;
                        $pm_array[$mgr_cnt]["people_mgr_id"] = $people_mgr->id;
                        $pm_array[$mgr_cnt]["title"] = "People Manager";

                        $ppl_mgr_array = array("name" => $people_mgr->name, "title" => "People Manager", "className" => "asso-rd drill-up");
                        $emp_array = array();
                        $emp_cnt = 0;
                        foreach($employees as $employee){
                            $emp_array[$emp_cnt]["name"] = $employee->name;
                            $emp_array[$emp_cnt]["title"] = "Employee";
                            $emp_cnt++;
                        }
                        $ppl_mgr_array["children"] = $emp_array;
                        
                        //$mgr_array[$mgr_cnt]["children"] = $emp_array;
                        if(count($employees)>0)
                        {
                            $mgr_array[$mgr_cnt]["emp_array"] = $ppl_mgr_array;
                            $mgr_array[$mgr_cnt]["className"] = "drill-down asso-rd";
                        }
                        $pm_array[$mgr_cnt]["children"] = $emp_array;
                        $mgr_cnt++;
                    }

                    $admin_array[$admin_cnt]["children"] = $mgr_array;
                    $admin_cnt++;
                }
            }
            $result_array["children"] = $admin_array;
        }  

        return json_encode(array("result_array" => $result_array, "emp_array" => $pm_array));

    }

    /***************** Vacancy start ****************/
    function vacancy_cal_list()
    {
        $vacancies = DB::table(Config::get('constants.tables.VACANCIES'))   
            ->select(Config::get("constants.tables.VACANCIES.").'*')
            ->where(Config::get("constants.tables.VACANCIES").'.status',1)          
            ->get()->toArray();
          
       /* $vacancies = DB::table(Config::get('constants.tables.WEEKEND_DAYS'))   
            ->select(Config::get("constants.tables.WEEKEND_DAYS.").'*')
            ->where(Config::get("constants.tables.WEEKEND_DAYS").'.weekend_status',1)          
            ->get()->toArray();*/
          
            $res_arr = array();

            $cnt=0;
            foreach ($vacancies as $temp_vacancies)
            {     
                //single day vacancy
                if($temp_vacancies->multiple_days==0)
                {
                    $strt = $temp_vacancies->single_day;
                    $res_arr[$cnt]['vacancy_id'] = $temp_vacancies->id;
                    $res_arr[$cnt]['start'] = $temp_vacancies->single_day;
                    $res_arr[$cnt]['title'] = $temp_vacancies->reason;
                }
                //multiple days vacancy
                else
                {
                    $strt = $temp_vacancies->from_date;
                    $res_arr[$cnt]['vacancy_id'] = $temp_vacancies->id;
                    $res_arr[$cnt]['start'] = $temp_vacancies->from_date;
                    $res_arr[$cnt]['end'] = $temp_vacancies->to_date;
                    $res_arr[$cnt]['title'] = $temp_vacancies->reason;
                }
                    
                //If past vacancy
                if($strt < date("Y-m-d"))
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['red_clr'];

                //If current day vacancy
                if($strt == date("Y-m-d"))
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['cyan_clr'];

                //If future vacancy
                if($strt == date("Y-m-d"))
                    $res_arr[$cnt]['backgroundColor'] = $res_arr[$cnt]['borderColor'] = $_POST['green_clr'];

                $strt = date("Y-m-d",strtotime("+1 day", strtotime($strt)));
                $cnt++;
            }
            echo json_encode($res_arr);
            exit;
    }


    //Vacancy List
    public function vacancy_list()
    {
         $vacancies = DB::table(Config::get('constants.tables.VACANCIES'))   
            ->select(Config::get("constants.tables.VACANCIES.").'*') 
            ->orderBy('id', 'DESC')
            ->get()->toArray();

        return view('successor/vacancy_list',['vacancies'=>$vacancies]);  
    }


    //Add Vacancy Form
    public function add_vacancy_form()
    {
        
        return view('vacancy/add_vacancy');
    }

    //Adding Vacancy
    public function add_vacancy(Request $request){       
        $now = new DateTime();

        $vacant_position = $request->input('vacant_position');
        $instead_of_whom = $request->input('instead_of_whom');
        $description = $request->input('description');

        $this->validate($request,[
        'vacant_position'=>'required',
        'instead_of_whom'=>'required',
        'description'=>'required']);

        DB::table(Config::get('constants.tables.VACANCIES'))->insert(
            ['vacant_position' => $vacant_position, 'instead_of_whom' => $instead_of_whom, 'description' => $description, 'created_by' => Auth::id(), 'created_on' => $now]
        );
        $request->session()->flash('success', 'Vacancy added successfully!');
        
        return json_encode(array("Success" => 1));
    }  

    //Update vacancy
    public function update_vacancy_form(Request $request){
        $id = $request->input('id');
       $vacant_position = $request->input('vacant_position');
        $instead_of_whom = $request->input('instead_of_whom');
        $description = $request->input('description');

        $this->validate($request,[
        'vacant_position'=>'required',
        'instead_of_whom'=>'required',
        'description'=>'required']);


        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.VACANCIES')." WHERE id='". $id . "'");

        if(count($successor)==1) {
            DB::table(Config::get('constants.tables.VACANCIES'))
                ->where('id', $id)
                ->update(['vacant_position' => $vacant_position, 'instead_of_whom' => $instead_of_whom, 'description' => $description]);
            $request->session()->flash('success', 'Vacancy updated successfully!');
        } else {
            $request->session()->flash('error', 'No record Found. Please try again!');
        }        
        return json_encode(array("Success" => 1));    
    }

    //List of all the vacancies - Current Admin User
    public function vacancies_list()
    {
        $vacancies = DB::table(Config::get('constants.tables.VACANCIES'))
            ->select('*')
            ->get();
        
        return view('vacancy/vacancylist',['vacancies'=>$vacancies]);        
    }

    //Fill the edit vacancy form
    public function fill_vacancy_form($id)
    {
        $vacancy_details = DB::table(Config::get('constants.tables.VACANCIES'))
            ->select('*')
            ->where('id', '=' , $id)            
            ->first();
      
        return json_encode(array('vacancy_details'=>$vacancy_details, 'id' => $id));
    }

    //Status Change
    public function vacancy_status_change(Request $request)
    {
        $id = $request->id;
        $old_status = $request->status;
        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.VACANCIES')." WHERE id='". $id . "'");

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
            DB::table(Config::get('constants.tables.VACANCIES'))
                ->where('id', $id)
                ->update(['status' => $new_status]);
            $status_div = '<a onclick="fnStatusChange('.$id.','.$new_status.')"><i class="btn btn-sm '.$btn_clr.' waves-effect icon fa-eye'.$icon.'" aria-hidden="true" title="'.$btn_title.'"></i></a>';
            return json_encode(array("Success" => "1", "status_div" => $status_div));
        }
    }

    //Delete vacancy
    public function delete_vacancy($arg)
    {
        $tbl_vacancy = Config::get('constants.tables.VACANCIES');
       
            //delete vacancy
            DB::table($tbl_vacancy)
            ->where('id', '=', $arg)
            ->delete();
            
            session()->flash('success', 'Vacancy deleted successfully!');
        
        return redirect('vacancy-list');

    }


    /***************** Vacnacy end ****************/
}
