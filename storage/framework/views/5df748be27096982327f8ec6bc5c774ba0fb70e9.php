<?php $__env->startSection('content'); ?>
<?php  $jobdetail=app('App\Http\Controllers\EmployeeController')->getjobdetail(Auth::user()->job_id) ?>
<script>
function url(url){
	
	window.location=url;
}
</script>

    <div class="page-content container-fluid">
      <div class="row">
        <div class="col-lg-3 col-xs-12">
        <div class="card card-shadow">
            <div class="card-block text-xs-center bg-white p-40">
              <div class="avatar avatar-100 m-b-20">
                <img src="http://localhost:8000/upload/1472750298.jpg" alt="1472750298.jpg">
              </div>
              <p class="font-size-20 blue-grey-700">Adedeji</p>
              <p class="blue-grey-400 m-b-20">Web Developer</p>
              <p class="m-b-35">Manage Client website and all some other stuffs worth manageing
                </p>
              <ul class="list-inline font-size-18 m-b-35">
                <li class="list-inline-item">
                  <a class="blue-grey-400" href="" target="_blank">
                    <i class="icon bd-twitter" aria-hidden="true"></i>
                  </a>
                </li>
                <li class="list-inline-item m-l-10">
                  <a class="blue-grey-400" href="" target="_blank" "="">
                    <i class="icon bd-facebook" aria-hidden="true"></i>
                  </a>
                </li>
                <li class="list-inline-item m-l-10">
                  <a class="blue-grey-400" href="" target="_blank">
                    <i class="icon bd-dribbble" aria-hidden="true"></i>
                  </a>
                </li>
                <li class="list-inline-item m-l-10">
                  <a class="blue-grey-400" href="" target="_blank">
                    <i class="icon bd-instagram" aria-hidden="true"></i>
                  </a>
                </li>
              </ul>
             
            </div>
          </div>
          <!-- End Page Widget -->
        </div>
        <div class="col-lg-9 col-xs-12">
          <!-- Panel -->
          <div class="panel">
            <div class="panel-body nav-tabs-animate nav-tabs-horizontal" data-plugin="tabs">
              <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#activities" aria-controls="activities" role="tab" aria-expanded="false">Basic Information </a></li>
                <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-expanded="true">Contact Information</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#messages" aria-controls="messages" role="tab" aria-expanded="false">Educational Information</a></li>
                <li class="nav-item dropdown" style="display: none;">
                  <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">Menu </a>
                  <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" data-toggle="tab" href="#activities" aria-controls="activities" role="tab">Basic Information <span class="tag tag-pill tag-danger">5</span></a>
                    <a class="dropdown-item" data-toggle="tab" href="#profile" aria-controls="profile" role="tab">Contact Information</a>
                    <a class="dropdown-item" data-toggle="tab" href="#messages" aria-controls="messages" role="tab">Educational Information</a>
                  </div>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane animation-slide-left" id="activities" role="tabpanel" aria-expanded="false">
                 <!--FORMS HERE -->
				<br>
				<div class="form-group">
                  <input type="text" class="form-control" value="<?php echo e(Auth::user()->name); ?>" placeholder="Full Name" disabled>
                </div>
				<div class="form-group">
                  <input type="text" id="email" class="form-control" value="<?php echo e(Auth::user()->email); ?>" placeholder="Email Address">
                </div>
				<div class="form-group">
                  <input type="text" class="form-control" value="<?php echo e(Auth::user()->dob); ?>" disabled placeholder="Date of Birth">
                </div>
				<div class="form-group">
                  <input type="text" value="<?php echo e(Auth::user()->sex); ?>" class="form-control" placeholder="Sex" disabled>
                </div>
				<div class="form-group">
                  <input type="text" class="form-control" value="<?php echo e(Auth::user()->facebook); ?>" id="facebook" placeholder="Facebook Profile Url">
                </div>
				<div class="form-group">
                  <input type="text" class="form-control" value="<?php echo e(Auth::user()->twitter); ?>" id="twitter" placeholder="Twitter Profile Url">
                </div>
				<div class="form-group">
                  <input type="text" class="form-control" value="<?php echo e(Auth::user()->instagram); ?>" id="instagram" placeholder="Instagram Profile Url">
                </div>
				<div class="form-group">
                  <input type="text" class="form-control" value="<?php echo e(Auth::user()->dribbble); ?>" id="dribble" placeholder="Dribble Profile Url">
                </div>
				  <div class="dropify-wrapper"><div class="dropify-message"><span class="file-icon"></span> <p>Drag and drop a file here or click</p><p class="dropify-error">Ooops, something wrong appended.</p></div><div class="dropify-loader"></div><div class="dropify-errors-container"><ul></ul></div><input type="file" id="input-file-now" data-plugin="dropify" data-default-file=""><button type="button" class="dropify-clear">Remove</button><div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p><p class="dropify-infos-message">Drag and drop or click to replace</p></div></div></div></div>
                </div>
                <div class="tab-pane animation-slide-left active" id="profile" role="tabpanel" aria-expanded="true">
				FORMS HERE
				
                </div>
                <div class="tab-pane animation-slide-left" id="messages" role="tabpanel" aria-expanded="false">
                 FORMS HERE

				 </div>
              </div>
            </div>
          </div>
          <!-- End Panel -->
        </div>
      </div>
    </div>
	

	<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>