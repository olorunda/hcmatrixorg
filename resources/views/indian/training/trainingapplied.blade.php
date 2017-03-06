@include('layouts.header', ['page_title' => 'Applied Training List'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Applied Training List</h1>
     
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
                    Training status updated successfully!
                </div>
                </div>  
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">
                      <thead> 
                          <tr>
                              <th>Employee Name</th> 
                              <th>Training Name</th> 
                              <th>Training Duration</th> 
                              <th>Training Location</th> 
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
                            @foreach ($trainings as $training)                            
                            <tr>
                                <td>{{ $training->emp_name }}</td>
                                <td>{{ $training->training_name }}</td>
                                <td>{{ date("M d, Y", strtotime($training->start_date)) }} to {{ date("M d, Y", strtotime($training->end_date)) }}</td>
                                <td>{{ $training->location }}</td>
                                <td id="status_div_{{ $training->id}}">
                                    <i class="btn btn-warning waves-effect icon fa-eye-slash" aria-hidden="true" title="Disapproved" onclick="fnStatusChange({{ $training->id }},'Disapproved')"></i>
                                    <i class="btn btn-info waves-effect icon fa-users" aria-hidden="true" title="Waitlisted" onclick="fnStatusChange({{ $training->id }},'Waitlisted')"></i>
                                    <i class="btn btn-success waves-effect icon fa-save" aria-hidden="true" title="Approve" onclick="fnStatusChange({{ $training->id }},'Approve')"></i>
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
    function fnStatusChange(id,status)
    {
      $("#training_id").val(id);
      $("#training_status").val(status);
       $("#status_form").submit();
    }

  </script>