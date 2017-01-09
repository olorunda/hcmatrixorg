	 <?php  $timeinsec=app('App\Repositories\JobRepository')->setexpired(1); 
				?>
	<div  style=" margin:0 0 0 36%;  height:150px; width:600px;" id="timer" data-timer="<?php echo e($timeinsec*60); ?>"></div>