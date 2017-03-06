<?php echo $__env->make('layouts.header', ['page_title' => 'Employee List'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <!-- Page -->
  <div class="page">
  <div class="page-header">
      <h1 class="page-title">Employees List</h1>
     
    </div>
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">
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
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div class="text-xs-right">
                      <form id="payroll_form" action="<?php echo e(url('/view-previous-payslip')); ?>" method="get">  
                        <label for="startDate">Month & year :</label>
                        <input name="selectmonth" id="datepicker" class="date-picker" value="<?php echo e(old('selectmonth')!='' ? old('selectmonth') : ''); ?> "/>
                        <input type="submit" id="action_button" class="btn btn-primary" value="Generate" />
                      </form>
                  </div>
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Employee #</th> 
                              <th>Name</th> 
                              <th>Month & Year</th>  
                              <th>Role</th>  
                              <th>Grade</th> 
                              <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
                                  <th>Action</th> 
                              <?php endif; ?>
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1;?>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>                            
                            <tr>
                                <td><?php echo e($sno++); ?> </td>      
                                <td><?php echo e($employee->emp_num); ?></td>
                                <td><?php echo e($employee->name); ?></td>
                                <td><?php echo e($employee->month_year); ?></td>
                                <td>
                                    <?php if($employee->role==Config::get('constants.roles.Admin_User')): ?> <?php echo e('Admin'); ?> <?php endif; ?>
                                    <?php if($employee->role==Config::get('constants.roles.People_Manager')): ?> <?php echo e('People Manager'); ?> <?php endif; ?>
                                    <?php if($employee->role==Config::get('constants.roles.Employee')): ?> <?php echo e('Employee'); ?> <?php endif; ?>
                                    <?php if($employee->role==Config::get('constants.roles.Factory_Employee')): ?> <?php echo e('Factory Employee'); ?> <?php endif; ?>
                                    <?php if($employee->role==Config::get('constants.roles.Doctor')): ?> <?php echo e('Doctor'); ?> <?php endif; ?>
                                </td>                                
                                <td><?php echo e($employee->grade); ?></td>
                                <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
                                  <td class="actions">
                                      <?php if(isset( $employee->payroll_id) ): ?>
                                      <a onClick="fnViewpayroll('<?php echo e($employee->payroll_id); ?>')"><i class="btn btn-sm btn-primary waves-effect icon fa-eye" aria-hidden="true" title="view"></i></a>
                                      
                                        <a onclick="fnIssuePS(<?php echo e($employee->payroll_id); ?>)"><i class="btn btn-sm btn-info waves-effect icon fa-chain-broken" aria-hidden="true" title="Issue Payslip Certificate"></i></a>
                                      
                                        <?php if($employee->ps_file!='' && file_exists(public_path('psc').'/'.$employee->ps_file)): ?> 
                                            <a href="public/psc/<?php echo $employee->ps_file; ?>" target="_blank"><i class="btn btn-sm btn-success waves-effect icon fa-chain" aria-hidden="true" title="View Payslip Certificate"></i></a> 
                                        <?php endif; ?>

                                      
                                  <?php else: ?>
                                      <a onClick="fnAddpayroll('<?php echo e($employee->id); ?>')"><i class="btn btn-sm btn-warning waves-effect icon fa-plus" aria-hidden="true" title="Add"></i></a>
                                  <?php endif; ?>
                                  </td>
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
  
  <!--- Add Payroll view modal start -->
  <div class="modal fade in" id="payroll-view-modal" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="payroll_title">View Payroll</h4>
        </div>
        <div class="modal-body">
         
			
            <div id="payroll_display"></div>
			
         </form>
        </div>
        <div class="modal-footer no-padding"></div>
      </div>
    </div>
  </div>
  <!-- Add Payroll view modal end -->
  
  
  
  <!-- Footer -->
<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
$("#datepicker").datepicker( {
    format: "M-yyyy",
    startView: "months", 
    minViewMode: "months",
	orientation: "bottom"
});

//view payroll
  function fnViewpayroll(arg)
  {
    
    $(".alert").remove();
    $.ajax({
        type: "GET",
        url: "get-saved-payroll/"+arg,
        dataType: "json", 
        
          success: function(response){ 
          var payroll = response.payroll;   
          //alert(payroll_details);
          
          $("#payroll_display").html(payroll); // for label span field
          
          $("#payroll-view-modal").modal("show");
          
        }     
      });
    
    
  }
  
  //function to issue the PS
  function fnIssuePS(arg)
  {    
    $.ajax({
        type: "POST",
        url: "issue_ps/"+arg,
        dataType: "json", 
        data :   "_token=<?php echo csrf_token(); ?>",
        
          success: function(response){ 
            if(response.Success==1)
            {
               location.reload();
            }
        }     
      });
  }
  
  $("#data_table").DataTable();
</script>
