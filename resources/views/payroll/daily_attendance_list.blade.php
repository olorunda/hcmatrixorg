@include('layouts.header', ['page_title' => 'Employee List'])

  <!-- Page -->
  <div class="page">
      <div class="page-header">
      <h1 class="page-title">Employees List</h1>
     
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
                              <th>Employee #</th> 
                              <th>Name</th> 
                              <th>Date of Birth (age)</th> 
                              <th>Email</th> 
                              <th>Phone number</th> 
                              <th>Role</th> 
                              @if(Auth::user()->role==Config::get('constants.roles.Admin_User') || Auth::user()->role==Config::get('constants.roles.People_Manager'))
                                <th>Action</th> 
                              @endif
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            @foreach ($employees as $employee)                            
                            <tr>
                                <td>{{$sno++}} </td>  
                                <td>{{ $employee->emp_num }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ date("M d, Y", strtotime($employee->dob)) }} ({{ $employee->age }})</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone_num }}</td>
                                <td>
                                    @if($employee->role==Config::get('constants.roles.Admin_User')) {{'Admin'}} @endif
                                    @if($employee->role==Config::get('constants.roles.People_Manager')) {{'People Manager'}} @endif
                                    @if($employee->role==Config::get('constants.roles.Employee')) {{'Employee'}} @endif
                                    @if($employee->role==Config::get('constants.roles.Doctor')) {{ 'Doctor'}} @endif
                                    @if($employee->role==Config::get('constants.roles.Factory_Employee')) {{ 'Factory Employee'}} @endif
                                </td>
                                @if(Auth::user()->role==Config::get('constants.roles.Admin_User') || Auth::user()->role==Config::get('constants.roles.People_Manager'))
                                  <td class="actions">
                                      <a onClick="fnSubmit({{ $employee->id }})"><i class="btn btn-sm btn-primary waves-effect icon fa-eye" aria-hidden="true" title="View"></i></a>
                                  </td>
                              @endif
                            </tr>                            
                            @endforeach 
                      </tbody> 
                  </table>    
                        <form id="view_form" action="{{ url('/view-emp-daily-attendance')}}" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id = "emp_id" value="">
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
      $("#emp_id").val(arg);
      $("#view_form").submit();
    }
</script>