<?php


namespace App\Repositories;

	class ProjectRepository{
		
		
		
		public function getallproject(){
			
		 if(\Auth::user()->role==2){
		 $allproject=\App\Project::where('lm_id',\Auth::User()->id)->orWhere('assigned_to_id',\Auth::User()->id)->orderBy('created_at')->paginate(10);
		 }
		 elseif(\Auth::user()->role==1){
			 $allproject=\App\Project::where('assigned_to_id',\Auth::User()->id)->orderBy('created_at')->paginate(10); 
		 }
		 else{
			 $allproject=\App\Project::paginate(10);
		 }
		 return $allproject;	
		}
		
		public function getname($id){
			
			return \App\User::select('name','id')->where('id',$id)->first();
			
		}
		
		public function gettask($id){
			
			return \App\Task::where('project_id',$id)->get();
		}
		
		public function projectstat($type){
			
			if(\Auth::user()->role==3){
					if($type==0){
						return \App\Project::count('id');
					}
					elseif($type==1){
						return \App\Project::where('status',1)->count('id');
					
					}
					else{
						return \App\Project::where('status',0)->count('id');
					
					}
				
			}
			elseif(\Auth::user()->role==2){
				
						if($type==0){
						return \App\Project::where('lm_id',\Auth::user()->id)
											->orWhere('assigned_to_id',\Auth::user()->id)
											->orderBy('created_at')
											->count('id');
					}
					elseif($type==1){
						return \App\Project::where('assigned_to_id',\Auth::user()->id)
											->where('status',1)
											->orderBy('created_at')
											->orWhere('lm_id',\Auth::user()->id)->count('id');
					
					}
					else{
						return \App\Project::where('assigned_to_id',\Auth::user()->id)
											->orWhere('lm_id',\Auth::user()->id)
											->orderBy('created_at')
											->where('status',0)
											->count('id');
					
					}
			}
			else{
						if($type==0){
						return \App\Project::where('assigned_to_id',\Auth::user()->id)
											->orderBy('created_at')
											->count('id');
					}
					elseif($type==1){
						return \App\Project::where('assigned_to_id',\Auth::user()->id)
											->orderBy('created_at')
											->where('status',1)->count('id');
					
					}
					else{
						return \App\Project::where('assigned_to_id',\Auth::user()->id)
											 ->orderBy('created_at')
											->where('status',0)
											->count('id');
					
					}
				
			}
			
		}
		
		
		
	}