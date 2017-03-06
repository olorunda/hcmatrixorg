@include('layouts.header', ['page_title' => 'Daily Attendances'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Daily Attendances</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        <div class="panel-body container-fluid">
			@if (session('success'))
                <div class="flash-message">
                <div class="alert alert-success">
                   {{ session('success') }} 
                </div>
                </div>
            @endif
            <div id="update-alert" style="display:none;">
                <div class="flash-message">
                    <div class="alert alert-success">
                        Employee Calendar Updated successfully! <small> Refresh the page to see changes</small>
                    </div>
                </div>
            </div>
            <div id="save-alert" style="display:none;">
                <div class="flash-message">
                    <div class="alert alert-success">
                        Employee Calendar Saved successfully! <small> Refresh the page to see changes</small>
                    </div>
                </div>
            </div>
          <div class="calendar-container">
            <div id="day_att_emp_calendar"></div>            
            <input type="hidden" name="_token" id="calendar_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $emp_id; ?>">
          </div>
            @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
              <button class="btn btn-sm btn-info waves-effect" type="button" onclick ="btn_back('admin');"><- Back</button>
            @elseif(Auth::user()->role==Config::get('constants.roles.People_Manager'))
              <button class="btn btn-sm btn-info waves-effect" type="button" onclick ="btn_back('poepleManager');"><- Back</button>
            @else
              <button class="btn btn-sm btn-info waves-effect" type="button" onclick ="btn_back('employee');"><- Back</button>
            @endif
        </div>
      </div>
    </div>
  </div>
  <!-- save event details modal start -->
  <div class="modal fade" id="saveEventDetails" aria-hidden="true" aria-labelledby="saveEventDetails"
        role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <form class="modal-content form-horizontal" name="fmsave" id="fmsave" action="#" method="post" role="form">
                {{ csrf_field() }}
              <div class="modal-header">
                <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                <h4 class="modal-title">Daily Attendance Details</h4>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label class="col-xs-12 col-md-4"><b>Attendance Status:</b></label>
                  <label class="col-md-8 col-xs-12" id="att_title">Attendance Title</label>                  
                </div>
                <div class="form-group row">
                  <label class="col-xs-12 col-md-4"><b>Attendance Date:</b></label>
                  <label class="col-md-8 col-xs-12" id="att_date">Attendance Date</label>                  
                </div>
                  <div class="form-group row">
                    <input type="hidden" name="save_emp_id" id="save_emp_id" value="">
                    <input type="hidden" name="save_emp_num" id="save_emp_num" value="">
                    <input type="hidden" name="save_att_date" id="save_att_date" value="">
                    <div class="col-xs-12"><span class="no-left-padding"><input type="button" class="btn btn-primary waves-effect" value="Make it present" onclick="savesubmit();"></span>
                    <span class="no-left-padding text-xs-left"><input type="button" class="btn btn-default waves-effect" value="Cancel" data-dismiss="modal"></span></div>
                  </div>
                <!--<div class="form-group row">
                  <label class="col-xs-12 col-md-4"><b>Attendance In-time:</b></label>
                  <label class="col-md-8 col-xs-12" id="att_intime">Attendance In-time</label>                  
                </div>
                <div class="form-group row">
                  <label class="col-xs-12 col-md-4"><b>Attendance Out-time:</b></label>
                  <label class="col-md-8 col-xs-12" id="att_outtime">Attendance Out-time</label>                  
                </div>-->
              </div>
              
            </form>
          </div>
        </div>
  <!-- save event details modal end -->
  
  <!-- edit event details modal start -->
  <div class="modal fade" id="EditEventDetails" aria-hidden="true" aria-labelledby="EditEventDetails"
        role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <form class="modal-content form-horizontal" name="fmupdate" id="fmupdate" action="{{ url('daily-attendance-emp-update') }}" method="post" role="form">
                 {{ csrf_field() }}
              <div class="modal-header">
                <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                <h4 class="modal-title">Daily Attendance Edit</h4>
              </div>
              <div class="modal-body">
			  <table class="table table-stripped">
					<tr>
					<td><b>Attendance Status:</b></td>
					<td id="edit_att_title">Present</td>
					</tr>
					<tr>
					<td><b>Attendance Date:</b></td>
					<td id="edit_att_date">Attendance Date</td>
					</tr>
					<tr>
					<td><b>Attendance In-time:</b></td>
					<td id="edit_att_intime">Attendance In-time</td>
					</tr>
					<tr>
					<td><b>Attendance Out-time:</b></td>
					<td id="edit_att_outtime">Attendance Out-time</td>
					</tr>
			  
			  
			  </table>
                   
                  <!--<div class="form-group">
                    <h4 class="example-title">Permission time to be included in</h4>
                    <select class="form-control" id="permission_id" name="permission_id">
                      <option value = ''>Select</option>
                      <option value = 'intime'>In-time</option>
                      <option value = 'outtime'>Out-time</option>
                      </select>                 
                  </div>
                 <div class="form-group">
                    <h4 class="example-title">Select minutes</h4>
                    <select class="form-control" id="minute_id" name="minute_id">
                      <option value = ''>Select</option>
                      <option value = '10'>10 mins</option>
                      <option value = '20'>20 mins</option>
                      <option value = '30'>30 mins</option>
                      </select>                 
                  </div>  -->
                  
                  <div class="input-append bootstrap-timepicker-component">Enter In-time : &nbsp;
                    <input type="time" name="intime" data-plugin="clockpicker" class="form-control" value="9:00 am"/>     
                    <span class="add-on">              
                    </span>
                  </div>
                      
                  <div class="clearfix hidden-sm-down hidden-lg-up"></div>
                 
                  <br>
                  <div class="form-group row">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="ex_intime" id="ex_intime" value="">
                    <div class="col-xs-12"><span class="no-left-padding"><input type="button" class="btn btn-primary waves-effect" value="Update" onclick="fnsubmit();"></span>
                    <span class="no-left-padding text-xs-left"><input type="button" class="btn btn-default waves-effect" value="Cancel" data-dismiss="modal"></span></div>
                  </div>
               
                 
              </div>
              
            </form>
          </div>
        </div>
  <!-- edit event details modal end -->
  <!-- Footer -->
  @include('layouts.footer')
<script src="{{ URL::asset('js/DailyAttendanceEmpCalendar.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap-timepicker.js') }}"></script>
<script>  

//page redirect
  function btn_back(type)
  {
      if(type == 'admin') {
        window.location = "{{ url('employee/list')}}";
    } else if(type == 'poepleManager') {
        window.location = "{{ url('employee/list')}}";
    } else {
        window.location = "{{ url('/daily-attendance')}}";
    }
  }
  $('.timepicker-default').timepicker({
      //template:'modal'
  });
  //$("#update-alert").show();
function fnsubmit()
  {
      
      $("#update-alert").hide();
      $("#save-alert").hide();
    $.ajax({
        type: "POST",
        url: "{{ url('daily-attendance-emp-update') }}",
        data: $("#fmupdate").serialize(),
        dataType: "json", 
        
          success: function(response){ 
              $('#EditEventDetails').modal('hide');
              $("#update-alert").show();
              $('#day_att_emp_calendar').fullCalendar('refresh');
              location.reload();
          
        }     
      });
  }
  
  function savesubmit()
  {
      
      $("#update-alert").hide();
      $("#save-alert").hide();
    $.ajax({
        type: "POST",
        url: "{{ url('daily-attendance-emp-save') }}",
        data: $("#fmsave").serialize(),
        dataType: "json", 
        
          success: function(response){ 
              $('#saveEventDetails').modal('hide');
              $("#save-alert").show();
              $('#day_att_emp_calendar').fullCalendar('refresh');
              location.reload();
          
        }     
      });
  }
</script>