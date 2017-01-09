@extends('layouts.app')

@section('content')
<style type="text/css">
	.hide {
		display: none;
	}
</style>
<script>
	function starttimeer(){
		
 $.get('{{url('timer')}}',function(data,status,xhr){
			
	   $( "#refreshclock" ).html(data);			
			$("#timer").TimeCircles({count_past_zero: false, time: { 
	 Days: { show: false }, 
	 Hours: { show: false }

	 }

	 }).addListener(countdownComplete); 
			 
		 });
		 
		
	}
	
	function url(url)
	{	
		window.location=url;
	}
	$(function(){
		
		jobStage(parseInt(localStorage.getItem("currentStage")));
	});
	/*function jobStage(stage)
	{
		$("#ajaxload").css("display", "block");
		var token = $("#_gen_token").val();
		var formData = {'_token':token}
		$.get('stages?stage='+stage, formData, function(data,xhr,status)
		{
			//$("#canvas").html(data);
			console.log(data);
			$("#canvas").hide().fadeIn('fast');
			//location.reload();
		});
		$("#ajaxload").css("display", "none");
	}*/
	function jobStage(stage)
	{
		$("#ajaxload").css('display', 'block');
		switch(stage)
		{
			case 1:
				$("#accountContainer").fadeIn("slow");
				$("#biodataContainer").hide();
				$("#correspondenceContainer").hide();
				$("#educationContainer").hide();
				$("#resultsContainer").hide();
				$("#employmentContainer").hide();
				$("#professionalContainer").hide();
				$("#skillsContainer").hide();
				$("#referencesContainer").hide();
				$("#additionalContainer").hide();
				$("#previewContainer").hide();
				if(typeof(Storage) != "undefined")
				{
					localStorage.setItem("currentStage", 1);
				}
				else
				{
					alert("Your browser does not support local storage. This page might not function properly.");
				}
				break;
			case 2:
				$("#accountContainer").hide();
				$("#biodataContainer").fadeIn("slow");
				$("#correspondenceContainer").hide();
				$("#educationContainer").hide();
				$("#resultsContainer").hide();
				$("#employmentContainer").hide();
				$("#professionalContainer").hide();
				$("#skillsContainer").hide();
				$("#referencesContainer").hide();
				$("#additionalContainer").hide();
				$("#previewContainer").hide();
				if(typeof(Storage) != "undefined")
				{
					localStorage.setItem("currentStage", 2);
				}
				else
				{
					alert("Your browser does not support local storage. This page might not function properly.");
				}
				break;
			case 3:
				$("#accountContainer").hide();
				$("#biodataContainer").hide();
				$("#correspondenceContainer").fadeIn("slow");
				$("#educationContainer").hide();
				$("#resultsContainer").hide();
				$("#employmentContainer").hide();
				$("#professionalContainer").hide();
				$("#skillsContainer").hide();
				$("#referencesContainer").hide();
				$("#additionalContainer").hide();
				$("#previewContainer").hide();
				if(typeof(Storage) != "undefined")
				{
					localStorage.setItem("currentStage", 3);
				}
				else
				{
					alert("Your browser does not support local storage. This page might not function properly.");
				}
				break;
			case 4:
				$("#accountContainer").hide();
				$("#biodataContainer").hide();
				$("#correspondenceContainer").hide();
				$("#educationContainer").fadeIn("slow");
				$("#resultsContainer").hide();
				$("#employmentContainer").hide();
				$("#professionalContainer").hide();
				$("#skillsContainer").hide();
				$("#referencesContainer").hide();
				$("#additionalContainer").hide();
				$("#previewContainer").hide();
				if(typeof(Storage) != "undefined")
				{
					localStorage.setItem("currentStage", 4);
				}
				else
				{
					alert("Your browser does not support local storage. This page might not function properly.");
				}
				break;
			case 5:
				$("#accountContainer").hide();
				$("#biodataContainer").hide();
				$("#correspondenceContainer").hide();
				$("#educationContainer").hide();
				$("#resultsContainer").hide();
				$("#employmentContainer").fadeIn("slow");
				$("#professionalContainer").hide();
				$("#skillsContainer").hide();
				$("#referencesContainer").hide();
				$("#additionalContainer").hide();
				$("#previewContainer").hide();
				if(typeof(Storage) != "undefined")
				{
					localStorage.setItem("currentStage", 5);
				}
				else
				{
					alert("Your browser does not support local storage. This page might not function properly.");
				}
				break;
			case 6:
				$("#accountContainer").hide();
				$("#biodataContainer").hide();
				$("#correspondenceContainer").hide();
				$("#educationContainer").hide();
				$("#resultsContainer").hide();
				$("#employmentContainer").hide();
				$("#professionalContainer").fadeIn("slow");
				$("#skillsContainer").hide();
				$("#referencesContainer").hide();
				$("#additionalContainer").hide();
				$("#previewContainer").hide();
				if(typeof(Storage) != "undefined")
				{
					localStorage.setItem("currentStage", 6);
				}
				else
				{
					alert("Your browser does not support local storage. This page might not function properly.");
				}
				break;
			case 7:
				$("#accountContainer").hide();
				$("#biodataContainer").hide();
				$("#correspondenceContainer").hide();
				$("#educationContainer").hide();
				$("#resultsContainer").hide();
				$("#employmentContainer").hide();
				$("#professionalContainer").hide();
				$("#skillsContainer").fadeIn("slow");
				$("#referencesContainer").hide();
				$("#additionalContainer").hide();
				$("#previewContainer").hide();
				if(typeof(Storage) != "undefined")
				{
					localStorage.setItem("currentStage", 7);
				}
				else
				{
					alert("Your browser does not support local storage. This page might not function properly.");
				}
				break;
			case 8:
				$("#accountContainer").hide();
				$("#biodataContainer").hide();
				$("#correspondenceContainer").hide();
				$("#educationContainer").hide();
				$("#resultsContainer").hide();
				$("#employmentContainer").hide();
				$("#professionalContainer").hide();
				$("#skillsContainer").hide();
				$("#referencesContainer").fadeIn("slow");
				$("#additionalContainer").hide();
				$("#previewContainer").hide();
				if(typeof(Storage) != "undefined")
				{
					localStorage.setItem("currentStage", 8);
				}
				else
				{
					alert("Your browser does not support local storage. This page might not function properly.");
				}
				break;
			case 9:
				$("#accountContainer").hide();
				$("#biodataContainer").hide();
				$("#correspondenceContainer").hide();
				$("#educationContainer").hide();
				$("#resultsContainer").hide();
				$("#employmentContainer").hide();
				$("#professionalContainer").hide();
				$("#skillsContainer").hide();
				$("#referencesContainer").hide();
				$("#additionalContainer").fadeIn("slow");
				$("#previewContainer").hide();
				if(typeof(Storage) != "undefined")
				{
					localStorage.setItem("currentStage", 9);
				}
				else
				{
					alert("Your browser does not support local storage. This page might not function properly.");
				}
				break;
			case 10:
				$("#accountContainer").hide();
				$("#biodataContainer").hide();
				$("#correspondenceContainer").hide();
				$("#educationContainer").hide();
				$("#resultsContainer").hide();
				$("#employmentContainer").hide();
				$("#professionalContainer").hide();
				$("#skillsContainer").hide();
				$("#referencesContainer").hide();
				$("#additionalContainer").hide();
				$("#previewContainer").fadeIn("slow");
				if(typeof(Storage) != "undefined")
				{
					localStorage.setItem("currentStage", 10);
				}
				else
				{
					alert("Your browser does not support local storage. This page might not function properly.");
				}
				break;
			case 11:
				$("#accountContainer").hide();
				$("#biodataContainer").hide();
				$("#correspondenceContainer").hide();
				$("#educationContainer").hide();
				$("#resultsContainer").fadeIn("slow");
				$("#employmentContainer").hide();
				$("#professionalContainer").hide();
				$("#skillsContainer").hide();
				$("#referencesContainer").hide();
				$("#additionalContainer").hide();
				$("#previewContainer").hide();
				if(typeof(Storage) != "undefined")
				{
					localStorage.setItem("currentStage", 11);
				}
				else
				{
					alert("Your browser does not support local storage. This page might not function properly.");
				}
				break;

		}
	}
</script>
<?php
function loadPreview($sessionvar)
{
	$retVal;
	switch($sessionvar)
	{
		case 1:
		$retVal = 'jobs.stages.account';
		break;
		case 2:
		$retVal = 'jobs.stages.biodata';
		break;
	}
	return $retVal;
}
?>
<script type="text/javascript" src="{{asset('assets/js/erec/accountvalidation.js')}}"></script>
<div class="page-header" style="margin-top: -40px;">
	<!--<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="../index.html">Home</a></li>
		<li class="breadcrumb-item active">Basic UI</li>
	</ol>-->
	<h1 class="page-title">Job Recruitment</h1>
	<!--<div class="page-header-actions">
		<button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-toggle="tooltip" data-placement="left" data-original-title="Save your session and sign out">
			<i class="icon wb-cloud" aria-hidden="true"></i>
		</button>
		<button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Refresh" onclick="location.reload();">
			<i class="icon wb-refresh" aria-hidden="true"></i>
		</button>
	</div>-->
</div>
<div class="page-content">
	<input type="hidden" name="_gen_token" id="_gen_token" value="{{csrf_token()}}">
	<input type="hidden" name="jobid" id="jobid" value="@if($jobid != null){{{$jobid}}}@else{0}@endif">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title">Application Stages</h3>
		</div>
		<div class="panel-body container-fluid">
			<div class="row row-lg">
				<div class="col-md-4 col-xs-12">
					<ul class="list-group list-group-gap">
						<!--<li class="list-group-item bg-blue-grey-100" id="accttab">
							<a class="text-primary" href="javascript:void(0)" onclick="jobStage(1)">
								<i class="icon wb-settings" aria-hidden="true"></i>Account Setup
							</a>
						</li>-->
						@if(Auth::user()->job_reg_status == 0)
						<li class="list-group-item bg-blue-grey-100" id="biotab">
							@if(count($bios) > 0)
							<a class="text-primary" id="biolink" href="javascript:void(0)" onclick="jobStage(2)">
							@else
							<a class="text-danger" id="biolink" href="javascript:void(0)" onclick="jobStage(2)">
							@endif
								<i class="icon wb-user" aria-hidden="true"></i>Bio Data
							</a>
						</li>
						<li class="list-group-item bg-blue-grey-100" id="corrtab">
							@if(count($corrs) > 0)
							<a class="text-primary" id="corrlink" href="javascript:void(0)" onclick="jobStage(3)">
							@else
							<a class="text-danger" id="corrlink" href="javascript:void(0)" onclick="jobStage(3)">
							@endif
								<i class="icon wb-map" aria-hidden="true"></i>Correspondence
							</a>
						</li>
						<li class="list-group-item bg-blue-grey-100" id="edtab">
							@if(count($eds) > 0 || count($edIs) > 0)
							<a class="text-primary" id="edlink" href="javascript:void(0)" onclick="jobStage(4)">
							@else
							<a class="text-danger" id="edlink" href="javascript:void(0)" onclick="jobStage(4)">
							@endif
								<i class="icon wb-book" aria-hidden="true"></i>Education
							</a>
						</li>

						<li class="list-group-item bg-blue-grey-100" id="restab">
							@if(count($olevel) > 0)
							<a class="text-primary" id="reslink" href="javascript:void(0)" onclick="jobStage(11)">
							@else
							<a class="text-danger" id="reslink" href="javascript:void(0)" onclick="jobStage(11)">
							@endif
								<i class="icon wb-library" aria-hidden="true"></i>O'Level
							</a>
						</li>

						<li class="list-group-item bg-blue-grey-100" id="emptab">
							@if(count($emps) > 0)
							<a class="text-primary" id="emplink" href="javascript:void(0)"  onclick="jobStage(5)">
							@else
							<a class="text-danger" id="emplink" href="javascript:void(0)"  onclick="jobStage(5)">
							@endif
								<i class="icon wb-briefcase" aria-hidden="true"></i>Employment History
							</a>
						</li>

						<li class="list-group-item bg-blue-grey-100" id="proftab">
							@if(count($profs) > 0)
							<a class="text-primary" id="proflink" href="javascript:void(0)" onclick="jobStage(6)">
							@else
							<a class="text-danger" id="proflink" href="javascript:void(0)" onclick="jobStage(6)">
							@endif
								<i class="icon wb-graph-up" aria-hidden="true"></i>Professional History
							</a>
						</li>

						<li class="list-group-item bg-blue-grey-100" id="skilltab">
							@if(count($skills) > 0 || count($trainings) > 0)
							<a class="text-primary" id="skilllink" href="javascript:void(0)" onclick="jobStage(7)">
							@else
							<a class="text-danger" id="skilllink" href="javascript:void(0)" onclick="jobStage(7)">
							@endif
								<i class="icon wb-hammer" aria-hidden="true"></i>Skills and Training
							</a>
						</li>

						<li class="list-group-item bg-blue-grey-100" id="reftab">
							@if(count($refs) > 0)
							<a class="text-primary" id="reflink" href="javascript:void(0)" onclick="jobStage(8)">
							@else
							<a class="text-danger" id="reflink" href="javascript:void(0)" onclick="jobStage(8)">
							@endif
								<i class="icon wb-users" aria-hidden="true"></i>References
							</a>
						</li>

						<li class="list-group-item bg-blue-grey-100" id="addtab">
							@if(count($adds) > 0)
							<a class="text-primary" id="addlink" href="javascript:void(0)" onclick="jobStage(9)">
							@else
							<a class="text-danger" id="addlink" href="javascript:void(0)" onclick="jobStage(9)">
							@endif
								<i class="icon wb-plus" aria-hidden="true"></i>Additional Information
							</a>
						</li>
						@else
						@endif
						<li class="list-group-item bg-blue-grey-100" id="prevtab">
							<a class="text-primary active" href="javascript:void(0)" onclick="jobStage(10)">
								<i class="icon wb-eye" aria-hidden="true"></i>Preview
							</a>
						</li>
						<?php $jobData = app('App\Http\Controllers\AvailJobController')->getJob($app_job); ?>
						@if($jobData['taketest'] == 1)
						@if(Auth::user()->job_reg_status == 1)
						<li class="list-group-item bg-blue-grey-100" id="prevtab">
							<a class="text-primary active"  onclick="starttimeer()" href="javascript:void(0)" data-toggle="modal" data-target="#testmodal" data-backdrop="static" 
   data-keyboard="false">
								<i class="icon wb-eye" aria-hidden="true"></i>Take Test
							</a>
						</li>
						@endif
						@endif
					</ul>
				</div>
				<div class="col-md-8 col-xs-12" id="canvas">
					<!--<div class="loader vertical-align-middle loader-tadpole" id="ajaxload" style="display: none;"></div>-->
					@include('jobs.stages.biodata')
					@include('jobs.stages.correspondence')
					@include('jobs.stages.education')
					@include('jobs.stages.results')
					@include('jobs.stages.employment')
					@include('jobs.stages.professionalhistory')
					@include('jobs.stages.skills')
					@include('jobs.stages.references')
					@include('jobs.stages.additional')
					@include('jobs.stages.preview')
					@include('jobs.taketest')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection