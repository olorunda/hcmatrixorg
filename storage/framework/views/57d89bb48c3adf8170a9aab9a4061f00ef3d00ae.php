<?php if(count($pilots) > 0): ?>
<div class="row row-lg">
  <div class="col-md-12 col-xs-12">
    <div class="panel panel-bordered" style="margin-bottom: 4px;">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-plane"></i> PILOT GOALS</h3>
      </div>
      <div class="panel-body">
        <div class="panel-group panel-group-simple" id="siteMegaAccordion1<?php echo e($direct->id); ?>" aria-multiselectable="true" role="tablist">
          <?php $__currentLoopData = $pilots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pilot): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
          <div class="panel">
            <div class="panel-heading" id="pilotHeadingModal1<?php echo e($direct->id); ?><?php echo e($pilot->id); ?>" role="tab">
              <a class="panel-title" data-toggle="collapse" href="#pilotcollapsModal1<?php echo e($direct->id); ?><?php echo e($pilot->id); ?>" data-parent="#siteMegaAccordion1<?php echo e($direct->id); ?>" aria-expanded="false" aria-controls="pilotcollapsModal1<?php echo e($direct->id); ?><?php echo e($pilot->id); ?>">
                <h5 class="text-warning">Commitment</h5>
              </a>
              <span class="text-default">
                <?php echo e($pilot->commitment); ?>

              </span>
            </div>
            <div class="panel-collapse collapse" id="pilotcollapsModal1<?php echo e($direct->id); ?><?php echo e($pilot->id); ?>" aria-labelledby="pilotHeadingModal1<?php echo e($direct->id); ?><?php echo e($pilot->id); ?>" role="tabpanel">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Objectvie</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li style="word-wrap: break-word;">
                        <?php echo e($pilot->objective); ?>

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
                        <?php if($pilot->emp_comment==NULL): ?>
                        No comments yet.
                        <?php else: ?>
                        <?php echo e($pilot->emp_comment); ?>

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
                        
                        <?php $cmt = app('App\Http\Controllers\LMController')->getCommentd($direct->id, $pilot->id); ?>
                        <br>
                        <p>
                          <a href="javascript:void(0)" onclick="editComm('cma1<?php echo e($j); ?><?php echo e($direct->id); ?>')" id="edit"><i class="icon wb-edit"></i></a>
                          <i class="hide" id="status<?php echo e($j); ?>"></i>
                        </p>
                        <div class="click2edit" id="cma1<?php echo e($j); ?><?php echo e($direct->id); ?>" empid="<?php echo e($direct->id); ?>" goalid="<?php echo e($pilot->id); ?>" style="word-wrap: break-word;">
                          <?php if(count($cmt) > 0): ?>
                          <?php if($cmt->lm_comment != NULL): ?>
                          <?php echo e($cmt->lm_comment); ?>

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
          <?php $j+=1;?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
<h4 class="text-danger">No Goals Assigned Yet</h4>
<?php endif; ?>