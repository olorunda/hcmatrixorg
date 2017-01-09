<?php $__env->startSection('content'); ?>
<script>
$(function (){
	
	
	


	/**
	TEST Settings
	**/
			$('#savetestsett').click(function(){
							
							var duration=$('#testduration').val();
							var quesnum=$('#quesnum').val();
							
							$.get('<?php echo e(url('test/setting')); ?>?duration='+duration+'&quesnum='+quesnum,function(data,status,xhr){
								
								if(xhr.status==200){
									
									toastr.success('Settings saved successfully');
									return ;
							}
								toastr.error('Some error Occurred:'+data);
							})
						});
						
	
		/**
	*
	*IMPORT question
	*
	*
	***/
	var myDropzone = new Dropzone("div#my-dropzone-files", { 
	
	url: "<?php echo e(url('import/question')); ?>",
	maxFilesize: 1,
	parallelUploads:1,
	acceptedFiles:'.csv',
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
	   
			
		   toastr.success('Import Successfull'+response);
	  	 myDropzone.removeFile(file);
		 
		 	setTimeout(function(){
	
		        window.location.reload();
				},2000);
		 
  
   });
   
    myDropzone.on("error", function(file,response) {
                   // sessionStorage.setItem("error", 1);
                   // $("#disp").html(response);
                  toastr.error('Some error Occurred:'+response);
				 myDropzone.removeFile(file);
                });
   
	//jhdhdh
  $('#importquestion').click(function(){
	
	myDropzone.processQueue();
	 
	 });

	
	/**
	*
	*IMPORT Question ENDS
	*
	*
	***/

	
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

});

//delete question
function deletequest(quesid){
	swal({   title: "Are you sure?", 
          	text: "You will not be able to recover this question!", 
			type: "warning", 
			showCancelButton: true,  
			confirmButtonColor: "#DD6B55", 
			confirmButtonText: "Yes, delete it!", 
			closeOnConfirm: false }, 
			function(){  
			$.get('/deletequestion/'+quesid,function(data,status,xhr){
		if(xhr.status==200){
			
			swal("Deleted!", "Question Successully Deleted", "success"); 
		   
				toastr.success("Question Successully Deleted"); 
				
				setTimeout(function(){
	
		        window.location.reload();
				},2000);
		}
		else{
			swal("Error", "Unable to delete question at the moment", "error"); 
				toastr.error("Unable to delete question at the moment"); 
		
		}
		
		
	       });
	
			
			});
	
       }


function modified(id){
	
	//alert(id);
	//event.preventDefault;
 var question=$('#question'+id).val();	
 var option1=$('#option1'+id).val();	
 var option2=$('#option2'+id).val();	
 var option3=$('#option3'+id).val();	
 var option4=$('#option4'+id).val();	

 var correct=$('#correct'+id).val();	
 var token=$('#token').val();
 
 $.post('<?php echo e(url('updatequestion')); ?>',{
	 question:question,
	 option1:option1,
	 option2:option2,
	 option3:option3,
	 id:id,
	 option4:option4,
	 answer:correct,
	 _token:token
	 
	 
	 
 },function(data,status,xhr){
	 
	if(xhr.status==200){
		
		if(data==0){
			return toastr.success("No Changes Made");
		}
	toastr.success("Question Succewssfully Modified");
	
	setTimeout(function(){
		
		 window.location.reload();
	},2000);
	}
	else{
		
		toastr.error("Soeme Error Occurred:"+data);
	}
	
	
	
 });
	
	
	
}

</script>
<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="token" />
<div class="page-header">
  <h1 class="page-title">Apptitude Test Settings</h1>
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
<?php if(count($questions)>0): ?>
	<?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<div class="panel" style="margin-bottom: 4px;">
  <div class="panel-body">
   <div class="ribbon ribbon-clip ribbon-reverse ribbon-success">
    <span style="cursor:pointer"  class="ribbon-inner" title="Apply"  data-target="#myModal<?php echo e($question->id); ?>" data-toggle="modal">
	Modify Question
    </span>
  </div>
  <div  class="ribbon ribbon-clip ribbon-danger">
     <span style="cursor:pointer" onclick="deletequest('<?php echo e($question->question_id); ?>')" class="ribbon-inner" >Delete Question</span>
  </div>
    <div class="panel-group panel-group-simple" id="siteMegaAccordion" aria-multiselectable="true" role="tablist">
      <div class="panel">
        <div class="panel-heading" id="siteMegaAccordionHeadingThree" role="tab">
          <a class="panel-title" data-toggle="collapse" href="#siteMegaCollapseThree<?php echo e($question->id); ?>" data-parent="#siteMegaAccordion" aria-expanded="false" aria-controls="siteMegaCollapseThree<?php echo e($question->id); ?>">
            <h4 class="text-warning">Question <?php echo e($question->id); ?></h4>
            <span class="text-default">
			<?php echo e($question->content); ?>

            </span>
          </a>
        </div>
		
        <div class="panel-collapse collapse" id="siteMegaCollapseThree<?php echo e($question->id); ?>" aria-labelledby="siteMegaAccordionHeadingThree" role="tabpanel">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12 col-xs-12">
                
                <ul>
                  <li>
				<span class=" <?php if($question->correctoption==1): ?> text-success <?php endif; ?>">1) <?php echo e($question->option1); ?></span>
                  </li>
                </ul>
              </div>
              <div class="col-md-12 col-xs-12">
               
                <ul>
                  <li>
				  <span class=" <?php if($question->correctoption==2): ?> text-success <?php endif; ?>">2) <?php echo e($question->option2); ?></span>
                  </li>
                  
                </ul>
              </div>
              <div class="col-md-12 col-xs-12">
               
                <ul>
                  <li>
                  <span class=" <?php if($question->correctoption==3): ?> text-success <?php endif; ?>"> 3) <?php echo e($question->option3); ?> </span>
                  </li>
                </ul>
              </div>
              <div class="col-md-12 col-xs-12">
            
                <ul>
                  <li><span class=" <?php if($question->correctoption==4): ?> text-success <?php endif; ?>">4) <?php echo e($question->option4); ?>

				  </span>
				  </li>
                </ul>
              </div>
           
              </div>
          </div>
        </div>
      </div>
	 
	
	
    </div>
  </div>
</div>
 <div id="myModal<?php echo e($question->id); ?>" class="modal modal-success fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Edit Question</h3>
      </div>
      <div class="modal-body">
        <div >
		<h4>Question</h4>
		
	
		    <textarea  data-provide="markdown" data-iconlibrary="fa" data-height="400px" class="md-input" rows="5"  style=""  id="question<?php echo e($question->question_id); ?>" ><?php echo e($question->content); ?>

									</textarea>
		<br>
		<br>
		<div class="col-md-3">Option One</div>
		<div class="col-md-9"><input type="text" class="form-control" id="option1<?php echo e($question->question_id); ?>" value="<?php echo e($question->option1); ?>"  /></div>
		<br>
		<br>
		<div class="col-md-3">Option Two</div>
		<div class="col-md-9">
		<input type="text" class="form-control" id="option2<?php echo e($question->question_id); ?>" value="<?php echo e($question->option2); ?>"  />
		</div>
		<br>
		<br>
		<div class="col-md-3">Option Three</div>
		<div class="col-md-9">
		<input type="text" class="form-control" id="option3<?php echo e($question->question_id); ?>" value="<?php echo e($question->option3); ?>"  />
		</div>
		<br>
		<br>
		<div class="col-md-3">Option Four</div>
		<div class="col-md-9">
		<input type="text" class="form-control" id="option4<?php echo e($question->question_id); ?>"  value="<?php echo e($question->option4); ?>"  />
		</div>
		<br>
		<br>
		<div class="col-md-3">Correct Option</div>
		<div class="col-md-9">
		<select name="center"  id="correct<?php echo e($question->question_id); ?>" class="form-control">
		<option value="1">Option 1</option>
		<option value="2">Option 2</option>
		<option value="3">Option 3</option>
		<option value="4">Option 4</option>
		</select>
		</div>
		<br>
		
			</div>
			
      </div>
      <div class="modal-footer">
	  <button class="btn btn-md btn-success"   style="pointer:cursor;" onclick="modified(<?php echo e($question->question_id); ?>)" value="export"><i class="fa fw fa-pencil-square-o"></i>Modify</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<?php else: ?>
	
<span>No Question Found, Click on the Plus Button to add question</span>
<?php endif; ?>
<?php echo e($questions->render()); ?>

<div class="modal fade modal-3d-flip-horizontal modal-success" id="importques" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Upload Apptitude Question</h4>
                        </div>
                        <div class="modal-body">
                         <div class="col-xs-12 col-xl-12 form-group" id="dropboxpane">
							   <b>Upload Apptitude Question:</b><br>
							        <div style="" class="dropzone" id="my-dropzone-files" name="my-dropzone-files">

                                                

                                            </div>
                               
                              </div>
						
						
                        </div>
                        <div class="modal-footer">
                         
                          <a type="button" href="<?php echo e(url('upload/samplequestion.csv')); ?>" class="btn btn-success"><i class="fa fa-download" style="border:none" ></i>&nbsp;&nbsp;Download Template</a> <button type="button" id="importquestion" class="btn btn-primary"><i class="fa fa-upload" ></i>&nbsp;&nbsp;Upload Question</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  <div class="modal fade modal-danger modal-rotate-from-left" id="appsett" aria-labelledby="exampleModalTitle" role="dialog"   style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content" style="z-index:99999999">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Apptitude Test Settings</h4>
                        </div>
                        <div class="modal-body">
                       <?php $mm=app('App\Repositories\GlobalSettingRepository')->appsett(); ?>
						 <p>Duration:</p>
						<input class="form-control" type="number" value="<?php echo e($mm['duration']); ?>" placeholder="Enter Test duration in minute" min="0" id="testduration" />
						<br>
						 <p>Number of Question:</p>
						<input type="number" class="form-control" placeholder="Enter Number of randomly generated question to display to applicants" min="0" value="<?php echo e($mm['dispques']); ?>" id="quesnum"  />
 				
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="savetestsett" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
<!-- FISCAL MODAL ENDS -->
	  <div class="site-action" data-plugin="actionBtn">
	  <button type="button" onclick="showadd()" class="site-action-toggle btn-raised btn btn-success btn-floating pull-left"  data-target="#importques" data-toggle="modal" >
      <i class="front-icon wb-plus animation-scale-up" aria-hidden="true"></i>
      <i class="back-icon wb-close animation-scale-up" aria-hidden="true"></i>
    </button> 
	

	 
		<button type="button" onclick="" class="site-action-toggle btn-raised btn btn-danger btn-floating pull-right"  data-target="#appsett" data-toggle="modal" >
      <i class="front-icon fa fa-cog animation-scale-up" aria-hidden="true"></i>
      <i class="back-icon fa fa-cog animation-scale-up" aria-hidden="true"></i>
    </button>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>