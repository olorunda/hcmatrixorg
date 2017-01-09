@extends('layouts.app')

@section('content')
<script src="../../global/vendor/jquery/jquery.js"></script>
<script>
	function url(url)
	{
		window.location=url;
	}
</script>
<!--<script type="text/javascript" src="{{asset('assets/js/jquery.transit.min.js')}}"></script>
<script type="text/javascript">
	$(function(){
		$(".img-circle").on("mouseover", function(){
			$(this).transition({ scale: 2.2 });
			console.log($(this).attr());
		});
	});
</script>-->
<?php
function niceDate($date)
{
	return date("l, jS \of F, Y. h:i:s A", strtotime($date));
}
?>
<div class="page-header">
	<h1 class="page-title">Goals Management</h1>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{url('lm/objectives_c')}}">Goal Management</a></li>
		<li class="breadcrumb-item active">Goals Mgt.</li>
	</ol>
</div>
<div class="page-content">
	<div class="row row-lg">
		<div class="col-md-12 col-xs-12">
			<div class="panel panel-bordered panel-dark">
				<div class="panel-heading">
					<h3 class="panel-title">Direct Reports <small style="color: white;">click an employee to comment.</small></h3>
				</div>
				<div class="panel-body">
					@if(count($directemps) > 0)
					@foreach($directemps as $direct)
					<?php $job = app('App\Http\Controllers\EmployeeController')->getjobdetail($direct->job_id); ?>
					<img class="img-circle img-bordered img-bordered-primary" id="avatar{{$direct->id}}" width="80" height="80" src="{{asset('upload')}}/{{$direct->image}}" style="cursor: pointer;" title="{{$direct->name}}" data-toggle="modal" data-target="#manageEmployeeModal{{$direct->id}}">
			
					<input type="hidden" name="last" id="last" value="{{$direct->id}}">
					@endforeach
					<p>{{ $directemps->links() }}</p>
					@else
					<h3>No Direct Employees Assigned to You Yet.</h3>
					@endif
				</div>
			</div>
		</div>
	</div>

	@if(count($directemps) > 0)
	@foreach($directemps as $direct)
	<div class="modal fade modal-rotate-from-bottom" id="manageEmployeeModal{{$direct->id}}" aria-hidden="true" aria-labelledby="heading{{$direct->id}}" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="heading{{$direct->id}}">{{strtoupper($direct->name)}}</h4>
				</div>
				<ul class="nav nav-tabs nav-tabs-line" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link active" data-toggle="tab" href="#headingDistinct1{{$direct->id}}" aria-controls="headingDistinct{{$direct->id}}" role="tab">
							<i class="fa fa-home"></i> Home
						</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" data-toggle="tab" href="#headingDistinct2{{$direct->id}}" aria-controls="headingDistinct2{{$direct->id}}" role="tab">
							<i class="fa fa-plane"></i> Pilot Goals
						</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" data-toggle="tab" href="#headingDistinct3{{$direct->id}}" aria-controls="headingDistinct4{{$direct->id}}" role="tab">
							<i class="fa fa-graduation-cap"></i> Individual Development Plans
						</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" data-toggle="tab" href="#headingDistinct4{{$direct->id}}" aria-controls="headingDistinct4{{$direct->id}}" role="tab">
							<i class="fa fa-line-chart"></i> Career Aspirations
						</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" data-toggle="tab" href="#headingDistinct5{{$direct->id}}" aria-controls="headingDistinct5{{$direct->id}}" role="tab">
							<i class="fa fa-cogs"></i> Employee Management
						</a>
					</li>
				</ul>
				<div class="modal-body">
					<div class="tab-content">
						<div class="tab-pane active" id="headingDistinct1{{$direct->id}}" role="tabpanel">
							<div class="row">
								<div class="col-md-3">
									<img class="img-thumbnail img-bordered img-default" src="{{asset('upload')}}/{{$direct->image}}" align="left" style="height: 100%;">
								</div>
								<div class="col-md-9">
									<h4>{{strtoupper($direct->name)}}</h4>
									<h5>Job Role: {{strtoupper($job['title'])}}</h5>
									<h5>Emp. ID.: {{strtoupper($direct->emp_num)}}</h5>
									<h5>Department: {{app('App\Http\Controllers\AvailJobController')->getDept($direct->workdept_id)}}</h5>
									<h5>Last Promoted on: {{niceDate($direct->last_promoted)}}</h5>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-6">
									<dl class="dl-horizontal">
										<dt>E-Mail</dt>
										<dd>{{$direct->email}}</dd>

										<dt>Phone</dt>
										<dd>{{$direct->phone_num}}</dd>
									</dl>
								</div>
								<div class="col-md-6">
									<dl class="dl-horizontal">
										<dt>Sex</dt>
										<dd>{{$direct->sex}}</dd>

										<dt>Date of Birth</dt>
										<dd>{{$direct->dob}} ({{$direct->age}})</dd>
									</dl>
								</div>
								<div class="col-md-12">
									<dl class="dl-horizontal">
										<dt>Address</dt>
										<dd>{{$direct->address}}</dd>
									</dl>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-6">
									<dl class="dl-horizontal">
										<dt>Next of Kin</dt>
										<dd>{{$direct->next_of_kin}}</dd>

										<dt>Relationship</dt>
										<dd>{{$direct->kin_relationship}}</dd>
									</dl>
								</div>
								<div class="col-md-6">
									<dl class="dl-horizontal">
										<dt>Phone</dt>
										<dd>{{$direct->kin_phonenum}}</dd>
									</dl>
								</div>
								<div class="col-md-12">
									<dl class="dl-horizontal">
										<dt>Address</dt>
										<dd>{{$direct->kin_address}}</dd>
									</dl>
								</div>
							</div>
						</div>
						<?php $i = $idn = $j = $k = $l = 1; ?>
						<div class="tab-pane" id="headingDistinct2{{$direct->id}}" role="tabpanel">
							<div class="row">
								<div class="col-md-3">
									<img class="img-thumbnail img-bordered img-default" src="{{asset('upload')}}/{{$direct->image}}" align="left" style="height: 100%;">
								</div>
								<div class="col-md-9">
									<h4>{{strtoupper($direct->name)}}</h4>
									<h5>Job Role: {{strtoupper($job['title'])}}</h5>
									<h5>Emp. ID.: {{strtoupper($direct->emp_num)}}</h5>
									<h5>Department: {{app('App\Http\Controllers\AvailJobController')->getDept($direct->workdept_id)}}</h5>
									<h5>Last Promoted on: {{niceDate($direct->last_promoted)}}</h5>
								</div>
							</div>
							<hr>
							@include('employee.tab-content')
						</div>
						<div class="tab-pane" id="headingDistinct3{{$direct->id}}" role="tabpanel">
							<div class="row">
								<div class="col-md-3">
									<img class="img-thumbnail img-bordered img-default" src="{{asset('upload')}}/{{$direct->image}}" align="left" style="height: 100%;">
								</div>
								<div class="col-md-9">
									<h4>{{strtoupper($direct->name)}}</h4>
									<h5>Job Role: {{strtoupper($job['title'])}}</h5>
									<h5>Emp. ID.: {{strtoupper($direct->emp_num)}}</h5>
									<h5>Department: {{app('App\Http\Controllers\AvailJobController')->getDept($direct->workdept_id)}}</h5>
									<h5>Last Promoted on: {{niceDate($direct->last_promoted)}}</h5>
								</div>
							</div>
							<hr>
							@include('employee.tab-content-idp')
						</div>
						<div class="tab-pane" id="headingDistinct4{{$direct->id}}" role="tabpanel">
							<div class="row">
								<div class="col-md-3">
									<img class="img-thumbnail img-bordered img-default" src="{{asset('upload')}}/{{$direct->image}}" align="left" style="height: 100%;">
								</div>
								<div class="col-md-9">
									<h4>{{strtoupper($direct->name)}}</h4>
									<h5>Job Role: {{strtoupper($job['title'])}}</h5>
									<h5>Emp. ID.: {{strtoupper($direct->emp_num)}}</h5>
									<h5>Department: {{app('App\Http\Controllers\AvailJobController')->getDept($direct->workdept_id)}}</h5>
									<h5>Last Promoted on: {{niceDate($direct->last_promoted)}}</h5>
								</div>
							</div>
							<hr>
							@include('employee.tab-content-careers')
						</div>
						<div class="tab-pane" id="headingDistinct5{{$direct->id}}" role="tabpanel">
							<div class="row">
								<div class="col-md-3">
									<img class="img-thumbnail img-bordered img-default" src="{{asset('upload')}}/{{$direct->image}}" align="left" style="height: 100%;">
								</div>
								<div class="col-md-9">
									<h4>{{strtoupper($direct->name)}}</h4>
									<h5>Job Role: {{strtoupper($job['title'])}}</h5>
									<h5>Emp. ID.: {{strtoupper($direct->emp_num)}}</h5>
									<h5>Department: {{app('App\Http\Controllers\AvailJobController')->getDept($direct->workdept_id)}}</h5>
									<h5>Last Promoted on: {{niceDate($direct->last_promoted)}}</h5>
								</div>
							</div>
							<hr>
							@include('employee.tab-content-organogram')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal -->
	@endforeach
	@endif
	<input type="hidden" name="_lmtoken" id="lmtoken" value="{{csrf_token()}}">
	@if(count($pilots) > 0)
	<div class="row row-lg">
		<div class="col-md-12 col-xs-12">
			<div class="panel panel-bordered" style="margin-bottom: 4px;">
				<div class="panel-heading">
					<h3 class="panel-title">PILOT GOALS</h3>
				</div>
				<div class="panel-body">
					<div class="panel-group panel-group-simple" id="siteMegaAccordion" aria-multiselectable="true" role="tablist">
						@foreach($pilots as $pilot)
						<div class="panel">
							<div class="panel-heading" id="pilotHeading{{$pilot->id}}" role="tab">
								<a class="panel-title" data-toggle="collapse" href="#pilotcollaps{{$pilot->id}}" data-parent="#siteMegaAccordion" aria-expanded="false" aria-controls="pilotcollaps{{$pilot->id}}">
									<h4 class="text-warning">COMMITMENT</h4>
								</a>
								<span class="text-default">
									{{$pilot->commitment}}
								</span>
							</div>
							<div class="panel-collapse collapse" id="pilotcollaps{{$pilot->id}}" aria-labelledby="pilotHeading{{$pilot->id}}" role="tabpanel">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12 col-xs-12">
											<h4>OBJECTIVE</h4>
											<ul>
												<li>
													{{$pilot->objective}}
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
	@else
	<div class="row row-lg">
		<div class="panel">
			<div class="panel-body">
				<h1>No Pilot Goals Set Yet. Please check back later.</h1>
			</div>
		</div>
	</div>
	@endif


</div>
@endsection