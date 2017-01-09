<?php 
$idpgoals = app('App\Repositories\EmployeeRepository')->getGoalTo(Auth::user()->id, $direct->id, 3); 
$glcnt = count($idpgoals); 
?>
<?php if($glcnt > 0): ?>
<div class="row row-lg">
  <div class="col-md-12 col-xs-12">
    <div class="panel panel-bordered" style="margin-bottom: 4px;">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-graduation-cap"></i>Individual Development Plans</h3>
      </div>
      <div class="panel-body">
        <div class="panel-group panel-group-simple" id="idp<?php echo e($direct->id); ?>" aria-multiselectable="true" role="tablist">
          <?php $__currentLoopData = $idpgoals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idpgoal): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
          <div class="panel">
            <div class="panel-heading" id="pilotHeadingModal1<?php echo e($direct->id); ?><?php echo e($idpgoal->id); ?>" role="tab">
              <a class="panel-title" data-toggle="collapse" href="#pilotcollapsModal1<?php echo e($direct->id); ?><?php echo e($idpgoal->id); ?>" data-parent="#idp<?php echo e($direct->id); ?>" aria-expanded="false" aria-controls="pilotcollapsModal1<?php echo e($direct->id); ?><?php echo e($idpgoal->id); ?>">
                <h5 class="text-warning">Commitment</h5>
              </a>
              <span class="text-default" style="word-wrap: break-word;">
                <?php echo e($idpgoal->commitment); ?>

              </span>
            </div>
            <div class="panel-collapse collapse" id="pilotcollapsModal1<?php echo e($direct->id); ?><?php echo e($idpgoal->id); ?>" aria-labelledby="pilotHeadingModal1<?php echo e($direct->id); ?><?php echo e($idpgoal->id); ?>" role="tabpanel">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Objectvie</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li style="word-wrap: break-word;">
                        <?php echo e($idpgoal->objective); ?>

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
                        <?php if($idpgoal->emp_comment==NULL): ?>
                        No comments yet.
                        <?php else: ?>
                        <?php echo e($idpgoal->emp_comment); ?>

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
                        <?php $lmidcmt = app('App\Http\Controllers\LMController')->getCommentd($direct->id, $idpgoal->id); ?>
                        <br>
                        <p>
                          <a href="javascript:void(0)" onclick="editComm('cmak1<?php echo e($k); ?><?php echo e($direct->id); ?>')" id="edit"><i class="icon wb-edit"></i></a>
                          <i class="hide" id="status<?php echo e($k); ?>"></i>
                        </p>
                        <div class="click2edit" id="cmak1<?php echo e($k); ?><?php echo e($direct->id); ?>" empid="<?php echo e($direct->id); ?>" goalid="<?php echo e($idpgoal->id); ?>" style="word-wrap: break-word;">
                          <?php if(count($lmidcmt) > 0): ?>
                          <?php if($lmidcmt->lm_comment != NULL): ?>
                          <?php echo e($lmidcmt->lm_comment); ?>

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
<h4 class="text-danger"><?php echo e($direct->name); ?> has no development plans set.</h4>
<?php endif; ?>