<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	 public $name,$from,$email,$message;
	 
    public function __construct($name,$email,$message,$from)
    {
        //
		$this->name=$name;
		$this->email=$email;
		$this->message=$message;
	 
		$this->from=$from;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		if($this->from==""){
			
			$from="noreply@hcmatrix.com";
		}
		else{
			
			$from=$this->from;
		}
        return $this->from($from)->view('emails.sendnotification')
							->with([
							'name'=>$this->name,
							'email'=>$this->email,
							'message'=>$this->message 
						]);
    }
}
