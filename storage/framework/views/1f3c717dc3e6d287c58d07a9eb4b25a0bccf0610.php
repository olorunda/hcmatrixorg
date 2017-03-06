<?php $__env->startSection('content'); ?>
<script>
  function url(url){

   window.location=url;
 }

 //delete job/dept
 function deletejobdept(type,division=0){
		
		if(division==0){
			customise='Job(s)';
			hideid='joblock';
			caltype='jobm';
		}
		else{
			customise='<?php echo e(_t('Department(s)')); ?>';
			hideid='delblock';
			caltype='dept';
		}
			 if($('.'+type).is(':checked')){
		
	 }
	 else{
		  toastr.error('<?php echo e(_t('Please Select')); ?> '+customise+' to delete');
		 return ;
	 }
	 swal({
  title: "<?php echo e(_t('Are you sure')); ?>?",
  text: "<?php echo e(_t('You will not be able to recover deleted')); ?> "+customise,
  type: "<?php echo e(_t('warning')); ?>",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "<?php echo e(_t('Yes, delete it!')); ?>",
  closeOnConfirm: false
},
function(){
	
     	//	alert('dfdfe');
	    var valuearr=$('.'+type+':checked').map(function() {return this.value;}).get();
		console.log(valuearr)
		var i=0;
		//$.each(valuearr,function(index,element){
			
			for( i=0; i<valuearr.length; i++){
				//console.log(valuearr[i]);
			$.get('<?php echo e(url('hr/deletejob')); ?>/'+valuearr[i]+'/'+division,function(data,status,xhr){
				
				if(xhr.status==200){
					
					sessionStorage.setItem('status',1);
				}
				else{
					sessionStorage.setItem('status',0);
				
				}
				
			
			
			}); 
			
			if(sessionStorage.getItem('status')==1){
				$('#'+hideid+valuearr[i]).hide();
					console.log('hidden'+valuearr[i]);
				finallys=eval($('.'+caltype).text()-1);
				$('.'+caltype).text(finallys);
				
				
			}
			}
			
			status=sessionStorage.getItem('status');
			if(status==1){
			toastr.success(customise+' Deleted');	//i++;
			}
			else{
				toastr.success('<?php echo e(_t('Error Ocurred')); ?>');	//i++;
			
				return ;
			}
			
			 swal("<?php echo e(_t('Deleted!", customise+" Successfully Deleted.')); ?>", "success");
	
			
		/** setTimeout(function(){
		window.location.reload();
		},2000); **/
		
		});

	}
	
 
 function search(type=0){
	
	if(type==2){
				input = document.getElementById("searchfield2");
		 table = document.getElementById("departmenttable");
		}
 	else{
		
		 input = document.getElementById("searchfield");
 
		table = document.getElementById("jobtable");
	
	}

  // Declare variables 
  var input, filter, table, tr, td, i;
  filter = input.value.toUpperCase();
 
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }

	
}
 function reset(){
	 
	 $('#jobblockm').hide();
			$('#hidedepm').hide();
			
			$('#departmentblockm').show();
		$('#datatypem').prop("disabled",false);
		$('#jobdepidm').val(1);
		$('#jobtitle').val("");
		$('#datatypem').val(2);
		$('#description').val("");
		$('#departmentm').val("");
      
			$('#changebtn').html('<button type="button" class="btn btn-primary btn-outline" id="savejobdepm" onclick="savejobdepm()"><i class="fa fa-save mailico"></i><i class="fa fa-circle-o-notch fa-spin fa-fw hidespin" style="display: none;"></i>&nbsp;&nbsp;<?php echo e(_t('Save changes')); ?></button>');
		$('.hidespin').hide();
 }

  function jobmodal(type=0,title=0,description=0,depid=0,jobid=0){
	  if(type==0){
	$('#uploadjob').modal('toggle'); 
	  }
	 
	  else{
		
		$('#manualadd').modal('toggle'); 
		
		//back here
		 if(type==2){
			 
		 $('#hidedepm').hide();
		    $('#departmentblockm').show();
			$('#jobblockm').hide();
			
			$('#datatypem').val(2);
			
			department=$('#departmentm').val(title);
			sessionStorage.setItem('depid',depid);
				
				$('#changebtn').html('<button type="button" class="btn btn-primary btn-outline" onclick="manualmodify(1)"><i class="fa fa-save mailico"></i><i class="fa fa-circle-o-notch fa-spin fa-fw hidespin"></i>&nbsp;&nbsp;<?php echo e(_t('Modify')); ?></button>');
		$('.hidespin').hide(); 
		
	     }
	  else{
			$('#hidedepm').show();
		    $('#departmentblockm').hide();
			$('#jobblockm').show();
			depid=$('#jobdepidm').val(depid);
	  
			
			sessionStorage.setItem('jobid',jobid);
		//add set here 
		depid=$('#jobdepidm').val(depid);
		title=$('#jobtitle').val(title);
		type=$('#datatypem').val(1);
		$('#datatypem').prop("disabled",true);
		
		description=$('#description').val(description);
      
		
		$('#changebtn').html('<button type="button" class="btn btn-primary btn-outline" onclick="manualmodify()"><i class="fa fa-save mailico"></i><i class="fa fa-circle-o-notch fa-spin fa-fw hidespin"></i>&nbsp;&nbsp;<?php echo e(_t('Modify')); ?></button>');
		$('.hidespin').hide();
		
	  } 
	  }
	 
 }
	function savedept(depid,department,token){
		
	
	$.post('<?php echo e(url('hr/manualadd')); ?>/1',{
	
	_token:token,
	depid:depid,
	department:department
	
  },function(data,status,xhr){
	
	if(xhr.status==200){
		
		toastr.success(data);
		
		setTimeout(function(){
			
			window.location.reload();
			
		},2000);
	}
	else{
		toastr.error("<?php echo e(_t('Some error Occurred')); ?>:"+ data);
	}
});

	
	
	}
	
 //save job/modify job multifunction
 function savejob(depid,title,description,action,type,token,jobid=0){

	$.post('<?php echo e(url('hr/manualadd')); ?>/0',{
	
	_token:token,
	action:action,
	title:title,
	description:description,
	jobdepid:depid,
	jobid:jobid,
	type:type
	
},function(data,status,xhr){
	
	if(xhr.status==200){
		
		toastr.success(data);
		
		setTimeout(function(){
			
			window.location.reload();
			
		},2000);
	}
	else{
		toastr.error("<?php echo e(_t('Some error Occurred')); ?>:"+ data);
	}
});

	
}


 function updatedep(elementid){
			   
		   $.get('<?php echo e(url('hr/getdep')); ?>',function(data,status,xhr){
			   
			   $.each(data,function(index,element){
				$('#'+elementid).append('<option value="'+element.id+'">'+element.spec+'</option>');
				
			   });
		   });
		 }
		//manual modify job 
		//next here
function manualmodify(type=0){
	 
	  token=$('#token').val();
	 if(type==1){
		 
		department=$('#departmentm').val();
		depid=sessionStorage.getItem('depid'); 
		//jump here
		savedept(depid,department,token);
	 }
	 else{
       
		
		depid=$('#jobdepidm').val();
		title=$('#jobtitle').val();
		type=$('#datatypem').val();
		description=$('#description').val();
		jobid=sessionStorage.getItem('jobid');
	
		savejob(depid,title,description,1,1,token,jobid);
	 }
 }

function savejobdepm(){
	
type=$('#datatypem').val();   //1 for job 2 for dept

departspec=$('#departmentm').val();

token=$('#token').val();

//for job
if(type==1){
depid=$('#jobdepidm').val();
title=$('#jobtitle').val();
description=$('#description').val();
savejob(depid,title,description,0,type,token);
}
else{

$.post('<?php echo e(url('hr/manualadd/0')); ?>',{
	
	_token:token,
	departspec:departspec,
	type:type
	
},function(data,status,xhr){
	
	if(xhr.status==200){
		 $('#showdeptm').html('<select id="jobdepidm" class="form-control" ><option  disabled>-- <?php echo e(_t('Select Department')); ?> --</option></select>');
		
	    updatedep("jobdepidm");
		toastr.success("<span style='z-index:9999999999'><?php echo e(_t('Department Added Successfully')); ?></span>");
		
		setTimeout(function(){
			
			window.location.reload();
			
		},2000);
	}
	else{
		toastr.error("<span style='z-index:9999999999'><?php echo e(_t('Some error Occurred')); ?>:"+ data+"</span>");
	}
});	
	
}
	
} 
 $(function(){
	 //modifyjobdepm
	 
	  
	//manual addcslashes


	
	 
	//delete job
 $('#deletejob').click(function(){
    deletejobdept('alljob');
	
		}); 
		
		$('#deletedept').click(function(){
    deletejobdept('alldep2',1);
	
		});

	
$('#checkall').click(function(){

	$('.alljob').prop('checked',this.checked);



});

 $('#checkall2').click(function(){

	$('.alldep2').prop('checked',this.checked);



}); 


	 //ajax
	 
	$('.hidespin').hide();
	$(document).ajaxStart(function(){
		$('.mailico').hide();
		$('.hidespin').show();
		
		
		
	}).ajaxStop(function(){
		
		
		$('.hidespin').hide();
		
		$('.mailico').show();
	});
	 
	 //handle csv upload parsing
	 var myDropzone = new Dropzone("div#my-dropzone-files", { 
	
	url: "<?php echo e(url('hr/importjob')); ?>",
	maxFilesize: 1,
	parallelUploads:1,
	acceptedFiles:'.csv',
	maxFiles:1,
	autoProcessQueue:false
	
	});
	
	myDropzone.on("sending", function(file, xhr, formData) {
  // Will send the filesize along with the file as POST data.

     var jobdepid=$('#jobdepid').val();
     var datatype=$('#datatype').val();
	
	 var token=$('#token').val();
	 if(jobdepid==0){
		 
	 }
	 else{
   sessionStorage.setItem('uploadtype',1);
  formData.append("jobdepid", jobdepid);
	 }
	 
  formData.append("type",datatype);
  formData.append("_token", token);
  formData.append("filesize", file.size);
  
   });
   
   //success upload
   myDropzone.on("success",function(file,response){
	   $('#showdept').html('<select id="jobdepid" class="form-control" ><option  disabled>--<?php echo e(_t('Select Department')); ?> --</option></select>');
			console.log(response);
		   toastr.success('Import was successfull:'+response);
		   updatedep('jobdepid');
		
	  	 myDropzone.removeFile(file);
		 
		 if(sessionStorage.getItem('uploadtype')==1){
			 
			 setTimeout(function(){
				 
				windo.location.reload(); 
				 
			 },2000);
		 }
  
   });
   
    myDropzone.on("error", function(file,response) {
                   // sessionStorage.setItem("error", 1);
                   // $("#disp").html(response);
                  toastr.error('<?php echo e(_t('Some error Occurred')); ?>: '+response);
				 myDropzone.removeFile(file);
                });
   
	
	 
	 $('#import').click(function(){
		 
		myDropzone.processQueue(); 
		 
	 });
	 
	$('#hidedep').hide();
	
     setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);


 
 
		
			$('#jobblockm').hide();
			$('#hidedepm').hide();
		
 $('#datatype').change(function(){
	 
	if($('#datatype').val()==1){
		$('#hidedep').show();
		
	} 
	else{
		$('#hidedep').hide();
	
	}
	 
	 
 });		
 $('#datatypem').change(function(){
	 
	if($('#datatypem').val()==1){
		$('#hidedepm').show();
		$('#departmentblockm').hide();
			$('#jobblockm').show();
	} 
	else{
			$('#departmentblockm').show();
			$('#jobblockm').hide();
		$('#hidedepm').hide();
	
	}
	 
	 
 });

 });
</script>

<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="token" />
<div class="page-header">
  <h1 class="page-title"><?php echo e(_t('Job/Department Settings')); ?></h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/"><?php echo e(_t('Home')); ?></a></li>
    <li class="breadcrumb-item active"><?php echo e(_t('You are Here')); ?></li>
  </ol>
  <div class="page-header-actions">
    <div class="row no-space w-250 hidden-sm-down">

      <div class="col-sm-6 col-xs-12">
        <div class="counter">
          <span class="counter-number font-weight-medium"><?php echo e(date('Y-m-d')); ?></span>

        </div>
      </div>
      <div class="col-sm-6 col-xs-12">
        <div class="counter">
          <span class="counter-number font-weight-medium" id="time">08:32:56 am</span>
        </div>
      </div>
    </div>
  </div>
  
</div>

            
			<div class="col-lg-6 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white">
                  <i class="icon icon-circle icon-2x wb-clipboard bg-red-600" aria-hidden="true"></i>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number jobm"><?php echo e(count($alljobs)); ?></span>
                    <span class="counter-number-related text-capitalize"><?php echo e(_t('Job')); ?>(s)</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16"><?php echo e(_t('in Total')); ?></div>
                </div>
              </div>
              <!-- End Card -->
            </div>
			
			<div class="col-lg-6 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix">
                <div class="counter counter-md pull-xs-left text-xs-left">
                  <div class="counter-number-group">
                    <span class="counter-number dept"><?php echo e(count($dept)); ?> </span>
                    <span class="counter-number-related text-capitalize"><?php echo e(_t('Department')); ?>(s)</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16"><?php echo e(_t('in total')); ?></div>
                </div>
                <div class="pull-xs-right white" style="cursor:pointer" data-toggle="modal" data-target="#managedepartment">
                  <i class="icon icon-circle icon-2x wb-users bg-blue-600" aria-hidden="true"></i>
                </div>
              </div>
              <!-- End Card -->
            </div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
<div class="col-md-12" id="exampleReport">
<div class="panel" id="exampleReport">
        <div class="panel-body">
          <div class="panel-heading">
            <div class="panel-title">
				
			
			</div>
			<div class="col-md-4" style="margin-top:-42px;">
				<input type="text" class="form-control round" placeholder="Enter job title to search" onkeyup="search()" id="searchfield">
				</div>
            <div class="panel-actions">
		
              <a class="panel-action icon wb-upload" data-toggle="tooltip" data-original-title="Upload Job" onclick="jobmodal()" data-container="body" title=""></a>
              <a class="panel-action icon wb-trash" data-toggle="tooltip" data-original-title="Delete Selected Job" id="deletejob" data-container="body" title=""></a>
			  
	
			  
            </div>
          </div>
          <div class="example-wrap">
            <div class="example">
		
              <div class="table-responsive">
                <table class="table table-hover" data-role="content" data-plugin="selectable" data-row-selectable="true" id="jobtable">
                  <thead class="bg-blue-grey-100">
                    <tr>
                      <th>
                        <span class="checkbox-custom checkbox-primary">
                          <input class="selectable-all" type="checkbox" id="checkall">
                          <label></label>
                        </span>
                      </th>
                      <th>
					  <?php echo e(_t('Title')); ?>

                      </th>
                      <th>
                        <?php echo e(_t('Description')); ?>

                      </th>
                    
                      <th>
                        <?php echo e(_t('Department')); ?>

                      </th> 
					  <th>
                        <?php echo e(_t('Action')); ?>

                      </th>
                     
                    </tr>
                  </thead>
                  <tbody>
				  <?php if(count($alljobs)>0): ?>
					<?php $__currentLoopData = $alljobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr id="joblock<?php echo e($job->id); ?>">
                      <td>
                        <span class="checkbox-custom checkbox-primary">
                          <input class="selectable-item alljob"  value="<?php echo e($job->id); ?>"type="checkbox">
                          <label></label>
                        </span>
                      </td>
                      <td><?php echo e(_t($job->title)); ?>

                       
                      </td>
                      <td><?php echo e(_t($job->description)); ?>

                       
                      </td>
					
					  <td>
					  <?php 
					  $deptname=app('App\Repositories\GlobalSettingRepository')->getdept($job->jobdep_id)['spec']; 
					  if($deptname==""){ 
					  $deptname="";
					  }  
					  ?>
					  <?php echo e(_t($deptname)); ?>

                       
                      </td>
					    <td><button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" onclick="jobmodal(1,'<?php echo e($job->title); ?>','<?php echo e($job->description); ?>','<?php echo e($job->jobdep_id); ?>','<?php echo e($job->id); ?>')" data-original-title="Edit">
                            <i class="icon wb-wrench" aria-hidden="true"></i>
                          </button>
                       
                      </td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					<?php else: ?>
						<tr>
 <span style="tex-align:center"><?php echo e(_t('No Record Found')); ?></span>
					</tr>
						
						<?php endif; ?>
					 </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
	  <div class="site-action" data-toggle="modal" data-target="#manualadd" onclick="reset()" data-plugin="actionBtn">
    <button type="button" class="site-action-toggle btn-raised btn btn-success btn-floating">
      <i class="front-icon wb-plus animation-scale-up" aria-hidden="true"></i>
      <i class="back-icon wb-close animation-scale-up" aria-hidden="true"></i>
    </button>
    <div class="site-action-buttons">
      <button type="button" data-action="trash" class="btn-raised btn btn-success btn-floating animation-slide-bottom">
        <i class="icon wb-trash" aria-hidden="true"></i>
      </button>
      <button type="button" data-action="folder" class="btn-raised btn btn-success btn-floating animation-slide-bottom">
        <i class="icon wb-folder" aria-hidden="true"></i>
      </button>
    </div>
  </div>
  
  <!--MANUAL ADD MODAL -->
  <div class="modal fade modal-success " id="manualadd" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" aria-hidden="true" style="display: none; z-index:99999999">
                          <div class="modal-dialog modal-sidebar modal-md">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title"><?php echo e(_t('Add/Modify Job/Department')); ?></h4>
                              </div>
                              <div class="modal-body">
							  <div>
                               <div class="col-xl-4 col-xs-12">
							<b>Type:</b>
							</div>
                              <div class="col-xs-12 col-xl-8 form-group">

						         <select id="datatypem" type="text" class="form-control" >
								  <option value="2">Department</option>
								  <option value="1">Job</option>
								 </select>
                              </div> 
                              </div> 
							    <div id="departmentblockm">
							    <div class="col-xl-4 col-xs-12">
							<b>Department:</b>
							</div>
                              <div class="col-xs-12 col-xl-8 form-group">

						      <input type="text"  placeholder="Enter Department Name" class="form-control" id="departmentm" />
							    
                              </div>
							  
							  </div>
							  	  <div id="hidedepm">
							<div class="col-xl-2 col-xs-12">
							<b>Department:</b>
							</div>
                              <div class="col-xs-12 col-xl-10 form-group" id="showdeptm">

						         <select id="jobdepidm" class="form-control" >
								  <option  disabled>-- Select Department --</option>
								  <?php $__currentLoopData = $dept; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $depts): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								  <option value="<?php echo e($depts->id); ?>"><?php echo e($depts->spec); ?></option>
								  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								 </select>
                              </div> 
								</div>
								
							  <div id="jobblockm">
							   <div class="col-xl-2 col-xs-12">
							<b>Title:</b>
							</div>
                              <div class="col-xs-12 col-xl-10 form-group">

						        <input type="text" id="jobtitle" class="form-control" />
                              </div> 
							  
							  <div class="col-xl-2 col-xs-12">
							<b>Description:</b>
							</div>
                              <div class="col-xs-12 col-xl-10 ">

						        <textarea  data-provide="markdown" data-iconlibrary="fa" data-height="400px" class="md-input" rows="5"  style=""  id="description">
								</textarea>
							    
                              </div>
							  </div>
							
                              </div><br><br>
                              <div class="modal-footer">
                               <div class="col-md-12 " id="changebtn" style="margin-top:30px;"> <button type="button" class="btn btn-primary btn-outline" id="savejobdepm" onclick="savejobdepm()"><i class="fa fa-save mailico"></i><i class="fa fa-circle-o-notch fa-spin fa-fw hidespin"></i>&nbsp;&nbsp;Save changes</button></div>

                              </div>
                            </div>
                          </div>
                        </div>
  <!--MANUAL ADD MODAL -->
  
  
  
	  		  <!--UPLOAD CSV MODAL -->
             <div class="modal fade modal-success modal-3d-sign" id="uploadjob" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title"><?php echo e(_t('Upload Job/Department')); ?> CSV</h4>
                        </div>
                        <div class="modal-body">
                           <form>
                            <div class="row">
							<div class="col-xl-4 col-xs-12">
							<b><?php echo e(_t('Data type')); ?>:</b>
							</div>
                              <div class="col-xs-12 col-xl-8 form-group">

						         <select id="datatype" type="text" class="form-control" >
								  <option value="2"><?php echo e(_t('Department')); ?></option>
								  <option value="1"><?php echo e(_t('Job')); ?></option>
								 </select>
                              </div> 
							  <div id="hidedep">
							<div class="col-xl-4 col-xs-12">
							<b><?php echo e(_t('Department')); ?>:</b>
							</div>
                              <div class="col-xs-12 col-xl-8 form-group" id="showdept">

						         <select id="jobdepid" class="form-control" >
								  <option  disabled>--Select Department --</option>
								  <?php $__currentLoopData = $dept; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $depts): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								  <option value="<?php echo e($depts->id); ?>"><?php echo e(_t($depts->spec)); ?></option>
								  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								 </select>
                              </div> 
								</div>
							
							   <div class="col-xs-12 col-xl-12 form-group" id="dropboxpane">
							   <b><?php echo e(_t('Upload CSV')); ?>:</b><br>
							        <div style="" class="dropzone" id="my-dropzone-files" name="my-dropzone-files">

                                                

                                            </div>
                               
                              </div>
							  
                              </div>
                          </form>
							
						
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(_t('Close')); ?></button>
                          <button type="button" id="import" class="btn btn-primary"><i class="fa fa-file-excel-o mailico"><i class="fa fa-circle-o-notch fa-spin fa-fw hidespin"></i></i>&nbsp;&nbsp;<?php echo e(_t('Import')); ?></button>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
				  
			  <!--UPLOAD CSV MODAL -->
			  
			  <!-- DEPARTMENT MANAGE MODAL-->
			  <div class="modal fade modal-success modal-3d-flip-vertical" id="managedepartment" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title"><?php echo e(_t('All Department')); ?></h4>
                        </div>
                        <div class="modal-body">
						<div class="panel" id="exampleReport">
        <div class="panel-body">
          <div class="panel-heading">
            <div class="panel-title">
				
			
			</div>
			<div class="col-md-4" style="margin-top:-42px;">
				<input type="text" class="form-control round" placeholder="Enter department name to search" onkeyup="search(2)" id="searchfield2">
				</div>
            <div class="panel-actions">
		
             
              <a class="panel-action icon wb-trash" data-toggle="tooltip" data-original-title="Delete Selected Job" id="deletedept" data-container="body" title=""></a>
			  
	
			  
            </div>
          </div>
          <div class="example-wrap">
            <div class="example">
		
              <div class="table-responsive">
  <table class="table table-hover" data-role="content" data-plugin="selectable" data-row-selectable="true" id="departmenttable">
                  <thead class="bg-blue-grey-100">
                    <tr>
                      <th>
                        <span class="checkbox-custom checkbox-primary">
                          <input class="selectable-all" type="checkbox" id="checkall2">
                          <label></label>
                        </span>
                      </th>
                      <th>
                        <?php echo e(_t('Department Name')); ?>

                      </th> 
					  <th>
                       <?php echo e(_t('Action')); ?>

                      </th>
                     
                    </tr>
                  </thead>
                  <tbody>
				  <?php if(count($dept)>0): ?>
					<?php $__currentLoopData = $dept; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr id="delblock<?php echo e($dept->id); ?>">
                      <td>
                        <span class="checkbox-custom checkbox-primary">
                          <input class="selectable-item alldep2"  value="<?php echo e($dept->id); ?>"type="checkbox">
                          <label></label>
                        </span>
                      </td>
                      <td ><?php echo e(_t($dept->spec)); ?>

                       
                      </td>
                     
					  
					    <td><button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" onclick="jobmodal(2,'<?php echo e($dept->spec); ?>',0,'<?php echo e($dept->id); ?>')" data-original-title="Edit">
                            <i class="icon wb-wrench" aria-hidden="true"></i>
                          </button>
                       
                      </td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					<?php else: ?>
						<tr>
					<span style="tex-align:center"><?php echo e(_t('No Record Found')); ?></span>
					</tr>
						
						<?php endif; ?>
					 </tbody>
                </table>
                              
				</div>
            </div>
          </div>
        </div>
      </div>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(_t('Close')); ?></button>
                           </div>
                      </div>
                    </div>
                  </div>
			  <!-- DEPARTMENT MANAGE MODAL-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>