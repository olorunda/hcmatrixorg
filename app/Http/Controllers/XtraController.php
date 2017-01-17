<?php

namespace App\Http\Controllers;

use App\Repositories\XtraRepository;
use Illuminate\Http\Request;
use App\Mail\newdocumentnotification;

class XtraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	protected $xtra;
	 
	public function  __construct(XtraRepository $xtra) {
		 $this->middleware('auth');;
		 $this->middleware('rights');;
		 $this->xtra=$xtra;
	}
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		
		if($id=="attendancecalender"){
			
			return view('xtrafeature.attendance360');
		}
		if($id=="docadmin"){
			$getfoldercount=$this->xtra->getfoldercount();
			$getdocumentcount=$this->xtra->getdocumentcount();
			$allfolder=$this->xtra->allfolder();
			 
			return view('xtrafeature.documanage',['foldercount'=>$getfoldercount,'docucount'=>$getdocumentcount,'allfolder'=>$allfolder]);
		}
		elseif($id="mydocument"){
			$getfoldercount=$this->xtra->getfoldercount();
			$getdocumentcount=$this->xtra->getdocumentcount(\Auth::user()->id);
			$allfolder=$this->xtra->allfolder();
			
			return view('xtrafeature.mydocument',['foldercount'=>$getfoldercount,'docucount'=>$getdocumentcount,'allfolder'=>$allfolder]);
		}
		return redirect('home');
    }
	public function dispcal(Request $request){
		//start=2016-11-27&end=2017-01-08
		//do som magic
		try {
			
		$emps=\DB::table('users')
						->join('attendances','users.emp_num','=','attendances.user_id')
						->select('users.name','attendances.created_at as startdate')
						->whereBetween('attendances.created_at',[$request->start,$request->end])
						->get();
		 
			foreach($emps as $empres):
			
			$dispemp[]=['title'=>$empres->name,'start'=>$empres->startdate];
			 
			endforeach;
			if(isset($dispemp)):
			return response()->json($dispemp);
			else:
			$dispemp=['title'=>'Nil','start'=>'2016-09-09'];
			return response()->json($dispemp);
			endif;
			
		}
		
		catch(\Exception $ex){
			
			return response()->json("Error:$ex");
		}
		
	}
	
	public function savefolder(Request $request){
		
		try {
			
			$savefolder=\App\folder::create(['name'=>$request->name]);
			
			return response()->json("Success",200);
		}
		catch(\Exception $ex){
			
			return response()->json("Error",404);
		}
		
	}
	
	public function viewdoc(Request $request){
		
		if(isset($request->type)){
			
	$getdoc=$this->xtra->mydocument($request->foldid,$request->type);
		}
		else{
	$getdoc=$this->xtra->alldocument($request->foldid);
		}
	return view('xtrafeature.documentfolder',['documents'=>$getdoc]);
		
		
	}
	
	public function deletedoc(Request $request){
		
	try{
		
	$getdoc=\App\empdoc::where('id',$request->id)->delete();
	
	return response()->json("success",200);
	
	}
	catch(\Exception $ex){
		
	return response()->json("Error:$ex");
	
	}

		
		
	}
	public function movedoc(Request $request){
		
		try {
			
		$movedoc=\App\empdoc::where('id',$request->id)->update(['folder_id'=>$request->destination]);
		$getdocname=\App\empdoc::where('id',$request->id)->select('documentname')->first();
		$getfoldername=\App\folder::where('id',$request->destination)->select('name')->first();
		$getlmemail=\App\User::where('id',\Auth::user()->linemanager_id)->select('email','name')->first();
		//notif
	session(['notmessage'=>\Auth::user()->name." Have Moved ".$getdocname['documentname']." Document to  ".$getfoldername['name'] ." Folder"]);
	session(['urllink'=>"view/document?foldid=".$request->destination."&foldername=".$getfoldername['name']]);
	session(['lmname'=>$getlmemail['name']]);
	
	\Mail::to($getlmemail['email'])->send(new newdocumentnotification());
	 
		return response()->json("success",200);
			
		}
		catch(\Exception $ex){
		
	return response()->json("Error:$ex");
	
	}
		
	}
	
	public function uploaddoc(Request $request){
		
		
		try{
			
			
			if($request->file('file')->extension()!="csv" && $request->file('file')->extension()!="docx"  && $request->file('file')->extension()!="xls"  && $request->file('file')->extension()!="pdf"){
				
				return response()->json("Error:file extension not valid",200);
				
			}
			
			if ($request->file('file')->isValid()) {
    //		$name\
	
		    $name=$request->name.'.'.$request->file('file')->extension();
			$path = $request->file('file')->store('document');
		
			$createdoc=\App\empdoc::create(['documentname'=>$request->name,'path'=>$path,'user_id'=>\Auth::user()->id,'folder_id'=>$request->folderid]);
			
				//get lm details & folder details
		$getfoldername=\App\folder::where('id',$request->folderid)->select('name')->first();
		$getlmemail=\App\User::where('id',\Auth::user()->linemanager_id)->select('email','name')->first();
			
		//send a notification mail
				 
	session(['notmessage'=>\Auth::user()->name." Have Uploaded Document in ".$getfoldername['name']]);
	session(['urllink'=>"view/document?foldid=".$request->folderid."&foldername=".$getfoldername['name']]);
	session(['lmname'=>$getlmemail['name']]);
	
	\Mail::to($getlmemail['email'])->send(new newdocumentnotification());
	
		
		
			return response()->json("Success",200);
			
			}
			return response()->json("Error",200);
			
		
			
		}
		catch(\Exception $ex){
			
			
			return response()->json("Error:$ex",404);
		}
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
	
	public function search(Request $request){
		//alldocument($folderid,$q=0,$mysearch=0)
		if(isset($request->mysearch)){
		
			$getdoc=$this->xtra->alldocument($request->foldid,$request->q,$request->mysearch);
		 
			
		}
		else {
		$getdoc=$this->xtra->alldocument($request->foldid,$request->q);
		
		}
	
	return view('xtrafeature.documentfolder',['documents'=>$getdoc]);
	
		
		
	}
	
	//edit folder name
	public function folderedit(Request $request){
	
	try{
		
		\App\folder::where('id',$request->id)->update(['name'=>$request->newname]);
		return response()->json("Success",200);
	}
	catch(\Exception $ex){
		
		return response()->json("Error:$ex",404);
	}
	
	}
	
	//delete folder 
	
	public function folderdelete(Request $request){
		
		try{
			$deletefolder=\App\folder::where('id',$request->id)->delete();
			return response()->json("Success",200);
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
    public function destroy($id)
    {
        //
    }
}
