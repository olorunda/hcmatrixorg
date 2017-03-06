@include('layouts.header', ['page_title' => 'All Employee Leave Details'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">All Employee Leave Details</h1>
     
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
                    Leave status updated successfully!
                </div>
                </div>  
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  
                  <!--<table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Employee Name</th>
                              <th>Employee #</th>
                              <th>Leave Duration</th> 
                              <th>Reason</th>  
                              <th>Total Leave Days</th>                    
                              <th>Status</th> 
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
                           <?php $sno = 1; ?>
                           @foreach ($leaves as $leave)                            
                            <tr> 
                                <td>{{$sno++}} </td>
                                <td>{{$leave->emp_name}}</td>
                                <td>{{$leave->emp_num}}</td>
                                <td>{{ date("M d, Y", strtotime($leave->from_date)).' to '.date("M d, Y", strtotime($leave->to_date)) }}</td>
                                <td>{{ $leave->leave_comment }}</td>
                                <td>{{ $leave->total_no_of_leave_days }}</td>
                                <td>
                                  @if($leave->leave_status==Config::get('constants.apply_leave_status.APPLIED')) {{'Applied'}} @endif
                                  @if($leave->leave_status==Config::get('constants.apply_leave_status.APPROVED')) {{'Approved'}} @endif
                                  @if($leave->leave_status==Config::get('constants.apply_leave_status.REJECTED')) {{'Rejected'}} @endif
                                  @if($leave->leave_status==Config::get('constants.apply_leave_status.CANCELLED')) {{'Cancelled'}} @endif
                                </td>

                                <td id="status_div_{{ $leave->id}}" class="actions">
                                  @if($leave->leave_status==Config::get('constants.apply_leave_status.APPLIED'))
                                    <a onclick="fnStatusChange({{ $leave->id}},{{ $leave->leave_status}})"><i class="btn btn-sm btn-warning waves-effect icon fa-exclamation-circle" aria-hidden="true" title="Applied"></i></a>
                                  @elseif($leave->leave_status==Config::get('constants.apply_leave_status.REJECTED'))
                                    <a onclick="fnStatusChange({{ $leave->id}},{{ $leave->leave_status}})"><i class="btn btn-sm btn-danger waves-effect icon fa-close" aria-hidden="true" title="Rejected"></i></a>
                                  @elseif($leave->leave_status==Config::get('constants.apply_leave_status.APPROVED'))
                                    <a onclick="fnStatusChange({{ $leave->id}},{{ $leave->leave_status}})"><i class="btn btn-sm btn-success waves-effect icon fa-check" aria-hidden="true" title="Approved"></i><a/>
                                  
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
  

  <!--- Leave status change modal start -->
  <div class="modal fade in" id="status-change-modal" role="dialog">
    <div class="modal-dialog ">
      <form class="form-horizontal" id="leave_status_form" role="form" method="POST">
        <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title" id="leave_title">Update Leave Status</h4>
        </div>
        <div class="modal-body">         
            {{ csrf_field() }}     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12">                     
              <div class="form-group">
                <h4 class="example-title">Leave Status</h4>
                <div id="status_update_div"></div>
              </div>
              <div id="leave_status_err"></div>  
              <div id="status_err"></div>                
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>            
          </div>        
        </div>
        <div class="modal-footer">
          <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <input type="hidden" name="leave_id" id="leave_id" value="">
               <div class="text-xs-left"><span class="no-left-padding" id="status_btn_div"><input type="button" class="btn btn-primary waves-effect" value="Update" onclick ="fnUpdateLeaveStatus()"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'employee-leaves';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>
       </div>
      </form>
    </div>
  </div>
  <!-- Leave status change modal end -->
  <!-- Footer -->
  @include('layouts.footer')
  <script type="text/javascript">
  $("#data_table").DataTable( {        
"aoColumnDefs": [
      { "bSearchable": false, "aTargets": [ -1 ] },
      { "bSortable": false, "aTargets": [ -1 ] }
    ]
    });
 

    function fnStatusChange(arg,status)
    {
      $(".alert").remove();
      var html = '<select class="form-control" id="leave_status" name="leave_status"><option value = "">Select</option>';
      if(status!="2")
        html = html+'<option value="2">Approved</option>';
      if(status!="3")
        html = html+'<option value="3">Rejected</option>';
      html = html+'</select>';  
      $("#leave_id").val(arg);



      $("#status_update_div").html(html);
      $("#status-change-modal").modal("show");
    }
	


    function fnUpdateLeaveStatus()
    {
      var url;
      $(".alert").remove();
      url = 'update-leave-status';

      $.ajax({
        type: "POST",
        url: url,
        data :   $("#leave_status_form").serialize(),
        dataType: "json", 
        
        beforeSend: function(){ $("#status_btn_div").html("Updating...");},       
        success: function(response){ 
          $("#status_btn_div").html('<input type="button" class="btn btn-primary waves-effect" value="Update" onclick ="fnUpdateLeaveStatus()">');
         
          if(response.Success==1)
          {
            $("#leave_status_form")[0].reset();
            window.location.href = "employee-leaves";
          }
        } ,
         error: function(data){
           $("#status_btn_div").html('<input type="button" class="btn btn-primary waves-effect" value="Update" onclick ="fnUpdateLeaveStatus()">');
        var errors = data.responseJSON;
        if(errors.leave_status)
        {
          $("#status_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.leave_status+'</strong></div></div>');
        }        
        
      }   
      });
    }

  </script>