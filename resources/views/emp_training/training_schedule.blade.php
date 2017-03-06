@include('layouts.header', ['page_title' => 'Training Schedules FY'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Training Schedules FY</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        <div class="panel-body container-fluid">
          <div class="calendar-container">
            <div id="calendar"></div>            
            <input type="hidden" name="_token" id="calendar_token" value="<?php echo csrf_token(); ?>">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="showEventDetails" aria-hidden="true" aria-labelledby="showEventDetails"
        role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <form class="modal-content form-horizontal" action="#" method="post" role="form">
              <div class="modal-header">
                <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="training_title">Training Title</h4>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label class="col-xs-12 col-md-3"><b>Training Period:</b></label>
                  <label class="col-md-9 col-xs-12" id="training_period">Training Period</label>                  
                </div>
                <div class="form-group row">
                  <label class="col-xs-12 col-md-3"><b>Training Location:</b></label>
                  <label class="col-md-9 col-xs-12" id="training_location">Training Location</label>                  
                </div>
                <div class="form-group row">
                  <label class="col-xs-12 col-md-3"><b>Capacity:</b></label>
                  <label class="col-md-9 col-xs-12" id="training_capacity">Capacity</label>                  
                </div>
                <div class="form-group row">
                  <label class="col-xs-12 col-md-3"><b>Enrollment Status:</b></label>
                  <label class="col-md-9 col-xs-12" id="training_status">Enrollment Status</label>                  
                </div>
              </div>
              
            </form>
          </div>
        </div>
  
  <!-- Footer -->
  @include('layouts.footer')
  <script src="{{ URL::asset('js/Calendar.js') }}"></script>
