<?php
$modes = array(
	1=> "STUDENT MEMBER",
	2=> "ASSOCIATE MEMBER",
	3=> "MEMBER",
	4=> "FELLOW",
	5=> "OTHER"
	);
	?>
	<div style="display: none;" id="professionalContainer">
		@if(count($profs) > 0)
		<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="profribbon">
			@else
			<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="profribbon" style="display: none;">
				@endif
				<span class="ribbon-inner" data-toggle="modal" data-target="#viewprofessionalrecords" title="View">
					View Records
				</span>
			</div>
			<br>
			<div id="professional">
				<h4>Professional History</h4>
				<button type="button" class="btn btn-floating btn-sm btn-success pull-right" id="addmoreprof" data-toggle="tooltip" data-placement="top" title="Add More.">
					<i class="icon wb-loop"></i>
				</button>
				<br>
				<form autocomplete="off">
					<input type="hidden" name="_prof_csrf" id="_prof_csrf" value="{{csrf_token()}}">
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="text" class="form-control" name="bodyname" id="bodyname" autofocus="autofocus" required="required
						">
						<label class="floating-label">Name of Organisation/Body</label>
						<label class="text-danger" id="body_err"></label>
					</div>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="text" class="form-control" name="date_joined_body" id="date_joined_body" data-plugin="datepicker" data-date-format="yyyy-mm-dd" required="required">
						<label class="floating-label">Date Joined</label>
						<label class="text-danger" id="org_date_join_err"></label>
					</div>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="text" class="form-control" name="date_left_body" id="date_left_body" data-plugin="datepicker" data-date-format="yyyy-mm-dd" required="required">
						<label class="floating-label">Till</label>
						<label class="text-danger" id="org_date_till_err"></label>
					</div>
					<div class="form-group">
						<label class="control-label">Membership Mode</label>
						<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="org_membership_type">
							<option value="1">STUDENT MEMBER</option>
							<option value="2">ASSOCIATE MEMBER</option>
							<option value="3">MEMBER</option>
							<option value="4">FELLOW</option>
							<option value="5">OTHER</option>
						</select>
					</div>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="text" class="form-control" name="org_number" id="org_number">
						<label class="floating-label">Membership Number</label>
						<label class="text-danger" id="org_number_err"></label>
					</div>
					<div  class="dropzone" id="proof" name="proof">

					</div>
					<label class="text-danger" id="proferr"></label>
					<br><br>
					<button type="submit" class="btn btn-icon btn-raised btn-success" id="submitprof" disabled="disabled"><i class="icon wb-plus"></i> Continue</button>
				</form>
			</div>

			<!-- Modal -->
			<div class="modal fade modal-rotate-from-left modal-warning" id="viewprofessionalrecords" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">Professional Certifications History</h4>
						</div>
						<div class="modal-body">
							@if(count($profs) > 0)
							<div class="panel-group" id="professionalaccordion" aria-multiselectable="true" role="tablist">
								@foreach($profs as $prof)
								<div class="panel">
									<div class="panel-heading" id="$profD{{$prof->id}}" role="tab">
										<a class="panel-title" data-toggle="collapse" href="#profDataLnk{{$prof->id}}" data-parent="#professionalaccordion" aria-expanded="false" aria-controls="profDataLnk{$prof->id}}">
											{{ $prof->body }}
										</a>
									</div>
								</div>
								<div class="panel-collapse collapse" id="profDataLnk{{$prof->id}}" aria-labelledby="profD{{$prof->id}}" role="tabpanel">
									<div class="panel-body">
										<div class="row row-lg">
											<div class="col-md-12" style="display: none;" id="profedited{{$prof->id}}">
												<div class="col-md-12">
													<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Success! </strong> Record Updated.
													</div>
												</div>
											</div>
											<div class="col-md-12" style="display: none;" id="profeditederr{{$prof->id}}">
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
														<input type="text" class="form-control" name="bodyname" id="edit_bodyname{{$prof->id}}" value="{{ $prof->body }}">
														<label class="floating-label">Name of Organisation/Body</label>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-md-6">
													<div class="form-group form-material floating" data-plugin="formMaterial">
														<input type="text" class="form-control" name="edit_date_joined_body" id="edit_date_joined_body{{$prof->id}}" data-plugin="datepicker" data-date-format="yyyy-mm-dd" value="{{$prof->date_joined}}">
														<label class="floating-label">Date Joined</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group form-material floating" data-plugin="formMaterial">
														<input type="text" class="form-control" name="edit_date_left_body" id="edit_date_left_body{{$prof->id}}" data-plugin="datepicker" data-date-format="yyyy-mm-dd" value="{{$prof->till}}">
														<label class="floating-label">Till</label>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Membership Mode</label>
														<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="edit_org_membership_type{{$prof->id}}">
															@for($mi = 1; $mi <= count($modes); $mi++)
															@if($prof->mode == $mi)
															<option selected="selected" value="{{$mi}}">{{$modes[$mi]}}</option>
															@else
															<option value="{{$mi}}">{{$modes[$mi]}}</option>
															@endif
															@endfor
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group form-material floating" data-plugin="formMaterial">
														<input type="text" class="form-control" name="edit_org_number" id="edit_org_number{{$prof->id}}" value="{{$prof->prof_number}}">
														<label class="floating-label">Membership ID Number</label>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-md-12">
													<button type="button" class="btn btn-success" onclick="updateProf({{$prof->id}})"><i class="icon wb-check-circle"></i> Save changes</button>
													<button type="button" class="btn btn-danger" onclick="deleteProf({{$prof->id}})"><i class="icon ion-ios-trash"></i> Delete</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							@endif
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
			function updateProf(id)
			{
				var _token = $("#_prof_csrf").val();
				var org_name = $("#edit_bodyname"+id).val();
				var date_joined = $("#edit_date_joined_body"+id).val();
				var date_left = $("#edit_date_left_body"+id).val();
				var mem_num = $("#edit_org_number"+id).val();
				var org_membership_type = $("#edit_org_membership_type"+id).val();

				var formData = {'_token':_token, 'org_name':org_name, 'date_joined':date_joined, 'date_left':date_left, 'mem_num':mem_num, 'org_membership_type':org_membership_type, 'type':7, 'opcode':2, 'id':id};
				console.log(formData);
				$.post('/job', formData, function(data,xhr,status){
					console.log(data);
					if(data == 1)
					{
						$("#profedited"+id).fadeIn("slow");
						$("#profeditederr"+id).fadeOut("fast");
					}
					else
					{
						$("#profedited"+id).fadeOut("fast");
						$("#profeditederr"+id).fadeIn("slow");
					}
					if(status == 500)
					{
						$("#profedited"+id).fadeOut("fast");
						$("#profeditederr"+id).fadeIn("slow");
					}
				});
			}

			function deleteProf(id)
			{
				var token = $("#_prof_csrf").val();
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
						var formData = {'_token':token, '_method': 'DELETE', 'type': 7};
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

			$(function(){

				$("#bodyname").on("keyup", function(){

					var body = $(this).val();
					if(!body || body.length == 0 || body == '')
					{
						$("#body_err").html("Please enter a valid organization name").fadeIn("slow");
						$("#submitprof").attr('disabled', 'disabled');
						return false;
					}
					else
					{
						$("#body_err").html("").fadeOut("fast");
						$("#submitprof").removeAttr('disabled');
						return false;
					}
				});

				$("#date_joined_body").on("keyup", function(){
					var orgdate_joined = $(this).val();
					if(!orgdate_joined || orgdate_joined == '')
					{
						$("#org_date_join_err").html("Please enter a valid date").fadeIn("slow");
						$("#submitprof").attr('disabled', 'disabled');
						return false;
					}
					else
					{
						$("#org_date_join_err").html("").fadeOut("fast");
						$("#submitprof").removeAttr('disabled');
						return true;
					}
				});

				$("#date_left_body").on("keyup", function(){
					var date_left = $(this).val();
					if(!date_left || date_left == '')
					{
						$("#org_date_till_err").html("Please enter a valid date").fadeIn("slow");
						$("#submitprof").attr('disabled', 'disabled');
						return false;
					}
					else
					{
						$("#org_date_till_err").html("").fadeOut("fast");
						$("#submitprof").removeAttr('disabled');
						return true;
					}
				});

				$("#org_number").on("keyup", function(){
					var orgnumber = $(this).val();
					if(!orgnumber || orgnumber == '' || orgnumber.length == 1)
					{
						$("#org_number_err").html("Please enter a valid membership number").fadeIn("slow");
						$("#submitprof").attr('disabled', 'disabled');
						return false;
					}
					else
					{
						$("#org_number_err").html("").fadeOut("fast");
						$("#submitprof").removeAttr('disabled');
						return true;
					}
				});

				$("#addmoreprof").click(function(){
					$("#bodyname").val("");
					$("#date_joined_body").val("");
					$("#date_left_body").val("");
					$("#org_number").val("");
				});

				
				Dropzone.autoDiscover = false;

				var myDropzone = new Dropzone("#proof",{
					url:'/job',
					autoProcessQueue:false,
					acceptedFiles:'image/png,image/jpeg,image/jpg,application/pdf',
					uploadMultiple:false,
					maxFiles:1,
					dictDefaultMessage:"Drag or click here to upload proof of membership.",
					addRemoveLinks:'dictCancelUpload',
					parallelUploads:1,
					dictInvalidFileType:"You can only upload an image or PDF document",
					maxFilesize:0.0642,
					dictFileTooBig: 'Warning: Document is Larger than 62kb'
				});

				myDropzone.on("sending", function(file,xhr,formData) {
					formData.append('_token', $("#_prof_csrf").val());

					formData.append("org_name", $("#bodyname").val());

					formData.append("date_joined", $("#date_joined_body").val());

					formData.append("date_left", $("#date_left_body").val());

					formData.append("mem_num", $("#org_number").val());

					formData.append("org_membership_type", $("#org_membership_type").val());

					formData.append('type', 7);

					formData.append('opcode', 1);
				});

				myDropzone.on("success", function(file,response) {
					console.log("Request succesful");
					console.log(response);
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
					toastr["success"]("Record Addedd succsesfully.<p>You can view records by clicking view records button.</p><p>To add more records. Please click on the add more button.</p>", "Success", toastr.options);
					$("#proflink").removeClass("text-danger").addClass("text-primary");
					$("#skilllink").removeClass("text-danger").addClass("text-primary");
					location.reload();
					//$("#profribbon").fadeIn("slow");
				});

				myDropzone.on("error", function(file,response) {
					console.log("Error occured");
					console.log(response);
					if(response == "Warning: Document is Larger than 62kb")
					{
						$("#proferr").html("Warning: Document is Larger than 62kb").fadeIn("slow");
					}
					else
					{
						$("#proferr").html("").fadeOut("fast");
					}
					myDropzone.removeFile(file);
				});



				myDropzone.on("complete", function(file) {
					myDropzone.removeFile(file);
				});

				$("#submitprof").click(function(e){
					e.preventDefault();
					myDropzone.processQueue();

				});
			});
		</script>