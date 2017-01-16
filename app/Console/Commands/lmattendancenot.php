<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Repositories\GlobalSettingRepository;
use App\Mail\attreport;

class lmattendancenot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lrattendance',$globalsetting;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Scheduled attendance Report';

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
						
		$getadminhr=\App\User::where('role',2)->select('id','name','email')->get();
		
		if($getnot['repfreq']==1){
			foreach($getadminhr as $hrdetails){
				
			$sendreport=$this->globalsetting->attendance("datesearch",date('Y-m-d 00:00:00'),date('Y-m-d 23:00:00'),0,1,1,$hrdetails->id);
			
			$sendmail=\Mail::to($hrdetails->email)
						->send(new attreport($sendreport,$hrdetails->name));
			}
		}
		elseif($getnot['repfreq']==2){
			
			foreach($getadminhr as $hrdetails){
			
			$sendreport=$this->globalsetting->attendance("datesearch",date('Y-m-d 00:00:00',strtotime('-1 week')),date('Y-m-d H:i:s'),0,1,1,$hrdetails->id);
			
			$sendmail=\Mail::to($hrdetails->email)
						->send(new attreport($sendreport,$hrdetails->name));
			}
		}
		else{
			foreach($getadminhr as $hrdetails){
			
			$sendreport=$this->globalsetting->attendance("datesearch",date('Y-m-d 00:00:00',strtotime('-1 month')),date('Y-m-d H:i:s'),0,1,1,$hrdetails->id);
			
			$sendmail=\Mail::to($hrdetails->email)
						->send(new attreport($sendreport,$hrdetails->name));
			}
		}
		 
 
		 $this->info('Attendance Notification Sent! ');
		
    }
}
