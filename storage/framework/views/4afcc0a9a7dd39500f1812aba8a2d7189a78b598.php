<?php $pilots=app('App\Repositories\EmployeeRepository')->getGoal('pilot', 2)?>
<script>

function modify(id,objective,commitment){
	
		$('#type').val(2);
		 id=$('#id').val(id); 
		 objective=$('#objective').val(objective);
     	 commitment=$('#commitment').val(commitment);
			  
		$('#addpilotcontrol').show(1000);
	
}

function deletes(id){
	
	swal({
  title: "Are you sure?",
  text: "You will not be able to recover this goal!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(){
	$.get('<?php echo e(url('delete/pilot')); ?>/'+id,function(data,status,xhr){
		
		if(xhr.status==200){

		 swal("Deleted!", "Pilot Goal Deleted.", "success");
		 
		 setTimeout(function(){
			 window.location.reload();
 
		 },2000);
		}
		else{
			toastr.error("Some Error Occurred");
		}
	});
 
});
}

$(function(){
	
	$('#addpilotcontrol').hide();
	
	
	$('#addpilot').click(function(){
		$('#type').val(1);
		 id=$('#id').val(0); 
		 objective=$('#objective').val("");
     	 commitment=$('#commitment').val("");
		
		$('#addpilotcontrol').show(1000);
		
	});
	
	//cancel pilot goal
	$('#cancelpilot').click(function(){
		$('#addpilotcontrol').hide(1000);
		
		
		
	});
	
	
	$('#savepilot').click(function(){
	
			  type=$('#type').val(); 
			  id=$('#id').val(); 
			  objective=$('#objective').val();
			  commitment=$('#commitment').val();
			  if(objective=="" || commitment==""){
				  
				  toastr.error("Please Fill all fields");
				  return;
			  }
			$.get('<?php echo e(url('save/pilot')); ?>',{
			type:type,
			id:id,
			objective:objective,
			commitment:commitment
				
			},function(data,status,xhr){
				
				if(xhr.status==200){
					if(type==1){
						
					
					toastr.success("Successfully Add Pilot Goal");
					}
					else{
						
					toastr.success("Successfully Modified Pilot Goal");
					}
				setTimeout(function(){
					
					window.location.reload();
				},2000);
				return ;
				}
				toastr.error("Some Error Occurred");
				
				
			});
	});		  
	
});

</script>
<div class="modal fade modal-primary modal-rotate-from-left" id="pilotgoals" aria-labelledby="exampleModalTitle" role="dialog"   style="display: none;" aria-hidden="true">

                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Add/Modify Pilot Goals</h4>
                        </div>
                        <div class="modal-body">
                        <div class="panel-group panel-group-continuous" id="exampleAccordionContinuous" aria-multiselectable="true" role="tablist">
					<?php if(count($pilots)>0): ?>
						<?php $__currentLoopData = $pilots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pilot): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                   <div class="panel  ">
				  
                    <div class="panel-heading" id="exampleHeadingContinuousThree" role="tab">
					 <div class="ribbon ribbon-bookmark ribbon-danger">
                        <span class="ribbon-inner" style="cursor:pointer" onclick="deletes('<?php echo e($pilot->id); ?>')">Delete</span>
                      </div>
					  <div class="ribbon ribbon-bookmark ribbon-reverse ribbon-success">
                        <span class="ribbon-inner" style="cursor:pointer" onclick='modify("<?php echo e($pilot->id); ?>","<?php echo e($pilot->objective); ?>","<?php echo e(htmlspecialchars($pilot->commitment)); ?>")'>Modify</span>
                      </div><br><Br>
                      <a class="panel-title collapsed" data-parent="#exampleAccordionContinuous" data-toggle="collapse" href="#exampleCollapseContinuousThree<?php echo e($pilot->id); ?>" aria-controls="exampleCollapseContinuousThree<?php echo e($pilot->id); ?>" aria-expanded="false">
                      <?php echo e($pilot->objective); ?>

                    </a>
                    </div>
                    <div class="panel-collapse collapse" id="exampleCollapseContinuousThree<?php echo e($pilot->id); ?>" aria-labelledby="exampleCollapseContinuousThree<?php echo e($pilot->id); ?>" role="tabpanel" aria-expanded="false" style="height: 0px;">
                      <div class="panel-body">
					  <?php echo e($pilot->commitment); ?>

                      </div>
                    </div>
                  </div>
				  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				  <?php else: ?>
					  <h3>No PIlot Goals Has Been Set for this Year</h3>
				  <?php endif; ?>
                </div>
				<div id="addpilotcontrol">
				<div class="example-wrap">
                <h4 class="example-title">Objective</h4>
				<input type="hidden" id="type" />
				<input type="hidden" id="id" value="0" />
                <textarea class="form-control" id="objective" rows="3"></textarea>
				<br>
               <h4 class="example-title">Commitment</h4>
                <textarea class="form-control" id="commitment" rows="3"></textarea><br>
           
				<button type="button" id="savepilot" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp; Save Goal</button>
				<button type="button" id="cancelpilot" class="btn btn-danger"><i class="fa fa-ban"></i>&nbsp;&nbsp; Cancel</button>
				   </div>
				</div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="addpilot" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Goal</button>
						   
                        </div>
                      </div>
                    </div>
                  </div>
</div>
<!-- QUERY SETTINGS ENDS -->
<!-- MODALS ENDS -->

<!-- here modal importemp -->

