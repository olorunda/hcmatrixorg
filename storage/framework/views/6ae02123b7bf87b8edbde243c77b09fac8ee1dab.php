<?php echo $__env->make('layouts.header', ['page_title' => 'Employee List'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
                              <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User') || Auth::user()->role==Config::get('constants.roles.People_Manager')): ?>
                                <th>Action</th> 
                              <?php endif; ?>
                          </tr> 
                      </thead> 
                      <tbody> 
                            <?php $sno = 1; ?>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>                            
                            <tr>
                                <td><?php echo e($sno++); ?> </td>  
                                <td><?php echo e($employee->emp_num); ?></td>
                                <td><?php echo e($employee->name); ?></td>
                                <td><?php echo e(date("M d, Y", strtotime($employee->dob))); ?> (<?php echo e($employee->age); ?>)</td>
                                <td><?php echo e($employee->email); ?></td>
                                <td><?php echo e($employee->phone_num); ?></td>
                                <td>
                                    <?php if($employee->role==Config::get('constants.roles.Admin_User')): ?> <?php echo e('Admin'); ?> <?php endif; ?>
                                    <?php if($employee->role==Config::get('constants.roles.People_Manager')): ?> <?php echo e('People Manager'); ?> <?php endif; ?>
                                    <?php if($employee->role==Config::get('constants.roles.Employee')): ?> <?php echo e('Employee'); ?> <?php endif; ?>
                                    <?php if($employee->role==Config::get('constants.roles.Doctor')): ?> <?php echo e('Doctor'); ?> <?php endif; ?>
                                    <?php if($employee->role==Config::get('constants.roles.Factory_Employee')): ?> <?php echo e('Factory Employee'); ?> <?php endif; ?>
                                </td>
                                <?php if(Auth::user()->role==Config::get('constants.roles.Admin_User') || Auth::user()->role==Config::get('constants.roles.People_Manager')): ?>
                                  <td class="actions">
                                      <a onClick="fnSubmit(<?php echo e($employee->id); ?>)"><i class="btn btn-sm btn-primary waves-effect icon fa-eye" aria-hidden="true" title="View"></i></a>
                                  </td>
                              <?php endif; ?>
                            </tr>                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> 
                      </tbody> 
                  </table>    
                        <form id="view_form" action="<?php echo e(url('/view-emp-daily-attendance')); ?>" method="post">
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
<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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