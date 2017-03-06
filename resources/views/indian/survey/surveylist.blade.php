@include('layouts.header', ['page_title' => 'Training Survey List'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Training Survey List</h1>
     
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
                    Survey status updated successfully!
                </div>
                </div>  
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <div class="text-xs-right">
                    <button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="document.location.href='add-survey'">Add Survey</button></div>
                  <!--<table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Training Name</th> 
                              <th>Survey Name</th> 
                              <th>Total Questions</th>                    
                              <th>Status</th> 
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            @foreach ($surveys as $survey)                            
                            <tr>
                                <td>{{$sno++}} </td>
                                <td>{{ $survey->training_name }}</td>
                                <td>{{ $survey->survey_name }}</td>
                                <td>{{ $survey->total_questions }}</td>
                                <td class="actions" id="status_div_{{ $survey->id}}">@if($survey->status==0) <a onclick="fnStatusChange({{ $survey->id}},{{ $survey->status}})"><i class="btn bt-sm btn-warning waves-effect icon fa-eye-slash" aria-hidden="true"   title="Make Active"></i></a> @else <a onclick="fnStatusChange({{ $survey->id}},{{ $survey->status}})"><i class="btn btn-sm btn-success waves-effect icon fa-eye" aria-hidden="true" title="Make Inactive"></i></a> @endif</td>
                                <td class="actions"><a onClick="document.location.href='edit-survey/{{$survey->id}}'"><i class="btn btn-sm btn-primary waves-effect icon fa-edit" aria-hidden="true" title="Edit"></i></a><a onClick="fnDelete({{ $survey->id}})"><i class="btn btn-sm btn-danger waves-effect icon fa-close" aria-hidden="true"  title="Delete"></i></a></td>
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
      if(confirm("Do you really want to delete this survey?"))
      {
        document.location.href="delete_survey/"+arg;
      }
    }

    function fnStatusChange(arg,status)
    {
      $.ajax({
        type: "POST",
        url: "survey_status_change",
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

  </script>