<?php

namespace App\Http\Controllers;

use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use App\Mail\SendNotification;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 protected $project;
	 
	public function  __construct(ProjectRepository $project){
		 if(session('locale')==""){
			session(['locale'=>'en']); 
	
		}
		 
		$this->middleware('auth');
		$this->project=$project;	
	}
    public function index(Request $request)
    {
        //
		$searchdb=\App\Project::where('name','LIKE',"%$request->q%")
								->orWhere('code','LIKE',"%$request->q%")
								->paginate(10);
								
						 
		return view('project.projectmanagement',['projects'=>$searchdb]);
		
	
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        	try{
					
		if(isset($request->tstartdate)){
			//savetask
			$savetask=\App\Task::create(['name'=>$request->taskname,'project_id'=>$request->projectid,'froms'=>self::convdate($request->tstartdate),'tos'=>self::convdate($request->tenddate)]);
			
			return response()->json('success',200);
		}
		//update task
		
				
       $saveproject=\App\Project::insertGetId(['name'=>$request->pname,'code'=>$request->pcode,'start_date'=>self::convdate($request->startdate),'end_est_date'=>self::convdate($request->estendingdate),'remark'=>$request->remark,'client_id'=>$request->clientname]);
	   
	   $managers=$request->projectmanager;
	   foreach($managers as $manager){
		   
		   $saveprojectmanager=\App\projectmanager::create(['projectid'=>$saveproject,'manager_id'=>$manager]);
		   
		   $getmanagerdetails=\App\User::where('id',$manager)
										->select('name','email')->first();
	   //notify project manager
	    $message="A new project has been assigned to you, Click <a href='".\URL::to('/login')."'>here</a> to view project";
			 session(['notifymessage22'=>$message]);
			\Mail::to($getmanagerdetails['email'])->send(new SendNotification($getmanagerdetails['name'],$getmanagerdetails['email'],$message));
	   
	   
	   }
	   
	   
	   return response()->json('success',200);
		}
		catch(\Exception $ex){
			
			return response()->json("Error:$ex",404);
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	
	   
    }
	
	public function convdate($date){
		
		$year=date('Y-m-d',strtotime($date));
		return $year;
	}
	public function getjobtitle($id){
		 return \App\job::where('id',$id)->select('title')->first();
	}
 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		if($id=="management"){
			
			$allproject=$this->project->getallproject();
		//	return $allproject;
			return view('project.projectmanagement',['projects'=>$allproject]);
		
		}
		
	/**	if($id=="orgadata"){
			
		$users=\App\User::select('id','linemanager_id as parentId','name','job_id','phone_num as phone','email as mail','address','image','role')->get();
				
		foreach ($users as $user){
			if($user->role!=3){
					$parentId=$user->parentId;
					//return;
			}
			else{
				$parentId="null";
				//return;
			}
			$userm[]=["id"=>$user->role,"parentId"=>$parentId,"name"=>$user->name,"title"=>self::getjobtitle($user->job_id)['title'],"phone"=>$user->phone,"mail"=>$user->mail,"address"=>trim($user->address),"image"=>$user->image];
			
			
		}
		return response()->json($userm,200);
		} **/
		if($id=="vieworgano"){
			
				$users=\App\User::select('id','linemanager_id as parentId','name','job_id','phone_num as phone','email as mail','address','image','role')->get();
				
		 
			//return $userm;
			return view('adminsettings.organochart',['users'=>$users]);
		}
		if($id=="total"){
			
			$allproject=$this->project->getallproject();
			return view('project.projectmanagement',['projects'=>$allproject]);
		
		}
		if($id=="pending"){
			$allproject=$this->project->getallproject(1);
			return view('project.projectmanagement',['projects'=>$allproject]);
		
		}
		if($id=="completed"){
			
			$allproject=$this->project->getallproject(2);
			 
			return view('project.projectmanagement',['projects'=>$allproject]);
		
		}
		
    }
	public function jobtitle($id){
		
		$title=\App\job::where('id',$id)->select('title')->first();
		return $title['title'];
	}
 	public function getname(Request $request,$type){
				
					if($request->q==""){
						return "";
					}
		if($type==1){
		$name=\App\User::where('name','LIKE','%'.$request->q.'%')
						->select('id','name as text')
						->get();
		}
		else{
			$name=\App\Client::where('name','LIKE','%'.$request->q.'%')
						->select('id','name as text')
						->get();
		}
		
		return $name;
	}
	 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        try{
			if(isset($request->taskid)){
			$modifytask=\App\Task::where('id',$id)->update(['name'=>$request->taskname,'froms'=>self::convdate($request->tstartdate),'tos'=>self::convdate($request->tenddate)]);
			
			return response()->json("success",200);
			
			}
			if(isset($request->projectid)){
				
				$saveproject=\App\Project::where('id',$id)->update(['name'=>$request->pname,'code'=>$request->pcode,'start_date'=>self::convdate($request->startdate),'end_est_date'=>self::convdate($request->estendingdate),'remark'=>$request->remark]);
				
				return response()->json("Success",200);
			}
			//project status update
			if(isset($request->projectme)){
				$checkproject=\App\Project::where('id',$id)->select('status')->first();
			if($checkproject['status']==0){
			$updateproject=\App\Project::where('id',$id)->update(['status'=>1,'actual_ending_date'=>date('Y-m-d')]);
			
			$out=1;
			}
			else{
			$updateproject=\App\Project::where('id',$id)->update(['status'=>0]);
			$out=0;
				
			}
			return response()->json(['start'=>$out,'date'=>date('Y-m-d')],200);
	
				
			}
			
			$checktask=\App\Task::where('id',$id)->select('status')->first();
			if($checktask['status']==0){
			$updatetask=\App\Task::where('id',$id)->update(['status'=>1]);
			$out=1;
			}
			else{
			$updatetask=\App\Task::where('id',$id)->update(['status'=>0]);
			$out=0;
				
			}
			return response()->json($out,200);
		}
		catch(\Exception $ex){
			
			return response()->json("Error:$ex",404);
		}
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
    public function destroy(Request $request,$id)
    {
        try{
			if($request->project=="project"){
			$deleteproject=\App\Project::where('id',$id)->delete();
				
			}
			else{
			$deletetask=\App\Task::where('id',$id)->delete();
			}
			return response("Success",200);
		}
		catch(\Exception $ex){
			
			return response("Error:$ex",404);
		}
    }
}
