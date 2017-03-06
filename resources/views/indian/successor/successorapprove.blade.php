  @include('layouts.header', ['page_title' => 'Successor Nominee List'])
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Successor Nominee List</h1>     
    </div>
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">
          <div class="row row-lg">
            @if (session('success'))
                <div class="flash-message">
                <div class="alert alert-success">
                    Successor Approved successfully!
                </div>
                </div>
            @endif
            @if (session('error'))
                <div class="flash-message">
                <div class="alert alert-danger">
                    Successor already Approved!
                </div>
                </div>
            @endif
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" >
                <div class="card-block p-0">
                  <!--<table class="table table-striped">-->
                  <!--<table data-toggle="table" class="tabletable-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Successor #</th> 
                              <th>Name</th> 
                              <th>DOB</th> 
                              <th>Age</th>
                              <th>E-Mail</th>
                              <th>Action</th>
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            @foreach ($successors as $successor)                            
                            <tr>
                                <td>{{$sno++}} </td> 
                                <td>{{ $successor->emp_num }}</td>
                                <td>{{ $successor->emp_name }}</td>
                                <td>@if($successor->dob!='' && $successor->dob!="0000-00-00") {{ date("M d, Y", strtotime($successor->dob)) }} @endif</td>
                                <td>{{ $successor->age }}</td>                                
                                <td>{{ $successor->email }}</td>
                                <td class="actions"><a onclick="fnSubmit({{ $successor->id }})"><i class="btn btn-sm btn-primary waves-effect icon fa-plus" aria-hidden="true" title="approve Successor"></i></a></td>
                            </tr>                            
                            @endforeach
                      </tbody> 
                  </table>
                  <form id="update_form" action="successorupdate" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id = "employee_id" value="">
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
      $("#employee_id").val(arg);
      $("#update_form").submit();
    }
  </script>