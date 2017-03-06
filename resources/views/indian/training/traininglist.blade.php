@include('layouts.header', ['page_title' => 'Training List'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Training List</h1>
     
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
                    Training status updated successfully!
                </div>
                </div>  
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div class="text-xs-right">
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnAddTraining()">Add Training</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnImport()">Import Trainings</button><br/><a href="public/sample_files/training_import_format.xlsx" target="_blank">Sample Excel File</a></div>
                  <!--<table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th> 
                              <th>Job Role</th> 
                              <th>Training Name</th> 
                              <th>Training Duration</th> 
                              <th>Training Location</th> 
                              <th>Capacity</th>                              
                              <th>Status</th> 
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
						  <?php $sno = 1; ?>
                            @foreach ($trainings as $training)                            
                            <tr>
								<td>{{ $sno++ }}</td>
                                <td>@if($training->job_role==Config::get('constants.roles.Admin_User')) {{'Admin'}} @endif
                          @if($training->job_role==Config::get('constants.roles.People_Manager')) {{'People Manager'}} @endif
                          @if($training->job_role==Config::get('constants.roles.Employee')) {{'Employee'}} @endif
                          @if($training->job_role==Config::get('constants.roles.Doctor')) {{ 'Doctor'}} @endif
                          @if($training->job_role==Config::get('constants.roles.Factory_Employee')) {{ 'Factory Employee'}} @endif</td>
                                <td>{{ $training->training_name }}</td>
                                <td>{{ date("M d, Y", strtotime($training->start_date)) }} to {{ date("M d, Y", strtotime($training->end_date)) }}</td>
                                <td>{{ $training->location }}</td>
                                <td>{{ $training->capacity }}</td>
                                <td class="actions" id="status_div_{{ $training->id}}">@if($training->status==0) <a onclick="fnStatusChange({{ $training->id}},{{ $training->status}})"><i class="btn btn-sm btn-warning waves-effect icon fa-eye-slash" aria-hidden="true"   title="Make Active"></i></a> @else <a onclick="fnStatusChange({{ $training->id}},{{ $training->status}})"><i class="btn btn-sm btn-success waves-effect icon fa-eye" aria-hidden="true" title="Make Inactive"></i></a> @endif</td>
                                <td class="actions"><a onClick="fnEditTraining({{$training->id}})"><i class="btn btn-sm btn-primary waves-effect icon fa-edit" aria-hidden="true" title="Edit"></i></a><a onClick="fnDelete({{ $training->id}})"><i class="btn btn-sm btn-danger waves-effect icon fa-close" aria-hidden="true" title="Delete"></i></a></td>
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
  
  <!-- modal start -->
    <div id='modal-import-trainings' class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('import-training') }}" enctype="multipart/form-data">
            {{ csrf_field() }}  
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Import Trainings</h4>
          </div>
          <div class="modal-body">
             <p><label>Upload CSV File: </label> &nbsp;<input type="file" name="file_import" id="file_import" > </p>
              <p class="text-right"><input type="submit" class="btn btn-primary" value="Submit" /></p>            
          </div>
          <div class="modal-footer">
          </div>
		  </form>
        </div>
      </div>
    </div>
  <!-- modal end -->

  <!--- Add training modal start -->
  <div class="modal fade in" id="training-modal" role="dialog">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlc0lDbH_vAyXIw_gMUf-m6-yAQMKc8MQ&libraries=places"></script>
    <div class="modal-dialog ">
      <form class="form-horizontal" id="add_training_form" role="form" method="POST">
        <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title" id="training_title">Add Training</h4>
        </div>
        <div class="modal-body">         
            {{ csrf_field() }}     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12"> 
              <div class="form-group">
                <?php //print_r($roles); ?>
                <h4 class="example-title">Job Role&nbsp;<span class="required_filed">*</span></h4>
                <select class="form-control" id="job_role" name="job_role">
                  <option value = ''>Select</option>
                    @foreach($roles as $role)  
                      @if($role->role!='' && $role->role!=0)
                        <option value = "{{ $role->role}}" {{ ((old("job_role")!='' && old("job_role") ==  $role->role) || (isset($training_details) && $training_details->job_role!='' && $training_details->job_role ==  $role->role)) ? "selected=selected":"" }}>
                          @if($role->role==Config::get('constants.roles.Admin_User')) {{'Admin'}} @endif
                          @if($role->role==Config::get('constants.roles.People_Manager')) {{'People Manager'}} @endif
                          @if($role->role==Config::get('constants.roles.Employee')) {{'Employee'}} @endif
                          @if($role->role==Config::get('constants.roles.Doctor')) {{ 'Doctor'}} @endif
                          @if($role->role==Config::get('constants.roles.Factory_Employee')) {{ 'Factory Employee'}} @endif
                        </option>
                      @endif
                    @endforeach                   
                  </select>                 
              </div>
              <div id="job_role_err"></div>
              <div class="form-group">
                <h4 class="example-title">Training Name&nbsp;<span class="required_filed">*</span></h4>
             
                <input type="text" class="form-control" id="training_name" name="training_name" placeholder="Training Name" value="{{ old('training_name')!='' ? old('training_name') : ((isset($training_details) && $training_details->training_name!='') ? $training_details->training_name : '') }}">
              </div> 
              <div id="training_name_err"></div>             
              <div class="form-group">
                <h4 class="example-title">Training Period&nbsp;<span class="required_filed">*</span></h4>               
                <div class="example">
                  <div class="input-daterange" data-plugin="datepicker">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                      </span>
                      <input type="text" class="form-control" name="start_date" id="start_date" value="{{ old('start_date')!='' ? old('start_date') : ((isset($training_details) && $training_details->start_date!='') ? date('M d, Y', strtotime($training_details->start_date)) : '') }}" />                      
                    </div> 
                                         
                    <div class="input-group">
                      <span class="input-group-addon">to</span>
                      <input type="text" class="form-control" name="end_date" id="end_date" value="{{ old('end_date')!='' ? old('end_date') : ((isset($training_details) && $training_details->end_date!='') ? date('M d, Y', strtotime($training_details->end_date)) : '') }}" />                      
                    </div>  
                  </div>    
                </div>
                <div class="col-xs-6 no-padding" id="start_date_err"></div>  
                <div class="col-xs-6 no-right-padding" id="end_date_err"></div>   
              </div>  
              <div class="clearfix"></div>          
              <div class="form-group">
                <h4 class="example-title">Location&nbsp;<span class="required_filed">*</span></h4>
                <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="{{ old('location')!='' ? old('location') : ((isset($training_details) && $training_details->location!='') ? $training_details->location : '') }}">               
              </div>
              <div id="location_err"></div>    
              <div class="form-group">
                <h4 class="example-title">Capacity&nbsp;<span class="required_filed">*</span></h4>
                <input type="text" class="form-control" id="capacity" name="capacity" placeholder="Capacity" value="{{ old('capacity')!='' ? old('capacity') : ((isset($training_details) && $training_details->capacity!='') ? $training_details->capacity : '') }}">               
              </div>
              <div id="capacity_err"></div> 
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
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="button" class="btn btn-primary waves-effect" id="training_btn" value="Save" onclick ="fnTraining()"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'trainings-list';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>
       </div>
      </form>
    </div>
  </div>
  <!-- Add training modal end -->
  <!-- Footer -->
  @include('layouts.footer')
  <script type="text/javascript">

  $("#data_table").DataTable( {        
"aoColumnDefs": [
      { "bSearchable": false, "aTargets": [ -2, -1 ] },
      { "bSortable": false, "aTargets": [ -2, -1 ] }
    ]
    });

  function init() {
                var input = document.getElementById('location');
                var autocomplete = new google.maps.places.Autocomplete(input);
            }

            google.maps.event.addDomListener(window, 'load', init);

    function fnDelete(arg)
    {
      if(confirm("Do you really want to delete this training?"))
      {
        document.location.href="delete_training/"+arg;
      }
    }

    function fnStatusChange(arg,status)
    {
      $.ajax({
        type: "POST",
        url: "training_status_change",
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
	
	//Import
	function fnImport()
  {
    $("#modal-import-trainings").modal('show');
  }

  //Add training
  function fnAddTraining()
  {
    $("#training_title").html("Add Training");
    $(".alert").remove();
    $("#training_btn").val("Save");
    $("#add_training_form")[0].reset();
    $("#training-modal").modal("show");
  }

  //Edit training
  function fnEditTraining(arg)
  {
    $("#training_title").html("Edit Training");
    $(".alert").remove();
    $.ajax({
        type: "GET",
        url: "edit-training/"+arg,
        dataType: "json", 
        
          success: function(response){ 
          var training_details = response.training_details;
          //filling the old values
          $("#job_role").val(training_details.job_role);
          $("#training_name").val(training_details.training_name);
          $("#start_date").val(training_details.start_date);
          $("#end_date").val(training_details.end_date);
          $("#location").val(training_details.location);
          $("#capacity").val(training_details.capacity);
          $("#id").val(training_details.id);
          $("#training_btn").val("Update");
          $("#training-modal").modal("show");
          
        }     
      });
  }

  function fnTraining()
    {
      var url;
      $(".alert").remove();
      if($("#id").val()!='')
          url = 'update-training';
      else
          url = 'add-training';
      $.ajax({
        type: "POST",
        url: url,
        data :   $("#add_training_form").serialize(),
        dataType: "json", 
        
        beforeSend: function(){ $("#btn_div").html("Updating...");},       
        success: function(response){ 
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="training_btn" value="Update" onclick ="fnTraining()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="training_btn" value="Save" onclick ="fnTraining()">');
          if(response.Success==1)
          {
            $("#add_training_form")[0].reset();
            window.location.href = "trainings-list";
          }
        } ,
         error: function(data){
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="training_btn" value="Update" onclick ="fnTraining()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="training_btn" value="Save" onclick ="fnTraining()">');
        var errors = data.responseJSON;
        if(errors.job_role)
        {
          $("#job_role_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.job_role+'</strong></div></div>');
        }
        if(errors.training_name)
        {
          $("#training_name_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.training_name+'</strong></div></div>');
        }
        if(errors.start_date)
        {
          $("#start_date_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.start_date+'</strong></div></div>');
        }
        if(errors.end_date)
        {
          $("#end_date_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.end_date+'</strong></div></div>');
        }
        if(errors.location)
        {
          $("#location_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.location+'</strong></div></div>');
        }
        if(errors.capacity)
        {
          $("#capacity_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.capacity+'</strong></div></div>');
        }
        
      }   
      });
    }

  </script>