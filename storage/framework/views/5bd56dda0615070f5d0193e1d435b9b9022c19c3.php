<?php $__env->startSection('content'); ?>
<script>
$(function (){
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

});


</script>
<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="token" />
<div class="page-header">
  <h1 class="page-title">Jobs Applied For</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">You are Here</li>
  </ol>
  <div class="page-header-actions">
    <div class="row no-space w-250 hidden-sm-down">

      <div class="col-sm-6 col-xs-12">
        <div class="counter">
          <span class="counter-number font-weight-medium"><?php echo e(date('Y-m-d')); ?></span>

        </div>
      </div>
      <div class="col-sm-6 col-xs-12">
        <div class="counter">
          <span class="counter-number font-weight-medium" id="time">08:32:56 am</span>
        </div>
      </div>
    </div>
  </div>
  
</div>
<div class="page-content" >
<div class="panel panel-primary panel-line">
            <div class="panel-heading">
              <h3 class="panel-title">Job Applied For</h3>
            </div>
            <div class="panel-body">
	<div class="table-responsive">
		<table class="table table-hover">
		<thead class="bg-blue-grey-100">
			<tr>
			<th>Job Title</th>
			<th>Date Applied</th>
			</tr>
		</thead>
		<tbody>
		<?php if(count($appliedfor) > 0): ?>
			<?php $__currentLoopData = $appliedfor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			
			<tr>
				<td><a target="_blank" style="text-decoration:none" href="<?php echo e(url('available_jobs/jobs?id=')); ?><?php echo e($job->id); ?>" ><?php echo e($job->title); ?></a></td>
				<?php $carbondate=Carbon\Carbon::parse($job->appdate); ?>
				<td> <?php echo e($carbondate->diffForHumans()); ?> </td>
			</tr>
			
			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		<?php else: ?>
			<div class="alert alert-danger">
				<h3>You have not applied for any job yet.</h3>
			</div>
		<?php endif; ?>
		</tbody>
		</table>
		
		<?php echo e($appliedfor->links()); ?>

		
	</div>
	</div>
          </div>
</div>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>