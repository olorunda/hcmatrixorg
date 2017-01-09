<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AbsenceRequest extends Mailable
{
    use Queueable, SerializesModels;
    public $data = array();
    public $empname;
    public $lmname;
    public $absenceName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data, $empname, $lmname, $absenceName)
    {
        //
        $this->data = $data;
        $this->empname = $empname;
        $this->lmname = $lmname;
        $this->absenceName = $absenceName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@fmnhcmatrix.com')->view('emails.absence');
    }
}
