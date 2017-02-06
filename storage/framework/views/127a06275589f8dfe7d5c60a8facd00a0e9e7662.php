<?php if(isset($direct)): ?>

<?php 
$cras = app('App\Repositories\EmployeeRepository')->getGoalTo(Auth::user()->id, $direct->id, 4); 
$cracnt = count($cras); 
?>
<?php if($cracnt > 0): ?>
<div class="row row-lg">
  <div class="col-md-12 col-xs-12">
    <div class="panel panel-bordered" style="margin-bottom: 4px;">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-line-chart"></i> Individual Development Plans</h3>
      </div>
      <div class="panel-body">
        <div class="panel-group panel-group-simple" id="career<?php echo e($direct->id); ?>" aria-multiselectable="true" role="tablist">
          <?php $__currentLoopData = $cras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cra): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
          <div class="panel">
            <div class="panel-heading" id="pilotHeadingModal1<?php echo e($direct->id); ?><?php echo e($cra->id); ?>" role="tab">
              <a class="panel-title" data-toggle="collapse" href="#pilotcollapsModal1<?php echo e($direct->id); ?><?php echo e($cra->id); ?>" data-parent="#career<?php echo e($direct->id); ?>" aria-expanded="false" aria-controls="pilotcollapsModal1<?php echo e($direct->id); ?><?php echo e($cra->id); ?>">
                <h5 class="text-warning">Commitment</h5>
              </a>
              <span class="text-default" style="word-wrap: break-word;">
                <?php echo e($cra->commitment); ?>

              </span>
            </div>
            <div class="panel-collapse collapse" id="pilotcollapsModal1<?php echo e($direct->id); ?><?php echo e($cra->id); ?>" aria-labelledby="pilotHeadingModal1<?php echo e($direct->id); ?><?php echo e($cra->id); ?>" role="tabpanel">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Objectvie</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li style="word-wrap: break-word;">
                        <?php echo e($cra->objective); ?>

                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Employee Comments</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li style="word-wrap: break-word;">
                        <?php if($cra->emp_comment==NULL): ?>
                        No comments yet.
                        <?php else: ?>
                        <?php echo e($cra->emp_comment); ?>

                        <?php endif; ?>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Line Manager Comment</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li>
                        <?php $lmcracmt = app('App\Http\Controllers\LMController')->getCommentd($direct->id, $cra->id); ?>
                        <br>
                        <p>
                          <a href="javascript:void(0)" onclick="editComm('cmal1<?php echo e($l); ?><?php echo e($direct->id); ?>')" id="edit"><i class="icon wb-edit"></i></a>
                          <i class="hide" id="status<?php echo e($l); ?>"></i>
                        </p>
                        <div class="click2edit" id="cmal1<?php echo e($l); ?><?php echo e($direct->id); ?>" empid="<?php echo e($direct->id); ?>" goalid="<?php echo e($cra->id); ?>" style="word-wrap: break-word;">
                        <?php if(count($lmcracmt) > 0): ?>
                        <?php if($lmcracmt->lm_comment != NULL): ?>
                        <?php echo e($lmcracmt->lm_comment); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                      </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php $k+=1;?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
<h4 class="text-danger no-pilot"><?php echo e($direct->name); ?> has no career aspirations set.</h4>
<?php endif; ?>

<?php else: ?>

<?php 
$cras = app('App\Repositories\EmployeeRepository')->getGoalTo(Auth::user()->id, Auth::user()->id, 4); 
$cracnt = count($cras); 
?>
<?php if($cracnt > 0): ?>
<div class="row row-lg">
  <div class="col-md-12 col-xs-12">
    <div class="panel panel-bordered" style="margin-bottom: 4px;">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-line-chart"></i> Individual Development Plans</h3>
      </div>
      <div class="panel-body">
        <div class="panel-group panel-group-simple" id="career<?php echo e(Auth::user()->id); ?>" aria-multiselectable="true" role="tablist">
          <?php $__currentLoopData = $cras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cra): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
          <div class="panel">
            <div class="panel-heading" id="pilotHeadingModal1<?php echo e(Auth::user()->id); ?><?php echo e($cra->id); ?>" role="tab">
              <a class="panel-title" data-toggle="collapse" href="#pilotcollapsModal1<?php echo e(Auth::user()->id); ?><?php echo e($cra->id); ?>" data-parent="#career<?php echo e(Auth::user()->id); ?>" aria-expanded="false" aria-controls="pilotcollapsModal1<?php echo e(Auth::user()->id); ?><?php echo e($cra->id); ?>">
                <h5 class="text-warning">Commitment</h5>
              </a>
              <span class="text-default" style="word-wrap: break-word;">
                <?php echo e($cra->commitment); ?>

              </span>
            </div>
            <div class="panel-collapse collapse" id="pilotcollapsModal1<?php echo e(Auth::user()->id); ?><?php echo e($cra->id); ?>" aria-labelledby="pilotHeadingModal1<?php echo e(Auth::user()->id); ?><?php echo e($cra->id); ?>" role="tabpanel">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Objectvie</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li style="word-wrap: break-word;">
                        <?php echo e($cra->objective); ?>

                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Employee Comments</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li style="word-wrap: break-word;">
                        <?php if($cra->emp_comment==NULL): ?>
                        No comments yet.
                        <?php else: ?>
                        <?php echo e($cra->emp_comment); ?>

                        <?php endif; ?>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Line Manager Comment</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li>
                        <?php $lmcracmt = app('App\Http\Controllers\LMController')->getCommentd(Auth::user()->id, $cra->id); ?>
                        <br>
                        <p>
                          <a href="javascript:void(0)" onclick="editComm('cmal1<?php echo e($l); ?><?php echo e(Auth::user()->id); ?>')" id="edit"><i class="icon wb-edit"></i></a>
                          <i class="hide" id="status<?php echo e($l); ?>"></i>
                        </p>
                        <div class="click2edit" id="cmal1<?php echo e($l); ?><?php echo e(Auth::user()->id); ?>" empid="<?php echo e(Auth::user()->id); ?>" goalid="<?php echo e($cra->id); ?>" style="word-wrap: break-word;">
                        <?php if(count($lmcracmt) > 0): ?>
                        <?php if($lmcracmt->lm_comment != NULL): ?>
                        <?php echo e($lmcracmt->lm_comment); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                      </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php $k+=1;?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
<h4 class="text-danger no-pilot"><?php echo e(Auth::user()->name); ?> has no career aspirations set.</h4>
<?php endif; ?>

<?php endif; ?>