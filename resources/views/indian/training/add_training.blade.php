@if(isset($id) && $id!='')  <?php $title = 'Edit Training'; ?> @else <?php $title = 'Add Training'; ?> @endif
@include('layouts.header', ['page_title' => $title])
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlc0lDbH_vAyXIw_gMUf-m6-yAQMKc8MQ&libraries=places"></script>
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">{{ $title }}</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        
        <div class="panel-body container-fluid">
          <form class="form-horizontal" role="form" method="POST" action="@if(isset($id) && $id!='') {{ url('update-training') }} @else {{ url('add-training') }} @endif">
            {{ csrf_field() }}     
          <div class="row row-lg col-xs-6">            
            <div class="col-xs-12">
              <div class="form-group">
                <?php //print_r($roles); ?>
                <h4 class="example-title">Job Role</h4>
                <select class="form-control" id="job_role" name="job_role">
                  <option value = ''>Select</option>
                    @foreach($roles as $role)  
                      @if($role->role!='' && $role->role!=0)
                        <option value = "{{ $role->role}}" {{ ((old("job_role")!='' && old("job_role") ==  $role->role) || (isset($training_details) && $training_details->job_role!='' && $training_details->job_role ==  $role->role)) ? "selected=selected":"" }}>
                          @if($role->role==Config::get('constants.roles.Admin_User')) {{'Admin'}} @endif
                          @if($role->role==Config::get('constants.roles.People_Manager')) {{'People Manager'}} @endif
                          @if($role->role==Config::get('constants.roles.Employee')) {{'Employee'}} @endif
                          @if($role->role==Config::get('constants.roles.Doctor')) {{ 'Doctor'}} @endif
                          @if($role->role==Config::get('constants.roles.Factory_Employee')) {{ 'Factory Employee'}} @endif
                        </option>
                      @endif
                    @endforeach                   
                  </select>                 
              </div>
               @if ($errors->has('job_role'))
                    <div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('job_role') }}</strong>
                      </div>
                    </div>
                  @endif  
              <div class="form-group">
                <h4 class="example-title">Training Name</h4>
             
                <input type="text" class="form-control" id="training_name" name="training_name" placeholder="Training Name" value="{{ old('training_name')!='' ? old('training_name') : ((isset($training_details) && $training_details->training_name!='') ? $training_details->training_name : '') }}">
              </div> 
              @if ($errors->has('training_name'))
                    <div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('training_name') }}</strong>
                      </div>
                    </div>
                  @endif

              <div class="form-group">
                <h4 class="example-title">Training Period</h4>               
                <div class="example">
                  <div class="input-daterange" data-plugin="datepicker">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                      </span>
                      <input type="text" class="form-control" name="start_date" id="start_date" value="{{ old('start_date')!='' ? old('start_date') : ((isset($training_details) && $training_details->start_date!='') ? date('M d, Y', strtotime($training_details->start_date)) : '') }}" />                      
                    </div>                    
                    <div class="input-group">
                      <span class="input-group-addon">to</span>
                      <input type="text" class="form-control" name="end_date" id="end_date" value="{{ old('end_date')!='' ? old('end_date') : ((isset($training_details) && $training_details->end_date!='') ? date('M d, Y', strtotime($training_details->end_date)) : '') }}" />                      
                    </div>                   
                  </div>                   
                </div>
                @if ($errors->has('start_date'))
                        <div class="flash-message">
                          <div class="alert alert-danger">
                            <strong>{{ $errors->first('start_date') }}</strong>
                          </div>
                        </div>
                      @endif
                    @if ($errors->has('end_date'))
                        <div class="flash-message">
                          <div class="alert alert-danger">
                            <strong>{{ $errors->first('end_date') }}</strong>
                          </div>
                        </div>
                      @endif
              </div>           
              <div class="form-group">
                <h4 class="example-title">Location</h4>
                <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="{{ old('location')!='' ? old('location') : ((isset($training_details) && $training_details->location!='') ? $training_details->location : '') }}">               
              </div>
               @if ($errors->has('location'))
                    <div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('location') }}</strong>
                      </div>
                    </div>
                  @endif
              <div class="form-group">
                <h4 class="example-title">Capacity</h4>
                <input type="text" class="form-control" id="capacity" name="capacity" placeholder="Capacity" value="{{ old('capacity')!='' ? old('capacity') : ((isset($training_details) && $training_details->capacity!='') ? $training_details->capacity : '') }}">               
              </div>
               @if ($errors->has('capacity'))
                    <div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('capacity') }}</strong>
                      </div>
                    </div>
                  @endif
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>
            <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="@if(isset($id) && $id!='') {{  $id }}@endif">
                <div class="text-xs-left"><span class="no-left-padding"><input type="submit" class="btn btn-primary waves-effect" value="@if(isset($id) && $id!='') {{ 'Update' }} @else {{ 'Save' }}@endif"></span>
                <span class="no-left-padding text-xs-left col-xs-3"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'trainings-list';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>

  
  </div>
  <!-- End Page -->
  <!-- Footer -->
  @include('layouts.footer')
  <script>
            function init() {
                var input = document.getElementById('location');
                var autocomplete = new google.maps.places.Autocomplete(input);
            }

            google.maps.event.addDomListener(window, 'load', init);
        </script>