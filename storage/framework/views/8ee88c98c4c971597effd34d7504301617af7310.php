<?php $__env->startSection('content'); ?>
<script>

$(function(){
	  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);
 
});
</script>


<div class="page-header">
  <h1 class="page-title">Payroll Settings</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
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
          <span class="counter-number font-weight-medium" id="time"></span>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-md-6 col-xs-12">
          <!-- Card -->
		     <div class="card card-block p-30 bg-blue-600">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Default </span>
                <span class="counter-number-related text-capitalize">Weekend Days</span>
              </div>
              <div class="counter-label text-capitalize"><a href="<?php echo e(url('/edit-weekend_days')); ?>" class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></a>
			   </div>
            </div>
          </div>
          </div>
		  
		  <div class="col-md-6 col-xs-12">
          <div class="card card-block p-30 bg-green-600">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Payslip logo</span>
                <span class="counter-number-related text-capitalize"> Settings</span>
              </div>
              <div class="counter-label text-capitalize"><a href="<?php echo e(url('/edit-payslip-details')); ?>" class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></a></div>
            </div>
          </div>
		  
		  
          <!-- End Card -->
        </div>
		
		 <div class="col-md-6 col-xs-12">
          <div class="card card-block p-30 bg-yellow-600">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Basic Pay</span>
                <span class="counter-number-related text-capitalize">Settings</span>
              </div>
              <div class="counter-label text-capitalize"><a href="<?php echo e(url('/basicpay-list')); ?>" class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></a></div>
            </div>
          </div>
		  
		  
          <!-- End Card -->
        </div> 
		
		<div class="col-md-6 col-xs-12">
          <div class="card card-block p-30 bg-red-600">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Salary</span>
                <span class="counter-number-related text-capitalize"> Components Settings</span>
              </div>
              <div class="counter-label text-capitalize"><a href="<?php echo e(url('/allowance-list')); ?>" class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></a></div>
            </div>
          </div>
          <!-- End Card -->
        </div>

		<div class="col-md-6 col-xs-12">
          <div class="card card-block p-30 bg-brown-600">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Payroll</span>
                <span class="counter-number-related text-capitalize"> Attendance Settings</span>
              </div>
              <div class="counter-label text-capitalize"><a href="<?php echo e(url('/daily-attendance-settings')); ?>" class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></a></div>
            </div>
          </div>
          <!-- End Card -->
        </div>
	<?php $__env->stopSection(); ?>
  
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>