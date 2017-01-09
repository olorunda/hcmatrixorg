<style type="text/css">
	.select2-dropdown {
		z-index: 9001;
	}
</style>
@if(Auth::user()->job_reg_status == 0)
<div id="biodataContainer">
@else
<div id="biodataContainer" style="display: none;">
@endif
	@if(count($bios) > 0)
	<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="bioribbon">
		@else
		<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="bioribbon" style="display: none;">
			@endif
			<span class="ribbon-inner" data-toggle="modal" data-target="#viewbiodata" title="View">
				View Records
			</span>
		</div>
		<br>
		<div id="biodata">
			<h4>Bio Data</h4>Fields marked * are compulsory
			<br>
			<form autocomplete="off">
				<input type="hidden" name="_bio_csrf" id="_bio_csrf" value="{{csrf_token()}}">
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<select class="form-control" id="app_title" name="app_title">
						<option value="1">Mr.</option>
						<option value="2">Mrs.</option>
						<option value="3">Miss.</option>
					</select>
					<label class="floating-label">Title*</label>
				</div>
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<select class="form-control" id="app_sex" name="app_sex">
						<option value="M">Male</option>
						<option value="F">Female</option>
					</select>
					<label class="floating-label">Sex*</label>
				</div>
				<div class="form-group">
					<div class="radio-custom radio-default radio-inline">
						<input type="radio" id="single" name="m_status" value="single" checked onclick="maidenCheck(1)">
						<label for="single">Single</label>
					</div>
					<div class="radio-custom radio-default radio-inline">
						<input type="radio" id="married" name="m_status" value="married" onclick="maidenCheck(0)">
						<label for="married">Married</label>
					</div>
				</div>
				<div class="form-group form-material floating" data-plugin="formMaterial" id="maidenBar" style="display: none;">
					<input type="text" class="form-control" name="maiden" id="maiden">
					<label class="floating-label">Maiden Name</label>
					<label class="text-danger" id="maidenerr"></label>
				</div>
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<input type="text" class="form-control" name="dob" id="dob" required="required" data-plugin="datepicker" data-date-format="yyyy-mm-dd">
					<label class="floating-label">Date of Birth*</label>
					<label class="text-danger" id="doberr"></label>
				</div>
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<input type="text" class="form-control" name="phone" id="phone" required="required">
					<label class="floating-label">Phone Number*</label>
					<label class="text-danger" id="phonerr"></label>
				</div>
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<select class="form-control" data-plugin="select2" data-allow-clear="true" id="app_origin" name="app_origin">
						@foreach($states as $state)
						<option value="{{$state->id}}">{{$state->state}}</option>
						@endforeach
					</select>
					<label class="floating-label">State of Origin*</label>
				</div>
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<input type="text" class="form-control" name="app_lga" id="app_lga" required="required">
					<label class="floating-label">Local Government Area*</label>
					<label class="text-danger" id="lgaerr"></label>
				</div>
			<!--<div class="form-group form-material floating" data-plugin="formMaterial">
				<input type="text" class="form-control" readonly="">
				<input type="file" name="inputFloatingFile" id="app_passport" required="required">
				<label class="floating-label">Upload Passport</label>
			</div>-->
			<p>

			</p>
			@if(Auth::user()->sex == 'M' || Auth::user()->sex == 'F')
			<button type="button" class="btn btn-icon btn-raised btn-success" data-toggle="modal" data-target="#viewbiodata"><i class="icon wb-eye"></i> View</button>
			@else
			<button type="submit" class="btn btn-icon btn-raised btn-success" id="submitBio" disabled="disabled"><i class="icon wb-plus"></i> Continue</button>
			@endif 
			<a class="btn btn-primary btn-outline" id="maidennotify" data-plugin="toastr"
			data-message="The maiden name must be a string"
			data-title="Maiden Name" data-container-id="toast-top-right" data-progress-bar="true"
			data-icon-class="toast-just-text toast-info" href="javascript:void(0)"
			role="button" style="display: none;">Progress Bar</a>
		</form>
	</div>

	<!-- Modal -->
	<div class="modal fade modal-rotate-from-left modal-warning" id="viewbiodata" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Bio-Data</h4>
				</div>
				<div class="modal-body">
					<div class="row row-lg">
						<div class="col-md-12" style="display: none;" id="bioedited">
							<div class="col-md-12">
								<div class="alert alert-success alert-dismissible">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Success! </strong> Record Updated.
								</div>
							</div>
						</div>
						<div class="col-md-12" style="display: none;" id="bioeditederr">
							<div class="col-md-12">
								<div class="alert alert-danger alert-dismissible">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Failed! </strong> Record was not updated. Please try again.
								</div>
							</div>
						</div>
						<input type="hidden" name="_edit_bio_csrf" id="_edit_bio_csrf" value="{{csrf_token()}}">
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group form-material floating" data-plugin="formMaterial">
									<select class="form-control" id="edit_title" name="edit_title">
										<option value="1">Mr.</option>
										<option value="2">Mrs.</option>
										<option value="3">Miss.</option>
									</select>
									<label class="floating-label">Title</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-material floating" data-plugin="formMaterial">
									<select class="form-control" id="edit_sex" name="edit_sex">
										<option value="M" @if($bios->sex == "M") selected @endif>Male</option>
										<option value="F" @if($bios->sex == "F") selected @endif>Female</option>
									</select>
									<label class="floating-label">Sex</label>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group form-material floating" data-plugin="formMaterial">
									<input type="text" class="form-control" name="edit_dob" id="edit_dob" required="required" data-plugin="datepicker" data-date-format="yyyy-mm-dd" value="{{$bios->dob}}">
									<label class="floating-label">Date of Birth</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-material floating" data-plugin="formMaterial">
									<input type="text" class="form-control" name="edit_phone" id="edit_phone" required="required" value="{{$bios->phone_num}}">
									<label class="floating-label">Phone Number*</label>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
									<div class="radio-custom radio-default radio-inline">
										@if($bios->marital_status == "single")
										<input type="radio" id="edit_single" name="edit_m_status" value="single" checked="checked">
										@else
										<input type="radio" id="edit_single" name="edit_m_status" value="single">
										@endif
										<label for="single">Single</label>
									</div>
									<div class="radio-custom radio-default radio-inline">
										@if($bios->marital_status == "married")
										<input type="radio" id="edit_married" name="edit_m_status" value="married" checked="checked">
										@else
										<input type="radio" id="edit_married" name="edit_m_status" value="married">
										@endif
										<label for="married">Married</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">State of Origin*</label>
									<select class="form-control" data-plugin="select2" data-allow-clear="true" id="edit_origin" name="edit_origin">
										@foreach($states as $state)
										@if($bios->state_origin_id == $state->id)
										<option selected="selected" value="{{$state->id}}">{{$state->state}}</option>
										@else
										<option value="{{$state->id}}">{{$state->state}}</option>
										@endif
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-material floating" data-plugin="formMaterial">
									<input type="text" class="form-control" name="edit_lga" id="edit_lga" value="{{$bios->lga}}">
									<label class="floating-label">Local Government Area*</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="icon wb-close"></i> Close</button>
					<button type="button" class="btn btn-success" id="editbiobtn" onclick="updateBio();"><i class="icon wb-check-circle"></i> Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal -->

	<script type="text/javascript">

		/*$("#app_sex").on('change', function(){
			var sexContent = $(this).val();
			if(sexContent == 'F' && $('input[name=m_status]:checked').val() == 'married')
			{
				$("#maidenBar").slideDown("slow");
			}
			else
			{
				$("#maidenBar").slideUp("fast");
			}
		});*/

		$("#dob").on('keyup', function(){
			var dobContent = $(this).val();
			if(!dobContent || dobContent == '' || containsAlpha(dobContent))
			{
				$("#doberr").html("Date of Birth is required and cannot contain alphabets").fadeIn("slow");
				$("#submitBio").attr('disabled', 'disabled');
				return false;
			}
			else
			{
				$("#doberr").html("").fadeOut("fast");
				$("submitBio").removeAttr('disabled');
				return true;
			}
		});

		$("#phone").on('keyup', function(){
			var phoneContent = $(this).val();
			if(!phoneContent || phoneContent == '' || containsAlpha(phoneContent))
			{
				$("#phonerr").html("Phone number is required and cannot contain alphabets").fadeIn("slow");
				$("#submitBio").attr('disabled', 'disabled');
				return false;
			}
			else
			{
				$("#phonerr").html("").fadeOut("fast");
				$("#submitBio").removeAttr('disabled');
				return true;
			}
		});

		$("#app_lga").on('keyup', function(){
			var lgaContent = $(this).val();
			if(!lgaContent || lgaContent == '')
			{
				$("#lgaerr").html("Local Government Area is required and cannot be empty").fadeIn("slow");
				$("#submitBio").attr('disabled', 'disabled');
				return false;
			}
			else
			{
				$("#lgaerr").html("").fadeOut("fast");
				$("#submitBio").removeAttr('disabled');
				return true;
			}
		});

		$("#submitBio").click(function(e){
			e.preventDefault();
			var maiden;
			var sex 		= $("#app_sex").val();
			var mstatus 	= $('input[name=m_status]:checked').val();
			if(sex == 'F' && mstatus == 'married')
			{
				maiden = $("#maiden").val();
			}
			else
			{
				maiden = "NOT APPLICABLE";
			}
			var dob 		= $("#dob").val();
			var phone 		= $("#phone").val();
			var origin 		= $("#app_origin").val();
			var lga 		= $("#app_lga").val();
			var token 		= $("#_bio_csrf").val();

			var formData = {
				'sex':sex, 
				'marital_status':mstatus, 
				'maiden_name':maiden, 
				'date_of_birth':dob, 
				'phone_number':phone, 
				'state_of_origin':origin, 
				'local_government_area':lga, 
				'_token':token,
				'type':2,
				'opcode':1
			};

			console.log(formData);

			$.post('/job', formData, function(data,xhr,status){
				if(data == 1)
				{
					//$("#bioribbon").fadeIn("slow");
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
					toastr["success"]("Record Saved.", "Success", toastr.options);

					$("#biolink").removeClass("text-danger").addClass("text-primary");
					$("#corrlink").removeClass("text-danger").addClass("text-primary");
					location.reload();
				}
				else
				{
					var response = "";
					if(data.maiden_name)
					{
						if(data.maiden_name.length == 1)
						{
							response = "<p>"+data.maiden_name+"</p>";
							$("#maidennotify").removeAttr('data-message').attr('data-message', response).click();
						}
						else
						{
							for(var i = 0; i < data.maiden_name.length; i++)
							{
								response += "<p>"+data.maiden_name[i]+"</p>";
								$("#maidennotify").attr('data-message', response).click();
							}
						}
					}
					if(data.date_of_birth)
					{
						if(data.date_of_birth.length == 1)
						{
							response = "<p>"+data.date_of_birth+"</p>";
						}
						else
						{
							for(var i = 0; i < data.date_of_birth.length; i++)
							{
								response += "<p>"+data.date_of_birth[i]+"</p>";
							}
						}
						swal({
							title: "Warning!",
							text: "" + response,
							html: true
						});
					}
					if(data.phone_number)
					{
						if(data.phone_number.length == 1)
						{
							response = "<p>"+data.phone_number+"</p>";
						}
						else
						{
							for(var i = 0; i < data.phone_number.length; i++)
							{
								response += "<p>"+data.phone_number[i]+"</p>";
							}
						}
						swal({
							title: "Warning!",
							text: "" + response,
							html: true
						});
					}
					if(data.state_of_origin)
					{
						if(data.state_of_origin.length == 1)
						{
							response = "<p>"+data.state_of_origin+"</p>";
						}
						else
						{
							for(var i = 0; i < data.state_of_origin.length; i++)
							{
								response += "<p>"+data.state_of_origin[i]+"</p>";
							}
						}
						swal({
							title: "Warning!",
							text: "" + response,
							html: true
						});
					}
					if(data.local_government_area)
					{
						if(data.local_government_area.length == 1)
						{
							response = "<p>"+data.local_government_area+"</p>";
						}
						else
						{
							for(var i = 0; i < data.local_government_area.length; i++)
							{
								response += "<p>"+data.local_government_area[i]+"</p>";
							}
						}
						swal({
							title: "Warning!",
							text: "" + response,
							html: true
						});
					}

				}
			});

		});

		function updateBio()
		{
			console.log("Trying to update");
			var sex 		= $("#edit_sex").val();
			var mstatus 	= $('input[name=edit_m_status]:checked').val();
			var dob 		= $("#edit_dob").val();
			var phone 		= $("#edit_phone").val();
			var origin 		= $("#edit_origin").val();
			var lga 		= $("#edit_lga").val();
			var token 		= $("#_edit_bio_csrf").val();

			var formData = {
				'sex':sex, 
				'marital_status':mstatus,
				'date_of_birth':dob, 
				'phone_number':phone, 
				'state_of_origin':origin, 
				'local_government_area':lga, 
				'_token':token,
				'type':2,
				'opcode':2
			};

			console.log(formData);

			$.post('/job', formData, function(data,xhr,status){
				console.log(data);
				if(data == 1)
				{
					$("#bioedited").fadeIn("slow");
				}
				else
				{
					$("#bioeditederr").fadeIn("slow");
				}
			});
		}

		//$('input[name=paystatus]:checked').val();

		function containNums(sample)
		{
			var Numbers = /[0-9]/;
			return Numbers.test(sample);
		}
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
		function maidenCheck(state)
		{
			var sex = $("#app_sex").val();
			if(sex == 'F' && state == 0)
			{
				//$("#maidenBar").slideDown("slow");
			}
			else
			{
				//$("#maidenBar").slideUp("fast");
			}
		}
	</script>

	<!--<script type="text/javascript">
		$(function(){
			Dropzone.autoDiscover = false;
			var myDropzone = new Dropzone("#my-dropzone", {
				url:'/abreqemp',
				autoProcessQueue:false,
				acceptedFiles:'image/png, image/jpeg, image/jpg',
				uploadMultiple:false,
				maxFiles:1,
				dictDefaultMessage:"Passport Photograph",
				addRemoveLinks:'dictCancelUpload',
				parallelUploads:1,
				dictInvalidFileType:"Supported File Types: .png, .jpeg, .jpg",
				maxFilesize:0.0642,
				dictFileTooBig: 'Warning: File cannot be larger than 62kb'

			});
			myDropzone.on("sending", function(file,xhr,formData) {
				formData.append('_token',     $("#requesttoken").val());
				formData.append('startdate',  $("#start_date").val());
				formData.append('enddate',    $("#end_date").val());
				formData.append('pay',      $('input[name=paystatus]:checked').val());
				formData.append('priority',   $("#priority").val());
				formData.append('type',     $("#abtype").val());
				formData.append('reason',     $("#reason").val());
				formData.append('total',    $("#totalreq").val());
			});
			myDropzone.on("success", function(file,response) {
				console.log(response);
				if(response == 0)
				{
					$("#exampleCloseButton").click();
					$("#formdata").html("<h3><i class='icon wb-close'></i></h3><h3>You have exhausted your leave credit. You can only apply for a leave without pay or modify current pending requests.</h3>").addClass("text-danger").fadeIn("slow");
				}
				else
				{
					if(!response.id && response != 0)
					{
						$("#formdata").html("<h3><i class='icon wb-close'></i></h3><h3>Request was not submitted. Plese refresh your browser and try again.</h3>").addClass("text-danger").fadeIn("slow");
					}
					else
					{
						$("#exampleCloseButton2").click();
						$("#formdata")
						.html("<h3><i class='icon wb-check-circle'></i></h3><h3>Request Submitted. You Will Be Notified Once Your Request is Approved.</h3>")
						.removeClass("text-danger").addClass("text-success text-center").fadeIn("slow");
						location.reload();
					}
				}
			});
			myDropzone.on("error", function(file,response) {
                  //swal('error',response,'error');
                  console.log(response);
                  $("#formdata").html("<h3><i class='icon wb-close'></i></h3><h3>Unfortunately! We experienced a difficulty in saving your current request. Please refresh your browser and try again.</h3>").addClass("text-danger").fadeIn("slow");
                  myDropzone.removeFile(file);
              });

			myDropzone.on("complete", function(file) {
				myDropzone.removeFile(file);
			});
		});
	</script>-->
</div>