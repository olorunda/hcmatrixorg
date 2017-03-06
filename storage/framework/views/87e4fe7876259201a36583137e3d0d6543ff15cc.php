<?php if($class==""): ?>
<script>
$(function(){
	
		
				$('#add_depd').submit(function(){
					event.preventDefault();
				var type=sessionStorage.getItem('type');
				if(type==1){
					create();
					return ;
				}
				
				update();
					
				});
			
	
	
});
function update(){
			
				relationship=$('#relationship').val();
					if(relationship=="nil"){
						toastr.error("<?php echo e(_t('Please Select relationship')); ?>");
						return;
					}
					name=$('#depname').val();
					dob=$('#depdob').val();
					email=$('#depemail').val();
					depphonenum=$('#depphonenum').val();
					id=sessionStorage.getItem('depid');
						$.get('<?php echo e(url('adddependant')); ?>/'+id,{
							dep_name:name,
							dep_dob:dob,
							dep_email:email,
							phone_num:depphonenum,
							relationship:relationship
							
						},function(data,status,xhr){
							
							if(xhr.status==200){
								
								toastr.success("<?php echo e(_t('Dependant Updated Successfully')); ?>");
								setTimeout(function(){
									
									window.location.reload();
									
								},2000);
								return ;
							}
							toastr.error("<?php echo e(_t('Unable to Update Dependant , Plese try again')); ?>"+data);
							return ;
							
						});
			
		}
		
		function create(){
			
			relationship=$('#relationship').val();
					if(relationship=="nil"){
						toastr.error("<?php echo e(_t('Please Select relationship')); ?>");
						return;
					}
					name=$('#depname').val();
					dob=$('#depdob').val();
					email=$('#depemail').val();
					depphonenum=$('#depphonenum').val();
					
						$.get('<?php echo e(url('adddependant/0')); ?>',{
							dep_name:name,
							dep_dob:dob,
							dep_email:email,
							phone_num:depphonenum,
							relationship:relationship
							
						},function(data,status,xhr){
							
							if(xhr.status==200){
								
								toastr.success("<?php echo e(_t('Dependant Added Successfully')); ?>");
								setTimeout(function(){
									
									window.location.reload();
									
								},2000);
								return ;
							}
							tostr.error("<?php echo e(_t('Unable to add Dependant , Plese try again')); ?>"+data);
							return ;
							
						});
						
			
		}
		
	
	function editdep(id,name,dob,relationship,email,phone_num){
		
				$('#depname').val(name);
					$('#depdob').val(dob);
					$('#depemail').val(email);
					$('#depphonenum').val(phone_num);
					sessionStorage.setItem('depid',id);
					sessionStorage.setItem('type',0);
				 $('#dynamics').text('<?php echo e(_t('Update Dependant')); ?>');
		 
		
	}
	 
	
	
	function fallback(){
			sessionStorage.setItem('type',1);
		 $('#dynamics').text('<?php echo e(_t('Add Dependant')); ?>'); 
	 
	}
			
		function depdelete(id){
		
		swal({
			title: "<?php echo e(_t('Are you sure?')); ?>",
			text: "<?php echo e(_t('You are about to delete dependant')); ?>",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "<?php echo e(_t('Yes, delete it!')); ?>",
			closeOnConfirm: false
		},
	function(){
		
			$.get('<?php echo e(url('deletedpendant')); ?>/'+id,function(data,status,xhr){
			
			if(xhr.status==200){
				toastr.success("<?php echo e(_t('Successfully Deleted')); ?>");
				swal("Deleted!", "<?php echo e(_t('Successfull')); ?>", "success");

				setTimeout(function(){
					
					
					window.location.reload();
					
				},2000);
				return ;
				
			}
			toastr.error("<?php echo e(_t('Some error')); ?>");
			return ;
			
		});
	
  		
		
		});
		
	}
					


</script>

<div class="modal fade modal-danger in" id="adddept" aria-labelledby="exampleModalDanger" role="dialog"  style="display: none; padding-right: 17px;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title"><?php echo e(_t('Add Dependant')); ?>

						  </h4>
                        </div>
                        <div class="modal-body">
                     
	   <div>
	
	   
	   <form id="add_depd"  >
	  
	   <input type="hidden"  id="xss" value="<?php echo e(csrf_token()); ?>" >
	  <b style="color:green"><?php echo e(_t('Relationship')); ?></b>
	    <select data-plugin="select2" id="relationship">
		<option value="nill"><?php echo e(_t('Choose a Relationship')); ?></option>
		<option value="Father"><?php echo e(_t('Father')); ?></option>
		<option value="Brother"><?php echo e(_t('Brother')); ?></option>
		<option value="Sister"><?php echo e(_t('Sister')); ?></option>
		<option value="Uncle"><?php echo e(_t('Uncle')); ?></option>
		<option value="Aunt"><?php echo e(_t('Aunt')); ?></option>
		</select>
		<br>
		  <b style="color:green"><?php echo e(_t('Name')); ?></b> 
	   <input type="text"  required placeholder="Full Name" id="depname"   class="form-control"><br>
	     <b style="color:green"><?php echo e(_t('Date of Birth')); ?></b> 
		<input type="text" data-plugin="datepicker" required placeholder="Date of birth" id="depdob"   class="form-control"><br>
		<b style="color:green"><?php echo e(_t('Email')); ?></b> 
		<input type="email" required placeholder="email@mail.com" id="depemail"   class="form-control">
	 
	    </div><br>
		<b style="color:green"><?php echo e(_t('Phone Number')); ?></b> 
		<input type="tel" required placeholder="070xxxx" id="depphonenum"   class="form-control">
	 
	    </div>
                    
                        <div class="modal-footer">
                          <a role="button" class="btn btn-default" data-dismiss="modal"><?php echo e(_t('Close')); ?></a>
						  <button type="submit"   class="btn btn-primary" id="dynamics"><?php echo e(_t('Add Dependant')); ?></button>
                        </div>
						</form>
						    </div>
                      </div>
                    </div>
<?php endif; ?>

 <div class="panel">
                    <div style="text-color:red;" class="panel-heading" id="exampleHeadingDefaultThree" role="tab">
                      <a style="text-decoration:none;" class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree" data-parent="#exampleAccordionDefault" aria-expanded="true" aria-controls="exampleCollapseDefaultThree">
                     <?php echo e(_t('Dependants(s)')); ?>( <button onclick="fallback()" data-toggle="modal" data-target="#adddept" class="<?php echo e($class); ?> btn btn-sm btn-outline btn-pure btn-success"><i class="icon wb-plus"></i><?php echo e(_t('Add')); ?></button> )<button class="pull-right btn btn-sm btn-icon btn-pure btn-default"><i class="icon wb-plus"></i></button>
                    </a>
                    </div>
                    <div class="panel-collapse collapse" id="exampleCollapseDefaultThree" aria-labelledby="exampleHeadingDefaultThree" role="tabpanel" aria-expanded="false">
              <div class="container">  
				<?php if(count($dependants)>0): ?>
          <table class="table table-hover dataTable table-striped w-full" id="exampleTableSearch" data-plugin="dataTable">
            <thead>
              <tr>
			  				
                <th><?php echo e(_t('Name')); ?></th>
                <th><?php echo e(_t('Date of Birth')); ?></th>
                <th><?php echo e(_t('Relationship')); ?></th>
                <th><?php echo e(_t('Email')); ?></th>
                <th><?php echo e(_t('Phone Number')); ?></th>
                 <th><?php echo e(_t('Action')); ?></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
               <th><?php echo e(_t('Name')); ?></th>
                <th><?php echo e(_t('Date of Birth')); ?></th>
                <th><?php echo e(_t('Relationship')); ?></th>
                <th><?php echo e(_t('Email')); ?></th>
                <th><?php echo e(_t('Phone Number')); ?></th>
                 <th><?php echo e(_t('Action')); ?></th>
              </tr>
            </tfoot>
            <tbody >
			<?php $__currentLoopData = $dependants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dependant): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
              <tr>
			  
                <td><?php echo e($dependant->name); ?></td>
                <td><?php echo e($dependant->dob); ?></td>
                <td><?php echo e($dependant->relationship); ?></td>
                <td><?php echo e($dependant->email); ?></td>
                <td><?php echo e($dependant->phone_num); ?></td>
                <td>
				<a  <?php echo e($disable); ?>  style="cursor:pointer;" onclick="editdep('<?php echo e($dependant->id); ?>','<?php echo e($dependant->name); ?>','<?php echo e($dependant->dob); ?>','<?php echo e($dependant->relationship); ?>','<?php echo e($dependant->email); ?>','<?php echo e($dependant->phone_num); ?>')" class="<?php echo e($class); ?> btn btn-sm btn-icon btn-pure btn-default" data-toggle="modal" data-target="#adddept"><i class="icon wb-edit" aria-hidden="true"></i></a>
				<a <?php echo e($disable); ?>  style="cursor:pointer;" onclick="depdelete('<?php echo e($dependant->id); ?>')"  class="<?php echo e($class); ?> btn btn-sm btn-icon btn-pure btn-default" ><i class="icon wb-trash" aria-hidden="true"></i></a>
				</td>
               
              </tr>
			 <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
           </tbody>
		 
          </table>
		  <?php else: ?>
			  <h3 class="text-center alert alert-success"><?php echo e(_t('No dependant Found')); ?></h3>
		  <?php endif; ?>
		  
        </div>
        </div>
      </div>
  