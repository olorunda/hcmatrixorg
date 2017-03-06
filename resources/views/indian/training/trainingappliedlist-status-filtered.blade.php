@include('layouts.header', ['page_title' => $title])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">{{ $title }}</h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        <div class="panel-body container-fluid">
          <div class="row row-lg">  
             
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
                              <th>Employee Num</th> 
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
                                <td>{{$sno++}} </td>
                                <td>{{ $training->emp_name }}</td>
                                <td>{{ $training->emp_num }}</td>
                                <td>{{ $training->training_name }}</td>
                                <td>{{ date("M d, Y", strtotime($training->start_date)) }} to {{ date("M d, Y", strtotime($training->end_date)) }}</td>
                                <td>{{ $training->location }}</td>
                                <td>{{ $training->capacity }}</td>    
                                <td>
                                    @if($training->status == Config::get('constants.training_status.NOT_APPROVED')) 
                                        <span class="tag tag-pill tag-danger">NOT APPROVED</span>
                                    @endif
                                    @if($training->status == Config::get('constants.training_status.WAITING'))
                                        <span class="tag tag-pill tag-info">WAITING LIST</span>
                                    @endif
                                    @if($training->status == Config::get('constants.training_status.APPROVED'))
                                        <span class="tag tag-pill tag-success">APPROVED</span>
                                    @endif
                                </td>  
                                <td class="actions" id="status_div_{{ $training->id}}">
                                    <a onclick="fnStatusChange({{ $training->id }},'Disapprove')"><i class="btn btn-sm btn-warning waves-effect icon fa-eye-slash" aria-hidden="true" title="Disapprove"></i></a>
                                    <a onclick="fnStatusChange({{ $training->id }},'Waitlisted')"><i class="btn btn-sm btn-info waves-effect icon fa-users" aria-hidden="true" title="Waitlist"></i></a>
                                    <a onclick="fnStatusChange({{ $training->id }},'Approve')"><i class="btn btn-sm btn-success waves-effect icon fa-save" aria-hidden="true" title="Approve"></i></a>
                                </td>                       
                            </tr>                            
                            @endforeach 
                      </tbody> 
                  </table>  
                  <form id="status_form" action="{{ url('/training_applied_status_change') }}" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id = "training_id" value="">
                    <input type="hidden" name="status" id = "training_status" value="">
                    
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
      { "bSortable": false, "aTargets": [ -1 ] }
    ]
    });
    function fnStatusChange(id,status)
    {
      $("#training_id").val(id);
      $("#training_status").val(status);
       $("#status_form").submit();
    }

  </script>