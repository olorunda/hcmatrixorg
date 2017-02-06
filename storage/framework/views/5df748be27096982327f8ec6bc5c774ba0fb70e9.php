<?php $__env->startSection('content'); ?>
<?php  $jobdetail=app('App\Http\Controllers\EmployeeController')->getjobdetail(Auth::user()->job_id); ?>
<script>
  function url(url){

   window.location=url;
 }
</script>
<?php $job = app('App\Http\Controllers\EmployeeController')->getjobdetail(Auth::user()->job_id); ?>
<?php
function niceDate($date)
{
  return date("l, jS \of F, Y. h:i:s A", strtotime($date));
}
?>
<div class="page-content container-fluid">
  <div class="row">
    <!--<div class="col-lg-3 col-xs-12">
      <div class="card card-shadow">
        <div class="card-block text-xs-center bg-white p-40">
          <div class="avatar avatar-100 m-b-20">
            <img src="http://localhost:8000/upload/1472750298.jpg" alt="1472750298.jpg">
          </div>
          <p class="font-size-20 blue-grey-700">Adedeji</p>
          <p class="blue-grey-400 m-b-20">Web Developer</p>
          <p class="m-b-35">Manage Client website and all some other stuffs worth manageing
          </p>
          <ul class="list-inline font-size-18 m-b-35">
            <li class="list-inline-item">
              <a class="blue-grey-400" href="" target="_blank">
                <i class="icon bd-twitter" aria-hidden="true"></i>
              </a>
            </li>
            <li class="list-inline-item m-l-10">
              <a class="blue-grey-400" href="" target="_blank" "="">
                <i class="icon bd-facebook" aria-hidden="true"></i>
              </a>
            </li>
            <li class="list-inline-item m-l-10">
              <a class="blue-grey-400" href="" target="_blank">
                <i class="icon bd-dribbble" aria-hidden="true"></i>
              </a>
            </li>
            <li class="list-inline-item m-l-10">
              <a class="blue-grey-400" href="" target="_blank">
                <i class="icon bd-instagram" aria-hidden="true"></i>
              </a>
            </li>
          </ul>

        </div>
      </div>
      <!-- End Page Widget --
    </div>-->
    <div class="col-lg-12 col-xs-12">
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body nav-tabs-animate nav-tabs-horizontal" data-plugin="tabs">
          <ul class="nav nav-tabs nav-tabs-line" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" data-toggle="tab" href="#headingDistinct1<?php echo e(Auth::user()->id); ?>" aria-controls="headingDistinct<?php echo e(Auth::user()->id); ?>" role="tab">
                <i class="fa fa-home"></i> Home
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" data-toggle="tab" href="#headingDistinct2<?php echo e(Auth::user()->id); ?>" aria-controls="headingDistinct2<?php echo e(Auth::user()->id); ?>" role="tab">
                <i class="fa fa-plane"></i> Pilot Goals
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" data-toggle="tab" href="#headingDistinct3<?php echo e(Auth::user()->id); ?>" aria-controls="headingDistinct4<?php echo e(Auth::user()->id); ?>" role="tab">
                <i class="fa fa-graduation-cap"></i> Individual Development Plans
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" data-toggle="tab" href="#headingDistinct4<?php echo e(Auth::user()->id); ?>" aria-controls="headingDistinct4<?php echo e(Auth::user()->id); ?>" role="tab">
                <i class="fa fa-line-chart"></i> Career Aspirations
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" data-toggle="tab" href="#headingDistinct5<?php echo e(Auth::user()->id); ?>" aria-controls="headingDistinct5<?php echo e(Auth::user()->id); ?>" role="tab">
                <i class="fa fa-cogs"></i> Employee Management
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="headingDistinct1<?php echo e(Auth::user()->id); ?>" role="tabpanel">
              <div class="row">
                <p></p>
                <div class="col-md-2">
                  <img class="img-thumbnail img-bordered img-default" src="<?php echo e(asset('upload')); ?>/<?php echo e(Auth::user()->image); ?>" align="left" style="width: 120px;height: 120px;">
                </div>
                <div class="col-md-10">
                  <h4><?php echo e(strtoupper(Auth::user()->name)); ?></h4>
                  <h5>Job Role: <?php echo e(strtoupper($job['title'])); ?></h5>
                  <h5>Emp. ID.: <?php echo e(strtoupper(Auth::user()->emp_num)); ?></h5>
                  <h5>Department: <?php echo e(app('App\Http\Controllers\AvailJobController')->getDept(Auth::user()->workdept_id)); ?></h5>
                  <h5>Last Promoted on: <?php echo e(niceDate(Auth::user()->last_promoted)); ?></h5>
				  <h5><b> </b>
									 <?php  $getrating=app('App\Http\Controllers\EmpController360')->getrate(Auth::user()->id,Auth::user()->id);  ?>
						 <script>
						 $(function(){
							 
							$('#rating<?php echo e(Auth::user()->id); ?>1').raty({ starType: 'i' });
							
						  $('#rating<?php echo e(Auth::user()->id); ?>1').raty('score', <?php echo e($getrating['rating']); ?>);
						  
							$('#rating<?php echo e(Auth::user()->id); ?>1').raty('readOnly', true);
						 });
						</script>
							<span   id="rating<?php echo e(Auth::user()->id); ?>1"></span>
								   <br/>
                             <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Total Rating: <?php echo e($getrating['rating']); ?> )</span>
									</h5>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <dl class="dl-horizontal">
                    <dt><h5>E-Mail</h5></dt>
                    <dd><?php echo e(Auth::user()->email); ?></dd>

                    <dt><h5>Phone</h5></dt>
                    <dd><?php echo e(Auth::user()->phone_num); ?></dd>
                  </dl>
                </div>
                <div class="col-md-6">
                  <dl class="dl-horizontal">
                    <dt><h5>Sex</h5></dt>
                    <dd><?php echo e(Auth::user()->sex); ?></dd>

                    <dt><h5>Date of Birth</h5></dt>
                    <dd><?php echo e(Auth::user()->dob); ?> (<?php echo e(Auth::user()->age); ?>)</dd>
                  </dl>
                </div>
                <div class="col-md-12">
                  <dl class="dl-horizontal">
                    <dt><h5>Address</h5></dt>
                    <dd><?php echo e(Auth::user()->address); ?></dd>
                  </dl>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <h4>Next Of Kin</h4>
                  <dl class="dl-horizontal">
                    <dt><h5>Name</h5></dt>
                    <dd><?php echo e(Auth::user()->next_of_kin); ?></dd>

                    <dt><h5>Relationship</h5></dt>
                    <dd><?php echo e(Auth::user()->kin_relationship); ?></dd>
                  </dl>
                </div>
                <div class="col-md-6">
                  <h4 style="visibility: hidden;">Next Of Kin</h4>
                  <dl class="dl-horizontal">
                    <dt><h5>Phone</h5></dt>
                    <dd><?php echo e(Auth::user()->kin_phonenum); ?></dd>
                  </dl>
                </div>
                <div class="col-md-12">
                  <dl class="dl-horizontal">
                    <dt><h5>Address</h5></dt>
                    <dd><?php echo e(Auth::user()->kin_address); ?></dd>
                  </dl>
                </div>
              </div>
            </div>
            <?php $i = $idn = $j = $k = $l = 1; ?>
            <div class="tab-pane" id="headingDistinct2<?php echo e(Auth::user()->id); ?>" role="tabpanel">
              <div class="row">
                <p></p>
                <div class="col-md-2">
                  <img class="img-thumbnail img-bordered img-default" src="<?php echo e(asset('upload')); ?>/<?php echo e(Auth::user()->image); ?>" align="left" style="width: 120px;height: 120px;">
                </div>
                <div class="col-md-10">
                  <h4><?php echo e(strtoupper(Auth::user()->name)); ?></h4>
                  <h5>Job Role: <?php echo e(strtoupper($job['title'])); ?></h5>
                  <h5>Emp. ID.: <?php echo e(strtoupper(Auth::user()->emp_num)); ?></h5>
                  <h5>Department: <?php echo e(app('App\Http\Controllers\AvailJobController')->getDept(Auth::user()->workdept_id)); ?></h5>
                  <h5>Last Promoted on: <?php echo e(niceDate(Auth::user()->last_promoted)); ?></h5>
				  <h5><b> </b>
									 <?php  $getrating=app('App\Http\Controllers\EmpController360')->getrate(Auth::user()->id,Auth::user()->id);  ?>
						 <script>
						 $(function(){
							 
							$('#rating<?php echo e(Auth::user()->id); ?>1').raty({ starType: 'i' });
							
						  $('#rating<?php echo e(Auth::user()->id); ?>1').raty('score', <?php echo e($getrating['rating']); ?>);
						  
							$('#rating<?php echo e(Auth::user()->id); ?>1').raty('readOnly', true);
						 });
						</script>
							<span   id="rating<?php echo e(Auth::user()->id); ?>1"></span>
								   <br/>
                             <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Total Rating: <?php echo e($getrating['rating']); ?> )</span>
									</h5>
                </div>
              </div>
              <hr>
              <?php echo $__env->make('employee.tab-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="tab-pane" id="headingDistinct3<?php echo e(Auth::user()->id); ?>" role="tabpanel">
              <div class="row">
                <p></p>
                <div class="col-md-2">
                  <img class="img-thumbnail img-bordered img-default" src="<?php echo e(asset('upload')); ?>/<?php echo e(Auth::user()->image); ?>" align="left" style="width: 120px;height: 120px;">
                </div>
                <div class="col-md-10">
                  <h4><?php echo e(strtoupper(Auth::user()->name)); ?></h4>
                  <h5>Job Role: <?php echo e(strtoupper($job['title'])); ?></h5>
                  <h5>Emp. ID.: <?php echo e(strtoupper(Auth::user()->emp_num)); ?></h5>
                  <h5>Department: <?php echo e(app('App\Http\Controllers\AvailJobController')->getDept(Auth::user()->workdept_id)); ?></h5>
                  <h5>Last Promoted on: <?php echo e(niceDate(Auth::user()->last_promoted)); ?></h5>
				  <h5><b> </b>
									 <?php  $getrating=app('App\Http\Controllers\EmpController360')->getrate(Auth::user()->id,Auth::user()->id);  ?>
						 <script>
						 $(function(){
							 
							$('#rating<?php echo e(Auth::user()->id); ?>3').raty({ starType: 'i' });
							
						  $('#rating<?php echo e(Auth::user()->id); ?>3').raty('score', <?php echo e($getrating['rating']); ?>);
						  
							$('#rating<?php echo e(Auth::user()->id); ?>3').raty('readOnly', true);
						 });
						</script>
							<span   id="rating<?php echo e(Auth::user()->id); ?>3"></span>
								   <br/>
                             <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Total Rating: <?php echo e($getrating['rating']); ?> )</span>
									</h5>
                </div>
              </div>
              <hr>
              <?php echo $__env->make('employee.tab-content-idp', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="tab-pane" id="headingDistinct4<?php echo e(Auth::user()->id); ?>" role="tabpanel">
              <div class="row">
                <p></p>
                <div class="col-md-2">
                  <img class="img-thumbnail img-bordered img-default" src="<?php echo e(asset('upload')); ?>/<?php echo e(Auth::user()->image); ?>" align="left" style="width: 120px;height: 120px;">
                </div>
                <div class="col-md-10">
                  <h4><?php echo e(strtoupper(Auth::user()->name)); ?></h4>
                  <h5>Job Role: <?php echo e(strtoupper($job['title'])); ?></h5>
                  <h5>Emp. ID.: <?php echo e(strtoupper(Auth::user()->emp_num)); ?></h5>
                  <h5>Department: <?php echo e(app('App\Http\Controllers\AvailJobController')->getDept(Auth::user()->workdept_id)); ?></h5>
                  <h5>Last Promoted on: <?php echo e(niceDate(Auth::user()->last_promoted)); ?></h5>
				  <h5><b> </b>
									 <?php  $getrating=app('App\Http\Controllers\EmpController360')->getrate(Auth::user()->id,Auth::user()->id);  ?>
						 <script>
						 $(function(){
							 
							$('#rating<?php echo e(Auth::user()->id); ?>1').raty({ starType: 'i' });
							
						  $('#rating<?php echo e(Auth::user()->id); ?>1').raty('score', <?php echo e($getrating['rating']); ?>);
						  
							$('#rating<?php echo e(Auth::user()->id); ?>1').raty('readOnly', true);
						 });
						</script>
							<span   id="rating<?php echo e(Auth::user()->id); ?>1"></span>
								   <br/>
                             <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Total Rating: <?php echo e($getrating['rating']); ?> )</span>
									</h5>
                </div>
              </div>
              <hr>
              <?php echo $__env->make('employee.tab-content-careers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="tab-pane" id="headingDistinct5<?php echo e(Auth::user()->id); ?>" role="tabpanel">
              <div class="row">
                <p></p>
                <div class="col-md-2">
                  <img class="img-thumbnail img-bordered img-default" src="<?php echo e(asset('upload')); ?>/<?php echo e(Auth::user()->image); ?>" align="left" style="width: 120px;height: 120px;">
                </div>
                <div class="col-md-10">
                  <h4><?php echo e(strtoupper(Auth::user()->name)); ?></h4>
                  <h5>Job Role: <?php echo e(strtoupper($job['title'])); ?></h5>
                  <h5>Emp. ID.: <?php echo e(strtoupper(Auth::user()->emp_num)); ?></h5>
                  <h5>Department: <?php echo e(app('App\Http\Controllers\AvailJobController')->getDept(Auth::user()->workdept_id)); ?></h5>
                  <h5>Last Promoted on: <?php echo e(niceDate(Auth::user()->last_promoted)); ?></h5>
				  <h5><b> </b>
									 <?php  $getrating=app('App\Http\Controllers\EmpController360')->getrate(Auth::user()->id,Auth::user()->id);  ?>
						 <script>
						 $(function(){
							 
							$('#rating<?php echo e(Auth::user()->id); ?>2').raty({ starType: 'i' });
							
						  $('#rating<?php echo e(Auth::user()->id); ?>2').raty('score', <?php echo e($getrating['rating']); ?>);
						  
							$('#rating<?php echo e(Auth::user()->id); ?>2').raty('readOnly', true);
						 });
						</script>
							<span   id="rating<?php echo e(Auth::user()->id); ?>2"></span>
								   <br/>
                             <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Total Rating: <?php echo e($getrating['rating']); ?> )</span>
									</h5>
                </div>
              </div>
              <hr>
              <?php echo $__env->make('employee.tab-content-organogram', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          </div>
        </div>
      </div>
      <!-- End Panel -->
    </div>
  </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>