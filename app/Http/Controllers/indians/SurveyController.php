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

class SurveyController extends  \App\Http\Controllers\Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
        
    /***************************Survey Functions Start*******************************/
    //Add Survey Form
    public function add_survey_form()
    {
        $trainings = DB::table(Config::get('constants.tables.TRAINING'))
            ->select('*')->where('status', '=' , 1)     
            ->get();         

        return view('survey/add_survey')->with('trainings', $trainings);
    }

 
    //Adding Survey
    public function add_survey(Request $request){       
        $now = new DateTime();

        $input = $request->all();


       //echo '<pre>'; print_r($input); die;

        $arr = array('training_id' =>'required', 'survey_name' =>'required');
        $rule = array();
        $cnt=0;
        foreach($request->input('question') as $key => $val)
        {
            
            /*//$arr['question['.$cnt.']'] = 'required';           
            //$rule['question['.$cnt.'].required'] = 'The question field is required.';
            $arr['answer_option['.$cnt.'][0]'] = 'required';
            //$rule['answer_option['.$cnt.'][0].required'] = 'The answer field is required.';
            $arr['answer_option['.$cnt.'][1]'] = 'required';
            //$rule['answer_option['.$cnt.'][1].required'] = 'The answer field is required.';
            $arr['answer_option['.$cnt.'][2]'] = 'required';
            //$rule['answer_option['.$cnt.'][2].required'] = 'The answer field is required.';
            $arr['answer_option['.$cnt.'][3]'] = 'required';
           // $rule['answer_option['.$cnt.'][3].required'] = 'The answer field is required.';*/
            $arr['question.*'] = 'required';
            $rule['question.*.required'] = 'The question field is required.';
            $arr['answer_option.'.$cnt.'.0'] = 'required';
            $arr['answer_option.'.$cnt.'.1'] = 'required';
            $arr['answer_option.'.$cnt.'.2'] = 'required';
            $arr['answer_option.'.$cnt.'.3'] = 'required';
            $rule['answer_option.'.$cnt.'.0.required'] = 'The answer field is required.';
            $rule['answer_option.'.$cnt.'.1.required'] = 'The answer field is required.';
            $rule['answer_option.'.$cnt.'.2.required'] = 'The answer field is required.';
            $rule['answer_option.'.$cnt.'.3.required'] = 'The answer field is required.';
            $cnt++;

           /* $arr['answer_option.*.1'] = 'required';
            $arr['answer_option.*.2'] = 'required';
            $arr['answer_option.*.3'] = 'required';*/
            //$rule['answer_option.*.*.required'] = 'The answer field is required.';

        }

       // print_r($rule); die;


        $this->validate($request,$arr,$rule);


        //echo $request->input('total_questions'); die;
       
        /*$this->validate($request, [
            'training_id' =>'required',            
            'survey_name' =>'required',  
            'question.*' =>'required',
            'answer_option.*.0' =>'required',
            'answer_option.*.1' =>'required',
            'answer_option.*.2' =>'required',
            'answer_option.*.3' =>'required'

        ],
        ['question.*.required' => 'The question field is required.',
        'answer_option.*.0.required' => 'The answer field 1 is required.',
        'answer_option.*.1.required' => 'The answer field 2 is required.',
        'answer_option.*.2.required' => 'The answer field 3 is required.',
        'answer_option.*.3.required' => 'The answer field 4 is required.'
        ]);*/




        $training_id = $request->input('training_id');
        $survey_name = $request->input('survey_name');
        $total_questions = $request->input('total_questions');
        $question = implode('^', $request->input('question'));  
        $temp_ans = $request->input('answer_option');
        $answer_option = '';
        //for($i=1;$i<= $total_questions; $i++)      
        for($i=0;$i< $total_questions; $i++)      
        {
            $answer_option.= implode('^', $temp_ans[$i]); 
            if($i<$total_questions)
                $answer_option.='^^';
        }


        DB::table(Config::get('constants.tables.SURVEY'))->insert(
            ['training_id' => $training_id, 'survey_name' => $survey_name, 'total_questions' => $total_questions, 'question' => $question, 'answer_option' => $answer_option, 'created_by' => Auth::id(), 'created_date' => $now]
        );
        $request->session()->flash('success', 'Survey added successfully!');
        
        return redirect('survey-list');        
    }  

    //Update survey
    public function update_survey_form(Request $request){
        $id = $request->input('id');
         $this->validate($request, [
            'training_id' =>'required',            
            'survey_name' =>'required',  
            'question.*' =>'required',
            'answer_option.*.0' =>'required',
            'answer_option.*.1' =>'required',
            'answer_option.*.2' =>'required',
            'answer_option.*.3' =>'required'

        ],
        ['question.*.required' => 'The question field is required.',
        'answer_option.*.*.required' => 'The answer field is required.']);


        $training_id = $request->input('training_id');
        $survey_name = $request->input('survey_name');
        $total_questions = $request->input('total_questions');
        $question = implode('^', $request->input('question'));  
        $temp_ans = $request->input('answer_option');
        $answer_option = '';
        for($i=0;$i< $total_questions; $i++)      
        {
            $answer_option.= implode('^', $temp_ans[$i]); 
            if($i<$total_questions)
                $answer_option.='^^';
        }
        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.SURVEY')." WHERE id='". $id . "'");

        if(count($successor)==1) {
            DB::table(Config::get('constants.tables.SURVEY'))
                ->where('id', $id)
                ->update(['training_id' => $training_id, 'survey_name' => $survey_name, 'total_questions' => $total_questions, 'question' => $question, 'answer_option' => $answer_option]);
            $request->session()->flash('success', 'Survey updated successfully!');
        } else {
            $request->session()->flash('error', 'No record Found. Please try again!');
        }        
        return redirect('survey-list');
    }

    //List of all the surveys - Current Admin User
    public function survey_list()
    {
        $surveys = DB::table(Config::get('constants.tables.SURVEY'))
            ->join(Config::get('constants.tables.TRAINING'), Config::get("constants.tables.TRAINING").'.id', '=', Config::get("constants.tables.SURVEY").'.training_id')
            ->select(Config::get("constants.tables.SURVEY").'.*', Config::get("constants.tables.TRAINING").'.training_name')
            ->orderBy('id', 'DESC')
            ->get();

        $trainings = DB::table(Config::get('constants.tables.TRAINING'))
            ->select('*')->where('status', '=' , 1)     
            ->get();  
        return view('survey/surveylist',['surveys'=>$surveys])->with('trainings', $trainings);        
    }

    //Fill the edit survey form
    public function fill_survey_form($id)
    {
        $survey_details = DB::table(Config::get('constants.tables.SURVEY'))
            ->select('*')
            ->where('id', '=' , $id)            
            ->first();

            $answer_array = array();
            $question_array = explode('^',$survey_details->question);
            $temp = explode('^^',$survey_details->answer_option);
            for($i=0;$i<count($temp);$i++)
            {
               $answer_array[$i] =  explode('^',$temp[$i]);
            }   

            //print_r($answer_array)          ; die;

         $trainings = DB::table(Config::get('constants.tables.TRAINING'))
            ->select('*')->where('status', '=' , 1)     
            ->get();    
        return view('survey/add_survey',['survey_details'=>$survey_details])->with('trainings', $trainings)->with('question_array', $question_array)->with('answer_array', $answer_array)->with('id', $id);
    }

    //Status Change
    public function status_change(Request $request)
    {
        $id = $request->id;
        $old_status = $request->status;
        
        $successor = DB::select("SELECT * FROM ".Config::get('constants.tables.SURVEY')." WHERE id='". $id . "'");

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
            DB::table(Config::get('constants.tables.SURVEY'))
                ->where('id', $id)
                ->update(['status' => $new_status]);
            $status_div = '<a onclick="fnStatusChange('.$id.','.$new_status.')"><i class="btn btn-sm '.$btn_clr.' waves-effect icon fa-eye'.$icon.'" aria-hidden="true" title="'.$btn_title.'"></i></a>';
            return json_encode(array("Success" => "1", "status_div" => $status_div));
        }
    }

    //Delete survey
    public function delete_survey($arg)
    {
        $tbl_survey = Config::get('constants.tables.SURVEY');
		$tbl_survey_post = Config::get('constants.tables.SURVEY_POST');
		
        //checking if any employee submitted feedback for the survey
		$survey_post_count = DB::table($tbl_survey_post)
			->select('*')
			->where('survey_id', '=', $arg)
			->get()
			->count();
		if($survey_post_count > 0)
		{
			session()->flash('error', 'Survey cannot be deleted since employees has submitted feedback for this survey!');
		}
		else
		{
			//delete survey
			DB::table($tbl_survey)
			->where('id', '=', $arg)
			->delete();
			
			session()->flash('success', 'Training survey deleted successfully!');
		}
		
		return redirect('survey-list');

    }
    
    //Training survey list for employee
    public function emp_survey_list()
    {
        $emp_id = Auth::id();
        $tbl_trainings = Config::get('constants.tables.TRAINING');
        $tbl_survey = Config::get('constants.tables.SURVEY');
        $tbl_users = Config::get('constants.tables.USER');
        $tbl_applied = Config::get('constants.tables.APPLY_TRAINING');
        $tbl_survey_post = Config::get('constants.tables.SURVEY_POST');

        
        //$surveys = DB::select("SELECT $tbl_survey.*,training.training_name FROM $tbl_survey JOIN (select $tbl_trainings.* from $tbl_trainings LEFT JOIN $tbl_applied ON $tbl_applied.training_id = $tbl_trainings.id WHERE $tbl_applied.emp_id=$emp_id AND $tbl_applied.approved_by IS NOT NULL AND $tbl_trainings.status=1 AND $tbl_applied.status=".Config::get('constants.training_status.APPROVED').")as training on training.id = $tbl_survey.training_id ORDER BY $tbl_survey.id DESC");
		
		$surveys = DB::select("SELECT $tbl_survey_post.id, $tbl_survey.*,training.training_name, survey_post.id as post_id FROM $tbl_survey JOIN (select $tbl_trainings.* from $tbl_trainings LEFT JOIN $tbl_applied ON $tbl_applied.training_id = $tbl_trainings.id WHERE $tbl_applied.emp_id=$emp_id AND $tbl_applied.approved_by IS NOT NULL AND $tbl_trainings.status=1 AND $tbl_applied.status=".Config::get('constants.training_status.APPROVED').")as training on training.id = $tbl_survey.training_id LEFT JOIN (select supo.* from $tbl_survey_post as supo join $tbl_survey as su on supo.survey_id = su.id  and supo.emp_id=$emp_id) as survey_post on survey_post.survey_id = $tbl_survey.id left join $tbl_survey_post on ($tbl_survey_post.survey_id = $tbl_survey.id) group by $tbl_survey.id ORDER BY $tbl_survey.id DESC");
        
        return view('survey/emp_surveylist',['surveys'=>$surveys]);        
    }
    
    //Trainings survey to fill by employee
    public function emp_survey_post(Request $request)
    {
        $tbl_survey = Config::get('constants.tables.SURVEY');
        $survey = DB::table($tbl_survey)            
            ->select("*")
            ->where('id', '=' ,$request->id )
            ->get();
        $trainings = DB::table(Config::get('constants.tables.TRAINING'))
            ->select('*')->where('status', '=' , 1)     
            ->get();  
        return view('survey/surveyfilling',['surveys'=>$survey])->with('trainings', $trainings);
    } 

    //Adding Survey
    public function emp_survey_add(Request $request){       
        $now = new DateTime();
       
        $training_id = $request->input('training_id');
        $survey_id = $request->input('survey_id');
        $emp_id = Auth::id();
        $question = implode('^', $request->input('question'));  
        $answer = implode('^', $request->input('answer'));

        DB::table(Config::get('constants.tables.SURVEY_POST'))->insert(
            ['training_id' => $training_id, 'survey_id' => $survey_id, 'emp_id' => $emp_id, 'question' => $question, 'answer' => $answer, 'status' => 1,
             'created_date' => $now]
       );
        $request->session()->flash('success', 'Filled Survey added successfully!');
        
        return redirect('training-survey-list');        
    }    
    
    //filled in surveys list view
    public function filled_surveys_list(){   
		$tbl_survey_post = Config::get('constants.tables.SURVEY_POST');
		$tbl_trainings = Config::get('constants.tables.TRAINING');
		$tbl_survey = Config::get('constants.tables.SURVEY');
		$tbl_users = Config::get('constants.tables.USER');
		
        $surveys = DB::table($tbl_survey_post)
			->select($tbl_survey_post.'.*', $tbl_survey_post.'.created_date as submitted_date', $tbl_trainings.'.training_name', $tbl_survey.'.survey_name',DB::raw('Count(*) as total_submitted'))
			->join($tbl_trainings, $tbl_trainings.'.id', '=', $tbl_survey_post.'.training_id' )
			->join($tbl_users, $tbl_users.'.id', '=', $tbl_survey_post.'.emp_id' )
			->join($tbl_survey, $tbl_survey.'.id', '=', $tbl_survey_post.'.survey_id' )
            ->groupBy("$tbl_survey_post."."training_id")
			->orderBy("$tbl_survey_post.id", 'desc')	
			->get();
        /*$surveys_count = DB::table($tbl_survey_post)
                ->select(DB::raw('Count(*) as total_submitted, training_id'))
                ->groupBy("training_id")
                ->get()->toarray();*/
		//echo '<pre>';print_r($surveys); exit;
        return view('survey/filled_surveys_list')->with('surveys', $surveys);;
                
    }  
    
    //filled in surveys list view
    public function filled_surveys(Request $request){   
		$training_id = $request->id;
		$tbl_survey_post = Config::get('constants.tables.SURVEY_POST');
		$tbl_trainings = Config::get('constants.tables.TRAINING');
		$tbl_survey = Config::get('constants.tables.SURVEY');
		$tbl_users = Config::get('constants.tables.USER');
		
        $surveys = DB::table($tbl_survey_post)
			->select($tbl_survey_post.'.*', $tbl_survey_post.'.created_date as submitted_date', $tbl_trainings.'.training_name', $tbl_users.'.name as emp_name', $tbl_survey.'.survey_name')
			->join($tbl_trainings, $tbl_trainings.'.id', '=', $tbl_survey_post.'.training_id' )
			->join($tbl_users, $tbl_users.'.id', '=', $tbl_survey_post.'.emp_id' )
			->join($tbl_survey, $tbl_survey.'.id', '=', $tbl_survey_post.'.survey_id' )
			->where($tbl_survey_post.'.training_id', '=' ,$training_id )
			->orderBy("$tbl_survey_post.id", 'desc')
			->get();
		//echo '<pre>';print_r($surveys); exit;
        return view('survey/filled_surveys')->with('surveys', $surveys);;
                
    }    
    
    //filled in surveys indiviual view for admin
    public function filled_survey_view(Request $request){   
        
        $survey_id = $request->id;
        $back_link = $request->back_link;
        $tbl_survey_post = Config::get('constants.tables.SURVEY_POST');
        $tbl_trainings = Config::get('constants.tables.TRAINING');
        $tbl_survey = Config::get('constants.tables.SURVEY');
        $tbl_users = Config::get('constants.tables.USER');
		
        $surveys = DB::table($tbl_survey_post)
			->select($tbl_survey_post.'.*', $tbl_survey_post.'.created_date as submitted_date', $tbl_trainings.'.training_name', $tbl_users.'.name as emp_name', $tbl_survey.'.survey_name')
			->join($tbl_trainings, $tbl_trainings.'.id', '=', $tbl_survey_post.'.training_id' )
			->join($tbl_users, $tbl_users.'.id', '=', $tbl_survey_post.'.emp_id' )
			->join($tbl_survey, $tbl_survey.'.id', '=', $tbl_survey_post.'.survey_id' )
                        ->where($tbl_survey_post.'.id', '=' ,$survey_id )
			->get();
		//echo $survey_id.'<pre>';print_r($surveys); exit;
        return view('survey/filled_survey_view')->with('surveys', $surveys)->with('back_link', $back_link);
                
    }  
    /***************************Survey Functions End*******************************/

}