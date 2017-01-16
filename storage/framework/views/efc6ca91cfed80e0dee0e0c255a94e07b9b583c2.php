<script>
$(function(){
	$("#saverep").click(function(){
		
		attendancereport=$('#attrep').val();
		
	$.get('<?php echo e(url('notification')); ?>',{
		
		attendance:attendancereport
		
	},function(data,status,xhr){
		
		if(xhr.status==200){
			
			toastr.success(data);
		}
		else{
			toastr.error(data);
		}
		
	});	
		
	});
});

</script>

<div class="modal fade modal-danger modal-rotate-from-left" id="notification" aria-labelledby="exampleModalTitle" role="dialog"   style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content" style="z-index:99999999">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Manage Nofifications</h4>
                        </div>
                        <div class="modal-body">
						<div class="col-md-12">
						<div class="col-md-5">
						<b class="font-weight:bold">Send Attendance Report:</b>
						</div>
						<div class="col-md-6">
						<select data-plugin="select2" id="attrep">
						
						<option >--Select Action--</option>
						<option value="1">Daily</option>
						<option value="2">Weekly</option>
						<option value="3">Monthly</option>
						
						
						</select>
						</div>
						<div class="col-md-1">
						<button type="button" id="saverep" class="btn btn-primary btn-sm">Save</button>
						</div>
						</div>
							 
				       
					   </div>
                        <div class="modal-footer">
                          
                        </div>
                      </div>
                    </div>
                  </div>
