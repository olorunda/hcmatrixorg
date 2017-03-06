<?php $__env->startSection('content'); ?>
<style type="text/css">
	.hide {
		display: none;
	}
</style>
<script>
	function starttimeer(){
		
 $.get('<?php echo e(url('timer')); ?>',function(data,status,xhr){
			
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
<script type="text/javascript" src="<?php echo e(asset('assets/js/erec/accountvalidation.js')); ?>"></script>
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
	<input type="hidden" name="_gen_token" id="_gen_token" value="<?php echo e(csrf_token()); ?>">
	<input type="hidden" name="jobid" id="jobid" value="<?php if($jobid != null): ?><?php echo e($jobid); ?><?php else: ?>{0}<?php endif; ?>">
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
						<?php if(Auth::user()->job_reg_status == 0): ?>
						<li class="list-group-item bg-blue-grey-100" id="biotab">
							<?php if(count($bios) > 0): ?>
							<a class="text-primary" id="biolink" href="javascript:void(0)" onclick="jobStage(2)">
							<?php else: ?>
							<a class="text-danger" id="biolink" href="javascript:void(0)" onclick="jobStage(2)">
							<?php endif; ?>
								<i class="icon wb-user" aria-hidden="true"></i>Bio Data
							</a>
						</li>
						<li class="list-group-item bg-blue-grey-100" id="corrtab">
							<?php if(count($corrs) > 0): ?>
							<a class="text-primary" id="corrlink" href="javascript:void(0)" onclick="jobStage(3)">
							<?php else: ?>
							<a class="text-danger" id="corrlink" href="javascript:void(0)" onclick="jobStage(3)">
							<?php endif; ?>
								<i class="icon wb-map" aria-hidden="true"></i>Correspondence
							</a>
						</li>
						<li class="list-group-item bg-blue-grey-100" id="edtab">
							<?php if(count($eds) > 0 || count($edIs) > 0): ?>
							<a class="text-primary" id="edlink" href="javascript:void(0)" onclick="jobStage(4)">
							<?php else: ?>
							<a class="text-danger" id="edlink" href="javascript:void(0)" onclick="jobStage(4)">
							<?php endif; ?>
								<i class="icon wb-book" aria-hidden="true"></i>Education
							</a>
						</li>

						<li class="list-group-item bg-blue-grey-100" id="restab">
							<?php if(count($olevel) > 0): ?>
							<a class="text-primary" id="reslink" href="javascript:void(0)" onclick="jobStage(11)">
							<?php else: ?>
							<a class="text-danger" id="reslink" href="javascript:void(0)" onclick="jobStage(11)">
							<?php endif; ?>
								<i class="icon wb-library" aria-hidden="true"></i>O'Level
							</a>
						</li>

						<li class="list-group-item bg-blue-grey-100" id="emptab">
							<?php if(count($emps) > 0): ?>
							<a class="text-primary" id="emplink" href="javascript:void(0)"  onclick="jobStage(5)">
							<?php else: ?>
							<a class="text-danger" id="emplink" href="javascript:void(0)"  onclick="jobStage(5)">
							<?php endif; ?>
								<i class="icon wb-briefcase" aria-hidden="true"></i>Employment History
							</a>
						</li>

						<li class="list-group-item bg-blue-grey-100" id="proftab">
							<?php if(count($profs) > 0): ?>
							<a class="text-primary" id="proflink" href="javascript:void(0)" onclick="jobStage(6)">
							<?php else: ?>
							<a class="text-danger" id="proflink" href="javascript:void(0)" onclick="jobStage(6)">
							<?php endif; ?>
								<i class="icon wb-graph-up" aria-hidden="true"></i>Professional History
							</a>
						</li>

						<li class="list-group-item bg-blue-grey-100" id="skilltab">
							<?php if(count($skills) > 0 || count($trainings) > 0): ?>
							<a class="text-primary" id="skilllink" href="javascript:void(0)" onclick="jobStage(7)">
							<?php else: ?>
							<a class="text-danger" id="skilllink" href="javascript:void(0)" onclick="jobStage(7)">
							<?php endif; ?>
								<i class="icon wb-hammer" aria-hidden="true"></i>Skills and Training
							</a>
						</li>

						<li class="list-group-item bg-blue-grey-100" id="reftab">
							<?php if(count($refs) > 0): ?>
							<a class="text-primary" id="reflink" href="javascript:void(0)" onclick="jobStage(8)">
							<?php else: ?>
							<a class="text-danger" id="reflink" href="javascript:void(0)" onclick="jobStage(8)">
							<?php endif; ?>
								<i class="icon wb-users" aria-hidden="true"></i>References
							</a>
						</li>

						<li class="list-group-item bg-blue-grey-100" id="addtab">
							<?php if(count($adds) > 0): ?>
							<a class="text-primary" id="addlink" href="javascript:void(0)" onclick="jobStage(9)">
							<?php else: ?>
							<a class="text-danger" id="addlink" href="javascript:void(0)" onclick="jobStage(9)">
							<?php endif; ?>
								<i class="icon wb-plus" aria-hidden="true"></i>Additional Information
							</a>
						</li>
						<?php else: ?>
						<?php endif; ?>
						<li class="list-group-item bg-blue-grey-100" id="prevtab">
							<a class="text-primary active" href="javascript:void(0)" onclick="jobStage(10)">
								<i class="icon wb-eye" aria-hidden="true"></i>Preview
							</a>
						</li>
						<?php $jobData = app('App\Http\Controllers\AvailJobController')->getJob($app_job); ?>
						<?php if($jobData['taketest'] == 1): ?>
						<?php if(Auth::user()->job_reg_status == 1): ?>
						<li class="list-group-item bg-blue-grey-100" id="prevtab">
							<a class="text-primary active"  onclick="starttimeer()" href="javascript:void(0)" data-toggle="modal" data-target="#testmodal" data-backdrop="static" 
   data-keyboard="false">
								<i class="icon wb-eye" aria-hidden="true"></i>Take Test
							</a>
						</li>
						<?php endif; ?>
						<?php endif; ?>
					</ul>
				</div>
				<div class="col-md-8 col-xs-12" id="canvas">
					<!--<div class="loader vertical-align-middle loader-tadpole" id="ajaxload" style="display: none;"></div>-->
					<?php echo $__env->make('jobs.stages.biodata', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->make('jobs.stages.correspondence', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->make('jobs.stages.education', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->make('jobs.stages.results', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->make('jobs.stages.employment', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->make('jobs.stages.professionalhistory', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->make('jobs.stages.skills', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->make('jobs.stages.references', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->make('jobs.stages.additional', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->make('jobs.stages.preview', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->make('jobs.taketest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>