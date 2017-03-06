<?php echo $__env->make('layouts.header', ['page_title' => 'Daily Attendance Settings'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Daily Attendance Settings</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        <div class="panel-body container-fluid">
          <div class="row row-lg">  
            
             <?php if(session('success')): ?>
                <div class="flash-message">
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="flash-message">
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
                </div>
            <?php endif; ?> 
			<?php if(count($errors)>0): ?>
                <div class="flash-message">
                <div class="alert alert-danger">
                    <?php echo e($errors->first()); ?> 
                </div>
                </div>
            <?php endif; ?> 
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
                              <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
                                <th>Action</th>
                              <?php endif; ?>
                          </tr> 
                      </thead> 
                      <tbody> 
                          <?php $sno = 1; ?>
                            <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <tr>  
                                <td><?php echo e($sno++); ?> </td>                                       
                                <td>
                                    <?php if($setting->role==Config::get('constants.roles.Admin_User')): ?> <?php echo e('Admin'); ?> <?php endif; ?>
                                    <?php if($setting->role==Config::get('constants.roles.People_Manager')): ?> <?php echo e('People Manager'); ?> <?php endif; ?>
                                    <?php if($setting->role==Config::get('constants.roles.Employee')): ?> <?php echo e('Employee'); ?> <?php endif; ?>
                                    <?php if($setting->role==Config::get('constants.roles.Factory_Employee')): ?> <?php echo e('Factory Employee'); ?> <?php endif; ?>
                                    <?php if($setting->role==Config::get('constants.roles.Doctor')): ?> <?php echo e('Doctor'); ?> <?php endif; ?>
                                </td>                 
                                <td><?php echo e($setting->late_minute); ?></td>
                                <td><?php echo e($setting->late_percentage); ?></td>                                
                                <td class="actions" id="status_div_<?php echo e($setting->id); ?>"><?php if($setting->status==0): ?> <a onclick="fnStatusChange(<?php echo e($setting->id); ?>,<?php echo e($setting->status); ?>)"><i class="btn btn-sm btn-warning waves-effect icon fa-eye-slash" aria-hidden="true"   title="Make Active"></i></a> <?php else: ?> <a onclick="fnStatusChange(<?php echo e($setting->id); ?>,<?php echo e($setting->status); ?>)"><i class="btn btn-sm btn-success waves-effect icon fa-eye" aria-hidden="true" title="Make Inactive"></i></a> <?php endif; ?></td>
                                <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
                                    <td class="actions"><a onClick="fnEditSetting(<?php echo e($setting->id); ?>)"><i class="btn btn-sm btn-primary waves-effect icon fa-edit" aria-hidden="true" title="Edit"></i></a><a onClick="fnDelete(<?php echo e($setting->id); ?>)"><i class="btn btn-sm btn-danger waves-effect icon fa-close" aria-hidden="true" title="Delete"></i></a></td>
                                <?php endif; ?>
                            </tr>                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> 
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
            <?php echo e(csrf_field()); ?>     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12">
              <div class="form-group">
                
                <h4 class="example-title">Job Role</h4>
                <select class="form-control" id="job_role" name="job_role">
                  <option value = ''>Select</option>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>  
                      <?php if($role->role!='' && $role->role!=0): ?>
                        <option value = "<?php echo e($role->role); ?>" <?php echo e(((old("job_role")!='' && old("job_role") ==  $role->role) || (isset($settings_details) && $settings_details->role!='' && $settings_details->role ==  $role->role)) ? "selected=selected":""); ?>>
                          <?php if($role->role==Config::get('constants.roles.Admin_User')): ?> <?php echo e('Admin'); ?> <?php endif; ?>
                          <?php if($role->role==Config::get('constants.roles.People_Manager')): ?> <?php echo e('People Manager'); ?> <?php endif; ?>
                          <?php if($role->role==Config::get('constants.roles.Employee')): ?> <?php echo e('Employee'); ?> <?php endif; ?>
                          <?php if($role->role==Config::get('constants.roles.Factory_Employee')): ?> <?php echo e('Factory Employee'); ?> <?php endif; ?>
                          <?php if($role->role==Config::get('constants.roles.Doctor')): ?> <?php echo e('Doctor'); ?> <?php endif; ?>
                        </option>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>                   
                  </select>                 
              </div>
              <div id="job_role_err"></div>              
              <div class="form-group">
                <h4 class="example-title">Late by Minutes</h4>
             
                <input type="text" class="form-control" id="late_min" name="late_min" placeholder="Late by Minutes" value="<?php echo e(old('late_min')!='' ? old('late_min') : ((isset($settings_details) && $settings_details->late_minute!='') ? $settings_details->late_minute : '')); ?>">
              </div>  
              <div id="late_min_err"></div>
              <div class="clearfix"></div>            
              <div class="form-group">
                <h4 class="example-title">Late Percentage Chargeable</h4>
             
                <input type="text" class="form-control" id="late_percent" name="late_percent" placeholder="Late Percentage Chargeable" value="<?php echo e(old('late_percent')!='' ? old('late_percent') : ((isset($settings_details) && $settings_details->late_percent!='') ? $settings_details->late_percent : '')); ?>">
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
                <input type="hidden" name="id" id="id" value="<?php if(isset($id) && $id!=''): ?> <?php echo e($id); ?><?php endif; ?>">
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
  <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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