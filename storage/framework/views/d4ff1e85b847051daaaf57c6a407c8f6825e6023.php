<?php $__env->startSection('content'); ?>
<script>

function scorerange(){
	
	startscore=$('#startscore').val();
	endscore=$('#endscore').val();
	
	window.location='<?php echo e(url('applicant')); ?>/job?id=<?php echo e(session('jobid')); ?>&type=s&startscore='+startscore+'&endscore='+endscore;
	
	
}
function search(){
	
	

  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("searchfield");
  filter = input.value.toUpperCase();
  table = document.getElementById("directempstable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }

	
}

function urlChange(url) {
   // var site = url+'?toolbar=0&amp;navpanes=0&amp;scrollbar=0';
    document.getElementById('loaddoc').src = url;
}

//decide approve or reject
function decide(empid,decision,email,name,jobtitle,token=1){
	
	if (token==1){
	var token=$('#token').val();
	}
	else{
		var token=token;
	}
	$.post('<?php echo e(url('appdisp')); ?>',{
		
		empid:empid,
		email:email,
		decide:decision,
		name:name,
		jobtitle:jobtitle,
		_token:token
		
	},function(data,status,xhr){
		
		if(xhr.status==200){
			if(decision==2){
			$('#stat'+empid).html('<span class="tag tag-danger">Rejected </span>');
			toastr.error('Rejected Successfully');
			}
			else{
			$('#stat'+empid).html('<span class="tag tag-success">Accepted </span>');
			toastr.success('Accepted Successfully');	
			}
		}
		else{
			toastr.error('An error Occurred');	
			
		}
		
	});
	
	
}

  function mail(email,name,id){
      
	  mailcond(0);
	$("#email").val(email);
	$("#name").val(name);
    $( "#email" ).prop( "disabled", true );
    $( "#name" ).prop( "disabled", true );
	
	$('.appname').text('Mail '+name);
	$('#name').val(name);
	$('#email').val(email);
	$('#id').val(id);
  
	
  }
  
function mailcond(type){
	
	if(type==1){
			$('#selectmulitple').removeClass('hide');
	$('#sendmail').hide();
	$('#sendmailmult').show();
	$('.appname').text('Mail Multiple Applicants');
	$('#name').hide();
	$('#email').hide();
	$('#multiname').show();
	
	}
	else{
		
	$('#selectmulitple').addClass('hide');
	$('#sendmail').show();
	$('#sendmailmult').hide();
	$('#name').show();
	$('#email').show();
	$('#multiname').hide();
	}
}

 function selectall(type){
	 if(type==1){
 $('#multiname').multiSelect('select_all');
	 }
	 else{
 $('#multiname').multiSelect('deselect_all');

	 }
 }
 
 function mailsending(name,email,message,id,token){
	 
	 	$.post('<?php echo e(url('sendmail')); ?>',{
		
			name:name,
			id:id,
			email:email,
			message:message,
			_token:token
			
		},function(data,status,xhr){
			
			if(xhr.status==200){
				toastr.success('Mail Successfully Sent to '+name);	
			}
			else{
				toastr.error('Some error Occurred:'+data);	
		
			}
			
		});
	 
 }

$(function(){
	
	
	
	$('.hidespin').hide();
	$(document).ajaxStart(function(){
		$('.mailico').hide();
		$('.hidespin').show();
		
		
		
	}).ajaxStop(function(){
		
		
		$('.hidespin').hide();
		
		$('.mailico').show();
	});
	
	//send multiple mail
	$('#sendmailmult').click(function(){
	
		var message=$('#message').val();
		
	   if(message==""){
		   
		return toastr.error('Message field empty');
		
	  }
		var token=$('#token').val();
		var multiselect=$('#multiname').val();
		
		for ( i=0; i<multiselect.length; i++){
			
				 id=multiselect[i];
				 email=$('#email'+id).val();
				 name=$('#name'+id).val();
				 
				
				mailsending(name,email,message,id,token);
	
				
			
		}
	
		
	});
	
	
	//send single mail
	$('#sendmail').click(function(){
	
		
		var name=  $('#name').val();
	var email= $('#email').val();
	var message=$('#message').val();
	if(message==""){
		return toastr.error('Message field empty');
	}
	
	var id=$('#id').val();
	var token=$('#token').val();
		
	mailsending(name,email,message,id,token);
		
		
		
	});
	
	
	
	 $("#carousel").pdfSlider();
	 
	  $(".pdfSlider_thumbsContainer").clone().appendTo("#headcont");
	$('.pdfSlider_next').html('<i style="padding:3px 0px 0 10px;" class="fa fa-angle-right  fa-3x"></i>');
	$('.pdfSlider_prev').html('<i style="padding:3px 0 0 10px;" class="fa fa-angle-left  fa-3x"></i>');
			$('#decide').change(function(){
		//	alert('dfdfe');
	    var valuearr=$('.appid:checked').map(function() {return this.value;}).get();
	    console.log(valuearr);
		var i=0;
		//$.each(valuearr,function(index,element){
		
				var token=$('#token').val();
				
			for( i=0; i<valuearr.length; i++){
				
				 empid=valuearr[i];
				 email=$('#email'+valuearr[i]).val();
				 name=$('#name'+valuearr[i]).val();
				job=$('#job'+valuearr[i]).val();
				 email=$('#email'+valuearr[i]).val();
				decision=$('#decide').val();
				
				decide(empid,decision,email,name,job,token);
			
			}
		});
	
	
	$('#checkall').click(function(){

	$('input:checkbox').prop('checked',this.checked);



}); 
	$('#sortjob').change(function(){
	
	
	var jobtype=$('#sortjob').val();
	if(jobtype=='p'||jobtype=='r'||jobtype=='a'){
	window.location='<?php echo e(url('applicant')); ?>/job?id=<?php echo e(session('jobid')); ?>'+'&type='+jobtype;
		return;
	}
	window.location='<?php echo e(url('applicant')); ?>/job?id='+jobtype;
	
	
});
	
 $('#sortjob').select2();
 $('#decide').select2();
 
 


	 $('#multiname').multiSelect();
});


</script>
<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="token" />
	
<div class="page bg-white" id="hidepage">
	<div class="page-aside">
		<!-- Contacts Sidebar -->
		<div class="page-aside-switch">
			<i class="icon wb-chevron-left" aria-hidden="true"></i>
			<i class="icon wb-chevron-right" aria-hidden="true"></i>
		</div>
		<div class="page-aside-inner page-aside-scroll">
			<div data-role="container">
				<div data-role="content">
				
					<div class="page-aside-section">
						<div class="list-group">
							<a class="list-group-item" href="javascript:void(0)">
								<span class="item-right"><?php echo e(count($applicants)); ?></span><i class="icon wb-inbox" aria-hidden="true"></i>All Applicant(s)
							</a>
							<a data-toggle="modal" data-target="#docload" class="list-group-item" onclick="docview()" href="javascript:void(0)" >
								<i class="icon wb-inbox" aria-hidden="true"></i>Document View Mode
							</a>
							<a  onclick="mailcond(1)" class="list-group-item"  data-toggle="modal" data-target="#mailapps" href="javascript:void(0)" >
								<i class="icon wb-envelope" aria-hidden="true"></i>Mass Mailing
							</a>
							</div>
							<div class="list-group" style="margin:0px 20px 0 20px;">
							<select id="sortjob"   data-plugin="select2" onclick="sort()" class="form-control" >
			
				<option >-Sort Criteria-</option>
				<option disabled>-<?php echo e(strtoupper('Job Title')); ?>-</option>
				<?php if(count($availablejobs)>0): ?>
				<?php $__currentLoopData = $availablejobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobs): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			    <option value="<?php echo e($jobs->id); ?>"><?php echo e(strtoupper($jobs->title)); ?></option>
			    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				<?php endif; ?>
				
				<option disabled>-STATUS-</option>
				<option value="p">Pending</option>
				<option value="a">Approved</option>
				<option value="r">Rejected</option>
				</select>
						
                
						</div>
						
						<div class="list-group" style="margin:10px 20px 0 20px;">
							<select id="decide"   data-plugin="select2" onclick="sort()" class="form-control" >
			
				<option  disabled>-Bulk Action-</option>
				<option value="1">Approved Selected</option>
				<option value="2">Rejected Selected</option>
				</select>
						
                
						</div>
						
						<div class="list-group" style="margin:10px 20px 0 20px;">
							Score:<div class="input-group  ">
                    <span class="input-group-addon">
                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                    </span>
                    <input type="number" min="0" class="form-control" id="startscore" placeholder="from" >
                 
                    <span class="input-group-addon">
                      <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                    </span>
                    <input type="number" min="0" placeholder="to" class="form-control" id="endscore" >
                  </div>
                
						</div>
						<div class="list-group" style="margin:10px 20px 0 20px;">
						<button class="btn btn-outline btn-danger" onclick="scorerange()">Go</button></div>
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
				
					<div class="input-search input-search-dark">
						<i class="input-search-icon wb-search" aria-hidden="true"></i>
						<input type="text" class="form-control" name="q" id="searchfield" onkeyup="search($(this).val())" placeholder="Search: Employee name...">
					</div>
				
			</div>
		</div>
		<!-- Employee Table Content -->
		<div id="contactsContent" class="page-content page-content-table" data-plugin="asSelectable">
			<!-- Actions -->
			<div class="page-content-actions">
			</div>
			<!-- Employees Table -->
			<table class="table table-condensed" id="directempstable">
				<thead class="thead-default">
					<tr>
						<th><input type="checkbox"  id="checkall" ></th>
						<th>FULLNAME</th>
						<th>APPLIED FOR</th>
						<th>STATUS</th>
						<th>SCORE</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody id="directempsbody">
				<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="token" />
					<?php if(count($applicants) > 0): ?>
						
					<?php $__currentLoopData = $applicants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<td >
<?php  $job=app('App\Repositories\EmployeeRepository')->getappdetail($emp->job_app_id) ?>
						<input type="checkbox"  class="appid" name="appid[]" value="<?php echo e($emp->id); ?>" >
						
					
						<input type="hidden"   id="email<?php echo e($emp->id); ?>" value="<?php echo e($emp->email); ?>" >
						<input type="hidden"   id="name<?php echo e($emp->id); ?>" value="<?php echo e($emp->name); ?>" >
						<input type="hidden"   id="job<?php echo e($emp->id); ?>" value="<?php echo e($job); ?>" >
						
						</td>
						<td height="10">
							<img  class="img-circle img-bordered img-bordered-primary" alt="avatar" src="<?php echo e(asset('upload')); ?>/<?php echo e($emp->image); ?>" style="margin-left:5px; align:center; width: 50px;height: 50px;" /><br>
							<?php echo e($emp->name); ?>

						</td>
						
						
						<td height="10"><?php echo e($job); ?></td>
						
						<td id="stat<?php echo e($emp->id); ?>"><?php if($emp->status==0): ?> <span class="tag tag-warning">Pending </span> <?php elseif($emp->status==1): ?> <span class="tag tag-success">Approved </span><?php else: ?> <span class="tag tag-danger">Rejected </span> <?php endif; ?></td>
						<td> <p style="margin:0 20px 0 20px;"><?php echo e(app('App\Repositories\EmployeeRepository')->getscore($emp->id,$emp->job_app_id)); ?></p> </td>
						<td height="10">
						<div class="btn-group" role="group">
						<div class="btn-group" role="group">
                      <button type="button" title="View Document" class="btn btn-icon btn-default dropdown-toggle btn-outline" id="exampleGroupDrop1" data-toggle="dropdown" aria-expanded="false">
                        <i class="icon wb-file" aria-hidden="true"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="exampleGroupDrop1" role="menu">
					  <?php $docs=app('App\Repositories\EmployeeRepository')->getdoc($emp->id); ?>
					  <?php if(count($docs)>0): ?>
						<?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <a data-toggle="modal" onclick="urlChange('<?php echo e(url('upload')); ?>/<?php echo e($doc->document); ?>')" data-target="#loaddiff" class="dropdown-item" href="javascript:void(0)" style="text-decoration:none;" role="menuitem"><?php echo e($doc->docname); ?></a>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					   <?php endif; ?>
                      </div>
                    </div>
                     
                      <button onclick="decide('<?php echo e($emp->id); ?>',1,'<?php echo e($emp->email); ?>','<?php echo e($emp->name); ?>','<?php echo e($job); ?>')"  type="button" title="Accept" class="btn btn-icon btn-default btn-outline"><i class="icon  wb-check" aria-hidden="true"></i></button>
					  
                      <button onclick="decide('<?php echo e($emp->id); ?>',2,'<?php echo e($emp->email); ?>','<?php echo e($emp->name); ?>','<?php echo e($job); ?>')" type="button" title="Reject" class="btn btn-icon btn-default btn-outline"><i class="icon  wb-close" aria-hidden="true"></i></button>
                      <button "urlChange('<?php echo e(url('profile')); ?>/<?php echo e($emp->id); ?>')" type="button" title="View Profile" class="btn btn-icon btn-default btn-outline"><i class="icon  wb-eye" aria-hidden="true"></i></button>
					  <button onclick="mail('<?php echo e($emp->email); ?>','<?php echo e($emp->name); ?>','$emp->id')" type="button" title="Mail <?php echo e($emp->name); ?>" class="btn btn-icon btn-default btn-outline" data-toggle="modal" data-target="#mailapps"><i class="icon  wb-envelope" aria-hidden="true"></i></button>
                    </div>
							<!--<button style="padding:10px;" type="button" class="btn btn-outline btn-icon btn-warning btn-sm" title="View Request" data-target="#viewcomment<?php echo e($emp->id); ?>" onclick="hide('<?php echo e($emp->id); ?>','<?php echo e($emp->email); ?>')" data-toggle="modal" >
								<i class="icon wb-eye" aria-hidden="true"></i> 
							</button>-->
							
						</td>
						
						<!--VIEW REQUEST -->
					
						
						<!-- mmm-->
						
						
						
						<!--END VIEW REQUEST -->
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<th colspan="5"><?php echo e($applicants->render()); ?></th>
					</tr>
					<?php else: ?>
					<tr>
						<th colspan="5">
							<h3>No Applicant Yet.</h3>
						</th>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>

</div>

<!-- Load diferent document  -->
 <div id="loaddiff" class="modal fade" role="dialog">
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

<!-- MAIL APPLICANT FORM  -->
<div  class="modal fade modal-3d-slit" id="mailapps" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title appname">  </h4>
                        </div>
                        <div class="modal-body">
                          <!-- Some Form -->
						  <form>
                            <div class="row">
                              <div class="col-xs-12 col-xl-12 form-group">
                                <input type="text" id="name" class="form-control" name="firstName" placeholder="">
								<input type="hidden" id="id" class="form-control"  placeholder="">
                              </div> 
								
							  <div style="margin-left:60px;" class="col-xs-12 col-xl-12 form-group hide" id="selectmulitple" >
							  
							   <select id="multiname" name="emails[]"  multiple class="form-control "   >
							  	
								<?php if(count($applicants) > 0): ?>
								
							    <?php $__currentLoopData = $applicants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                               
								<option value="<?php echo e($emp->id); ?>"><?php echo e($emp->name); ?></option>
								
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								<?php endif; ?>
								
								</select>
								<br>
								<button class="btn btn-primary btn-outline" onclick="selectall(1)" id="selec" type="button">select all</button>
								<button class="btn btn-primary btn-outline" id="uselectall" onclick="selectall(0)" type="button">deselect all</button>
                              </div>
                              
                              <div class="col-xs-12 col-xl-12 form-group">
                                <input type="email" id="email" class="form-control" name="email" placeholder="Your Email">
                              </div>
                              <div class="col-xl-12 col-xs-12">
                                <textarea id="message" class="form-control" rows="5" placeholder="Type your message"></textarea>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
						  <button type="button" id="sendmail"  class="btn btn-primary" ><i class="fa fa-circle-o-notch fa-spin fa-fw hidespin"></i><i class="wb-envelope mailico" ></i>&nbsp;&nbsp;Send Mail</button>
						  
						    <button type="button" id="sendmailmult"  class="btn btn-primary" ><i class="fa fa-circle-o-notch fa-spin fa-fw hidespin"></i><i class="wb-envelope mailico" ></i>&nbsp;&nbsp;Send Mail</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  
				  
<!-- DOCUMENT LOAD -->
 <div id="docload" class="modal fade modal-rotate-from-left"  role="dialog">
   <div class="modal-dialog">

    <!-- Modal content -->
    <div class="modal-content modal-lg " style="margin-left:-15%; height:700px; width:1000px;">
     <div class="modal-header">
	 </div>
 <div class="modal-body " >
 <div id="carousel" >
	    <?php if(count($applicants) > 0): ?>
						
 
 
      
    
<?php $__currentLoopData = $applicants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
      <?php $docs=app('App\Repositories\EmployeeRepository')->getdoc($emp->id); ?>
					  <?php if(count($docs)>0): ?>
						<?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					
					 <object style="width:900px;" data="<?php echo e(url('upload')); ?>/<?php echo e($doc->document); ?>" type="application/pdf" data-caption="<?php echo e($emp->name); ?>"></object>
                        
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					   <?php endif; ?> 
					   <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>					   
					  
   



 
   <?php endif; ?> 
   </div>
    </div>
    </div>
  </div> 

     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  </div>
     


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>