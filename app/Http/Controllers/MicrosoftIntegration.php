<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use App\Repositories\MicrosoftRepository;

class MicrosoftIntegration extends Controller
{
    //
	protected $microsoft;
	public function __construct(MicrosoftRepository $microsoft){
		
		$this->middleware('auth');
		$this->middleware('rights');
		$this->microsoft=$microsoft;
		
	}
	
	public function displayevent(){
		
		$graph = new Graph();
  $graph
      ->setBaseUrl("https://graph.microsoft.com/")
      ->setApiVersion("v1.0")
      ->setAccessToken(session('accesstoken'));
		 
  $events = $graph->createRequest("get", "/me/calendar/events")
                ->addHeaders(array("Content-Type" => "application/json"))
                ->setReturnType(Model\Event::class)
                ->setTimeout("1000")
                ->execute();
				
		
		foreach($events as $event){
			$myevent[]=['title'=>$event->getsubject(),'start'=>$event->getstart()->getdateTime(),'end'=>$event->getend()->getdateTime()];
			
		}

			return $myevent;

 
		
	}
	
	public function dateconv($start,$end){
		
		$date= date('Y-m-dTH:i:s',strtotime($start." ".$end));
		
		return str_replace('UTC','T',$date);
		
	}
	public function createvent(Request $request){
		if(\Auth::user()->role==1){
			$type="Optional";
		}
		else{
			$type="Required";
		}
		//$attendees=$request->attendees;
		//return  self::dateconv($request->enddate,$request->endtime);
		$email=$request->attendees;
		
		if(isset($request->attopt)){
			$attopt=$request->attopt;
			if($attopt==1){
			//all dreport
			$getemailname=\App\User::select('name','email')->where('linemanager_id',\Auth::user()->id)->chunk(100,function($users){
				 foreach($users as $user){
			
				$emailaddress []=["type"=>$type,"emailAddress"=>["address"=>"$user->email","name"=>"$user->name"]];
 		 
				 }
				
			});
			
			}
			elseif($attopt==2){
				//all lm
				$getemailname=\App\User::select('name','email')->where('role',2)->chunk(100,function($users){
				 foreach($users as $user){
			
				$emailaddress []=["type"=>$type,"emailAddress"=>["address"=>"$user->email","name"=>"$user->name"]];
 		 
				 }
				
			});
			
			}
			elseif($attopt==3){
				//all employee
				$getemailname=\App\User::select('name','email')->chunk(100,function($users){
				 foreach($users as $user){
			
				$emailaddress []=["type"=>$type,"emailAddress"=>["address"=>"$user->email","name"=>"$user->name"]];
 		 
				 }
				
			});
			}
			else{
			$emailarr=explode(',',$email);
		foreach($emailarr as $email){
			
		 $emailaddress []=["type"=>$type,"emailAddress"=>["address"=>"$email","name"=>""]];
 		 
		}	
			}
		}
		else{
		$emailarr=explode(',',$email);
		foreach($emailarr as $email){
			
		 $emailaddress []=["type"=>$type,"emailAddress"=>["address"=>"$email","name"=>""]];
 		 
		}
		}
		 
		
		
		 		$graph = new Graph();
  $graph
      ->setBaseUrl("https://graph.microsoft.com/")
      ->setApiVersion("v1.0")
      ->setAccessToken(session('accesstoken'));
		 
				$events = $graph->createRequest("post", "/me/calendar/events")
                ->addHeaders(array("Content-Type" => "application/json"))
				->attachBody([ 
                "Id"=> null,
				"attendees"=>$emailaddress,
                "Subject"=> $request->subject,
                "Body"=> [
                    "ContentType"=> "Text",
                    "Content"=> $request->description
                ],
                "Start"=> [
                    "DateTime"=> self::dateconv($request->startdate,$request->starttime),
                    "TimeZone"=> "Pacific Standard Time"
                ],
				"importance"=>$request->importance,
                "End"=> [
                    "DateTime"=>  self::dateconv($request->enddate,$request->endtime),
                    "TimeZone"=> "Pacific Standard Time"
                ],
                "ShowAs"=> "Free",
                "IsReminderOn"=>$request->reminder,
				"reminderMinutesBeforeStart"=>5,
				"location"=>[
			
			"displayName"=> $request->location,
			"locationEmailAddress"=> ""
			]
            ])
			//Free, Tentative, Busy
                ->setTimeout("1000")
                ->execute();
		   	return var_dump($events);		
			return response()->json("Success",200);
		 
		
	}
	
	public function sendmail(Request $request){
	
		$sendmessage=$this->microsoft->mailemployee($request->respname,$request->respaddr,$request->subject,$request->content);
	
		
		return $sendmessage;
		
	}
	
	public function outlookevent(){
		
		return view('microsoft.events');
	}
	
}
