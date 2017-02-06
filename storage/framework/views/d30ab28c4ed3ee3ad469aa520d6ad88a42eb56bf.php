<?php $__env->startSection('content'); ?>
<?php  $jobdetail=app('App\Http\Controllers\EmployeeController')->getjobdetail(Auth::user()->job_id) ?>
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
<div class="page-header">
	<h1 class="page-title">Line Manager Objectives</h1>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('home')); ?>">Home</a></li>
		<li class="breadcrumb-item"><a href="<?php echo e(url('lm/objectives_c')); ?>">Goal Management</a></li>
		<li class="breadcrumb-item active">Stretch Goals</li>
	</ol>
	<div class="page-header-actions">
		<!--<a class="btn btn-sm btn-default btn-outline btn-round" href="<?php echo e(url('/lm/objectives_c')); ?>">
			<i class="icon wb-arrow-left" aria-hidden="true"></i>
			<span class="hidden-sm-down">Back</span>
		</a>-->

		<select class="form-control" id="changeemp" data-plugin="select2" data-placeholder="Select Employee" data-allow-clear="true" style="width: 200px;" onchange="window.location='/lm/objectives_a?isemp='+ $(this).val();">
			<option value=""></option>
			<optgroup label="Direct Employees">
				<?php $__currentLoopData = $directemps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $direct): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<option value="<?php echo e($direct->id); ?>"><?php echo e($direct->name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</optgroup>
		</select>
	</div>
</div>

<style type="text/css">
	tbody.prfTb, tr.prfTb, td.prfTb {border: none;border-top: none;border-bottom: none;}
</style>
<div class="page-content" >

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
					</div>
						<!--<table style="font-size:15px;" class="table table-hover">
							<?php $job = app('App\Http\Controllers\EmployeeController')->getjobdetail($employee->job_id); ?>
							<tbody class="prfTb">
								<tr class="prfTb">
									<td class="prfTb"><i class="icon wb-user m-r-10"></i> NAME</td>
									<td class="prfTb"><?php echo e($employee->name); ?></td>
								</tr>
								<tr class="prfTb">
									<td class="prfTb"><i class="icon wb-link m-r-10"></i> EMP. ID:</td>
									<td class="prfTb"><?php echo e($employee->emp_num); ?></td>
								</tr>
								<tr class="prfTb">
									<td class="prfTb"><i class="icon wb-plugin m-r-10"></i> JOB ROLE</td>
									<td class="prfTb"><?php echo e($job['title']); ?></td>
								</tr>
								<tr class="prfTb">
									<td class="prfTb"><i class="icon wb-mobile m-r-10"></i>TEL</td>
									<th class="prfTb"><?php echo e($employee->phone_num); ?></th>
								</tr>
								<tr class="prfTb">
									<td class="prfTb" style="font-size:15px;"><i class="icon wb-map m-r-10"></i> ADDRESS</td>
									<td class="prfTb"><?php echo e($employee->address); ?></td>
								</tr>
							</tbody>
						</table>-->
					</div>
				</div>

<div class="col-md-3 col-xs-12 pull-right">
					<img class="img-rounded img-bordered img-bordered-primary" width="150" height="150" src="<?php echo e(asset('upload')); ?>/<?php echo e($employee->image); ?>">
				</div>
			</div>
		</div>
		<div class="pull-right">
			
		</div>
	</div>
	<?php $deadline = app('App\Http\Controllers\LMController')->checkDeadline(month($fiscal->start_month), $fiscal->grace); ?>
	<?php $review   = app('App\Http\Controllers\LMController')->review(month($fiscal->start_month), $fiscal->grace); ?>


	<div class="row row-lg">
		<div class="col-md-12 col-xs-12">
			<div class="panel panel-bordered">
				<div class="panel-heading">
					<h3 class="panel-title">
						Goals and Objectives <!--- <?php if(session()->has('FY')): ?> <?php echo e(session('FY')); ?> <?php endif; ?>-->
						<?php if($deadline=='open'): ?>
						<button type="button" title="Add New Goal" class="btn btn-floating btn-danger btn-sm pull-right" id="newgoal" onclick="$('#newgoalForm').fadeIn('slow')">
							<i class="icon wb-plus" aria-hidden="true"></i>
						</button>
						<?php else: ?>
						<?php endif; ?>
					</h3>
				</div>
				<div class="panel-body">
					<?php if(count($lmgoals) > 0): ?>
					<div class="panel-group panel-group-simple" id="siteMegaAccordion" aria-multiselectable="true" role="tablist">
						<?php $__currentLoopData = $lmgoals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lmgoal): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<?php $cmt = app('App\Http\Controllers\LMController')->getCommentd($employee->id, $lmgoal->id); ?>
						<div class="panel">
							<div class="panel-heading" id="pilotHeading<?php echo e($lmgoal->id); ?>" role="tab">
								<a class="panel-title" data-toggle="collapse" href="#pilotcollaps<?php echo e($lmgoal->id); ?>" data-parent="#siteMegaAccordion" aria-expanded="false" aria-controls="pilotcollaps<?php echo e($lmgoal->id); ?>">
									<?php if($deadline=='open' || $review == 'open'): ?>
									<h4 class="text-success">
										<i class="fa fa-unlock-alt"></i>
										COMMITMENT
									</h4>
									<?php else: ?>
									<h4 class="text-warning">
										<i class="fa fa-lock"></i>
										COMMITMENT
									</h4>
									<?php endif; ?>
								</a>
								<div class="pull-right">
									<a href="javascript:void(0)" title="Edit" data-toggle="modal" data-target="#goaled<?php echo e($lmgoal->id); ?>"><i class="icon wb-edit"></i></a>
									<a class="text-danger" href="javascript:void(0)" title="Delete" onclick="modifyGoal(<?php echo e($lmgoal->id); ?>, 2)"><i class="icon wb-power"></i></a>
									<i class="hide" id="status<?php echo e($lmgoal->id); ?>">Status: waiting...</i>
								</div>
								<span class="text-default">
									<?php echo e($lmgoal->commitment); ?>

								</span>
							</div>
							<div class="panel-collapse collapse" id="pilotcollaps<?php echo e($lmgoal->id); ?>" aria-labelledby="pilotHeading<?php echo e($lmgoal->id); ?>" role="tabpanel">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-2 col-xs-12">
											OBJECTIVE
										</div>
										<div class="col-md-10 col-xs-12">
											<ul>
												<li><?php echo e($lmgoal->objective); ?></li>
											</ul>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2 col-xs-12">
											EMPLOYEE COMMENTS
										</div>
										<div class="col-md-10 col-xs-12">
											<ul>
												<?php if(count($cmt) > 0): ?>
												<li>
													<?php if($cmt->emp_comment != NULL): ?>
													<?php echo e($cmt->emp_comment); ?> 
													<?php else: ?>
													No Comments Yet!
													<?php endif; ?>
												</li>
												<?php else: ?>
												<li>
													[No Comments Yet]
												</li>
												<?php endif; ?>
											</ul>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2 col-xs-12">
											Line Manager Comments
										</div>
										<div class="col-md-10 col-xs-12">
											<ul>
												<?php if(count($cmt) > 0): ?>
												<li>
													<?php if($deadline=='open' || $review=='open'): ?>
													<p>
														<a href="javascript:void(0)" id="edit" onclick="editComm(<?php echo e($lmgoal->id); ?>)"><i class="icon wb-edit"></i> Edit Comment</a>

													</p>
													<div class="click2edit" id="<?php echo e($lmgoal->id); ?>" empid="<?php echo e($employee->id); ?>">
														<?php echo e($cmt->lm_comment); ?>

													</div>
													<?php else: ?>
													<?php echo e($cmt->lm_comment); ?>

													<?php endif; ?>
												</li>
												<?php else: ?>
												<li>
													<?php if($deadline=='open' || $review=='open'): ?>
													<p>
														<a href="javascript:void(0)" id="edit" onclick="editComm(<?php echo e($lmgoal->id); ?>)"><i class="icon wb-edit"></i> Comment</button>
													</p>
													<div class="click2edit" id="<?php echo e($lmgoal->id); ?>" empid="<?php echo e($employee->id); ?>">

													</div>
													<?php else: ?>

													<?php endif; ?>
												</li>
												<?php endif; ?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</div>
					<?php else: ?>
					<h3 class="no-pilot">NO ENTRY FOUND</h3>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<input type="hidden" name="_lmtoken" id="_lmtoken" value="<?php echo e(csrf_token()); ?>">
										

		<!--<div class="panel">
			<div class="panel-body container-fluid">
				<div class="row row-lg">
					<div class="col-md-12 col-xs-12">
						<!-- ToolbarWithLogAllHooks --
						<div class="example-wrap">
							<h4 clabtn-floatingss="example-title">Goals and Objectives</h4>
							<p>A little comments can go here. Anything.</p>
							<?php if($deadline=='open'): ?>
							<button type="button" title="Add New Goal" class="btn btn-floating btn-danger btn-sm" id="newgoal" onclick="$('#newgoalForm').fadeIn('slow')">
								<i class="icon wb-plus" aria-hidden="true"></i>
							</button>
							<?php else: ?>
							<?php endif; ?>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr class="text-center">
											<th>#</th>
											<th>COMMITMENTS</th>
											<th>OBJECTIVES</th>
											<th>EMP. COMMENTS</th>
											<th>MY COMMENT</th>
										</tr>
									</thead>
									<tbody>
										<?php if(count($lmgoals) > 0): ?>
										<?php $__currentLoopData = $lmgoals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lmgoal): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<?php $cmt = app('App\Http\Controllers\LMController')->getCommentd($employee->id, $lmgoal->id); ?>
										<tr>
											<?php if($deadline=='open'): ?>
											<th><i class="fa fa-unlock-alt"></i></th>
											<?php else: ?>
											<th><i class="fa fa-lock"></i></th>
											<?php endif; ?>
											<th style="width: 211px;"><?php echo e($lmgoal->commitment); ?></th>
											<th style="width: 101px;"><?php echo e($lmgoal->objective); ?></th>

											<?php if(count($cmt) > 0): ?>
											<th style="width: 166px;">
												<?php if($cmt->emp_comment != NULL): ?>
												<?php echo e($cmt->emp_comment); ?> 
												<?php else: ?>
												No Comments Yet!
												<?php endif; ?>
											</th>
											<th style="width: 400px;">
												<?php if($deadline=='open' || $review=='open'): ?>
												<p>
													<button type="button" class="btn btn-outline btn-success btn-sm" id="edit" onclick="editComm(<?php echo e($lmgoal->id); ?>)"><i class="fa fa-edit"></i> Edit</button>
													<a href="javascript:void(0)" title="Edit" data-toggle="modal" data-target="#goaled<?php echo e($lmgoal->id); ?>"><i class="icon wb-edit"></i></a>
													<a class="text-danger" href="javascript:void(0)" title="Delete" onclick="modifyGoal(<?php echo e($lmgoal->id); ?>, 2)"><i class="icon wb-power"></i></a>
													<i class="hide" id="status<?php echo e($lmgoal->id); ?>">Status: waiting...</i>
												</p>
												<div class="click2edit" id="<?php echo e($lmgoal->id); ?>" empid="<?php echo e($employee->id); ?>">
													<?php echo e($cmt->lm_comment); ?>

												</div>
												<?php else: ?>
												<?php echo e($cmt->lm_comment); ?>

												<?php endif; ?>
											</th>
											<?php else: ?>
											<th style="width: 101px;">No Comments Yet</th>
											<th style="width: 465px;">
												<?php if($deadline=='open' || $review=='open'): ?>
												<p>
													<button type="button" class="btn btn-outline btn-success btn-sm" id="edit" onclick="editComm(<?php echo e($lmgoal->id); ?>)"><i class="fa fa-edit"></i> Edit</button>
													<a href="javascript:void(0)" title="Edit" data-toggle="modal" data-target="#goaled<?php echo e($lmgoal->id); ?>"><i class="icon wb-edit"></i></a>
													<a class="text-danger" href="javascript:void(0)" title="Delete" onclick="modifyGoal(<?php echo e($lmgoal->id); ?>, 2)"><i class="icon wb-power"></i></a>
												</p>
												<div class="click2edit" id="<?php echo e($lmgoal->id); ?>" empid="<?php echo e($employee->id); ?>">

												</div>
												<?php else: ?>

												<?php endif; ?>
											</th>
											<?php endif; ?>

										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										<?php else: ?>
										<tr>
											<th colspan="5"><h3 class="text-danger">NO ENTRY FOUND.</h3></th>
										</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- End Example #ToolbarWithLogAllHooks --
					</div>
				</div>
			</div>
		</div>-->

		<div class="row row-lg">
			<div class="col-md-12">
				<div class="panel hide" id="newgoalForm">
					<div class="panel-body container-fluid">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="example-wrap">
									<h4 class="example-title">COMMITMENT</h4>
									<textarea class="form-control" required="required" id="newcommitment" style="height: 70px;resize: none;"></textarea>
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="example-wrap">
									<h4 class="example-title">OBJECTIVE</h4>
									<textarea class="form-control" required="required" id="newobjective" style="height: 70px;resize: none;"></textarea>
								</div>
							</div>
							<input type="hidden" name="employee" id="newgoalemp" value="<?php echo e($employee->id); ?>">
							<div class="col-md-12 col-xs-12">
								<button type="button" class="btn btn-sm btn-animate btn-animate-side btn-info" id="btnaddgoal" style="height: 30px;">
									<span><i class="icon wb-plus" aria-hidden="true"></i>Add New Goal</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php if(count($lmgoals) > 0): ?>
	<?php $__currentLoopData = $lmgoals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lmgoal): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	<div class="modal fade" id="goaled<?php echo e($lmgoal->id); ?>" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-sidebar modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Edit Goal</h4>
				</div>
				<div class="modal-body">
					<div class="row" style="width: 400px;">
						<div class="form-group col-xs-12 col-md-12">
							<label class="form-control-label">COMMITMENT</label>
							<textarea class="form-control" style="height: 100px;resize: none;" id="editcommit<?php echo e($lmgoal->id); ?>"><?php echo e($lmgoal->commitment); ?></textarea>
						</div>
						<div class="form-group col-xs-12 col-md-12">
							<label class="form-control-label">OBJECTIVE</label>
							<textarea class="form-control" style="height: 100px;resize: none;" id="editobject<?php echo e($lmgoal->id); ?>"><?php echo e($lmgoal->objective); ?></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-block" onclick="modifyGoal(<?php echo e($lmgoal->id); ?>, 1)">Save changes</button>
					<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal -->
	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	<?php endif; ?>

	<a class="btn btn-danger btn-outline" id="exampleCloseButton" data-plugin="toastr" data-message="Unfortunately something happened at our end and the system could not process your request. Please reload your browser and try again." data-title="Goal Setting" data-container-id="toast-bottom-right" data-close-button="true" data-tap-to-dismiss="false" data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button" style="display: none;">Generate</a>

	<a class="btn btn-danger btn-outline" id="exampleCloseButton2" data-plugin="toastr" data-message="New Goal Added Successfully." data-title="Goal Setting" data-container-id="toast-bottom-right" data-close-button="true" data-tap-to-dismiss="false" data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button" style="display: none;">Generate</a>

	<a class="btn btn-danger btn-outline" id="exampleCloseButton3" data-plugin="toastr" data-message="Goal Deleted Successfully." data-title="Goal Setting" data-container-id="toast-bottom-right" data-close-button="true" data-tap-to-dismiss="false" data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button" style="display: none;">Generate</a>

	<a class="btn btn-danger btn-outline" id="exampleCloseButton4" data-plugin="toastr" data-message="Update Successful." data-title="Goal Setting" data-container-id="toast-bottom-right" data-close-button="true" data-tap-to-dismiss="false" data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button" style="display: none;">Generate</a>
	<?php $__env->stopSection(); ?>

	<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
	<script type="text/javascript">
		$(function(){
			$("#btnaddgoal").click(function(){
				var commitment 	= $("#newcommitment").val();
				var objective 	= $("#newobjective").val();
				var assignedto 	= $("#newgoalemp").val();
				var token 		= $("#_lmtoken").val();
				var type 		= 2;
				var formData 	= {'commitment':commitment, 'objective':objective, 'assignedto':assignedto, 'type':type, '_token':token};
				console.log(formData);
				$.post("/lm", formData, function(data,xhr,status){
					if(!data.id)
					{
						$("#exampleCloseButton").click();
					}
					else
					{
						$("#exampleCloseButton2").click();
						location.reload();
					}
				});
			});
		});

		function modifyGoal(id, type)
		{
			var token = $("#_lmtoken").val();
			if(type == 1)
			{
			//edit
			var commitment = $("#editcommit"+id).val();
			var objective = $("#editobject"+id).val();
			var token = $("#_lmtoken").val();
			var formData = {'commitment':commitment, 'objective':objective, '_token':token, '_method':'PUT'};
			$.post("/lm/"+id, formData, function(data,xhr,status) {
				if(data == 1)
				{
					$("#exampleCloseButton4").click();
					location.reload();
				}
				else
				{
					$("#exampleCloseButton").click();
				}
			});
		}
		else
		{
			//delete
			swal({
				title: "Delete Goal Settings",
				text: "This Operation Cannot Be Reversed!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, cancel!",
				closeOnConfirm: false,
				closeOnCancel: false
			},
			function(isConfirm){
				if (isConfirm) {
					var formData = {'id':id, '_token':token, '_method':'DELETE'};
					$.post('/lm/'+id, formData, function(data,xhr,status){
						if(data == 1)
						{
							$("#exampleCloseButton3").click();
							location.reload();
						}
						else
						{
							$("#exampleCloseButton").click();
						}
					});
				} else {
					swal("Cancelled", "The Operation Was Cancelled", "warning");
				}
			});
		}
	}
</script>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>