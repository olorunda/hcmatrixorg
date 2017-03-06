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
                  <!--<table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Training Name</th> 
                              <th>Survey Name</th> 
                              <th>Total Questions</th> 
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
                                <td class="actions">
									@if(empty($survey->post_id))
										<a onclick="fnSubmit({{ $survey->id }})"><i class="btn btn-sm btn-primary waves-effect icon fa-sign-in" aria-hidden="true" title="Enter the survey"></i></a>
                                    @else
                                      <i class="btn btn-primary waves-effect icon fa-eye" aria-hidden="true" onclick="fnView({{ $survey->post_id }})" title="View"></i>
                                    @endif
								</td>   
                            </tr>                            
                            @endforeach 
                      </tbody> 
                  </table>  
                    <form id="create_form" action="training-survey-post" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id = "survey_id" value="">
                  </form>
                  <form id="view_form" action="{{ url('/filled-surveys-view')}}" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id = "view_survey_id" value="">
                    <input type="hidden" name="back_link" id = "back_link" value="training-survey-list">
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
      $("#survey_id").val(arg);
       $("#create_form").submit();
    }
    function fnView(arg)
    {
      $("#view_survey_id").val(arg);
      $("#view_form").submit();
    }
   
  </script>