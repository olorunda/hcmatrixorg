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
					<img style="margin:10px 10px 0 0" class="img-circle img-bordered img-bordered-primary" id="avatar{{$direct->id}}" width="70" height="70" src="{{asset($direct->image)}}" style="cursor: pointer;" title="{{$direct->name}}" data-toggle="modal" data-target="#manageEmployeeModal{{$direct->id}}">

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
								<div class="col-md-2">
									<img class="img-thumbnail img-bordered img-default" src="{{asset($direct->image)}}" align="left" style="width: 120px;height: 120px;margin-top: 10px;">
								</div>
								<div class="col-md-10">
									<h4>{{strtoupper($direct->name)}}</h4>
									<h5>Job Role: {{strtoupper($job['title'])}}</h5>
									<h5>Emp. ID.: {{strtoupper($direct->emp_num)}}</h5>
									<h5>Department: {{app('App\Http\Controllers\AvailJobController')->getDept($direct->workdept_id)}}</h5>
									<h5>Last Promoted on: {{niceDate($direct->last_promoted)}}</h5>
									<h5><b> </b>
									 <?php  $getrating=app('App\Http\Controllers\EmpController360')->getrate($direct->id,Auth::user()->id);  ?>
						 <script>
						 $(function(){
							 
							$('#rating{{$direct->id}}5').raty({ starType: 'i' });
							
						  $('#rating{{$direct->id}}5').raty('score', {{$getrating['rating']}});
						  
							$('#rating{{$direct->id}}5').raty('readOnly', true);
						 });
						</script>
							<span   id="rating{{$direct->id}}5"></span>
								   <br/>
                             <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Total Rating: {{$getrating['rating']}} )</span>
									</h5>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-6">
									<dl class="dl-horizontal">
										<dt><h5>E-Mail</h5></dt>
										<dd>{{$direct->email}}</dd>

										<dt><h5>Phone</h5></dt>
										<dd>{{$direct->phone_num}}</dd>
									</dl>
								</div>
								<div class="col-md-6">
									<dl class="dl-horizontal">
										<dt><h5>Sex</h5></dt>
										<dd>{{$direct->sex}}</dd>

										<dt><h5>Date of Birth</h5></dt>
										<dd>{{$direct->dob}} ({{$direct->age}})</dd>
									</dl>
								</div>
								<div class="col-md-12">
									<dl class="dl-horizontal">
										<dt><h5>Address</h5></dt>
										<dd>{{$direct->address}}</dd>
									</dl>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-6">
									<h4>Next Of Kin</h4>
									<dl class="dl-horizontal">
										<dt><h5>Name</h5></dt>
										<dd>{{$direct->next_of_kin}}</dd>

										<dt><h5>Relationship</h5></dt>
										<dd>{{$direct->kin_relationship}}</dd>
									</dl>
								</div>
								<div class="col-md-6">
								<h4 style="visibility: hidden;">Next Of Kin</h4>
									<dl class="dl-horizontal">
										<dt><h5>Phone</h5></dt>
										<dd>{{$direct->kin_phonenum}}</dd>
									</dl>
								</div>
								<div class="col-md-12">
									<dl class="dl-horizontal">
										<dt><h5>Address</h5></dt>
										<dd>{{$direct->kin_address}}</dd>
									</dl>
								</div>
							</div>
						</div>
						<?php $i = $idn = $j = $k = $l = 1; ?>
						<div class="tab-pane" id="headingDistinct2{{$direct->id}}" role="tabpanel">
							<div class="row">
								<div class="col-md-2">
									<img class="img-thumbnail img-bordered img-default" src="{{asset($direct->image)}}" align="left" style="width: 120px;height: 120px;margin-top: 10px;">
								</div>
								<div class="col-md-10">
									<h4>{{strtoupper($direct->name)}}</h4>
									<h5>Job Role: {{strtoupper($job['title'])}}</h5>
									<h5>Emp. ID.: {{strtoupper($direct->emp_num)}}</h5>
									<h5>Department: {{app('App\Http\Controllers\AvailJobController')->getDept($direct->workdept_id)}}</h5>
									<h5>Last Promoted on: {{niceDate($direct->last_promoted)}}</h5>
									<h5><b> </b>
									 <?php  $getrating=app('App\Http\Controllers\EmpController360')->getrate($direct->id,Auth::user()->id);  ?>
						 <script>
						 $(function(){
							 
							$('#rating{{$direct->id}}3').raty({ starType: 'i' });
							
						  $('#rating{{$direct->id}}3').raty('score', {{$getrating['rating']}});
						  
							$('#rating{{$direct->id}}3').raty('readOnly', true);
						 });
						</script>
							<span   id="rating{{$direct->id}}3"></span>
								   <br/>
                             <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Total Rating: {{$getrating['rating']}} )</span>
									</h5>
								</div>
							</div>
							<hr>
							@include('employee.tab-content')
						</div>
						<div class="tab-pane" id="headingDistinct3{{$direct->id}}" role="tabpanel">
							<div class="row">
								<div class="col-md-2">
									<img class="img-thumbnail img-bordered img-default" src="{{asset($direct->image)}}" align="left" style="width: 120px;height: 120px;margin-top: 10px;">
								</div>
								<div class="col-md-10">
									<h4>{{strtoupper($direct->name)}}</h4>
									<h5>Job Role: {{strtoupper($job['title'])}}</h5>
									<h5>Emp. ID.: {{strtoupper($direct->emp_num)}}</h5>
									<h5>Department: {{app('App\Http\Controllers\AvailJobController')->getDept($direct->workdept_id)}}</h5>
									<h5>Last Promoted on: {{niceDate($direct->last_promoted)}}</h5>
									<h5><b> </b>
									 <?php  $getrating=app('App\Http\Controllers\EmpController360')->getrate($direct->id,Auth::user()->id);  ?>
						 <script>
						 $(function(){
							 
							$('#rating{{$direct->id}}2').raty({ starType: 'i' });
							
						  $('#rating{{$direct->id}}2').raty('score', {{$getrating['rating']}});
						  
							$('#rating{{$direct->id}}2').raty('readOnly', true);
						 });
						</script>
							<span   id="rating{{$direct->id}}2"></span>
								   <br/>
                             <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Total Rating: {{$getrating['rating']}} )</span>
									</h5>
								</div>
							</div>
							<hr>
							@include('employee.tab-content-idp')
						</div>
						<div class="tab-pane" id="headingDistinct4{{$direct->id}}" role="tabpanel">
							<div class="row">
								<div class="col-md-2">
									<img class="img-thumbnail img-bordered img-default" src="{{asset($direct->image)}}" align="left" style="width: 120px;height: 120px;margin-top: 10px;">
								</div>
								<div class="col-md-10">
									<h4>{{strtoupper($direct->name)}}</h4>
									<h5>Job Role: {{strtoupper($job['title'])}}</h5>
									<h5>Emp. ID.: {{strtoupper($direct->emp_num)}}</h5>
									<h5>Department: {{app('App\Http\Controllers\AvailJobController')->getDept($direct->workdept_id)}}</h5>
									<h5>Last Promoted on: {{niceDate($direct->last_promoted)}}</h5>
									<h5><b> </b>
									 <?php  $getrating=app('App\Http\Controllers\EmpController360')->getrate($direct->id,Auth::user()->id);  ?>
						 <script>
						 $(function(){
							 
							$('#rating{{$direct->id}}1').raty({ starType: 'i' });
							
						  $('#rating{{$direct->id}}1').raty('score', {{$getrating['rating']}});
						  
							$('#rating{{$direct->id}}1').raty('readOnly', true);
						 });
						</script>
							<span   id="rating{{$direct->id}}1"></span>
								   <br/>
                             <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Total Rating: {{$getrating['rating']}} )</span>
									</h5>
								</div>
							</div>
							<hr>
							@include('employee.tab-content-careers')
						</div>
						<div class="tab-pane" id="headingDistinct5{{$direct->id}}" role="tabpanel">
							<div class="row">
								<div class="col-md-2">
									<img class="img-thumbnail img-bordered img-default" src="{{asset($direct->image)}}" align="left" style="width: 120px;height: 120px;margin-top: 10px;">
								</div>
								<div class="col-md-10">
									<h4>{{strtoupper($direct->name)}}</h4>
									<h5>Job Role: {{strtoupper($job['title'])}}</h5>
									<h5>Emp. ID.: {{strtoupper($direct->emp_num)}}</h5>
									<h5>Department: {{app('App\Http\Controllers\AvailJobController')->getDept($direct->workdept_id)}}</h5>
									<h5>Last Promoted on: {{niceDate($direct->last_promoted)}}</h5>
									<h5><b> </b>
									 <?php  $getrating=app('App\Http\Controllers\EmpController360')->getrate($direct->id,Auth::user()->id);  ?>
						 <script>
						 $(function(){
							 
							$('#rating{{$direct->id}}4').raty({ starType: 'i' });
							
						  $('#rating{{$direct->id}}4').raty('score', {{$getrating['rating']}});
						  
							$('#rating{{$direct->id}}4').raty('readOnly', true);
						 });
						</script>
							<span   id="rating{{$direct->id}}4"></span>
								   <br/>
                             <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Total Rating: {{$getrating['rating']}} )</span>
									</h5>
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
@endsection