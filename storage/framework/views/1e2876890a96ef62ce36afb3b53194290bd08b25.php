<?php echo $__env->make('layouts.header', ['page_title' => 'Leave List'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Leave List</h1>
     
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
                    Leave status updated successfully!
                </div>
                </div>  
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div class="text-xs-right">
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnAddLeave()">Add Leave</button><!--&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnImport()">Import Leaves</button><br/><a href="public/sample_files/leave_import_format.xlsx" target="_blank">Sample Excel File</a>--></div>
                  <!--<table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Leave Duration</th> 
                              <th>Reason</th>  
                              <th>Total Leave Days</th>                    
                              <th>Status</th> 
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            <?php $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>                            
                            <tr>                                
                                <td><?php echo e($sno++); ?> </td>
                                <td><?php echo e(date("M d, Y", strtotime($leave->from_date)).' to '.date("M d, Y", strtotime($leave->to_date))); ?></td>
                                <td><?php echo e($leave->leave_comment); ?></td>
                                <td><?php echo e($leave->total_no_of_leave_days); ?></td>
                                <td id="status_div_<?php echo e($leave->id); ?>">
                                  <?php if($leave->leave_status==Config::get('constants.apply_leave_status.APPLIED')): ?> <?php echo e('Applied'); ?> <?php endif; ?>
                                  <?php if($leave->leave_status==Config::get('constants.apply_leave_status.APPROVED')): ?> <?php echo e('Approved'); ?> <?php endif; ?>
                                  <?php if($leave->leave_status==Config::get('constants.apply_leave_status.REJECTED')): ?> <?php echo e('Rejected'); ?> <?php endif; ?>
                                  <?php if($leave->leave_status==Config::get('constants.apply_leave_status.CANCELLED')): ?> <?php echo e('Cancelled'); ?> <?php endif; ?>
                                </td>
                                <td class="actions"><?php if($leave->leave_status==Config::get('constants.apply_leave_status.APPLIED') && (strtotime($leave->from_date)>strtotime(date("Y-m-d")))): ?><a onClick="fnCancel(<?php echo e($leave->id); ?>)"><i class="btn btn-sm btn-danger waves-effect icon fa-close" aria-hidden="true" title="Cancel"></i></a><?php endif; ?></td>
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

  <!--- Add leave modal start -->
  <div class="modal fade in" id="leave-modal" role="dialog">    
    <div class="modal-dialog ">
      <form class="form-horizontal" id="add_leave_form" role="form" method="POST">
        <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title" id="leave_title">Apply Leave</h4>
        </div>
        <div class="modal-body">         
            <?php echo e(csrf_field()); ?>     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12">  
              <div class="form-group">
                <label class="example-title">Leave Period&nbsp;<span class="required_filed">*</span></label>               
                <div class="example">
                  <div class="input-daterange" data-plugin="datepicker">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                      </span>
                      <input type="text" class="form-control" name="from_date" id="from_date" value="<?php echo e(old('from_date')!='' ? old('from_date') : ((isset($leave_details) && $leave_details->from_date!='') ? date('M d, Y', strtotime($leave_details->from_date)) : '')); ?>" />                      
                    </div>                    
                    <div class="input-group">
                      <span class="input-group-addon">to</span>
                      <input type="text" class="form-control" name="to_date" id="to_date" value="<?php echo e(old('to_date')!='' ? old('to_date') : ((isset($leave_details) && $leave_details->to_date!='') ? date('M d, Y', strtotime($leave_details->to_date)) : '')); ?>"  />                      
                    </div>                   
                  </div>                   
                </div>
                <div id="from_date_err" class="col-xs-6 no-padding"></div>    
                <div id="to_date_err" class="col-xs-6 no-right-padding"></div>                   
              </div> 
              <div class="clearfix"></div> 
              <div class="form-group">
                <label class="example-title">Available Leave Days</label>
                <b id="remaining_leaves">--</b>  
                <input type="hidden" id="total_no_of_leave_days" name="total_no_of_leave_days" value="0">         
              </div>
              <div class="form-group">
                <label class="example-title">Comment&nbsp;<span class="required_filed">*</span></label>
                <textarea class="form-control" id="leave_comment" name="leave_comment" placeholder="Comment"><?php echo e(old('leave_comment')!='' ? old('leave_comment') : ((isset($leave_details) && $leave_details->leave_comment!='') ? $leave_details->leave_comment : '')); ?></textarea>               
              </div>
              <div id="leave_comment_err"></div>    
              
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>            
          </div>        
        </div>
        <div class="modal-footer">
          <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="<?php if(isset($id) && $id!=''): ?> <?php echo e($id); ?><?php endif; ?>">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="button" class="btn btn-primary waves-effect" id="leave_btn" value="Save" onclick ="fnLeave()"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'my-leaves';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>
       </div>
      </form>
    </div>
  </div>
  <!-- Add leave modal end -->
  <!-- Footer -->
  <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <script type="text/javascript">

  $("#data_table").DataTable( {        
"aoColumnDefs": [
      { "bSearchable": false, "aTargets": [ -1 ] },
      { "bSortable": false, "aTargets": [ -1 ] }
    ]
    });

  function date_change()
  {
    var html = '';
    var from_date = new Date('M d, yyyy');
    var to_date = new Date('M d, yyyy');
    if($("#from_date").val())
    from_date = $("#from_date").val();    
    if($("#to_date").val())
      to_date = $("#to_date").val();

    $.ajax({
        type: "POST",
        url: "getavailleave",
        data: "_token=<?php echo csrf_token() ?>&from_date="+from_date+"&to_date="+to_date,
        dataType: "json", 
        
        beforeSend: function(){ $("#remaining_leaves").html("Updating...");},       
        success: function(response){ 
          if(response.Success==1)
          {
            $("#remaining_leaves").html(response.bal_leave);
            $("#total_no_of_leave_days").val(response.total_no_of_leave_days);
            $(".alert").css('display', 'none');
            $("#status_div").css('display', 'block');
          }
        }     
      });

  }

  $("#from_date").change(function()
  { 
    date_change();
  });

  $("#to_date").change(function()
  { 
    date_change();
  });


  function fnCancel(arg)
    {
      if(confirm("Do you really want to cancel this leave?"))
      {
        document.location.href="cancel_leave/"+arg;
      }
    }

    function fnStatusChange(arg,status)
    {
      $.ajax({
        type: "POST",
        url: "leave_status_change",
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
  //Add leave
  function fnAddLeave()
  {
    $("#remaining_leaves").html('--');
    $("#total_no_of_leave_days").val('');
    $("#leave_title").html("Apply Leave");
    $(".alert").remove();
    $("#leave_btn").val("Save");
    $("#add_leave_form")[0].reset();
    $("#leave-modal").modal("show");
  }

  function fnLeave()
    {
      var url;
      $(".alert").remove();
      url = 'apply-leave';
      $.ajax({
        type: "POST",
        url: url,
        data :   $("#add_leave_form").serialize(),
        dataType: "json", 
        
        beforeSend: function(){ $("#btn_div").html("Updating...");},       
        success: function(response){ 
          $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="leave_btn" value="Save" onclick ="fnLeave()">');
          if(response.Success==1)
          {
            $("#add_leave_form")[0].reset();
            window.location.href = "my-leaves";
          }
        } ,
         error: function(data){
        $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="leave_btn" value="Save" onclick ="fnLeave()">');
        var errors = data.responseJSON;
       
       
        if(errors.from_date)
        {
          $("#from_date_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.from_date+'</strong></div></div>');
        }
        if(errors.to_date)
        {
          $("#to_date_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.to_date+'</strong></div></div>');
        }
        if(errors.leave_comment)
        {
          $("#leave_comment_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.leave_comment+'</strong></div></div>');
        }
        
      }   
      });
    }

  </script>