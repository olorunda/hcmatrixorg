Dear <?php echo e($name); ?><br>
<?php if(session('notifymessage22')!=""): ?>
<p><?php echo html_entity_decode(session('notifymessage22')); ?><p>
<?php else: ?>
	
<p><?php echo html_entity_decode($message); ?><p>
<?php endif; ?>
