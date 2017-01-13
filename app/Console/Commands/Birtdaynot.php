<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Mail\Birtdayemail;

use Mail;
class Birtdaynot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Birthdaynot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Birtday Notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
		 \App\User::select('name','email','dob')->where('linemanager_id','>',0)->chunk(100,function($users){
			 foreach($users as $user){
				 $getdatemonth=date('m-d',strtotime($user->dob));
				 if(date('m-d')==$getdatemonth){
				//send birthday email messages 
				Mail::to($user->email)->send(new Birtdayemail($user->name,$user->dob)); 
				
				}
				
				
			 } 
		 });

        $this->info('All birthday Notification Sent!');
		
    }
}
