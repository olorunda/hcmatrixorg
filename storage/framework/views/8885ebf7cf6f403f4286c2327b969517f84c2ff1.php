Dear <?php echo e(session('reciever')); ?>,<br>
	<p><?php echo e(session('notmessage')); ?></p>
	<p>
	Click <a href="<?php echo e(url('login')); ?>">Here</a> to login and manage your request
	</p>