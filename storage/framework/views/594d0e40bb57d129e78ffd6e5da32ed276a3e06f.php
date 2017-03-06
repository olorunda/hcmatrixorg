<?php echo $__env->make('layouts.header', ['page_title' => $title], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title"><?php echo e($title); ?></h1>
     
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
                            <?php $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>                            
                            <tr>
                                <td><?php echo e($sno++); ?> </td>
                                <td><?php echo e($training->emp_name); ?></td>
                                <td><?php echo e($training->emp_num); ?></td>
                                <td><?php echo e($training->training_name); ?></td>
                                <td><?php echo e(date("M d, Y", strtotime($training->start_date))); ?> to <?php echo e(date("M d, Y", strtotime($training->end_date))); ?></td>
                                <td><?php echo e($training->location); ?></td>
                                <td><?php echo e($training->capacity); ?></td>    
                                <td>
                                    <?php if($training->status == Config::get('constants.training_status.NOT_APPROVED')): ?> 
                                        <span class="tag tag-pill tag-danger">NOT APPROVED</span>
                                    <?php endif; ?>
                                    <?php if($training->status == Config::get('constants.training_status.WAITING')): ?>
                                        <span class="tag tag-pill tag-info">WAITING LIST</span>
                                    <?php endif; ?>
                                    <?php if($training->status == Config::get('constants.training_status.APPROVED')): ?>
                                        <span class="tag tag-pill tag-success">APPROVED</span>
                                    <?php endif; ?>
                                </td>  
                                <td class="actions" id="status_div_<?php echo e($training->id); ?>">
                                    <a onclick="fnStatusChange(<?php echo e($training->id); ?>,'Disapprove')"><i class="btn btn-sm btn-warning waves-effect icon fa-eye-slash" aria-hidden="true" title="Disapprove"></i></a>
                                    <a onclick="fnStatusChange(<?php echo e($training->id); ?>,'Waitlisted')"><i class="btn btn-sm btn-info waves-effect icon fa-users" aria-hidden="true" title="Waitlist"></i></a>
                                    <a onclick="fnStatusChange(<?php echo e($training->id); ?>,'Approve')"><i class="btn btn-sm btn-success waves-effect icon fa-save" aria-hidden="true" title="Approve"></i></a>
                                </td>                       
                            </tr>                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> 
                      </tbody> 
                  </table>  
                  <form id="status_form" action="<?php echo e(url('/training_applied_status_change')); ?>" method="post">
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
  <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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