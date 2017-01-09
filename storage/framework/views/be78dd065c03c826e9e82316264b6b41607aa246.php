<div class="modal fade modal-danger modal-rotate-from-left" id="leave" aria-labelledby="exampleModalTitle" role="dialog"   style="display: none;" aria-hidden="true">

                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Add Leave Types</h4>
                        </div>
                        <div class="modal-body">
                        <p>Action Type</p>
						<select data-plugin="select2" id="actiontypel">
						
						<option >--Select Action--</option>
						<option value="edit">Edit Leave Type</option>
						<option value="add">Add Leave Type</option>
						<option value="pub">Add Holiday</option>
						<option value="editpub">Edit Holiday</option>
						
						</select>
						<br>
						
						<!-- aDD aCTION -->
						<div id="addl">
						 <p>Leave Type</p>
						<input type="text" placeholder="Enter query Type .." class="form-control" id="qtypel" /><br>
						
						<p>Number of Day</p>
						 <input type="number" class="form-control" id="qtemplatel" >
									
									<br>
						
						</div>
						
						<div id="addps">
						 <p>Holiday Name</p>
						<input type="text" placeholder="Enter holiday name" class="form-control" id="holname" /><br>
						
						<p>Duration</p>
						 		<div class="example">
                  <div class="input-daterange" data-plugin="datepicker">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon wb-calendar" aria-hidden="true"></i>
                      </span>
                      <input type="text" id="holfrom" class="form-control" name="start">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">to</span>
                      <input type="text" id="holto" class="form-control" name="end">
                    </div>
                  </div>
                </div>
									<br>
						
						</div>
						
							<div id="editps">
							<?php    
								$holidays=app('App\Repositories\GlobalSettingRepository')->getholiday();
								?>
								 <?php if(count($holidays)>0): ?>
									 <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				
								<input type="hidden" value="<?php echo e($types->start_date); ?>"  id="phfrom<?php echo e($types->id); ?>">
				<input type="hidden" value="<?php echo e($types->end_date); ?>"  id="phto<?php echo e($types->id); ?>">
								
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								<?php endif; ?>
				
			 <select id="qtype1lp" data-plugin="select2" type="text" class="form-control" >
								  <option value="0">-Select Holiday Name-</option>
								
								 <?php if(count($holidays)>0): ?>
									 <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				
				<option value="<?php echo e($types->id); ?>"><?php echo e($types->title); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								  <?php endif; ?>
			 </select><br>
						 <p>Holiday Name</p>
						<input type="text" placeholder="" class="form-control" id="modholname" disabled /><br>
						
						<p>Duration</p>
						 		<div class="example">
                  <div class="input-daterange" data-plugin="datepicker">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon wb-calendar" aria-hidden="true"></i>
                      </span>
                      <input type="text" id="modholfrom" class="form-control" name="start" disabled>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">to</span>
                      <input type="text" id="modholto" class="form-control" name="end"  disabled>
                    </div>
                  </div>
                </div>
									<br>
						
						</div>
						
						
						
						<!-- EDIT ACTION -->
						<div id="editl">
						
						<div class="col-xl-4 col-xs-12">
							<b>Select Leave Types:</b>
							</div>
                              <div class="col-xs-12 col-xl-8 form-group">
							     <?php if(count($leaves)>0): ?>
									 <?php $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> 
							     <input type="hidden" value="<?php echo e($types->days); ?>" id="<?php echo e($types->id); ?>l"/>
								 <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								  <?php endif; ?>
								  
						         <select id="qtype1l" data-plugin="select2" type="text" class="form-control" >
								  <option value="0">-Select Leave Type-</option>
								
								 <?php if(count($leaves)>0): ?>
									 <?php $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								
								  <option value="<?php echo e($types->id); ?>"><?php echo e($types->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								  <?php endif; ?>
								 </select>
								


						</div>
						
							<b>Title:</b><br>
							 
							      <input type="text" id="qtitledeitl" class="form-control" disabled>
							    
						       <br>
								
							  <div class="" id="tpanel">
							      <input type="number" min="0"  class="form-control" id="qtemplate1l" disabled>
									
							    
						       
								
                               
                              </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="saveqtemplatel" class="btn btn-primary">Save changes</button>
						  <button type="button" id="modifyqtemplatel" class="btn btn-primary" disabled>Save changes</button>
						  <button type="button" id="savehols" class="btn btn-primary" >Save changes</button>
						  <button type="button" id="savemodhols" class="btn btn-primary" >Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
</div>

<div>



</div>


<div class="modal fade modal-fade-in-scale-up" id="attachtorole" aria-labelledby="exampleModalTitle" role="dialog"   aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Attach Leave Day To Job Role</h4>
                        </div>
                        <div class="modal-body">
                         <p>Job Role</p>
						<select data-plugin="select2" id="jobrole">
						
						<option >--Select Role--</option>
						<option value="4">Casual</option>
						<option value="1">Employee</option>
						<option value="2">Line Manager</option>
						<option value="3">Admin HR</option> 
						</select>
						<br>
						 <p>Allowable Leave Day</p>
						 <input type="text" class="form-control" id="leaveday" />
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="saveattach">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>



<!-- QUERY SETTINGS ENDS -->
<!-- MODALS ENDS -->

<!-- here modal importemp -->

