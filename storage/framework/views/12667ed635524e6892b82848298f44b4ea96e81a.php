<?php echo $__env->make('layouts.header', ['page_title' => 'My Expenses'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">My Expenses</h1>
     
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
             
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div class="text-xs-right">
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnAddExpense()">Add Expense</button></div>
                 
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>                               
                              <th>S.No</th>
                              <th>Expense Date</th>
                              <th>Expense Details</th>                      
                              <th>Expense Charge</th>                              
                              <th>Expense Status</th>
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            <?php $__currentLoopData = $expense_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>                            
                            <tr>                                
                                <td><?php echo e($sno++); ?> </td>                                
                                <td><?php echo e(date('M d, Y', strtotime($expense->expense_date))); ?></td>
                                <td><?php echo e($expense->expense_details); ?></td>
                                <td><?php echo e($expense->expense_charge); ?></td>


                                <td class="actions">
                                  <?php if($expense->expense_status==Config::get('constants.expense_status.APPLIED')): ?> <span class="tag tag-pill tag-primary">Applied</span> <?php endif; ?>
                                  <?php if($expense->expense_status==Config::get('constants.expense_status.APPROVED')): ?> <span class="tag tag-pill tag-success">Approved</span> <?php endif; ?>
                                  <?php if($expense->expense_status==Config::get('constants.expense_status.REVISE')): ?> <span class="tag tag-pill tag-warning">Revise</span> <?php endif; ?>
                                  <?php if($expense->expense_status==Config::get('constants.expense_status.REVISED')): ?> <span class="tag tag-pill tag-info">Revised</span> <?php endif; ?>
                                  <?php if($expense->expense_status==Config::get('constants.expense_status.REJECTED')): ?> <span class="tag tag-pill tag-danger">Rejected</span> <?php endif; ?>
                                </td>
                                <td class="actions"><?php if($expense->expense_status!=Config::get('constants.expense_status.APPROVED') && $expense->expense_status!=Config::get('constants.expense_status.REJECTED')): ?><a onClick="fnEditExpense(<?php echo e($expense->id); ?>)"><i class="btn btn-sm btn-primary waves-effect icon fa-edit" aria-hidden="true" title="Edit"></i></a><?php endif; ?> <?php if($expense->expense_status!=Config::get('constants.expense_status.APPROVED')): ?><a onClick="fnDelete(<?php echo e($expense->id); ?>)"><i class="btn btn-sm btn-danger waves-effect icon fa-close" aria-hidden="true" title="Delete"></i></a><?php endif; ?></td>
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
  
  <!--- Add expense modal start -->
  <div class="modal fade in" id="expense-modal" role="dialog">    
    <div class="modal-dialog ">
      <form class="form-horizontal" id="add_expense_form" role="form" method="POST">
        <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title" id="expense_title">Add Expense</h4>
        </div>
        <div class="modal-body">         
            <?php echo e(csrf_field()); ?>     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12">
              <div class="form-group">
                <?php //print_r($roles); ?>
                <label class="example-title">Expense Date&nbsp;<span class="required_filed">*</span></label>
                <input type="text" class="expense_datepicker form-control" id="expense_date" name="expense_date" placeholder="Expense Date" value="<?php echo e(old('expense_date')!='' ? old('expense_date') : ((isset($expense_details) && $expense_details->expense_date!='') ? date('M d, Y', strtotime($expense_details->expense_date)) : '')); ?>" data-plugin="datepicker">
                               
              </div>
              <div id="expense_date_err"></div>
              

              <div class="form-group">
                <label class="example-title">Expense Details&nbsp;<span class="required_filed">*</span></label>
                <input type="text" class="form-control" id="expense_details" name="expense_details" placeholder="Expense Details" value="<?php echo e(old('  expense_details')!='' ? old(' expense_details') : ((isset($expense_details) && $expense_details-> expense_details!='') ? $expense_details-> expense_details : '')); ?>">               
              </div>
              <div id="expense_details_err"></div> 
              <div class="form-group">
                <label class="example-title">Expense Charge&nbsp;<span class="required_filed">*</span></label>
                <input type="text" class="form-control" id="expense_charge" name="expense_charge" placeholder="Expense Charge" value="<?php echo e(old('expense_charge')!='' ? old('expense_charge') : ((isset($expense_details) && $expense_details->expense_charge!='') ? $expense_details->expense_charge : '')); ?>">               
              </div>
              <div id="expense_charge_err"></div>          
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>            
          </div>        
        </div>
        <div class="modal-footer">
          <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="<?php if(isset($id) && $id!=''): ?> <?php echo e($id); ?><?php endif; ?>">
                <input type="hidden" name="revise_expense" id="revise_expense" value="">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="button" class="btn btn-primary waves-effect" id="expense_btn" value="Save" onclick ="fnExpense()"></span>
                <span class="no-left-padding" id="expense-revise-btn" style="display:none;"><input type="button" class="btn btn-success waves-effect" id="expense_revise_btn" value="Revise" onclick ="fnReviseExpense()"></span>

                  
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'my-expenses';"></span></div>
                
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>
       </div>
      </form>
    </div>
  </div>
  <!-- Add expense modal end -->
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
      if(confirm("Do you really want to delete this expense?"))
      {
        document.location.href="delete_expense/"+arg;
      }
    }

    function fnStatusChange(arg,status,is_expense)
    {
      $.ajax({
        type: "POST",
        url: "expense_status_change",
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


  //Add expense
  function fnAddExpense()
  {
    $("#expense_title").html("Add Expense");
    $(".alert").remove();
    $("#expense_btn").val("Save");
    $("#add_expense_form")[0].reset();
    $("#expense-modal").modal("show");
  }

  //Edit expense
  function fnEditExpense(arg)
  {
    $("#expense_title").html("Edit Expense");
    $(".alert").remove();
    $.ajax({
        type: "GET",
        url: "edit-expense/"+arg,
        dataType: "json", 
        
          success: function(response){ 
          var expense_det = response.expense_det;
          //filling the old values
          $("#expense_details").val(expense_det.expense_details);          
          $("#expense_charge").val(expense_det.expense_charge); 
          $("#expense_date").val(expense_det.expense_date);     
          $("#id").val(expense_det.id);
          $("#expense_btn").val("Update");
          $("#expense-revise-btn").show();
          $("#expense-modal").modal("show");
          
        }     
      });
  }

  function fnReviseExpense()
  {
    $("#revise_expense").val('1');
    fnExpense('expense_revise_btn');
  }

  function fnExpense(arg)
    {
      if(arg=='')
        arg = 'expense_btn';
      var url;
      $(".alert").remove();
      if($("#id").val()!='')
          url = 'update-expense';
      else
          url = 'add-expense';
      $.ajax({
        type: "POST",
        url: url,
        data :   $("#add_expense_form").serialize(),
        dataType: "json", 
        
        beforeSend: function(){ $("#"+arg).html("Updating...");},       
        success: function(response){ 
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="expense_btn" value="Update" onclick ="fnExpense()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="expense_btn" value="Save" onclick ="fnExpense()">');
          if(response.Success==1)
          {
            $("#add_expense_form")[0].reset();
            window.location.href = "my-expenses";
          }
        } ,
         error: function(data){
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="expense_btn" value="Update" onclick ="fnExpense()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="expense_btn" value="Save" onclick ="fnExpense()">');
        var errors = data.responseJSON;
        if(errors.expense_details)
        {
          $("#expense_details_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.expense_details+'</strong></div></div>');
        }
        
        if(errors.expense_date)
        {
          $("#expense_date_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.expense_date+'</strong></div></div>');
        }
        if(errors.expense_charge)
        {
          $("#expense_charge_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.expense_charge+'</strong></div></div>');
        }
        
        
      }   
      });
    }

  </script>