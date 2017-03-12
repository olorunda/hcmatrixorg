 	
	<script>
	function editproject(id,name,code,start_date,end_est_date,remark){
		
		 $('#pname').val(name);
		 $('#projectcode').val(code);
		 $('#start_date').val(start_date);
		 $('#end_est_date').val(end_est_date);
		 $('#remark').val(remark);
		 
					$('.assigned_to_id').hide();
					
					$('.client_name').hide();
		// alert(remark);
		 sessionStorage.setItem('projid',id);
		$('#addpjbtn').text('Update Project');
		sessionStorage.setItem('setprojtype',1);
	}
	function updateproject(){
		
			$pname=$('#pname').val();
					$pcode=$('#projectcode').val();
					$startdate=$('#start_date').val();
					$estendingdate=$('#end_est_date').val();
					$clientname=$('#client_name').val();
					$remark=$('#remark').val();
					$projectmanager=$('#assigned_to_id').val();
					$projectid=sessionStorage.getItem('projid');
					
				$.get('<?php echo e(url('project')); ?>/'+$projectid+'/edit',{
					
					pname:$pname,
					pcode:$pcode,
					startdate:$startdate,
					estendingdate:$estendingdate,
					//clientname:$clientname,
					remark:$remark,
					//projectmanager:$projectmanager,
					projectid:$projectid
					
				},function (data,status,xhr){
					
					if(xhr.status==200){
						toastr.success("<?php echo e(_t('Successfully Updated Project and all project managers notified')); ?>");
						setTimeout(function(){
						window.location.reload();
						},2000);
						return ;
					}
					toastr.error("<?php echo e(_t('Some error occurred')); ?>");
					
				});
		
	}
function deleteproject(id){
		
		swal({
  title: "<?php echo e(_t('Are you sure?')); ?>",
  text: "<?php echo e(_t('You will not be able to recover deleted Projects!')); ?>",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "<?php echo e(_t('Yes, delete it!')); ?>",
  closeOnConfirm: false
},
function(){
	//extend jquery fro put and delete

//extend jquery fro put and delete

		$.delete('<?php echo e(url('project')); ?>/'+id,{
			
			project:'project'
			
		},function(data,status,xhr){
			
			if(xhr.status==200){
				
				toastr.success("<?php echo e(_t('Project Successfully Deleted')); ?>");
				swal("<?php echo e(_t('Deleted!')); ?>", "<?php echo e(_t('Project deleted Successfully.')); ?>", "success");
				setTimeout(function(){
					
					window.location.reload();
					
				},2000);
				return ;
			}
			toastr.error("<?php echo e(_t('Some Error Occurred')); ?>");
			
		});
		
		
});
		
	}
	
	function createproject(){
		
			
					$pname=$('#pname').val();
					$pcode=$('#projectcode').val();
					$startdate=$('#start_date').val();
					$estendingdate=$('#end_est_date').val();
					$clientname=$('#client_name').val();
					$remark=$('#remark').val();
					$projectmanager=$('#assigned_to_id').val();
					
				$.get('<?php echo e(url('project')); ?>/create',{
					
					pname:$pname,
					pcode:$pcode,
					startdate:$startdate,
					estendingdate:$estendingdate,
					clientname:$clientname,
					remark:$remark,
					projectmanager:$projectmanager
					
				},function (data,status,xhr){
					
					if(xhr.status==200){
						toastr.success("<?php echo e(_t('Successfully Added Project and all project managers notified')); ?>");
						setTimeout(function(){
						window.location.reload();
						},2000);
						return ;
					}
					toastr.error("<?php echo e(_t('Some error occurred')); ?>");
					
				});
		 
		
	}
	
			$(function(){
	
			$('#submit').submit(function(){
				event.preventDefault();
				//come here
				$type=sessionStorage.getItem('setprojtype');
				if($type==0){
					
					createproject();
				}
				else{
					
					updateproject();
				}
			});
				
				//select2 ajax
				 $('#assigned_to_id').select2({
				   ajax: {
							 delay: 250,
							 processResults: function (data) {
								 
										return {
											
							results: data
								};
							},
							 

							url: function (params) {
							return '<?php echo e(url('getname')); ?>/1';
							}
						
					}
				});
				
		 $('#client_name').select2({
				   ajax: {
					   
							 delay: 250,
							 processResults: function (data) {
								 
										return {
											
							results: data
								};
							},
							 

							url: function (params) {
							return '<?php echo e(url('getname')); ?>/0';
							}
						
					}
				});
			});
			</script>

<div class="modal fade in" id="addProjectForm" aria-labelledby="addProjectForm" role="dialog"   style="display: hide; padding-right: 17px;">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
          <h4 class="modal-title"><?php echo e(_t('Create New Project')); ?></h4>
        </div>
        <div class="modal-body">
          <form   id="submit" role="form">
            <div class="form-group">
              <label class="form-control-label m-b-15" for="name"><?php echo e(_t('Project name')); ?>:</label>
              <input type="text" class="form-control" id="pname" name="name" placeholder="Project name">
            </div> 
		
			<div class="form-group">
              <label class="form-control-label m-b-15" for="name"><?php echo e(_t('Code')); ?>:</label>
              <input type="text" class="form-control" value="<?php echo e(mt_rand(000,999)); ?>" id="projectcode" name="name" placeholder="Project Code">
            </div>
			<div class="form-group">
              <label class="form-control-label m-b-15" for="name"><?php echo e(_t('Start Date')); ?>:</label>
              <input type="text" data-plugin="datepicker" class="form-control"   id="start_date"   placeholder="Project Code">
            </div>
			<div class="form-group">
              <label class="form-control-label m-b-15" for="name"><?php echo e(_t('Estimated Ending')); ?>:</label>
              <input type="text" data-plugin="datepicker" class="form-control"   id="end_est_date"   placeholder="Project Code">
            </div>
			<div class="form-group client_name">
              <label class="form-control-label m-b-15 " for="name"><?php echo e(_t('Client Name')); ?>:</label>
              <select    id="client_name" >
			  <option ><?php echo e(_t('Select Customer Name')); ?></option>
			  </select>
            </div>
		
			<div class="form-group">
              <label class="form-control-label m-b-15" for="name"><?php echo e(_t('Remark')); ?>:</label>
              <textarea id="remark" class="maxlength-textarea form-control mb-sm" placeholder="Droject description." rows="4" maxlength="1000" data-plugin="maxlength"></textarea>
            </div>
			<div class="form-group assigned_to_id">
              <label class="form-control-label m-b-15" for="name"><?php echo e(_t('Project Manager')); ?>:</label>
              <select   multiple   id="assigned_to_id" name="assigned_to_id" >
			  <option ><?php echo e(_t('Type the employee name')); ?></option>
			  </select>
         
            
            
        </div>
        <div class="modal-footer text-xs-left">
          <button class="btn btn-primary" id="addpjbtn" type="submit"><?php echo e(_t('Create Project')); ?></button>
          <a class="btn btn-sm btn-white" data-dismiss="modal" href="javascript:void(0)">Cancel</a>
        </div>
		 </form>
      </div>
    </div>
  </div>