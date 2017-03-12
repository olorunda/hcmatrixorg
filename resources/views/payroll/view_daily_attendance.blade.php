@include('layouts.header', ['page_title' => 'Daily Attendance List'])

  <!-- Page -->
  <div class="page">
      <div class="page-header">
      <h1 class="page-title">Daily Attendance List</h1>
    </div>
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">
          <div class="row row-lg">     
            
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <!--<table data-toggle="table" class="table table-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Date</th> 
                              <th>Status</th> 
                              <th>In-time</th> 
                              <th>Out-time</th> 
                              @if(Auth::user()->role==Config::get('constants.roles.Admin_User') || Auth::user()->role==Config::get('constants.roles.People_Manager'))
                                  <th>Action</th> 
                              @endif
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            @foreach ($daily_attendances as $daily_attendance)                            
                            <tr>
                                <td>{{$sno++}} </td>  
                                <td>{{ date("M d, Y", strtotime($daily_attendance['date'])) }}</td>
                                <td>{{ $daily_attendance['title'] }}</td>
                                <td>{{ $daily_attendance['clock_in'] !='' ? date("g:i a", strtotime($daily_attendance['clock_in'])) : '' }}</td>
                                <td>{{ $daily_attendance['clock_out'] !='' ?date("g:i a", strtotime($daily_attendance['clock_out'])) : '' }}</td>
                                @if(Auth::user()->role==Config::get('constants.roles.Admin_User') || Auth::user()->role==Config::get('constants.roles.People_Manager'))
                                  <td class="actions">
                                      <a onClick="fnSubmit({{ $daily_attendance['attendance_id'] }}, {{$daily_attendance['date']}})"><i class="btn btn-sm btn-primary waves-effect icon fa-edit" aria-hidden="true" title="View"></i></a>
                                  </td>
                              @endif
                            </tr>                            
                            @endforeach 
                      </tbody> 
                  </table>    
                    @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
                      <button class="btn btn-sm btn-info waves-effect" type="button" onclick ="btn_back('admin');"><- Back</button>
                    @elseif(Auth::user()->role==Config::get('constants.roles.People_Manager'))
                      <button class="btn btn-sm btn-info waves-effect" type="button" onclick ="btn_back('poepleManager');"><- Back</button>
                    @else
                      <button class="btn btn-sm btn-info waves-effect" type="button" onclick ="btn_back('employee');"><- Back</button>
                    @endif
                    </div>  
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
<script>  

$("#data_table").DataTable();
//page redirect
  function btn_back(type)
  {
      if(type == 'admin') {
        window.location = "{{ url('/daily-attendance-list')}}";
    } else if(type == 'poepleManager') {
        window.location = "{{ url('/day-att-emp-list')}}";
    } else {
        window.location = "{{ url('/daily-attendance')}}";
    }
  }
</script>