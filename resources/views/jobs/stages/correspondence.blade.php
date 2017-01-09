<style type="text/css">
	.select2-dropdown {
		z-index: 9001;
	}
</style>
<div id="correspondenceContainer" style="display: none;">
	@if(count($corrs) > 0)
	<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="corrsribbon">
		@else
		<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="corrsribbon" style="display: none;">
			@endif
			<span class="ribbon-inner" data-toggle="modal" data-target="#viewcorrs" title="View">
				View Records
			</span>
		</div>
		<br>
		@if(count($corrs) > 0)
		<div id="correspondence">
			@else
			<div id="correspondence">
				@endif
				<h4>Correspondence</h4><span class="text-danger">Fields marked * are compulsory</span>
				<br>
				<form autocomplete="off">
					<input type="hidden" name="_corr_csrf" id="_corr_csrf" value="{{csrf_token()}}">
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="text" class="form-control" name="addr" id="addr" required="required" autofocus="autofocus">
						<label class="floating-label">Address*</label>
						<label class="text-danger" id="addrerr"></label>
					</div>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="text" class="form-control" name="city" id="city" required="required">
						<label class="floating-label">City*</label>
						<label class="text-danger" id="cityerr"></label>
					</div>
			<!--<div class="form-group form-material floating" data-plugin="formMaterial">
				<input type="text" class="form-control" name="postal" id="postal" required="required">
				<label class="floating-label">Postal Code*</label>
				<label class="text-danger" id="emailerr"></label>
			</div>-->
			<div class="form-group form-material floating" data-plugin="formMaterial">
				<select class="form-control" data-plugin="select2" data-allow-clear="true" id="corr_state">
					@foreach($states as $state)
					<option value="{{$state->id}}">{{$state->state}}</option>
					@endforeach
				</select>
				<label class="floating-label">State*</label>
			</div>
			@if(count($corrs) > 0)
			<button type="submit" class="btn btn-icon btn-raised btn-success" data-toggle="modal" data-target="#viewcorrs"><i class="icon wb-eye"></i> View</button>
			@else
			<button type="submit" class="btn btn-icon btn-raised btn-success" id="submitCorr" disabled="disabled"><i class="icon wb-plus"></i> Continue</button>
			@endif
		</form>
	</div>
</div>
<!-- Modal -->
<div class="modal fade modal-rotate-from-left modal-warning" id="viewcorrs" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">Correspondence</h4>
			</div>
			<div class="modal-body">
				<div class="row row-lg">
					@if(count($corrs) > 0)
					<div class="col-md-12" style="display: none;" id="corredited">
						<div class="col-md-12">
							<div class="alert alert-success alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong>Success! </strong> Record Updated.
							</div>
						</div>
					</div>
					<div class="col-md-12" style="display: none;" id="correditederr">
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
								<input type="text" class="form-control" name="edit_city" id="edit_city" value="{{$corrs->city}}">
								<label class="floating-label">City*</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">State*</label>
								<select class="form-control" data-plugin="select2" data-allow-clear="true" id="edit_corr_state">
									@foreach($states as $state)
									@if($corrs->state_id == $state->id)
									<option selected="selected" value="{{$state->id}}">{{$state->state}}</option>
									@else
									<option value="{{$state->id}}">{{$state->state}}</option>
									@endif
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-12">
							<div class="form-group form-material floating" data-plugin="formMaterial">
								<textarea class="form-control" rows="3" name="edit_addr" id="edit_addr">{{$corrs->street}}</textarea>
								<label class="floating-label">Address</label>
							</div>
						</div>
					</div>
					@else
					<div class="col-md-12">
						<div class="col-md-12">
							<h4>No record found!</h4>
						</div>
					</div>
					@endif
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="icon wb-close"></i> Close</button>
				<button type="button" class="btn btn-success" onclick="updateContact()"><i class="icon wb-check-circle"></i> Save changes</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->
<script type="text/javascript">
	$("#addr").on("keyup", function(){
		var address = $(this).val();
		if(!address || address == '')
		{
			$("#addrerr").html("Please enter a valid address").fadeIn("slow");
			$("#submitCorr").attr('disabled', 'disabled');
			return false;
		}
		else
		{
			$("#addrerr").html("").fadeOut("fast");
			$("#submitCorr").removeAttr("disabled");
			return true;
		}
	});

	$("#city").on("keyup", function(){
		var city = $(this).val();
		if(!city || city == '')
		{
			$("#cityerr").html("Please enter a valid city").fadeIn("slow");
			$("#submitCorr").attr("disabled", "disabled");
			return false;
		}
		else
		{
			$("#cityerr").html("").fadeOut("fast");
			$("#submitCorr").removeAttr("disabled");
			return true;
		}
	});

	$("#submitCorr").click(function(e){
		e.preventDefault();
		var response;
		var address = $("#addr").val();
		var city = $("#city").val();
		var state = $("#corr_state").val();
		var token = $("#_corr_csrf").val();

		var formData = {'address':address, 'city':city, 'state':state, 'type':3, 'opcode':1, '_token':token};

		$.post('/job', formData, function(data,xhr,status){
			console.log(data);
			if(data.id)
			{
				/*$("#accountContainer").hide();
				$("#biodataContainer").hide();
				$("#correspondenceContainer").hide();
				$("#educationContainer").fadeIn("slow");
				$("#employmentContainer").hide();
				$("#professionalContainer").hide();
				$("#skillsContainer").hide();
				$("#referencesContainer").hide();
				$("#additionalContainer").hide();
				$("#previewContainer").hide();*/
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
				//$("#corrsribbon").fadeIn("slow");
				$("#edlink").removeClass("text-danger").addClass("text-primary");
				location.reload();
			}
			else
			{
				if(data.street)
				{
					if(data.street.length == 1)
					{
						response = "<p>"+data.street+"</p>";
					}
					else
					{
						for(var i = 0; i < data.street.length; i++)
						{
							response += "<p>"+data.street[i]+"</p>";
						}
					}
					swal({
						title: "Warning!",
						text: "" + response,
						html: true
					});
				}

				if(data.city)
				{
					if(data.city.length == 1)
					{
						response = "<p>"+data.city+"</p>";
					}
					else
					{
						for(var i = 0; i < data.city.length; i++)
						{
							response += "<p>"+data.city[i]+"</p>";
						}
					}
					swal({
						title: "Warning!",
						text: "" + response,
						html: true
					});
				}

				if(!data.street && !data.city)
				{
					response = "<p>Something just got broken unexpectedly. Please refresh your browser to continue your registration.</p>";
					swal({
						title: "Warning!",
						text: "" + response,
						html: true
					});
				}
			}
		});

	});

	function updateContact()
	{
		var address = $("#edit_addr").val();
		var city = $("#edit_city").val();
		var state = $("#edit_corr_state").val();
		var token = $("#_corr_csrf").val();

		var formData = {'address':address, 'city':city, 'state':state, 'type':3, 'opcode':2, '_token':token};

		$.post('/job', formData, function(data,xhr,status){
			console.log(data);
			if(data == 1)
			{
				$("#corredited").fadeIn("slow");
			}
			else
			{
				$("#correditederr").fadeIn("slow");
			}
		});
	}
</script>