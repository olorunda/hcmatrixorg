<?php


namespace App\Repositories;

 class XtraRepository{
	 
	 
	 
	 //get folder count
	 public function getfoldercount(){
		 
		 $count=\App\folder::count('id');
		 return $count;
		 
	 }
	 
	 
	 //get document count
	 public function getdocumentcount($userid="e"){
		 if(is_numeric($userid)){
			  $count =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						->join('folders','folders.id','=','empdocs.folder_id')
						->where('users.id',\Auth::user()->id)
						->count('empdocs.id');
		 }
		 else{
		 if(\Auth::user()->role==1){
			  $count =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						->join('folders','folders.id','=','empdocs.folder_id')
						->where('users.id',\Auth::user()->id)
						->count('empdocs.id');
						
			 
		 }
		 elseif(\Auth::user()->role==2){
				 $count =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						->join('folders','folders.id','=','empdocs.folder_id')
						->where('users.linemanager_id',\Auth::user()->id)
						->count('empdocs.id');
			 
		 }
		 else{
		 $count =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						->join('folders','folders.id','=','empdocs.folder_id')
						->count('empdocs.id');
		 }
		 }
		 
		 return $count;
		 
	 }
	 //getfolder
	 public function getfolder($id){
		 
		 return \App\folder::where('id',$id)->select('name')->first()['name'];
		 
	 }
	 //search my document
	 
	 //my document
	 public function mydocument($folderid){
		 
		  $alldocument =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						->where('empdocs.folder_id','=',$folderid)
						->where('empdocs.user_id',\Auth::user()->id)
						->select('empdocs.*','users.name as name')
						->orderBy('empdocs.created_at','desc')
						->paginate(20);
			return $alldocument;
		 
	 }
	 //all document
	 public function alldocument($folderid,$q=0,$mysearch=0){
		 if($folderid=="gen"){
			 $folderid=0;
			 $type="!=";
		 }
		 else{
			 $folderid=$folderid;
			 $type="="; 
		 }
		 
		if(\Auth::user()->role==2){
			if(!is_numeric($q)){
			if(!is_numeric($mysearch)){
				$columncond='users.id';
				
			}
			else{
				$columncond='users.linemanager_id';
				
				
			}
			
			 $alldocument =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						->where('empdocs.folder_id',"$type",$folderid)
						->where($columncond,\Auth::user()->id) 
						->where('empdocs.documentname','like',"%$q%")
						->orderBy('empdocs.created_at','desc')
						->select('empdocs.*','users.name as name')
						->paginate(20);
				if(count($alldocument)==0){
			 $alldocument =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						->where('empdocs.folder_id',"$type",$folderid)
						->where($columncond,\Auth::user()->id) 
						//->where('empdocs.documentname','like',"%$q%")
						->Where('users.name','like',"%$q%")
						//->orWhere('users.email','like',"%$q%")
						->orderBy('empdocs.created_at','desc')
						->select('empdocs.*','users.name as name')
						->paginate(20);
						
						if(count($alldocument)==0){
							
								 $alldocument =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						->where('empdocs.folder_id',"$type",$folderid)
						->where($columncond,\Auth::user()->id) 
						//->where('empdocs.documentname','like',"%$q%")
						//->orWhere('users.name','like',"%$q%")
						->Where('users.email','like',"%$q%")
						->orderBy('empdocs.created_at','desc')
						->select('empdocs.*','users.name as name')
						->paginate(20);
						}
				}
				
		
						
			}
			else{
		 $alldocument =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						->where('empdocs.folder_id',"$type",$folderid)
						->where('users.linemanager_id',\Auth::user()->id)
						->select('empdocs.*','users.name as name')
						->orderBy('empdocs.created_at','desc')
						->paginate(20);
			}			
		}
		elseif(\Auth::user()->role==1){
			if(!is_numeric($q)){
				 
				 $alldocument =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						
					->where('empdocs.folder_id',"$type",$folderid)
						
						 ->select('empdocs.*','users.name as name')
						 
						->where('empdocs.documentname','like',"%$q%")
					 ->orderBy('empdocs.created_at','desc')
						 ->where('empdocs.user_id',\Auth::user()->id)
						 
						->paginate(20);
					if(count($alldocument)==0){
						
						 $alldocument =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						
						->where('empdocs.folder_id',"$type",$folderid)
						
						 ->select('empdocs.*','users.name as name')
						 
						 ->orderBy('empdocs.created_at','desc')
						->Where('users.name','like',"%$q%")
						
						 ->where('empdocs.user_id',\Auth::user()->id)
						 
						->paginate(20);
						
						if(count($alldocument)==0){
							 $alldocument =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						
						->where('empdocs.folder_id',"$type",$folderid)
						->orderBy('empdocs.created_at','desc')
						 ->select('empdocs.*','users.name as name')
						 
						 
						//->Where('users.name','like',"%$q%")
						->Where('users.email','like',"%$q%")
						 ->where('empdocs.user_id',\Auth::user()->id)
						 
						->paginate(20);
							
						}
					}
						
			}
			else {
				 $alldocument =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						->where('empdocs.folder_id',"$type",$folderid)
						->where('empdocs.user_id',\Auth::user()->id)
						->select('empdocs.*','users.name as name')
						->orderBy('empdocs.created_at','desc')
						->paginate(20);
			}	
			
		}
		elseif(\Auth::user()->role==3){
			if(!is_numeric($q)){
				
				
			
			 $alldocument =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						->where('empdocs.folder_id',"$type",$folderid)
						->where('empdocs.documentname','like',"%$q%")
						->orWhere('users.name','like',"%$q%")
						->orWhere('users.email','like',"%$q%")
						->select('empdocs.*','users.name as name')
						->orderBy('empdocs.created_at','desc')
						->paginate(20); 
			}
          else{			
						
						$alldocument =\DB::table('empdocs')
						->join('users','users.id','=','empdocs.user_id')
						->where('empdocs.folder_id',"$type",$folderid)
						->select('empdocs.*','users.name as name')
						->orderBy('empdocs.created_at','desc')
						->paginate(20);
		  }
		}
		else{
			
			$alldocument=[];
		}
		return $alldocument; 
	 }
	 //get all folder
	 public function allfolder($t=0){
		 	 if($t!=0){
			 $allfolder=\App\folder::all();	 
			 return $allfolder;
			 }
			 $allfolder=\App\folder::paginate(20);
			 return $allfolder;
			 
	 
		 
	 }
	 
	 
	 
 }