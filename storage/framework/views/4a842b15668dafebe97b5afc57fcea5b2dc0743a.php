<div style="display: none;" id="additionalContainer">
	<div class="ribbon ribbon-clip ribbon-reverse ribbon-success">
		<span class="ribbon-inner" data-toggle="modal" data-target="#additionalrecords" title="View">
			View Records
		</span>
	</div>
	<br>
	<div id="additional">
		<h4>Additional Information</h4>
		<br>
		<form autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" name="_info_csrf" id="_info_csrf" value="<?php echo e(csrf_token()); ?>">
			<div class="row row-lg">
				<div class="col-md-12">
					<div class="col-md-3">
						<select class="form-control" required="required" data-plugin="select2" data-allow-clear="true" id="addinfocat">
							<?php if(count($gradeDocs) > 0): ?>
							<?php $__currentLoopData = $gradeDocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<option value="<?php echo e($grade->id); ?>"><?php echo e($grade->docname); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							<?php endif; ?>
						</select>
						<br>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">Upload File</label>
							<div  class="dropzone" id="otherinfo" name="otherinfo">

							</div>
						</div>
						<button type="submit" class="btn btn-icon btn-raised btn-success" id="uploaddocs"><i class="icon wb-plus"></i> Continue</button>
					</div>
				</div>
			</div>
		</form>
	</div>

	<br>

	<div class="row row-lg">
		<div class="col-md-12">
			<div id="uploadedData" class="panel m-b-0">
				<div class="panel-heading">
					<h3 class="panel-title">Documents</h3>
					<div class="panel-actions">
						<div class="dropdown">
							<a class="panel-action" data-toggle="dropdown" href="#" aria-expanded="false"><i class="icon wb-settings" aria-hidden="true"></i></a>
							</div>
							<a class="panel-action icon wb-refresh" data-load-type="round-circle" aria-hidden="true" id="refresh-img" onclick="getUploadedFiles()"></a>
							<a class="panel-action icon wb-minus" aria-expanded="true" data-toggle="panel-collapse" aria-hidden="true"></a>
							<a class="panel-action icon wb-expand" data-toggle="panel-fullscreen" aria-hidden="true"></a>
						</div>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-stripped table-hover" id="docsTable">
								<thead class="thead-default">
									<tr>
										<th>File</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody id="docsTableBody">
									<tr>
										<?php if(count($adds) > 0): ?>
										<?php $__currentLoopData = $adds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addFile): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<tr>
											<th>
												<?php $docCat = app('app\Repositories\JobRepository')->getDocumentTypes($addFile->id); ?>
												<?php echo e($docCat['docname']); ?>

											</th>
											<th>
												<a class="text-danger" href="javascript:void(0)" id="useraddFile<?php echo e($addFile->id); ?>" data-toggle="tooltip" title="Delete" onclick="deleteDoc(<?php echo e($addFile->id); ?>)" style="text-decoration:none;">
													<i class="icon wb-close"></i>
												</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<a class="text-primary" href="<?php echo e(asset('upload')); ?>/<?php echo e($addFile->document); ?>" target="_blank" id="useraddFile<?php echo e($addFile->id); ?>" data-toggle="tooltip" title="View" style="text-decoration:none;">
													<i class="icon wb-eye"></i>
												</a>
											</th>
										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										<?php else: ?>
										<h4 class="text-center">Any File You Upload Will Be Displayed Here.</h4>
										<?php endif; ?>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function getUploadedFiles()
		{
			var tr;
			var docTypes = [];
			var pass = $("#_info_csrf").val();
			var formData = {'_token':pass};

			$.get('/job/docType', formData, function(data,xhr,status){
				console.log(data);
				for(var index = 0; index < data.length; index++)
				{
					docTypes[index+1] = data[index].docname;
				}
			});

			$.get('/job/get-images', formData, function(data,xhr,status){
				console.log(data);
				$("#docsTableBody").html("");
				if(!data || data.length <= 0)
				{
					tr = "<tr><th colspan='2'>No Files Uploaded Yet.</th></tr>";
				}
				else
				{
					$.each(data, function(i, item){
						var typeName = docTypes[item.type_id];
						tr += '<tr>' 
						+ '<th>'+typeName+'</th>'
						+ '<th>'
						+ '<a class="text-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="deleteDoc('+item.id+')"><i class="icon wb-close"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
						+ '<a class="text-primary" href="../../upload/'+item.document+'" target="_blank" data-toggle="tooltip" title="View"><i class="icon wb-eye"></i></a>'
						+ '</th>'
						'</tr>';
					});
					$('[data-toggle="tooltip"]').tooltip();
				}
				$("#docsTableBody").append(tr);
			});
		}

		function deleteDoc(id)
		{
			swal({
				title: "Are you sure?",
				text: "You will not be able to recover this file  after you have deleted it?",
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
					var pass = $("#_info_csrf").val();
					var formData = {'_token':pass, 'id':id, '_method':'DELETE', 'type':11};
					$.post('/job/'+id, formData, function(data,xhr,status){
						if(data == 1)
						{
							swal("Deleted!", "Your file has been deleted.", "success");
							$("#refresh-img").click();
						}
					});
				} else {
					swal("Cancelled", "Operation cancelled");
				}
			});
		}
	</script>


	<script type="text/javascript">
		$(function(){
			Dropzone.autoDiscover = false;

			var docDropZone = new Dropzone("#otherinfo", {
				url:'/job',
				autoProcessQueue:false,
				acceptedFiles:'image/png,image/jpeg,image/jpg,application/pdf',
				uploadMultiple:false,
				maxFiles:1,
				dictDefaultMessage:"Drag or click here to upload certificate.",
				addRemoveLinks:'dictCancelUpload',
				parallelUploads:1,
				dictInvalidFileType:"You can only upload an image or PDF document",
				maxFilesize:0.0642,
				dictFileTooBig: 'Warning: Document is Larger than 62kb'
			});

			docDropZone.on("sending", function(file,xhr,formData) {
				formData.append('_token', $("#_info_csrf").val());

				formData.append('doctype', $("#addinfocat").val());

				formData.append('type', 12);
			});

			docDropZone.on("success", function(file,response) {
				console.log(response);
				console.log("Request successful");
				if(response == "nofile")
				{
					swal("Warning!", "No file was uploaded. Please select a file and try again", "warning");
				}
				else if(response == "invalid")
				{
					var response = "Your file was not properly uploaded. Here are few things you can try:";
					response += "<ul>";
					response += "<li>Make sure your computer is connected to the internet</li>";
					response += "<li>If you have been on this page for 5 minutes or more, its a good idea to reload this page and try again.</li>";
					response += "<li>Clean your cache to make sure you are not trying to access an expired page.</li>";
					response += "</ul>";
					swal({
						title: "Failed!",
						text: "" + response,
						html: true
					});
				}
				else
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
					toastr["success"]("New Document Upload Successfull.", "Success", toastr.options);
					$("#addlink").removeClass("text-danger").addClass("text-primary");
					$("#refresh-img").click();
				}
			});

			docDropZone.on("error", function(file,response) {
				console.log("Error occured");
				swal("Failed!", "Unfortunately an error occured while you were trying to upload your file. Please refresh your browser and try again.", "warning");
				docDropZone.removeFile(file);
			});

			docDropZone.on("complete", function(file) {
				docDropZone.removeFile(file);
			});

			$("#uploaddocs").click(function(e){
				e.preventDefault();
				docDropZone.processQueue();

			});
		});
	</script>