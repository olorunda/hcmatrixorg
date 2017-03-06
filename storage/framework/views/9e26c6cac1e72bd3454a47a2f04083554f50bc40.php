<?php echo $__env->make('layouts.header', ['page_title' => 'Holiday List'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Holiday List</h1>
     
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
                    Holiday status updated successfully!
                </div>
                </div>  
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div class="text-xs-right">
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnAddHoliday()">Add Holiday</button><!--&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnImport()">Import Holidays</button><br/><a href="public/sample_files/holiday_import_format.xlsx" target="_blank">Sample Excel File</a>--></div>
                    <div class="clearfix"><br/></div>
                  <!--<table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true"> table table-hover dataTable table-striped-->
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Holiday(s)</th> 
                              <th>Reason</th>                      
                              <th>Status</th> 
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
                          <?php $sno = 1; ?>
                            <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>  
                            <tr>  
                                <td><?php echo e($sno++); ?> </td>                             
                                <td><?php if($holiday->multiple_days==1): ?> <?php echo e(date("M d, Y", strtotime($holiday->from_date))); ?> to <?php echo e(date("M d, Y", strtotime($holiday->to_date))); ?> <?php else: ?> <?php echo e(date("M d, Y", strtotime($holiday->single_day))); ?> <?php endif; ?></td>
                                <td><p><?php echo e($holiday->reason); ?></p></td>
                                <td class="actions" id="status_div_<?php echo e($holiday->id); ?>"><?php if($holiday->status==0): ?> <a onclick="fnStatusChange(<?php echo e($holiday->id); ?>,<?php echo e($holiday->status); ?>)"><i class="btn btn-sm btn-warning waves-effect icon fa-eye-slash" aria-hidden="true"   title="Make Active"></i></a> <?php else: ?> <a onclick="fnStatusChange(<?php echo e($holiday->id); ?>,<?php echo e($holiday->status); ?>)"><i class="btn btn-sm btn-success waves-effect icon fa-eye" aria-hidden="true" title="Make Inactive"></i></a> <?php endif; ?></td>
                                <td class="actions"><a onClick="fnEditHoliday(<?php echo e($holiday->id); ?>)"><i class="btn btn-sm btn-primary waves-effect icon fa-edit" aria-hidden="true" title="Edit"></i></a><a onClick="fnDelete(<?php echo e($holiday->id); ?>)"><i class="btn btn-sm btn-danger waves-effect icon fa-close" aria-hidden="true" title="Delete"></i></a></td>
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
  

  <!--- Add holiday modal start -->
  <div class="modal fade in" id="holiday-modal" role="dialog">    
    <div class="modal-dialog ">
      <form class="form-horizontal" id="add_holiday_form" role="form" method="POST">
        <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title" id="holiday_title">Add Holiday</h4>
        </div>
        <div class="modal-body">         
            <?php echo e(csrf_field()); ?>     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12">
              <div class="form-group">
                <label class="example-title">Multiple Days Holiday</label>&nbsp;&nbsp;&nbsp;
                <input type="checkbox" id="multiple_days" name="multiple_days" value="1" <?php echo e(((old("multiple_days")!='' && old("multiple_days") ==  1) || (isset($holiday_details) && $holiday_details->multiple_days!='' && $holiday_details->multiple_days ==  1)) ? "checked=checked":""); ?>>              
              </div>
              <div id="multiple_days_err"></div>
              <div class="form-group" id="single_day_div">
                <label class="example-title">Day&nbsp;<span class="required_filed">*</span></label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="icon wb-calendar" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="datepicker form-control" id="single_day" name="single_day" placeholder="Day" value="<?php echo e(old('single_day')!='' ? old('single_day') : ((isset($holiday_details) && $holiday_details->single_day!='') ? date('M d, Y', strtotime($holiday_details->single_day)) : '')); ?>" data-plugin="datepicker">
                  </div>
                </div>  
              </div> 
              <div id="single_day_err"></div>             
              <div class="form-group" id="multiple_days_div" style="display:none;">
                <label class="example-title">Holiday Period&nbsp;<span class="required_filed">*</span></label>               
                <div class="">
                  <div class="input-daterange" data-plugin="datepicker">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                      </span>
                      <input type="text" class="form-control" name="from_date" id="from_date" value="<?php echo e(old('from_date')!='' ? old('from_date') : ((isset($holiday_details) && $holiday_details->from_date!='') ? date('M d, Y', strtotime($holiday_details->from_date)) : '')); ?>" />                      
                    </div>                    
                    <div class="input-group">
                      <span class="input-group-addon">to</span>
                      <input type="text" class="form-control" name="to_date" id="to_date" value="<?php echo e(old('to_date')!='' ? old('to_date') : ((isset($holiday_details) && $holiday_details->to_date!='') ? date('M d, Y', strtotime($holiday_details->to_date)) : '')); ?>" />                      
                    </div>                   
                  </div>                   
                </div>
                <div id="from_date_err" class="col-xs-6 no-padding"></div>    
                <div id="to_date_err" class="col-xs-6 no-right-padding"></div>                   
              </div>
              <div class="clearfix"></div>            
              <div class="form-group">
                <label class="example-title">Reason&nbsp;<span class="required_filed">*</span></label>
                <input type="text" class="form-control" id="reason" name="reason" placeholder="Reason" value="<?php echo e(old('reason')!='' ? old('reason') : ((isset($holiday_details) && $holiday_details->reason!='') ? $holiday_details->reason : '')); ?>">               
              </div>
              <div id="reason_err"></div>    
              
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>            
          </div>        
        </div>
        <div class="modal-footer">
          <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="<?php if(isset($id) && $id!=''): ?> <?php echo e($id); ?><?php endif; ?>">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Save" onclick ="fnHoliday()"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'holiday-list';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>
       </div>
      </form>
    </div>
  </div>
  <!-- Add holiday modal end -->
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
      if(confirm("Do you really want to delete this training?"))
      {
        document.location.href="delete_holiday/"+arg;
      }
    }

    function fnStatusChange(arg,status)
    {
      $.ajax({
        type: "POST",
        url: "holiday_status_change",
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

  $('#multiple_days').change(function() {
    $("#multiple_days_div").css("display","none");
    $("#single_day_div").css("display","block");
    $("#from_date_err").html('');
    $("#to_date_err").html('');

    if($(this).is(":checked")) {
      $("#multiple_days_div").css("display","block");
      $("#single_day_div").css("display","none");
      $("#single_day_err").html('');
    }
    });


  $("#multiple_days").click(function(){ 
        var element = $(this).find('option:selected'); 
        fnClient(element.val());
        getSpecicalRequest(element.val());
        getShippingDetails(element.val());
        getPetId();
       
         
    }); 

  //Add holiday
  function fnAddHoliday()
  {
    $("#holiday_title").html("Add Holiday");
    $(".alert").remove();
    $("#holiday_btn").val("Save");
    $("#add_holiday_form")[0].reset();
    $("#holiday-modal").modal("show");
  }

  //Edit holiday
  function fnEditHoliday(arg)
  {
    $("#holiday_title").html("Edit Holiday");
    $(".alert").remove();
    $.ajax({
        type: "GET",
        url: "edit-holiday/"+arg,
        dataType: "json", 
        
          success: function(response){ 
          var holiday_details = response.holiday_details;
          //filling the old values
          if(holiday_details.multiple_days==1)
          {
            $("#multiple_days").attr('checked','checked');
            $("#multiple_days_div").css("display","block");
            $("#single_day_div").css("display","none");
          }
          else
          {
            $("#multiple_days_div").css("display","none");
            $("#single_day_div").css("display","block");
          }
          $("#job_role").val(holiday_details.job_role);
          $("#single_day").val(holiday_details.single_day);
          $("#from_date").val(holiday_details.from_date);
          $("#to_date").val(holiday_details.to_date);
          $("#reason").val(holiday_details.reason);
          $("#id").val(holiday_details.id);
          $("#holiday_btn").val("Update");
          $("#holiday-modal").modal("show");
          
        }     
      });
  }

  function fnHoliday()
    {
      var url;
      $(".alert").remove();
      if($("#id").val()!='')
          url = 'update-holiday';
      else
          url = 'add-holiday';
      $.ajax({
        type: "POST",
        url: url,
        data :   $("#add_holiday_form").serialize(),
        dataType: "json", 
        
        beforeSend: function(){ $("#btn_div").html("Updating...");},       
        success: function(response){ 
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Update" onclick ="fnHoliday()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Save" onclick ="fnHoliday()">');
          if(response.Success==1)
          {
            $("#add_holiday_form")[0].reset();
            window.location.href = "holiday-list";
          }
        } ,
         error: function(data){
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Update" onclick ="fnHoliday()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="holiday_btn" value="Save" onclick ="fnHoliday()">');
        var errors = data.responseJSON;
        if(errors.multiple_days)
        {
          $("#multiple_days_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.multiple_days+'</strong></div></div>');
        }
        if(errors.single_day)
        {
          $("#single_day_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.single_day+'</strong></div></div>');
        }
        if(errors.from_date)
        {
          $("#from_date_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.from_date+'</strong></div></div>');
        }
        if(errors.to_date)
        {
          $("#to_date_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.to_date+'</strong></div></div>');
        }
        if(errors.reason)
        {
          $("#reason_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.reason+'</strong></div></div>');
        }
        
        
      }   
      });
    }

  </script>