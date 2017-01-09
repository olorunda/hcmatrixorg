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

<div class="page-header">
	<h1 class="page-title">L.M. Objectives</h1>
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
						<table class="table table-hover">
							<?php $job = app('App\Http\Controllers\EmployeeController')->getjobdetail($employee->job_id); ?>
							<tbody>
								<tr>
									<th><i class="icon wb-user m-r-10"></i> NAME</th>
									<th>{{$employee->name}}</th>
								</tr>
								<tr>
									<th><i class="icon wb-link m-r-10"></i> EMP. ID:</th>
									<th>{{$employee->emp_num}}</th>
								</tr>
								<tr>
									<th><i class="icon wb-plugin m-r-10"></i> JOB ROLE</th>
									<th>{{$job['title']}}</th>
								</tr>
								<tr>
									<th><i class="icon wb-mobile m-r-10"></i>TEL</th>
									<th>{{$employee->phone_num}}</th>
								</tr>
								<tr>
									<th><i class="icon wb-map m-r-10"></i> ADDRESS</th>
									<th>{{$employee->address}}</th>
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
	<?php $deadline = app('App\Http\Controllers\LMController')->checkDeadline(month($fiscal['start_month']), $fiscal['grace']); ?>
	<?php $review   = app('App\Http\Controllers\LMController')->review(month($fiscal['start_month']), $fiscal['grace']); ?>
	

	<!-- <div class="panel">
		<div class="panel-body container-fluid">
			<div class="row row-lg">
				<div class="col-lg-12 col-xs-12">
				<div class="col-lg-12 col-xs-12">
              <!-- Card
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white">
                  <i class="icon icon-circle icon-2x wb-clipboard bg-red-600" aria-hidden="true"></i>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number">{{count($pilots)}}</span>
                    <span class="counter-number-related text-capitalize">Total</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">Pilot goals</div>
                </div>
              </div>
              <!-- End Card 
            </div>
					
					<!-- End Example Bar 
				</div>				
			</div>
		</div>
	</div> -->
 
	<div class="panel">
		<div class="panel-body container-fluid">
			<div class="row row-lg">
				<div class="col-lg-12 col-xs-12">
					<div class="table-responsive">
						<table class="table ">
							<thead>
								<tr class="bg-blue-grey-100">
									<th>#</th>
									<th>COMMITMENT</th>
									<th>OBJECTIVE</th>
									<th>HR RATE</th>
									<th>COMMENTS</th>
									<th>MY RATING</th>
								</tr>
							</thead>
							<tbody>
								@if(count($pilots) > 0)
								<input type="hidden" name="_ratetoken" id="_ratetoken" value="{{csrf_token()}}">
								<?php $counter=0; ?>
								@foreach($pilots as $pilot)
								<?php $adminrating = app('App\Http\Controllers\LMController')->getRating($employee->id, $pilot->id); ?>
								<tr>
									<th>{{$counter+=1}}</th>
									<th style="width: 300px;">{{$pilot->commitment}}</th>
									<th style="width: 300px;">{{$pilot->objective}}</th>

									@if(count($adminrating) > 0)

									@if($adminrating->admin_rate==0)
									<th>Not Yet Rated!</th>
									@else
									<th style="width: 150px;">{{$adminrating->admin_rate}}</th>
									@endif

									<th style="width: 200px;">{{$adminrating->lm_comment}}</th>

									<th>
										{{$adminrating->lm_rate}}
									</th>

									@else
									<th>Not Yet Rated!</th>
									<th style="width: 200px;">No Comments Found.</th>
									<th style="width: 200px;">
										<!--<div class="rating" id="rating{{$pilot->id}}" data-plugin="rating" data-target="#exampleHintTarget"
										data-hints="1 - Bad,2 - Poor,3 - Okay,4 - Good,5 - Excellent"></div>
										<div class="rating-hint" id="exampleHintTarget"></div>-->
										@if($fiscal['end_month'] != date('m'))
										<h5>Rating is currently locked. You will receive a notification once rating is available.</h5>
										@else
										<div class="ratemp" id="{{$pilot->id}}"></div> <i id="hint{{$pilot->id}}"></i>
										@endif
									</th>
									@endif
								</tr>
								@endforeach
								@else
								<tr>
									<th colspan="6">
										<h3>No Pilot Goals To Rate.</h3>
									</th>
								</tr>
								@endif
							</tbody>
						</table>

						@if(count($pilots) > 0)
						@foreach($pilots as $pilot)
						<!-- Example Sidebar -->
						<div class="example-wrap">
							<div class="example">
								<!-- Modal -->
								<div class="modal fade" id="ratecomments{{$pilot->id}}" aria-hidden="true" aria-labelledby="examplePositionSidebar"
									role="dialog" tabindex="-1">
									<div class="modal-dialog modal-sidebar modal-sm">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
												<h4 class="modal-title">{{$employee->name}}</h4>
											</div>
											<div class="modal-body">
												<img class="img-rounded img-bordered img-bordered-primary" width="150" height="150" src="{{asset('upload')}}/{{$employee->image}}">
												<br>
											<!--<div class="form-group">
												<label for="commitment{{$pilot->id}}">Commitment</label>
												<textarea class="form-control" id="commitment{{$pilot->id}}" disabled="disabled">{{$pilot->commitment}}</textarea>
											</div>
											<div class="form-group">
												<label for="objective{{$pilot->id}}">Objective</label>
												<textarea class="form-control" id="objective{{$pilot->id}}" disabled="disabled">{{$pilot->commitment}}</textarea>
											</div>-->
											<div class="form-group">
												<label for="ratingval{{$pilot->id}}">Rating</label>
												<input type="number" max="5" min="1" class="form-control" name="rating" id="ratingval{{$pilot->id}}" value="">
											</div>
											<div class="form-group">
												<label for="lmcomment{{$pilot->id}}">Comment</label>
												<textarea class="form-control" id="lmcomment{{$pilot->id}}"></textarea>
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
				</div>
			</div>
		</div>
	</div>
</div>
</div>

@endsection