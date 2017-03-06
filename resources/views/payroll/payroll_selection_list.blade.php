@include('layouts.header', ['page_title' => 'Employee List'])

  <!-- Page -->
  <div class="page">
  <div class="page-header">
      <h1 class="page-title">Employees List</h1>
     
    </div>
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">
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
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div class="text-xs-right">
                      <form id="payroll_form" action="{{ url('/view-previous-payslip')}}" method="get">  
                        <label for="startDate">Month & year :</label>
                        <input name="selectmonth" id="datepicker" class="date-picker" value="{{ old('selectmonth')!='' ? old('selectmonth') : ''}} "/>
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
                              @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
                                  <th>Action</th> 
                              @endif
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1;?>
                            @foreach ($employees as $employee)                            
                            <tr>
                                <td>{{$sno++}} </td>      
                                <td>{{ $employee->emp_num }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->month_year }}</td>
                                <td>
                                    @if($employee->role==Config::get('constants.roles.Admin_User')) {{'Admin'}} @endif
                                    @if($employee->role==Config::get('constants.roles.People_Manager')) {{'People Manager'}} @endif
                                    @if($employee->role==Config::get('constants.roles.Employee')) {{'Employee'}} @endif
                                    @if($employee->role==Config::get('constants.roles.Factory_Employee')) {{'Factory Employee'}} @endif
                                    @if($employee->role==Config::get('constants.roles.Doctor')) {{ 'Doctor'}} @endif
                                </td>                                
                                <td>{{ $employee->grade }}</td>
                                @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
                                  <td class="actions">
                                      @if(isset( $employee->payroll_id) )
                                      <a onClick="fnViewpayroll('{{ $employee->payroll_id }}')"><i class="btn btn-sm btn-primary waves-effect icon fa-eye" aria-hidden="true" title="view"></i></a>
                                      
                                        <a onclick="fnIssuePS({{ $employee->payroll_id}})"><i class="btn btn-sm btn-info waves-effect icon fa-chain-broken" aria-hidden="true" title="Issue Payslip Certificate"></i></a>
                                      
                                        @if($employee->ps_file!='' && file_exists(public_path('psc').'/'.$employee->ps_file)) 
                                            <a href="public/psc/<?php echo $employee->ps_file; ?>" target="_blank"><i class="btn btn-sm btn-success waves-effect icon fa-chain" aria-hidden="true" title="View Payslip Certificate"></i></a> 
                                        @endif

                                      
                                  @else
                                      <a onClick="fnAddpayroll('{{ $employee->id }}')"><i class="btn btn-sm btn-warning waves-effect icon fa-plus" aria-hidden="true" title="Add"></i></a>
                                  @endif
                                  </td>
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
@include('layouts.footer')
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
