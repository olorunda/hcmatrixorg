<?php $__env->startSection('content'); ?>
<script src="../../global/vendor/jquery/jquery.js"></script>
<script type="text/javascript">
	$(function(){  

		<?php echo $__env->make('script.morris', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

	//});

</script>
<?php  $jobdetail=app('App\Http\Controllers\EmployeeController')->getjobdetail(Auth::user()->job_id);

$fiscal=app('App\Repositories\EmployeeRepository')->fiscalYear();



?>
<?php
function countsex(array $directemps, $sex) 
{
	$count = 0;
	for($i = 0; $i < count($directemps); $i++)
	{
		if($directemps[$i]==$sex)
		{
			$count+=1;
		}
	}
	return $count;
}

function month($id)
{
	$retVal;
	switch($id)
	{
		case 1:
		$retVal = "Jan";
		break;
		case 2:
		$retVal = "Feb";
		break;
		case 3:
		$retVal = "Mar";
		break;
		case 4:
		$retVal = "Apr";
		break;
		case 5:
		$retVal = "May";
		break;
		case 6:
		$retVal = "Jun";
		break;
		case 7:
		$retVal = "Jul";
		break;
		case 8:
		$retVal = "Aug";
		break;
		case 9:
		$retVal = "Sep";
		break;
		case 10:
		$retVal = "Oct";
		break;
		case 11:
		$retVal = "Nov";
		break;
		case 12:
		$retVal = "Dec";
		break;
	}
	return $retVal;
}
?>
<script>
	function url(url){

		window.location=url;
	}
</script>
<?php


$deadline = app('App\Http\Controllers\LMController')->checkDeadline(); 
$review   = app('App\Http\Controllers\LMController')->review(); 
$disable='';
if($deadline=='open' || $review=='open'){
	$disable='';
}

else{
	$disable='disabled';
}

?>
<div class="page-header">
	<h1 class="page-title">Line Manager Objectives</h1>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('home')); ?>">Home</a></li>
		<li class="breadcrumb-item"><a href="<?php echo e(url('lm/objectives_c')); ?>">Performance Review</a></li>
		<li class="breadcrumb-item active">Employee Performance Rating</li>
	</ol>
	<div class="page-header-actions">
		<!--<a class="btn btn-sm btn-default btn-outline btn-round" href="<?php echo e(url('/lm/objectives_c')); ?>">
			<i class="icon wb-arrow-left" aria-hidden="true"></i>
			<span class="hidden-sm-down">Back</span>
		</a>-->

		<select class="form-control" id="changeemp" data-plugin="select2" data-placeholder="Select Employee" data-allow-clear="true" style="width: 200px;" onchange="window.location='/lm/rate?isemp='+ $(this).val();">
			<option value=""></option>
			<optgroup label="Direct Employees">
				<?php $__currentLoopData = $directemps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $direct): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<option value="<?php echo e($direct->id); ?>"><?php echo e($direct->name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</optgroup>
		</select>
	</div>
</div>


<div class="page-content">

	<div class="panel">
		<div class="panel-body">
			<div class="row row-lg">
				<div class="col-md-9 col-xs-12">
					<div class="table-responsive">
						<?php $job = app('App\Http\Controllers\EmployeeController')->getjobdetail($employee->job_id); ?>
						<div class="col-md-12">
							<div class="col-md-3">
								<i class="icon wb-user m-r-10 btn-pure btn-success"></i> NAME
							</div>
							<div class="col-md-9">
								<?php if(isset($employee->name)): ?><?php echo e($employee->name); ?><?php else: ?> NILL <?php endif; ?>
								<p></p>
							</div>
							<div class="col-md-3">
								<i class="icon wb-link m-r-10 btn-pure btn-info"></i> ID
							</div>
							<div class="col-md-9">
								<?php if($employee->emp_num == ''): ?>NILL <?php else: ?><?php echo e($employee->emp_num); ?><?php endif; ?>
								<p></p>
							</div>
							<div class="col-md-3">
								<i class="icon wb-plugin m-r-10 btn-pure btn-warning"></i> JOB ROLE
							</div>
							<div class="col-md-9">
								<?php if($job['title'] == ''): ?>NILL <?php else: ?><?php echo e($job['title']); ?><?php endif; ?>
								<p></p>
							</div>
							<div class="col-md-3">
								<i class="icon wb-mobile m-r-10 btn-pure btn-danger"></i> TEL
							</div>
							<div class="col-md-9">
								<?php if($employee->phone_num == ''): ?>NILL <?php else: ?><?php echo e($employee->phone_num); ?><?php endif; ?>
								<p></p>
							</div>
							<div class="col-md-3">
								<i class="icon wb-map m-r-10 btn-pure btn-dark"></i> ADDRESS
							</div>
							<div class="col-md-9">
								<?php if($employee->address == ''): ?>NILL <?php else: ?><?php echo e($employee->address); ?><?php endif; ?>
							</div>
						</div>					</div>
					</div>

					<div class="col-md-3 col-xs-12 pull-right">
						<img class="img-rounded img-bordered img-bordered-primary" width="150" height="150" src="<?php echo e(asset($employee->image)); ?>">
					</div>
				</div>
			</div>
			<div class="pull-right">

			</div>
		</div>
		<?php $deadline = app('App\Http\Controllers\LMController')->checkDeadline(month($fiscal['start_month']), $fiscal['grace']); ?>
		<?php $review   = app('App\Http\Controllers\LMController')->review(month($fiscal['start_month']), $fiscal['grace']); ?>

		<?php if(count($pilots) > 0): ?>
		<?php $goalCounter = 0; $counter = 0; ?> 
		<input type="hidden" name="_ratetoken" id="_ratetoken" value="<?php echo e(csrf_token()); ?>">
		<div class="row row-lg">
			<div class="col-md-12 col-xs-12">
				<div class="panel panel-bordered" style="margin-bottom: 4px;">
					<div class="panel-heading">
						<h3 class="panel-title">PILOT GOALS <!--- <?php if(session()->has('FY')): ?> <?php echo e(session('FY')); ?> <?php else: ?> <?php echo e(date('Y-m-d')); ?> <?php endif; ?>--></h3>
					</div>
					<div class="panel-body">
						<div class="panel-group panel-group-simple" id="siteMegaAccordion" aria-multiselectable="true" role="tablist">
							<?php $__currentLoopData = $pilots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pilot): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<?php $adminrating = app('App\Http\Controllers\LMController')->getRating($employee->id, $pilot->id); ?>
							<div class="panel">
								<div class="panel-heading" id="pilotHeading<?php echo e($pilot->id); ?>" role="tab">
									<a class="panel-title" data-toggle="collapse" href="#pilotcollaps<?php echo e($pilot->id); ?>" data-parent="#siteMegaAccordion" aria-expanded="false" aria-controls="pilotcollaps<?php echo e($pilot->id); ?>">
										<h4 class="text-warning">COMMITMENT <?php echo e($goalCounter+=1); ?></h4>
									</a>
									<span class="text-default">
										<?php echo e($pilot->commitment); ?>

									</span>
								</div>
								<div class="panel-collapse collapse" id="pilotcollaps<?php echo e($pilot->id); ?>" aria-labelledby="pilotHeading<?php echo e($pilot->id); ?>" role="tabpanel">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<h4>Objective(s)</h4>
												<ul>
													<li>
														<?php echo e($pilot->objective); ?>

													</li>
												</ul>
											</div>
											<div class="col-md-12 col-xs-12">
												<h4>HR Rating</h4>
												<ul>
													<li>
														<?php if( isset($adminrating) && count($adminrating) > 0 ): ?>

														<?php if($adminrating['admin_rate']==0): ?>
														<p>Not Yet Rated!</p>

														<?php if(Auth::user()->role == 3): ?>

														<?php if(session()->has('FY') && session('FY') == date('Y')): ?>

														<?php if($disable!=''): ?>
														<h5>Rating is currently locked. You will receive a notification once rating is available.</h5>
														<?php else: ?>
														<div class="ratemp" id="<?php echo e($pilot->id); ?>"></div> <i id="hint<?php echo e($pilot->id); ?>"></i>
														<?php endif; ?>
														<!--endif($disable != '') -->

														<?php endif; ?>
														<!--endif(($request->session()->has('FY') && session('FY') == date('Y'))) -->

														<?php endif; ?>
														<!--endif(Auth::user()->role == 3) -->


														<?php else: ?>
														<!--elseif($adminrating->admin_rate == 0) -->

														<?php echo e($adminrating['admin_rate']); ?>


														<?php if(Auth::user()->role == 3): ?>

														<?php if(session()->has('FY') && session('FY') == date('Y')): ?>
														<a href="javascript:void(0)" data-toggle="modal" data-target="#ratecomments<?php echo e($pilot->id); ?>" title="Edit Rating">
															<i class="fa fa-edit"></i>
														</a>
														<?php endif; ?>
														<!--endif(session()->has('FY') && session('FY') == date('Y')) -->


														<?php endif; ?>
														<!--endif(Auth::user()->role == 3) -->

														<?php endif; ?>
														<!--endif($adminrating->Admin_rate === 0)-->

														<?php else: ?>
														<!--elseif(isset($adminrating) && count($adminrating) > 0) -->

														<p>Not Yet Rated!</p>

														<?php if(Auth::user()->role == 3): ?>

														<?php if(session()->has('FY') && session('FY') == date('Y')): ?>

														<?php if($disable!=''): ?>
														<h5>Rating is currently locked. You will receive a notification once rating is available.</h5>
														<?php else: ?>
														<div class="ratemp" id="<?php echo e($pilot->id); ?>"></div> <i id="hint<?php echo e($pilot->id); ?>"></i>
														<?php endif; ?>
														<!--endif($disable != '') -->

														<?php endif; ?>
														<!--endif(($request->session()->has('FY') && session('FY') == date('Y'))) -->

														<?php endif; ?>
														<!--endif(Auth::user()->role == 3) -->

														<?php endif; ?>
														<!--endif(isset($adminrating) && count($adminrating) > 0) -->
													</li>
												</ul>
											</div>
											<div class="col-md-12 col-xs-12">
												<h4>HR Comments</h4>
												<ul>
													<li>
														<?php if( isset($adminrating) && count($adminrating) > 0 ): ?>

														<?php echo e($adminrating['admin_comment']); ?>


														<?php else: ?>
														<p>No Comments Found.</p>
														<?php endif; ?>
													</li>
												</ul>
											</div>

											<div class="col-md-12 col-xs-12">
												<h4>Line Manager Rating</h4>
												<ul>
													<li>
														<?php if( isset($adminrating) && count($adminrating) > 0 ): ?>

														<?php if($adminrating['lm_rate'] == 0): ?>
														<p>Not Yet Rated!</p>

														<?php if(Auth::user()->role == 2): ?>

														<?php if(session()->has('FY') && session('FY') == date('Y')): ?>

														<?php if($disable!=''): ?>
														<h5>Rating is currently locked. You will receive a notification once rating is available.</h5>
														<?php else: ?>
														<div class="ratemp" id="<?php echo e($pilot->id); ?>"></div> <i id="hint<?php echo e($pilot->id); ?>"></i>
														<?php endif; ?>
														<!--endif($disable != '') -->

														<?php endif; ?>
														<!--endif($request->session()->has('FY') && session('FY') == date('Y')) -->

														<?php endif; ?>
														<!--endif(Auth::user()->role == 2) -->


														<?php else: ?>
														<!--elseif($adminrating->lm_rate === 0) -->

														<?php echo e($adminrating['lm_rate']); ?>


														<?php if(Auth::user()->role == 2): ?>

														<?php if(session()->has('FY') && session('FY') == date('Y')): ?>
														<a href="javascript:void(0)" data-toggle="modal" data-target="#ratecomments<?php echo e($pilot->id); ?>" title="Edit Rating">
															<i class="fa fa-edit"></i>
														</a>
														<?php endif; ?>
														<!--endif(session()->has('FY') && session('FY') == date('Y'))-->

														<?php endif; ?>
														<!--endif(Auth::user()->role == 3) -->


														<?php endif; ?>
														<!--endif($adminrating->lm_rate == 0) -->

														<?php else: ?>
														<!--elseif(isset($adminrating) && count($adminrating) > 0) -->

														<p>Not Yet Rated!</p>

														<?php if(Auth::user()->role == 2): ?>

														<?php if(session()->has('FY') && session('FY') == date('Y')): ?>

														<?php if($disable!=''): ?>
														<h5>Rating is currently locked. You will receive a notification once rating is available.</h5>
														<?php else: ?>
														<div class="ratemp" id="<?php echo e($pilot->id); ?>"></div> <i id="hint<?php echo e($pilot->id); ?>"></i>
														<?php endif; ?>
														<!--endif($disable != '') -->

														<?php endif; ?>
														<!--endif(($request->session()->has('FY') && session('FY') == date('Y'))) -->

														<?php endif; ?>
														<!--endif(Auth::user()->role == 2)-->


														<?php endif; ?>
														<!--endif(isset($adminrating) && count($adminrating) > 0) -->
													</li>
												</ul>
											</div>
											<div class="col-md-12 col-xs-12">
												<h4>Line Manager Comments</h4>
												<ul>
													<li>
														<?php if( isset($adminrating) && count($adminrating) > 0 ): ?>

														<?php if($adminrating['lm_comment'] != NULL): ?>
														<?php echo e($adminrating['lm_comment']); ?>

														<?php else: ?>
														No Comments Found.
														<?php endif; ?>

														<?php else: ?>

														<p>No Comments Found.</p>
														<?php endif; ?>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style="height: 50px;"></div>
		<?php else: ?>
		<div class="row row-lg">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-body">
						<h3 class="no-pilot">No Pilot Goals Set Yet. Please check back later.</h3>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>

	</div>



	<?php if(count($pilots) > 0): ?>
	<?php $__currentLoopData = $pilots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pilot): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	<?php $adminrating = app('App\Http\Controllers\LMController')->getRating($employee->id, $pilot->id); ?>
	<!-- Example Sidebar -->
	<div class="example-wrap">
		<div class="example">
			<!-- Modal -->
			<div class="modal fade" id="ratecomments<?php echo e($pilot->id); ?>" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title"><?php echo e($employee->name); ?></h4>
						</div>
						<div class="modal-body">
						<!--	<img class="img-rounded img-bordered img-bordered-primary" width="150" height="150" src="<?php echo e(asset('storage')); ?>/<?php echo e($employee->image); ?>"> -->
							<br>
							<div class="form-group">
								<label for="ratingval<?php echo e($pilot->id); ?>">Rating</label>
								<?php if(Auth::user()->role == 3): ?>
								<input type="number" max="5" min="1" class="form-control" name="rating" id="ratingval<?php echo e($pilot->id); ?>" value="<?php if(count($adminrating) > 0): ?><?php echo e($adminrating['admin_rate']); ?><?php endif; ?>">
								<?php else: ?>
								<input type="number" max="5" min="1" class="form-control" name="rating" id="ratingval<?php echo e($pilot->id); ?>" value="<?php if(count($adminrating) > 0): ?><?php echo e($adminrating['lm_rate']); ?><?php endif; ?>">
								<?php endif; ?>
							</div>
							<div class="form-group">
								<label for="lmcomment<?php echo e($pilot->id); ?>">Comment</label>
								<?php if(Auth::user()->role == 3): ?>
								<textarea class="form-control" id="lmcomment<?php echo e($pilot->id); ?>"><?php if(count($adminrating) > 0): ?> <?php if($adminrating['admin_comment'] != NULL): ?> <?php echo e($adminrating['admin_comment']); ?> <?php endif; ?> <?php endif; ?></textarea>
								<?php else: ?>
								<textarea class="form-control" id="lmcomment<?php echo e($pilot->id); ?>"><?php if(count($adminrating) > 0): ?> <?php if($adminrating['lm_comment'] != NULL): ?> <?php echo e($adminrating['lm_comment']); ?> <?php endif; ?> <?php endif; ?></textarea>
								<?php endif; ?>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success btn-block" onclick="saverating(<?php echo e($pilot->id); ?>, <?php echo e($employee->id); ?>)">
								<i class="fa fa-star"></i> 
								<i class="fa fa-star"></i> 
								Rate 
								<i class="fa fa-star"></i> 
								<i class="fa fa-star"></i>
							</button>
							<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End Modal -->
		</div>
	</div>
	<!-- End Example Sidebar -->
	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	<?php endif; ?>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>