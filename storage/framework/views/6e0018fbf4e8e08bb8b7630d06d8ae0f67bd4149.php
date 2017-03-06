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
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="window.location ='<?php echo e(url('/view-previous-payslip')); ?>';"> View previous payslip </button>
                  </div>
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Employee #</th> 
                              <th>Name</th> 
                              <th>Basic Pay</th>  
                              <th>Role</th>  
                              <th>Grade</th> 
                              <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
                                  <th>Action</th> 
                              <?php endif; ?>
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>                            
                            <tr>
                                <td><?php echo e($sno++); ?> </td>      
                                <td><?php echo e($employee->emp_num); ?></td>
                                <td><?php echo e($employee->name); ?></td>
                                <td><?php echo e($employee->basicpay); ?></td>
                                <td>
                                    <?php if($employee->role==Config::get('constants.roles.Admin_User')): ?> <?php echo e('Admin'); ?> <?php endif; ?>
                                    <?php if($employee->role==Config::get('constants.roles.People_Manager')): ?> <?php echo e('People Manager'); ?> <?php endif; ?>
                                    <?php if($employee->role==Config::get('constants.roles.Employee')): ?> <?php echo e('Employee'); ?> <?php endif; ?>
                                    <?php if($employee->role==Config::get('constants.roles.Doctor')): ?> <?php echo e('Doctor'); ?> <?php endif; ?>
                                    <?php if($employee->role==Config::get('constants.roles.Factory_Employee')): ?> <?php echo e('Factory Employee'); ?> <?php endif; ?>
                                </td>                               
                                <td><?php echo e($employee->grade); ?></td>
                                <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
                                  <td class="actions">
                                      <?php if(isset( $employee->payroll_id) ): ?>
                                      <a onClick="fnViewpayroll('<?php echo e($employee->payroll_id); ?>')"><i class="btn btn-sm btn-primary waves-effect icon fa-eye" aria-hidden="true" title="view"></i></a>
                                      
                                        <a onclick="fnIssuePS(<?php echo e($employee->payroll_id); ?>)"><i class="btn btn-sm btn-info waves-effect icon fa-chain-broken" aria-hidden="true" title="Issue Payslip Certificate"></i></a>
                                      
                                        <?php if($employee->ps_file!='' && file_exists('psc/'.$employee->ps_file)): ?> 
                                            <a href="psc/<?php echo $employee->ps_file; ?>" target="_blank"><i class="btn btn-sm btn-success waves-effect icon fa-chain" aria-hidden="true" title="View Payslip Certificate"></i></a> 
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
  
  <!--- Add Payroll save modal start -->
  <div class="modal fade in" id="payroll-save-modal" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="payroll_title">Add Payroll</h4>
        </div>
        <div class="modal-body">
         <form id="payroll_form" action="payroll-update" method="post">
			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			<input type="hidden" name="id" id = "employee_id" value="">
                        <input type="hidden" name="num" id = "employee_num" value="">
                        <input type="hidden" name="basicpay" id = "employee_basicpay" value="">
                        <input type="hidden" name="attendance_days" id = "employee_attendance_days" value="">
                        <input type="hidden" name="working_days" id = "employee_working_days" value="">
                        <input type="hidden" name="leave_days" id = "employee_leave_days" value="">
                        <input type="hidden" name="lop_leave_days" id = "employee_lop_leave_days" value="">
                        <input type="hidden" name="late_coming_deduction" id = "employee_late_coming_deduction" value="">
                        <input type="hidden" name="basic_pay" id = "employee_basic_pay" value="">
                        <input type="hidden" name="salary" id = "employee_salary" value="">
                        <input type="hidden" name="gross_salary" id = "employee_gross_salary" value="">
                        <input type="hidden" name="month_year" id = "employee_month_year" value="">
                        
                        <input type="hidden" name="all_allowances" id = "employee_all_allowances" value="">
                        <input type="hidden" name="all_deductions" id = "employee_all_deductions" value="">
                        <input type="hidden" name="consolidated_allowance" id = "employee_consolidated_allowance" value="">
                        <input type="hidden" name="total_reliefs" id = "employee_total_reliefs" value="">
                        <input type="hidden" name="taxable_income" id = "employee_taxable_income" value="">
                        <input type="hidden" name="cal_tax_pay" id = "employee_cal_tax_pay" value="">
                        <input type="hidden" name="minimum_tax_payable" id = "employee_minimum_tax_payable" value="">
                        <input type="hidden" name="tax_payable" id = "employee_tax_payable" value="">
  

        <p><b>Employee Name &nbsp; : &nbsp; </b><span id="emp_name"></span></p>
        <p><b>Employee Number &nbsp; : &nbsp; </b><span id="emp_numb"></span></p>
        <p><b>Monthly Basic Pay &nbsp; : &nbsp; </b><span id="basicpay"></span></p>
        <p><b>Month & year &nbsp;:&nbsp; </b><span id="month_year"></span></p>
        <p><b>Office Working Days &nbsp;:&nbsp; </b><span id="attendance_days"></span></p>
        <p><b>Employee Working Days &nbsp;:&nbsp; </b><span id="working_days"></span></p>
        <p><b>Employee Casual Leave Days Taken &nbsp;:&nbsp; </b><span id="leave_days"></span></p>
        <p><b>Employee LOP Leave Days &nbsp;:&nbsp; </b><span id="lop_leave_days"></span></p>

        <table class="table table-bordered">
          <tr>
            <th><b>Basic Pay</b></th>
            <td style="text-align:right"><b><span id="basic_pay"></span></b></td>
          </tr>
          <!-- 123456 when salary component includes formula, this fields are commented
          <tr>
            <th colspan="2"><b>Allowances Details</b></th>       
          </tr>
          <tr>
            <td colspan="2"><span id="allowance_details"></span></td>       
          </tr> -->
          <tr>
            <th colspan="2"><b>Allowances</b></th>       
          </tr>
          <tr><td colspan="2" id="all_allowances"></td></tr>
          <tr class="exp_tr" style="display:none;">
            <th colspan="2"><b>Expenses Details</b></th>       
          </tr>
          <tr class="exp_tr" style="display:none;">
            <td colspan="2"><span id="expense_details"></span></td>       
          </tr>
          <tr class="exp_tr" style="display:none;">
            <th colspan="2"><b>Expenses</b></th>       
          </tr>
          <tr class="exp_tr" style="display:none;"><td colspan="2" id="all_expenses"></td></tr>
          <tr>
            <th><b>Gross Pay</b></th>
            <td style="text-align:right"><span id="gross_salary"></span></td>
          </tr>
          <!-- 123456 when salary component includes formula, this fields are commented
          <tr>
            <th colspan="2"><b>Deductions Details</b></th>      
          </tr>
          <tr>
            <td colspan="2"><span id="deduction_details"></span></td>       
          </tr>-->
          <tr>
            <th colspan="2"><b>Deductions</b></th>
          </tr>
          <tr><td colspan="2" id="all_deductions"></td></tr>
          <tr>
            <th><b>Consolidated Allowance</b></th>
            <td style="text-align:right"><b><span id="consolidated_allowance"></span></b></td>
          </tr>
          <tr>
            <th><b>Total Reliefs</b></th>
            <td style="text-align:right"><b><span id="total_reliefs"></span></b></td>
          </tr>
          <tr>
            <th><b>Taxable Income</b></th>
            <td style="text-align:right"><b><span id="taxable_income"></span></b></td>
          </tr>
          <tr>
            <th><b>Calculated Tax Payable</b></th>
            <td style="text-align:right"><b><span id="cal_tax_pay"></span></b></td>
          </tr>
          <tr>
            <th><b>Minimum Tax Payable</b></th>
            <td style="text-align:right"><b><span id="minimum_tax_payable"></span></b></td>
          </tr>
          <tr>
            <th><b>Tax Payable</b></th>
            <td style="text-align:right"><b><span id="tax_payable"></span></b></td>
          </tr>
        <tr>
          <td>Late Coming Deduction</td>
          <td style="text-align:right">(-) <span id="late_coming_deduction"></span></td>       
        </tr>
        <tr>
          <th colspan="2"><h3><b class="pull-right">NET PAY : <span id="salary"></span></b></h3></th>
        </tr>
      </table>

			<p class="text-right">
			<input type="submit" id="action_button" class="btn btn-primary" value="Generate" />
			<input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'payroll-list';">
			</p>
         </form>
        </div>
        <div class="modal-footer no-padding"></div>
      </div>
    </div>
  </div>
  <!-- Add Payroll save modal end -->
  
  
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

<?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')) { ?>

  $("#data_table").DataTable( {        
"aoColumnDefs": [
      { "bSearchable": false, "aTargets": [ -1 ] },
      { "bSortable": false, "aTargets": [ -1 ] }
    ]
    });
  <?php } else { ?>
    $("#data_table").DataTable();
    <?php } ?>
//Add payroll
  function fnAddpayroll(arg)
  {
        
    $(".alert").remove();
    $.ajax({
        type: "GET",
        url: "get-payroll/"+arg,
        dataType: "json", 
        
          success: function(response){ 
          var employee_details = response.employee_details;
          var deduction_details = response.deduction_details;
          var allowance_details = response.allowance_details;
          var all_allowances = response.all_allowances;

          var expense_details = response.expense_details;
          var all_expenses = response.all_expenses;
          
          var all_deductions = response.all_deductions;
          var attendance_day = response.attendance_day;
          var working_day = response.working_day;
          var month_year = response.month_year;
          var basic_pay = parseFloat(response.basic_pay).toFixed(2);
          
          var gross_salary = parseFloat(response.gross_salary).toFixed(2);
          var netsalary = parseFloat(response.netsalary).toFixed(2);
          var num_of_leaves = response.num_of_leaves;
          var num_of_lop_leaves = response.num_of_lop_leaves;
          var late_coming_deduction = parseFloat(response.late_coming_deduction).toFixed(2);
          
          var consolidated_allowance = parseFloat(response.consolidated_allowance).toFixed(2);
          var total_reliefs = parseFloat(response.total_reliefs).toFixed(2);
          var taxable_income = parseFloat(response.taxable_income).toFixed(2);
          var cal_tax_pay = parseFloat(response.cal_tax_pay).toFixed(2);
          var minimum_tax_payable = parseFloat(response.minimum_tax_payable).toFixed(2);
          var tax_payable = parseFloat(response.tax_payable).toFixed(2);
          //alert(allowance_details.allowances_value);
          $("#employee_num").val(employee_details[0].emp_num); // for input hidden field
          $("#employee_id").val(employee_details[0].id);
          $("#employee_basicpay").val(employee_details[0].basicpay);
          
          $("#employee_attendance_days").val(attendance_day);
          $("#employee_working_days").val(working_day);
          $("#employee_leave_days").val(num_of_leaves);
          
          $("#employee_lop_leave_days").val(num_of_lop_leaves);
          $("#employee_late_coming_deduction").val(late_coming_deduction);
          $("#employee_basic_pay").val(basic_pay);
          
          $("#employee_salary").val(netsalary);
          $("#employee_gross_salary").val(gross_salary);
          $("#employee_month_year").val(month_year);
          
          $("#employee_all_allowances").val(all_allowances);
          $("#employee_all_deductions").val(all_deductions);
          $("#employee_consolidated_allowance").val(consolidated_allowance);
          $("#employee_total_reliefs").val(total_reliefs);
          
          $("#employee_taxable_income").val(taxable_income);
          $("#employee_cal_tax_pay").val(cal_tax_pay);
          $("#employee_minimum_tax_payable").val(minimum_tax_payable);
          $("#employee_tax_payable").val(tax_payable);
          
          
          $("#emp_name").html(employee_details[0].name); // for label span field
          $("#emp_numb").html(employee_details[0].emp_num);
          $("#basicpay").html(employee_details[0].basicpay);
          
          $("#month_year").html(month_year);
          $("#attendance_days").html(attendance_day);
          $("#working_days").html(working_day);
		  
          $("#leave_days").html(num_of_leaves);          
          $("#lop_leave_days").html(num_of_lop_leaves);  
          $("#late_coming_deduction").html(late_coming_deduction);  
          $("#basic_pay").html(basic_pay);
		  
          $("#deduction").html(parseFloat(deduction_details.deductions_value).toFixed(2));
          $("#deduction_details").html(deduction_details.deductions_name);
          
          $("#allowance").html(parseFloat(allowance_details.allowances_value).toFixed(2));
          $("#allowance_details").html(allowance_details.allowance_name);  

          $("#expense").html(parseFloat(expense_details.expenses_value).toFixed(2));
          $("#expense_details").html(expense_details.expenses_name); 

          $("#consolidated_allowance").html(consolidated_allowance);
          $("#total_reliefs").html(total_reliefs);
          $("#taxable_income").html(taxable_income);
          
          $("#cal_tax_pay").html(cal_tax_pay);
          $("#minimum_tax_payable").html(minimum_tax_payable);
          $("#tax_payable").html(tax_payable);
           
          var temp_all = all_allowances.split('^^^^');
          var all_html = '<table class="table table-bordered" style="width:100%;">';
          for(var i =0;i<temp_all.length; i++)
          {
            var temp = temp_all[i].split('||||');

            all_html = all_html+'<tr><td>'+temp[0]+'</td><td style="text-align:right">(+) '+temp[1]+'</td></tr>';
          }
          all_html = all_html+'</table>';
          var temp_ded = all_deductions.split('^^^^');
          var ded_html = '<table class="table table-bordered" style="width:100%;">';
          for(var i =0;i<temp_ded.length; i++)
          {
            var temp = temp_ded[i].split('||||');

            ded_html = ded_html+'<tr><td>'+temp[0]+'</td><td style="text-align:right">(-) '+temp[1]+'</td></tr>';
          }
          ded_html = ded_html+'</table>';

          exp_html = 'Nill';
          if(all_expenses.length>0)
          {
            $(".exp_tr").css('display', 'table-row');
            var temp_exp = all_expenses.split('^^^^');
            var exp_html = '<table class="table table-bordered" style="width:100%;">';
            for(var i =0;i<temp_exp.length; i++)
            {
              var temp = temp_exp[i].split('||||');

              exp_html = exp_html+'<tr><td>'+temp[0]+'</td><td style="text-align:right">(+) '+temp[1]+'</td></tr>';
            }
            exp_html = exp_html+'</table>';
          }

          //alert(exp_html);
          
          
          $("#all_allowances").html(all_html);
          $("#all_expenses").html(exp_html);
          $("#all_deductions").html(ded_html);
          //$("#allowance").html(attendance_day);
          
          
          $("#salary").html(netsalary);
          $("#gross_salary").html(gross_salary);
          $("#action_button").prop('disabled', false);
          $("#payroll-save-modal").modal("show");
          
        }     
      });
    
    //$("#basicpay-modal").modal("show");
  }
  
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
              window.location.href = "payroll-list";
            }
        }     
      });
  }
</script>