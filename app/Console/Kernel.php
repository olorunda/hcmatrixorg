<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
 
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
		Commands\Birtdaynot::class,
		Commands\attendancenot::class,
		Commands\lmattendancenot::class,
    ];
 
	 
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
		   $schedule->command('Birthdaynot')->daily();
		   
		//send attenndance report
		   $getnot=\App\notifcation_sett::where('id',1)
					->select('repfreq')
					->first();		
						
			if($getnot['repfreq']==1){
				
		   $schedule->command('Sendreport')->daily();
		   $schedule->command('lrattendance')->daily();
			}	
			elseif($getnot['repfreq']==2){
				
		   $schedule->command('Sendreport')->weekly();;
		   $schedule->command('lrattendance')->weekly();;
			}
			else{
		   $schedule->command('Sendreport')->monthly();	
		   $schedule->command('lrattendance')->monthly();	
			}
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
