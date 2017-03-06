@extends('layouts.app')

@section('content')
<script src="../../global/vendor/jquery/jquery.js"></script>
<script type="text/javascript">
	$(function(){  

		@include('script.morris') 

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
		<li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{url('lm/objectives_c')}}">Performance Review</a></li>
		<li class="breadcrumb-item active">Employee Performance Rating</li>
	</ol>
	<div class="page-header-actions">
		<!--<a class="btn btn-sm btn-default btn-outline btn-round" href="{{url('/lm/objectives_c')}}">
			<i class="icon wb-arrow-left" aria-hidden="true"></i>
			<span class="hidden-sm-down">Back</span>
		</a>-->

		<select class="form-control" id="changeemp" data-plugin="select2" data-placeholder="Select Employee" data-allow-clear="true" style="width: 200px;" onchange="window.location='/lm/rate?isemp='+ $(this).val();">
			<option value=""></option>
			<optgroup label="Direct Employees">
				@foreach($directemps as $direct)
				<option value="{{$direct->id}}">{{$direct->name}}</option>
				@endforeach
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
								@if(isset($employee->name)){{$employee->name}}@else NILL @endif
								<p></p>
							</div>
							<div class="col-md-3">
								<i class="icon wb-link m-r-10 btn-pure btn-info"></i> ID
							</div>
							<div class="col-md-9">
								@if($employee->emp_num == '')NILL @else{{$employee->emp_num}}@endif
								<p></p>
							</div>
							<div class="col-md-3">
								<i class="icon wb-plugin m-r-10 btn-pure btn-warning"></i> JOB ROLE
							</div>
							<div class="col-md-9">
								@if($job['title'] == '')NILL @else{{$job['title']}}@endif
								<p></p>
							</div>
							<div class="col-md-3">
								<i class="icon wb-mobile m-r-10 btn-pure btn-danger"></i> TEL
							</div>
							<div class="col-md-9">
								@if($employee->phone_num == '')NILL @else{{$employee->phone_num}}@endif
								<p></p>
							</div>
							<div class="col-md-3">
								<i class="icon wb-map m-r-10 btn-pure btn-dark"></i> ADDRESS
							</div>
							<div class="col-md-9">
								@if($employee->address == '')NILL @else{{$employee->address}}@endif
							</div>
						</div>					</div>
					</div>

					<div class="col-md-3 col-xs-12 pull-right">
						<img class="img-rounded img-bordered img-bordered-primary" width="150" height="150" src="{{asset('storage')}}/{{$employee->image}}">
					</div>
				</div>
			</div>
			<div class="pull-right">

			</div>
		</div>
		<?php $deadline = app('App\Http\Controllers\LMController')->checkDeadline(month($fiscal['start_month']), $fiscal['grace']); ?>
		<?php $review   = app('App\Http\Controllers\LMController')->review(month($fiscal['start_month']), $fiscal['grace']); ?>

		@if(count($pilots) > 0)
		<?php $goalCounter = 0; $counter = 0; ?> 
		<input type="hidden" name="_ratetoken" id="_ratetoken" value="{{csrf_token()}}">
		<div class="row row-lg">
			<div class="col-md-12 col-xs-12">
				<div class="panel panel-bordered" style="margin-bottom: 4px;">
					<div class="panel-heading">
						<h3 class="panel-title">PILOT GOALS <!--- @if(session()->has('FY')) {{ session('FY') }} @else {{ date('Y-m-d') }} @endif--></h3>
					</div>
					<div class="panel-body">
						<div class="panel-group panel-group-simple" id="siteMegaAccordion" aria-multiselectable="true" role="tablist">
							@foreach($pilots as $pilot)
							<?php $adminrating = app('App\Http\Controllers\LMController')->getRating($employee->id, $pilot->id); ?>
							<div class="panel">
								<div class="panel-heading" id="pilotHeading{{$pilot->id}}" role="tab">
									<a class="panel-title" data-toggle="collapse" href="#pilotcollaps{{$pilot->id}}" data-parent="#siteMegaAccordion" aria-expanded="false" aria-controls="pilotcollaps{{$pilot->id}}">
										<h4 class="text-warning">COMMITMENT {{ $goalCounter+=1 }}</h4>
									</a>
									<span class="text-default">
										{{$pilot->commitment}}
									</span>
								</div>
								<div class="panel-collapse collapse" id="pilotcollaps{{$pilot->id}}" aria-labelledby="pilotHeading{{$pilot->id}}" role="tabpanel">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<h4>Objective(s)</h4>
												<ul>
													<li>
														{{$pilot->objective}}
													</li>
												</ul>
											</div>
											<div class="col-md-12 col-xs-12">
												<h4>HR Rating</h4>
												<ul>
													<li>
														@if( isset($adminrating) && count($adminrating) > 0 )

														@if($adminrating['admin_rate']==0)
														<p>Not Yet Rated!</p>

														@if(Auth::user()->role == 3)

														@if(session()->has('FY') && session('FY') == date('Y'))

														@if($disable!='')
														<h5>Rating is currently locked. You will receive a notification once rating is available.</h5>
														@else
														<div class="ratemp" id="{{$pilot->id}}"></div> <i id="hint{{$pilot->id}}"></i>
														@endif
														<!--endif($disable != '') -->

														@endif
														<!--endif(($request->session()->has('FY') && session('FY') == date('Y'))) -->

														@endif
														<!--endif(Auth::user()->role == 3) -->


														@else
														<!--elseif($adminrating->admin_rate == 0) -->

														{{$adminrating['admin_rate']}}

														@if(Auth::user()->role == 3)

														@if(session()->has('FY') && session('FY') == date('Y'))
														<a href="javascript:void(0)" data-toggle="modal" data-target="#ratecomments{{$pilot->id}}" title="Edit Rating">
															<i class="fa fa-edit"></i>
														</a>
														@endif
														<!--endif(session()->has('FY') && session('FY') == date('Y')) -->


														@endif
														<!--endif(Auth::user()->role == 3) -->

														@endif
														<!--endif($adminrating->Admin_rate === 0)-->

														@else
														<!--elseif(isset($adminrating) && count($adminrating) > 0) -->

														<p>Not Yet Rated!</p>

														@if(Auth::user()->role == 3)

														@if(session()->has('FY') && session('FY') == date('Y'))

														@if($disable!='')
														<h5>Rating is currently locked. You will receive a notification once rating is available.</h5>
														@else
														<div class="ratemp" id="{{$pilot->id}}"></div> <i id="hint{{$pilot->id}}"></i>
														@endif
														<!--endif($disable != '') -->

														@endif
														<!--endif(($request->session()->has('FY') && session('FY') == date('Y'))) -->

														@endif
														<!--endif(Auth::user()->role == 3) -->

														@endif
														<!--endif(isset($adminrating) && count($adminrating) > 0) -->
													</li>
												</ul>
											</div>
											<div class="col-md-12 col-xs-12">
												<h4>HR Comments</h4>
												<ul>
													<li>
														@if( isset($adminrating) && count($adminrating) > 0 )

														{{$adminrating['admin_comment']}}

														@else
														<p>No Comments Found.</p>
														@endif
													</li>
												</ul>
											</div>

											<div class="col-md-12 col-xs-12">
												<h4>Line Manager Rating</h4>
												<ul>
													<li>
														@if( isset($adminrating) && count($adminrating) > 0 )

														@if($adminrating['lm_rate'] == 0)
														<p>Not Yet Rated!</p>

														@if(Auth::user()->role == 2)

														@if(session()->has('FY') && session('FY') == date('Y'))

														@if($disable!='')
														<h5>Rating is currently locked. You will receive a notification once rating is available.</h5>
														@else
														<div class="ratemp" id="{{$pilot->id}}"></div> <i id="hint{{$pilot->id}}"></i>
														@endif
														<!--endif($disable != '') -->

														@endif
														<!--endif($request->session()->has('FY') && session('FY') == date('Y')) -->

														@endif
														<!--endif(Auth::user()->role == 2) -->


														@else
														<!--elseif($adminrating->lm_rate === 0) -->

														{{$adminrating['lm_rate']}}

														@if(Auth::user()->role == 2)

														@if(session()->has('FY') && session('FY') == date('Y'))
														<a href="javascript:void(0)" data-toggle="modal" data-target="#ratecomments{{$pilot->id}}" title="Edit Rating">
															<i class="fa fa-edit"></i>
														</a>
														@endif
														<!--endif(session()->has('FY') && session('FY') == date('Y'))-->

														@endif
														<!--endif(Auth::user()->role == 3) -->


														@endif
														<!--endif($adminrating->lm_rate == 0) -->

														@else
														<!--elseif(isset($adminrating) && count($adminrating) > 0) -->

														<p>Not Yet Rated!</p>

														@if(Auth::user()->role == 2)

														@if(session()->has('FY') && session('FY') == date('Y'))

														@if($disable!='')
														<h5>Rating is currently locked. You will receive a notification once rating is available.</h5>
														@else
														<div class="ratemp" id="{{$pilot->id}}"></div> <i id="hint{{$pilot->id}}"></i>
														@endif
														<!--endif($disable != '') -->

														@endif
														<!--endif(($request->session()->has('FY') && session('FY') == date('Y'))) -->

														@endif
														<!--endif(Auth::user()->role == 2)-->


														@endif
														<!--endif(isset($adminrating) && count($adminrating) > 0) -->
													</li>
												</ul>
											</div>
											<div class="col-md-12 col-xs-12">
												<h4>Line Manager Comments</h4>
												<ul>
													<li>
														@if( isset($adminrating) && count($adminrating) > 0 )

														@if($adminrating['lm_comment'] != NULL)
														{{$adminrating['lm_comment']}}
														@else
														No Comments Found.
														@endif

														@else

														<p>No Comments Found.</p>
														@endif
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style="height: 50px;"></div>
		@else
		<div class="row row-lg">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-body">
						<h3 class="no-pilot">No Pilot Goals Set Yet. Please check back later.</h3>
					</div>
				</div>
			</div>
		</div>
		@endif

	</div>



	@if(count($pilots) > 0)
	@foreach($pilots as $pilot)
	<?php $adminrating = app('App\Http\Controllers\LMController')->getRating($employee->id, $pilot->id); ?>
	<!-- Example Sidebar -->
	<div class="example-wrap">
		<div class="example">
			<!-- Modal -->
			<div class="modal fade" id="ratecomments{{$pilot->id}}" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">{{$employee->name}}</h4>
						</div>
						<div class="modal-body">
						<!--	<img class="img-rounded img-bordered img-bordered-primary" width="150" height="150" src="{{asset('storage')}}/{{$employee->image}}"> -->
							<br>
							<div class="form-group">
								<label for="ratingval{{$pilot->id}}">Rating</label>
								@if(Auth::user()->role == 3)
								<input type="number" max="5" min="1" class="form-control" name="rating" id="ratingval{{$pilot->id}}" value="@if(count($adminrating) > 0){{$adminrating['admin_rate']}}@endif">
								@else
								<input type="number" max="5" min="1" class="form-control" name="rating" id="ratingval{{$pilot->id}}" value="@if(count($adminrating) > 0){{$adminrating['lm_rate']}}@endif">
								@endif
							</div>
							<div class="form-group">
								<label for="lmcomment{{$pilot->id}}">Comment</label>
								@if(Auth::user()->role == 3)
								<textarea class="form-control" id="lmcomment{{$pilot->id}}">@if(count($adminrating) > 0) @if($adminrating['admin_comment'] != NULL) {{$adminrating['admin_comment']}} @endif @endif</textarea>
								@else
								<textarea class="form-control" id="lmcomment{{$pilot->id}}">@if(count($adminrating) > 0) @if($adminrating['lm_comment'] != NULL) {{$adminrating['lm_comment']}} @endif @endif</textarea>
								@endif
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success btn-block" onclick="saverating({{$pilot->id}}, {{$employee->id}})">
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
	@endforeach
	@endif
	@endsection