@include('layouts.header', ['page_title' => 'Daily Attendances'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Daily Attendances</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        <div class="panel-body container-fluid">
          <div class="calendar-container">
            <div id="daily_attendance_calendar"></div>            
            <input type="hidden" name="_token" id="calendar_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $emp_id; ?>">
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
                <h4 class="modal-title">Daily Attendance Details</h4>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label class="col-xs-12 col-md-4"><b>Attendance Date:</b></label>
                  <label class="col-md-8 col-xs-12" id="att_date">Attendance Date</label>                  
                </div>
                <div class="form-group row">
                  <label class="col-xs-12 col-md-4"><b>Attendance In-time:</b></label>
                  <label class="col-md-8 col-xs-12" id="att_intime">Attendance In-time</label>                  
                </div>
                <div class="form-group row">
                  <label class="col-xs-12 col-md-4"><b>Attendance Out-time:</b></label>
                  <label class="col-md-8 col-xs-12" id="att_outtime">Attendance Out-time</label>                  
                </div>
              </div>
              
            </form>
          </div>
        </div>
  
  <!-- Footer -->
  @include('layouts.footer')
<script src="{{ URL::asset('js/DailyAttendanceCalendar.js') }}"></script>
