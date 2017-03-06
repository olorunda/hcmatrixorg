@include('layouts.header', ['page_title' => 'Diagnosis Details'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Diagnosis Details</h1>
     
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
                    Diagnosis status updated successfully!
                </div>
                </div>  
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div class="text-xs-right">
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnAddDiagnosis()">Add Diagnosis</button></div>
                  <!--<table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Doctor Name</th> 
                              <th>Diagnosis Date</th> 
                              <th>Recommendation</th>
                              <th>Leave Duration</th>   
                              <th>Medical Checkup</th>
                              <th>Medical Report</th>                                            
                              <th>Leave Status</th> 
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            @foreach ($diagnosis as $diag)                            
                            <tr>
                                <td>{{$sno++}} </td>  
                                <td>{{$diag->doctor_name}}</td>
                                <td>{{ date("M d, Y", strtotime($diag->diagnosis_date)) }}</td>
                                <td>{{ $diag->doctor_recommendation }}</td>
                                <td>{{ $diag->total_leave_days }} days<br/>from {{ date("M d, Y", strtotime($diag->leave_from)) }}<br/>to {{ date("M d, Y", strtotime($diag->leave_to)) }}</td>
                                <td>@if($diag->external_leave_type==1) {{ 'External'}} @else {{ 'Internal' }}@endif</td>
                                <td>@if($diag->medical_report!=''  && file_exists(public_path('medical_reports').'/'.$diag->medical_report))<a href="public/medical_reports/<?php echo $diag->medical_report; ?>" target="_blank">{{$diag->medical_report}}</a> @endif</td> 
                                <td>@if($diag->leave_status =="2") {{ 'Pending' }} @elseif ($diag->leave_status =="1") {{ 'Approved' }} @elseif ($diag->leave_status =="0") {{ 'Cancelled' }} @endif</td>

                                <td class="actions">
                                  @if($diag->leave_status =="2" && $diag->created_by ==Auth::id())
                                    <a onClick="fnEditDiagnosis({{$diag->id}})"><i class="btn btn-sm btn-primary waves-effect icon fa-edit" aria-hidden="true" title="Edit"></i></a>
                                    <a onClick="fnDelete({{ $diag->id}})"><i class="btn btn-sm btn-danger waves-effect icon fa-trash-o" aria-hidden="true" title="Delete"></i></a>
                                  @elseif($diag->leave_status==Config::get('constants.leave_status.APPROVED'))
                                    @if($diag->mc_issued!=0 && $diag->mc_file!='' && file_exists(public_path('mcs').'/'.$diag->mc_file)) <a href="public/mcs/<?php echo $diag->mc_file; ?>" download target="_blank"><i class="btn btn-sm btn-success waves-effect icon fa-download" aria-hidden="true"   title="Download Medical Certificate"></i></a>
                                    @endif
                                  @endif</td>
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
  <!--- Add diagnosis modal start -->
  <div class="modal fade in" id="diagnosis-modal" role="dialog">
    <div class="modal-dialog ">
      <form class="form-horizontal" id="add_my_diagnosis_form" role="form" method="POST" enctype="multipart/form-data">
        <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title" id="diagnosis_title">Add Diagnosis</h4>
        </div>
        <div class="modal-body">         
            {{ csrf_field() }}     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12">
              
              <div class="form-group">
                <h4 class="example-title">Diagnosis Description&nbsp;<span class="required_filed">*</span></h4>
                <textarea id="diagnosis_description" class="form-control" rows="3" name="diagnosis_description" placeholder="Diagnosis Description">{{ old('diagnosis_description')!='' ? old('diagnosis_description') : ((isset($diagnosis_details) && $diagnosis_details->diagnosis_description!='') ? $diagnosis_details->diagnosis_description : '') }}</textarea>
              </div> 
              <div id="diagnosis_description_err"></div>  
              <div class="form-group">
                <h4 class="example-title">Prescribed Drugs&nbsp;<span class="required_filed">*</span></h4>
                <textarea id="prescribed_drugs" class="form-control" rows="3" name="prescribed_drugs" placeholder="Prescribed Drugs">{{ old('prescribed_drugs')!='' ? old('prescribed_drugs') : ((isset($diagnosis_details) && $diagnosis_details->prescribed_drugs!='') ? $diagnosis_details->prescribed_drugs : '') }}</textarea>
              </div> 
              <div id="prescribed_drugs_err"></div>      
              <div class="form-group">
                <h4 class="example-title">Doctor's Recommendation&nbsp;<span class="required_filed">*</span></h4>
                <textarea id="doctor_recommendation" class="form-control" rows="3" name="doctor_recommendation" placeholder="Doctor's Recommendation">{{ old('doctor_recommendation')!='' ? old('doctor_recommendation') : ((isset($diagnosis_details) && $diagnosis_details->doctor_recommendation!='') ? $diagnosis_details->doctor_recommendation : '') }}</textarea>
              </div> 
              <div id="doctor_recommendation_err"></div> 
              <div class="form-group">
                <h4 class="example-title">Medical Checkup&nbsp;<span class="required_filed">*</span></h4>
                <select class="form-control" id="external_leave_type" name="external_leave_type">
                  <option value = ''>Select</option>
                  <option value="0">Internal</option>
                  <option value="1">External</option>
                </select>           
              </div>
              <div id="external_leave_type_err"></div>                
              <div class="form-group">
                <h4 class="example-title">Total Leave Days&nbsp;<span class="required_filed">*</span></h4>
                <input type="text" class="form-control" id="total_leave_days" name="total_leave_days" placeholder="Total Leave Days" value="{{ old('total_leave_days')!='' ? old('total_leave_days') : ((isset($diagnosis_details) && $diagnosis_details->total_leave_days!='') ? $diagnosis_details->total_leave_days : '') }}">
                </div> 
              <div id="total_leave_days_err"></div>                  
              <div class="form-group">
                <h4 class="example-title">Leave Duration&nbsp;<span class="required_filed">*</span></h4>               
                <div class="example">
                  <div class="input-daterange" data-plugin="datepicker">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                      </span>
                      <input type="text" class="form-control" name="leave_from" id="leave_from" value="{{ old('leave_from')!='' ? old('leave_from') : ((isset($diagnosis_details) && $diagnosis_details->leave_from!='') ? date('M d, Y', strtotime($diagnosis_details->leave_from)) : '') }}" />                      
                    </div>                    
                    <div class="input-group">
                      <span class="input-group-addon">to</span>
                      <input type="text" class="form-control" name="leave_to" id="leave_to" value="{{ old('leave_to')!='' ? old('leave_to') : ((isset($diagnosis_details) && $diagnosis_details->leave_to!='') ? date('M d, Y', strtotime($diagnosis_details->leave_to)) : '') }}" />                      
                    </div>                   
                  </div>                   
                </div>
                <div class="col-xs-6 no-padding" id="leave_from_err"></div>    
                <div class="col-xs-6 no-right-padding" id="leave_to_err"></div>                   
              </div>
              <div class="clearfix"></div> 
              <div class="form-group">
                <h4 class="example-title">Medical Report</h4>
                  <input type="file" name="medical_report" id="medical_report">
                  <div id="medical_report_err"></div>  
                  <div id="medical_report_file"></div>
                  @if(isset($diagnosis_details) && $diagnosis_details->medical_report!='' && file_exists(public_path('medical_reports').'/'.$diagnosis_details->medical_report)) <a href="../public/uploads/<?php echo $diagnosis_details->medical_report; ?>" target="_blank">{{$diagnosis_details->medical_report}}</a> @endif

              </div>       
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>            
          </div>        
        </div>
        <div class="modal-footer">
          <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="@if(isset($id) && $id!='') {{  $id }}@endif">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="button" class="btn btn-primary waves-effect" id="diagnosis_btn" value="Save" onclick ="fnDiagnosis()"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'diagnosis-details';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>
       </div>
      </form>
    </div>
  </div>
  <!-- Add diagnosis modal end -->

  <!--- Leave status change modal start -->
  <div class="modal fade in" id="status-change-modal" role="dialog">
    <div class="modal-dialog ">
      <form class="form-horizontal" id="diagnosis_status_form" role="form" method="POST">
        <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title" id="diagnosis_title">Update Leave Status</h4>
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
                <input type="hidden" name="diag_id" id="diag_id" value="">
               <div class="text-xs-left"><span class="no-left-padding" id="status_btn_div"><input type="button" class="btn btn-primary waves-effect" value="Update" onclick ="fnUpdateDiagnosisStatus()"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'diagnosis-details';"></span></div>
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
 
    function fnDelete(arg)
    {
      if(confirm("Do you really want to delete this diagnosis?"))
      {
        document.location.href="delete_my_diagnosis/"+arg;
      }
    }

    function fnStatusChange(arg,status)
    {
      $(".alert").remove();
      var html = '<select class="form-control" id="leave_status" name="leave_status"><option value = "">Select</option>';
      if(status!="2")
        html = html+'<option value="2">Pending</option>';
      if(status!="1")
        html = html+'<option value="1">Approved</option>';
      if(status!="0")
        html = html+'<option value="0">Cancelled</option>';
      html = html+'</select>';  
      $("#diag_id").val(arg);



      $("#status_update_div").html(html);
      $("#status-change-modal").modal("show");
    }
	
  //Add diagnosis
  function fnAddDiagnosis()
  {
    $("#diagnosis_title").html("Add Diagnosis");
    $(".alert").remove();
    $("#diagnosis_btn").val("Save");
    $("#add_my_diagnosis_form")[0].reset();
    $("#diagnosis-modal").modal("show");
  }

  //Edit diagnosis
  function fnEditDiagnosis(arg)
  {
    $("#diagnosis_title").html("Edit Diagnosis");
    $(".alert").remove();
    $.ajax({
        type: "GET",
        url: "edit-diagnosis/"+arg,
        dataType: "json", 
        
          success: function(response){ 
          var diagnosis_details = response.diagnosis_details;
          //filling the old values
          $("#diagnosis_description").val(diagnosis_details.diagnosis_description);
          $("#prescribed_drugs").val(diagnosis_details.prescribed_drugs);
          $("#doctor_recommendation").val(diagnosis_details.doctor_recommendation);
          $("#total_leave_days").val(diagnosis_details.total_leave_days);
          $("#leave_from").val(diagnosis_details.leave_from);
          $("#leave_to").val(diagnosis_details.leave_to);
          $("#external_leave_type").val(diagnosis_details.external_leave_type);
          if(diagnosis_details.medical_report!='')
          {
              $("#medical_report_file").html('<a href="public/medical_reports/'+diagnosis_details.medical_report+'" target="_blank">'+diagnosis_details.medical_report+'</a>');
          }

          $("#id").val(diagnosis_details.id);
          $("#diagnosis_btn").val("Update");
          $("#diagnosis-modal").modal("show");
          
        }     
      });
  }

  function fnDiagnosis()
    {
      var inputData = new FormData($("#add_my_diagnosis_form")[0]);
       jQuery($('#medical_report')[0].files, function(file) {
            inputData.append('medical_report', file);
        });
       var url;
      $(".alert").remove();
      if($("#id").val()!='')
          url = 'update-my-diagnosis';
      else
          url = 'add-my-diagnosis';
      $.ajax({
        url: url,
        type: "POST",        
        data :   inputData,
        async: false,
        processData: false,
        contentType: false,
        dataType: "json", 
        
        beforeSend: function(){ $("#btn_div").html("Updating...");},       
        success: function(response){ 
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="diagnosis_btn" value="Update" onclick ="fnDiagnosis()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="diagnosis_btn" value="Save" onclick ="fnDiagnosis()">');
          if(response.Success==1)
          {
            $("#add_my_diagnosis_form")[0].reset();
            window.location.href = "my-diagnosis-details";
          }
        } ,
         error: function(data){
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="diagnosis_btn" value="Update" onclick ="fnDiagnosis()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="diagnosis_btn" value="Save" onclick ="fnDiagnosis()">');
        var errors = data.responseJSON;
        if(errors.user_id)
        {
          $("#user_id_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.user_id+'</strong></div></div>');
        }
        if(errors.diagnosis_description)
        {
          $("#diagnosis_description_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.diagnosis_description+'</strong></div></div>');
        }
        if(errors.prescribed_drugs)
        {
          $("#prescribed_drugs_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.prescribed_drugs+'</strong></div></div>');
        }
        if(errors.doctor_recommendation)
        {
          $("#doctor_recommendation_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.doctor_recommendation+'</strong></div></div>');
        }
        if(errors.total_leave_days)
        {
          $("#total_leave_days_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.total_leave_days+'</strong></div></div>');
        }
        if(errors.leave_from)
        {
          $("#leave_from_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.leave_from+'</strong></div></div>');
        }
        if(errors.leave_to)
        {
          $("#leave_to_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.leave_to+'</strong></div></div>');
        }
        if(errors.external_leave_type)
        {
          $("#external_leave_type_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.external_leave_type+'</strong></div></div>');
        }
        if(errors.medical_report)
        {
          $("#medical_report_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.medical_report+'</strong></div></div>');
        }

        
        
      }   
      });
    }

    function fnUpdateDiagnosisStatus()
    {
      var url;
      $(".alert").remove();
      url = 'update-diagnosis-status';

      $.ajax({
        type: "POST",
        url: url,
        data :   $("#diagnosis_status_form").serialize(),
        dataType: "json", 
        
        beforeSend: function(){ $("#status_btn_div").html("Updating...");},       
        success: function(response){ 
          $("#status_btn_div").html('<input type="button" class="btn btn-primary waves-effect" value="Update" onclick ="fnUpdateDiagnosisStatus()">');
         
          if(response.Success==1)
          {
            $("#diagnosis_status_form")[0].reset();
            window.location.href = "diagnosis-details";
          }
        } ,
         error: function(data){
           $("#status_btn_div").html('<input type="button" class="btn btn-primary waves-effect" value="Update" onclick ="fnUpdateDiagnosisStatus()">');
        var errors = data.responseJSON;
        if(errors.external_leave_type)
        {
          $("#status_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.external_leave_type+'</strong></div></div>');
        }        
        
      }   
      });
    }

  </script>