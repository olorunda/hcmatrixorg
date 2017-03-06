<?php
$degrees = array(
	1	=> "O.N.D.",
	2	=> "H.N.D.",
	3	=> "B.Sc.",
	4	=> "B.Eng.",
	5	=> "M.B.A.",
	6	=> "M.Sc.",
	7	=> "M.Phil.",
	8	=> "P.hD.",
	9	=> "OTHER",
	);
$gradesClass = array(
	1	=> "FIRST CLASS",
	2	=> "SECOND CLASS UPPER",
	3	=> "SECOND CLASS LOWER",
	4	=> "THIRD CLASS",
	5	=> "DISTINCTION",
	6	=> "MERIT",
	7	=> "PASS",
	8	=> "UPPER CREDIT",
	9	=> "LOWER CREDIT",
	10	=> "OTHER",
	);
$modes = array(
	1=> "STUDENT MEMBER",
	2=> "ASSOCIATE MEMBER",
	3=> "MEMBER",
	4=> "FELLOW",
	5=> "OTHER"
	);
$refTitle = array(
	1 	=> "Mr.",
	2	=> "Mrs.",
	3	=> "Miss.",
	4	=> "Ms."
	);
	?>
	<style type="text/css">
		a.panel-title {
			box-shadow: 3px 3px 4px #ececec;
		}
		/*.table-borderless tbody tr td,
		.table-borderless tbody tr th,
		.table-borderless thead tr th,
		.table-borderless thead tr td,
		.table-borderless tfoot tr th,
		.table-borderless tfoot tr td {
			border: none;
		}*/
		.table-borderless tbody tr td,
		.table-borderless tbody tr th {
			border: none;
		}
	</style>
	<div style="display: none;" id="previewContainer">
		<?php if(Auth::user()->job_reg_status == 0): ?>
		<div class="ribbon ribbon-clip ribbon-reverse ribbon-success">
			<span class="ribbon-inner" data-toggle="modal" data-target="#finalsubmission">
				Final Copy
			</span>
		</div>
		<?php endif; ?>
		<br>
		<div id="preview">
			<h4>Preview Your C.V.</h4>
			<br>
			<div class="row row-lg">
				<div class="col-md-12">
					<!-- Example Default Accordion -->
					<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
						<div class="panel">
							<div class="panel-heading" id="exampleHeadingDefaultOne" role="tab">
								<a class="panel-title" data-toggle="collapse" href="#exampleCollapseDefaultOne" data-parent="#exampleAccordionDefault" aria-expanded="true" aria-controls="exampleCollapseDefaultOne">
									<i class="icon wb-user" aria-hidden="true"></i> Bio-Data
								</a>
							</div>
							<div class="panel-collapse collapse in" id="exampleCollapseDefaultOne" aria-labelledby="exampleHeadingDefaultOne"role="tabpanel">
								<!-- Example Panel Fullscreen -->
								<br>
								<div class="panel-heading">
									<div class="panel-actions panel-actions-keep">
										<a class="panel-action icon wb-expand" data-toggle="panel-fullscreen" aria-hidden="true"></a>
									</div>
								</div>
								<div class="panel-body">
									<form class="form-horizontal">
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">Your Name: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												<?php if(count($bios) > 0): ?>
												<?php echo e($bios->name); ?>

												<?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">Date of Birth: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												<?php if(count($bios) > 0): ?>
												<?php echo e($bios->dob); ?>

												<?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">Sex: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												<?php if(count($bios) > 0): ?>
												<?php if($bios->sex == "F"): ?>
												Female
												<?php else: ?>
												Male
												<?php endif; ?>
												<?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">Phone Number: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												<?php if(count($bios) > 0): ?>
												<?php echo e($bios->phone_num); ?>

												<?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">E-Mail: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												<?php if(count($bios) > 0): ?>
												<?php echo e($bios->email); ?>

												<?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">Marital Status: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												<?php if(count($bios) > 0): ?>
												<?php if($bios->marital_status == "single"): ?>
												Single
												<?php else: ?>
												Married
												<?php endif; ?>
												<?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">State of Origin: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<?php if($bios->state_origin_id == $state->id): ?>
												<?php echo e($state->state); ?>

												<?php endif; ?>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">Local Government Area: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												<?php if(count($bios) > 0): ?>
												<?php echo e($bios->lga); ?>

												<?php endif; ?>
											</div>
										</div>
									</form>
								</div>
								<!-- End Example Panel Fullscreen -->
							</div>
						</div>
						<div class="panel">
							<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab">
								<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultTwo" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultTwo">
									<i class="icon wb-map" aria-hidden="true"></i> Correspondence
								</a>
							</div>
							<div class="panel-collapse collapse" id="exampleCollapseDefaultTwo" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
								<br>
								<div class="panel-heading">
									<div class="panel-actions panel-actions-keep">
										<a class="panel-action icon wb-expand" data-toggle="panel-fullscreen" aria-hidden="true"></a>
									</div>
								</div>
								<div class="panel-body">
									<form class="form-horizontal">
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">Street: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												<?php if(count($corrs) > 0): ?>
												<?php echo e($corrs->street); ?>

												<?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">City: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												<?php if(count($corrs) > 0): ?>
												<?php echo e($corrs->city); ?>

												<?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">State: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												<?php if(count($corrs) > 0): ?>
												<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<?php if($corrs->state_id == $state->id): ?>
												<?php echo e($state->state); ?>

												<?php endif; ?>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												<?php endif; ?>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-heading" id="exampleHeadingDefaultFour" role="tab">
								<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultFour" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultFour">
									<i class="icon wb-book" aria-hidden="true"></i> Educational Background
								</a>
							</div>
							<div class="panel-collapse collapse" id="exampleCollapseDefaultFour" aria-labelledby="exampleHeadingDefaultFour" role="tabpanel">
								<br>
								<div class="panel-heading">
									<div class="panel-actions panel-actions-keep">
										<a class="panel-action icon wb-expand" data-toggle="panel-fullscreen" aria-hidden="true"></a>
									</div>
								</div>
								<div class="panel-body" style="height: 30%;overflow-y: auto;">
									<h4>Secondary School</h4>
									<!-- Third Left -->
									<div class="col-xl-12 col-lg-12 col-md-12 col-xs-12" id="ecommerceRecentOrder">
										<div class="card card-shadow table-row">
											<div class="card-block bg-white table-responsive">
												<table class="table table-hover table-borderless">
													<thead class="table-active">
														<tr>
															<th>Name</th>
															<th>Entry Year</th>
															<th>Year Completed</th>
															<th>Degree Obtained</th>
														</tr>
													</thead>
													<tbody>
														<?php if(count($eds) > 0): ?>
														<?php $__currentLoopData = $eds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ed): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<tr>
															<td><?php echo e($ed->name); ?></td>
															<td><?php echo e($ed->start_year); ?></td>
															<td><?php echo e($ed->end_year); ?></td>
															<td>
																<?php if(count($gradeDocs) > 0): ?>
																<?php $__currentLoopData = $gradeDocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<?php if($ed->degree == $grade->id): ?>
																<?php echo e($grade->docname); ?>

																<?php endif; ?>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
																<?php endif; ?>
															</td>
														</tr>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														<?php else: ?>
														<?php endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- End Third Left -->
									<h4>Higher Institution</h4>
									<!-- Third Left -->
									<div class="col-xl-12 col-lg-12 col-md-12 col-xs-12" id="ecommerceRecentOrder">
										<div class="card card-shadow table-row">
											<div class="card-block bg-white table-responsive">
												<table class="table table-hover table-borderless">
													<thead class="table-active">
														<tr>
															<th>Name</th>
															<th>Course</th>
															<th>Degree Obtained</th>
															<th>Degree Class</th>
															<th>Country</th>
															<th>Entry Year</th>
															<th>Year Completed</th>
														</tr>
													</thead>
													<tbody>
														<?php if(count($edIs) > 0): ?>
														<?php $__currentLoopData = $edIs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eds): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<tr>
															<td><?php echo e($eds->name); ?></td>
															<td><?php echo e($eds->course); ?></td>
															<td>
																<?php for($degindex = 1; $degindex <= count($degrees); $degindex++): ?>
																<?php if($eds->degree == $degindex): ?>
																<?php echo e($degrees[$degindex]); ?>

																<?php endif; ?>
																<?php endfor; ?>
															</td>
															<td>
																<?php for($gradeindex = 1; $gradeindex <= count($gradesClass); $gradeindex++): ?>
																<?php if($eds->degree_class == $gradeindex): ?>
																<?php echo e($gradesClass[$gradeindex]); ?>

																<?php endif; ?>
																<?php endfor; ?>
															</td>
															<td>
																<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<?php if($eds->country_id == $country->id): ?>
																<?php echo e($country->country); ?>

																<?php endif; ?>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
															</td>
															<td>
																<?php echo e($eds->start_year); ?>

															</td>
															<td>
																<?php echo e($eds->end_year); ?>

															</td>
														</tr>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														<?php else: ?>
														<?php endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- End Third Left -->
									<div class="h-200">
										
									</div>
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-heading" id="exampleHeadingDefaultFive" role="tab">
								<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultFive" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultFive">
									<i class="icon wb-library" aria-hidden="true"></i> O'Level
								</a>
							</div>
							<div class="panel-collapse collapse" id="exampleCollapseDefaultFive" aria-labelledby="exampleHeadingDefaultFive" role="tabpanel">
								<br>
								<div class="panel-heading">
									<div class="panel-actions panel-actions-keep">
										<a class="panel-action icon wb-expand" data-toggle="panel-fullscreen" aria-hidden="true"></a>
									</div>
								</div>
								<div class="panel-body" style="height: 50%;overflow-y: auto;">
									<!-- Third Left -->
									<div class="col-xl-12 col-lg-12 col-md-12 col-xs-12" id="ecommerceRecentOrder">
										<div class="card card-shadow table-row">
											<div class="card-header card-header-transparent p-y-20">
												<div class="btn-group dropdown">
													<a href="#" class="text-body dropdown-toggle blue-grey-700" data-toggle="dropdown">EXAM TYPE</a>
													<div class="dropdown-menu animate" role="menu">
														<?php if(count($xamolevel) > 0): ?>
														<?php $__currentLoopData = $xamolevel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $takens): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<?php $name =  app('App\Repositories\JobRepository')->getDocumentTypes($takens->exam_id); ?>
														<a class="dropdown-item prevxam" href="javascript:void(0)" role="menuitem" exam="<?php echo e($takens->exam_id); ?>">
															<?php echo e($name['docname']); ?>

														</a>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="card-block bg-white table-responsive">
												<input type="hidden" name="_preview_csrf" id="_preview_csrf" value="<?php echo e(csrf_token()); ?>">
												<table class="table table-hover table-borderless" id="oleveltable">
													<thead class="table-active">
														<tr>
															<th>Subject</th>
															<th>Grade</th>
														</tr>
													</thead>
													<tbody id="olevelbody">
														<!--<tr>
															<td>Mathematics</td>
															<td>iMac</td>
														</tr>
														<tr>
															<td>English</td>
															<td>iPhone</td>
														</tr>
														<tr>
															<td>Chemistry</td>
															<td>apple Watch</td>
														</tr>
														<tr>
															<td>Physics</td>
															<td>mac Mouse</td>
														</tr>-->
														<tr>
															<td colspan="2">Select Exam Type To View Records.</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- End Third Left -->
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-heading" id="exampleHeadingDefaultSix" role="tab">
								<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultSix" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultSix">
									<i class="icon wb-briefcase" aria-hidden="true"></i> Employment History
								</a>
							</div>
							<div class="panel-collapse collapse" id="exampleCollapseDefaultSix" aria-labelledby="exampleHeadingDefaultSix" role="tabpanel">
								<br>
								<div class="panel-heading">
									<div class="panel-actions panel-actions-keep">
										<a class="panel-action icon wb-expand" data-toggle="panel-fullscreen" aria-hidden="true"></a>
									</div>
								</div>
								<div class="panel-body" style="height: 50%;overflow-y: auto;">
									<!-- Third Left -->
									<div class="col-xl-12 col-lg-12 col-md-12 col-xs-12" id="ecommerceRecentOrder">
										<div class="card card-shadow table-row">
											<div class="card-block bg-white table-responsive">
												<table class="table table-hover table-borderless">
													<thead class="table-active">
														<tr>
															<th>Organization</th>
															<th>Position</th>
															<th>Date Employed</th>
															<th>Till</th>
														</tr>
													</thead>
													<tbody>
														<?php if(count($emps) > 0): ?>
														<?php $__currentLoopData = $emps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<tr>
															<td><?php echo e($emp->organization); ?></td>
															<td><?php echo e($emp->position); ?></td>
															<td><?php echo e($emp->start_date); ?></td>
															<td><?php echo e($emp->end_date); ?></td>
														</tr>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														<?php endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- End Third Left -->
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-heading" id="exampleHeadingDefaultSeven" role="tab">
								<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultSeven" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultSeven">
									<i class="icon wb-graph-up" aria-hidden="true"></i> Professional History
								</a>
							</div>
							<div class="panel-collapse collapse" id="exampleCollapseDefaultSeven" aria-labelledby="exampleHeadingDefaultSeven" role="tabpanel">
								<br>
								<div class="panel-heading">
									<div class="panel-actions panel-actions-keep">
										<a class="panel-action icon wb-expand" data-toggle="panel-fullscreen" aria-hidden="true"></a>
									</div>
								</div>
								<div class="panel-body" style="height: 50%;overflow-y: auto;">
									<!-- Third Left -->
									<div class="col-xl-12 col-lg-12 col-md-12 col-xs-12" id="ecommerceRecentOrder">
										<div class="card card-shadow table-row">
											<div class="card-block bg-white table-responsive">
												<table class="table table-hover table-borderless">
													<thead class="table-active">
														<tr>
															<th>Organization</th>
															<th>Date Joined</th>
															<th>Till</th>
															<th>Membership Mode</th>
															<th>Membership Number</th>
														</tr>
													</thead>
													<tbody>
														<?php if(count($profs) > 0): ?>
														<?php $__currentLoopData = $profs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profHis): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<tr>
															<td><?php echo e($profHis->body); ?></td>
															<td><?php echo e($profHis->date_joined); ?></td>
															<td><?php echo e($profHis->till); ?></td>
															<td>
																<?php for($mi = 1; $mi <= count($modes); $mi++): ?>
																<?php if($profHis->mode == $mi): ?>
																<?php echo e($modes[$mi]); ?>

																<?php endif; ?>
																<?php endfor; ?>
															</td>
															<td><?php echo e($profHis->prof_number); ?></td>
														</tr>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														<?php endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- End Third Left -->
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-heading" id="exampleHeadingDefaultEight" role="tab">
								<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultEight" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultEight">
									<i class="icon wb-hammer" aria-hidden="true"></i> Skills and Training
								</a>
							</div>
							<div class="panel-collapse collapse" id="exampleCollapseDefaultEight" aria-labelledby="exampleHeadingDefaultEight" role="tabpanel">
								<br>
								<div class="panel-heading">
									<div class="panel-actions panel-actions-keep">
										<a class="panel-action icon wb-expand" data-toggle="panel-fullscreen" aria-hidden="true"></a>
									</div>
								</div>
								<div class="panel-body" style="height: 50%;overflow-y: auto;">
									<!-- Third Left -->
									<div class="col-xl-4 col-lg-4 col-md-12 col-xs-12" id="ecommerceRecentOrder">
										<div class="card card-shadow table-row">
											<div class="card-block bg-white table-responsive">
												<table class="table table-hover table-borderless">
													<thead class="table-active">
														<tr>
															<th>Skill</th>
															<th>Proficiency Level</th>
														</tr>
													</thead>
													<tbody>
														<?php if(count($skills) > 0): ?>
														<?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skillHis): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<tr>
															<td>
																<?php $__currentLoopData = $jobskills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobskill): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<?php if($skillHis->skill_id == $jobskill->id): ?>
																<?php echo e($jobskill->skill); ?>:
																<?php endif; ?>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
															</td>
															<td>
																<?php $__currentLoopData = $competencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competence): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<?php if($skillHis->proficiency_id == $competence->id): ?>
																<?php echo e($competence->proficiency); ?>

																<?php endif; ?>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
															</td>
														</tr>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														<?php endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- End Third Left -->
									<!-- Third Left -->
									<div class="col-xl-8 col-lg-8 col-md-12 col-xs-12" id="ecommerceRecentOrder">
										<div class="card card-shadow table-row">
											<div class="card-block bg-white table-responsive">
												<table class="table table-hover table-borderless">
													<thead class="table-active">
														<tr>
															<th>Training</th>
															<th>Institution</th>
															<th>Start Date</th>
															<th>End Date</th>
															<th>Location</th>
														</tr>
													</thead>
													<tbody>
														<?php if(count($trainings) > 0): ?>
														<?php $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trains): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<tr>
															<td><?php echo e($trains->training_name); ?></td>
															<td><?php echo e($trains->institution); ?></td>
															<td><?php echo e($trains->start_date); ?></td>
															<td><?php echo e($trains->end_date); ?></td>
															<td><?php echo e($trains->location); ?></td>
														</tr>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														<?php endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- End Third Left -->
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-heading" id="exampleHeadingDefaultNine" role="tab">
								<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultNine" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultNine">
									<i class="icon wb-users" aria-hidden="true"></i> References 
								</a>
							</div>
							<div class="panel-collapse collapse" id="exampleCollapseDefaultNine" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
								<br>
								<div class="panel-heading">
									<div class="panel-actions panel-actions-keep">
										<a class="panel-action icon wb-expand" data-toggle="panel-fullscreen" aria-hidden="true"></a>
									</div>
								</div>
								<div class="panel-body" style="height: 50%;overflow-y: auto;">
									<!-- Third Left -->
									<div class="col-xl-12 col-lg-12 col-md-12 col-xs-12" id="ecommerceRecentOrder">
										<div class="card card-shadow table-row">
											<div class="card-block bg-white table-responsive">
												<table class="table table-hover table-borderless">
													<thead class="table-active">
														<tr>
															<th>Title</th>
															<th>Name</th>
															<th>Profession</th>
															<th>Address</th>
															<th>City</th>
															<th>State</th>
															<th>Country</th>
															<th>E-Mail</th>
															<th>Phone</th>
														</tr>
													</thead>
													<tbody>
														<?php if(count($refs) > 0): ?>
														<?php $__currentLoopData = $refs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refHis): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<tr>
															<td>
																<?php for($j = 1; $j <= count($refTitle); $j++): ?>
																<?php if($refHis->ref_title == $j): ?>
																<?php echo e($refTitle[$j]); ?>

																<?php endif; ?>
																<?php endfor; ?>
															</td>
															<td><?php echo e($refHis->ref_name); ?></td>
															<td><?php echo e($refHis->ref_prof); ?></td>
															<td><?php echo e($refHis->ref_addr); ?></td>
															<td><?php echo e($refHis->ref_city); ?></td>
															<td>
																<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<?php if($refHis->ref_state_id == $state->id): ?>
																<?php echo e($state->state); ?>

																<?php endif; ?>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
															</td>
															<td>
																<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<?php if($refHis->ref_country_id == $country->id): ?>
																<?php echo e($country->country); ?>

																<?php endif; ?>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
															</td>
															<td><?php echo e($refHis->ref_email); ?></td>
															<td><?php echo e($refHis->ref_phone); ?></td>
														</tr>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														<?php endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- End Third Left -->
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-heading" id="exampleHeadingDefaultTen" role="tab">
								<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultTen" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultTen">
									<i class="icon wb-plus" aria-hidden="true"></i> Additional Information
								</a>
							</div>
							<div class="panel-collapse collapse" id="exampleCollapseDefaultTen" aria-labelledby="exampleHeadingDefaultTen" role="tabpanel">
								<br>
								<div class="panel-heading">
									<div class="panel-actions panel-actions-keep">
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
						<?php $jobCompStat = app('App\Repositories\JobRepository')->checkJobComplete(Auth::user()->id, $jobid); ?>
						<?php if($jobCompStat['status'] == 0): ?>
						<div style="height: 20px;">
							
						</div>
						<div class="col-md-12">
							<button type="button" class="btn btn-success btn-raised" data-toggle="modal" data-target="#finalsubmission">Finalize</button>
						</div>
						<?php endif; ?>
					</div>
					<!-- End Example Default Accordion -->
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade modal-3d-flip-vertical modal-warning" id="finalsubmission" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">Final Copy</h4>
						</div>
						<div class="modal-body">
							<div class="row row-lg">
								<div class="col-md-12">
									<h4>Make sure your information on this page is correct. After final submission, you will not be able to make any more changes</h4>
								</div>
								<div class="col-md-12">

								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success m-x-5" onclick="completeRegistration()"><i class="icon wb-check-circle"></i> Yes! Am Through</button>
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon wb-arrow-left"></i> No! I'm not done.</button>
							<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="icon wb-close"></i> Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End Modal -->
		</div>
	</div>
	<?php if(count($subjects) > 0): ?>
	<?php $sjc = 1; ?>
	<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	<input type="hidden" name="subjecthelp<?php echo e($sjc); ?>" id="subjecthelp<?php echo e($sjc); ?>" subjectid="<?php echo e($subject->id); ?>" value="<?php echo e($subject->subject); ?>">
	<?php $sjc+=1; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	<input type="hidden" name="subjectcount" id="subjectcount" value="<?php echo e(count($subjects)); ?>">
	<?php endif; ?>

	<?php if(count($grades) > 0): ?>
	<?php $grdc = 1; ?>
	<?php $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	<input type="hidden" name="gradehelp<?php echo e($grdc); ?>" id="gradehelp<?php echo e($grdc); ?>" gradeid="<?php echo e($grade->id); ?>" value="<?php echo e($grade->grade); ?>">
	<?php $grdc+=1; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	<input type="hidden" name="gradecount" id="gradecount" value="<?php echo e(count($grades)); ?>">
	<?php endif; ?>
	<script type="text/javascript">
		function completeRegistration()
		{
			var token = $("#_preview_csrf").val();
			var jobid = $("#jobid").val();
			var formData = {'_token':token, 'type':15, 'opcode':1, 'jobid':jobid};
			$.post("/job", formData, function(data,xhr,status){
				if(data == 1)
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
					toastr["success"]("Registration Complete. You will be notified when your application has been processed.", "Success", toastr.options);
					location.reload();
				}
				else
				{
					swal("Failed!", "Unfortunately! Your registration could not be finalized at the moment. Please try again.", "error");
				}
			});
		}

		$(function(){
			$(".prevxam").click(function(){
				var subjectname = '';
				var gradename = '';
				var totalsubjects = $("#subjectcount").val();
				var gradetotal    = $("#gradecount").val();
				var exam_id = $(this).attr('exam');
				var token   = $("#_preview_csrf").val();
				var formData = {'selected':exam_id, '_token':token};
				$.get('/job/subjects', formData, function(data,xhr,status){
					if(data.length >= 1 && data.length == 6)
					{
						var response;
						$("#olevelbody").html("");
						$.each(data, function(i, item){
							for(var i = 1; i <= totalsubjects; i++)
							{
								var id = $("#subjecthelp"+i).attr('subjectid');
								if(id == item.subject_id)
								{
									subjectname = $("#subjecthelp"+i).val();
								}
							}
							for(var i = 1; i <= gradetotal; i++)
							{
								var gradeid = $("#gradehelp"+i).attr('gradeid');
								if(gradeid == item.grade_id)
								{
									gradename = $("#gradehelp"+i).val();
								}
							}
							response += '<tr>'
							+ '<td>'+subjectname+'</td>'
							+ '<td>'+gradename+'</td>'
							+ '</tr>'
						});
						$("#olevelbody").append(response);

					}
					else if(data.length < 6)
					{
						swal("Incomplete Record", "Your record was not properly updated to the server. Please delete and try again.", "error");
					}
					else
					{
						swal("Not Found", "No result found", "warning");
					}
				});
			});
		});
	</script>