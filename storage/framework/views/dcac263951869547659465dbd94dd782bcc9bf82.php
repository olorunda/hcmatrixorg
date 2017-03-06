<div style="display: none;" id="skillsContainer">
	<?php if(count($skills) > 0): ?>
	<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="skillribbon">
		<?php else: ?>
		<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="skillribbon" style="display: none;">
			<?php endif; ?>
			<span class="ribbon-inner" data-toggle="modal" data-target="#viewskillsrecords" title="View">
				View Records
			</span>
		</div>
		<br>
		<div id="skills">
			<h4>Skills</h4>
			<span class="text-danger" style="visibility: hidden">Fields marked * are compulsory</span>
			<!--<button type="button" class="btn btn-floating btn-sm btn-success pull-right" id="addskillmore" data-toggle="tooltip" data-placement="top" title="Add More.">-
				<i class="icon wb-loop"></i>
			</button>-->
			<br><br>
			<form autocomplete="off">
				<input type="hidden" name="_skill_csrf" id="_skill_csrf" value="<?php echo e(csrf_token()); ?>">
				<div class="form-group">
					<label class="control-label">Skill</label>
					<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="skillset">
						<?php if(count($jobskills) > 0): ?>
						<?php $__currentLoopData = $jobskills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobskill): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<option value="<?php echo e($jobskill->id); ?>"><?php echo e($jobskill->skill); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						<?php else: ?>
						<option value="0">No Job Skill Required</option>
						<?php endif; ?>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Competence Level</label>
					<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="compset">
						<?php if(count($competencies) > 0): ?>
						<?php $__currentLoopData = $competencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competence): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<option value="<?php echo e($competence->id); ?>"><?php echo e($competence->proficiency); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						<?php else: ?>
						<option value="0">No Competence Level Required</option>
						<?php endif; ?>
					</select>
				</div>
				<button type="submit" class="btn btn-icon btn-raised btn-success" id="submitskill"><i class="icon wb-plus"></i> Save</button>
			</form>

			<br><br>
			<h4>Training</h4>
			<span class="text-danger" style="visibility: hidden">Fields marked * are compulsory</span>
			<button type="button" class="btn btn-floating btn-sm btn-warning pull-right" data-toggle="tooltip" data-placement="top" title="Add More." id="addmoretrain">
				<i class="icon wb-loop"></i>
			</button>
			<br><br>
			<form autocomplete="off">
				<input type="hidden" name="_csrf_train_token" id="_csrf_train_token" value="<?php echo e(csrf_token()); ?>">
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<input type="text" class="form-control" name="train_name" id="train_name" autofocus="autofocus">
					<label class="floating-label">Name of Training</label>
					<label class="text-danger" id="train_name_err"></label>
				</div>
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<input type="text" class="form-control" name="train_start" id="train_start" data-plugin="datepicker" data-date-format="yyyy-mm-dd">
					<label class="floating-label">Start Date</label>
					<label class="text-danger" id="train_start_err"></label>
				</div>
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<input type="text" class="form-control" name="train_end" id="train_end" data-plugin="datepicker" data-date-format="yyyy-mm-dd">
					<label class="floating-label">End Date</label>
					<label class="text-danger" id="train_end_err"></label>
				</div>
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<input type="text" class="form-control" name="train_inst" id="train_inst" autofocus="autofocus">
					<label class="floating-label">Institution</label>
					<label class="text-danger" id="train_inst_err"></label>
				</div>
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<input type="text" class="form-control" name="train_loc" id="train_loc" autofocus="autofocus">
					<label class="floating-label">Location</label>
					<label class="text-danger" id="train_loc_err"></label>
				</div>
				<button type="submit" class="btn btn-icon btn-raised btn-success" id="submittraining" disabled="disabled"><i class="icon wb-plus"></i> Continue</button>
			</form>
		</div>

		<!-- Modal -->
		<div class="modal fade modal-rotate-from-left modal-warning" id="viewskillsrecords" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title">Skills and Training - Records</h4>
					</div>
					<div class="modal-body">
						<?php if(count($skills) > 0): ?>
						<?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<div class="row row-lg">
							<div class="col-md-12" style="display: none;" id="skilledited<?php echo e($skill->id); ?>">
								<div class="col-md-12">
									<div class="alert alert-success alert-dismissible">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>Success! </strong> Record Updated.
									</div>
								</div>
							</div>
							<div class="col-md-12" style="display: none;" id="skilleditederr<?php echo e($skill->id); ?>">
								<div class="col-md-12">
									<div class="alert alert-danger alert-dismissible">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>Failed! </strong> Record was not updated. Please try again.
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Skill</label>
										<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="edit_skillset<?php echo e($skill->id); ?>">
											<?php $__currentLoopData = $jobskills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobskill): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<?php if($skill->skill_id == $jobskill->id): ?>
											<option selected="selected" value="<?php echo e($jobskill->id); ?>"><?php echo e($jobskill->skill); ?></option>
											<?php else: ?>
											<option value="<?php echo e($jobskill->id); ?>"><?php echo e($jobskill->skill); ?></option>
											<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Competence Level</label>
										<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="edit_compset<?php echo e($skill->id); ?>">
											<?php $__currentLoopData = $competencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competence): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<?php if($skill->proficiency_id == $competence->id): ?>
											<option selected="selected" value="<?php echo e($competence->id); ?>"><?php echo e($competence->proficiency); ?></option>
											<?php else: ?>
											<option value="<?php echo e($competence->id); ?>"><?php echo e($competence->proficiency); ?></option>
											<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<button type="button" class="btn btn-success m-b-5" onclick="updateSkill(<?php echo e($skill->id); ?>)"><i class="icon wb-check-circle"></i> </button>
									<button type="button" class="btn btn-danger" onclick="deleteSkill(<?php echo e($skill->id); ?>)"><i class="icon ion-ios-trash"></i></button>
								</div>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						<?php endif; ?>
						<div class="row row-lg">
							<div class="col-md-12">
								<div class="col-md-12">
									<h4>Training</h4>
									<hr>
								</div>
							</div>
						</div>
						<!-- training -->
						<?php if(count($trainings) > 0): ?>
						<div class="panel-group" id="trainingaccordion" aria-multiselectable="true" role="tablist">
							<?php $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<div class="panel">
								<div class="panel-heading" id="$trainEd<?php echo e($training->id); ?>" role="tab">
									<a class="panel-title" data-toggle="collapse" href="#trainingEdData<?php echo e($training->id); ?>" data-parent="#trainingaccordion" aria-expanded="false" aria-controls="trainingEdData{$ed->id}}">
										<?php echo e($training->training_name); ?>

									</a>
								</div>
							</div>
							<div class="panel-collapse collapse" id="trainingEdData<?php echo e($training->id); ?>" aria-labelledby="trainEd<?php echo e($training->id); ?>" role="tabpanel">
								<div class="panel-body">
									<div class="row row-lg">
										<div class="col-md-12" style="display: none;" id="trainedited<?php echo e($training->id); ?>">
											<div class="col-md-12">
												<div class="alert alert-success alert-dismissible">
													<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													<strong>Success! </strong> Record Updated.
												</div>
											</div>
										</div>
										<div class="col-md-12" style="display: none;" id="traineditederr<?php echo e($training->id); ?>">
											<div class="col-md-12">
												<div class="alert alert-danger alert-dismissible">
													<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													<strong>Failed! </strong> Record was not updated. Please try again.
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="col-md-12">
												<div class="form-group form-material floating" data-plugin="formMaterial">
													<input type="text" class="form-control" name="train_name" id="edit_train_name<?php echo e($training->id); ?>" value="<?php echo e($training->training_name); ?>">
													<label class="floating-label">Name of Training</label>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="col-md-6">
												<div class="form-group form-material floating" data-plugin="formMaterial">
													<input type="text" class="form-control" name="train_start" id="edit_train_start<?php echo e($training->id); ?>" data-plugin="datepicker" data-date-format="yyyy-mm-dd" value="<?php echo e($training->start_date); ?>">
													<label class="floating-label">Start Date</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-material floating" data-plugin="formMaterial">
													<input type="text" class="form-control" name="edit_train_end" id="edit_train_end<?php echo e($training->id); ?>" data-plugin="datepicker" data-date-format="yyyy-mm-dd" value="<?php echo e($training->end_date); ?>">
													<label class="floating-label">End Date</label>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="col-md-6">
												<div class="form-group form-material floating" data-plugin="formMaterial">
													<input type="text" class="form-control" name="edit_train_inst" id="edit_train_inst<?php echo e($training->id); ?>" value="<?php echo e($training->institution); ?>">
													<label class="floating-label">Institution</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-material floating" data-plugin="formMaterial">
													<input type="text" class="form-control" name="edit_train_loc" id="edit_train_loc<?php echo e($training->id); ?>" value="<?php echo e($training->location); ?>">
													<label class="floating-label">Location</label>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<button type="button" class="btn btn-success m-b-5" onclick="updateTrain(<?php echo e($training->id); ?>)"><i class="icon wb-check-circle"></i> Save changes</button>
											<button type="button" class="btn btn-danger" onclick="deleteTrain(<?php echo e($training->id); ?>)"><i class="icon ion-ios-trash"></i> Delete</button>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</div>
						<?php else: ?>
						<h4 class="text-center">No Training Found</h4>
						<?php endif; ?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="icon wb-close"></i> Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal -->
	</div>

	<script type="text/javascript">
		$("#submitskill").click(function(e){
			e.preventDefault();
			var _csrf = $("#_skill_csrf").val();
			var skill = $("#skillset").val();
			var comp  = $("#compset").val();

			var formData = {'skill':skill, 'comp':comp, '_token':_csrf, 'type':8, 'opcode':1};
			$.post('/job', formData, function(data,xhr,status){
				if(data.id)
				{
					toastr.options = {
						"closeButton":true,
						"debug":false,
						"newestOnTop":true,
						"progressBar":true,
						"positionClass":"toast-bottom-full-width",
						"preventDuplicates":false,
						"onclick":null,
						"showDuration":"300",
						"hideDuration":"1000",
						"timeOut":"5000",
						"extendedTimeOut":"1000",
						"showEasing":"swing", 
						"hideEasing":"linear",
						"showMethod":"fadeIn",
						"hideMethod":"fadeOut"
					};
					toastr["success"]("New Skill Addedd succsesfully.<p>You can view records by clicking view records button.</p><p>To add more records. Please click on the add more button.</p>", "Success", toastr.options);
					$("#skilllink").removeClass("text-danger").addClass("text-primary");
					$("#reflink").removeClass("text-danger").addClass("text-primary");
					location.reload();
					//$("#skillribbon").fadeIn("slow");
				}
				else
				{
					var response = "<p>Unfortunately! Your record could not be saved due to an unknown error. Please refresh your browser and try again.</p>";
					swal({
						title: "Warning!",
						text: "" + response,
						html: true
					});
				}
			});
		});
	</script>

	<script type="text/javascript">
		$("#train_name").on("keyup", function(){
			var name = $(this).val();
			if(!name || name.length < 3 || name == '')
			{	
				$("#train_name_err").html("Please enter a valid training name").fadeIn("slow");
				$("#submittraining").attr('disabled', 'disabled');
				return false;
			}
			else
			{
				$("#train_name_err").html("").fadeOut("fast");
				$("#submittraining").removeAttr("disabled");
				return true;
			}
		});

		$("#train_start").on("keyup", function(){
			var date = $(this).val();
			if(!date || date == '' || containsAlpha(date))
			{
				$("#train_start_err").html("Please enter a valid date").fadeIn("slow");
				$("#submittraining").attr("disabled", "disabled");
				console.log("Not a valid date");
				return false;
			}
			else
			{
				$("#train_start_err").html("").fadeOut("fast");
				$("#submittraining").removeAttr("disabled");
				return true;
			}
		});

		$("#train_end").on("keyup", function(){
			var date = $(this).val();
			if(!date || date == '' || containsAlpha(date))
			{
				$("#train_end_err").html("Please enter a valid date").fadeIn("slow");
				$("#submittraining").attr("disabled", "disabled");
				return false;
			}
			else
			{
				$("#train_end_err").html("").fadeOut("fast");
				$("#submittraining").removeAttr("disabled");
				return true;
			}
		})

		$("#train_loc").on("keyup", function(){
			var loc = $(this).val();
			if(!loc || loc.length == 0 || loc == '')
			{
				$("#train_loc_err").html("Please enter valid location").fadeIn("slow");
				$("#submittraining").attr("disabled", "disabled");
				return false;
			}
			else
			{
				$("#train_loc_err").html("").fadeOut("fast");
				$("#submittraining").removeAttr("disabled");
				return true;
			}
		});

		$("#train_inst").on("keyup", function(){
			var inst = $(this).val();
			if(!inst || inst == '')
			{
				$("#train_inst_err").html("Please enter a valid institution name").val();
				$("#submittraining").attr("disabled", "disabled");
				return false;
			}
			else
			{
				$("#train_inst_err").html("").fadeOut("fast");
				$("#submittraining").removeAttr("disabled");
				return true;
			}
		});

		$("#submittraining").click(function(e){
			e.preventDefault();
			var trainname = $("#train_name").val();
			var trainstart = $("#train_start").val();
			var trainend = $("#train_end").val();
			var inst = $("#train_inst").val();
			var location = $("#train_loc").val();
			var _csrf = $("#_csrf_train_token").val();

			var formData = {'name':trainname, 'start':trainstart, 'end':trainend, 'institution':inst, 'location':location, '_token':_csrf, 'type':9, 'opcode':1};
			console.log(formData);
			$.post("/job", formData, function(data,xhr,status){
				if(data.id)
				{
					toastr.options = {
						"closeButton":true,
						"debug":false,
						"newestOnTop":true,
						"progressBar":true,
						"positionClass":"toast-bottom-full-width",
						"preventDuplicates":false,
						"onclick":null,
						"showDuration":"300",
						"hideDuration":"1000",
						"timeOut":"5000",
						"extendedTimeOut":"1000",
						"showEasing":"swing", 
						"hideEasing":"linear",
						"showMethod":"fadeIn",
						"hideMethod":"fadeOut"
					};
					toastr["success"]("New Training Addedd succsesfully.<p>You can view records by clicking view records button.</p><p>To add more records. Please click on the add more button.</p>", "Success", toastr.options);
					$("#skilllink").removeClass("text-danger").addClass("text-primary");
				}
				else
				{
					if(data.training_name)
					{
						var response;
						if(data.train_name.length == 1)
						{
							response = "<p>"+data.train_name+"</p>";
						}
						else
						{
							for(var i = 0; i < data.train_name.length; i++)
							{
								response += "<p>"+data.train_name[i]+"</p>";
							}
						}
						swal({
							title: "Warning!",
							text: "" + response,
							html: true
						});
					}
					if(data.start_date)
					{
						if(data.start_date.length == 1)
						{
							response = "<p>"+data.start_date+"</p>";
						}
						else
						{
							for(var i = 0; i < data.start_date.length; i++)
							{
								response += "<p>"+data.start_date[i]+"</p>";
							}
						}
						swal({
							title: "Warning!",
							text: "" + response,
							html: true
						});
					}
					if(data.end_date)
					{
						if(data.end_date.length == 1)
						{
							response = "<p>"+data.end_date+"</p>";
						}
						else
						{
							for(var i = 0; i < data.end_date.length; i++)
							{
								response += "<p>"+data.end_date[i]+"</p>";
							}
						}
						swal({
							title: "Warning!",
							text: "" + response,
							html: true
						});
					}
					if(data.institution)
					{
						if(data.institution.length == 1)
						{
							response = "<p>"+data.institution+"</p>";
						}
						else
						{
							for(var i = 0; i < data.institution.length; i++)
							{
								response += "<p>"+data.institution[i]+"</p>";
							}
						}
						swal({
							title: "Warning!",
							text: "" + response,
							html: true
						});
					}
					if(data.location)
					{
						if(data.location.length == 1)
						{
							response = "<p>"+data.location+"</p>";
						}
						else
						{
							for(var i = 0; i < data.location.length; i++)
							{
								response += "<p>"+data.location[i]+"</p>";
							}
						}
						swal({
							title: "Warning!",
							text: "" + response,
							html: true
						});
					}
					if(!data.training_name && !data.start_date && !end_date && !institution && !location)
					{
						var response = "<p>Unfortunately! Your record could not be saved due to an unknown error. Please refresh your browser and try again.</p>";
						swal({
							title: "Warning!",
							text: "" + response,
							html: true
						});
					}
				}
			});
		});

		function containsAlpha(sample)
		{
			var alphaUpper = /[A-Z]/;
			var alphaLower = /[a-z]/;

			var retVal = false; 
			if(alphaUpper.test(sample) || alphaLower.test(sample))
			{
				retVal = !retVal;
			}
			return retVal;
		}

		$("#addmoretrain").click(function(){
			$("#train_name").val("");
			$("#train_start").val("");
			$("#train_end").val("");
			$("#train_inst").val("");
			$("#train_loc").val("");
		});	

		function updateSkill(id)
		{
			var _csrf = $("#_skill_csrf").val();
			var skill = $("#edit_skillset"+id).val();
			var comp  = $("#edit_compset"+id).val();

			var formData = {'skill':skill, 'comp':comp, '_token':_csrf, 'type':8, 'opcode':2, 'id':id};
			console.log(formData);
			$.post('/job', formData, function(data,xhr,status){
				console.log(data);
				if(data == 1)
				{
					$("#skilledited"+id).fadeIn("slow");
					$("#skilleditederr"+id).fadeOut("fast");
				}
				else
				{
					$("#skilledited"+id).fadeOut("fast");
					$("#skilleditederr"+id).fadeIn("slow");
				}
				if(status == 500)
				{
					$("#skilledited"+id).fadeOut("fast");
					$("#skilleditederr"+id).fadeIn("slow");
				}
			});
		}

		function updateTrain(id)
		{
			var trainname = $("#edit_train_name"+id).val();
			var trainstart = $("#edit_train_start"+id).val();
			var trainend = $("#edit_train_end"+id).val();
			var inst = $("#edit_train_inst"+id).val();
			var location = $("#edit_train_loc"+id).val();
			var _csrf = $("#_csrf_train_token").val();

			var formData = {'name':trainname, 'start':trainstart, 'end':trainend, 'institution':inst, 'location':location, '_token':_csrf, 'type':9, 'opcode':2, 'id':id};
			console.log(formData);
			$.post('/job', formData, function(data,xhr,status){
				console.log(data);
				if(data == 1)
				{
					$("#trainedited"+id).fadeIn("slow");
					$("#traineditederr"+id).fadeOut("fast");
				}
				else
				{
					$("#trainedited"+id).fadeOut("fast");
					$("#traineditederr"+id).fadeIn("slow");
				}
				if(status == 500)
				{
					$("#trainedited"+id).fadeOut("fast");
					$("#traineditederr"+id).fadeIn("slow");
				}
			});
		}

		function deleteSkill(id)
		{
			var token = $("#_skill_csrf").val();
			swal({
				title: "Warning!",
				text: "This operation cannot be reversed",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#f96868",
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, Go back.",
				closeOnConfirm: false,
				closeOnCancel: false
			}, function(isConfirm){
				if(isConfirm)
				{
					var formData = {'_token':token, '_method': 'DELETE', 'type': 8};
					$.post('/job/'+id, formData, function(data,xhr,status){
						console.log(data);
						if(data == 0)
						{
							swal("Success", "You have successfully removed a record.", "success");
							location.reload();
						}
						else
						{
							swal("Not Completed!", "Your record could not be removed. Please try again.", "error");
						}
						if(status == 500)
						{
							swal("Not Completed!", "Your record could not be removed. Please reload your browser and try again.", "error");
						}
					});
				}
				else
				{
					swal("Cancelled", "Operation Cancelled");
				}
			});
		}

		function deleteTrain(id)
		{
			var token = $("#_csrf_train_token").val();
			swal({
				title: "Warning!",
				text: "This operation cannot be reversed",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#f96868",
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, Go back.",
				closeOnConfirm: false,
				closeOnCancel: false
			}, function(isConfirm){
				if(isConfirm)
				{
					var formData = {'_token':token, '_method': 'DELETE', 'type': 9};
					$.post('/job/'+id, formData, function(data,xhr,status){
						console.log(data);
						if(data == 0)
						{
							swal("Success", "You have successfully removed a record.", "success");
							location.reload();
						}
						else
						{
							swal("Not Completed!", "Your record could not be removed. Please try again.", "error");
						}
						if(status == 500)
						{
							swal("Not Completed!", "Your record could not be removed. Please reload your browser and try again.", "error");
						}
					});
				}
				else
				{
					swal("Cancelled", "Operation Cancelled");
				}
			});
		}
	</script>