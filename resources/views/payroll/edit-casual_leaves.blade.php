<?php $title = 'Update No. of Casual Leaves'; ?>
@include('layouts.header', ['page_title' => $title])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">{{ $title }}</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        
        <div class="panel-body container-fluid">
          <div class="row row-lg col-xs-12"> 
          @if (session('success'))
                <div class="flash-message">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                </div>
            @endif
            @if (session('error'))
                <div class="flash-message">
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                </div>
            @endif                     
          <form class="form-horizontal" role="form" method="POST" action="{{ url('update_casual_leaves') }}" enctype="multipart/form-data">
            {{ csrf_field() }}   
            <div class="col-xs-6">    
              <div class="form-group col-xs-12">
                <div class="col-xs-4"><h4>Job Role</h4></div>
                <div class="col-xs-8"><h4>Casual Leaves / Month</h4></div>
              </div>               
             @foreach ($casual_leaves_details as $casual_leaves_det)

             <div class="form-group col-xs-12">
                <div class="col-xs-4">
                  <h4 class="example-title">
                  <?php
                    if($casual_leaves_det->job_role==Config::get('constants.roles.Admin_User'))
                      echo 'Admin';
                    if($casual_leaves_det->job_role==Config::get('constants.roles.People_Manager'))
                      echo 'People Manager';
                  if($casual_leaves_det->job_role==Config::get('constants.roles.Employee'))
                      echo 'Employee';
                  if($casual_leaves_det->job_role==Config::get('constants.roles.Doctor'))
                      echo 'Doctor';
                  if($casual_leaves_det->job_role==Config::get('constants.roles.Factory_Employee'))
                      echo 'Factory Employee';
                  ?> <span class="required_filed">*</span></h4></div>
                  <div class="col-xs-8">
                  <input id="job_role" class="form-control" name="job_role[]" type="hidden" value="{{$casual_leaves_det->job_role}}">
                    <input id="num_of_leaves" class="form-control" name="num_of_leaves{{$casual_leaves_det->job_role}}" type="text" value="{{ old('num_of_leaves'.$casual_leaves_det->job_role)!='' ? old('num_of_leaves'.$casual_leaves_det->job_role) : ((isset($casual_leaves_det) && $casual_leaves_det->num_of_leaves!='') ? $casual_leaves_det->num_of_leaves : '') }}">
                  @if ($errors->has('num_of_leaves'.$casual_leaves_det->job_role))
                    <br/><div class="flash-message">
                      <div class="alert alert-danger">
                        <strong>{{ $errors->first('num_of_leaves'.$casual_leaves_det->job_role) }}</strong>
                      </div>
                    </div>
                  @endif 
                  </div>
              </div>
            @endforeach
              
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>
            <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="submit" class="btn btn-primary waves-effect" value="Save"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'edit-casual_leaves';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>          
          </form>
          </div>
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