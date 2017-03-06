<?php echo $__env->make('layouts.header', ['page_title' => 'Daily Attendance'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <!-- Page -->
  <div class="page">
      <div class="page-header">
      <h1 class="page-title">Daily Attendance</h1>
     
    </div>
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">
          <div class="row row-lg">     
            <?php if(session('success')): ?>
                <div class="flash-message">
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="flash-message">
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
                </div>
            <?php endif; ?> 
            <div class="col-xs-12 col-md-12">
              <!-- Widget Timeline -->
              <div class="card card-shadow card-responsive" id="widgetTimeline">
                <div class="card-block p-0">
				<div class="text-xs-right">
                        <?php /*<button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="window.location = 'view-daily-attendance';">View Daily attendance</button>*/ ?>
						<button class="btn btn-sm btn-primary waves-effect" type="button" onclick ="fnSubmit(<?php echo e(Auth::id()); ?>)">View Daily attendance</button>
                        <form id="view_form" action="<?php echo e(url('/view-daily-attendance')); ?>" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id = "emp_id" value="">
                  </form>  
                    </div>
                    <div class="clearfix"></div><br/>
                  <table class="table table-bordered table-striped">
                      <tbody> 
                           <tr>
                                <th>Employee #</th> 
                                <td><?php echo e($employee->emp_num); ?></td>
                            </tr>                            
                            <tr>
                                <th>Name</th> 
                                <td><?php echo e($employee->name); ?></td>
                            </tr> 
                            <tr>
                                <th>Date</th> 
                                <td><?php echo e(date("M d, Y, g:i a")); ?></td>
                            </tr> 
                      </tbody> 
                      <tfoot>
                          <tr>
                              <td colspan="2">
                                  <form id="basicpay_form" action="daily-attendance-update" method="post">
                                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                      <input type="hidden" name="num" id = "employee_num" value="<?php echo e($employee->emp_num); ?>">
                                  
                                  <?php if(!empty($condition)): ?>
                                      <?php if($condition=="weekend"): ?>
                                        Its a Weekend
                                      <?php elseif($condition=="holiday"): ?>
                                        Its a Holiday
                                      <?php elseif($condition=="leaveapproved"): ?>
                                        Its a Leave approved day
                                      <?php elseif($condition=="fullrecordexists"): ?>                                      
                                        Already Punching done
                                      <?php elseif($condition=="halfrecordexists"): ?>
                                          <?php $__currentLoopData = $daily_records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $daily_record): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>  
                                                <input type="hidden" name="record_id" value="<?php echo e($daily_record->id); ?>">
                                                <input type="submit" class="btn btn-primary" value="Out-Time" />
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      <?php endif; ?>                                       
                                  <?php else: ?>
                                      <input type="submit" class="btn btn-primary" value="In-Time" />
                                  <?php endif; ?>  
                                  </form>
                              </td>
                          </tr>                      
                      </tfoot>
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
   function fnSubmit(arg)
    {
      $("#emp_id").val(arg);
      $("#view_form").submit();
    }

  </script>