<div style="display: none;" id="resultsContainer">
	<?php if(count($olevel) > 0): ?>
	<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="resribbon">
		<?php else: ?>
		<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="resribbon" style="display: none;">
			<?php endif; ?>
			<span class="ribbon-inner" data-toggle="modal" data-target="#viewolevel" title="View">
				View Records
			</span>
		</div>
		<br>
		<div id="results">
			<h4>O'Level Results</h4>
			<form autocomplete="off">
				<input type="hidden" name="_olevel_csrf" id="_olevel_csrf" value="<?php echo e(csrf_token()); ?>">
				<div class="row row-lg">
					<div class="col-md-12">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Degree Obtained*</label>
								<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="examtyperes">
									<?php if(count($gradeDocs) > 0): ?>
									<?php $__currentLoopData = $gradeDocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<option value="<?php echo e($grade->id); ?>"><?php echo e($grade->docname); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									<?php endif; ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<?php for($subjectCounter = 1; $subjectCounter <= 6; $subjectCounter++): ?>
				<div class="row row-lg">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="form-group form-material floating" data-plugin="formMaterial">
								<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="subject<?php echo e($subjectCounter); ?>">
									<?php if(count($subjects) > 0): ?>
									<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									<?php endif; ?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-material floating" data-plugin="formMaterial">
								<select class="form-control floating" data-plugin="select2" data-allow-clear="true" id="grade<?php echo e($subjectCounter); ?>">
									<?php if(count($grades) > 0): ?>
									<?php $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<option value="<?php echo e($grade->id); ?>"><?php echo e($grade->grade); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									<?php endif; ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<?php endfor; ?>
				<div class="row row-lg">
					<div class="col-md-12">
						<div class="col-md-8 col-md-offset-3">
							<button type="submit" class="btn btn-icon btn-raised btn-success" id="submitResult"><i class="icon wb-plus"></i> Continue</button>
						</div>
					</div>
				</div>
			</form>
		</div>


		<!-- Modal -->
		<div class="modal fade modal-rotate-from-left modal-warning" id="viewolevel" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title">O'Level Result</h4>
					</div>
					<div class="modal-body">
						<div class="row row-lg">
							<div class="col-md-12">
								<div class="col-md-12">
									<div class="alert alert-primary alert-dismissible">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>Edit: </strong> Select the option you want to change cnd click change in the dialog box
									</div>
								</div>
							</div>
							<div class="col-md-12" style="display: none;" id="result_edited_olevel">
								<div class="col-md-12">
									<div class="alert alert-success alert-dismissible">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>Success! </strong> Record Updated.
									</div>
								</div>
							</div>
							<div class="col-md-12" style="display: none;" id="result_edited_err_olevel">
								<div class="col-md-12">
									<div class="alert alert-danger alert-dismissible">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>Failed! </strong> Record was not updated. Please try again.
									</div>
								</div>
							</div>
							<!--<div class="col-md-12" id="result_change">
								<div class="col-md-12">
									<div class="alert alert-warning">
										<strong>Success!</strong> You should <a href="#" class="alert-link">read this message</a>.
										<strong>New changes made. Do you want to save changes? </strong>
										<a href="" class="alert-link">Yes</a>
										<a href="" class="alert-link">No</a>
									</div>
								</div>
							</div>-->
							<div class="col-md-12">
								<div class="col-md-4">
									<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="viewmod">
										<option value="0">-Select-</option>
										<?php if(count($xamolevel) > 0): ?>
										<?php $__currentLoopData = $xamolevel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $takens): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<?php $name =  app('App\Repositories\JobRepository')->getDocumentTypes($takens->exam_id); ?>
										<option value="<?php echo e($takens->exam_id); ?>"><?php echo e($name['docname']); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										<?php endif; ?>
									</select>
								</div>
							</div>
							<?php for($subjectCounter = 1; $subjectCounter <= 6; $subjectCounter++): ?>
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="form-group form-material floating" data-plugin="formMaterial">
										<select class="form-control editsub"  id="edit_subject<?php echo e($subjectCounter); ?>">
											<?php if(count($subjects) > 0): ?>
											<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											<?php endif; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-material floating" data-plugin="formMaterial">
										<select class="form-control floating editgrade" id="edit_grade_olevel<?php echo e($subjectCounter); ?>">
											<?php if(count($grades) > 0): ?>
											<?php $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<option value="<?php echo e($grade->id); ?>"><?php echo e($grade->grade); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											<?php endif; ?>
										</select>
									</div>
								</div>
							</div>
							<?php endfor; ?>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" onclick="deleteOlevel()" disabled="disabled" id="deleteres"><i class="icon ion-ios-trash"></i> Delete</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="icon wb-close"></i> Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal -->
	</div>
	<script type="text/javascript">
		$("#submitResult").click(function(e){
			e.preventDefault();
			var token = $("#_olevel_csrf").val();
			var examType = $("#examtyperes").val();
			var subjects = [];
			var grades   = [];

			for(var i = 1; i <= 6; i++)
			{
				subjects[i] = $("#subject"+i).val();
				grades[i]   = $("#grade"+i).val();

				console.log("Subject: " + subjects[i] + "\t Grade: " + grades[i]);
			}

			var formData = 
			{
				'_token':token, 'type':11, 'examType':examType, 'opcode':4,
				'subject1':subjects[1], 'grade1':grades[1],
				'subject2':subjects[2], 'grade2':grades[2],
				'subject3':subjects[3], 'grade3':grades[3],
				'subject4':subjects[4], 'grade4':grades[4],
				'subject5':subjects[5], 'grade5':grades[5],
				'subject6':subjects[6], 'grade6':grades[6],
			};

			$.post("/job", formData, function(data,xhr,status){
				console.log(data);
				if(data.created_at)
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
					toastr["success"]("O'Level Results Saved.", "Success", toastr.options);
					$("#reslink").removeClass("text-danger").addClass("text-primary");
					$("#emplink").removeClass("text-danger").addClass("text-primary");
					location.reload();
					//$("#resribbon").fadeIn("slow");
				}
				else if(!data || status == 500)
				{
					var response = "<p>Unfortunately! Your record was not captured. Please reload your browser and try again.</p>";
					swal({
						title: "Warning!",
						text: "" + response,
						html: true
					});
				}
			});
		})

		$("#viewmod").on("change", function(){
			var selected = $(this).val();
			var token = $("#_olevel_csrf").val();

			var formData = {'selected':selected, '_token':token};

			if(selected != 0)
			{
				$("#deleteres").removeAttr("disabled");

				$.get('/job/subjects', formData, function(data,xhr,status){
					console.log(data);
					console.log(data.length);

					if(data.length >= 1 && data.length == 6)
					{
						var response;
						for(var i = 0; i < data.length; i++)
						{
							var subject = "edit_subject"+ (i+1);
							var grade   = "edit_grade_olevel"+ (i+1);
							$("#"+subject).val(data[i].subject_id);
							$("#"+grade).val(data[i].grade_id)
							console.log(subject + " = " + data[i].subject_id);
							console.log(grade   + " = " + data[i].grade_id);
						}
					}
					else if(data.length < 6)
					{
						swal("Incomplete Record", "Your record was not properly updated to the server. Please delete and try again.", "error");
					}
					else
					{
						swal("Not Found", "No result found", "warning");
					}
				});
			}
		});

		$(function(){
			var oldValue, newValue;
			var oldGValue, newGValue;
			var select = $(".editsub");
			$(".editsub").on('focus', function () {
				oldValue = this.value;
				console.log("Old value = " + oldValue);
			}).change(function() {
				newValue = this.value;
				console.log("New Value = " + newValue);


				swal({
					title: "Warning!",
					text: "You are about to change a subject, would you like to continue?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#f96868",
					confirmButtonText: "Yes, change it!",
					cancelButtonText: "No, Go back.",
					closeOnConfirm: false,
					closeOnCancel: false
				}, function(isConfirm){
					if(isConfirm)
					{
						var token = $("#_olevel_csrf").val();
						var examType = $("#viewmod").val();
						var formData = {'_token':token, 'oldValue':oldValue, 'newValue':newValue, 'examType':examType, 'type':13};
						console.log(formData);
						$.post('/job', formData, function(data,xhr,status){
							console.log(data);
							if(data == 1)
							{
								swal("saved", "update successful", "success");
							}
							else
							{
								swal("error", "update was not successful. please try again.", "error");
							}
						});
					}
					else
					{
						swal("Cancelled", "Operation Cancelled");
					}
				});
			});

			$(".editgrade").on('focus', function () {
				oldGValue = this.value;
				console.log("Old value = " + oldGValue);
			}).change(function() {
				newGValue = this.value;
				var id = $(this).attr('id').match(/\d+$/);
				var subject = $("#edit_subject"+id).val();
				console.log("New value = " + newGValue);

				swal({
					title: "Warning!",
					text: "You are about to change a grade, would you like to continue?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#f96868",
					confirmButtonText: "Yes, change it!",
					cancelButtonText: "No, Go back.",
					closeOnConfirm: false,
					closeOnCancel: false
				}, function(isConfirm){
					if(isConfirm)
					{
						var token = $("#_olevel_csrf").val();
						var examType = $("#viewmod").val();
						var formData = {'_token':token, 'subject_id':subject, 'oldValue':oldGValue, 'newValue':newGValue, 'examType':examType, 'type':14};
						console.log(formData);
						$.post('/job', formData, function(data,xhr,status){
							console.log(data);
							if(data == 1)
							{
								swal("saved", "update successful", "success");
							}
							else
							{
								swal("error", "update was not successful. please try again.", "error");
							}
						});
					}
					else
					{
						swal("Cancelled", "Operation Cancelled");
					}
				});
			});
		});

		function updateOlevel()
		{
			var token = $("#_olevel_csrf").val();
			var examType = $("#viewmod").val();
			var subjects = [];
			var grades   = [];

			for(var i = 1; i <= 6; i++)
			{
				subjects[i] = $("#edit_subject"+i).val();
				grades[i]   = $("#edit_grade_olevel"+i).val();

				console.log("Subject: " + subjects[i] + "\t Grade: " + grades[i]);
			}

			var formData = 
			{
				'_token':token, 'type':11, 'examType':examType, 'opcode':2,
				'subject1':subjects[1], 'grade1':grades[1],
				'subject2':subjects[2], 'grade2':grades[2],
				'subject3':subjects[3], 'grade3':grades[3],
				'subject4':subjects[4], 'grade4':grades[4],
				'subject5':subjects[5], 'grade5':grades[5],
				'subject6':subjects[6], 'grade6':grades[6],
			};

			console.log(formData);

			$.post('/job', formData, function(data,xhr,status){
				console.log(data);
				if(data == 6)
				{
					$("#result_edited_olevel").fadeIn("slow");
					$("#result_edited_err_olevel").fadeOut("fast");
				}
				else
				{
					$("#result_edited_olevel").fadeOut("fast");
					$("#result_edited_err_olevel").fadeIn("slow");
				}
				if(status == 500)
				{
					$("#result_edited_olevel").fadeOut("fast");
					$("#result_edited_err_olevel").fadeIn("slow");
				}
			});
		}

		function deleteOlevel()
		{
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
					var examType = $("#viewmod").val();
					var token = $("#_olevel_csrf").val();
					var formData = {'_token':token, '_method':'DELETE', 'type':12};
					$.post('/job/'+examType, formData, function(data,xhr,status){
						console.log(data);
						if(data == 6)
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