<?php $__env->startSection('content'); ?>
<?php  function getyear($date,$type=0){
					if($type==0){
						$getyear=explode(' ',$date);
						return $getyear[0];
					}
					else{
						
						$getyear=explode('-',$date);
						$remtime=explode(' ',$getyear[2]);
						return [$getyear[0],$getyear[1],$remtime[0]];
						//return $ydm;
					}
					
				}
	?>
<script>
function setprojtype(type=1){
	
	if(type==0){
		sessionStorage.setItem('setprojtype',0);
		$('.assigned_to_id').show();
		$('.client_name').show();
		$('#addpjbtn').text('<?php echo e(_t('Add Project')); ?>');
	}
	else{
		$('#addpjbtn').text('<?php echo e(_t('Update Project')); ?>');
		sessionStorage.setItem('setprojtype',1);
	}
	
}
function projectid(id){
 
	sessionStorage.setItem('prjid',id);
    sessionStorage.setItem('type',1);
	$('#tskbtn').text('<?php echo e(_t('Create Task')); ?>');
}
function completetask(id){
	
	$.get('<?php echo e(url('project')); ?>/'+id+'/edit',{
		
		task:"1"
		
	},function(data,status,xhr){
		
		if(xhr.status==200){
			console.log(data);
			if(data==1){
				
			toastr.success('<?php echo e(_t('Task Mark as Completed')); ?>');
			$('#status'+id).html('<i class="text text-success"><?php echo e(_t('completed')); ?></i>');	
			}
			else{
				
			toastr.warning('<?php echo e(_t('Task Mark as Pending')); ?>');
				$('#status'+id).html('<i class="text text-warning"><?php echo e(_t('pending')); ?></i>');	
			
			}
		}
		else{
			toastr.error('<?php echo e(_t('Some Error Occurred')); ?>');
	
		}
		
		
	});
	
}
 function completeproject(id){
	
	$.get('<?php echo e(url('project')); ?>/'+id+'/edit',{
		
		projectme:'project'
		
	},function(data,status,xhr){
		
		if(xhr.status==200){
		
			if(data.start==1){
					toastr.success('<?php echo e(_t('Project Mark as Completed')); ?>');
			$('#prjstatus'+id).html('<i class="text text-success"><?php echo e(_t('completed')); ?></i>');	
			$('#enddate'+id).html(data.date);	
			}
			else{
					toastr.success('<?php echo e(_t('Project Mark as Pending')); ?>');
				$('#prjstatus'+id).html('<i class="text text-warning"><?php echo e(_t('pending')); ?></i>');	
				$('#enddate'+id).html(data.date);
			}
		}
		else{
			toastr.error('<?php echo e(_t('Some Error Occurred')); ?>');
	
		}
		
		
	});
	
	
	
 }
$(function (){
	
	
	
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

});


</script>
<style>
  .center {text-align: center; margin-left: auto; margin-right: auto; margin-bottom: auto; margin-top: auto;}
  b{
	  font-weight:bold;
  }

</style>
<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="token" />
<div class="page-header">
  <h1 class="page-title"><?php echo e(_t('Project Management')); ?></h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(url('home')); ?>"><?php echo e(_t('Home')); ?></a></li>
    <li class="breadcrumb-item active"><?php echo e(_t('You are Here')); ?></li>
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

<div class="container">
  <div class="row">
    <div style="height:150px;" class="col-lg-4 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white">
                 <a style="text-decoration:none; color:white;" href="<?php echo e(url(session('locale').'/project')); ?>/total"> <i class="icon icon-circle icon-2x wb-clipboard bg-red-600" aria-hidden="true"></i></a>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number"><?php echo e(app('App\Repositories\ProjectRepository')->projectstat(0)); ?></span>
                    <span class="counter-number-related text-capitalize"><?php echo e(_t('projects')); ?></span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16"><?php echo e(_t('in total')); ?></div>
                </div>
              </div>
              <!-- End Card -->
            </div>  
			<div style="height:150px;" class="col-lg-4 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white">
                  <a style="text-decoration:none;color:white;" href="<?php echo e(url(session('locale').'/project')); ?>/pending">  <i class="icon icon-circle icon-2x wb-alert bg-yellow-600" aria-hidden="true"></i></a>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number"><?php echo e(app('App\Repositories\ProjectRepository')->projectstat(2)); ?></span>
                    <span class="counter-number-related text-capitalize"><?php echo e(_t('projects')); ?></span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16"><?php echo e(_t('is pending')); ?></div>
                </div>
              </div>
              <!-- End Card -->
            </div> 
			<div style="height:150px;" class="col-lg-4 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white">
                 <a style="text-decoration:none;color:white;" href="<?php echo e(url(session('locale').'/project')); ?>/completed"><i class="icon icon-circle icon-2x  wb-check bg-green-600" aria-hidden="true"></i></a>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number"><?php echo e(app('App\Repositories\ProjectRepository')->projectstat(1)); ?></span>
                    <span class="counter-number-related text-capitalize"><?php echo e(_t('projects')); ?></span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16"><?php echo e(_t('is completed')); ?></div>
                </div>
              </div>
              <!-- End Card -->
            </div>
			<div class="col-md-12" style="margin-top:30px;"></div>
       <div class="col-md-12">
          <div class="panel ">
            <div class="panel-heading">
              <h3 style="display:inline-block" class="panel-title"><?php echo e(_t('Project List')); ?></h3>
			  <div class="col-md-3 form-group pull-right" style="margin-top:10px;">
			  <form action="<?php echo e(url('project')); ?>" method="GET" >
                  <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search...">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-primary"><i class="icon wb-search" aria-hidden="true"></i></button>
                    </span>
                  </div>
			</form>
                </div>
            </div>
            <div class="panel-body">
			<?php if(count($projects)>0): ?>
				
			<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
			<?php  $i=2;  ?>
					<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					
					<?php if($i%2==0): ?>
					<?php	$class="panel-warning";   ?>
					<?php else: ?>
					<?php	$class="panel-success";   ?>	
					<?php endif; ?>
                  <div class="panel <?php echo e($class); ?> panel-line">
                    <div class="panel-heading" id="exampleHeadingDefaultOne" role="tab">
                      <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne<?php echo e($project->id); ?>" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultOne">
                      <?php echo e($project->name); ?>(<?php echo e($project->code); ?>)
					  
                    </a>
                    </div>
                    <div class="panel-collapse collapse" id="exampleCollapseDefaultOne<?php echo e($project->id); ?>" aria-labelledby="exampleHeadingDefaultOne" role="tabpanel" aria-expanded="false" style="height: 0px;">
                      <div class="panel-body">
					  <div class="btn-group">
					  
					  </div>
                        <table class="table table-responsive table-striped " >
								<tr>
									<td><b><?php echo e(_t('Action')); ?></b></td>
									<td>
					<button style="border:none" title="Mark as Completed" class="btn btn-icon btn-pure btn-success btn-sm"  onclick="completeproject('<?php echo e($project->id); ?>')"><i class="wb-check" ></i></button>
					  
					 <?php if(Auth::user()->role==3 && Auth::user()->role==2 ): ?>
					<button style="border:none" title="Delete Task" class="btn btn-icon btn-pure btn-danger btn-sm"  onclick="deleteproject('<?php echo e($project->id); ?>')"><i class="wb-trash" ></i></button>
					<?php endif; ?>
					
					<button data-target="#addProjectForm" data-toggle="modal" style="border:none" title="Edit Task" class="btn btn-icon btn-pure btn-warning btn-sm"  onclick="editproject('<?php echo e($project->id); ?>','<?php echo e($project->name); ?>','<?php echo e($project->code); ?>','<?php echo e(getyear($project->start_date,0)); ?>','<?php echo e(getyear($project->end_est_date,0)); ?>','<?php echo e($project->remark); ?>')"><i class="wb-edit" ></i></button> 
					  </td>
								
								</tr><tr>
									<td><b><?php echo e(_t('Project Name')); ?></b></td>
									<td><?php echo e($project->name); ?></td>
								
								</tr>
								<tr>
									<td><b><?php echo e(_t('Project Code')); ?></b></td>
									<td><?php echo e($project->code); ?></td>
								
								</tr>
								<tr>
									<td><b><?php echo e(_t('Project Status')); ?></b></td>
									<td id="prjstatus<?php echo e($project->id); ?>"><?php if($project->status==0): ?>  
										<i class="text text-warning"><?php echo e(_t('pending')); ?></i> <?php else: ?> 
										<i class="text text-success"><?php echo e(_t('completed')); ?></i>
											<?php endif; ?> </td>
								
								</tr>
								<tr>
									<td><b><?php echo e(_t('Start Date')); ?></b></td>
									<td><?php echo e(getyear($project->start_date,0)); ?>

									</td>
								
								</tr>
								<tr>
									<td><b><?php echo e(_t('Estimated Ending Date')); ?></b></td>
									<td><?php echo e(getyear($project->end_est_date,0)); ?></td>
								
								</tr>
								<tr>
									<td><b><?php echo e(_t('Duration')); ?></b></td>
									<td><?php $date=getyear($project->start_date,1); 
											$date1= \Carbon\Carbon::parse($project->start_date);
											$date2= \Carbon\Carbon::parse($project->end_est_date);
									?>	<?php echo e($date1->createFromDate($date[0],$date[1],$date[2])->diff($date2)->format('%y yr(s), %m mth(s) and %d day(s)')); ?></td>
								
								</tr>
								
								<tr>
									<td><b><?php echo e(_t('Actual Ending Date')); ?></b></td>
									<td id="enddate"><?php echo e(getyear($project->actual_ending_date,0)); ?></td>
								
								</tr>
								<tr>
									<td><b><?php echo e(_t('Early/Late')); ?></b></td>
									<td id="enddate">
									<?php 
									
									$enddate=date('Ymd',strtotime($project->end_est_date));
									$actualendate=date('Ymd',strtotime($project->actual_ending_date));
									
									?>
									<?php if($enddate>=$actualendate): ?> 
										<i class="text text-success"><?php echo e(_t('Early')); ?> </i>
									<?php else: ?>
										<i class="text text-danger"><?php echo e(_t('Late')); ?></i>	
									<?php endif; ?>
									
									</td>
								
								</tr>
								<tr>
									<td><b><?php echo e(_t('Project Manager')); ?></b></td>
									<td>
									<?php  $managers=app('App\Repositories\ProjectRepository')->getname($project->id); ?>
									 <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									 <?php echo e($manager['name']); ?>,
									 <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									
									</td>
								
								</tr><tr>
								<?php  $gettasks=app('App\Repositories\ProjectRepository')->gettask($project->id);   ?>
									<td><b><?php echo e(_t('Project Task')); ?></b></td>
									<td>
									<?php if(count($gettasks)>0): ?>
										 <?php if(Auth::user()->role==3 || Auth::user()->role==2): ?>
								  <button class="btn btn-icon btn-danger btn-sm" data-target="#addtasks" data-toggle="modal" onclick="projectid('<?php echo e($project->id); ?>')"><i class="fa fa-add" ></i>Add Task</button><br><br><?php endif; ?>
										<table>
												<?php $__currentLoopData = $gettasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										    <tr>
											<td style="font-weight:bold"><?php echo e($task->name); ?></td>
											<td><?php echo e($task->froms); ?> <b>to</b></td>
											<td><?php echo e($task->tos); ?></td>
											<td id="status<?php echo e($task->id); ?>"><?php if($task->status==0): ?> <i class="text text-warning"><?php echo e(_t('pending')); ?></i> <?php else: ?> <i class="text text-success"><?php echo e(_t('completed')); ?></i>  <?php endif; ?>
											</td>
											<td>  
											<button style="border:none" title="Mark as Completed" class="btn btn-icon btn-pure btn-success btn-sm"  onclick="completetask('<?php echo e($task->id); ?>')"><i class="wb-check" ></i>
											</button>
											 <?php if(Auth::user()->role==3): ?>
											<button style="border:none" title="Mark as Completed" class="btn btn-icon btn-pure btn-danger btn-sm"  onclick="deletetask('<?php echo e($task->id); ?>')"><i class="wb-trash" ></i>
											</button>
											<?php endif; ?>
											 <?php if(Auth::user()->role==3 || Auth::user()->role==2): ?>
											<button data-target="#addtasks" data-toggle="modal" style="border:none" title="Edit Task" class="btn btn-icon btn-pure btn-warning btn-sm"  onclick="edittask('<?php echo e($task->id); ?>','<?php echo e($task->name); ?>','<?php echo e($task->froms); ?>','<?php echo e($task->tos); ?>')"><i class="wb-edit" ></i></button>
										    <?php endif; ?>
											</td>
											</tr>
											<?php   $i++; ?>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										  
										</table>
										 <?php else: ?>
											  <?php if(Auth::user()->role==3 || Auth::user()->role==2): ?>
											  <button class="btn btn-icon btn-danger btn-sm" data-target="#addtasks" data-toggle="modal" onclick="projectid('<?php echo e($project->id); ?>')"><i class="fa fa-add" ></i><?php echo e(_t('Add Task')); ?></button>
												<?php endif; ?>
										 
											<?php endif; ?>
									</td>
								
								</tr><tr>
									<td><b><?php echo e(_t('Remark')); ?></b></td>
									<td><?php echo e($project->remark); ?></td>
								
								</tr>
						
						</table>
                      </div>
                    </div>
                  </div>
				  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </div>
			<?php else: ?>
				<h3 class="alert alert-info"><?php echo e(_t('No Project Found!')); ?></h3>
			<?php endif; ?>
		 	  </div>
			  <?php echo $projects->render(); ?>

        </div>
        
    </div>
  </div>
  </div>
  <?php if(Auth::user()->role==2 || Auth::user()->role==3): ?>
  <button onclick="setprojtype(0)" class="site-action btn-raised btn btn-success btn-floating" data-target="#addProjectForm" data-toggle="modal" type="button">
    <i class="icon wb-plus" aria-hidden="true"></i>
  </button>
  <?php endif; ?>
   <?php echo $__env->make('partials.addtask', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('partials.addproject', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
 
    </body>
</html>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>