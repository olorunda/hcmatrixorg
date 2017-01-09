<?php $__env->startSection('content'); ?>
<script src="../../global/vendor/jquery/jquery.js"></script>
<script>
  function url(url)
  {	
   window.location=url;
 }
</script>
<style type="text/css">
  .panel-group .panel-title:after, .panel-group .panel-title:before {
    position: absolute;
    top: 15px;
    right: 30px;
    font-family: "Web Icons";
    -webkit-transition: all .3s linear 0s;
    -o-transition: all .3s linear 0s;
    transition: all .3s linear 0s;
    color: #f0ad4e !important;
    border-color: #d43f3a;
    font-size: 18px;
  }
  a > h4:hover{
    color: #04c;
  }
</style>
<h1 class="page-title" style="position: relative;left: 10px;top: -10px;margin-bottom: -10px;">Jobs</h1>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="javascript:void(0)">Available Jobs</a></li>
  <li class="breadcrumb-item active">You are Here</li>
</ol>
<br>
<div class="col-md-12">
  <div class="col-md-3">
    <div class="panel panel-bordered">
      <div class="panel-heading">
        <h3 class="panel-title">Filter Jobs</h3>
      </div>
      <div class="panel-body">
        <form id="searchForm">
          <input type="hidden" name="vKey" id="vKey" value="<?php echo e(csrf_token()); ?>">
          <div class="row">
            <div class="form-group">
            <label class="control-label sm-select-label">Years of Experience</label>
              <select class="sm-select form-control" id="experience">
                <option value="0">-all-</option>
                <option value="1">Entry Level</option>
                <option value="2">1 - 3 Years</option>
                <option value="3">3 - 5 Years</option>
                <option value="4">5 - 7 Years</option>
                <option value="5">7 - 10 Years</option>
                <option value="6">10 - 15 Years</option>
                <option value="7">15+</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label sm-select-label">Job Type</label>
              <select class="sm-select form-control" id="jobtype">
                <option value="0">-all-</option>
                <?php if(count($joblevels) == 1): ?>
                <option value="<?php echo e($joblevels['id']); ?>"><?php echo e($joblevels['level']); ?></option>
                <?php elseif(count($joblevels) > 1): ?>
                <?php $__currentLoopData = $joblevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $joblevel): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <option value="<?php echo e($joblevel->id); ?>"><?php echo e($joblevel->level); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php else: ?>
                <?php endif; ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label sm-select-label">Employement Type</label>
              <select class="sm-select form-control" id="emptype">
                <option value="0">-all-</option>
                <?php if(count($jobtypes) > 0 && count($jobtypes) == 1): ?>
                <option value="<?php echo e($jobtypes['id']); ?>"><?php echo e($jobtypes['work_type']); ?></option>
                <?php elseif(count($jobtypes) > 0 && count($jobtypes) > 1): ?>
                <?php $__currentLoopData = $jobtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobtype): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <option value="<?php echo e($jobtype->id); ?>"><?php echo e($jobtype->work_type); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php endif; ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label sm-select-label">Department</label>
              <select class="sm-select form-control" id="deptfil">
                <option value="0">-all-</option>
                <?php if(count($jobdepts) == 1): ?>
                <option value="<?php echo e($jobdepts['id']); ?>"><?php echo e($jobdepts['dept']); ?></option>
                <?php elseif(count($jobdepts) > 1): ?>
                <?php $__currentLoopData = $jobdepts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobdept): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <option value="<?php echo e($jobdept->id); ?>"><?php echo e($jobdept->dept); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php endif; ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label sm-select-label">Date Posted</label>
              <select class="sm-select form-control" id="dateposted">
                <option value="0">-all-</option>
                <option value="1">Today</option>
                <option value="2">Yesterday</option>
                <option value="3">Last week</option>
                <option value="4">2 weeks</option>
                <option value="5">Last 30 days</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label sm-select-label">Location</label>
              <select class="sm-select  form-control" id="location">
                <option value="0">-all-</option>
                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <option value="<?php echo e($state->id); ?>"><?php echo e($state->state); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              </select>
            </div>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-warning btn-raised btn-animate btn-animate-side" style="width: 200px;margin: 0px auto;margin-left: 25px;margin-right: 25px;">
              <span><i class="icon fa fa-filter" aria-hidden="true"></i>Filter</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-9"> 
    <?php if(count($results) > 0): ?>
    <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    <div class="panel" style="margin-bottom: 4px;">
      <div class="panel-body">
        <div class="panel-group panel-group-simple" id="siteMegaAccordion<?php echo e($result->id); ?>" aria-multiselectable="true" role="tablist">
          <div class="ribbon ribbon-clip ribbon-reverse ribbon-success">
            <span class="ribbon-inner" data-toggle="tooltip" title="Apply" onclick="url('<?php echo e(url('available_jobs')); ?>/jobs?id=<?php echo e($result->id); ?>')">
              Apply Here
            </span>
          </div>
          <div class="panel">
            <div class="panel-heading" id="siteMegaAccordionHeadingOne<?php echo e($result->id); ?>" role="tab">
              <a class="panel-title" data-toggle="collapse" href="#siteMegaCollapseOne<?php echo e($result->id); ?>" data-parent="#siteMegaAccordion<?php echo e($result->id); ?>" aria-expanded="false" aria-controls="siteMegaCollapseOne<?php echo e($result->id); ?>">
                <h4 class="text-warning">Experience</h4>
              </a>
              <span class="text-default">
                <?php echo e($result->title); ?>

              </span>
              <div class="page-header-actions">
                <button type="button" class="btn btn-icon social-facebook" data-placement="top" data-toggle="tooltip" title="Like">
                  <i class="icon bd-facebook" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-icon social-twitter" data-placement="bottom" data-toggle="tooltip" title="Tweet">
                  <i class="icon bd-twitter" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-icon social-linkedin" data-placement="left" data-toggle="tooltip" title="Share">
                  <i class="icon bd-linkedin" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-icon btn-danger" data-placement="top" data-toggle="tooltip" title="Send as mail">
                  <i class="icon wb-link-intact"></i>
                </button>
              </div>
            </div>
            <div class="panel-collapse collapse" id="siteMegaCollapseOne<?php echo e($result->id); ?>" aria-labelledby="siteMegaAccordionHeadingOne<?php echo e($result->id); ?>" role="tabpanel">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <h4>EXPERIENCE REQUIRED</h4>
                    <ul>
                      <li>
                        <?php echo e($result->required_exp); ?>

                      </li>
                    </ul>
                  </div>
                  <div class="col-md-12 col-xs-12">
                    <h4>JOB DESCRIPTION</h4>
                    <ul>
                      <li>
                        <?php echo e($result->job_desc); ?>

                      </li>
                    </ul>
                  </div>
                  <div class="col-md-12 col-xs-12">
                    <h4>EDUCATIONAL REQUIREMENTS</h4>
                    <ul>
                      <li>
                        <?php echo e($result->qualification); ?>

                      </li>
                    </ul>
                  </div>
                  <div class="col-md-12 col-xs-12">
                    <h4>OTHER SKILLS</h4>
                    <ul>
                      <li>
					  <?php echo e($result->otherskill); ?>

                      </li>
                     
                    </ul>
                  </div>
                  <div class="col-md-12 col-xs-12 pull-right">
                    <button type="button" class="btn btn-raised btn-success btn-lg" onclick="url('<?php echo e(url('available_jobs')); ?>/jobs?id=<?php echo e($result->id); ?>')"><i class="icon wb-dropright"></i> Apply</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    <?php else: ?>
    <div id="avail_jobs_sect">
      <?php if(count($jobs) <= 0): ?>
      <h4>No Jobs Posted Yet. please check back later.</h4>
      <?php elseif(count($jobs) == 1): ?>
      <div class="panel" style="margin-bottom: 4px;">
        <div class="panel-body">
          <div class="panel-group panel-group-simple" id="siteMegaAccordion<?php echo e($jobs['id']); ?>" aria-multiselectable="true" role="tablist">
            <div class="ribbon ribbon-clip ribbon-reverse ribbon-success">
              <span class="ribbon-inner" data-toggle="tooltip" title="Apply" onclick="url('<?php echo e(url('available_jobs')); ?>/jobs?id=<?php echo e($jobs['id']); ?>')">
                Apply Here
              </span>
            </div>
            <div class="panel">
              <div class="panel-heading" id="siteMegaAccordionHeadingOne<?php echo e($jobs['id']); ?>" role="tab">
                <a class="panel-title" data-toggle="collapse" href="#siteMegaCollapseOne<?php echo e($jobs['id']); ?>" data-parent="#siteMegaAccordion<?php echo e($jobs['id']); ?>" aria-expanded="false" aria-controls="siteMegaCollapseOne<?php echo e($jobs['id']); ?>">
                  <h4 class="text-warning">Experience</h4>
                </a>
                <span class="text-default">
                  <?php echo e($jobs['title']); ?>

                </span>
                <div class="page-header-actions">
                  <button type="button" class="btn btn-icon social-facebook" data-placement="top" data-toggle="tooltip" title="Like">
                    <i class="icon bd-facebook" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-icon social-twitter" data-placement="bottom" data-toggle="tooltip" title="Tweet">
                    <i class="icon bd-twitter" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-icon social-linkedin" data-placement="left" data-toggle="tooltip" title="Share">
                    <i class="icon bd-linkedin" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-icon btn-danger" data-placement="top" data-toggle="tooltip" title="Send as mail">
                    <i class="icon wb-link-intact"></i>
                  </button>
                </div>
              </div>
              <div class="panel-collapse collapse" id="siteMegaCollapseOne<?php echo e($jobs['id']); ?>" aria-labelledby="siteMegaAccordionHeadingOne<?php echo e($jobs['id']); ?>" role="tabpanel">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12 col-xs-12">
                      <h4>EXPERIENCE REQUIRED</h4>
                      <ul>
                        <li>
                          <?php echo e($jobs['required_exp']); ?>

                        </li>
                      </ul>
                    </div>
                    <div class="col-md-12 col-xs-12">
                      <h4>JOB DESCRIPTION</h4>
                      <ul>
                        <li>
                          <?php echo e($jobs['job_desc']); ?>

                        </li>
                      </ul>
                    </div>
                    <div class="col-md-12 col-xs-12">
                      <h4>EDUCATIONAL REQUIREMENTS</h4>
                      <ul>
                        <li>
                          <?php echo e($jobs['qualification']); ?>

                        </li>
                      </ul>
                    </div>
                    <div class="col-md-12 col-xs-12">
                      <h4>OTHER SKILLS</h4>
                      <ul>
                        <li>
						<?php echo e($jobs['otherskill']); ?>

                        </li>
                        
                      </ul>
                    </div>
                    <div class="col-md-12 col-xs-12 pull-right">
                      <button type="button" class="btn btn-raised btn-success btn-lg" onclick="url('<?php echo e(url('available_jobs')); ?>/jobs?id=<?php echo e($jobs['id']); ?>')"><i class="icon wb-dropright"></i> Apply</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php else: ?>
      <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
      <div class="panel" style="margin-bottom: 4px;">
        <div class="panel-body">
          <div class="panel-group panel-group-simple" id="siteMegaAccordion<?php echo e($job->id); ?>" aria-multiselectable="true" role="tablist">
            <div class="ribbon ribbon-clip ribbon-reverse ribbon-success">
              <span class="ribbon-inner" data-toggle="tooltip" title="Apply" onclick="url('<?php echo e(url('available_jobs')); ?>/jobs?id=<?php echo e($job->id); ?>')">
                Apply Here
              </span>
            </div>
            <div class="panel">
              <div class="panel-heading" id="siteMegaAccordionHeadingOne<?php echo e($job->id); ?>" role="tab">
                <a class="panel-title" data-toggle="collapse" href="#siteMegaCollapseOne<?php echo e($job->id); ?>" data-parent="#siteMegaAccordion<?php echo e($job->id); ?>" aria-expanded="false" aria-controls="siteMegaCollapseOne<?php echo e($job->id); ?>">
                  <h4 class="text-warning">Experience</h4>
                </a>
                <span class="text-default">
                  <?php echo e($job->title); ?>

                </span>
                <div class="page-header-actions">
                  <button type="button" class="btn btn-icon social-facebook" data-placement="top" data-toggle="tooltip" title="Like">
                    <i class="icon bd-facebook" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-icon social-twitter" data-placement="bottom" data-toggle="tooltip" title="Tweet">
                    <i class="icon bd-twitter" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-icon social-linkedin" data-placement="left" data-toggle="tooltip" title="Share">
                    <i class="icon bd-linkedin" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-icon btn-danger" data-placement="top" data-toggle="tooltip" title="Send as mail">
                    <i class="icon wb-link-intact"></i>
                  </button>
                </div>
              </div>
              <div class="panel-collapse collapse" id="siteMegaCollapseOne<?php echo e($job->id); ?>" aria-labelledby="siteMegaAccordionHeadingOne<?php echo e($job->id); ?>" role="tabpanel">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12 col-xs-12">
                      <h4>EXPERIENCE REQUIRED</h4>
                      <ul>
                        <li>
                          <?php echo e($job->required_exp); ?>

                        </li>
                      </ul>
                    </div>
                    <div class="col-md-12 col-xs-12">
                      <h4>JOB DESCRIPTION</h4>
                      <ul>
                        <li>
                          <?php echo e($job->job_desc); ?>

                        </li>
                      </ul>
                    </div>
                    <div class="col-md-12 col-xs-12">
                      <h4>EDUCATIONAL REQUIREMENTS</h4>
                      <ul>
                        <li>
                          <?php echo e($job->qualification); ?>

                        </li>
                      </ul>
                    </div>
                    <div class="col-md-12 col-xs-12">
                      <h4>OTHER SKILLS</h4>
                      <ul>
                        <li>
						<?php echo e($job->otherskill); ?>

                        </li>
                       
                      </ul>
                    </div>
                    <div class="col-md-12 col-xs-12 pull-right">
                      <button type="button" class="btn btn-raised btn-success btn-lg" onclick="url('<?php echo e(url('available_jobs')); ?>/jobs?id=<?php echo e($job->id); ?>')"><i class="icon wb-dropright"></i> Apply</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
      <?php endif; ?>
    </div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_guest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>