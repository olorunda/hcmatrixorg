<?php

namespace App\Repositories;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class MicrosoftRepository{
	
		
	public function mailemployee($respname,$respaddr,$content,$subject){
		//return $content;
		try{
		$graph = new Graph();
  $graph
      ->setBaseUrl("https://graph.microsoft.com/")
      ->setApiVersion("v1.0")
      ->setAccessToken(session('accesstoken'));
		 
		$mailBody = array( "Message" => array(
                   "subject" => $subject,
                   "body" => array(
                       "contentType" => "html",
                       "content" => $content
                   ),
                 "sender" => array(
                     "emailAddress" => array(
                         "name" => \Auth::user()->name,
                         "address" => \Auth::user()->email
                     )
                 ),
                 "from" => array(
                      "emailAddress" => array(
                         "name" => \Auth::user()->name,
                         "address" => \Auth::user()->email
                     )
                 ),
                 "toRecipients" => array(
                     array(
                       "emailAddress" => array(
                           "name" => $respname,
                           "address" => $respaddr

                    )
                 )
              )
          )
   );

		$graph->createRequest("POST", "/me/sendMail")
      ->attachBody($mailBody)
      ->execute();
	  return response()->json("Success",200);
		}
		catch(\Exception $ex){
		
		return response()->json("Error:$ex",404);
			
			
		}
		
		
		
		
	}
	
	
	
	
	
	
}