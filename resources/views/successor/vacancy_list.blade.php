@include('layouts.header', ['page_title' => 'Vacancy List'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Vacancy List</h1>
     
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
                    Vacancy status updated successfully!
                </div>
                </div>  
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div class="text-xs-right">
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnAddVacancy()">Add Vacancy</button></div>
                    <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Vacant Position</th> 
                              <th>Instead of whom</th>
                              <th>Short Description</th>
                              <th>Is Filled</th>                      
                              <th>Status</th> 
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
                          <?php $sno = 1; ?>
                            @foreach ($vacancies as $vacancy)  
                            <tr>  
                                <td>{{$sno++}} </td>                             
                                <td>{{$vacancy->vacant_position}}</td>
                                <td>{{$vacancy->instead_of_whom}}</td>
                                <td><p>{{ $vacancy->description }}</p></td>
                                <td>@if($vacancy->is_filled==1) {{'Yes'}} @else{{'No'}}@endif</td>
                                <td class="actions" id="status_div_{{ $vacancy->id}}">@if($vacancy->status==0) <a onclick="fnStatusChange({{ $vacancy->id}},{{ $vacancy->status}})"><i class="btn btn-sm btn-warning waves-effect icon fa-eye-slash" aria-hidden="true"   title="Make Active"></i></a> @else <a onclick="fnStatusChange({{ $vacancy->id}},{{ $vacancy->status}})"><i class="btn btn-sm btn-success waves-effect icon fa-eye" aria-hidden="true" title="Make Inactive"></i></a> @endif</td>
                                <td class="actions">@if($vacancy->is_filled!=1) <a onClick="fnEditVacancy({{$vacancy->id}})"><i class="btn btn-sm btn-primary waves-effect icon fa-edit" aria-hidden="true" title="Edit"></i></a><a onClick="fnDelete({{ $vacancy->id}})"><i class="btn btn-sm btn-danger waves-effect icon fa-close" aria-hidden="true" title="Delete"></i></a>@endif</td>
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
  

  <!--- Add vacancy modal start -->
  <div class="modal fade in" id="vacancy-modal" role="dialog">    
    <div class="modal-dialog ">
      <form class="form-horizontal" id="add_vacancy_form" role="form" method="POST">
        <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title" id="vacancy_title">Add Vacancy</h4>
        </div>
        <div class="modal-body">         
            {{ csrf_field() }}     
          <div class="row row-lg col-xs-12">            
            <div class="col-xs-12">
              <div class="form-group">
                <label class="example-title">Vacant Position&nbsp;<span class="required_filed">*</span></label>
                <input type="text" class="form-control" id="vacant_position" name="vacant_position" placeholder="Vacant Position" value="{{ old('vacant_position')!='' ? old('vacant_position') : ((isset($vacancy_details) && $vacancy_details->vacant_position!='') ? $vacancy_details->vacant_position : '') }}">               
              </div>
              <div id="vacant_position_err"></div> 
              <div class="form-group">
                <label class="example-title">Instead of whom&nbsp;<span class="required_filed">*</span></label>
                <input type="text" class="form-control" id="instead_of_whom" name="instead_of_whom" placeholder="Instead of whom" value="{{ old('instead_of_whom')!='' ? old('instead_of_whom') : ((isset($vacancy_details) && $vacancy_details->instead_of_whom!='') ? $vacancy_details->instead_of_whom : '') }}">               
              </div>
              <div id="instead_of_whom_err"></div>    
                         
              <div class="form-group">
                <label class="example-title">Description&nbsp;<span class="required_filed">*</span></label>
                <textarea class="form-control" id="description" name="description" placeholder="Description">{{ old('description')!='' ? old('description') : ((isset($vacancy_details) && $vacancy_details->description!='') ? $vacancy_details->description : '') }}</textarea>               
              </div>
              <div id="description_err"></div>    
              
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>            
          </div>        
        </div>
        <div class="modal-footer">
          <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="@if(isset($id) && $id!='') {{  $id }}@endif">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="button" class="btn btn-primary waves-effect" id="vacancy_btn" value="Save" onclick ="fnVacancy()"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'vacancy-list';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>
         </div>
       </div>
      </form>
    </div>
  </div>
  <!-- Add vacancy modal end -->
  <!-- Footer -->
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
        document.location.href="delete_vacancy/"+arg;
      }
    }

    function fnStatusChange(arg,status)
    {
      $.ajax({
        type: "POST",
        url: "vacancy_status_change",
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

  $('#multiple_days').change(function() {
    $("#multiple_days_div").css("display","none");
    $("#single_day_div").css("display","block");
    $("#from_date_err").html('');
    $("#to_date_err").html('');

    if($(this).is(":checked")) {
      $("#multiple_days_div").css("display","block");
      $("#single_day_div").css("display","none");
      $("#single_day_err").html('');
    }
    });


  $("#multiple_days").click(function(){ 
        var element = $(this).find('option:selected'); 
        fnClient(element.val());
        getSpecicalRequest(element.val());
        getShippingDetails(element.val());
        getPetId();
       
         
    }); 

  //Add vacancy
  function fnAddVacancy()
  {
    $("#vacancy_title").html("Add Vacancy");
    $(".alert").remove();
    $("#vacancy_btn").val("Save");
    $("#add_vacancy_form")[0].reset();
    $("#vacancy-modal").modal("show");
  }

  //Edit vacancy
  function fnEditVacancy(arg)
  {
    $("#vacancy_title").html("Edit Vacancy");
    $(".alert").remove();
    $.ajax({
        type: "GET",
        url: "edit-vacancy/"+arg,
        dataType: "json", 
        
          success: function(response){ 
          var vacancy_details = response.vacancy_details;
          
          $("#vacant_position").val(vacancy_details.vacant_position);
          $("#instead_of_whom").val(vacancy_details.instead_of_whom);
          $("#description").val(vacancy_details.description);
          $("#id").val(vacancy_details.id);
          $("#vacancy_btn").val("Update");
          $("#vacancy-modal").modal("show");
          
        }     
      });
  }

  function fnVacancy()
    {
      var url;
      $(".alert").remove();
      if($("#id").val()!='')
          url = 'update-vacancy';
      else
          url = 'add-vacancy';
      $.ajax({
        type: "POST",
        url: url,
        data :   $("#add_vacancy_form").serialize(),
        dataType: "json", 
        
        beforeSend: function(){ $("#btn_div").html("Updating...");},       
        success: function(response){ 
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="vacancy_btn" value="Update" onclick ="fnVacancy()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="vacancy_btn" value="Save" onclick ="fnVacancy()">');
          if(response.Success==1)
          {
            $("#add_vacancy_form")[0].reset();
            window.location.href = "vacancy-list";
          }
        } ,
         error: function(data){
          if($("#id").val()!='')
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="vacancy_btn" value="Update" onclick ="fnVacancy()">');
          else
            $("#btn_div").html('<input type="button" class="btn btn-primary waves-effect" id="vacancy_btn" value="Save" onclick ="fnVacancy()">');
        var errors = data.responseJSON;
        if(errors.vacant_position)
        {
          $("#vacant_position_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.vacant_position+'</strong></div></div>');
        }
        if(errors.instead_of_whom)
        {
          $("#instead_of_whom_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.instead_of_whom+'</strong></div></div>');
        }
        if(errors.description)
        {
          $("#description_err").html('<div class="flash-message"><div class="alert alert-danger"><strong>'+errors.description+'</strong></div></div>');
        }        
        
      }   
      });
    }

  </script>