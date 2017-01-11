<?php $__env->startSection('content'); ?>
 
 
<script>

//query employee

function query(id,name){
	
	$('#title').text('Query '+name);
	sessionStorage.setItem('name',name);
	sessionStorage.setItem('userid',id);
}
	

//query ends
//date search 
function datesearch(type=0){
	
	
	startdate=$('#startdate').val();
	starttime=$('#starttime').val();
	enddate=$('#enddate').val();
	endtime=$('#endtime').val();
	empname=$('#q').val();

	if(empname!=""){
		addionalsearch="&q="+empname;
	}
	else{
		addionalsearch="";
	}
	if(startdate=="" || starttime=="" || enddate=="" || endtime==""){
		toastr.error("Please fill In all fields");
		
		return ;
	}
	
	if(type==1){
		
	window.location='<?php echo e(url('attendance/timesearch')); ?>?startdate='+startdate+'&enddate='+enddate+'&starttime='+starttime+'&enddtime='+endtime+'&type=1'+addionalsearch;

	return ;
	}
	window.location='<?php echo e(url('attendance/timesearch')); ?>?startdate='+startdate+'&enddate='+enddate+'&starttime='+starttime+'&enddtime='+endtime+'&type=0'+addionalsearch;
}


$(function(){
	
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
<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="token" />
<div class="page-header">
  <h1 class="page-title">Attendance Management</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
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
          <span class="counter-number font-weight-medium" id="time">08:32:56 am</span>
        </div>
      </div>
    </div>
  </div>
  
</div>

			<div class="col-lg-6 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-30">
                <div class="counter counter-md text-xs-left">
                  <div class="counter-label text-uppercase m-b-5"><b>Total Early Employee(s) Today</b></div>
                  <div class="counter-number-group m-b-10">
                    <span class="counter-number"><?php echo e($attstat['early']); ?></span>
                  </div>
                  <div class="counter-label">
                    <div class="progress progress-xs m-b-10">
                      <div class="progress-bar progress-bar-danger bg-blue-600" aria-valuenow="70.3" aria-valuemin="0" aria-valuemax="100" style="width: 70.3%" role="progressbar">
                        <span class="sr-only">1%</span>
                      </div>
                    </div>
                    <div class="counter counter-sm text-xs-left">
                      <div class="counter-number-group">
                        <span class="counter-icon blue-600 m-r-5"><i class="wb-graph-up"></i></span>
                        <span class="counter-number"><?php echo e(round(($attstat['early']/$attstat['total'])*100,1)); ?>%</span>
                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Card -->
            </div>
			<div class="col-lg-6 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-30">
                <div class="counter counter-md text-xs-left">
                  <div class="counter-label text-uppercase m-b-5"><b>Total Late Employee(s) Today</b></div>
                  <div class="counter-number-group m-b-10">
                    <span class="counter-number"><?php echo e($attstat['late']); ?></span>
                  </div>
                  <div class="counter-label">
                    <div class="progress progress-xs m-b-10">
                      <div class="progress-bar progress-bar-info bg-red-600" aria-valuenow="70.3" aria-valuemin="0" aria-valuemax="100" style="width: 70.3%" role="progressbar">
                        <span class="sr-only">70.3%</span>
                      </div>
                    </div>
                    <div class="counter counter-sm text-xs-left">
                      <div class="counter-number-group">
                        <span class="counter-icon blue-600 m-r-5"><i class="wb-graph-up"></i></span>
                        <span class="counter-number"><?php echo e(round(($attstat['late']/$attstat['total'])*100,1)); ?>%</span>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Card -->
            </div>
			 
<div class="col-md-12 col-xs-12 col-md-12" >
<div class="panel " >
        <div class="panel-body container-fluid">
          <div class="row row-lg">
            

            <div class="col-xl-12 col-xs-12">
              <!-- Example Table Selectable -->
	<div class="col-md-8">
	</div>		  
<div class="col-md-4">

<div class="input-group">
                   
                    <input value="<?php echo e(old('q')); ?>" id="q" name="q" class="form-control" type="text" name="round-input-control" placeholder="Enter Employee number or name">  
                    
                  </div></div><div class="col-md-12" style="margin-top:30px;"></div>
              <div class="example-wrap">
			  	<div class="col-md-2"><b>Date Range :</b></div>
                <p id="basicExample">
				
				<div class="col-md-5" style="margin-left:-40px">
			
				<div class="input-group  " >
                    <span class="input-group-addon">
                      <i class="icon wb-calendar" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control datepair-date datepair-start" id="startdate" data-plugin="datepicker">
                 
                    <span class="input-group-addon">
                      <i class="icon wb-time" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control datepair-time datepair-start ui-timepicker-input" id="starttime" data-plugin="timepicker" autocomplete="off">
                  </div>
                  </div>
				  
				  <div class="col-xl-1">
				  to
				  </div>
				  <div class="col-xl-5">
				  <div class="input-group col-xl-5" style="margin-top:-23px; margin-left:15px; ">
                   
                    <span class="input-group-addon">
                      <i class="icon wb-calendar" aria-hidden="true"></i>
                    </span>
                    <input id="enddate" type="text" class="form-control datepair-date datepair-end" name="end" data-plugin="datepicker">
                 
                    <span class="input-group-addon">
                      <i class="icon wb-time" aria-hidden="true"></i>
                    </span>
                    <input id="endtime" type="text" class="form-control datepair-time datepair-end ui-timepicker-input" data-plugin="timepicker" autocomplete="off">
                 
                    <span style="cursor:pointer;" onclick="datesearch()" title="Search" class="input-group-addon">
                    
					<i class="fa fa-search "></i>
                    </span>
					<span style="cursor:pointer;" onclick="datesearch(1)" title="Export to Excel" class="input-group-addon"><i class="fa fa-file-excel-o"></i>
                    
                    </span>
                  </div>
                  </div>
</p><div class="col-md-12" style="margin-bottom:40px;"></div>

                <div class="example">
				  <div class="pull-right">About <b><?php echo e($attendances->total()); ?></b> result(s)</div>
				  <div class="col-md-12" style="margin-top:10px;"></div>
                  <table class="table table-hover" data-plugin="selectable" data-row-selectable="true">
                    <thead>
                      <tr class="bg-blue-grey-100">

                        <th>
                          EMPID
                        </th>
                        <th>
                          NAME
                        </th>
                        <th class="hidden-sm-down">
                          CLOCK IN TIME
                        </th>
                        <th class="hidden-sm-down">
                          CLOCK OUT TIME
                        </th> 
						<th class="hidden-sm-down">
                          STATUS
                        </th>
						<th class="hidden-sm-down">
                          ACTION
                        </th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php if(count($attendances)>0): ?>
					 <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    
                     <tr>
					       <td><?php echo e($attendance->emp_num); ?></td>
                        <td><?php echo e($attendance->name); ?></td>
                        <td class="hidden-sm-down">
                        <span class="text text-success">
						<b><?php echo e($attendance->created_at); ?></b>
						</span>
                        </td>
                        <td class="hidden-sm-down">
						
                        <span class="text text-danger">
						<b><?php if($attendance->clockout_time==""): ?> Nill <?php else: ?> <?php echo e($attendance->clockout_time); ?> <?php endif; ?></b>
					   </span>
                        </td>
						<td><?php if($attendance->status==""): ?>
						<?php echo e($attendance->status); ?>

						<?php $latestat=app('App\Repositories\GlobalSettingRepository')->checkearly($attendance->created_at,$attendance->status,$attendance->id,$attendance->ids);  ?>
						<?php else: ?>
							<?php $latestat=$attendance->status; ?>
						<?php endif; ?>
						<span class="tag <?php if($latestat=='Early'): ?> tag-success <?php else: ?> tag-danger <?php endif; ?>"><?php echo e($latestat); ?></span>
						</td>
						<td>
						 <button type="button" title="Query Employee" class="btn btn-outline btn-warning" data-target="#querymod" onclick="query('<?php echo e($attendance->id); ?>','<?php echo e($attendance->name); ?>')" data-toggle="modal" ><i class="icon wb-hammer" aria-hidden="true"></i></button>
						</td>
                      </tr>
					  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					  <?php else: ?>
						<tr>
					<td>
					</td><td>
					</td><td>
					</td>
					<td >
						<b style="font-size:20px;" class="text-success"> No Attendance Report For Today Yet</b>
						</td>

						</tr>
					  <?php endif; ?>
					  
                    </tbody>
                  </table>
				 
				  <?php echo e($attendances->render()); ?>

				
                </div>
              </div>
              <!-- End Example Table Selectable -->
            </div>
          </div>
        </div>
      </div>
</div>
<!-- SET START OF BUSINESS & CLOSE OF BUSINESS -->
<!-- FISCAL MODAL ENDS -->
<!-- QUERY MODAL STARTS -->

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
	
<!-- QUERY MODAL ENDS-->
<!-- SET START OF BUSINESS & CLOSE OF BUSINESS -->

	  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>