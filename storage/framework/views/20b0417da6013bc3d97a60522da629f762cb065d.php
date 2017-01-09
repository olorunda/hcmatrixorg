<?php $__env->startSection('content'); ?>
<script>
$(function(){
	
	
	  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

 
	
});
	//set read
	function  setread(qid){

	$('#brand'+qid).hide();
	$.get('<?php echo e(url('setreadquery')); ?>?qid='+qid,function(data,status,xhr){
		if(xhr.status==200){
		
		}
	});
	
	}
	
function reply(){
	var email=sessionStorage.getItem('email');
	var comment=$('#comment').val();
	var id=sessionStorage.getItem('id');
	var title=sessionStorage.getItem('title');
	$.get('<?php echo e(url('replyquery')); ?>?comment='+comment+'&id='+id+'&email='+email+'&title='+title+'&empid=<?php echo e(Auth::user()->id); ?>',function(data,status,xhr){
		
		if(xhr.status==200){
			
			$('#threadbody').append('<div class="comment media"> <div class="media-left"> <a class="avatar avatar-lg" href="javascript:void(0)"> <img src="<?php echo e(url('upload')); ?>/<?php echo e(Auth::user()->image); ?>" alt="..."> </a></div> <div class="comment-body media-body"> <a class="comment-author" href="javascript:void(0)">You @ Now</a> <div class="comment-content">  <p>'+comment+'</p> </div>   </div></div><hr>');
			
			toastr.success('Query Reply Sent');
			
		}
		else{
			toastr.error('Some Error Occurred');
		}
		
		
	});
	
	
}

function setparam(title,email,id){
	
	sessionStorage.setItem('email',email);
	sessionStorage.setItem('id',id);
	sessionStorage.setItem('title',title);
	$('#qtype').html(title);
}
</script>
<div class="">
<div class="page-header">
  <h1 class="page-title">My Queries</h1>
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
          <span class="counter-number font-weight-medium" id="time"></span>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
<?php if(count($query)>0): ?>
			<?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $queries): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	 <?php  $gettemplate=app('App\Repositories\EmployeeRepository')->querytypes($queries->query_type_id);?>
	    
					<?php if(isset($gettemplate['title'])): ?>
							
							<?php  $title=$gettemplate['title']; ?>
						<?php else: ?>
							<?php $title="Others"; ?>
						<?php endif; ?>
						
                  <div class="panel">
				 
                    <div class="panel-heading" id="exampleHeadingDefaultOne" role="tab">
					<div class="ribbon ribbon-clip">
                        <span class="ribbon-inner"><?php echo e($queries->created_at->diffForHumans()); ?></span>
                      </div>
					  
			  <?php $userid=app('App\Repositories\EmployeeRepository')->getuserdetails($queries->lm_id); ?>
					 <div class="ribbon ribbon-clip ribbon-reverse ribbon-primary">
                        <span class="ribbon-inner" onclick="setparam('<?php echo e($title); ?>','<?php echo e($userid['email']); ?>','<?php echo e($queries->id); ?>')" data-target="#exampleNiftySuperScaled" data-toggle="modal" style="cursor:pointer"><i class="wb wb-message"></i>Reply Query</span>
                      </div><br><br>
                      <a onclick="setread('<?php echo e($queries->id); ?>')"  class="panel-title" data-toggle="collapse" href="#exampleCollapseDefaultOne<?php echo e($queries->id); ?>" data-parent="#exampleAccordionDefault" aria-expanded="true" aria-controls="exampleCollapseDefaultOne<?php echo e($queries->id); ?>">
                  
						<b><?php echo e($title); ?> <?php if($queries->empnew==1): ?> <span id="brand<?php echo e($queries->id); ?>" class="tag tag-warning">New</span> <?php endif; ?></b>
					
                    </a>
                    </div>
					
                    <div class="panel-collapse collapse" id="exampleCollapseDefaultOne<?php echo e($queries->id); ?>" aria-labelledby="exampleHeadingDefaultOne" role="tabpanel" aria-expanded="true">
                      <div class="panel-body">
                      <?php if($title=="Others"): ?>
						<?php	$queryt=$queries->document;  ?>
					<img src="<?php echo e(url('storage')); ?>/<?php echo e($queryt); ?>" />
						<?php else: ?>
						<?php	$queryt=$queries->content;  ?>	
						<?php echo e($queries->content); ?>

						<?php endif; ?>
						<hr>
		<?php $comments=app('App\Repositories\EmployeeRepository')->querythread($queries->id,1); ?>
		<div id="threadbody" >
		<?php if(count($comments)>0): ?>
			 
				<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			  <?php
				if(Auth::user()->id==$queries->user_id){
				$userid=$queries->user_id;	
					
				}
				else{
					
					$userid=$queries->lm_id;
				}

			  $userid=app('App\Repositories\EmployeeRepository')->getuserdetails($comment->emp_id); ?>
			   
						<div class="comment media"> <div class="media-left"> <a class="avatar avatar-lg" href="javascript:void(0)"> <img src="<?php echo e(url('upload')); ?>/<?php echo e($userid['image']); ?>" alt="..."> </a></div> <div class="comment-body media-body"> <a class="comment-author" href="javascript:void(0)"><?php if($comment->emp_id==Auth::user()->id): ?>
							You @ <?php echo e($comment->created_at->diffForHumans()); ?>

						<?php else: ?>
						<?php echo e($userid['name']); ?> @ <?php echo e($comment->created_at->diffForHumans()); ?>

						<?php endif; ?>
						</a> <div class="comment-content">  <p><?php echo e($comment->comment); ?></p> </div>   </div></div><hr>
						
						
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						<?php endif; ?>
						</div>
                      </div>
                    </div>
                  </div>
				  
				  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				  <?php else: ?>
					  <div class="panel">
				 
                    <div class="panel-heading" >
					<h3 class="text-success center-block" style="text-align:center"> Hurray!! , No query Issued Yet.</h3>
				
					</div>
					</div>
				
				  
				  <?php endif; ?>
                  </div>
                  </div>
				  <div class="modal fade modal-super-scaled" id="exampleNiftySuperScaled" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Reply to <span id="qtype"></span> Query </h4>
                        </div>
                        <div class="modal-body">
                          <p>
						 
						  <textarea data-provide="markdown" data-iconlibrary="fa" data-width="" class="md-input" rows="5" id="comment" placeholder="Enter Query Reply Here" class="form-control">
						  
						  </textarea></p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" onclick="reply()" class="btn btn-primary">Reply</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  
				  
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>