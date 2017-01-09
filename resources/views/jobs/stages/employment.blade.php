<div style="display: none;" id="employmentContainer">
	@if(count($emps) > 0)
	<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="empribbon">
		@else
		<div class="ribbon ribbon-clip ribbon-reverse ribbon-success" id="empribbon" style="display: none;">
			@endif
			<span class="ribbon-inner" data-toggle="modal" data-target="#viewemploymentrecords" title="View">
				View Records
			</span>
		</div>
		<br>
		<div id="employement">
			<h4>Employment History</h4> <small>you scan skip this page if you don't have any employement history</small>
			<button type="button" class="btn btn-floating btn-sm btn-success pull-right" data-toggle="tooltip" data-placement="top" title="Add More." id="addmoreEmp">
				<i class="icon wb-loop"></i>
			</button>
			<br>
			<form autocomplete="off">
				<input type="hidden" name="_emp_token" id="_emp_token" value="{{csrf_token()}}">
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<input type="text" class="form-control" name="orgname" id="orgname" autofocus="autofocus">
					<label class="floating-label">Name of Organisation</label>
					<label class="text-danger" id="org_name_err"></label>
				</div>
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<input type="text" class="form-control" name="position" id="position">
					<label class="floating-label">Position Held*</label>
					<label class="text-danger" id="position_err"></label>
				</div>
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<input type="text" class="form-control" name="dateemp" id="dateemp" data-plugin="datepicker" data-date-format="yyyy-mm-dd" required="required">
					<label class="floating-label">Date Employed</label>
					<label class="text-danger" id="date_emp_err"></label>
				</div>
				<div class="form-group form-material floating" data-plugin="formMaterial">
					<input type="text" class="form-control" name="dateemptill" id="dateemptill" data-plugin="datepicker" data-date-format="yyyy-mm-dd" required="required">
					<label class="floating-label">Till</label>
					<label class="text-danger" id="date_till_err"></label>
				</div>
				<button type="submit" class="btn btn-icon btn-raised btn-success" id="submitEmp" disabled="disabled"><i class="icon wb-plus"></i> Continue</button>
			</form>
		</div>
		<!-- Modal -->
		<div class="modal fade modal-rotate-from-left modal-warning" id="viewemploymentrecords" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title">Employment History</h4>
					</div>
					<div class="modal-body">
						@if(count($emps) > 0)
						<div class="panel-group" id="employementaccordion" aria-multiselectable="true" role="tablist">
							@foreach($emps as $emp)
							<div class="panel">
								<div class="panel-heading" id="$empD{{$emp->id}}" role="tab">
									<a class="panel-title" data-toggle="collapse" href="#empDataLnk{{$emp->id}}" data-parent="#employementaccordion" aria-expanded="false" aria-controls="empDataLnk{$emp->id}}">
										{{ $emp->organization }}
									</a>
								</div>
							</div>
							<div class="panel-collapse collapse" id="empDataLnk{{$emp->id}}" aria-labelledby="empD{{$emp->id}}" role="tabpanel">
								<div class="panel-body">
									<div class="row row-lg">
										<div class="col-md-12" style="display: none;" id="empedited{{$emp->id}}">
											<div class="col-md-12">
												<div class="alert alert-success alert-dismissible">
													<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													<strong>Success! </strong> Record Updated.
												</div>
											</div>
										</div>
										<div class="col-md-12" style="display: none;" id="empeditederr{{$emp->id}}">
											<div class="col-md-12">
												<div class="alert alert-danger alert-dismissible">
													<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													<strong>Failed! </strong> Record was not updated. Please try again.
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-material floating" data-plugin="formMaterial">
												<input type="text" class="form-control" name="edit_orgname{{$emp->id}}" id="edit_orgname{{$emp->id}}" value="{{$emp->organization}}">
												<label class="floating-label">Name of Organisation</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-material floating" data-plugin="formMaterial">
												<input type="text" class="form-control" name="edit_position" id="edit_position{{$emp->id}}" value="{{$emp->position}}">
												<label class="floating-label">Position Held</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-material floating" data-plugin="formMaterial">
												<input type="text" class="form-control" name="edit_dateemp" id="edit_dateemp{{$emp->id}}" data-plugin="datepicker" data-date-format="yyyy-mm-dd" value="{{$emp->start_date}}">
												<label class="floating-label">Date Employed</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-material floating" data-plugin="formMaterial">
												<input type="text" class="form-control" name="edit_dateemptill" id="edit_dateemptill{{$emp->id}}" data-plugin="datepicker" data-date-format="yyyy-mm-dd" value="{{$emp->end_date}}">
												<label class="floating-label">Till</label>
											</div>
										</div>
										<div class="col-md-12">
											<button type="button" class="btn btn-success" onclick="updateEmp({{$emp->id}})"><i class="icon wb-check-circle"></i> Save changes</button>
											<button type="button" class="btn btn-danger" onclick="deleteEmp({{$emp->id}})"><i class="icon ion-ios-trash"></i> Delete</button>
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
		function showHelp(id)
		{
			if(id == 1)
			{
				swal("Help", "If you are still at your place of employement, kindly select todays date");
			}
		}

		function isValidDate(dateString) {
			var regEx = /^\d{4}-\d{2}-\d{2}$/;
			return dateString.match(regEx) != null;
		}

		$("#addmoreEmp").click(function(e){
			e.preventDefault();
			$("#orgname").val("");
			$("#position").val("");
			$("#dateemp").val("");
			$("#dateemptill").val("");
		});

		$("#orgname").on("keyup", function(){
			var orgname = $(this).val();
			if(!orgname || orgname.length <= 3 || orgname == '')
			{
				$("#org_name_err").html("Please enter a valida organization name").fadeIn("slow");
				$("#submitEmp").attr('disabled', 'disabled');
				return false;
			}
			else
			{
				$("#org_name_err").html("").fadeOut("fast");
				$("#submitEmp").removeAttr('disabled');
				return true;
			}
		});

		$("#position").on("keyup", function(){
			var position = $(this).val();
			if(!position || position.length <= 5 || position == '')
			{
				$("#position_err").html("Please enter your position at the organization").fadeIn("slow");
				$("#submitEmp").attr('disabled', 'disabled');
				return false;
			}
			else
			{
				$("#position_err").html("").fadeOut("fast");
				$("#submitEmp").removeAttr('disabled');
				return true;
			}
		});

		$("#submitEmp").click(function(e){
			e.preventDefault();
			var orgname = $("#orgname").val();
			var position = $("#position").val();
			var dateemp = $("#dateemp").val();
			var datetill = $("#dateemptill").val();
			var token = $("#_emp_token").val();

			var formData = {'orgname':orgname, 'position':position, 'dateemp':dateemp, 'datetill':datetill, '_token':token, 'type':6, 'opcode':1};
			console.log(formData);

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
					toastr["success"]("Employement Information saved.", "Success", toastr.options);
					$("#emplink").removeClass("text-danger").addClass("text-primary");
					$("#proflink").removeClass("text-danger").addClass("text-primary");
					location.reload();
					//$("#empribbon").fadeIn("slow");
				}
				else
				{
					if(data.organization)
					{
						var response;
						if(data.organization.length == 1)
						{
							response = "<p>"+data.organization+"</p>";
						}
						else
						{
							for(var i = 0; i < data.organization.length; i++)
							{
								response += "<p>"+data.organization[i]+"</p>";
							}
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
					if(data.position)
					{
						var response;
						if(data.position.length == 1)
						{
							response = "<p>"+data.position+"</p>";
						}
						else
						{
							for(var i = 0; i < data.position.length; i++)
							{
								response += "<p>"+data.position[i]+"</p>";
							}
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
					if(data.start_date)
					{
						var response;
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
					if(data.end_date)
					{
						var response;
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
				}
			});
});

function  updateEmp(id)
{
	var orgname = $("#edit_orgname"+id).val();
	var position = $("#edit_position"+id).val();
	var dateemp = $("#edit_dateemp"+id).val();
	var datetill = $("#edit_dateemptill"+id).val();
	var token = $("#_emp_token").val();

	var formData = {'orgname':orgname, 'position':position, 'dateemp':dateemp, 'datetill':datetill, '_token':token, 'type':6, 'opcode':2, 'id':id};
	$.post('/job', formData, function(data,xhr,status){
		if(data == 1)
		{
			$("#empedited"+id).fadeIn("slow");
			$("#empeditederr"+id).fadeOut("fast");
		}
		else
		{
			$("#empedited"+id).fadeOut("fast");
			$("#empeditederr"+id).fadeIn("slow");
		}
	});
}

function deleteEmp(id)
{
	var token = $("#_emp_token").val();
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
			var formData = {'_token':token, '_method': 'DELETE', 'type': 6};
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

$("#addmoreEmp").click(function(){
	$("#orgname").val("");
	$("#position").val("");
	$("#dateemp").val("");
	$("#dateemptill").val("");
});
</script>