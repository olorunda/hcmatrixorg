<?php $__env->startSection('content'); ?>
<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="token" />
<script>


function query(id,name){
	
	$('#title').text('Query '+name);
	sessionStorage.setItem('name',name);
	sessionStorage.setItem('userid',id);
}

 function assignrole(employeeid,empname){
	//alert(empname);
	$('#empname').html(empname);
	sessionStorage.setItem('employeeid',employeeid);
}

function url(url){
	
	window.location=url;
}

function lockemp(empid){
	
	
			$('#icon'+empid).toggleClass('wb-link');
			$('#icon'+empid).toggleClass('wb-link-broken');
			
	$.get('<?php echo e(url('disableemp')); ?>/'+empid,function(data,status,xhr){
		
		
		if(xhr.status==200){
			console.log(data);
			if(data==1){
			toastr.success('Employee Disabled');
		}
		else{
			toastr.success('Employee Enabled');
	
		}
		}
		else{
			toastr.error('Some Error occurred');
		}
		
	});
}
	
	
	function mapemployee(){
		
		lmid=$('#linemanager').val();
		//	alert('dfdfe');
		if($('.emparrlist').is(':checked')){
			
		}
		else{
			
			toastr.error('Please Select at lease one employee to Map');
			return ;
		}
	    var valuearr=$('.emparrlist:checked').map(function() {return this.value;}).get();
		console.log(valuearr);
		var i=0;
		//$.each(valuearr,function(index,element){
			
			for( i=0; i<valuearr.length; i++){
				//console.log(valuearr[i]);
			$.get('<?php echo e(url('hr/assignlm')); ?>/'+valuearr[i]+'/'+lmid,function(data,status,xhr){
				
				if(xhr.status==200){
					
					sessionStorage.setItem('status',1);
				}
				else{
					sessionStorage.setItem('status',0);
				
				}
				
			
			
			}); 
				}
			if(sessionStorage.getItem('status')==1){
				toastr.success('Employee(s) Succefully Mapped');
					setTimeout(function(){
						
					window.location.reload();	
						
					},2000);
			}
			else{
			toastr.error('Some error occurred');	
			}
			
		
		
	}
	
$(function(){
	
	/**
	* MAPP Employee TO LINE Manager BLOCK
	*
	*
	*
	**/
	
	$('select').select2();
	
$('#checkall').click(function(){

	$('.emparrlist').prop('checked',this.checked);



});
	
	/**
	* MAPP Employee TO LINE Manager BLOCK
	*
	*
	*
	**/
	
	$('#assign').click(function(){
		
		empid=sessionStorage.getItem('employeeid');
        role=$('#assignedrole').val();
		if(role==2){
			rolename='Line-Manager';
			
		}
		else if(role==3){
			rolename="Admin-HR";
		}
		else{
			rolename="Employee";
		}
		
		$.get('<?php echo e(url('hr/assignerole')); ?>?empid='+empid+'&role='+role,function(data,status,xhr){
			//come here
			if(xhr.status==200){
				$('#role'+empid).html(rolename);
				currentlmcount=$('#lmcount').text();
		
				vv=eval(currentlmcount+1);
				$('#lmcount').text(vv);
				toastr.success("Role Assignment Successfull");
			}
			
			else{
			toastr.error("Some Error Occurred:"+data);
				
			}
			
		});
		
		
	});
	
	//dropzone
	var myDropzone = new Dropzone("div#my-dropzone-files", { 
	
	url: "<?php echo e(url('issue/query')); ?>",
	maxFilesize: 1,
	parallelUploads:1,
	acceptedFiles:'image/*,application/pdf',
	maxFiles:1,
	autoProcessQueue:false
	
	});
	
	myDropzone.on("sending", function(file, xhr, formData) {
  // Will send the filesize along with the file as POST data.

     var template=$('#qtemplate').val();
	 var qtypeid=$('#qtype').val();
	 var userid=sessionStorage.getItem('userid');
	 var token=$('#token').val();
	 
  formData.append("template", template);
  formData.append("qtypeid", 0);
  formData.append("userid", userid);
  formData.append("_token", token);
  formData.append("filesize", file.size);
  
   });
   
   //success upload
   myDropzone.on("success",function(file,response){
	   
			
		   toastr.success('Query Successfully Issued');
	  	 myDropzone.removeFile(file);
  
   });
   
    myDropzone.on("error", function(file,response) {
                   // sessionStorage.setItem("error", 1);
                   // $("#disp").html(response);
                  toastr.error('Some error Occurred:'+response);
				 myDropzone.removeFile(file);
                });
   
	
		 $('#issueother').hide();
		 $('#dropboxpane').hide();
	//jhdhdh
  $('#issueother').click(function(){
	
	myDropzone.processQueue();
	 
	 });
	
	
$('#issuequery').click(function(){
	
	 var template=$('#qtemplate').val();
	 var qtypeid=$('#qtype').val();
	 var userid=sessionStorage.getItem('userid');
	 var token=$('#token').val();
	 
	 $.post('<?php echo e(url('issue')); ?>/query',{
		 template:template,
		 qtypeid:qtypeid,
		 userid:userid,
		 _token:token
		 
		 
	 },function (data,status,xhr){
		 console.log(data);
		 if(xhr.status==200){
			 
			 toastr.success('Query Has been Issued to '+sessionStorage.getItem('name'));
			 return 0;
		 }
		 toastr.error('Some Error Occurred');
		 
		 
	 });
	
	
});
//fdjhkfedhfehj

	  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);
 $('#qtype').change(function(){
	 
	 
	 id=$('#qtype').val();
	if(id=="others"){
		 $('#tpane').hide();
		 $('#issuequery').hide();
		 $('#issueother').show();
		 $('#dropboxpane').show();
		 
	}
	else{
		 $('#tpane').show();
	
		 $('#issuequery').show();
		 $('#issueother').hide();
		 $('#dropboxpane').hide();
	 template=$('#'+id).val();
	 
	 $('#qtemplate').val(template);
	 
	}
	 
 });
});

</script>
   

<div class="page container-fluid" >
    <div class="page-header">
  <h1 class="page-title"><?php if(Auth::user()->role==2): ?> <?php echo e(Auth::user()->name); ?>'s Direct Report <?php else: ?> Admin-Hr's Direct Report <?php endif; ?></h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
    <li class="breadcrumb-item active">You are Here</li>
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
          <span class="counter-number font-weight-medium" id="time"></span>
        </div>
      </div>
    </div>
  </div>
</div>
<?php if(Auth::user()->role==3): ?>
<div class="col-lg-6 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix" >
                <div class="pull-xs-left white" style="cursor:pointer;" onclick="url('<?php echo e(url('employee/list')); ?>')">
                  <i class="icon icon-circle icon-2x wb-user bg-red-600" aria-hidden="true"></i>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number jobm"><?php echo e(app('App\Repositories\GlobalSettingRepository')->getlmcount(5)); ?></span>
                    <span class="counter-number-related text-capitalize">Employees</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">in Total</div>
                </div>
              </div>
              <!-- End Card -->
            </div>
			<div class="col-lg-6 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white" style="cursor:pointer;" onclick="url('<?php echo e(url('employee/linemanager')); ?>')">
                  <i class="icon icon-circle icon-2x wb-clipboard bg-red-600" aria-hidden="true"></i>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number " id="lmcount"><?php echo e(app('App\Repositories\GlobalSettingRepository')->getlmcount(2)); ?></span>
                    <span class="counter-number-related ">Line-Manager(s)</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">in Total</div>
                </div>
              </div>
			  </div>
			 <br><br><br><br><br><br><br><br>
	<?php endif; ?>		
		
    <div class="container-fluid">
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body">
		<?php if(Auth::user()->role==3): ?>
		  <div class="col-md-1"><span style="margin-left:15.2px;" class="checkbox-custom checkbox-primary">
                          <input class="selectable-all" type="checkbox" id="checkall">
                          <label></label>
                        </span></div>
					<?php endif; ?>
          <form class="page-search-form" role="search" method="GET" action="<?php echo e(url('employee/list')); ?>">
            <div class="input-search input-search-dark col-md-4">
              <i class="input-search-icon wb-search" aria-hidden="true"></i>
              <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search Users">
              <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
            </div>
			
          </form>
		  <?php if(Auth::user()->role==3): ?>
		  <div class="col-md-1"></div>
		  
		  <div class="col-md-2">
		  <button class="btn btn-outline btn-success" data-toggle="modal" data-target="#lmlist"><i class="wb wb-clipboard"></i>&nbsp;&nbsp;Map Selected Employee To Line-Manager</button>
		  </div>
		  <?php endif; ?>
		  <br>
		 <div class="pull-right" style="margin-top:-15px;" >
		 About <?php echo e($employees->total()); ?> Result(s)</div>
          <div class="nav-tabs-horizontal " >
             <div ><br>
              <div class=""  role="tabpanel">
			  
				<?php if(count($employees)>0): ?>
                <ul class="list-group">
			<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<?php if($employee->id==Auth::user()->id): ?>
			
				<?php else: ?>
               <li class="list-group-item">
                    <div class="media">
                      <div class="media-left">
                        <div class="avatar ">
						<?php if(Auth::user()->role==3): ?>
						<span style="margin-left:9px;" class="checkbox-custom checkbox-primary">
                          <input class="selectable-all emparrlist" value="<?php echo e($employee->id); ?>" type="checkbox" id="">
                          <label></label>
                        </span>
						<?php endif; ?>
						 <img src="<?php echo e(url('upload')); ?>/<?php echo e($employee->image); ?>" alt="<?php echo e($employee->name); ?>">
                          <i></i>
                        </div>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading">
                          <?php echo e($employee->name); ?>

                          
                        </h4>
                        <p>
                          <i class="icon icon-color wb-map" aria-hidden="true"></i>                          <?php echo e($employee->address); ?>

                        </p>                        
						<p>
						<p>
                          <i class="icon icon-color wb-map" aria-hidden="true"></i>Role: <span id="role<?php echo e($employee->id); ?>"> <?php if($employee->role==1): ?> Employee <?php endif; ?> <?php if($employee->role==2): ?> <b>Line-Manager</b> <?php endif; ?>
						  <?php if($employee->role==3): ?> <b>Admin-HR</b>
						  
						  <?php endif; ?>  
							</span>
                        </p>                        
						<p>
                          <i class="icon icon-color wb-user" aria-hidden="true"></i> Managed By:
						  <?php if(Auth::user()->id==$employee->linemanager_id): ?>
							 You 
						  <?php else: ?>
						  <?php $name=app('App\Repositories\EmployeeRepository')->manager($employee->linemanager_id)['name']; ?>
						  <?php echo e($name); ?>

						  <?php endif; ?>
                        </p>
						<?php if(Auth::user()->role==3): ?>
						<p>
                          <i class="icon icon-color fa fa-user-plus" aria-hidden="true"></i>Assign Role: <button type="button" title="Assign Role" class="btn btn-pure btn-primary fa fa-user-plus " data-toggle="modal" data-target="#assignrole"onclick="assignrole('<?php echo e($employee->id); ?>','<?php echo e($employee->name); ?>')"></i></button>
						  					  
                        </p>
						<?php endif; ?>
						<div>
                          <a class="text-action" href="mailto:">
                            <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                          </a>
                          <a class="text-action" href="<?php echo e($employee->instagram); ?>">
                            <i class="icon icon-color bd-instagram" aria-hidden="true"></i>
                          </a>
                          <a class="text-action" href="<?php echo e($employee->twitter); ?>">
                            <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                          </a>
                          <a class="text-action" href="<?php echo e($employee->facebook); ?>">
                            <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                          </a>
                          <a class="text-action" href="<?php echo e($employee->dribble); ?>">
                            <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                          </a>
                        </div>
                       </div>
					   <?php if(Auth::user()->id==$employee->id): ?>
						 <?php else: ?>
                      <div  class="media-right" >
                    <div class="btn-group-vertical" aria-label="Vertical button group" role="group">
					
					<!-- Make LINE MANAGER -->
                  
					<!-- Make LINE MANAGER -->
					
					 <button type="button" title="View Profile" class="btn btn-outline btn-primary"><i class="icon wb-eye" aria-hidden="true"></i></button>
                    <button type="button" title="Query Employee" class="btn btn-outline btn-warning" data-target="#querymod" onclick="query('<?php echo e($employee->id); ?>','<?php echo e($employee->name); ?>')" data-toggle="modal" ><i class="icon wb-hammer" aria-hidden="true"></i></button>
					<?php if(Auth::user()->role==3): ?>
						
						<?php if($employee->locked==0): ?>
						<?php 
					$type="wb-link";
					
					?>
						<?php else: ?>
						<?php  $type="wb-link-broken"; 
							
					?>	
					<?php endif; ?>
                    <button type="button" id="disable" title="Disable/Enable Employee" class="btn btn-outline btn-danger" onclick="lockemp(<?php echo e($employee->id); ?>)"><i id="icon<?php echo e($employee->id); ?>" class="icon <?php echo e($type); ?>" aria-hidden="true"></i></button> 
				
				
					<?php endif; ?>
                     </div>
                      </div>
						<?php endif; ?>
				   </div>
                  </li>
				  <hr>
				  	<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			
				</ul>
                <?php else: ?>
					
				No Result Found
				<?php endif; ?>
				<?php echo $employees->render(); ?>

				</div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Panel -->
    </div>
  </div>

  <div class="modal fade modal-3d-sign" id="querymod" aria-labelledby="exampleModalTitle" role="dialog"  aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="title"></h4>
                        </div>
                        <div class="modal-body" id="query">
                       
						  <form>
                            <div class="row">
							<div class="col-xl-4 col-xs-12">
							<b>Select Query Types:</b>
							</div>
                              <div class="col-xs-12 col-xl-8 form-group">
							     <?php if(count($querytype)>0): ?>
									 <?php $__currentLoopData = $querytype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> 
							     <input type="hidden" value="<?php echo e($types->template); ?>" id="<?php echo e($types->id); ?>"/>
								 <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								  <?php endif; ?>
								  
						         <select id="qtype" data-plugin="select2" type="text" class="form-control" >
								  <option >-Select query Type--</option>
								
								 <?php if(count($querytype)>0): ?>
									 <?php $__currentLoopData = $querytype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								
								  <option value="<?php echo e($types->id); ?>"><?php echo e($types->title); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								  <?php endif; ?>
								  <option value="others">Others</option>
								
								 </select>
								
                               
                              </div> 

							  <div class="col-xs-12 col-xl-12 form-group" id="tpane">
							      <textarea  data-provide="markdown" data-iconlibrary="fa" data-height="400px" class="md-input" rows="5"  style=""  id="qtemplate">
									</textarea>
							    
						       
								
                               
                              </div>
							   <div class="col-xs-12 col-xl-12 form-group" id="dropboxpane">
							   <b>Upload Query Letter:</b><br>
							        <div style="" class="dropzone" id="my-dropzone-files" name="my-dropzone-files">

                                                

                                            </div>
                               
                              </div>
							  
                              </div>
                          </form>
							
						
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="issuequery" class="btn btn-primary">Issue Query</button>  
						  <button type="button" id="issueother" class="btn btn-primary">Issue Query</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  <!-- ASSIGN ROLE -->
				  <div class="modal fade modal-3d-flip-vertical" id="assignrole" aria-labelledby="exampleModalTitle" role="dialog"  style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Assign Role to <span id="empname"></span></h4>
                        </div>
                        <div class="modal-body">
                          <p>Select Role</p>
						  <select id="assignedrole" data-plugin="select2" class="form-control">
						  <option value="2">Line-Manager</option>
						  <option value="3">Admin-HR</option>
						  
						  </select>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="assign">Assign</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  <!-- ASSIGN ROLE -->
				  
				  <!--MAP EMPLOYEE TO LINE-MANAGER -->
				  <div class="modal fade modal-rotate-from-bottom" id="lmlist" aria-labelledby="exampleModalTitle" role="dialog"  aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Map Linemanager to Employee</h4>
                        </div>
                        <div class="modal-body">
                          <div class="modal-body">
                          <p>Select Line Manager</p>
						  <select id="linemanager">
						  <?php if(count($lms)>0): ?>
						  <?php $__currentLoopData = $lms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lm): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						  <option value="<?php echo e($lm->id); ?>"><?php echo e($lm->name); ?></option>
						  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						  <?php else: ?>
							<option>-No Line Manager-</option>
						   
						  <?php endif; ?>
						  </select>
                        </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" onclick="mapemployee()" class="btn btn-primary">Map Selected Employee</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  <!--MAP EMPLOYEE TO LINE-MANAGER -->
				  
				  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>