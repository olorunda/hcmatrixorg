<div class="modal fade modal-slide-in-right" id="viewemp<?php echo e($employee->id); ?>" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title"><?php echo e($employee->name); ?>'s Profile</h4>
                        </div>
                        <div class="modal-body">
                         
							<div class="row">
								<div class="col-md-3">
									<img class="img-thumbnail img-bordered img-default" src="<?php echo e(asset('upload')); ?>/<?php echo e($employee->image); ?>" align="left" style="height: 100%;">
								</div>
								<div class="col-md-9">
									<h4><?php echo e(strtoupper($employee->name)); ?></h4>
									<?php $job = app('App\Http\Controllers\EmployeeController')->getjobdetail($employee->job_id); ?>
									<h5>Job Role: <?php echo e(strtoupper($job['title'])); ?></h5>
									<h5> ID: <?php echo e(strtoupper($employee->emp_num)); ?></h5>
									<h5>Department: <?php echo e(app('App\Http\Controllers\AvailJobController')->getDept($employee->workdept_id)); ?></h5>
									<h5>Last Promoted on: <?php echo e(niceDate($employee->last_promoted)); ?></h5>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-6">
									<dl class="dl-horizontal">
										<dt>E-Mail</dt>
										<dd><?php echo e($employee->email); ?></dd>

										<dt>Phone</dt>
										<dd><?php echo e($employee->phone_num); ?></dd>
									</dl>
								</div>
								<div class="col-md-6">
									<dl class="dl-horizontal">
										<dt>Sex</dt>
										<dd><?php echo e($employee->sex); ?></dd>

										<dt>Date of Birth</dt>
										<dd><?php echo e($employee->dob); ?> (<?php echo e($employee->age); ?>)</dd>
									</dl>
								</div>
								<div class="col-md-12">
									<dl class="dl-horizontal">
										<dt>Address</dt>
										<dd><?php echo e($employee->address); ?></dd>
									</dl>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-6">
									<dl class="dl-horizontal">
										<dt>Next of Kin</dt>
										<dd><?php echo e($employee->next_of_kin); ?></dd>

										<dt>Relationship</dt>
										<dd><?php echo e($employee->kin_relationship); ?></dd>
									</dl>
								</div>
								<div class="col-md-6">
									<dl class="dl-horizontal">
										<dt>Phone</dt>
										<dd><?php echo e($employee->kin_phonenum); ?></dd>
									</dl>
								</div>
								<div class="col-md-12">
									<dl class="dl-horizontal">
										<dt>Address</dt>
										<dd><?php echo e($employee->kin_address); ?></dd>
									</dl>
								</div>
							</div>
						 
						
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>