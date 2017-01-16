<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class attreport extends Mailable
{
    use Queueable, SerializesModels;

	public $excelfile,$name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($excelfile,$name)
    {
		$this->excelfile=$excelfile;
		$this->name=$name;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		
		        return $this->view('emails.attendancereport')
						->with(['name'=>$this->name])
                     ->attach(storage_path('exports/attendance.xls'), [
                        'as' => 'attendance.xls',
                        'mime' => 'application/pdf',
                    ]);
         
    }
}
