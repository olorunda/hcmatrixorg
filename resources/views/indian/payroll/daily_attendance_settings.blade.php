@include('layouts.header', ['page_title' => 'Daily Attendance Settings'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Daily Attendance Settings</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        <div class="panel-body container-fluid">
          <div class="row row-lg">  
            
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
			@if (count($errors)>0)
                <div class="flash-message">
                <div class="alert alert-danger">
                    {{ $errors->first() }} 
                </div>
                </div>
            @endif 
            <div class="flash-message">
                <div class="alert alert-success" id="status_div" style="display:none;">
                    Daily Attendance Settings updated successfully!
                </div>
                </div>  
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div class="text-xs-right">
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnAddsettings()">Add New Settings</button>
                  </div>
                    <div class="clearfix"><br/></div>
                  <table class="table table-hover dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Job Role</th>
                              <th>Late by Minutes</th> 
                              <th>Late Percentage Chargeable</th>                      
                              <th>Status</th> 
                              @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
                                <th>Action</th>
                              @endif
                          </tr> 
                      </thead> 
                      <tbody> 
                          <?php $sno = 1; ?>
                            @foreach ($settings as $setting)
                            <tr>  
                                <td>{{$sno++}} </td>                                       
                                <td>
                                    @if($setting->role==Config::get('constants.roles.Admin_User')) {{'Admin'}} @endif
                                    @if($setting->role==Config::get('constants.roles.People_Manager')) {{'People Manager'}} @endif
                                    @if($setting->role==Config::get('constants.roles.Employee')) {{'Employee'}} @endif
                                    @if($setting->role==Config::get('constants.roles.Factory_Employee')) {{'Factory Employee'}} @endif
                                    @if($setting->role==Config::get('constants.roles.Doctor')) {{ 'Doctor'}} @endif
                                </td>                 
                                <td>{{$setting->late_minute}}</td>
                                <td>{{$setting->late_percentage}}</td>                                
                                <td class="actions" id="status_div_{{ $setting->id}}">@if($setting->status==0) <a onclick="fnStatusChange({{ $setting->id}},{{ $setting->status}})"><i class="btn btn-sm btn-warning waves-effect icon fa-eye-slash" aria-hidden="true"   title="Make Active"></i></a> @else <a onclick="fnStatusChange({{ $setting->id}},{{ $setting->status}})"><i class="btn btn-sm btn-success waves-effect icon fa-eye" aria-hidden="true" title="Make Inactive"></i></a> @endif</td>
                                @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
                                    <td class="actions"><a onClick="fnEditSetting({{$setting->id}})"><i class="btn btn-sm btn-primary waves-effect icon fa-edit" aria-hidden="true" title="Edit"></i></a><a onClick="fnDelete({{ $setting->id}})"><i class="btn btn-sm btn-danger waves-effect icon fa-close" aria-hidden="true" title="Delete"></i></a></td>
                                @endif
                            </tr>                            
                            @endforeach 
                      </tbody> 
                  </table>           
                </div>
              </div>          
              <!-- End Widget Timeline -->
            </div>
          </div>
        </div>
      </div> 
    </div>
  </div>
  <!-- End Page -->
  <!--- Add Settings modal start -->
  <div class="modal fade in" id="settings-modal" role="dialog">    
    <div class="modal-dialog ">
      <form class="form-horizontal" id="add_settings_form" role="form" method="POST">
        <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title" id="settings_title">Add Settings</h4>
        </div>
        <div class="modal-body">         
            {{ csrf_field() }}     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12">
              <div class="form-group">
                
                <h4 class="example-title">Job Role</h4>
                <select class="form-control" id="job_role" name="job_role">
                  <option value = ''>Select</option>
                    @foreach($roles as $role)  
                      @if($role->role!='' && $role->role!=0)
                        <option value = "{{ $role->role}}" {{ ((old("job_role")!='' && old("job_role") ==  $role->role) || (isset($settings_details) && $settings_details->role!='' && $settings_details->role ==  $role->role)) ? "selected=selected":"" }}>
                          @if($role->role==Config::get('constants.roles.Admin_User')) {{'Admin'}} @endif
                          @if($role->role==Config::get('constants.roles.People_Manager')) {{'People Manager'}} @endif
                          @if($role->role==Config::get('constants.roles.Employee')) {{'Employee'}} @endif
                          @if($role->role==Config::get('constants.roles.Factory_Employee')) {{'Factory Employee'}} @endif
                          @if($role->role==Config::get('constants.roles.Doctor')) {{ 'Doctor'}} @endif
                        </option>
                      @endif
                    @endforeach                   
                  </select>                 
              </div>
              <div id="job_role_err"></div>              
              <div class="form-group">
                <h4 class="example-title">Late by Minutes</h4>
             
                <input type="text" class="form-control" id="late_min" name="late_min" placeholder="Late by Minutes" value="{{ old('late_min')!='' ? old('late_min') : ((isset($settings_details) && $settings_details->late_minute!='') ? $settings_details->late_minute : '') }}">
              </div>  
              <div id="late_min_err"></div>
              <div class="clearfix"></div>            
              <div class="form-group">
                <h4 class="example-title">Late Percentage Chargeable</h4>
             
                <input type="text" class="form-control" id="late_percent" name="late_percent" placeholder="Late Percentage Chargeable" value="{{ old('late_percent')!='' ? old('late_percent') : ((isset($settings_details) && $settings_details->late_percent!='') ? $settings_details->late_percent : '') }}">
              </div>  
              <div id="late_percent_err"></div>
                  
              
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>            
          </div>        
        </div>
        <div class="modal-footer">
          <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="@if(isset($id) && $id!='') {{  $id }}@endif">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="button" class="btn btn-primary waves-effect" id="settings_btn" value="Save" onclick ="fndaily()"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'daily-attendance-settings';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>
       </div>
      </form>
    </div>
  </div>
  <!-- Add Settings modal end -->
  <!-- Footer -->
  @include('layouts.footer')
  <script type="text/javascript">
   $("#data_table").DataTable( {        
"aoColumnDefs": [
      { "bSearchable": false, "aTargets": [ -2, -1 ] },
      { "bSortable": false, "aTargets": [ -2, -1 ] }
    ]
    });

  function fnDelete(arg)
    {
      if(confirm("Do you really want to delete this Settings?"))
      {
        document.location.href="delete_daily_attendance_settings/"+arg;
      }
    }

    function fnStatusChange(arg,status)
    {
      $.ajax({
        type: "POST",
        url: "daily-attendance-settings-status-change",
        data: "_token=<?php echo csrf_token() ?>&id="+arg+"&status="+status,
        dataType: "json", 
        
        beforeSend: function(){ $("#status_div_"+arg).html("Updating...");},       
        success: function(response){ 
          if(response.Success==1)
          {
            $("#status_div_"+arg).html(response.status_div);
            $(".alert").css('display', 'none');
            $("#status_div").css('display', 'block');
          }
        }     
      });
    }


  //Add holiday
  function fnAddsettings()
  {
    $("#settings_title").html("Add Settings");
    $(".alert").remove();
    $("#settings_btn").val("Save");
    $("#add_settings_form")[0].reset();
    $("#settings-modal").modal("show");
  }

  //Edit holiday
  function fnEditSetting(arg)
  {
    $("#settings_title").html("Edit Settings");
    $(".alert").remove();
    $.ajax({
        type: "GET",
        url: "edit-daily-attendance-settings/"+arg,
        dataType: "json", 
        
          success: function(response){ 
          var settings_details = response.settings_details;
          //filling the old values
          
          $("#job_role").val(settings_details.role);          
          $("#late_min").val(settings_details.late_minute);
          $("#late_percent").val(settings_details.late_percentage);
          $("#id").val(settings_details.id);
          $("#settings_btn").val("Update");
          $("#settings-modal").modal("show");
          
        }     
      });
  }

  function fndaily()
    {
      var url;
      $(".alert").remove();
      if($("#id").val()!='')
          url = 'update-daily-attendance-settings';
      else
          url = 'add-daily-attendance-settings';
      //alert(url);
      $.ajax({
        type: "POST",
        url: url,
        data :   $("#add_settings_form").serialize(),
        dataType: "json", 
        
        beforeSend: function(){ $("#btn_div").html("Updating...");},       
        success: function(response){ 
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Update" onclick ="fndaily()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Save" onclick ="fndaily()">');
          if(response.Success==1)
          {
            $("#add_settings_form")[0].reset();
            window.location.href = "daily-attendance-settings";
          }
        } ,
         error: function(data){
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Update" onclick ="fndaily()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Save" onclick ="fndaily()">');
        var errors = data.responseJSON;
        if(errors.late_min)
        {
          $("#late_min_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.late_min+'</strong></div></div>');
        }
        if(errors.late_percent)
        {
          $("#late_percent_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.late_percent+'</strong></div></div>');
        }
        if(errors.job_role)
        {
          $("#job_role_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.job_role+'</strong></div></div>');
        }
      }   
      });
    }

  </script>