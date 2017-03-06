@include('layouts.header', ['page_title' => 'Employee Expense Status'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Employee Expense Status</h1>
     
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
             
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>                               
                              <th>S.No</th>
                              <th>Employee Name</th>
                              <th>Expense Date</th>
                              <th>Expense Details</th>                      
                              <th>Expense Charge</th>                              
                              <th>Expense Status</th>
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            @foreach ($expense_list as $expense)                            
                            <tr>                                
                                <td>{{$sno++}} </td>   
                                <td>{{ $expense->user_name }}</td>                             
                                <td>{{ date('M d, Y', strtotime($expense->expense_date)) }}</td>
                                <td>{{ $expense->expense_details }}</td>
                                <td>{{ $expense->expense_charge }}</td>
                                <td class="actions">
                                  @if($expense->expense_status==Config::get('constants.expense_status.APPLIED')) {{'Applied'}} @endif
                                  @if($expense->expense_status==Config::get('constants.expense_status.APPROVED')) {{'Approved'}} @endif
                                  @if($expense->expense_status==Config::get('constants.expense_status.REVISE')) {{'Revise'}} @endif
                                  @if($expense->expense_status==Config::get('constants.expense_status.REVISED')) {{'Revised'}} @endif
                                  @if($expense->expense_status==Config::get('constants.expense_status.CANCELLED')) {{'Cancelled'}} @endif
                                  @if($expense->expense_status==Config::get('constants.expense_status.REJECTED')) {{'Rejected'}} @endif
                                </td>

                                <td id="status_div_{{ $expense->id}}" class="actions">
                                  @if($expense->expense_status==Config::get('constants.expense_status.APPLIED'))
                                    <a onclick="fnStatusChange({{ $expense->id}},{{ $expense->expense_status}})"><i class="btn btn-sm btn-warning waves-effect icon fa-exclamation-circle" aria-hidden="true" title="Applied"></i></a>
                                  @elseif($expense->expense_status==Config::get('constants.expense_status.REJECTED'))
                                    <a onclick="fnStatusChange({{ $expense->id}},{{ $expense->expense_status}})"><i class="btn btn-sm btn-danger waves-effect icon fa-close" aria-hidden="true" title="Rejected"></i></a>
                                  @elseif($expense->expense_status==Config::get('constants.expense_status.APPROVED'))
                                    <a onclick="fnStatusChange({{ $expense->id}},{{ $expense->expense_status}})"><i class="btn btn-sm btn-success waves-effect icon fa-check" aria-hidden="true" title="Approved"></i><a/>
                                  @elseif($expense->expense_status==Config::get('constants.expense_status.REVISE'))
                                    <a onclick="fnStatusChange({{ $expense->id}},{{ $expense->expense_status}})"><i class="btn btn-sm btn-warning waves-effect icon fa-file-text-o" aria-hidden="true" title="Revise"></i><a/>
                                  @elseif($expense->expense_status==Config::get('constants.expense_status.REVISED'))
                                    <a onclick="fnStatusChange({{ $expense->id}},{{ $expense->expense_status}})"><i class="btn btn-sm btn-success waves-effect icon fa-copy" aria-hidden="true" title="Revised"></i><a/>

                                  
                                  @endif
                              </td>

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
            {{ csrf_field() }}     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12">
              <div class="form-group">
                <?php //print_r($roles); ?>
                <label class="example-title">Expense Date&nbsp;<span class="required_filed">*</span></label>
                <input type="text" class="expense_datepicker form-control" id="expense_date" name="expense_date" placeholder="Expense Date" value="{{ old('expense_date')!='' ? old('expense_date') : ((isset($expense_details) && $expense_details->expense_date!='') ? date('M d, Y', strtotime($expense_details->expense_date)) : '') }}" data-plugin="datepicker">
                               
              </div>
              <div id="expense_date_err"></div>
              

              <div class="form-group">
                <label class="example-title">Expense Details&nbsp;<span class="required_filed">*</span></label>
                <input type="text" class="form-control" id="expense_details" name="expense_details" placeholder="Expense Details" value="{{ old('  expense_details')!='' ? old(' expense_details') : ((isset($expense_details) && $expense_details-> expense_details!='') ? $expense_details-> expense_details : '') }}">               
              </div>
              <div id="expense_details_err"></div> 
              <div class="form-group">
                <label class="example-title">Expense Charge&nbsp;<span class="required_filed">*</span></label>
                <input type="text" class="form-control" id="expense_charge" name="expense_charge" placeholder="Expense Charge" value="{{ old('expense_charge')!='' ? old('expense_charge') : ((isset($expense_details) && $expense_details->expense_charge!='') ? $expense_details->expense_charge : '') }}">               
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
                <input type="hidden" name="id" id="id" value="@if(isset($id) && $id!='') {{  $id }}@endif">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="button" class="btn btn-primary waves-effect" id="expense_btn" value="Save" onclick ="fnExpense()"></span>
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
  @include('layouts.footer')

  <!--- Expense status change modal start -->
  <div class="modal fade in" id="status-change-modal" role="dialog">
    <div class="modal-dialog ">
      <form class="form-horizontal" id="expense_status_form" role="form" method="POST">
        <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title" id="expense_title">Update Expense Status</h4>
        </div>
        <div class="modal-body">         
            {{ csrf_field() }}     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12">                     
              <div class="form-group">
                <h4 class="example-title">Expense Status</h4>
                <div id="status_update_div"></div>
              </div>
              <div id="expense_status_err"></div>  
              <div id="status_err"></div>                
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>            
          </div>        
        </div>
        <div class="modal-footer">
          <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <input type="hidden" name="expense_id" id="expense_id" value="">
               <div class="text-xs-left"><span class="no-left-padding" id="status_btn_div"><input type="button" class="btn btn-primary waves-effect" value="Update" onclick ="fnUpdateExpenseStatus()"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'employee-expenses';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>
       </div>
      </form>
    </div>
  </div>
  <!-- Expense status change modal end -->

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

    function fnStatusChange(arg,status)
    {
      $(".alert").remove();
      var html = '<select class="form-control" id="expense_status" name="expense_status"><option value = "">Select</option>';
      if(status!="2")
        html = html+'<option value="2">Approved</option>';
      if(status!="3")
        html = html+'<option value="3">Revise</option>';
      /*if(status!="4")
        html = html+'<option value="4">Revised</option>';*/
      if(status!="5")
        html = html+'<option value="5">Rejected</option>';
      html = html+'</select>';  
      $("#expense_id").val(arg);
      $("#status_update_div").html(html);
      $("#status-change-modal").modal("show");
    }

    function fnUpdateExpenseStatus()
    {
      var url;
      $(".alert").remove();
      url = 'update-expense-status';

      $.ajax({
        type: "POST",
        url: url,
        data :   $("#expense_status_form").serialize(),
        dataType: "json", 
        
        beforeSend: function(){ $("#status_btn_div").html("Updating...");},       
        success: function(response){ 
          $("#status_btn_div").html('<input type="button" class="btn btn-primary waves-effect" value="Update" onclick ="fnUpdateExpenseStatus()">');
         
          if(response.Success==1)
          {
            $("#expense_status_form")[0].reset();
            window.location.href = "employee-expenses";
          }
        } ,
         error: function(data){
           $("#status_btn_div").html('<input type="button" class="btn btn-primary waves-effect" value="Update" onclick ="fnUpdateExpenseStatus()">');
        var errors = data.responseJSON;
        if(errors.expense_status)
        {
          $("#status_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.expense_status+'</strong></div></div>');
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
          console.log(expense_det);
          //filling the old values
          $("#expense_details").val(expense_det.expense_details);          
          $("#expense_charge").val(expense_det.expense_charge); 
          $("#expense_date").val(expense_det.expense_date);     
          $("#id").val(expense_det.id);
          $("#expense_btn").val("Update");
          $("#expense-modal").modal("show");
          
        }     
      });
  }

  function fnExpense()
    {
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
        
        beforeSend: function(){ $("#btn_div").html("Updating...");},       
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