$(function(){
	Dropzone.autoDiscover = false;
	var myDropzone = new Dropzone("#my-dropzone", {
		url:'/abreqemp',
		autoProcessQueue:false,
		acceptedFiles:'image/png, image/jpeg, image/jpg, .pdf, .docx, .doc',
		uploadMultiple:false,
		maxFiles:1,
		dictDefaultMessage:"Supporting Documents",
		addRemoveLinks:'dictCancelUpload',
		parallelUploads:1,
		dictInvalidFileType:"Supported File Types: .png,.jpeg, .jpg, .pdf, .docx,.doc",
		maxFilesize:0.0642,
		dictFileTooBig: 'Warning: File cannot be larger than 62kb'

	});
	myDropzone.on("sending", function(file,xhr,formData) {
		formData.append('_token', 		$("#requesttoken").val());
		formData.append('startdate', 	$("#start_date").val());
		formData.append('enddate', 		$("#end_date").val());
		formData.append('pay', 			$('input[name=paystatus]:checked').val());
		formData.append('priority', 	$("#priority").val());
		formData.append('type', 		$("#abtype").val());
		formData.append('reason', 		$("#reason").val());
		formData.append('total', 		$("#totalreq").val());
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
		console.log(response);
		$("#formdata").html("<h3><i class='icon wb-close'></i></h3><h3>Unfortunately! We experienced a difficulty in saving your current request. Please refresh your browser and try again.</h3>").addClass("text-danger").fadeIn("slow");
		myDropzone.removeFile(file);
	});

	myDropzone.on("complete", function(file) {
		myDropzone.removeFile(file);
	});

	$("#submitrequest").click(function(){
		var startdate 	= $("#start_date").val();
		var enddate 	= $("#end_date").val();
		var paystat 	= $('input[name=paystatus]:checked').val();
		var priority 	= $("#priority").val();
		var type 		= $("#abtype").val();
		var reason 		= $("#reason").val();
		var file 		= $('#input-file-disable-remove').prop('files');
		var token 		= $("#requesttoken").val();

		if(!startdate || startdate == '')
		{
			$("#starterror").text("Please select a start date.").fadeIn("slow");
		}
		else
		{
			$("#starterror").text("Please select a start date.").fadeOut("slow");	
		}
		if(!enddate || enddate == '')
		{
			$("#enderror").text("Please select a valid end date").fadeIn("slow");
		}
		else
		{
			$("#enderror").text("Please select a valid end date").fadeOut("slow");	
		}
		if(!priority || priority == '')
		{
			$("#priorityerror").text("Please select a valid priority").fadeIn("slow");
		}
		else
		{
			$("#priorityerror").text("Please select a valid priority").fadeOut("slow");
		}
		if(!type || type == '')
		{
			$("#aberror").text("Please select a valid absence type").fadeIn("slow");
		}
		else
		{
			$("#aberror").text("Please select a valid absence type").fadeOut("slow");
		}
		if(!reason || reason == '')
		{
			$("#reasonerror").text("Enter a valid reason").fadeIn("slow");
		}
		else
		{
			$("#reasonerror").text("Enter a valid reason").fadeOut("slow");	
		}
		myDropzone.processQueue();
	});
});



function modifyRequest(id, operation)
{
	var token 		= $("#_request_token").val();
	if(operation == 1)
	{
		//modify
		swal({
			title: "MODIFY?",
			text: "You are about to alter this request's date parameters!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, continue!",
			cancelButtonText: "No, cancel!",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm){
			if (isConfirm) {
				var startdate 	= $("#modstart"+id).val();
				var enddate 	= $("#modend"+id).val();

				var formData = {'startdate':startdate, 'enddate':enddate, 'id':id, '_token':token};
				$.get('/modifyRequest?type='+operation, formData, function(data,xhr,status){
					if(data==1)
					{
						swal("Modified!", "Changes Saved Successfully!", "success");
						location.reload();
					}
					else
					{
						swal("Failed!", "Something went wrong while trying to modify your request! Please refresh your browser and try again", "error");
					}
				});
			} else {
				swal("Cancelled", "The Operation Was Cancelled.", "warning");
			}
		});
	}
	else
	{
		//delete
		swal({
			title: "You are about to delete this leave request?",
			text: "This Operation Cannot Be Reversed!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel!",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm){
			if (isConfirm) {
				var formData = {'id':id, '_token':token};
				$.get('/modifyRequest?type='+operation, formData, function(data,xhr,status){
					if(data == 1)
					{
						swal("Deleted!", "Absence Request has been withdrawn.", "success");
						location.reload();
					}
					else
					{
						swal("Failed!", "Something went wrong while trying to delete your request! Please refresh your browser and try again.", "error");
					}
				});
			} else {
				swal("Cancelled", "The Operation Was Cancelled", "warning");
			}
		});
	}
}