<div class="modal fade modal-danger modal-rotate-from-left" id="leave" aria-labelledby="exampleModalTitle" role="dialog"   style="display: none;" aria-hidden="true">

                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">{{_t('Add Leave Types')}}</h4>
                        </div>
                        <div class="modal-body">
                        <p>{{_t('Action Type')}}</p>
						<select data-plugin="select2" id="actiontypel">
						
						<option >--{{_t('Select Action')}}--</option>
						<option value="edit">{{_t('Edit Leave Type')}}</option>
						<option value="add">{{_t('Add Leave Type')}}</option>
						<option value="pub">{{_t('Add Holiday')}}</option>
						<option value="editpub">{{_t('Edit Holiday')}}</option>
						
						</select>
						<br>
						
						<!-- aDD aCTION -->
						<div id="addl">
						 <p>{{_t('Leave Type')}}</p>
						<input type="text" placeholder="Enter query Type .." class="form-control" id="qtypel" /><br>
						
						<p>{{_t('Number of Day')}}</p>
						 <input type="number" class="form-control" id="qtemplatel" >
									
									<br>
						
						</div>
						
						<div id="addps">
						 <p>{{_t('Holiday Name')}}</p>
						<input type="text" placeholder="Enter holiday name" class="form-control" id="holname" /><br>
						
						<p>{{_t('Duration')}}</p>
						 		<div class="example">
                  <div class="input-daterange" data-plugin="datepicker">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon wb-calendar" aria-hidden="true"></i>
                      </span>
                      <input type="text" id="holfrom" class="form-control" name="start">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">{{_t('to')}}</span>
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
								 @if(count($holidays)>0)
									 @foreach($holidays as $types)
				
								<input type="hidden" value="{{$types->start_date}}"  id="phfrom{{$types->id}}">
				<input type="hidden" value="{{$types->end_date}}"  id="phto{{$types->id}}">
								
								@endforeach
								@endif
				
			 <select id="qtype1lp" data-plugin="select2" type="text" class="form-control" >
								  <option value="0">-{{_t('Select Holiday Name')}}-</option>
								
								 @if(count($holidays)>0)
									 @foreach($holidays as $types)
				
				<option value="{{$types->id}}">{{$types->title}}</option>
									@endforeach
								  @endif
			 </select><br>
						 <p>{{_t('Holiday Name')}}</p>
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
                      <span class="input-group-addon">{{_t('to')}}</span>
                      <input type="text" id="modholto" class="form-control" name="end"  disabled>
                    </div>
                  </div>
                </div>
									<br>
						
						</div>
						
						
						
						<!-- EDIT ACTION -->
						<div id="editl">
						
						<div class="col-xl-4 col-xs-12">
							<b>{{_t('Select Leave Types')}}:</b>
							</div>
                              <div class="col-xs-12 col-xl-8 form-group">
							     @if(count($leaves)>0)
									 @foreach($leaves as $types) 
							     <input type="hidden" value="{{$types->days}}" id="{{$types->id}}l"/>
								 @endforeach
								  @endif
								  
						         <select id="qtype1l" data-plugin="select2" type="text" class="form-control" >
								  <option value="0">-{{_t('Select Leave Type')}}-</option>
								
								 @if(count($leaves)>0)
									 @foreach($leaves as $types)
								
								  <option value="{{$types->id}}">{{$types->name}}</option>
									@endforeach
								  @endif
								 </select>
								


						</div>
						
							<b>{{_t('Title')}}:</b><br>
							 
							      <input type="text" id="qtitledeitl" class="form-control" disabled>
							    
						       <br>
								
							  <div class="" id="tpanel">
							      <input type="number" min="0"  class="form-control" id="qtemplate1l" disabled>
									
							    
						       
								
                               
                              </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">{{_t('Close')}}</button>
                          <button type="button" id="saveqtemplatel" class="btn btn-primary">{{_t('Save changes')}}</button>
						  <button type="button" id="modifyqtemplatel" class="btn btn-primary" disabled>{{_t('Save changes')}}</button>
						  <button type="button" id="savehols" class="btn btn-primary" >{{_t('Save changes')}}</button>
						  <button type="button" id="savemodhols" class="btn btn-primary" >{{_t('Save changes')}}</button>
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
                          <h4 class="modal-title">{{_t('Attach Leave Day To Job Role')}}</h4>
                        </div>
                        <div class="modal-body">
                         <p>{{_t('Job Role')}}</p>
						<select data-plugin="select2" id="jobrole">
						
						<option >--{{_t('Select Role')}}--</option>
						<option value="4">{{_t('Casual')}}</option>
						<option value="1">{{_t('Employee')}}</option>
						<option value="2">{{_t('Line Manager')}}</option>
						<option value="3">{{_t('Admin HR')}}</option> 
						</select>
						<br>
						 <p>{{_t('Allowable Leave Day')}}</p>
						 <input type="text" class="form-control" id="leaveday" />
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">{{_t('Close')}}</button>
                          <button type="button" class="btn btn-primary" id="saveattach">{{_t('Save changes')}}</button>
                        </div>
                      </div>
                    </div>
                  </div>



<!-- QUERY SETTINGS ENDS -->
<!-- MODALS ENDS -->

<!-- here modal importemp -->

