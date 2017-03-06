
			<?php if($class==""): ?>
 <script>
 
 $(function(){
	 
		
				
				$('#add_skill').submit(function(){
					event.preventDefault();
				var type=sessionStorage.getItem('exptype');
				if(type==1){
					createexp();
					return ;
				}
				
				updateskill();
					
				}); 
	 
	 
 });
 function updateskill(){
				
				
				    skillname=$('#skillname').val();
					skillexp=$('#skillexp').val();
					skillrating=$('#skillrating').val();
					remark=$('#remark').val();
				 
					if(skillrating=="nil"){
						toastr.error("<?php echo e(_t('Please Select your skill level')); ?>");
						return;
					}
					 
					id=sessionStorage.getItem('expid');
						$.get('<?php echo e(url('addexperiences')); ?>/'+id,{
							skill:skillname,
							experience:skillexp,
							rating:skillrating,
							remark:remark
							
						},function(data,status,xhr){
							
							if(xhr.status==200){
								
								toastr.success("<?php echo e(_t('Skill Updated Successfully')); ?>");
								setTimeout(function(){
									
									window.location.reload();
									
								},2000);
								return ;
							}
							toastr.error("<?php echo e(_t('Unable to Update Skill , Plese try again')); ?>"+data);
							return ;
							
						});
			
		}
		
		function createexp(){
			
						    skillname=$('#skillname').val();
					skillexp=$('#skillexp').val();
					skillrating=$('#skillrating').val();
					remark=$('#remark').val();
				 
					if(skillrating=="nil"){
						toastr.error("<?php echo e(_t('Please Select your skill level')); ?>");
						return;
					}
					//id=sessionStorage.getItem('expid');
						$.get('<?php echo e(url('addexperiences')); ?>/'+0,{
							skill:skillname,
							experience:skillexp,
							rating:skillrating,
							remark:remark
							
						},function(data,status,xhr){
							
							if(xhr.status==200){
								
								toastr.success("<?php echo e(_t('Skill added Successfully')); ?>");
								setTimeout(function(){
									
									window.location.reload();
									
								},2000);
								return ;
							}
							toastr.error("<?php echo e(_t('Unable to add Skill , Plese try again')); ?>"+data);
							return ;
							
						});
			
						
			
		}
		
 function editskill(skill,id,experience,rating,remarks){
		
				$('#skillname').val(skill);
					$('#skillexp').val(experience);
					$('#skillrating').val(rating);
					$('#remark').val(remarks);
					sessionStorage.setItem('expid',id);
					sessionStorage.setItem('exptype',0);
				 $('#expdynamics').text('<?php echo e(_t('Update Experience')); ?>');
		
		
	}
	function fallbackskill(){
			sessionStorage.setItem('exptype',1);
		 $('#expdynamics').text('<?php echo e(_t('Add Experience')); ?>'); 
	 
	}
	
	function expdelete(id){
		
		swal({
			title: "<?php echo e(_t('Are you sure?')); ?>",
			text: "<?php echo e(_t('You are about to delete Experience')); ?>",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "<?php echo e(_t('Yes, delete it!')); ?>",
			closeOnConfirm: false
		},
	function(){
		
			$.get('<?php echo e(url('deleteexperiences')); ?>/'+id,function(data,status,xhr){
			
			if(xhr.status==200){
				toastr.success("<?php echo e(_t('Successfully Deleted')); ?>");
				swal("<?php echo e(_t('Deleted!')); ?>", "<?php echo e(_t('Successfull')); ?>", "success");

				setTimeout(function(){
					
					
					window.location.reload();
					
				},2000);
				return ;
				
			}
			toastr.error("<?php echo e(_t('Some error Occurred')); ?>");
			return ;
			
		});
	
  		
		
		});
		
	}
	
 
 
 </script>
		
 <div class="modal fade modal-danger in" id="addskill" aria-labelledby="exampleModalDanger" role="dialog"  style="display: none; padding-right: 17px;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title"><?php echo e(_t('Manage Skill')); ?>

						  </h4>
                        </div>
                        <div class="modal-body">
                     
	   <div>
		
	   
	   <form id="add_skill"  >
	   <b style="color:green"><?php echo e(_t('Name')); ?></b> 
	   <input type="text"  required placeholder="skill name" id="skillname"   class="form-control"><br> 
	   <b style="color:green"><?php echo e(_t('Experience in Years')); ?></b> 
	   <input type="number"  required placeholder="Experience in years" id="skillexp"   class="form-control"><br>
	   
	  <b style="color:green"><?php echo e(_t('Skill Level')); ?></b>
	    <select data-plugin="select2" id="skillrating">
		<option value="nill"><?php echo e(_t('Choose Skill Level')); ?></option>
		<option value="Beginner"><?php echo e(_t('Beginner')); ?></option>
		<option value="Intermediate"><?php echo e(_t('Intermediate')); ?></option>
		<option value="Proffessional"><?php echo e(_t('Proffessional')); ?></option>
		<option value="Expert"><?php echo e(_t('Expert')); ?></option>
		</select>
		<br>
		 
		<b style="color:green"><?php echo e(_t('Remark')); ?></b> 
		<textarea  required placeholder="Remark" id="remark"   class="form-control">
		</textarea>
	    </div>  </div>
                    
                        <div class="modal-footer">
                          <a role="button" class="btn btn-default" data-dismiss="modal"><?php echo e(_t('Close')); ?></a>
						  <button type="submit"   class="pull-right btn btn-primary" id="expdynamics"><?php echo e(_t('Add Skill')); ?></button>
                        </div>
						</form>
						   
                    
                      </div>
                    </div>
                  </div>
 <?php endif; ?>

 <div class="panel">
                    <div style="text-color:red;" class="panel-heading" id="exampleHeadingDefaultThreeskill" role="tab">
                      <a style="text-decoration:none;" class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThreeskill" data-parent="#exampleAccordionDefault" aria-expanded="true" aria-controls="exampleCollapseDefaultThree">
                      <?php echo e(_t('Skill(s)')); ?>( <button onclick="fallbackskill()" data-toggle="modal" data-target="#addskill" class="<?php echo e($class); ?> btn btn-sm btn-outline btn-pure btn-success"><i class="icon wb-plus"></i><?php echo e(_t('Add')); ?></button> )<button class="pull-right btn btn-sm btn-icon btn-pure btn-default"><i class="icon wb-plus"></i></button>
                    </a>
                    </div>
                    <div class="panel-collapse collapse" id="exampleCollapseDefaultThreeskill" aria-labelledby="exampleHeadingDefaultThreeskill" role="tabpanel" aria-expanded="false">
              <div class="container">  
				<?php if(count($skills)>0): ?>
          <table class="table table-hover dataTable table-striped w-full" id="exampleTableSearch" data-plugin="dataTable">
            <thead>
              <tr>
			  				
                <th><?php echo e(_t('Skill')); ?></th>
                <th><?php echo e(_t('Experience In Years')); ?></th>
                <th><?php echo e(_t('Skill Rating')); ?></th>
                <th><?php echo e(_t('Remarks')); ?></th> 
                <th><?php echo e(_t('Action')); ?></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                 <th><?php echo e(_t('Skill')); ?></th>
                <th><?php echo e(_t('Experience In Years')); ?></th>
                <th><?php echo e(_t('Skill Rating')); ?></th>
                <th><?php echo e(_t('Remarks')); ?></th> 
                <th><?php echo e(_t('Action')); ?></th>
              </tr>
            </tfoot>
            <tbody >
			<?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
              <tr>
			  	
                <td><?php echo e($skill->skill); ?></td>
                <td><?php echo e($skill->experience); ?> Year(s)</td>
                <td><?php echo e($skill->rating); ?></td>
                <td><?php echo e($skill->remarks); ?></td>
              
                <td>
				<a <?php echo e($disable); ?> style="cursor:pointer;" onclick="editskill('<?php echo e($skill->skill); ?>','<?php echo e($skill->id); ?>','<?php echo e($skill->experience); ?>','<?php echo e($skill->rating); ?>','<?php echo e($skill->remarks); ?>')" class="<?php echo e($class); ?> btn btn-sm btn-icon btn-pure btn-default" data-toggle="modal" data-target="#addskill"><i class="icon wb-edit" aria-hidden="true"></i></a>
				<a <?php echo e($disable); ?> style="cursor:pointer;" onclick="expdelete('<?php echo e($skill->id); ?>',1)"  class="<?php echo e($class); ?> btn btn-sm btn-icon btn-pure btn-default" ><i class="icon wb-trash" aria-hidden="true"></i></a>
				</td>
               
              </tr>
			 <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
           </tbody>
		 
          </table>
		  <?php else: ?>
			  <h3 class="text-center alert alert-success"><?php echo e(_t('No Skill Found')); ?></h3>
		  <?php endif; ?>
		  
        </div>
        </div>
      </div>
       