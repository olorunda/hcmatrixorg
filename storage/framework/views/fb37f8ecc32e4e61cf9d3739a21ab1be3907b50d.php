<?php $__env->startSection('content'); ?>
  
<script>
//search


function sort(){
	

}
function urlChange(url) {
   // var site = url+'?toolbar=0&amp;navpanes=0&amp;scrollbar=0';
    document.getElementById('loaddoc').src = url;
}

$(function(){

$('#statusleave').change(function(){
	
	
	var status=$('#statusleave').val();
	window.location='<?php echo e(url('sort')); ?>/'+status;
	
	
});
 
	

 $('#statusleave').select2();

$('.btcal').click(function() {
    window.setTimeout(clickToday, 200);
});

});

function clickToday() {
    $('.fc-today-button').click();
}

$(function(){
			
	$('#script-warning').hide();
	
});


function loadcal(type){
    $('#calendar').fullCalendar({
         noEventsMessage:'No Leave Request For today',
		 allDayText:'Leave Request',
		  defaultView: 'listWeek',
          header: {
				left: 'prev,next today',
				center: 'Employee Leave Request Calender',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			events: {
				url: '<?php echo e(url('manage/getleave')); ?>',
				error: function() {
					$('#script-warning').show();
				},
					color: '#263238',     // an option!
					textColor: 'yellow' // an option!
				
			}
		
    });

}



	function url(url){
		window.location=url;
	}
	function  submitdecision(comment,type,id,email){
	//alert(email);
		var token=$('#token').val();
	//	return alert(type);
	
		$.post('<?php echo e(url('manage')); ?>',{
			
			comment:comment,
			type:type,
			id:id,
			email:email,
			_token:token,
			
		},function (data,status,xhr){
		//console.log(data);
			if(xhr.status==200){
				
				$('#action'+id).hide();
				$('#decide'+id).show();
				$('#lmtext'+id).hide();
				$('#lmcomment'+id).show();
				
				
				if(type==1){
					
					//$('#statusset').html('<span class="tag tag-success">Approved </span>');
					$('#lmcomment'+id).html(comment+'( <span class="tag tag-success">Approved </span> )');
					toastr.success('Leave Approved');
				 swal('success','Leave Approved','success');
				 
				 <?php if(Auth::user()->role==3): ?>
					 setTimeout(function(){
						 
						 window.location.reload();
						 
					 },2000);
				 
				 <?php endif; ?>
				 
				 return ;
				}
				else{
					
					//$('#statusset').html('<span class="tag tag-danger">Rejected </span>');
					$('#lmcomment'+id).html(comment+'( <span class="tag tag-danger">Rejected</span> )');
					toastr.error('Leave Rejected');
			
			
				swal('Rejected','Leave Rejected','error');
				
				 <?php if(Auth::user()->role==3): ?>
					 setTimeout(function(){
						 
						 window.location.reload();
						 
					 },2000);
				 
				 <?php endif; ?>
				 return ;
				}
			}
			return swal('Error','Some error occurred','error');
			
			
			
			
		});
		
		
	}
	
	function fixclode(id){
		
		$('#lmtext'+id).show();
		$('#action'+id).toggle();
		$('#decide'+id).show();
		$('#lmtext'+id).toggle(); 
		$('#lmcomment'+id).show();
							 
	}

	function hide(id,email){
					 
					 $('#lmtext'+id).hide();
					 $('#action'+id).hide();
					 
					 $('#accept'+id).click(function(){
						
						//send ajax
					   var comment= $('#commitment'+id).val();
						 submitdecision(comment,1,id,email);
					 }); 


					 $('#decide'+id).click(function(){
						 
						//
							 $('#action'+id).show();
							 $('#decide'+id).hide();
							 $('#lmtext'+id).show(); 
							 $('#lmcomment'+id).hide();
						
						 
					 }); 
					 
					 $('#reject'+id).click(function(){
						   var comment= $('#commitment'+id).val();
						   	 submitdecision(comment,2,id,email);
						// send reject ajax
						 
					 });
					 
					 
				 }

</script>

<div class="page bg-white" >
	<div class="page-aside">
		<!-- Contacts Sidebar -->
		<div class="page-aside-switch">
			<i class="icon wb-chevron-left" aria-hidden="true"></i>
			<i class="icon wb-chevron-right" aria-hidden="true"></i>
		</div>
		<div class="page-aside-inner page-aside-scroll scrollable is-enabled scrollable-vertical">
			<div data-role="container">
				<div data-role="content">
				
					<div class="page-aside-section">
						<div class="list-group">
							<a class="list-group-item" href="javascript:void(0)" onclick="cat('A')">
								<span class="item-right"><?php echo e(count($directemps)); ?></span><i class="icon wb-inbox" aria-hidden="true"></i>All Request
							</a>
							</div>
							<div class="list-group" style="margin:0px 20px 0 20px;">
							<select id="statusleave"   data-plugin="select2" onclick="sort()" class="form-control" >
			
				<option>-Select Criteria-</option>
				<option value="5">All</option>
				<option disabled class="select2-results__group" style="font-size:15px;"><p class="text-center">  -Priority- </p></option>
				<option value="0">Normal</option>
				<option value="1">Medium</option>
				<option value="2">High</option>
				
				<option disabled class="select2-results__group" style="font-size:25px;"><p class="text-center">  -Status- </p></option>
				<option value="3">Approved</option>
				<option value="4">Rejected</option>
			
				</select>
						
                
						</div>
					</div>
					<div class="page-aside-section">
					<h4 class="page-aside-title">Leave Category</h4>
						<div class="page-aside-section">
						<?php if(count($leavecat)>0): ?>
						
							<input type="hidden" name="lmtoken" id="lmtoken" value="<?php echo e(csrf_token()); ?>">
						
							<?php $__currentLoopData = $leavecat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<div class="list-group">
								<h5>
									<a class="list-group-item" href="<?php echo e(url('leave')); ?>?type=<?php echo e($leave->id); ?>">
										<span class="item-right"></span><i class="fa fa-plane " aria-hidden="true"></i> <?php echo e($leave->name); ?>

									</a>
								</h5>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						
						
							<?php endif; ?>
							</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<!-- Employee Table Content -->
	<div class="page-main"  >
		<!-- Employee Table Content Header -->
		<div class="page-header">
			<h1 class="page-title">Direct Reports</h1>
			<div class="page-header-actions">
				<form method="GET" action="<?php echo e(url('search')); ?>">
					<div class="input-search input-search-dark">
						<i class="input-search-icon wb-search" aria-hidden="true"></i>
						<input type="text" class="form-control" name="q" id="searchfield" onkeyup="search($(this).val())" placeholder="Search: Employee name...">
					</div>
				</form>
			</div>
		</div>
		<!-- Employee Table Content -->
		<div id="contactsContent" class="page-content page-content-table" data-plugin="asSelectable">
			<!-- Actions -->
			<div class="page-content-actions">
			</div>
			<!-- Employees Table -->
			<table class="table table-condensed" id="directempstable">
				<thead>
					<tr>
						
						<th>Name</th>
						<th>ID</th>
						<th>Role</th>
						<th>Type</th>
						<th>Priority</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="directempsbody">
				<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="token" />
					<?php if(count($directemps) > 0): ?>
					<?php $__currentLoopData = $directemps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						
						<td height="10">
							<img  class="img-circle img-bordered img-bordered-primary" alt="avatar" src="<?php echo e(asset('storage')); ?>/<?php echo e($emp->image); ?>" style="margin-left:5px; align:center; width: 50px;height: 50px;" /><br>
							<?php echo e($emp->name); ?>

						</td>
						
						<?php  $job=app('App\Http\Controllers\EmployeeController')->getjobdetail($emp->job_id) ?>
						<td height="10"><?php echo e($emp->emp_num); ?></td>
						<td height="10"><?php echo e($job['title']); ?></td>
						<?php $leavetype=app('App\Repositories\EmployeeRepository')->leavecat($emp->absencetypes_id); ?>
						<td> <?php echo e($leavetype); ?>  </td>
						<td> <?php if($emp->priority=='0'): ?> <span class="tag tag-success" ><b>Normal</b></span> <?php elseif($emp->priority=='1'): ?> <span class="tag tag-warning" ><b>Medium</b></span> <?php else: ?> <span class="tag tag-danger" ><b>High</b></span> <?php endif; ?> </td>
						<td><?php if($emp->status==0): ?> <span class="tag tag-warning">Pending </span> <?php elseif($emp->status==1): ?> <span class="tag tag-success">Approved </span><?php else: ?> <span class="tag tag-danger">Rejected </span> <?php endif; ?></td>
						<td height="10">
							
							<button style="padding:10px;" type="button" class="btn btn-outline btn-icon btn-warning btn-sm" title="View Request" data-target="#viewcomment<?php echo e($emp->id); ?>" onclick="hide('<?php echo e($emp->id); ?>','<?php echo e($emp->email); ?>')" data-toggle="modal" >
								<i class="icon wb-eye" aria-hidden="true"></i>
							</button>
							
						</td>
						<!--VIEW REQUEST -->
					
						
						<!-- mmm-->
						<div class="modal fade modal-3d-flip-horizontal" id="viewcomment<?php echo e($emp->id); ?>" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" data-keyboard="false" data-backdrop="static" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" onclick="fixclode('<?php echo e($emp->id); ?>')" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title"><b><i class="icon  wb-align-justify"></i>&nbsp;&nbsp;Leave Request</b></h4>
                        </div>
                        <div class="modal-body">
                       
			 <div class="example table-responsive">
                <div class="card card-block">
              <h4 class="card-title"><?php echo e(strtoupper($emp->name)); ?></h4>
              <p class="card-text">
			  <div class="col-md-12" style="margin-bottom:10px;">
			  <div class="col-md-4"><b>Leave Type:</b></div>
			  <div class="col-md-8"><?php echo e($leavetype); ?></div>
			  </div>
			  <div class="col-md-12" style="margin-bottom:10px;">
			    <div class="col-md-4"><b>Reason:</b></div>
			  <div class="col-md-8"><?php echo e($emp->reason); ?></div>
			  </div>
			  <div class="col-md-12" style="margin-bottom:10px;">
			    <div class="col-md-4"><b>Date:</b></div>
			
			  <div class="col-md-8"><?php echo e(date('F j, Y',strtotime($emp->startdate))); ?>&nbsp;&nbsp;&nbsp;&nbsp; <b>To</b>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo e(date('F j, Y',strtotime($emp->expected_end))); ?></div>
			  </div>
			  <div class="col-md-12" style="margin-bottom:10px;">
			     <div class="col-md-4"><b>Status:</b></div>
			  <div class="col-md-8" id="statusset"><?php if($emp->status==1): ?> <span class="tag tag-success"  >Approved </span><?php elseif($emp->status==2): ?> <span class="tag tag-danger">Rejected </span> <?php else: ?> <span class="tag tag-warning">Pending</span> <?php endif; ?></div>
			  </div>
			    <div class="col-md-12" style="margin-bottom:10px;">
			     <div class="col-md-4"><b>Your Comment:</b></div>
				 <div class="col-md-8" id="lmtext<?php echo e($emp->id); ?>">
				  <textarea  data-provide="markdown" data-iconlibrary="fa"  id="commitment<?php echo e($emp->id); ?>" class="md-input" rows="5" style="width: 100%; resize: none;" ><?php echo e($emp->lm_comments); ?></textarea>
				 </div>
			
				
			  <div class="col-md-8" id="lmcomment<?php echo e($emp->id); ?>">
			  
			  <?php if($emp->lm_comments==""): ?> No Comment Yet <?php else: ?> <?php echo e($emp->lm_comments); ?>(<?php if($emp->lm_approve==1): ?> <span class="tag tag-success">Approved </span><?php else: ?> <span class="tag tag-danger">Rejected </span> <?php endif; ?>) <?php endif; ?></div>
			  </div>
			    <div class="col-md-12" style="margin-bottom:10px;">
			     <div class="col-md-4"><b>Admin Comment:</b></div>
			  <div class="col-md-8"><?php if($emp->admin_comments==""): ?> No Comment Yet <?php else: ?> <?php echo e($emp->admin_comments); ?>( <?php if($emp->admin_approve==1): ?> <span class="tag tag-success">Approved </span><?php else: ?> <span class="tag tag-danger">Rejected </span> <?php endif; ?> ) <?php endif; ?> </div>
			  </div> 
			  <div class="col-md-12" style="margin-bottom:10px;">
			     <div class="col-md-4"><b>Board Comment:</b></div>
			  <div class="col-md-8"><?php if($emp->board_comments==""): ?> No Comment Yet <?php else: ?> <?php echo e($emp->board_comments); ?>( <?php if($emp->board_approve==1): ?> <span class="tag tag-success">Approved </span><?php else: ?> <span class="tag tag-danger">Rejected </span> <?php endif; ?> ) <?php endif; ?></div>
			  </div>
			  </div>
             
            </div>
             </div>
                       
                        <div class="modal-footer">
						   <?php if($emp->status=="1" || $emp->status=="2"): ?>
							<?php else: ?>
							<button type="button" id="decide<?php echo e($emp->id); ?>" class="btn btn-icon btn-success btn-outline"><i class="icon   wb-help-circle" title="Decide" aria-hidden="true"></i>&nbsp;Decide</button>
						    <?php endif; ?>
							<div >
							<div id="action<?php echo e($emp->id); ?>">
						<button type="button" id="accept<?php echo e($emp->id); ?>" class="btn btn-icon btn-success btn-outline"><i class="icon  wb-check" title="Accept" aria-hidden="true"></i></button>
						<button type="button" id="reject<?php echo e($emp->id); ?>" class="btn btn-icon btn-danger btn-outline"><i class="icon  wb-close" title="Reject"  aria-hidden="true"></i></button>
						<?php if($emp->file!=""): ?>
							<button  type="button" onClick="urlChange('<?php echo e(url('upload')); ?>/support/<?php echo e($emp->file); ?>')" data-toggle="modal" data-target="#viewdoc"  class="btn btn-icon btn-info btn-outline"><i class="icon wb-file" title="Calender"   aria-hidden="true"></i>&nbsp;View Document</button>
						<?php endif; ?>
						</div>
						<?php if($emp->status=="1" || $emp->status=="2"): ?>
							
						<button  type="button" data-target="#calview"  onclick="loadcal('<?php echo e($leavetype); ?>')" id="button" data-toggle="modal"  class="btcal btn btn-icon btn-info btn-outline"><i class="icon   wb-calendar" title="Calender"   aria-hidden="true"></i>&nbsp;Check Calender</button>
							<?php else: ?>
						<button style="float:left; margin-top:-37px;" type="button" data-target="#calview"  onclick="loadcal('<?php echo e($leavetype); ?>')" id="button" data-toggle="modal"  class="btcal btn btn-icon btn-info btn-outline"><i class="icon   wb-calendar" title="Calender"   aria-hidden="true"></i>&nbsp;Check Calender</button>
					<?php endif; ?>
					
                       	</div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
						
						
						
						
						<!--END VIEW REQUEST -->
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<th colspan="5"><?php echo e($directemps->links()); ?></th>
					</tr>
					<?php else: ?>
					<tr>
						<th colspan="5">
							<h3>No Leave Requests Yet.</h3>
						</th>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
	<a class="btn btn-primary btn-outline" id="exampleCloseButton" data-plugin="toastr" data-message="No match found." data-title="Search Box" data-container-id="toast-bottom-right" data-close-button="true" data-tap-to-dismiss="false" data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button" style="display: none;">Generate</a>
</div>
<div class="modal fade modal-3d-flip-vertical" id="calview" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title"><b><i class="icon  wb-calendar"></i>&nbsp;&nbsp;Employee 360 Leave Requests</b></h4>
                        </div>
                        <div class="modal-body">
                       <span class="alert alert-danger " id="script-warning">Unable to load event</span>
			        <div id='calendar'></div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>
				  
				     <div id="viewdoc" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content -->
    <div class="modal-content modal-lg" style="margin-left:-15%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
      <div class="modal-body">
    
	   <iframe  id="loaddoc"  style="border:none; width:100%; height:1000px;"  > </iframe>
     </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div> 
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>