<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeeRepository;

class lmabsenceController extends Controller
{
	
	
	protected $employee;
	
	public function __construct(EmployeeRepository $employee){
		
			if(session('locale')==""){
			session(['locale'=>'en']); 
	
		}
		  
		$this->middleware('auth');
		$this->middleware('rights');
		$this->employee=$employee;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    return view('employee.viewrequest');
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
		
		//approve /reject with comment
		if(\Auth::user()->role==2){
        $decisideleave=$this->employee->approvereject(['lm_comments'=>$request->comment,'lm_approve'=>$request->type],$request->id,$request->email);
		}
		else{
			
		 $decisideleave=$this->employee->approvereject(['admin_comments'=>$request->comment,'admin_approve'=>$request->type,'status'=>$request->type],$request->id,$request->email);
			
		}
		return $decisideleave;
    }
	public function sorts($type){
		
		$directemp=$this->employee->lmemployee(\Auth::user()->id, $type);
			$leavecat=$this->employee->leavecat('all');
			
			 return view('employee.viewrequest',['directemps'=>$directemp,'leavecat'=>$leavecat]);
   
		
	}
	
	//searchleave
	public function searchleave(Request $request){
		$directemp=$this->employee->lmemployee(\Auth::user()->id,'search',$request->q);
			$leavecat=$this->employee->leavecat('all');
			
			 return view('employee.viewrequest',['directemps'=>$directemp,'leavecat'=>$leavecat]);
   
		
	}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($route)
    {
		if($route=='absence'){
			$directemp=$this->employee->lmemployee(\Auth::user()->id, 'leave');
			$leavecat=$this->employee->leavecat('all');
			
			 return view('employee.viewrequest',['directemps'=>$directemp,'leavecat'=>$leavecat]);
   
		}
		if($route=='getleave'){
			
			$getleavedate=$this->employee->getleave(\Auth::user()->id);
			return $getleavedate;
		}
		if($route=='leavestat'){
			
			$getcounts=$this->employee->getcount();
			return view('employee.lmviewperformance',['count'=>$getcounts]);
		}
		if($route=='getholiday'){
		$getholiday=$this->employee->getleave(\Auth::user()->id,1);
			return $getholiday;	
			
		}
		if($route=='positions'){
			
		$state=$this->employee->allstate();
		$levels=$this->employee->allevel();
		$types=$this->employee->worktype();
		$specs=$this->employee->workspec();
		$alljob=$this->employee->alljob();
		
		return view('jobmanage.managejoblisting',[
		'states'=>$state,
		'levels'=>$levels,
		'types'=>$types,
		'specs'=>$specs,
		'availablejob'=>$alljob
		
		]);
				//'positions';	
		}
		
		if($route=='applicant'){
			
		return 'positions';	
		
		}if($route=='mail'){
			
		return 'positions';	
		
		}
		
		
		
        //
    }
	
	//leave stat
	public function leavestat(){
		
		$getleavestat=$this->employee->leavestat();
		return $getleavestat;
		
	}
	
	
	public function disptype(Request $request){
		
		$directemp=$this->employee->lmemployee(\Auth::user()->id,'type', $request->type);
		$leavecat=$this->employee->leavecat('all');
		return view('employee.viewrequest',['directemps'=>$directemp,'leavecat'=>$leavecat]);
   		
		
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
}
