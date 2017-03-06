<?php
$refTitle = array(
	1 	=> "Mr.",
	2	=> "Mrs.",
	3	=> "Miss.",
	4	=> "Ms."
	);
	?>
	<div style="display: none;" id="referencesContainer">
		<?php if(count($refs) > 0): ?>
		<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="refribbon">
			<?php else: ?>
			<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="refribbon" style="display: none;">
				<?php endif; ?>
				<span class="ribbon-inner" data-toggle="modal" data-target="#viewreferencsrecords" title="View">
					View Records
				</span>
			</div>
			<br>
			<div id="references">
				<h4>References</h4>
				<span class="text-danger">Fields marked * are compulsory</span>
				<button type="button" class="btn btn-floating btn-sm btn-success pull-right" id="addmoreref" data-toggle="tooltip" data-placement="top" title="Add More.">
					<i class="icon wb-loop"></i>
				</button>
				<br>
				<form autocomplete="off">
					<input type="hidden" name="_ref_token" id="_ref_token" value="<?php echo e(csrf_token()); ?>">
					<div class="form-group">
						<label class="control-label">Title*</label>
						<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="ref_title">
							<option value="1">Mr.</option>
							<option value="2">Mrs.</option>
							<option value="3">Miss.</option>
							<option value="4">Ms.</option>
						</select>
					</div>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="text" class="form-control" name="ref_name" id="ref_name" required="required" autofocus="autofocus">
						<label class="floating-label">Name*</label>
						<label class="text-danger" id="ref_name_err"></label>
					</div>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="text" class="form-control" name="ref_prof" id="ref_prof" required="required">
						<label class="floating-label">Profession*</label>
						<label class="text-danger" id="ref_prof_err"></label>
					</div>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="text" class="form-control" name="ref_addr" id="ref_addr" required="required">
						<label class="floating-label">Address*</label>
						<label class="text-danger" id="ref_addr_err"></label>
					</div>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="text" class="form-control" name="ref_city" id="ref_city" required="required">
						<label class="floating-label">City*</label>
						<label class="text-danger" id="ref_city_err"></label>
					</div>
					<div class="form-group">
						<label class="control-label">State*</label>
						<select class="form-control" data-plugin="select2" data-allow-clear="true" id="ref_state">
							<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<option value="<?php echo e($state->id); ?>"><?php echo e($state->state); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">country*</label>
						<select class="form-control" data-plugin="select2" data-allow-clear="true" id="ref_country">
							<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</select>
						<label class="text-danger" id="ref_country_err"></label>
					</div>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="email" class="form-control" name="ref_mail" id="ref_mail" required="required">
						<label class="floating-label">E-Mail*</label>
						<label class="text-danger" id="ref_mail_err"></label>
					</div>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="phone" class="form-control" name="ref_phone" id="ref_phone" required="required">
						<label class="floating-label">Phone*</label>
						<label class="text-danger" id="ref_phone_err"></label>
					</div>
					<button type="submit" class="btn btn-icon btn-raised btn-success" id="submitreferences" disabled="disabled"><i class="icon wb-plus"></i> Continue</button>
				</form>
			</div>

			<!-- Modal -->
			<div class="modal fade modal-rotate-from-left modal-warning" id="viewreferencsrecords" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">References - Records</h4>
						</div>
						<div class="modal-body">
							<div class="row row-lg">
								<div class="col-md-12">
									<?php if(count($refs) > 0): ?>
									<div class="panel-group" id="referencesaccordion" aria-multiselectable="true" role="tablist">
										<?php $__currentLoopData = $refs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<div class="panel">
											<div class="panel-heading" id="$refEd<?php echo e($ref->id); ?>" role="tab">
												<a class="panel-title" data-toggle="collapse" href="#refEdData<?php echo e($ref->id); ?>" data-parent="#referencesaccordion" aria-expanded="false" aria-controls="refEdData{$ref->id}}">
													<?php echo e($ref->ref_name); ?>

												</a>
											</div>
										</div>
										<div class="panel-collapse collapse" id="refEdData<?php echo e($ref->id); ?>" aria-labelledby="refEd<?php echo e($ref->id); ?>" role="tabpanel">
											<div class="panel-body">
												<div class="row row-lg">
													<div class="col-md-12" style="display: none;" id="refedited<?php echo e($ref->id); ?>">
														<div class="col-md-12">
															<div class="alert alert-success alert-dismissible">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Success! </strong> Record Updated.
															</div>
														</div>
													</div>
													<div class="col-md-12" style="display: none;" id="refeditederr<?php echo e($ref->id); ?>">
														<div class="col-md-12">
															<div class="alert alert-danger alert-dismissible">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Failed! </strong> Record was not updated. Please try again.
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label">Title*</label>
																<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="edit_ref_title<?php echo e($ref->id); ?>">
																	<?php for($i = 1; $i <= count($refTitle); $i++): ?>
																	<?php if($ref->ref_title == $i): ?>
																	<option selected="selected" value="<?php echo e($i); ?>"><?php echo e($refTitle[$i]); ?></option>
																	<?php else: ?>
																	<option value="<?php echo e($i); ?>"><?php echo e($refTitle[$i]); ?></option>
																	<?php endif; ?>
																	<?php endfor; ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-6">
															<div class="form-group form-material floating" data-plugin="formMaterial">
																<input type="text" class="form-control" name="edit_ref_name" id="edit_ref_name<?php echo e($ref->id); ?>" value="<?php echo e($ref->ref_name); ?>">
																<label class="floating-label">Name</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group form-material floating" data-plugin="formMaterial">
																<input type="text" class="form-control" name="edit_ref_prof" id="edit_ref_prof<?php echo e($ref->id); ?>" value="<?php echo e($ref->ref_prof); ?>">
																<label class="floating-label">Profession</label>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group form-material floating" data-plugin="formMaterial">
																<textarea class="form-control" name="edit_ref_addr" id="edit_ref_addr<?php echo e($ref->id); ?>"><?php echo e($ref->ref_addr); ?></textarea>
																<label class="floating-label">Address</label>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-6">
															<div class="form-group form-material floating" data-plugin="formMaterial">
																<input type="text" class="form-control" name="edit_ref_city" id="edit_ref_city<?php echo e($ref->id); ?>" value="<?php echo e($ref->ref_city); ?>">
																<label class="floating-label">City</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">State*</label>
																<select class="form-control" data-plugin="select2" data-allow-clear="true" id="edit_ref_state<?php echo e($ref->id); ?>">
																	<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																	<?php if($ref->ref_state_id == $state->id): ?>
																	<option selected="selected" value="<?php echo e($state->id); ?>"><?php echo e($state->state); ?></option>
																	<?php else: ?>
																	<option value="<?php echo e($state->id); ?>"><?php echo e($state->state); ?></option>
																	<?php endif; ?>
																	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label">country*</label>
																<select class="form-control" data-plugin="select2" data-allow-clear="true" id="edit_ref_country<?php echo e($ref->id); ?>">
																	<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																	<?php if($ref->ref_country_id == $country->id): ?>
																	<option selected="selected" value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
																	<?php else: ?>
																	<option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
																	<?php endif; ?>
																	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-6">
															<div class="form-group form-material floating" data-plugin="formMaterial">
																<input type="email" class="form-control" name="edit_ref_mail" id="edit_ref_mail<?php echo e($ref->id); ?>" value="<?php echo e($ref->ref_email); ?>">
																<label class="floating-label">E-Mail</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group form-material floating" data-plugin="formMaterial">
																<input type="phone" class="form-control" name="edit_ref_phone" id="edit_ref_phone<?php echo e($ref->id); ?>" value="<?php echo e($ref->ref_phone); ?>">
																<label class="floating-label">Phone</label>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-12">
															<button type="button" class="btn btn-success" onclick="updateRef(<?php echo e($ref->id); ?>)"><i class="icon wb-check-circle"></i> Save changes</button>
															<button type="button" class="btn btn-danger" onclick="deleteRef(<?php echo e($ref->id); ?>)"><i class="icon ion-ios-trash"></i> Delete</button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									</div>
									<?php else: ?>
									<h4 class="text-center">No Referees Saved Yet.</h4>
									<?php endif; ?>
								</div>
							</div>
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
			$("#ref_name").on("keyup", function(){
				var name = $(this).val();
				if(!name || name == '' || name.length < 3)
				{
					$("#ref_name_err").html("Please enter a valid name").fadeIn("slow");
					$("#submitreferences").attr("disabled", "disabled");
					return false;
				}
				else
				{
					$("#ref_name_err").html("").fadeOut("fast");
					$("#submitreferences").removeAttr("disabled");
					return true;
				}
			});

			$("#ref_prof").on("keyup", function(){
				var prof = $(this).val();
				if(!prof || prof == '')
				{
					$("#ref_prof_err").html("Please enter a valid profession").fadeIn("slow");
					$("#submitreferences").attr("disabled", "disabled");
					return false;
				}
				else
				{
					$("#ref_prof_err").html("").fadeOut("fast");
					$("#submitreferences").removeAttr("disabled");
					return false;
				}
			});

			$("#ref_addr").on("keyup", function(){
				var addr = $(this).val();
				if(!addr || addr == '' || addr.length < 5)
				{
					$("#ref_addr_err").html("Please enter a valid address").fadeIn("slow");
					$("#submitreferences").attr("disabled", "disabled");
					return false;
				}
				else
				{
					$("#ref_addr_err").html("").fadeOut("fast");
					$("#submitreferences").removeAttr("disabled");
					return true;
				}
			});

			$("#ref_city").on("keyup", function(){
				var city = $(this).val();
				if(!city || city == '')
				{
					$("#ref_city_err").html("Please enter a valid city").fadeIn("slow");
					$("#submitreferences").attr("disabled", "disabled");
					return false;
				}
				else
				{
					$("#ref_city_err").html("").fadeOut("fast");
					$("#submitreferences").removeAttr("disabled");
					return true;
				}
			});

			$("#ref_country").on("change", function(){
				var country = $(this).val();
				if(country == 1 || country == 14 || country == 33 || country == 53 || country == 67 || country == 71 || country == 83 || country == 89 || country == 98 || country == 102 || country == 111 || country == 121 || country == 141 || country == 152 || country == 154 || country == 165 || country == 167 || country == 171 || country == 200 || country == 213 || country == 220 || country == 224 || country == 226)
				{
					$("#ref_country_err").html("Please select a valid country").fadeIn("slow");
					$("#submitreferences").attr("disabled", "disabled");
					return false;
				}
				else
				{
					$("#ref_country_err").html("").fadeOut("fast");
					$("#submitreferences").removeAttr("disabled");
					return true;
				}
			})

			$("#ref_mail").on("keyup", function(){
				var mail = $(this).val();
				if(!mail || !validateEmail(mail))
				{
					$("#ref_mail_err").html("Please enter a valid e-mail address").fadeIn("slow");
					$("#submitreferences").attr("disabled", "disabled");
					return false;
				}
				else
				{
					$("#ref_mail_err").html("").fadeOut("fast");
					$("#submitreferences").removeAttr("disabled");
					return true;
				}
			});

			$("#submitreferences").click(function(e){
				e.preventDefault();
				var title = $("#ref_title").val();
				var name = $("#ref_name").val();
				var prof = $("#ref_prof").val();
				var addr = $("#ref_addr").val();
				var city = $("#ref_city").val();
				var state = $("#ref_state").val();
				var country = $("#ref_country").val();
				var mail = $("#ref_mail").val();
				var phone = $("#ref_phone").val();
				var token = $("#_ref_token").val();

				var formData = {'title':title, 'name':name, 'prof':prof, 'addr':addr, 'city':city, 'state':state, 'country':country, 'mail':mail, 'phone':phone, '_token':token, 'type':10, 'opcode':1};

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
						toastr["success"]("New Reference Contact Addedd succsesfully.<p>You can view records by clicking view records button.</p><p>To add more records. Please click on the add more button.</p>", "Success", toastr.options);
						$("#reflink").removeClass("text-danger").addClass("text-primary");
						$("#addlink").removeClass("text-danger").addClass("text-primary");
						location.reload();
						//$("#refribbon").fadeIn("slow");
					}
					else
					{
						if(data.ref_name)
						{
							var response;
							if(data.ref_name.length == 1)
							{
								response = "<p>"+data.ref_name+"</p>";
							}
							else
							{
								for(var i = 0; i < data.ref_name.length; i++)
								{
									response += "<p>"+data.ref_name[i]+"</p>";
								}
							}
							swal({
								title: "Warning!",
								text: "" + response,
								html: true
							});
						}
						if(data.ref_prof)
						{
							var response;
							if(data.ref_prof.length == 1)
							{
								response = "<p>"+data.ref_prof+"</p>";
							}
							else
							{
								for(var i = 0; i < data.ref_prof.length; i++)
								{
									response += "<p>"+data.ref_prof[i]+"</p>";
								}
							}
							swal({
								title: "Warning!",
								text: "" + response,
								html: true
							});
						}
						if(data.ref_addr)
						{
							var response;
							if(data.ref_addr.length == 1)
							{
								response = "<p>"+data.ref_addr+"</p>";
							}
							else
							{
								for(var i = 0; i < data.ref_addr.length; i++)
								{
									response += "<p>"+data.ref_addr[i]+"</p>";
								}
							}
							swal({
								title: "Warning!",
								text: "" + response,
								html: true
							});
						}
						if(data.ref_city)
						{
							var response;
							if(data.ref_city.length == 1)
							{
								response = "<p>"+data.ref_city+"</p>";
							}
							else
							{
								for(var i = 0; i < data.ref_city.length; i++)
								{
									response += "<p>"+data.ref_city[i]+"</p>";
								}
							}
							swal({
								title: "Warning!",
								text: "" + response,
								html: true
							});
						}
						if(data.ref_email)
						{
							var response;
							if(data.ref_email.length == 1)
							{
								response = "<p>"+data.ref_email+"</p>";
							}
							else
							{
								for(var i = 0; i < data.ref_email.length; i++)
								{
									response += "<p>"+data.ref_email[i]+"</p>";
								}
							}
							swal({
								title: "Warning!",
								text: "" + response,
								html: true
							});
						}
						if(data.ref_phone)
						{
							var response;
							if(data.ref_phone.length == 1)
							{
								response = "<p>"+data.ref_phone+"</p>";
							}
							else
							{
								for(var i = 0; i < data.ref_phone.length; i++)
								{
									response += "<p>"+data.ref_phone[i]+"</p>";
								}
							}
							swal({
								title: "Warning!",
								text: "" + response,
								html: true
							});
						}
						if(status == 500)
						{
							var response = "<p>Unfortunately! Your record was not captured. Please reload your browser and try again.</p>";
							swal({
								title: "Warning!",
								text: "" + response,
								html: true
							});
						}
					}
				});
			});

function validateEmail(mail)   
{  
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))  
	{  
		return true;
	}
	return false;
}

$("#addmoreref").click(function(){
	$("#ref_name").val("");
	$("#ref_prof").val("");
	$("#ref_addr").val("");
	$("#ref_city").val("");
	$("#ref_mail").val("");
	$("#ref_phone").val("");
});

function updateRef(id)
{
	var title = $("#edit_ref_title"+id).val();
	var name = $("#edit_ref_name"+id).val();
	var prof = $("#edit_ref_prof"+id).val();
	var addr = $("#edit_ref_addr"+id).val();
	var city = $("#edit_ref_city"+id).val();
	var state = $("#edit_ref_state"+id).val();
	var country = $("#edit_ref_country"+id).val();
	var mail = $("#edit_ref_mail"+id).val();
	var phone = $("#edit_ref_phone"+id).val();
	var token = $("#_ref_token").val();

	var formData = {'title':title, 'name':name, 'prof':prof, 'addr':addr, 'city':city, 'state':state, 'country':country, 'mail':mail, 'phone':phone, '_token':token, 'type':10, 'opcode':2, 'id':id};
	console.log(formData);
	$.post('/job', formData, function(data,xhr,status){
		console.log(data);
		if(data == 1)
		{
			$("#refedited"+id).fadeIn("slow");
			$("#refeditederr"+id).fadeOut("fast");
		}
		else
		{
			$("#refedited"+id).fadeOut("fast");
			$("#refeditederr"+id).fadeIn("slow");
		}
		if(status == 500)
		{
			$("#refedited"+id).fadeOut("fast");
			$("#refeditederr"+id).fadeIn("slow");
		}
	});
}


function deleteRef(id)
{
	var token = $("#_ref_token").val();
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
			var formData = {'_token':token, '_method': 'DELETE', 'type': 10};
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