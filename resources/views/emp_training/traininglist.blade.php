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
                              <th>Job Role</th> 
                              <th>Training Name</th> 
                              <th>Training Duration</th> 
                              <th>Training Location</th> 
                              <th>Capacity</th>                              
                              <th>Status</th> 
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            @foreach ($trainings as $training)                            
                            <tr>
                                <td>{{$sno++}} </td>
                                <td>@if($training->job_role==Config::get('constants.roles.Employee')) {{'Employee'}} @endif</td>
                                <td>{{ $training->training_name }}</td>
                                <td>{{ date("M d, Y", strtotime($training->start_date)) }} to {{ date("M d, Y", strtotime($training->end_date)) }}</td>
                                <td>{{ $training->location }}</td>
                                <td>{{ $training->capacity }}</td>
                                <td class="actions"><a onclick="fnSubmit({{ $training->id }})"><i class="btn btn-sm btn-primary waves-effect icon fa-plus" aria-hidden="true"></i></a></td>
                                
                            </tr>                            
                            @endforeach 
                      </tbody> 
                  </table>   
                    <form id="create_form" action="apply-training" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id = "training_id" value="">
                  </form>
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
      { "bSearchable": false, "aTargets": [ -1 ] },
      { "bSortable": false, "aTargets": [ -1 ] }
    ]
    });
    function fnSubmit(arg)
    {
      $("#training_id").val(arg);
       $("#create_form").submit();
    }

  </script>