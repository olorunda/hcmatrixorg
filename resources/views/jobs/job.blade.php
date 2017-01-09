@extends('layouts.app_guest')

@section('content')
<script src="../../global/vendor/jquery/jquery.js"></script>
<script>
	function url(url)
	{	
		window.location=url;
	}
</script>
<?php
function niceDate($date)
{
	return date("l, jS \of F, Y. h:i:s A", strtotime($date));
}
?>
<div class="page-header" style="margin-top: -40px;">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0)" onclick="url('{{url('available_jobs')}}/joblist')">Available Jobs</a></li>
		<li class="breadcrumb-item active">You are Here</li>
	</ol>
	<h1 class="page-title">{{$jobDetail->title}}</h1>
	<div class="page-header-actions">
		<button type="button" class="btn btn-icon social-facebook" data-placement="top" data-toggle="tooltip" title="Like">
			<i class="icon bd-facebook" aria-hidden="true"></i>
		</button>
		<button type="button" class="btn btn-icon social-twitter" data-placement="bottom" data-toggle="tooltip" title="Tweet">
			<i class="icon bd-twitter" aria-hidden="true"></i>
		</button>
		<button type="button" class="btn btn-icon social-linkedin" data-placement="left" data-toggle="tooltip" title="Share">
			<i class="icon bd-linkedin" aria-hidden="true"></i>
		</button>
		<button type="button" class="btn btn-icon btn-danger" data-placement="top" data-toggle="tooltip" title="Send as mail">
			<i class="icon wb-link-intact"></i>
		</button>
	</div>
</div>
<!--<h3>
	<button type="button" class="btn btn-round btn-outline btn-default" onclick="url('{{url('job')}}/joblist')"><i class="icon wb-arrow-left"></i> Go Back</button>
	<i class="fa fa-suitcase"></i> Web Developer
</h3>-->
<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 col-xs-12">
			<!-- STARTING HERE NOW -->
				@if($errors->any())
				<div class="alert alert-danger">
						<h4>Sorry! This application for this position is closed. Please try other job openings.</h4>
				</div>
				@endif
			</div>
			<div class="col-md-2 col-xs-12">
				<h5>Summary</h5>
			 
				</div>
			<div class="col-md-10 col-xs-12">
				<ul>
					<li class="text-default">
				
			{{substr($jobDetail->job_desc,1,300)}}...
					</li>
				</ul>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<h5>Experience Required</h5>
			</div>
			<div class="col-md-10 col-xs-12">
				<ul>
					<li class="text-default">
						{{$jobDetail->required_exp}}
					</li>
				</ul>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<h5>Job Description</h5>
			</div>
			<div class="col-md-10 col-xs-12">
				<ul>
					<li class="text-default">
						{{$jobDetail->job_desc}}
					</li>
				</ul>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<h5>Educational Qualification</h5>
			</div>
			<div class="col-md-10 col-xs-12">
				<ul>
					<li class="text-default">
						{{$jobDetail->qualification}}
					</li>
				</ul>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<h5>Other Skills</h5>
			</div>
			<div class="col-md-10 col-xs-12">
			<ul>
			<li>{{$jobDetail->otherskill}}</li>
			</ul>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<h5>Department</h5>
			</div>
			<div class="col-md-10 col-xs-12">
				<ul>
					<li class="text-default">
						<label class="control-label">
							[{{app('App\Http\Controllers\AvailJobController')->getDept($jobDetail->spec_id)}}]
						</label>
					</li>
				</ul>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<h5>Job Level</h5>
			</div>
			<div class="col-md-10 col-xs-12">
				<ul>
					<li class="text-default">
						<label class="control-label">
						    @if($jobDetail->type_id==0)
							[No Level Found]
							@else
								[{{strtoupper(app('App\Http\Controllers\AvailJobController')->getJobLevel($jobDetail->level_id)['level'])}}]
							@endif
						</label>
					</li>
				</ul>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<h5>Location</h5>
			</div>
			<div class="col-md-10 col-xs-12">
				<ul>
					<li class="text-default">
						<label class="control-label">
						[{{strtoupper(app('App\Http\Controllers\AvailJobController')->getLocation($jobDetail->location_id)['state'])}} STATE]
						</label>
					</li>
				</ul>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<h5>Minimum Years of Experience</h5>
			</div>
			<div class="col-md-10 col-xs-12">
				<ul>
					<li class="text-default">
						<label class="control-label">[{{$jobDetail->min_exp}} - {{$jobDetail->max_exp}} YEARS]</label>
					</li>
				</ul>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<h5>Work Type</h5>
			</div>
			<div class="col-md-10 col-xs-12">
				<ul>
					<li class="text-default">
						<label class="control-label">
					    @if($jobDetail->type_id==0)
							[No Work Type Found]
							@else
							[{{strtoupper(app('App\Http\Controllers\AvailJobController')->getJobType($jobDetail->type_id)['work_type'])}}]
						@endif
						</label>
					</li>
				</ul>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<h5>Duration</h5>
			</div>
			<div class="col-md-10 col-xs-12">
				<ul>
					<li class="text-default">
						<label class="control-label">
							[{{strtoupper(niceDate($jobDetail->created_at))}}]
						</label> <b>-</b> 
						<label class="control-label">
							[{{strtoupper(niceDate($jobDetail->date_expire))}}]
						</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<span class="pull-right">
					<a class="text-danger" href="#">Read The Application Guide</a> <b>|</b> <a class="text-danger" href="#">Visit our FAQ's Page</a>&nbsp;&nbsp;
					<button type="button" class="btn btn-icon btn-raised btn-success" data-toggle="modal" data-target="#exampleNifty3dRotateBottom">
						<i class="icon wb-dropright"></i> Apply Here
					</button>
				</span>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade modal-rotate-from-bottom" id="exampleNifty3dRotateBottom" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">Privacy Policy</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<p>
							The personal data you provide as part of the recruitment process and/or otherwise for potential employment, will be held and processed for the purpose of your registration, application and the selection process of F.M.N. Plc and in connection with any subsequent employment or placement, unless otherwise indicated. After completion of the application process your data may be held and processed for purposes in connection with future vacancies (where permitted by local legislation) such as but not limited to identifying you as a potential candidate for future suitable vacancies and/or to inform you of future suitable vacancies, unless otherwise indicated.
						</p> 

						<p>
							The personal data will be controlled by Flour Mills Nigeria Plc. In order to process the personal data provided and otherwise for the purposes indicated your personal data may be disclosed to other Flour Mills company and to third party organisations providing administration or other services to the relevant Flour Mills Partners. 
						</p>

						By submitting your personal data and application form you: 
						<ol>
							<li>
								Declare that you have read, understood and accepted the statements set out in this data protection form; and
							</li>
							<li>
								Declare that the information given in this form is complete and true; and
							</li>
							<li>
								Are giving your consent to the processing of the information contained in this application, which may in some countries include ethical, racial and health data, or subsequent applications, and any other personal data you may provide separately in the manner and to the extent described in this form; and
							</li>
							<li>
								Are authorizing the relevant F.M.N. Company to verify or have verified on its behalf all statements contained in this application form and to make any necessary reference checks. For the avoidance of doubt, please note that reference checks will only be carried out with your prior consent; and
							</li>
							<li>
								Consent to the transfer of your data between F.M.N. and/or third parties processing your data on behalf of these F.M.N. Plc in the manner and to the extent described in this form, irrespective of their location.
							</li>
						</ol>

						<p>
							Thank you for your interest in applying for Flour Mills Plc. Coporations. At F.M.N. we have a diverse mix of men and women of over 100 different nationalities and ethnic groups, orientations, backgrounds and cultures. We value this diversity and continuously encourage the very best candidates world-wide to apply to F.M.N. F.M.N. is an Equal Opportunity Employer.
						</p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">
				<i class="icon wb-close"></i> No! Thanks.
				</button>
				@if(Auth::check())
				<button type="button" class="btn btn-success" onclick="url('{{url('job')}}/default?job_id={{$jobid}}')">
				<i class="icon wb-check"></i> I Agree.
				</button>
				@else
				<?php session(['preview_job'=>$jobid]); ?>
				<button type="button" class="btn btn-success" onclick="url('{{url('job')}}/default?job_id={{$jobid}}')">
				<i class="icon wb-check"></i> I Agree.
				</button>
				@endif
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->
@endsection