<?php echo $__env->make('layouts.header', ['page_title' => 'Nominated Successors List'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Nominated Successors List</h1>     
    </div>
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">
          <div class="row row-lg">   
            <?php if(session('success')): ?>
                <div class="flash-message">
                <div class="alert alert-success">
                    Successor Approved successfully!
                </div>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="flash-message">
                <div class="alert alert-danger">
                    Successor already Approved!
                </div>
                </div>
            <?php endif; ?>  
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
                              <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
                                <th>People Manager</th>
                              <?php endif; ?>
                              <th>Vacant Position</th>
                              <th>Comments</th> 
                              <th>Nominated Date</th> 
                              <th>Nomination Status</th> 
                              <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
                                  <th>Action</th> 
                              <?php endif; ?>
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            <?php $__currentLoopData = $successors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $successor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>                            
                            <tr>
                                <td><?php echo e($sno++); ?> </td>                                
                                <td><?php echo e($successor->name); ?> (<?php echo e($successor->emp_num); ?>)</td>
                                <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
                                  <td><?php echo e($successor->people_manager); ?></td>
                                <?php endif; ?>
                                <td><?php echo e($successor->vacant_position); ?> (<?php echo e($successor->instead_of_whom); ?>)</td>
                                <td><?php echo e($successor->comments); ?></td>
                                <td><?php echo e(date("M d, Y", strtotime($successor->nominated_on))); ?></td>
                                <?php if($successor->approval_status==0): ?>
                                  <td>
                                      <span class="tag tag-pill tag-dark">Pending</span>
                                  </td>
                                <?php else: ?>
                                  <td>
                                    <span class="tag tag-pill tag-success">Approved</span>
                                  </td>
                                <?php endif; ?>
                                <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User')): ?>
                                  <?php if($successor->approval_status==0 && Auth::user()->role==Config::get('constants.roles.Admin_User') && $successor->is_filled==0): ?>
                                    <td class="actions">
                                      <a onclick="fnSubmit(<?php echo e($successor->id); ?>)"><i class="btn btn-sm btn-warning waves-effect icon fa-plus" aria-hidden="true" alt="Approve" ></i></a>
                                    </td>
                                  <?php else: ?>
                                    <td>
                                      <i class="btn btn-sm btn-warning waves-effect disabled icon fa-plus" aria-hidden="true"></i>
                                    </td>
                                  <?php endif; ?>
                                <?php endif; ?> 
                            </tr>                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> 
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
<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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