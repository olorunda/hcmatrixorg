@extends('layouts.app')

@section('content')
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
		<li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{url('lm/objectives_c')}}">Goal Management</a></li>
		<li class="breadcrumb-item active">Stretch Goals</li>
	</ol>
	<div class="page-header-actions">
		<!--<a class="btn btn-sm btn-default btn-outline btn-round" href="{{url('/lm/objectives_c')}}">
			<i class="icon wb-arrow-left" aria-hidden="true"></i>
			<span class="hidden-sm-down">Back</span>
		</a>-->

		<select class="form-control" id="changeemp" data-plugin="select2" data-placeholder="Select Employee" data-allow-clear="true" style="width: 200px;" onchange="window.location='/lm/objectives_a?isemp='+ $(this).val();">
			<option value=""></option>
			<optgroup label="Direct Employees">
				@foreach($directemps as $direct)
				<option value="{{$direct->id}}">{{$direct->name}}</option>
				@endforeach
			</optgroup>
		</select>
	</div>
</div>


<div class="page-content" >

	<div class="panel">
		<div class="panel-body">
			<div class="row row-lg">
				<div class="col-md-9 col-xs-12">
					<div class="table-responsive">
						<table style="font-size:15px;" class="table table-hover">
							<?php $job = app('App\Http\Controllers\EmployeeController')->getjobdetail($employee->job_id); ?>
							<tbody>
								<tr>
									<td><i class="icon wb-user m-r-10"></i> NAME</td>
									<td>{{$employee->name}}</td>
								</tr>
								<tr>
									<td><i class="icon wb-link m-r-10"></i> EMP. ID:</td>
									<td>{{$employee->emp_num}}</td>
								</tr>
								<tr>
									<td><i class="icon wb-plugin m-r-10"></i> JOB ROLE</td>
									<td>{{$job['title']}}</td>
								</tr>
								<tr>
									<td><i class="icon wb-mobile m-r-10"></i>TEL</td>
									<th>{{$employee->phone_num}}</th>
								</tr>
								<tr>
									<td style="font-size:15px;"><i class="icon wb-map m-r-10"></i> ADDRESS</td>
									<td>{{$employee->address}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

<div class="col-md-3 col-xs-12 pull-right">
					<img class="img-rounded img-bordered img-bordered-primary" width="150" height="150" src="{{asset('upload')}}/{{$employee->image}}">
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
						Goals and Objectives
						@if($deadline=='open')
						<button type="button" title="Add New Goal" class="btn btn-floating btn-danger btn-sm pull-right" id="newgoal" onclick="$('#newgoalForm').fadeIn('slow')">
							<i class="icon wb-plus" aria-hidden="true"></i>
						</button>
						@else
						@endif
					</h3>
				</div>
				<div class="panel-body">
					@if(count($lmgoals) > 0)
					<div class="panel-group panel-group-simple" id="siteMegaAccordion" aria-multiselectable="true" role="tablist">
						@foreach($lmgoals as $lmgoal)
						<?php $cmt = app('App\Http\Controllers\LMController')->getCommentd($employee->id, $lmgoal->id); ?>
						<div class="panel">
							<div class="panel-heading" id="pilotHeading{{$lmgoal->id}}" role="tab">
								<a class="panel-title" data-toggle="collapse" href="#pilotcollaps{{$lmgoal->id}}" data-parent="#siteMegaAccordion" aria-expanded="false" aria-controls="pilotcollaps{{$lmgoal->id}}">
									@if($deadline=='open' || review == 'open')
									<h4 class="text-success">
										<i class="fa fa-unlock-alt"></i>
										COMMITMENT
									</h4>
									@else
									<h4 class="text-warning">
										<i class="fa fa-lock"></i>
										COMMITMENT
									</h4>
									@endif
								</a>
								<div class="pull-right">
									<a href="javascript:void(0)" title="Edit" data-toggle="modal" data-target="#goaled{{$lmgoal->id}}"><i class="icon wb-edit"></i></a>
									<a class="text-danger" href="javascript:void(0)" title="Delete" onclick="modifyGoal({{$lmgoal->id}}, 2)"><i class="icon wb-power"></i></a>
									<i class="hide" id="status{{$lmgoal->id}}">Status: waiting...</i>
								</div>
								<span class="text-default">
									{{$lmgoal->commitment}}
								</span>
							</div>
							<div class="panel-collapse collapse" id="pilotcollaps{{$lmgoal->id}}" aria-labelledby="pilotHeading{{$lmgoal->id}}" role="tabpanel">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-2 col-xs-12">
											OBJECTIVE
										</div>
										<div class="col-md-10 col-xs-12">
											<ul>
												<li>{{$lmgoal->objective}}</li>
											</ul>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2 col-xs-12">
											EMPLOYEE COMMENTS
										</div>
										<div class="col-md-10 col-xs-12">
											<ul>
												@if(count($cmt) > 0)
												<li>
													@if($cmt->emp_comment != NULL)
													{{$cmt->emp_comment}} 
													@else
													No Comments Yet!
													@endif
												</li>
												@else
												<li>
													[No Comments Yet]
												</li>
												@endif
											</ul>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2 col-xs-12">
											Line Manager Comments
										</div>
										<div class="col-md-10 col-xs-12">
											<ul>
												@if(count($cmt) > 0)
												<li>
													@if($deadline=='open' || $review=='open')
													<p>
														<a href="javascript:void(0)" id="edit" onclick="editComm({{$lmgoal->id}})"><i class="icon wb-edit"></i> Edit Comment</a>

													</p>
													<div class="click2edit" id="{{$lmgoal->id}}" empid="{{$employee->id}}">
														{{$cmt->lm_comment}}
													</div>
													@else
													{{$cmt->lm_comment}}
													@endif
												</li>
												@else
												<li>
													@if($deadline=='open' || $review=='open')
													<p>
														<a href="javascript:void(0)" id="edit" onclick="editComm({{$lmgoal->id}})"><i class="icon wb-edit"></i> Comment</button>
													</p>
													<div class="click2edit" id="{{$lmgoal->id}}" empid="{{$employee->id}}">

													</div>
													@else

													@endif
												</li>
												@endif
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>
						@endforeach
					</div>
					@else
					<h3>NO ENTRY FOUND</h3>
					@endif
				</div>
			</div>
		</div>
	</div>
<input type="hidden" name="_lmtoken" id="_lmtoken" value="{{csrf_token()}}">
										

		<!--<div class="panel">
			<div class="panel-body container-fluid">
				<div class="row row-lg">
					<div class="col-md-12 col-xs-12">
						<!-- ToolbarWithLogAllHooks --
						<div class="example-wrap">
							<h4 clabtn-floatingss="example-title">Goals and Objectives</h4>
							<p>A little comments can go here. Anything.</p>
							@if($deadline=='open')
							<button type="button" title="Add New Goal" class="btn btn-floating btn-danger btn-sm" id="newgoal" onclick="$('#newgoalForm').fadeIn('slow')">
								<i class="icon wb-plus" aria-hidden="true"></i>
							</button>
							@else
							@endif
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
										@if(count($lmgoals) > 0)
										@foreach($lmgoals as $lmgoal)
										<?php $cmt = app('App\Http\Controllers\LMController')->getCommentd($employee->id, $lmgoal->id); ?>
										<tr>
											@if($deadline=='open')
											<th><i class="fa fa-unlock-alt"></i></th>
											@else
											<th><i class="fa fa-lock"></i></th>
											@endif
											<th style="width: 211px;">{{$lmgoal->commitment}}</th>
											<th style="width: 101px;">{{$lmgoal->objective}}</th>

											@if(count($cmt) > 0)
											<th style="width: 166px;">
												@if($cmt->emp_comment != NULL)
												{{$cmt->emp_comment}} 
												@else
												No Comments Yet!
												@endif
											</th>
											<th style="width: 400px;">
												@if($deadline=='open' || $review=='open')
												<p>
													<button type="button" class="btn btn-outline btn-success btn-sm" id="edit" onclick="editComm({{$lmgoal->id}})"><i class="fa fa-edit"></i> Edit</button>
													<a href="javascript:void(0)" title="Edit" data-toggle="modal" data-target="#goaled{{$lmgoal->id}}"><i class="icon wb-edit"></i></a>
													<a class="text-danger" href="javascript:void(0)" title="Delete" onclick="modifyGoal({{$lmgoal->id}}, 2)"><i class="icon wb-power"></i></a>
													<i class="hide" id="status{{$lmgoal->id}}">Status: waiting...</i>
												</p>
												<div class="click2edit" id="{{$lmgoal->id}}" empid="{{$employee->id}}">
													{{$cmt->lm_comment}}
												</div>
												@else
												{{$cmt->lm_comment}}
												@endif
											</th>
											@else
											<th style="width: 101px;">No Comments Yet</th>
											<th style="width: 465px;">
												@if($deadline=='open' || $review=='open')
												<p>
													<button type="button" class="btn btn-outline btn-success btn-sm" id="edit" onclick="editComm({{$lmgoal->id}})"><i class="fa fa-edit"></i> Edit</button>
													<a href="javascript:void(0)" title="Edit" data-toggle="modal" data-target="#goaled{{$lmgoal->id}}"><i class="icon wb-edit"></i></a>
													<a class="text-danger" href="javascript:void(0)" title="Delete" onclick="modifyGoal({{$lmgoal->id}}, 2)"><i class="icon wb-power"></i></a>
												</p>
												<div class="click2edit" id="{{$lmgoal->id}}" empid="{{$employee->id}}">

												</div>
												@else

												@endif
											</th>
											@endif

										</tr>
										@endforeach
										@else
										<tr>
											<th colspan="5"><h3 class="text-danger">NO ENTRY FOUND.</h3></th>
										</tr>
										@endif
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
							<input type="hidden" name="employee" id="newgoalemp" value="{{$employee->id}}">
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

	@if(count($lmgoals) > 0)
	@foreach($lmgoals as $lmgoal)
	<div class="modal fade" id="goaled{{$lmgoal->id}}" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1">
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
							<textarea class="form-control" style="height: 100px;resize: none;" id="editcommit{{$lmgoal->id}}">{{$lmgoal->commitment}}</textarea>
						</div>
						<div class="form-group col-xs-12 col-md-12">
							<label class="form-control-label">OBJECTIVE</label>
							<textarea class="form-control" style="height: 100px;resize: none;" id="editobject{{$lmgoal->id}}">{{$lmgoal->objective}}</textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-block" onclick="modifyGoal({{$lmgoal->id}}, 1)">Save changes</button>
					<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal -->
	@endforeach
	@endif

	<a class="btn btn-danger btn-outline" id="exampleCloseButton" data-plugin="toastr" data-message="Unfortunately something happened at our end and the system could not process your request. Please reload your browser and try again." data-title="Goal Setting" data-container-id="toast-bottom-right" data-close-button="true" data-tap-to-dismiss="false" data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button" style="display: none;">Generate</a>

	<a class="btn btn-danger btn-outline" id="exampleCloseButton2" data-plugin="toastr" data-message="New Goal Added Successfully." data-title="Goal Setting" data-container-id="toast-bottom-right" data-close-button="true" data-tap-to-dismiss="false" data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button" style="display: none;">Generate</a>

	<a class="btn btn-danger btn-outline" id="exampleCloseButton3" data-plugin="toastr" data-message="Goal Deleted Successfully." data-title="Goal Setting" data-container-id="toast-bottom-right" data-close-button="true" data-tap-to-dismiss="false" data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button" style="display: none;">Generate</a>

	<a class="btn btn-danger btn-outline" id="exampleCloseButton4" data-plugin="toastr" data-message="Update Successful." data-title="Goal Setting" data-container-id="toast-bottom-right" data-close-button="true" data-tap-to-dismiss="false" data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button" style="display: none;">Generate</a>
	@endsection

	<script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
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