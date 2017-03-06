@include('layouts.header', ['page_title' => 'Sick Leave Requests'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Sick Leave Requests</h1>
     
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
                              <th>Doctor Name</th> 
                              <th>Diagnosis Date</th> 
                              <th>Recommendation</th>
                              <th>Leave Duration</th> 
                              <th>Medical Checkup</th>
                              <th>Medical Report</th>                                          
                              <th>Leave Status</th> 
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            @foreach ($diagnosis as $diag)                            
                            <tr>
                                <td>{{$sno++}} </td>  
                                <td>{{$diag->employee_name}}</td>
                                <td>{{$diag->doctor_name}}</td>
                                <td>{{ date("M d, Y", strtotime($diag->diagnosis_date)) }}</td>
                                <td>{{ $diag->doctor_recommendation }}</td>
                                <td>{{ $diag->total_leave_days }} days<br/>from {{ date("M d, Y", strtotime($diag->leave_from)) }}<br/>to {{ date("M d, Y", strtotime($diag->leave_to)) }}</td>
                                <td>@if($diag->external_leave_type==1) {{ 'External'}} @else {{ 'Internal' }}@endif</td>
                                <td>@if($diag->medical_report!=''  && file_exists(public_path('medical_reports').'/'.$diag->medical_report))<a href="public/medical_reports/<?php echo $diag->medical_report; ?>" target="_blank">{{$diag->medical_report}}</a> @endif</td>
                                <td>@if($diag->leave_status ==Config::get('constants.leave_status.PENDING')) {{ 'Pending' }} @elseif ($diag->leave_status ==Config::get('constants.leave_status.APPROVED')) {{ 'Approved' }} @elseif ($diag->leave_status ==Config::get('constants.leave_status.CANCELLED')) {{ 'Cancelled' }} @endif</td>
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

  $("#data_table").DataTable();
</script>
 