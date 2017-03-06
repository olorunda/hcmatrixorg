@include('layouts.header', ['page_title' => 'Filled Surveys List'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Filled Surveys List</h1>
     
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
                    flash message
                </div>
                </div>  
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr> 
                               <th>S.No</th>
                              <th>Training Name</th> 
                              <th>Survey Name</th>                   
                              <th>Total Submitted</th> 
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
                                <td>{{ $survey->total_submitted }}</td>
                                <td><i class="btn btn-primary waves-effect icon fa-sign-in" aria-hidden="true" onclick="fnSubmit({{ $survey->training_id }})" title="View"></i></td>
                            </tr>                            
                            @endforeach 
                      </tbody> 
                  </table>   
                  <form id="view_form" action="{{ url('/filled-surveys')}}" method="post">
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
      { "bSearchable": false, "aTargets": [ -2, -1 ] },
      { "bSortable": false, "aTargets": [ -2, -1 ] }
    ]
    });
   function fnSubmit(arg)
    {
      $("#training_id").val(arg);
      $("#view_form").submit();
    }

  </script>