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
		@if(Auth::user()->job_reg_status == 0)
		<div class="ribbon ribbon-clip ribbon-reverse ribbon-success">
			<span class="ribbon-inner" data-toggle="modal" data-target="#finalsubmission">
				Final Copy
			</span>
		</div>
		@endif
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
												@if(count($bios) > 0)
												{{$bios->name}}
												@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">Date of Birth: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												@if(count($bios) > 0)
												{{$bios->dob}}
												@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">Sex: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												@if(count($bios) > 0)
												@if($bios->sex == "F")
												Female
												@else
												Male
												@endif
												@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">Phone Number: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												@if(count($bios) > 0)
												{{$bios->phone_num}}
												@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">E-Mail: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												@if(count($bios) > 0)
												{{$bios->email}}
												@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">Marital Status: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												@if(count($bios) > 0)
												@if($bios->marital_status == "single")
												Single
												@else
												Married
												@endif
												@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">State of Origin: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												@foreach($states as $state)
												@if($bios->state_origin_id == $state->id)
												{{$state->state}}
												@endif
												@endforeach
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">Local Government Area: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												@if(count($bios) > 0)
												{{$bios->lga}}
												@endif
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
												@if(count($corrs) > 0)
												{{$corrs->street}}
												@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">City: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												@if(count($corrs) > 0)
												{{$corrs->city}}
												@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xs-12 col-md-3 form-control-label">State: </label>
											<div class="col-md-9 col-xs-12 m-t-5">
												@if(count($corrs) > 0)
												@foreach($states as $state)
												@if($corrs->state_id == $state->id)
												{{$state->state}}
												@endif
												@endforeach
												@endif
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
														@if(count($eds) > 0)
														@foreach($eds as $ed)
														<tr>
															<td>{{ $ed->name }}</td>
															<td>{{ $ed->start_year }}</td>
															<td>{{ $ed->end_year }}</td>
															<td>
																@if(count($gradeDocs) > 0)
																@foreach($gradeDocs as $grade)
																@if($ed->degree == $grade->id)
																{{ $grade->docname }}
																@endif
																@endforeach
																@endif
															</td>
														</tr>
														@endforeach
														@else
														@endif
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
														@if(count($edIs) > 0)
														@foreach($edIs as $eds)
														<tr>
															<td>{{ $eds->name }}</td>
															<td>{{ $eds->course }}</td>
															<td>
																@for($degindex = 1; $degindex <= count($degrees); $degindex++)
																@if($eds->degree == $degindex)
																{{$degrees[$degindex]}}
																@endif
																@endfor
															</td>
															<td>
																@for($gradeindex = 1; $gradeindex <= count($gradesClass); $gradeindex++)
																@if($eds->degree_class == $gradeindex)
																{{$gradesClass[$gradeindex]}}
																@endif
																@endfor
															</td>
															<td>
																@foreach($countries as $country)
																@if($eds->country_id == $country->id)
																{{$country->country}}
																@endif
																@endforeach
															</td>
															<td>
																{{ $eds->start_year }}
															</td>
															<td>
																{{ $eds->end_year }}
															</td>
														</tr>
														@endforeach
														@else
														@endif
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
														@if(count($xamolevel) > 0)
														@foreach($xamolevel as $takens)
														<?php $name =  app('App\Repositories\JobRepository')->getDocumentTypes($takens->exam_id); ?>
														<a class="dropdown-item prevxam" href="javascript:void(0)" role="menuitem" exam="{{ $takens->exam_id }}">
															{{ $name['docname'] }}
														</a>
														@endforeach
														@endif
													</div>
												</div>
											</div>
											<div class="card-block bg-white table-responsive">
												<input type="hidden" name="_preview_csrf" id="_preview_csrf" value="{{ csrf_token() }}">
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
														@if(count($emps) > 0)
														@foreach($emps as $emp)
														<tr>
															<td>{{ $emp->organization }}</td>
															<td>{{ $emp->position }}</td>
															<td>{{ $emp->start_date }}</td>
															<td>{{ $emp->end_date }}</td>
														</tr>
														@endforeach
														@endif
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
														@if(count($profs) > 0)
														@foreach($profs as $profHis)
														<tr>
															<td>{{ $profHis->body }}</td>
															<td>{{ $profHis->date_joined }}</td>
															<td>{{ $profHis->till }}</td>
															<td>
																@for($mi = 1; $mi <= count($modes); $mi++)
																@if($profHis->mode == $mi)
																{{$modes[$mi]}}
																@endif
																@endfor
															</td>
															<td>{{ $profHis->prof_number }}</td>
														</tr>
														@endforeach
														@endif
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
														@if(count($skills) > 0)
														@foreach($skills as $skillHis)
														<tr>
															<td>
																@foreach($jobskills as $jobskill)
																@if($skillHis->skill_id == $jobskill->id)
																{{$jobskill->skill}}:
																@endif
																@endforeach
															</td>
															<td>
																@foreach($competencies as $competence)
																@if($skillHis->proficiency_id == $competence->id)
																{{$competence->proficiency}}
																@endif
																@endforeach
															</td>
														</tr>
														@endforeach
														@endif
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
														@if(count($trainings) > 0)
														@foreach($trainings as $trains)
														<tr>
															<td>{{ $trains->training_name }}</td>
															<td>{{ $trains->institution }}</td>
															<td>{{ $trains->start_date }}</td>
															<td>{{ $trains->end_date }}</td>
															<td>{{ $trains->location }}</td>
														</tr>
														@endforeach
														@endif
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
														@if(count($refs) > 0)
														@foreach($refs as $refHis)
														<tr>
															<td>
																@for($j = 1; $j <= count($refTitle); $j++)
																@if($refHis->ref_title == $j)
																{{$refTitle[$j]}}
																@endif
																@endfor
															</td>
															<td>{{ $refHis->ref_name }}</td>
															<td>{{ $refHis->ref_prof }}</td>
															<td>{{ $refHis->ref_addr }}</td>
															<td>{{ $refHis->ref_city }}</td>
															<td>
																@foreach($states as $state)
																@if($refHis->ref_state_id == $state->id)
																{{$state->state}}
																@endif
																@endforeach
															</td>
															<td>
																@foreach($countries as $country)
																@if($refHis->ref_country_id == $country->id)
																{{$country->country}}
																@endif
																@endforeach
															</td>
															<td>{{ $refHis->ref_email }}</td>
															<td>{{ $refHis->ref_phone }}</td>
														</tr>
														@endforeach
														@endif
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
													@if(count($adds) > 0)
													@foreach($adds as $addFile)
													<tr>
														<th>
															<?php $docCat = app('app\Repositories\JobRepository')->getDocumentTypes($addFile->id); ?>
															{{$docCat['docname']}}
														</th>
														<th>
															<a class="text-danger" href="javascript:void(0)" id="useraddFile{{$addFile->id}}" data-toggle="tooltip" title="Delete" onclick="deleteDoc({{$addFile->id}})" style="text-decoration:none;">
																<i class="icon wb-close"></i>
															</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<a class="text-primary" href="{{asset('upload')}}/{{$addFile->document}}" target="_blank" id="useraddFile{{$addFile->id}}" data-toggle="tooltip" title="View" style="text-decoration:none;">
																<i class="icon wb-eye"></i>
															</a>
														</th>
													</tr>
													@endforeach
													@else
													<h4 class="text-center">Any File You Upload Will Be Displayed Here.</h4>
													@endif
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<?php $jobCompStat = app('App\Repositories\JobRepository')->checkJobComplete(Auth::user()->id, $jobid); ?>
						@if($jobCompStat['status'] == 0)
						<div style="height: 20px;">
							
						</div>
						<div class="col-md-12">
							<button type="button" class="btn btn-success btn-raised" data-toggle="modal" data-target="#finalsubmission">Finalize</button>
						</div>
						@endif
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
	@if(count($subjects) > 0)
	<?php $sjc = 1; ?>
	@foreach($subjects as $subject)
	<input type="hidden" name="subjecthelp{{ $sjc }}" id="subjecthelp{{ $sjc }}" subjectid="{{ $subject->id }}" value="{{ $subject->subject }}">
	<?php $sjc+=1; ?>
	@endforeach
	<input type="hidden" name="subjectcount" id="subjectcount" value="{{ count($subjects) }}">
	@endif

	@if(count($grades) > 0)
	<?php $grdc = 1; ?>
	@foreach($grades as $grade)
	<input type="hidden" name="gradehelp{{ $grdc }}" id="gradehelp{{ $grdc }}" gradeid="{{ $grade->id }}" value="{{ $grade->grade }}">
	<?php $grdc+=1; ?>
	@endforeach
	<input type="hidden" name="gradecount" id="gradecount" value="{{ count($grades) }}">
	@endif
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