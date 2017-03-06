<?php echo $__env->make('layouts.header', ['page_title' => 'Sick Leave Requests'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                            <?php $__currentLoopData = $diagnosis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diag): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>                            
                            <tr>
                                <td><?php echo e($sno++); ?> </td>  
                                <td><?php echo e($diag->employee_name); ?></td>
                                <td><?php echo e($diag->doctor_name); ?></td>
                                <td><?php echo e(date("M d, Y", strtotime($diag->diagnosis_date))); ?></td>
                                <td><?php echo e($diag->doctor_recommendation); ?></td>
                                <td><?php echo e($diag->total_leave_days); ?> days<br/>from <?php echo e(date("M d, Y", strtotime($diag->leave_from))); ?><br/>to <?php echo e(date("M d, Y", strtotime($diag->leave_to))); ?></td>
                                <td><?php if($diag->external_leave_type==1): ?> <?php echo e('External'); ?> <?php else: ?> <?php echo e('Internal'); ?><?php endif; ?></td>
                                <td><?php if($diag->medical_report!=''  && file_exists(public_path('medical_reports').'/'.$diag->medical_report)): ?><a href="public/medical_reports/<?php echo $diag->medical_report; ?>" target="_blank"><?php echo e($diag->medical_report); ?></a> <?php endif; ?></td>
                                <td><?php if($diag->leave_status ==Config::get('constants.leave_status.PENDING')): ?> <?php echo e('Pending'); ?> <?php elseif($diag->leave_status ==Config::get('constants.leave_status.APPROVED')): ?> <?php echo e('Approved'); ?> <?php elseif($diag->leave_status ==Config::get('constants.leave_status.CANCELLED')): ?> <?php echo e('Cancelled'); ?> <?php endif; ?></td>
                            </tr>                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> 
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
  <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <script type="text/javascript">

  $("#data_table").DataTable();
</script>
 