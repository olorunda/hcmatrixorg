@include('layouts.header', ['page_title' => 'Filled Surveys'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Filled Surveys</h1>
     
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
                              <th>Employee Name</th> 
                              <th>Training Name</th> 
                              <th>Survey Name</th>                   
                              <th>Submitted Date</th> 
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
					  <?php $sno = 1; ?>
                            @foreach ($surveys as $survey)                            
                            <tr>
							<td>{{$sno++}} </td>
                                <td>{{ $survey->emp_name }}</td>
                                <td>{{ $survey->training_name }}</td>
                                <td>{{ $survey->survey_name }}</td>
                                <td >{{ date("M d, Y", strtotime($survey->submitted_date)) }}</td>
                                <td><i class="btn btn-primary waves-effect icon fa-eye" aria-hidden="true" onclick="fnSubmit({{ $survey->id }})" title="View"></i></td>
                            </tr>                            
                            @endforeach 
                      </tbody> 
                  </table>   
                  <div class="text-xs-left"><input type="button" class="btn btn-default waves-effect" value="Back" onclick="back_btn();"></div>
                  <form id="view_form" action="{{ url('/filled-surveys-view')}}" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id = "survey_id" value="">
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
      $("#survey_id").val(arg);
      $("#view_form").submit();
    }
    function back_btn()
    {
        window.location = "{{ url('/filled-surveys-list')}}";
    }

  </script>