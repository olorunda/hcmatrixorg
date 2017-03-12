<?php


namespace App\Repositories;
use DB;
	class ProjectRepository{
		
		
		
		public function getallproject($type=0){
			
			if($type==1){
			 if(\Auth::user()->role==2){
		 $allproject=\DB::table('projects')
						->join('projectmanagers','projects.id','=','projectmanagers.projectid')
						->join('users','projectmanagers.manager_id','=','users.id')
						->where('projectmanagers.manager_id',\Auth::user()->id)
						 ->select('projects.name as name','projects.code','start_date','end_est_date','actual_ending_date','project_task_id','remark','client_id',DB::raw('MAX(projects.id) as id'),'projects.status')
						//->orWhere('users.linemanager_id',\Auth::user()->id)
						->where('projects.status',0)
						 ->groupBy('projects.id')
						->distinct()
						->paginate(10);
		 //\App\Project::where('lm_id',\Auth::User()->id)->orWhere('assigned_to_id',\Auth::User()->id)->orderBy('created_at')->where('status',0)->paginate(10);
		 }
		 elseif(\Auth::user()->role==1){
			 $allproject=\DB::table('projects')
						->join('projectmanagers','projects.id','=','projectmanagers.projectid')
						->join('users','projectmanagers.manager_id','=','users.id')
						->where('projectmanagers.manager_id',\Auth::user()->id)
						 ->select('projects.name as name','projects.code','start_date','end_est_date','actual_ending_date','project_task_id','remark','client_id',DB::raw('MAX(projects.id) as id') ,'projects.status')
						->where('projects.status',0)
						->groupBy('projects.id')
						->orderBy('projects.created_at')
						->paginate(10); 
		 }
		 else{
			 $allproject=\App\Project::where('status',0)->paginate(10);
		 }	
			}
			elseif($type==2){
				
					 if(\Auth::user()->role==2){
		 $allproject=\DB::table('projects')
						->join('projectmanagers','projects.id','=','projectmanagers.projectid')
						->join('users','projectmanagers.manager_id','=','users.id')
						->where([['projectmanagers.manager_id',\Auth::user()->id],['projects.status',1]])
						//->orWhere('users.linemanager_id',\Auth::user()->id)
					 
						 ->select('projects.name as name','projects.code','start_date','end_est_date','actual_ending_date','project_task_id','remark','client_id',DB::raw('MAX(projects.id) as id'),'projects.status')
						->orderBy('projects.created_at')
						->groupBy('projects.id')
						->paginate(10);
		 }
		 elseif(\Auth::user()->role==1){
			 $allproject=\DB::table('projects')
						->join('projectmanagers','projects.id','=','projectmanagers.projectid')
						->join('users','projectmanagers.manager_id','=','users.id')
						->where('projectmanagers.manager_id',\Auth::user()->id)
						 ->select('projects.name as name','projects.code','start_date','end_est_date','actual_ending_date','project_task_id','remark','client_id',DB::raw('MAX(projects.id) as id'), 'projects.status')
						 ->groupBy('projects.id')
						->where('projects.status',1)->orderBy('projects.created_at')->paginate(10); 
		 }
		 else{
			 $allproject=\App\Project::where('status',1)->paginate(10);
		 }
			}
			else{
				
			
		 if(\Auth::user()->role==2){
		 $allproject=\DB::table('projects')
						->join('projectmanagers','projects.id','=','projectmanagers.projectid')
						->join('users','projectmanagers.manager_id','=','users.id')
						->where('projectmanagers.manager_id',\Auth::user()->id)
						 ->select('projects.name as name','projects.code','start_date','end_est_date','actual_ending_date','project_task_id','remark','client_id',DB::raw('MAX(projects.id) as id'), 'projects.status')
						//->orWhere('users.linemanager_id',\Auth::user()->id)
						->groupBy(DB::raw('projects.id'))
						->orderBy('projects.created_at')
						->paginate(10);
		 }
		 elseif(\Auth::user()->role==1){
			 $allproject=\DB::table('projects')
						->join('projectmanagers','projects.id','=','projectmanagers.projectid')
						->join('users','projectmanagers.manager_id','=','users.id')
						->where('projectmanagers.manager_id',\Auth::user()->id)
						 ->select('projects.name as name','projects.code','start_date','end_est_date','actual_ending_date','project_task_id','remark','client_id',DB::raw('MAX(projects.id) as id'),'projects.status')
						 ->groupBy(DB::raw('projects.id'))
						->orderBy('projects.created_at')->paginate(10); 
		 }
		 else{
			 $allproject=\App\Project::paginate(10);
		 }
		 
			}
		 return $allproject;	
		}
		
		public function getname($id){
			$names=[];
			$getmanagers= \App\projectmanager::select('manager_id')->where('projectid',$id)->get();
			//return $getmanagers;
			foreach($getmanagers as $manager){
				
				$getname=\App\User::where('id',$manager->manager_id)->select('name')->first();
				$names[]=['name'=>$getname['name']];
			}
			return $names;
		}
		
		public function gettask($id){
			
			return \App\Task::where('project_id',$id)->get();
		}
		
		public function projectstat($type){
			
			if(\Auth::user()->role==3){
					if($type==0){
						return \App\Project::where('status',0)->count('id');
					}
					elseif($type==1){
						return \App\Project::where('status',1)->count('id');
					
					}
					else{
						return \App\Project::count('id');
					
					}
				
			}
			elseif(\Auth::user()->role==2){
				
						if($type==0){
						return  \DB::table('projects')
						->join('projectmanagers','projects.id','=','projectmanagers.projectid')
						->join('users','projectmanagers.manager_id','=','users.id')
						->where('projectmanagers.manager_id',\Auth::user()->id)
						//->orWhere('users.linemanager_id',\Auth::user()->id)
						->orderBy('projects.created_at')
						->where('projects.status',0)
						 ->distinct('projects.id')
						 
						 ->count('projects.id');
					}
					elseif($type==1){
						return \DB::table('projects')
						->join('projectmanagers','projects.id','=','projectmanagers.projectid')
						->join('users','projectmanagers.manager_id','=','users.id')
						->where('projectmanagers.manager_id',\Auth::user()->id)
						 ->where('projects.status',1)
					     ->distinct('projects.id')
						->count('projects.id');
					
					}
					else{
						return \DB::table('projects')
						->join('projectmanagers','projects.id','=','projectmanagers.projectid')
						->join('users','projectmanagers.manager_id','=','users.id')
						->where('projectmanagers.manager_id',\Auth::user()->id)
					//	->orWhere('users.linemanager_id',\Auth::user()->id)
						 
						  ->distinct('projects.id')
						 ->count('projects.id');
					
					}
			}
			else{
						if($type==0){
						return \DB::table('projects')
						->join('projectmanagers','projects.id','=','projectmanagers.projectid')
						->join('users','projectmanagers.manager_id','=','users.id')
						->where('projectmanagers.manager_id',\Auth::user()->id)
					//	->orWhere('users.linemanager_id',\Auth::user()->id)
						 ->where('projects.status',0)
						 ->count('projects.id');
					}
					elseif($type==1){
						return \DB::table('projects')
						->join('projectmanagers','projects.id','=','projectmanagers.projectid')
						->join('users','projectmanagers.manager_id','=','users.id')
						->where('projectmanagers.manager_id',\Auth::user()->id)
						 
						 ->where('projects.status',1)
						  ->distinct('projects.id')
						 ->count('projects.id');
					
					}
					else{
						return \DB::table('projects')
						->join('projectmanagers','projects.id','=','projectmanagers.projectid')
						->join('users','projectmanagers.manager_id','=','users.id')
						->where('projectmanagers.manager_id',\Auth::user()->id)
						 ->distinct('projects.id')
						 ->count('projects.id');
					
					}
				
			}
			
		}
		
		
		
	}