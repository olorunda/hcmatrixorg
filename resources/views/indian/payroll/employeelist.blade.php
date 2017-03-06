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
                  
                  <!--<table data-toggle="table" class="table table-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Employee grade</th>
                              <th>Basicpay</th>
                              @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
                                  <th>Action</th> 
                              @endif
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            @foreach ($employees as $employee)                            
                            <tr>
                                <td>{{$sno++}} </td>
                                <td>{{ $employee->grade }}</td>
                                <td>{{ $employee->basicpay }}</td>
                                @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
                                  <td class="actions">
                                      @if(isset( $employee->basicpay))
                                      <a onClick="fnEditBasicpay('{{ $employee->grade }}', '{{ $employee->basicpay }}')"><i class="btn btn-sm btn-primary waves-effect icon fa-edit" aria-hidden="true" title="Edit"></i></a>
                                      @else
                                      <a onClick="fnAddBasicpay('{{ $employee->grade }}')"><i class="btn btn-sm btn-warning waves-effect icon fa-plus" aria-hidden="true" title="Add"></i></a>
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
  
  <!--- Add Basicpay modal start -->
  <div class="modal fade in" id="basicpay-modal" role="dialog">
    <div class="modal-dialog ">
      <form class="form-horizontal" id="basicpay_form" action="basicpay-update" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="basicpay_title">Add Basicpay</h4>
        </div>
        <div class="modal-body">
         {{ csrf_field() }} 
         <div class="row row-lg">
             <div class="col-xs-12">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="grade" id = "employee_grade" value="">
                <input type="hidden" name="action" id ="action" value="">
                <div class="form-group">
                  <h4 class="example-title col-sm-4">Employee Grade: </h4>
                  <div class="col-sm-8">
                  <h6 id="emp_grade"></h6>
                  </div>
                </div>			 
                <div class="clearfix"></div>
                <div class="form-group">
                  <h4 class="example-title col-sm-4">Basic Pay&nbsp;<span class="required_filed">*</span>:</h4>
                  <div class="col-sm-8">
                    <input type="text" class="form-control " name ="basicpay" id="basicpay">
                  </div>
                </div>			
                <div id="basicpay_err"></div>
             </div>
         </div>
        </div>
        <div class="modal-footer">
		<div class="row row-lg">
          <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group" style="padding-left: 13px;">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="button" class="btn btn-primary waves-effect" value="Submit" onclick ="fnBasicpay()" /></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'basicpay-list';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>  
        </div>  		 
      </div>
      </form>
    </div>
  </div>
  <!-- Add Basicpay modal end -->
  
  <!-- Footer -->
@include('layouts.footer')
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
//Add basicpay
  function fnAddBasicpay(emp_grade)
  {
    $("#basicpay_title").html("Add Basicpay");
    
    $("#basicpay").val(""); // to clear the text box
    $("#employee_grade").val(emp_grade); // for input hidden field    
    $("#action").val("add");
    
    $("#emp_grade").html(emp_grade); // for label span field
    $(".alert").remove();
    $("#basicpay-modal").modal("show");
  }
  
//Edit basicpay
  function fnEditBasicpay(emp_grade, emp_basicpay)
  {
    $("#basicpay_title").html("Edit Basicpay");
    $("#employee_grade").val(emp_grade); // for input hidden field
    $("#basicpay").val(emp_basicpay);
    $("#action").val("update");
    
    $("#emp_grade").html(emp_grade); // for label span field
    $(".alert").remove();
    $("#basicpay-modal").modal("show");
  }
  
  function fnBasicpay()
    {
      var url;
      $(".alert").remove();      
      url = 'basicpay-update';
      $.ajax({
        type: "POST",
        url: url,
        data :   $("#basicpay_form").serialize(),
        dataType: "json", 
        
        beforeSend: function(){ $("#btn_div").html("Updating...");},       
        success: function(response){ 
          
          if(response.Success==1)
          {
            $("#basicpay_form")[0].reset();
            window.location.href = "basicpay-list";
          }
        } ,
        error: function(data){       
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" value="Submit" onclick ="fnBasicpay()" />');
            var errors = data.responseJSON;
            if(errors.basicpay)
            {
              $("#basicpay_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.basicpay+'</strong></div></div>');
            }        
        }   
      });
    }
</script>