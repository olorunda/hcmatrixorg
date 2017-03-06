@include('layouts.header', ['page_title' => 'Employees Payroll'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Employees Payroll</h1>
     
    </div>
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">
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
                  <!--<table data-toggle="table" class="table table-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Employee #</th> 
                              <th>Name</th> 
                              <th>Basic Pay</th>
                              <th>Month - Year</th>                             
                              <th>Action</th> 
                              
                          </tr> 
                      </thead> 
                      
                      <tbody> 
                      <?php $sno = 1;  ?>

                      @if(count($employees)>0)
                      @foreach($employees as $employee)                         
                            <tr>
                                <td>{{$sno++}} </td>  
                                <td>{{ $employee->emp_num }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->basicpay }}</td>
                                <td>{{ $employee->month_year }}</td>
                                <td class="actions"> 
                                 @if($employee->ps_issued!=0 &&$employee->ps_file!='' && file_exists(public_path('psc').'/'.$employee->ps_file))                                     
                                        <a href="public/psc/<?php echo $employee->ps_file; ?>" download target="_blank"><i class="btn btn-sm btn-success waves-effect icon fa-download" aria-hidden="true" title="Download Payslip Certificate"></i></a>                                                                 
                                 @endif
                               </td>
                            </tr> 
                           @endforeach  
                           @endif     
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
<?php if(isset($employee) && $employee->ps_issued!=0 &&$employee->ps_file!='' && file_exists(public_path('psc').'/'.$employee->ps_file)) { ?>
  $("#data_table").DataTable( {        
"aoColumnDefs": [
      { "bSearchable": false, "aTargets": [ -1 ] },
      { "bSortable": false, "aTargets": [ -1 ] }
    ]
    });
  <?php } else { ?>
    $("#data_table").DataTable();
    <?php } ?>
</script>