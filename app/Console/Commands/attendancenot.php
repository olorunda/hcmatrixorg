<?php

namespace App\Console\Commands;

use App\Repositories\GlobalSettingRepository;
use App\mail\attreport;

use Illuminate\Console\Command;

class attendancenot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Sendreport', $globalsetting;
	
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Scheduled Attendance Report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GlobalSettingRepository $globalsetting)
    {
        parent::__construct();
		$this->globalsetting=$globalsetting;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
		$getnot=\App\notifcation_sett::where('modulename','attendance')
						->select('repfreq')
						->first();
						
		$getadminhr=\App\User::where('role',3)->select('name','email')->get();
		
		if($getnot['repfreq']==1){
			
			$sendreport=$this->globalsetting->attendance("datesearch",date('Y-m-d 00:00:00'),date('Y-m-d 23:00:00'),0,1,1);
		}
		elseif($getnot['repfreq']==2){
			
			$sendreport=$this->globalsetting->attendance("datesearch",date('Y-m-d 00:00:00',strtotime('-1 week')),date('Y-m-d H:i:s'),0,1,1);
		}
		else{
			$sendreport=$this->globalsetting->attendance("datesearch",date('Y-m-d 00:00:00',strtotime('-1 month')),date('Y-m-d H:i:s'),0,1,1);
		}
		foreach($getadminhr as $hrdetails){
			
			$sendmail=\Mail::to($hrdetails->email)
						->send(new attreport($sendreport,$hrdetails->name));
		}
 
		 $this->info('Attendance Notification Sent! ');
		
		
		
		
    }
}
