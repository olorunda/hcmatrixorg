<?php $__env->startSection('content'); ?>
<script src="../../global/vendor/jquery/jquery.js"></script>

<?php  $jobdetail=app('App\Http\Controllers\EmployeeController')->getjobdetail(Auth::user()->job_id) ?>
<script>
  function url(url){

   window.location=url;
 }

 $(function(){
	 
	 
  $('#clockin').thooClock();
  	
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

  //clockin
 $('#clocking').click(function(){
	 
	$.get('employee/clock',function(data,status,xhr){
		
	if(xhr.status==200){
		
		
		toastr.success(data);
	}
	else{
		
		
		toastr.error("Some Error Occurred:"+data);
	}
	
		
		
	});
	}); 
	
	//clock out
	$('#clockout').click(function(){
	 
	$.get('employee/clockout',function(data,status,xhr){
		
	if(xhr.status==200){
		
		
		toastr.success(data);
	}
	else{
		
		
		toastr.error("Some Error Occurred:"+data);
	}
	
		
		
	});
	}); 
	 
 });
</script>
<style>
 


</style>
<div class="page-header">
  <h1 class="page-title">Home</h1>
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
          <span class="counter-number font-weight-medium" id="time"><?php echo e(date('h:i s a')); ?></span>

        </div>
      </div>
    </div>
  </div>
</div>
<div >

  <?php if(Auth::user()->role!=0 ): ?>
<div class="col-md-12 col-xs-12 col-md-12">
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel">
    <div class="card card-shadow card-shadow1">
      <div class="card-block bg-white p-30">
        <button onclick="url('<?php echo e(url('/employee/profile')); ?>')" type="button" class="btn btn-floating btn-sm btn-warning">
          <i class="fa fa-user"></i>
        </button>
        <span class="m-l-15 font-weight-400">Profile</span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
	
  </div>
  
    <?php if(Auth::user()->role>=2): ?>
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel marg" >
    <div class="card card-shadow card-shadow1" >
      <div class="card-block bg-white p-30">
        <button onclick="url('<?php echo e(url('manage/absence')); ?>')" type="button" class="btn btn-floating btn-sm btn-success">
          <i class="fa fa-plane"></i>
        </button>
        <span class="m-l-15 font-weight-400">Absence Mgt</span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel marg">
    <div class="card card-shadow card-shadow1">
      <div class="card-block bg-white p-30">
        <button <?php if(Auth::user()->role>=2): ?>  onclick="url('<?php echo e(url('employee/objective')); ?>')" 
		<?php else: ?>  onclick="url('<?php echo e(url('employee/performance')); ?>')"      <?php endif; ?> type="button" class="btn btn-floating btn-sm btn-primary">
          <i class="fa fa-signal"></i>
        </button>
        <span class="m-l-15 font-weight-400">Performance</span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 col-xs-12 info-panel marg" >
    <div class="card card-shadow card-shadow1">
      <div class="card-block bg-white p-30">
        <button type="button" class="btn btn-floating btn-sm btn-info">
          <i class="fa fa-book"></i>
        </button>
        <span class="m-l-15 font-weight-400">Training </span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel <?php if(Auth::user()->role>=2): ?> <?php else: ?> marg <?php endif; ?>" >
    <div class="card card-shadow card-shadow1">
      <div class="card-block bg-white p-30">
        <button type="button" class="btn btn-floating btn-sm btn-warning">
          <i class="fa fa-money"></i>
        </button>
        <span class="m-l-15 font-weight-400">Finance</span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
  </div>
    <div class="col-xl-3 col-md-6 col-xs-12 info-panel <?php if(Auth::user()->role>=2): ?> marg  <?php else: ?>  <?php endif; ?>">
    <div class="card card-shadow card-shadow1">
      <div class="card-block bg-white p-30">
        <button type="button" class="btn btn-floating btn-sm btn-danger">
          <i class="fa fa-heartbeat"></i>
        </button>
        <span class="m-l-15 font-weight-400">Health</span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
  </div>
  <?php if(Auth::user()->role>=2): ?>
   <div class="col-xl-3 col-md-6 col-xs-12 info-panel marg">                    
    <div class="card card-shadow card-shadow1">
      <div class="card-block bg-white p-30">
        <button onclick="url('<?php echo e(url('hr/attendance')); ?>')" type="button" class="btn btn-floating btn-sm btn-info">
          <i class="fa fa-calendar"></i>
        </button>
        <span class="m-l-15 font-weight-400">Attendance</span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>
</div>
<?php endif; ?>
<div class="col-md-12 col-xs-12 col-md-12">
<style>
#personalCompletedWidget .overlay-background{
	background: #077a3b;
	#background: url('<?php echo e(url('assets/images/fmn.png')); ?>');
	background-color: hsla(124, 40%, 20%, 0.6);
}
.overlay-panel {
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	padding: 0px;
	color: #fff;
}
canvas{
	
	width:72%;
	height:100%;
}
 
</style>

<!-- Personal -->
        <div class="col-md-6">
          <div id="personalCompletedWidget" class="card card-shadow">
            <div class="card-header text-xs-center card-header-transparent cover overlay">
              <img class="cover-image" src="../../../global/photos/placeholder.png">
              <div class="overlay-panel overlay-background vertical-align">
                <div class="vertical-align-middle">
                  <a class="avatar avatar-100" href="javascript:void(0)">
                    <img alt="" src="../../../global/portraits/4.jpg">
       
         </a>
                  <div class="font-size-20"><?php echo e(Auth::user()->name); ?></div>
                  <div class="font-size-14"><?php echo e($jobdetail['title']); ?></div>
				  
				  <!--<ul class="list-inline font-size-18 m-b-35">
        <li class="list-inline-item">
          <a class="blue-grey-400" href="<?php echo e(Auth::user()->twitter); ?>" target="_blank">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
        </li>
        <li class="list-inline-item m-l-10">
          <a class="blue-grey-400" href="<?php echo e(Auth::user()->facebook); ?>" target="_blank"">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
        </li>
        <li class="list-inline-item m-l-10">
          <a class="blue-grey-400" href="<?php echo e(Auth::user()->dribble); ?>" target="_blank">
            <i class="icon bd-dribbble" aria-hidden="true"></i>
          </a>
        </li>
        <li class="list-inline-item m-l-10">
          <a class="blue-grey-400" href="<?php echo e(Auth::user()->instagram); ?>" target="_blank">
            <i class="icon bd-instagram" aria-hidden="true"></i>
          </a>
        </li>
      </ul>-->
                </div>
              </div>
            </div>
            <div class="card-block">
              <div class="row text-xs-center m-b-20">
			  <!--<p class="m-b-35"><?php echo e($jobdetail['description']); ?>

      </p>-->
	  
                <?php if(Auth::user()->age == 0): ?>
        <?php if(session()->has('preview_job')): ?>
          <button type="button" class="btn btn-primary p-x-40" onclick="url('<?php echo e(url('job')); ?>/default?job_id=<?php echo e(session('preview_job')); ?>')">Complete Job Application
          </button>
        <?php else: ?>
          <button type="button" class="btn btn-primary p-x-40" onclick="url('<?php echo e(url('available_jobs')); ?>/joblist')">Available Jobs
          </button>
        <?php endif; ?>
      <?php else: ?>
      <button type="button" class="btn btn-primary p-x-40" onclick="url('employee/profile')">View Profile</button>
      <?php endif; ?>
              </div>
              
            </div>
          </div>
        </div>
        <!-- End Personal -->

<!--
<div class="col-md-6" style="margin-left:-13px;">
  <div class="card card-shadow">
    <div class="card-block text-xs-center bg-white p-40">
      <div class="avatar avatar-100 m-b-20">
        <img src="<?php echo e(asset('upload')); ?>/<?php echo e(Auth::user()->image); ?>" alt="<?php echo e(Auth::user()->image); ?>">
      </div>
      <p class="font-size-20 blue-grey-700"><?php echo e(Auth::user()->name); ?></p>
      <p class="blue-grey-400 m-b-20"><?php echo e($jobdetail['title']); ?></p>
      <p class="m-b-35"><?php echo e($jobdetail['description']); ?>

      </p>
      <ul class="list-inline font-size-18 m-b-35">
        <li class="list-inline-item">
          <a class="blue-grey-400" href="<?php echo e(Auth::user()->twitter); ?>" target="_blank">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
        </li>
        <li class="list-inline-item m-l-10">
          <a class="blue-grey-400" href="<?php echo e(Auth::user()->facebook); ?>" target="_blank"">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
        </li>
        <li class="list-inline-item m-l-10">
          <a class="blue-grey-400" href="<?php echo e(Auth::user()->dribble); ?>" target="_blank">
            <i class="icon bd-dribbble" aria-hidden="true"></i>
          </a>
        </li>
        <li class="list-inline-item m-l-10">
          <a class="blue-grey-400" href="<?php echo e(Auth::user()->instagram); ?>" target="_blank">
            <i class="icon bd-instagram" aria-hidden="true"></i>
          </a>
        </li>
      </ul>
      <?php if(Auth::user()->age == 0): ?>
        <?php if(session()->has('preview_job')): ?>
          <button type="button" class="btn btn-primary p-x-40" onclick="url('<?php echo e(url('job')); ?>/default?job_id=<?php echo e(session('preview_job')); ?>')">Complete Job Application
          </button>
        <?php else: ?>
          <button type="button" class="btn btn-primary p-x-40" onclick="url('<?php echo e(url('available_jobs')); ?>/joblist')">Available Jobs
          </button>
        <?php endif; ?>
      <?php else: ?>
      <button type="button" class="btn btn-primary p-x-40" onclick="url('employee/profile')">View Profile</button>
      <?php endif; ?>
    </div>
  </div>
  
</div>-->
<div class="col-md-6">
  <div class="card card-shadow" style="padding:0 0 5px 0; ">
  <div class="ribbon ribbon-clip ribbon-success" >
                        <span id="clocking" style="z-index:999999999; cursor:pointer;" class="ribbon-inner">Clock In</span>
                      </div>
	<div  class="ribbon ribbon-clip ribbon-reverse ribbon-danger" >
                        <span class="ribbon-inner" id="clockout" style="z-index:999999999; cursor:pointer;">Clock Out</span>
                      </div>
    <div class="card-block text-xs-center bg-white p-40">
     
	<div id="clockin"  >
	
	
	</div><br><br> 
	
	 </div>
  </div>
</div>
<div clss="col-md-6">
<script src="https://irecharge.com.ng/plugin/jquery.cookie.js" type="text/javascript"></script> <script src="https://irecharge.com.ng/plugin/topup_plugin_form.prod.js" type="text/javascript"></script> <script>$(document).ready(function(){var vid='1702C98A80'; $("#iRecharge_container").topUpForm(vid); load_irecharge_cookie();});</script> <div id="iRecharge_container">ss</div>
</div>
<!-- Personal -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>