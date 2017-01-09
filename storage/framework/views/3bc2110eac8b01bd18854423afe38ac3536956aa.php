<style type="text/css">
	.select2-dropdown {
		z-index: 9001;
	}
</style>
<?php
$degrees = array(
	1	=> "O.N.D.",
	2	=> "H.N.D.",
	3	=> "B.Sc.",
	4	=> "B.Eng.",
	5	=> "M.B.A.",
	6	=> "M.Sc.",
	7	=> "M.Phil.",
	8	=> "P.hD.",
	9	=> "OTHER",
	);
$grades = array(
	1	=> "FIRST CLASS",
	2	=> "SECOND CLASS UPPER",
	3	=> "SECOND CLASS LOWER",
	4	=> "THIRD CLASS",
	5	=> "DISTINCTION",
	6	=> "MERIT",
	7	=> "PASS",
	8	=> "UPPER CREDIT",
	9	=> "LOWER CREDIT",
	10	=> "OTHER",
	);
	?>
	<div style="display: none;" id="educationContainer">
		<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="edribbon">
			<span class="ribbon-inner" data-toggle="modal" data-target="#vieweducation" title="View">
				View Records
			</span>
		</div>
		<br>
		<div id="education">
			<h4>Secondary School Education</h4><span class="text-danger">Fields marked * are compulsory</span>
			<button type="button" class="btn btn-floating btn-sm btn-success pull-right" id="addmoresec" data-toggle="tooltip" data-placement="top" title="Add More Secondary School."><i class="icon wb-loop"></i></button>
			<br>
			<form autocomplete="off">
				<input type="hidden" name="_sec_token" id="_sec_token" value="<?php echo e(csrf_token()); ?>">
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<input type="text" class="form-control" name="schname" id="schname" required="required" autofocus="autofocus">
					<label class="floating-label">Name of School*</label>
					<label class="text-danger" id="namesecerr"></label>
				</div>
				<div class="form-group">
					<label class="control-label">Year of Entry*</label>
					<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="sechentryyear">
						<option value="1980">1980</option>
						<?php for($i = 1981; $i <= date('Y'); $i++): ?>
						<option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
						<?php endfor; ?>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Year Completed*</label>
					<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="seccompletedyear">
						<option value="1980">1980</option>
						<?php for($i = 1981; $i <= date('Y'); $i++): ?>
						<option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
						<?php endfor; ?>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Degree Obtained*</label>
					<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="secdegree">
						<?php if(count($gradeDocs) > 0): ?>
						<?php $__currentLoopData = $gradeDocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<option value="<?php echo e($grade->id); ?>"><?php echo e($grade->docname); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						<?php endif; ?>
					</select>
				</div>
			<!--<a class="btn btn-primary btn-outline" id="secsaved" data-plugin="toastr" data-message="" data-container-id="toast-top-right" data-progress-bar="true"
			data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button">Progress Bar</a>-->
			<button type="submit" class="btn btn-icon btn-raised btn-success" id="submitSec" disabled="disabled"><i class="icon wb-plus"></i> Continue</button>
			<br><br>
		</form>
		<form autocomplete="off">
			<input type="hidden" name="_inst_token" id="_inst_token" value="<?php echo e(csrf_token()); ?>">
			<h4>Tertiary Education</h4><span class="text-danger">Fields marked * are compulsory</span>
			<button type="button" class="btn btn-floating btn-sm btn-success pull-right" id="addmoreinst" data-toggle="tooltip" data-placement="top" title="Add More Tertiary Education"><i class="icon wb-loop"></i></button>
			<div class="form-group">
				<label class="control-label">country*</label>
				<select class="form-control" data-plugin="select2" data-allow-clear="true" id="inst_country">
					<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</select>
				<label class="text-danger" id="inst_country_err"></label>
			</div>
			<div class="form-group form-material floating" data-plugin="formMaterial">
				<input type="text" class="form-control" name="instname" id="inst_name" required="required">
				<label class="floating-label">Name of Institution*</label>
				<label class="text-danger" id="inst_name_err"></label>
			</div>
			<div class="form-group form-material floating" data-plugin="formMaterial">
				<input type="text" class="form-control" name="course" id="inst_course" required="required">
				<label class="floating-label">Course of Study*</label>
				<label class="text-danger" id="inst_course_err"></label>
			</div>
			<div class="form-group">
				<label class="control-label">Year of Entry*</label>
				<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="inst_start">
					<option value="1980">1980</option>
					<?php for($i = 1981; $i <= date('Y'); $i++): ?>
					<option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
					<?php endfor; ?>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">Year Completed*</label>
				<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="inst_end">
					<option value="1980">1980</option>
					<?php for($i = 1981; $i <= date('Y'); $i++): ?>
					<option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
					<?php endfor; ?>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">Degree Obtained*</label>
				<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="inst_degree">
					<?php for($degindex = 1; $degindex <= count($degrees); $degindex++): ?>
					<option value="<?php echo e($degindex); ?>"><?php echo e($degrees[$degindex]); ?></option>
					<?php endfor; ?>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">Degree Class*</label>
				<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="inst_degree_class">
					<?php for($gradeindex = 1; $gradeindex <= count($grades); $gradeindex++): ?>
					<option value="<?php echo e($gradeindex); ?>"><?php echo e($grades[$gradeindex]); ?></option>
					<?php endfor; ?>
				</select>
			</div>
			<button type="submit" class="btn btn-icon btn-raised btn-success" id="submitInst" disabled="disabled"><i class="icon wb-plus"></i> Continue</button>
		</form>
	</div>

	<!-- Modal -->
	<div class="modal fade modal-rotate-from-left modal-warning" id="vieweducation" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Education Records</h4>
				</div>
				<div class="modal-body">
					<div class="row row-lg">
						<div class="col-md-12">
							<?php if(count($eds) > 0): ?>
							<div class="panel-group" id="secondaryaccordion" aria-multiselectable="true" role="tablist">
								<?php $__currentLoopData = $eds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ed): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<div class="panel">
									<div class="panel-heading" id="$secEd<?php echo e($ed->id); ?>" role="tab">
										<a class="panel-title" data-toggle="collapse" href="#secEdData<?php echo e($ed->id); ?>" data-parent="#secondaryaccordion" aria-expanded="false" aria-controls="secEdData{$ed->id}}">
											<?php echo e($ed->name); ?>

										</a>
									</div>
								</div>
								<div class="panel-collapse collapse" id="secEdData<?php echo e($ed->id); ?>" aria-labelledby="secEd<?php echo e($ed->id); ?>" role="tabpanel">
									<div class="panel-body">
										<div class="row row-lg">
											<div class="col-md-12" style="display: none;" id="ededited<?php echo e($ed->id); ?>">
												<div class="col-md-12">
													<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Success! </strong> Record Updated.
													</div>
												</div>
											</div>
											<div class="col-md-12" style="display: none;" id="ededitederr<?php echo e($ed->id); ?>">
												<div class="col-md-12">
													<div class="alert alert-danger alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Failed! </strong> Record was not updated. Please try again.
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-md-6">
													<div class="form-group form-material floating" data-plugin="formMaterial">
														<input type="text" class="form-control" name="edit_schname" id="edit_schname<?php echo e($ed->id); ?>" value="<?php echo e($ed->name); ?>">
														<label class="floating-label">Name of School*</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Year of Entry*</label>
														<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="edit_entry_year<?php echo e($ed->id); ?>">
															<option value="1980">1980</option>
															<?php for($i = 1981; $i <= date('Y'); $i++): ?>
															<?php if($ed->start_year == $i): ?>
															<option selected="selected" value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
															<?php else: ?>
															<option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
															<?php endif; ?>
															<?php endfor; ?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Year Completed*</label>
														<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="edit_seccompletedyear<?php echo e($ed->id); ?>">
															<option value="1980">1980</option>
															<?php for($i = 1981; $i <= date('Y'); $i++): ?>
															<?php if($ed->end_year == $i): ?>
															<option selected="selected" value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
															<?php else: ?>
															<option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
															<?php endif; ?>
															<?php endfor; ?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Degree Obtained*</label>
														<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="edit_secdegree<?php echo e($ed->id); ?>">
															<?php if(count($gradeDocs) > 0): ?>
															<?php $__currentLoopData = $gradeDocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
															<?php if($ed->degree == $grade->id): ?>
															<option selected="selected" value="<?php echo e($grade->id); ?>"><?php echo e($grade->docname); ?></option>
															<?php else: ?>
															<option value="<?php echo e($grade->id); ?>"><?php echo e($grade->docname); ?></option>
															<?php endif; ?>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
															<?php endif; ?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-md-12">
													<button type="button" class="btn btn-success" onclick="updateSec(<?php echo e($ed->id); ?>)"><i class="icon wb-check-circle"></i> Save changes</button>
													<button type="button" class="btn btn-danger" onclick="deleteSec(<?php echo e($ed->id); ?>)"><i class="icon ion-ios-trash"></i> Delete</button>
												</div>
											</div>
										</div>
									</div>

								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							</div>
							<?php endif; ?>

							<h4>Higher Institution</h4>
							<hr>
							<!-- Higher Institution Records -->
							<?php if(count($edIs) > 0): ?>
							<div class="panel-group" id="institutionaccordion" aria-multiselectable="true" role="tablist">
								<?php $__currentLoopData = $edIs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $is): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<div class="panel">
									<div class="panel-heading" id="$isEd<?php echo e($is->id); ?>" role="tab">
										<a class="panel-title" data-toggle="collapse" href="#isEdData<?php echo e($is->id); ?>" data-parent="#institutionaccordion" aria-expanded="false" aria-controls="isEdData{$is->id}}">
											<?php echo e($is->name); ?>

										</a>
									</div>
								</div>
								<div class="panel-collapse collapse" id="isEdData<?php echo e($is->id); ?>" aria-labelledby="isEd<?php echo e($is->id); ?>" role="tabpanel">
									<div class="panel-body">
										<div class="row row-lg">
											<div class="col-md-12" style="display: none;" id="isedited<?php echo e($is->id); ?>">
												<div class="col-md-12">
													<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Success! </strong> Record Updated.
													</div>
												</div>
											</div>
											<div class="col-md-12" style="display: none;" id="iseditederr<?php echo e($is->id); ?>">
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
														<label class="control-label">country*</label>
														<select class="form-control" data-plugin="select2" data-allow-clear="true" id="edit_is_country<?php echo e($is->id); ?>">
															<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
															<?php if($is->country_id == $country->id): ?>
															<option selected="selected" value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
															<?php else: ?>
															<option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
															<?php endif; ?>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group form-material floating" data-plugin="formMaterial">
														<input type="text" class="form-control" name="editisname" id="edit_is_name<?php echo e($is->id); ?>" value="<?php echo e($is->name); ?>">
														<label class="floating-label">Name of Institution*</label>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-md-6">
													<div class="form-group form-material floating" data-plugin="formMaterial">
														<input type="text" class="form-control" name="editiscourse" id="edit_is_course<?php echo e($is->id); ?>" value="<?php echo e($is->course); ?>">
														<label class="floating-label">Course of Study*</label>
														<label class="text-danger" id="inst_course_err"></label>
													</div>
												</div>
												<div class="col-md-6">
													
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Degree Obtained*</label>
														<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="edit_is_degree<?php echo e($is->id); ?>">
															<?php for($degindex = 1; $degindex <= count($degrees); $degindex++): ?>
															<?php if($is->degree == $degindex): ?>
															<option selected="selected" value="<?php echo e($degindex); ?>"><?php echo e($degrees[$degindex]); ?></option>
															<?php else: ?>
															<option value="<?php echo e($degindex); ?>"><?php echo e($degrees[$degindex]); ?></option>
															<?php endif; ?>
															<?php endfor; ?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Degree Class*</label>
														<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="edit_grade<?php echo e($is->id); ?>">
															<?php for($gradeindex = 1; $gradeindex <= count($grades); $gradeindex++): ?>
															<?php if($is->degree_class == $gradeindex): ?>
															<option selected="selected" value="<?php echo e($gradeindex); ?>"><?php echo e($grades[$gradeindex]); ?></option>
															<?php else: ?>
															<option value="<?php echo e($gradeindex); ?>"><?php echo e($grades[$gradeindex]); ?></option>
															<?php endif; ?>
															<?php endfor; ?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Year of Entry*</label>
														<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="edit_is_start<?php echo e($is->id); ?>">
															<option value="1980">1980</option>
															<?php for($i = 1981; $i <= date('Y'); $i++): ?>
															<?php if($is->start_year == $i): ?>
															<option selected="selected" value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
															<?php else: ?>
															<option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
															<?php endif; ?>
															<?php endfor; ?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Year Completed*</label>
														<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="edit_is_end<?php echo e($is->id); ?>">
															<option value="1980">1980</option>
															<?php for($i = 1981; $i <= date('Y'); $i++): ?>
															<?php if($is->end_year == $i): ?>
															<option selected="selected" value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
															<?php else: ?>
															<option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
															<?php endif; ?>
															<?php endfor; ?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-md-12">
													<button type="button" class="btn btn-success" onclick="updateInst(<?php echo e($is->id); ?>)"><i class="icon wb-check-circle"></i> Save changes</button>
													<button type="button" class="btn btn-danger" onclick="deleteInst(<?php echo e($is->id); ?>)"><i class="icon ion-ios-trash"></i> Delete</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="row row-lg">
						<div class="col-md-12">
							<div class="col-md-12">
								<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="icon wb-close"></i> Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal -->
</div>
<script type="text/javascript">
	$("#schname").on("keyup", function(){
		var secname = $(this).val();
		if(!secname || secname == '')
		{
			$("#namesecerr").html("Please enter a secondary school name").fadeIn("slow");
			$("#submitSec").attr('disabled', 'disabled');
			return false;
		}
		else
		{
			$("#namesecerr").html("").fadeOut("fast");
			$("#submitSec").removeAttr("disabled");
			return true;
		}
	});
	$("#submitSec").click(function(e){
		e.preventDefault();
		var secname = $("#schname").val();
		var secstart = $("#sechentryyear").val();
		var secend = $("#seccompletedyear").val();
		var secdegree = $("#secdegree").val();
		var token = $("#_sec_token").val();

		var formData = {'secname':secname, 'secstart':secstart, 'secend':secend, 'secdegree':secdegree, '_token':token, 'type':4, 'opcode':1};

		$.post('/job', formData, function(data,xhr,status){
			console.log(data);
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
				toastr["success"]("Secondary School Record Saved.", "Success", toastr.options);
				//$("#edribbon").fadeIn("slow");
				location.reload();
			}
			else
			{
				var response;
				if(data.name)
				{
					if(data.name.length == 1)
					{
						response = "<p>"+data.name+"</p>";
					}
					else
					{
						for(var i = 0; i < data.name.length; i++)
						{
							response += "<p>"+data.name[i]+"</p>";
						}
					}
				}
				else
				{
					response = "<p>An unknown error just occured. Please refresh your browser and try again.</p>";
				}

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
				toastr["warning"](""+response, "Warning", toastr.options);
			}
		});
	});
</script>

<script type="text/javascript">
	$("#inst_name").on("keyup", function(){
		var name = $(this).val();
		if(!name || name.length <= 5 || name == '')
		{
			$("#inst_name_err").html("Please enter a valid Institution Name").fadeIn("slow");
			$("#submitInst").attr('disabled', 'disabled');
			return false;
		}
		else
		{
			$("#inst_name_err").html("").fadeOut("fast");
			$("#submitInst").removeAttr('disabled');
			return true;
		}
	});

	$("#inst_country").on("change", function(){
		var country = $(this).val();
		if(country == 1 || country == 14 || country == 33 || country == 53 || country == 67 || country == 71 || country == 83 || country == 89 || country == 98 || country == 102 || country == 111 || country == 121 || country == 141 || country == 152 || country == 154 || country == 165 || country == 167 || country == 171 || country == 200 || country == 213 || country == 220 || country == 224 || country == 226)
		{
			$("#inst_country_err").html("Invalid country selected. Please select a valid country").fadeIn("slow");
			$("#submitInst").attr('disabled', 'disabled');
			return false;
		}
		else
		{
			$("#inst_country_err").html("").fadeOut("fast");
			$("#submitInst").removeAttr('disabled');
			return true;
		}

	});

	$("#inst_course").on("keyup", function(){
		var course = $(this).val();
		if(!course || course.length <= 5 || course == '')
		{
			$("#inst_course_err").html("Please enter a valid course name").fadeIn("slow");
			$("#submitInst").attr('disabled', 'disabled');
			return false;
		}
		else
		{
			$("#inst_course_err").html("").fadeOut("fast");
			$("#submitInst").removeAttr('disabled');
			return true;
		}
	});

	$("#submitInst").click(function(e){
		e.preventDefault();
		var country = $("#inst_country").val();
		var name = $("#inst_name").val();
		var course = $("#inst_course").val();
		var start = $("#inst_start").val();
		var end = $("#inst_end").val();
		var degree = $("#inst_degree").val();
		var degreeClass = $("#inst_degree_class").val();
		var token = $("#_inst_token").val();

		if(country == 1 || country == 14 || country == 33 || country == 53 || country == 67 || country == 71 || country == 83 || country == 89 || country == 98 || country == 102 || country == 111 || country == 121 || country == 141 || country == 152 || country == 154 || country == 165 || country == 167 || country == 171 || country == 200 || country == 213 || country == 220 || country == 224 || country == 226)
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
			toastr["warning"]("Invalid Country Selected.<p>Please select a valid country</p>", "Warning", toastr.options);
			return false;
		}
		else
		{
			var formData = {'country':country, 'name':name, 'course':course, 'start_year':start, 'end_year':end, 'degree':degree, 'degreeClass':degreeClass, '_token':token, 'type':5, 'opcode': 1};

			console.log(formData);

			$.post("/job", formData, function(data,xhr,status){
				console.log(data);
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
					toastr["success"]("Institution record saved.<p>You can view records by clicking view records button.</p>", "Success", toastr.options);
					location.reload();
					swal({
						title: "Success",
						text: "would you like to add more Institution records?",
						type: "success",
						showCancelButton: true,
						confirmButtonColor: "#369b6f",
						confirmButtonText: "Yes, I want to add more",
						cancelButtonText: "No, I'm done adding",
						closeOnConfirm: false,
						closeOnCancel: false
					}, function(isConfirm){
						if(isConfirm)
						{
							$("#inst_name").html("").fadeIn("slow");
							$("#inst_course").html("").fadeIn("slow");
							$("#inst_country option[value=1]").attr('selected', 'selected');
							$("#inst_start option[value=1980]").attr('selected', 'selected');
							$("#inst_end option[value=1980]").attr('selected', 'selected');
							$("#inst_degree option[value=1]").attr('selected', 'selected');
							$("#inst_degree_class option[value=1]").attr('selected', 'selected');
							swal("You can view your added records anytime by clicking on view records.");
						}
						else
						{
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
							$("#edlink").removeClass("text-danger").addClass("text-primary");
							$("#emplink").removeClass("text-danger").addClass("text-primary");
							swal("You can view your added records anytime by clicking on view records.");
						}
					});
				}
				else
				{

				}
			});
		}
	});

	function updateSec(id)
	{
		var secname = $("#edit_schname"+id).val();
		var secstart = $("#edit_entry_year"+id).val();
		var secend = $("#edit_seccompletedyear"+id).val();
		var secdegree = $("#edit_secdegree"+id).val();
		var token = $("#_sec_token").val();

		var formData = {'secname':secname, 'secstart':secstart, 'secend':secend, 'secdegree':secdegree, '_token':token, 'type':4, 'opcode':2, 'id':id};
		console.log(formData);
		$.post('/job', formData, function(data,xhr,status){
			console.log(data);
			if(data == 1)
			{
				$("#ededited"+id).fadeIn("slow");
				$("#ededitederr"+id).fadeOut("fast");
			}
			else
			{
				$("#ededitederr"+id).fadeIn("slow");
				$("#ededited"+id).fadeOut("fast");
			}
		});
	}

	function updateInst(id)
	{
		var country = $("#edit_is_country"+id).val();
		var name = $("#edit_is_name"+id).val();
		var course = $("#edit_is_course"+id).val();
		var start = $("#edit_is_start"+id).val();
		var end = $("#edit_is_end"+id).val();
		var degree = $("#edit_is_degree"+id).val();
		var degreeClass = $("#edit_grade"+id).val();
		var token = $("#_inst_token").val();

		if(country == 1 || country == 14 || country == 33 || country == 53 || country == 67 || country == 71 || country == 83 || country == 89 || country == 98 || country == 102 || country == 111 || country == 121 || country == 141 || country == 152 || country == 154 || country == 165 || country == 167 || country == 171 || country == 200 || country == 213 || country == 220 || country == 224 || country == 226)
		{
			swal("Warning!", "Please enter a valid Country.", "warning");
		}
		else
		{
			var formData = {'country':country, 'name':name, 'course':course, 'start_year':start, 'end_year':end, 'degree':degree, 'degreeClass':degreeClass, '_token':token, 'type':5, 'opcode': 2, 'id':id};
			console.log(formData);
			$.post('/job', formData, function(data,xhr,status){
				console.log(data);
				if(data == 1)
				{
					$("#isedited"+id).fadeIn("slow");
					$("#iseditederr"+id).fadeOut("fast");
				}
				else
				{
					$("#iseditederr"+id).fadeIn("slow");
					$("#isedited"+id).fadeOut("fast");
				}
			});
		}
	}

	function deleteSec(id)
	{
		var token = $("#_sec_token").val();
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
				var formData = {'_token':token, '_method': 'DELETE', 'type': 4};
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

	function deleteInst(id)
	{
		var token = $("#_inst_token").val();
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
				var formData = {'_token':token, '_method': 'DELETE', 'type': 5};
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

	$("#addmoresec").click(function(){
		$("#schname").val("");
	});
	$("#addmoreinst").click(function(){
		$("#inst_name").val("");
		$("#inst_course").val("");
	})
</script>