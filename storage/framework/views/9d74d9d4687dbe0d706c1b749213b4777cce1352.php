<div class="modal fade modal-3d-slit" id="addjobs" aria-labelledby="exampleModalTitle" role="dialog"  aria-hidden="true" style="display: none;" >

                    <div class="modal-dialog modal-sidebar">
					
                      <form class="modal-content" id="sumjob">
					 
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="exampleFormModalLabel">Add Job</h4>
                        </div>
                        <div class="modal-body">
                          <div class="row">
						 
							
							<div class="col-xs-12 col-xl-12 form-group">
                              <input required  type="text" class="form-control" id="jobref" placeholder="Job reference number">
                            </div>
							
							<div class="col-xs-12 col-xl-12 form-group">
                             <select data-plugin="select2" class="form-control" id="taketest"  >
							<option value="0">-Take Apptitude Test-</option>
							
							<option value="1">Yes</option>
							<option value="0">No</option>
									
							</select>
                            </div>
							
                            <div class="col-xs-12 col-xl-12 form-group">
                              <input required  type="text" class="form-control" id="title" placeholder="job title">
                            </div>
							<div class="col-xs-12 col-xl-12 form-group">
							<select data-plugin="select2" class="form-control" id="levelid"  >
							<option value="0">-Select Level-</option>
									<?php if(count($levels)>0): ?>
									<?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<option value="<?php echo e($level->id); ?>"><?php echo e($level->level); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									<?php endif; ?>
							</select>
							</div>
							
							<div class="col-xs-12 col-xl-12 form-group">
							<select data-plugin="select2" class="form-control" id="typeid"  >
							<option value="0">-Work Type-</option>
									<?php if(count($types)>0): ?>
									<?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<option value="<?php echo e($type->id); ?>"><?php echo e($type->work_type); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									<?php endif; ?>
							</select>
							</div>
							
							<div class="col-xs-12 col-xl-12 form-group">
							<select data-plugin="select2" class="form-control" id="specid"  >
							<option value="0">-Department-</option>
									<?php if(count($specs)>0): ?>
									<?php $__currentLoopData = $specs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spec): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<option value="<?php echo e($spec->id); ?>"><?php echo e($spec->spec); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									<?php endif; ?>
							</select>
							</div>
							
                            <div class="col-xs-12 col-xl-12 form-group">
							<select data-plugin="select2" class="form-control" id="state"  >
							<option value="0">Location (all)</option>
									<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<option value="<?php echo e($state->id); ?>"><?php echo e($state->state); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							</select>
							</div>
					  	   <div class="col-xs-12 col-xl-12 form-group expreq">
							Experience Required
							<input required  type="text"  id="expyear" data-plugin="ionRangeSlider" data-min=0 data-max=25 data-from=2  data-prefix="Year(s)"  data-type="double" data-grid="true">
							</div>
							
                            <div class="col-xs-12 col-xl-12 form-group ">
                              <textarea required  data-provide="markdown" data-iconlibrary="fa"  id="description" class="md-input" rows="5" style="width: 100%; resize: none;" placeholder="job description"></textarea>
                            </div> 
							
							<div class="col-xs-12 col-xl-12 form-group">
                              <textarea required  data-provide="markdown" data-iconlibrary="fa"  id="requiredexp" class="md-input" rows="5" style="width: 100%; resize: none;" placeholder="Description of experience reuired"></textarea>
                            </div>
                             <div class="col-xs-12 col-xl-12 form-group">
                              <textarea required  data-provide="markdown" data-iconlibrary="fa"  id="requirement" class="md-input" rows="5" style="width: 100%; resize: none;" placeholder="Educational Requirement"></textarea>
                            </div>
							
							 <div class="col-xs-12 col-xl-12 form-group">
                              <textarea required  data-provide="markdown" data-iconlibrary="fa"  id="otherskill" class="md-input" rows="5" style="width: 100%; resize: none;" placeholder="Other Skills"></textarea>
                            </div>
							<div class="col-xs-12 col-xl-12 form-group salrange">
							Salary Range
							<input required  type="text"  id="range" data-plugin="ionRangeSlider" data-min=10000 data-max=1000000 data-from=15000  data-prefix="Salary( N"  data-type="double" data-grid="true">
							</div>
							   <div class="col-xs-12 col-xl-12 form-group">
                            	<input required  type="text" class="form-control" name="start_date" id="expdate" placeholder="Expiry Date" autocomplete="off" data-plugin="datepicker" data-date-format="yyyy-mm-dd" required="required">
                            </div>
					
                            <div class="col-xs-12 col-md-12 pull-xs-right" id="showhide">
                              <input required  type="submit" id="addjob" class="add btn btn-primary btn-outline add"  value="Add Job">
							  
                            </div> 
							
							<div class="col-xs-12 col-md-12 pull-xs-right" id="hidemod">
                              <input required  type="submit" class="mod btn btn-primary btn-outline"  value="Modify">
							  
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                
                  </div>
			  
	