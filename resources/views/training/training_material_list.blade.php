@include('layouts.header', ['page_title' => 'Training Materials List'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Training Materials List</h1>
     
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
            <div class="flash-message">
                <div class="alert alert-success" id="status_div" style="display:none;">
                    Training material status updated successfully!
                </div>
                </div>  
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div class="text-xs-right">
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnAddTrainingMaterial()">Add Training Material</button></div>
                  <!--<table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
							  <th>S.No</th> 
                              <th>Job Training Name</th> 
                              <th>Pre / Post Reading</th> 
                              <th>Training Material Name</th> 
                              <th>Training Material</th>                              
                              <th>Status</th> 
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
						  <?php $sno = 1; ?>
                            @foreach ($training_materials as $training_materials)                            
                            <tr>
								<td>{{ $sno++ }}</td>
                                <td>{{ $training_materials->training_name }}</td>
                                <td>@if($training_materials->reading_type==0) {{ 'Pre Reading' }} @elseif($training_materials->reading_type==1) {{ 'Post Reading' }}@endif</td>
                                <td>{{ $training_materials->training_material_name }}</td>
                                <td>@if(isset($training_materials) && $training_materials->training_material!='' && file_exists(public_path('uploads').'/'.$training_materials->training_material)) <a href="public/uploads/<?php echo $training_materials->training_material; ?>" target="_blank">{{$training_materials->training_material}}</a> @endif</td>
                                <td class="actions" id="status_div_{{ $training_materials->id}}">@if($training_materials->status==0) <a onclick="fnStatusChange({{ $training_materials->id}},{{ $training_materials->status}})"><i class="btn btn-sm btn-warning waves-effect icon fa-eye-slash" aria-hidden="true" title="Make Active"></i></a> @else <a onclick="fnStatusChange({{ $training_materials->id}},{{ $training_materials->status}})"><i class="btn btn-sm btn-success waves-effect icon fa-eye" aria-hidden="true" title="Make Inactive" ></i></a> @endif</td>
                                <td class="actions"><a onClick="fnEditTrainingMaterial({{$training_materials->id}})"><i class="btn btn-sm btn-primary waves-effect icon fa-edit" aria-hidden="true" title="Edit"></i></a><a onClick="fnDelete({{ $training_materials->id}})"><i class="btn btn-sm btn-danger waves-effect icon fa-close" aria-hidden="true"  title="Delete"></i></a></td>
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
  <!-- Footer -->
  <!--- Add training material modal start -->
  <div class="modal fade in" id="training-material-modal" role="dialog">
    <div class="modal-dialog ">
      <form class="form-horizontal" id="add_training_material_form" role="form" method="POST" enctype="multipart/form-data">
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
                <?php //print_r($trainings); ?>
                <h4 class="example-title">Job Training Name&nbsp;<span class="required_filed">*</span></h4>
                <select class="form-control" id="training_id" name="training_id">
                  <option value = ''>Select</option>
                    @foreach($trainings as $training)  
                      @if($training->training_name!='' && $training->id!=0)
                        <option value = "{{ $training->id}}" {{ ((old("training_id")!='' && old("training_id") ==  $training->id)) ? "selected=selected":"" }}>{{$training->training_name}}
                        </option>
                      @endif
                    @endforeach                   
                  </select>                 
              </div>
              <div id="training_id_err"></div>
              <div class="form-group">
                <h4 class="example-title">Pre / Post Reading&nbsp;<span class="required_filed">*</span></h4>
                <select class="form-control" id="reading_type" name="reading_type">
                  <option value = ''>Select</option>
                  <option value = "0" {{ ((old("reading_type")!='' && old("reading_type") ==  0)) ? "selected=selected" :"" }}>Pre Reading
                  </option>  
                  <option value = "1" {{ ((old("reading_type")!='' && old("reading_type") ==  1)) ? "selected=selected" :"" }}>Post Reading
                  </option>               
                  </select> 
              </div>  
              <div id="reading_type_err"></div>    
              <div class="form-group">
                <h4 class="example-title">Training Material Name&nbsp;<span class="required_filed">*</span></h4>
             
                <input type="text" class="form-control" id="training_material_name" name="training_material_name" placeholder="Training Material Name" value="{{ old('training_material_name')!='' ? old('training_material_name') : '' }}">
              </div> 
              <div id="training_material_name_err"></div>    
              <div class="form-group">
                <h4 class="example-title">Training Material&nbsp;<span class="required_filed">*</span></h4>
                  <input type="file" name="training_material" id="training_material">
                  <div id="training_file"></div>

              </div> 
              <div id="training_material_err"></div> 
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
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="button" class="btn btn-primary waves-effect" id="training_btn" value="Save" onclick ="fnTrainingMaterial()"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'training-material-list';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>
       </div>
      </form>
    </div>
  </div>
  <!-- Add training material modal end -->
  @include('layouts.footer')
  <script type="text/javascript">

  $("#data_table").DataTable( {        
"aoColumnDefs": [
      { "bSearchable": false, "aTargets": [ -2, -1 ] },
      { "bSortable": false, "aTargets": [ -2, -1 ] }
    ]
    });
    function fnDelete(arg)
    {
      if(confirm("Do you really want to delete this training?"))
      {
        document.location.href="delete_training_material/"+arg;
      }
    }

    function fnStatusChange(arg,status)
    {
      $.ajax({
        type: "POST",
        url: "training_material_status_change",
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

    //Add training material
  function fnAddTrainingMaterial()
  {
    $("#training_title").html("Add Training Material");
    $(".alert").remove();
    $("#training_btn").val("Save");
    $("#add_training_material_form")[0].reset();
    $("#training-material-modal").modal("show");
  }

  //Edit training
  function fnEditTrainingMaterial(arg)
  {
    $("#training_title").html("Edit Training Material");
    $(".alert").remove();
    $.ajax({
        type: "GET",
        url: "edit-training-material/"+arg,
        dataType: "json", 
        
          success: function(response){ 
          var training_materials = response.training_materials;
          //filling the old values
          $("#training_id").val(training_materials.training_id);
          $("#reading_type").val(training_materials.reading_type);
          $("#training_material_name").val(training_materials.training_material_name);
          if(training_materials.training_material!='')
          {
              $("#training_file").html('<a href="public/uploads/'+training_materials.training_material+'" target="_blank">'+training_materials.training_material+'</a>');
          }
          
          $("#id").val(training_materials.id);
          $("#training_btn").val("Update");
          $("#training-material-modal").modal("show");
          
        }     
      });
  }

  function fnTrainingMaterial()
    {
      var inputData = new FormData($("#add_training_material_form")[0]);
       jQuery($('#training_material')[0].files, function(file) {
            inputData.append('training_material', file);
        });
       $(".alert").remove();

      //console.log(inputData);
      var url;
      if($("#id").val()!='')
          url = 'update-training-material';
      else
          url = 'add-training-material';
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
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="training_btn" value="Update" onclick ="fnTrainingMaterial()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="training_btn" value="Save" onclick ="fnTrainingMaterial()">');
          if(response.Success==1)
          {
            $("#add_training_material_form")[0].reset();
            window.location.href = "training-material-list";
          }
        } ,
         error: function(data){
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="training_btn" value="Update" onclick ="fnTrainingMaterial()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="training_btn" value="Save" onclick ="fnTrainingMaterial()">');
        var errors = data.responseJSON;
        if(errors.training_id)
        {
          $("#training_id_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.training_id+'</strong></div></div>');
        }
        if(errors.reading_type)
        {
          $("#reading_type_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.reading_type+'</strong></div></div>');
        }
        if(errors.training_material_name)
        {
          $("#training_material_name_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.training_material_name+'</strong></div></div>');
        }
        if(errors.training_material)
        {
          $("#training_material_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.training_material+'</strong></div></div>');
        }
        
      }   
      });
    }

  </script>