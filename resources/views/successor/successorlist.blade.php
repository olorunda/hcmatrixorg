@include('layouts.header', ['page_title' => 'Nominated Successors List'])

  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Nominated Successors List</h1>     
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
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
                  <!--<table data-toggle="table" class="table table-striped" data-mobile-responsive="true" data-pagination="true" data-search="true">-->
                  <div class="clearfix"><br/></div>
                  <table class="table table-hover tabletable-striped dataTable" id="data_table">
                      <thead> 
                          <tr>
                              <th>S.No</th>
                              <th>Name</th> 
                              @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
                                <th>People Manager</th>
                              @endif
                              <th>Vacant Position</th>
                              <th>Comments</th> 
                              <th>Nominated Date</th> 
                              <th>Nomination Status</th> 
                              @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
                                  <th>Action</th> 
                              @endif
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            @foreach ($successors as $successor)                            
                            <tr>
                                <td>{{$sno++}} </td>                                
                                <td>{{ $successor->name }} ({{ $successor->emp_num }})</td>
                                @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
                                  <td>{{ $successor->people_manager }}</td>
                                @endif
                                <td>{{$successor->vacant_position}} ({{$successor->instead_of_whom}})</td>
                                <td>{{ $successor->comments }}</td>
                                <td>{{ date("M d, Y", strtotime($successor->nominated_on)) }}</td>
                                @if($successor->approval_status==0)
                                  <td>
                                      <span class="tag tag-pill tag-dark">Pending</span>
                                  </td>
                                @else
                                  <td>
                                    <span class="tag tag-pill tag-success">Approved</span>
                                  </td>
                                @endif
                                @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
                                  @if($successor->approval_status==0 && Auth::user()->role==Config::get('constants.roles.Admin_User') && $successor->is_filled==0)
                                    <td class="actions">
                                      <a onclick="fnSubmit({{ $successor->id }})"><i class="btn btn-sm btn-warning waves-effect icon fa-plus" aria-hidden="true" alt="Approve" ></i></a>
                                    </td>
                                  @else
                                    <td>
                                      <i class="btn btn-sm btn-warning waves-effect disabled icon fa-plus" aria-hidden="true"></i>
                                    </td>
                                  @endif
                                @endif 
                            </tr>                            
                            @endforeach 
                      </tbody> 
                  </table>    
                  <form id="update_form" action="successorupdate" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id = "successor_id" value="">
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
  <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')){ ?>
  $("#data_table").DataTable( {        
"aoColumnDefs": [
      { "bSearchable": false, "aTargets": [ -2, -1 ] },
      { "bSortable": false, "aTargets": [ -1 ] }
    ]
    });
  <?php } else { ?>
  $("#data_table").DataTable( {        
"aoColumnDefs": [
      { "bSearchable": false, "aTargets": [ -1] }
    ]
    });
<?php } ?>

    function fnSubmit(arg)
    {
      $("#successor_id").val(arg);
      $("#update_form").submit();
    }
  </script>