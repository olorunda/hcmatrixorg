	<?php 
	if(isset($_GET['job_id'])):
		$jobid=$_GET['job_id'];
			else:
		$jobid="Not Available";	
	endif;
	$checktesttake=app('App\Repositories\JobRepository')->checktexttake($jobid); 
	$getscore=app('App\Repositories\JobRepository')->gettestscore($jobid); 
	if($getscore==""){
		$getscore=0;
	}

	?>
	
	<script>
	function complete(){
		$.get('<?php echo e(url('completed')); ?>?jobid=<?php echo e($_GET['job_id']); ?>',function(data,status,xhr){
			sessionStorage.setItem('completecall',1);
			if(data=="success"){
				window.location.reload();
			}
			
		});
	}
	
	function countdownComplete(unit, value, total){
    if(total<=0){
		
        $(this).fadeOut('slow').replaceWith("<h4>Time's Up!</h4>");
		alert('Time Up');
		submitanswer();
		complete();
    }
}


function loadtimer(){
	
	
		 
		 $.get('<?php echo e(url('timer')); ?>',function(data,status,xhr){
			
	   $( "#refreshclock" ).html(data);			
			$("#timer").TimeCircles({count_past_zero: false, time: { 
	 Days: { show: false }, 
	 Hours: { show: false }

	 }

	 }).addListener(countdownComplete); 
			 
		 });
		 
}
 $(function(){
	 
	  if(sessionStorage.getItem('count')<1 || sessionStorage.getItem('count')==""|| sessionStorage.getItem('count')==null){
	sessionStorage.setItem('count',0);
	 }
	 	  
		 
	 <?php if(session()->has('on')|| session('on')==1): ?>
		 loadtimer();
	 $('#testmodal').modal({backdrop:'static',keyboard:false}
		 );
	
	 <?php endif; ?>
	 
	 
	 $('#ref').click(function(){
		
	loadtimer();
		 	 
		
});
		 


	 $("#timer").TimeCircles({count_past_zero: false, time: { 
	 Days: { show: false }, 
	 Hours: { show: false }

	 }

	 }).addListener(countdownComplete);
	
	 sessionStorage.setItem('completecall',0);


		if( sessionStorage.getItem('count')!=0){
	getquestion(sessionStorage.getItem('count'));
	}
	else{
		 getquestion(0);
	}
	
 
	 $(window).on('beforeunload',function(){
		 
		 
		 
		$.get('<?php echo e(url('seton')); ?>',function(data,status,xhr){

	
	});
	
	
 
	//return 'If you Reload This page your test would start again';
	
});
	 

	
	

	 
	 //submit
	 $('#submit').click(function(){
		 
		 submitanswer();
		complete();	
	});
	 
	$(document).ajaxStart(function(){
		
		NProgress.start();
	}).ajaxStop(function(){
		
		NProgress.done();
		
	});

	if(sessionStorage.getItem('count')==sessionStorage.getItem('max')){
		 $('#next').hide();
	 
	}

	
	//getquestioncount
	$.get('<?php echo e(url('count')); ?>',function(data,status,xhr){

	if((Math.ceil(data/1))-1==0){
		
	 $('#next').hide();		
	}
	

	sessionStorage.setItem('max',data-1);
	
	
	});	
	
	
	//next button
	$('#next').click(function(){
		
 submitanswer();
	

	//submit answer when user click next

	
	max=sessionStorage.getItem('max');
		
	
	
	var counter= sessionStorage.getItem('count');
	counter++;
	  sessionStorage.setItem('count',counter);
	
	getquestion(counter);
	if(	sessionStorage.getItem('count')==max){
		 $('#next').hide();
	 
	}
	});
	 
	 
 });
 
 function getquestion(num){	
	 if(num==0){
		 num=0;
	 }
	 else{
		 num=num*1;
	 }
		$.get('<?php echo e(url('taketest')); ?>/'+num,function(data,status,xhr){
		console.log(data);
			if(data=='Unauthorized.'){
				window.location.reload();
			return ;
		}
				$('#displayquestion').html("");
			
				
		
		
		$.each(data,function(index,element){
		
		
		
			$('#displayquestion').append(
			'<br><br><input type="hidden" id="questid" value="'+element.question_id+ '"><div class="col-md-12"><b>&nbsp;&nbsp;&nbsp;&nbsp;'
				+ element.content+
				'</b></div><div class="col-md-12" style="padding-top:10px; padding-left:33px;">'+
				'<input type="radio"  name="option" id="option'+element.question_id+'" value="1" style="float:left;" ><div class="col-md-4">'
				+ element.option1+
				'</div></div>'+
				'</div><div class="col-md-12"  style="padding-top:10px; padding-left:33px;">'+
				'<input type="radio" name="option" id="option'+element.question_id+'" value="2" style="float:left;" ><div class="col-md-4">'
				+ element.option2+
				'</div></div>'+
				'</div><div class="col-md-12"  style="padding-top:10px; padding-left:33px;">'+
				'<input type="radio" name="option" id="option'+element.question_id+'" value="3" style="float:left;" ><div class="col-md-4">'
				+ element.option3+
				'</div></div>'+
				'</div><div class="col-md-12"  style="padding-top:10px; padding-left:33px;">'+
				'<input type="radio"  id="option" value="4" name="option'+element.question_id+'" style="float:left;" ><div class="col-md-4">'
				+element.option4+
				'</div></div><br><div class="col-md-12" style="padding-bottom:20px;"></div>');
			
			
		});
		
});
	 }
	 
	 function submitanswer(){
		 
		
		 
		 var questid=$('#questid').val();
		 var selectedoption=$('input[name=option]:checked').val();
		 submitstudentanswer(questid,selectedoption);
		 
		 
	 }
	 
	 
	 function submitstudentanswer(questionid,selectedoption){
		
		var userid=$('#userid').val();
  
	
	$.get('<?php echo e(url('applicant')); ?>/submittest/'+userid+'/'+questionid+'/'+selectedoption+'/<?php echo e($jobid); ?>',function(data,status,xhr){
		
		
		if(data=='expired'){
			
			complete();
			
			return ;
		}
		
		if(data=='failure'){
			
		 swal("Error", "Some Unknow error occured :)", "error"); 
		}
		
	
		
	});
		
		
	}
	
	
	
	</script>
<div id="testmodal" class="modal fade modal-3d-sign" role="dialog">
  <div class="modal-dialog modal-lg modal-warning ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
       <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title">	<?php if($checktesttake==0): ?>	
				
			<b>Apptitude Test</b>

			 <?php else: ?>
			<b>CBT Test Result  </b>
			<?php endif; ?></h4>
      </div>
    
	<div class="container-fluid"  >
	<?php if($checktesttake==0): ?>	
		<div id="refreshclock">
			

			</div><!-- <button style=" margin:0 0 0 45%;" id="ref" class="btn btn-success"><i class="fa fa-refresh"></i>Refresh Timer</button><br>--> <?php endif; ?>
	<div class="row" style="">
		
			<div class="panel panel-bordered" >
				<div class="panel-heading">
		
				
				</div>
				<div class="panel-body" >
				<?php if($checktesttake==1): ?>
					
				<h4><b>Your Score is :<?php echo e($getscore); ?></b></h4>
			
				
				<?php else: ?>
				<div id="displayquestion">
				
				</div>
				<input type="hidden" value="<?php echo e(Auth::user()->id); ?>" id="userid">
					<button style="margin:0 0 0 15px;" class="btn btn-danger btn-md pull-right" id="submit"	title="next" >Submit</button>
					<button class="btn btn-success btn-md pull-right" id="next"	title="next" >Next</button>
				&nbsp;&nbsp;
				<?php endif; ?>
				</div>
			</div>
		
	</div>
</div>
	  </div>
    </div>

     </div>
  
  </div>
