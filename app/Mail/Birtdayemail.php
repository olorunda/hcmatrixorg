<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Birtdayemail extends Mailable
{
    use Queueable, SerializesModels;

	public $name,$dob;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$dob)
    {
        //
		$this->name=$name;
		$this->dob=$dob;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.birthdays')
				->with(['name'=>$this->name,'dob'=>$this->dob]);
    }
}
