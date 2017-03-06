<?php $title = 'Default Weekend Days'; ?>
<?php echo $__env->make('layouts.header', ['page_title' => $title], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title"><?php echo e($title); ?></h1>
     
    </div>
    <div class="page-content">
      <div class="panel">
        
        <div class="panel-body container-fluid">
          <div class="row row-lg col-xs-12"> 
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
      <?php if(count($errors)>0): ?>
                <div class="flash-message">
                <div class="alert alert-danger">
                    <?php echo e($errors->first()); ?> 
                </div>
                </div>
            <?php endif; ?> 
          <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('update_weekend_days')); ?>">
            <?php echo e(csrf_field()); ?>     
                     
            <div class="col-xs-6">              
                <?php //print_r($roles); ?>
                <h4 class="example-title">Select the weekend days of a week</h4>
                <?php $__currentLoopData = $week_end_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $week_end_det): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>  
                  <?php
                  $chked = '';
                  if($week_end_det->weekend_status==1)
                    $chked = "checked=checked";
                  ?>
                  <div class="form-group">
                    <div class="col-xs-1"><input type='checkbox' name='weekend_day[]' id='<?php echo e(strtolower($week_end_det->weekend_day)); ?>_chk' <?php echo e($chked); ?> value='<?php echo e($week_end_det->weekend_day); ?>'></div><div class="col-xs-11"><label><?php echo e($week_end_det->weekend_day); ?></label> </div>  
                  </div>                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>                   
              
                <?php if($errors->has('weekend_day')): ?>
                    <div class="flash-message">
                      <div class="alert alert-danger">
                        <strong><?php echo e($errors->first('weekend_day')); ?></strong>
                      </div>
                    </div>
                  <?php endif; ?>
              
            </div>
            <div class="clearfix hidden-sm-down hidden-lg-up"></div>
            <div class="col-xs-12">
              <!-- Example Textarea -->
              <div class="form-group">
                <div class="text-xs-left"><span class="no-left-padding" id="btn_div"><input type="submit" class="btn btn-primary waves-effect" id="training_btn" value="Save"></span>
                <span class="no-left-padding"><input type="button" class="btn btn-default waves-effect" value="Cancel" onclick="window.location = 'edit-weekend_days';"></span></div>
              </div>
              <!-- End Example Textarea -->
            </div>          
          </form>
          </div>
        </div>
      </div>
    </div>

  
  </div>
  <!-- End Page -->
  <!-- Footer -->
  <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <script>
            function init() {
                var input = document.getElementById('location');
                var autocomplete = new google.maps.places.Autocomplete(input);
            }

            google.maps.event.addDomListener(window, 'load', init);
        </script>