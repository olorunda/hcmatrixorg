<?php $__env->startSection('content'); ?>
<script src="../../global/vendor/jquery/jquery.js"></script>

<?php  $jobdetail=app('App\Http\Controllers\EmployeeController')->getjobdetail(Auth::user()->job_id) ?>
<script>
  function url(url){

   window.location=url;
 }
 
 function urlChange(url) {
   $('#hide').slideUp(1000);
   $('.show').show(1000);
    document.getElementById('loaddoc').src = url;
   }
   
 $(function(){

   setInterval(function(){
    $.get('/employee/time',function(data,status,xhr){

     $('#time').html(data);

   });	


  },1000);
   $('.col-md-6').fadeIn(1000);
		
		   $('.show').hide(1000);

<?php echo $__env->make('script.morris', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</script>
  <div id="hide" >
<div class="page-header">
  <h1 class="page-title">Performance OverView  </h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Performance Dashboard</a></li>
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
          <span class="counter-number font-weight-medium" id="time"><?php echo e(date('h:i:s a')); ?></span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="documents-wrap app-documents categories" data-plugin="animateList" data-child="li" style="overflow: hidden;">
		<?php if(count($lmgoal)>0): ?>
  <div class="card">
              <div class="card-block">
                <h4 class="card-title"><i class="wb-graph-up" ></i>&nbsp;&nbsp;Pilot Performance Chart For <?php if(session()->has('FY')): ?> <?php echo e(session('FY')); ?> <?php else: ?> <?php echo e(date('Y')); ?>  <?php endif; ?></h4>
				
                <span class="card-text"><div id="pilotchart"></div></span>
               
             
              </div>
            </div> 
			<?php endif; ?>
			  <div class="card">
              <div class="card-block">
                <h4 class="card-title"><i class="wb-pluse" ></i>&nbsp;&nbsp;Pilot Goal Performance Overview For <?php if(session()->has('FY')): ?> <?php echo e(session('FY')); ?> <?php else: ?> <?php echo e(date('Y')); ?>  <?php endif; ?> </h4>
                <p class="card-text"><div class="example table-responsive">
				<?php if(count($lmgoal)>0): ?>
                  <table class="table table-striped">
                    <thead class="bg-blue-grey-100">
					
                      <tr>
                        <th>S/N</th>
                        <th>Objective</th>
                        <th>Committment</th> 
                        <th>LM Rating</th>
                        <th class="text-nowrap">Admin Rating</th>
                        <th class="text-nowrap">Comment(s)</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php $index=1; ?>
					<?php $__currentLoopData = $lmgoal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lmgoals): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    
                      <tr>
                       <td><?php echo e($index++); ?></td>
                       <td><?php echo e($lmgoals->objective); ?></td>
                       <td><?php echo e($lmgoals->commitment); ?></td>
					   <?php  $lmrate=app('App\Repositories\EmployeeRepository')->getrate($lmgoals->id); ?>
                       <td><?php if($lmrate['lm_rate']==""): ?> Not Yet Rated <?php else: ?> <?php echo e($lmrate['lm_rate']); ?> <?php endif; ?> </td>
                        <td><?php if($lmrate['admin_rate']==""): ?> Not Yet Rated <?php else: ?> <?php echo e($lmrate['admin_rate']); ?> <?php endif; ?></td>
                        <td><button class="btn btn-outline btn-success" data-target="#viewcomment<?php echo e($lmgoals->id); ?>" data-toggle="modal" type="button"><i class="wb-eye"></i>&nbsp;&nbsp;View</button>
						
						<!-- mmm-->
						<div class="modal fade modal-3d-flip-horizontal" id="viewcomment<?php echo e($lmgoals->id); ?>" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title"><b><i class="icon  wb-align-justify"></i>&nbsp;&nbsp;Comments</b></h4>
                        </div>
                        <div class="modal-body">
                       
			 <div class="example table-responsive">
                  <table class="table table-striped">
                    <thead class="bg-blue-grey-100">
                      <tr>
                        <th>Admin's Comment</th>
                        <th>LM's Comment</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php if($lmrate['admin_comment']==""): ?> No Comment Yet <?php else: ?> <?php echo e($lmrate['admin_comment']); ?> <?php endif; ?></td>
                        <td> <?php if($lmrate['lm_comment']==""): ?> No Comment Yet <?php else: ?> <?php echo e($lmrate['lm_comment']); ?>  <?php endif; ?></td>
                        
                      </tr>
                    </tbody>
                  </table>
             </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>
						</td>
                      </tr>
					  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                      
                      
                    </tbody>
                  </table>
				  <?php else: ?>
					  
				 <p style="margin-top:500px; font-size:30px; margin:20px;" class=" center-block alert alert-success" id="notfound"> Pilot Goal Has Not been Set For This Year</div>
				  <?php endif; ?>
                </div></p>
               
             
              </div>
            </div>
		</div>
		</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>