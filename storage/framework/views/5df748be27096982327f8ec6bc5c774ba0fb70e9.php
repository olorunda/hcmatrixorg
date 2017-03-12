<?php $__env->startSection('content'); ?>
<?php  $jobdetail=app('App\Http\Controllers\EmployeeController')->getjobdetail($employeedata->job_id); ?>
<script>
  function url(url){

   window.location=url;
 }
</script>
<?php $job = app('App\Http\Controllers\EmployeeController')->getjobdetail($employeedata->job_id); 
		if(Auth::user()->id!=$employeedata->id){
			$class="hide";
			$disable="disabled";
		}
		else{
			
			$class="";
			$disable="";
		}
		

?>
<?php
function niceDate($date)
{
  return date("l, jS \of F, Y. h:i:s A", strtotime($date));
}
?>
	<script>

	$(function(){
							var myDropzone = new Dropzone("div#my-dropzone-files", { 
	
	url: "<?php echo e(url('update/picture')); ?>",
	maxFilesize: 0.062,
	parallelUploads:1,
	acceptedFiles:'.jpg,.jpeg,.png',
	maxFiles:1,
	autoProcessQueue:false
	
	});
	
	myDropzone.on("sending", function(file, xhr, formData) {
  // Will send the filesize along with the file as POST data.

   token=$('#token').val();
  formData.append("_token", token);
  formData.append("filesize", file.size);
  
   });
   
   //success upload
   myDropzone.on("success",function(file,response){
	   
			
		   toastr.success('<?php echo e(_t('Upload  Successfull')); ?>');
	  	 myDropzone.removeFile(file);
		 setTimeout(function(){
			 
			window.location.reload(); 
			 
		 },2000);
  
   });
   
    myDropzone.on("error", function(file,response) {
                   // sessionStorage.setItem("error", 1);
                   // $("#disp").html(response);
                  toastr.error('<?php echo e(_t('Some error Occurred')); ?>:'+response);
				 myDropzone.removeFile(file);
                });
   
	//jhdhdh
  $('#uploadpics').click(function(){
	
	myDropzone.processQueue();
	 
	 });

	
						
					$('#saveprofile').click(function(){
						kinrel=$('#kinrel').val();
						kinphone=$('#kinphone').val();
						kinaddr=$('#kinaddr').val();
						nextkin=$('#nextkin').val();
						phone=$('#p_num').val();
						email=$('#p_email').val();
						addr=$('#addr').val();
						maritalstat=$('#maritalstat').val();
					 
						$.get('<?php echo e(url('updateprofile')); ?>',{
							
						kinrel:kinrel,
						kinphone:kinphone,
						kinaddr:kinaddr,
						nextkin:nextkin,
						phone:phone,
						email:email,
						addr:addr,
						maritalstat:maritalstat
							
							
						},function(data,status,xhr){
							
							if(xhr.status==200){
								
								toastr.success("<?php echo e(_t('Profile Updated Successfully')); ?>");
								return;
							}
							toastr.error("<?php echo e(_t('Some Error Occurred')); ?>"+data);
							
						})
						
						
						
					});
					
					});
			
				
	</script>
	<input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>" >
<div class="page-content container-fluid">
<div class="pull-right">
<a role="button" href="<?php echo e(url(session('locale').'/view')); ?>/mydocument" class="btn btn-info btn-md <?php echo e($class); ?>"><i class="fa fa-document"></i><?php echo e(_t('My Document(s)')); ?></a>
<button class="btn btn-danger btn-md <?php echo e($class); ?>" data-toggle="modal" href="#myModal"><?php echo e(_t('Change Password')); ?></button>
<button class="btn btn-success btn-md <?php echo e($class); ?>" id="saveprofile"><?php echo e(_t('Save Changes')); ?></button>
</div>
<?php echo $__env->make('partials.passchange', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<div class="modal fade modal-info in <?php echo e($class); ?>" id="picschange" aria-labelledby="exampleModalDanger" role="dialog" tabindex="-1" style="display: none; padding-right: 17px;">
              
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title"><?php echo e(_t('Change Picture')); ?></h4>
                        </div>
                        <div class="modal-body">
                         <div class="col-xs-12 col-xl-12 form-group" id="dropboxpane">
							   <b><?php echo e(_t('Upload Your New Picture')); ?>:</b><br>
							        <div style="" class="dropzone" id="my-dropzone-files" name="my-dropzone-files">

                                                

                                            </div>
                               
                              </div>
						
						
                        </div>
                        <div class="modal-footer">
                         
                          <button type="button" id="uploadpics" class="btn <?php echo e($class); ?> btn-primary"><i class="fa fa-upload" ></i>&nbsp;&nbsp;<?php echo e(_t('Upload Picture')); ?></button>
                        </div>
                      </div>
                    </div>
             
	
                  </div>
 
  <div class="row" style="margin-top:4%;">
    <!--<div class="col-lg-3 col-xs-12">
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
      <!-- End Page Widget --
    </div>-->
    <div class="col-lg-12 col-xs-12">
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body nav-tabs-animate nav-tabs-horizontal" data-plugin="tabs">
          <ul class="nav nav-tabs nav-tabs-line" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" data-toggle="tab" href="#headingDistinct1<?php echo e($employeedata->id); ?>" aria-controls="headingDistinct<?php echo e($employeedata->id); ?>" role="tab">
                <i class="fa fa-home"></i> <?php echo e(_t('Home')); ?>

              </a>
            </li>
          <li class="nav-item" role="presentation">
              <a class="nav-link" data-toggle="tab" href="#headingDistinct5<?php echo e($employeedata->id); ?>" aria-controls="headingDistinct5<?php echo e($employeedata->id); ?>" role="tab">
                <i class="fa fa-cogs"></i> <?php echo e(_t('View Direct Report')); ?>

              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="headingDistinct1<?php echo e($employeedata->id); ?>" role="tabpanel">
              <div class="row">
                <p></p>
                <div class="col-md-2">
                  <img class="img-thumbnail img-bordered img-default" src="<?php echo e(asset($employeedata->image)); ?>" align="left" style="width: 120px;height: 120px;"><br>
				 <button data-toggle="modal" data-target="#picschange" style="margin-top:5px; width: 120px;" class="<?php echo e($class); ?> btn btn-info btn-md">
				 <?php echo e(_t('Change Picture')); ?></button>
                </div>
                <div class="col-md-10">
                  <h4><?php echo e(strtoupper($employeedata->name)); ?></h4>
                  <h5><?php echo e(_t('Job Role')); ?>: <?php echo e(strtoupper($job['title'])); ?></h5>
                  <h5><?php echo e(_t('Emp. ID')); ?>.: <?php echo e(strtoupper($employeedata->emp_num)); ?></h5>
                  <h5><?php echo e(_t('Department')); ?>: <?php echo e(app('App\Http\Controllers\AvailJobController')->getDept($employeedata->workdept_id)); ?></h5>
                  <h5><?php echo e(_t('Last Promoted on')); ?>: <?php echo e(niceDate($employeedata->last_promoted)); ?></h5>
				  <h5><b> </b>
									 <?php  $getrating=app('App\Http\Controllers\EmpController360')->getrate($employeedata->id,$employeedata->id);  ?>
						 <script>
						 $(function(){
							 
							$('#rating<?php echo e($employeedata->id); ?>5').raty({ starType: 'i' });
							
						  $('#rating<?php echo e($employeedata->id); ?>5').raty('score', <?php echo e($getrating['rating']); ?>);
						  
							$('#rating<?php echo e($employeedata->id); ?>5').raty('readOnly', true);
						 });
						</script>
							<span   id="rating<?php echo e($employeedata->id); ?>5"></span>
								   <br/>
                             <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( <?php echo e(_t('Total Rating')); ?>: <?php echo e($getrating['rating']); ?> )</span>
									</h5>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <dl class="dl-horizontal">
                    <dt><h5><?php echo e(_t('E-Mail')); ?></h5></dt>
                    <dd><input <?php echo e($disable); ?> type="text" class="form-control" id="p_email" value="<?php echo e($employeedata->email); ?>"  ></dd>

                    <dt><h5><?php echo e(_t('Phone')); ?></h5></dt>
                    <dd><input <?php echo e($disable); ?> type="text" class="form-control" id="p_num" value="<?php echo e($employeedata->phone_num); ?>" ></dd>
                  </dl>
                </div>
				
                <div class="col-md-6">
                  <dl class="dl-horizontal">
                    <dt><h5><?php echo e(_t('Sex')); ?></h5></dt>
                    <dd><?php echo e($employeedata->sex); ?></dd>

                    <dt><h5><?php echo e(_t('Date of Birth')); ?></h5></dt>
                   <dd> <?php echo e($employeedata->dob); ?>(<?php echo e($employeedata->age); ?>)</dd>
				   
                  </dl>
                </div>
                 
                  
				  <dl  class="col-md-6 dl-horizontal">
                    <dt><h5><?php echo e(_t('Marital Status')); ?></h5></dt>
                    <dd><select <?php echo e($disable); ?> data-plugin="select2" id="maritalstat" >
					<option value="<?php echo e($employeedata->marital_status); ?>" ><?php echo e(_t(ucfirst($employeedata->marital_status))); ?></option>
					<option value="Single"><?php echo e(_t('Single')); ?></option>
					<option value="Married"><?php echo e(_t('Married')); ?></option>
					<option value="Divorced"><?php echo e(_t('Divorced')); ?></option>
					</select> </dd>
                  </dl>
				   <dl  style="margin-top:-65px;" class="col-md-6 dl-horizontal">
                    <dt><h5><?php echo e(_t('Address')); ?></h5></dt>
                    <dd><textarea <?php echo e($disable); ?> class="form-control" id="addr" value="<?php echo e($employeedata->address); ?>" >  <?php echo e($employeedata->address); ?></textarea></dd>
                  </dl>
                 
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <h4><?php echo e(_t('Next Of Kin')); ?></h4>
                  <dl class="dl-horizontal">
                    <dt><h5><?php echo e(_t('Name')); ?></h5></dt>
                    <dd><input type="text" <?php echo e($disable); ?> class="form-control" id="nextkin" value="<?php echo e($employeedata->next_of_kin); ?>" /></dd>

                    <dt><h5><?php echo e(_t('Relationship')); ?></h5></dt>
                    <dd><input type="text" <?php echo e($disable); ?> class="form-control" id="kinrel" value="<?php echo e($employeedata->kin_relationship); ?>" /></dd>
                  </dl>
                </div>
                <div class="col-md-6">
                  <h4 style="visibility: hidden;"><?php echo e(_t('Next Of Kin')); ?></h4>
                  <dl class="dl-horizontal">
                    <dt><h5><?php echo e(_t('Phone')); ?></h5></dt>
                    <dd><input type="text" <?php echo e($disable); ?> class="form-control" id="kinphone" value="<?php echo e($employeedata->kin_phonenum); ?>" /></dd>
                  </dl>
                </div>
			
                <div class="col-md-12">
                  <dl class="dl-horizontal">
                    <dt><h5>Address</h5></dt>
                    <dd><textarea class="form-control" <?php echo e($disable); ?> id="kinaddr" value="<?php echo e($employeedata->kin_address); ?>"><?php echo e($employeedata->kin_address); ?></textarea></dd>
                  </dl>
                </div>
              </div>
            </div>
            <?php $i = $idn = $j = $k = $l = 1; ?>
           <div class="tab-pane" id="headingDistinct5<?php echo e($employeedata->id); ?>" role="tabpanel">
              <div class="row">
                <p></p>
                <div class="col-md-2">
                  <img class="img-thumbnail img-bordered img-default" src="<?php echo e(asset($employeedata->image)); ?>" align="left" style="width: 120px;height: 120px;"><br>
				   <button data-toggle="modal" data-target="#picschange" style="margin-top:5px; width: 120px;" class="btn btn-info btn-md <?php echo e($class); ?>">
				<?php echo e(_t('Change Picture')); ?></button>
                </div>
                <div class="col-md-10">
                  <h4><?php echo e(strtoupper($employeedata->name)); ?></h4>
                  <h5><?php echo e(_t('Job Role')); ?>: <?php echo e(strtoupper($job['title'])); ?></h5>
                  <h5><?php echo e(_t('Emp. ID')); ?>.: <?php echo e(strtoupper($employeedata->emp_num)); ?></h5>
                  <h5><?php echo e(_t('Department')); ?>: <?php echo e(app('App\Http\Controllers\AvailJobController')->getDept($employeedata->workdept_id)); ?></h5>
                  <h5><?php echo e(_t('Last Promoted on')); ?>: <?php echo e(niceDate($employeedata->last_promoted)); ?></h5>
				  <h5><b> </b>
									 <?php  $getrating=app('App\Http\Controllers\EmpController360')->getrate($employeedata->id,$employeedata->id);  ?>
						 <script>
						 $(function(){
							 
							$('#rating<?php echo e($employeedata->id); ?>2').raty({ starType: 'i' });
							
						  $('#rating<?php echo e($employeedata->id); ?>2').raty('score', <?php echo e($getrating['rating']); ?>);
						  
							$('#rating<?php echo e($employeedata->id); ?>2').raty('readOnly', true);
						 });
						</script>
							<span   id="rating<?php echo e($employeedata->id); ?>2"></span>
								   <br/>
                             <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( <?php echo e(_t('Total Rating')); ?>: <?php echo e($getrating['rating']); ?> )</span>
									</h5>
                </div>
              </div>
              <hr>
              <?php echo $__env->make('employee.tab-content-organogram', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          </div>
        </div>
      </div>
      <!-- End Panel -->
    </div>
  </div>
 <?php echo $__env->make('partials.dependant', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

 <?php echo $__env->make('partials.skills', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
 <?php echo $__env->make('partials.academics', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
 <?php echo $__env->make('partials.past_exp', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
                
                  </div>


 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>