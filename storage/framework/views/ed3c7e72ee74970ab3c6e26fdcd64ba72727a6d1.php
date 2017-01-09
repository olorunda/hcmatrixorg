<?php $__env->startSection('content'); ?>
<script>
$(function (){
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

});
$(function(){
							  $('#savefolder').click(function(){
								
								$.get('<?php echo e(url('savefolder?name=')); ?>'+$('#foldername').val(),function(data,status,xhr){
									if(xhr.status==200){
										
										toastr.success("Folder Created Successfully");
										
										setTimeout(function(){
											
											window.location.reload();
										},2000);
										return ;
									}
									else {
										toastr.error("Some Error Occurred");
									}
									
								});
								  
								  
							  });
							  
							  
						  });
						  

</script>

<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="token" />
<div class="page-header">
  <h1 class="page-title">My Document</h1>
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
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white">
                  <i class="icon icon-circle icon-2x wb-clipboard bg-red-600" aria-hidden="true"></i>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number"><?php echo e($foldercount); ?></span>
                    <span class="counter-number-related text-capitalize">Folders</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">available</div>
                </div>
              </div>
              <!-- End Card -->
            </div>
			<div class="col-lg-6 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white">
                  <i class="icon icon-circle icon-2x wb-clipboard bg-red-600" aria-hidden="true"></i>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number"><?php echo e($docucount); ?></span>
                    <span class="counter-number-related text-capitalize">Documents</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">Uploaded</div>
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
	<div class="col-lg-12">		 
<div class="panel panel-success panel-line">
            <div class="panel-heading">
              <h3 class="panel-title">All Folders
			  <?php  session(['type'=>'me']) ?>
			   <div class="col-md-4 pull-right">
			  <form method="get"  action="<?php echo e(url('searchdoc')); ?>">
                    <input type="hidden" name="foldid"  value="gen">
                    
                  <div class="input-group ">
				  
                    <input required type="text" name="q" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-default btn-outline" onclick="searchq()" id="searchbtn">Search</button>
                    </span>
					
					
                  </div>
				  </form></div></h3>
			  	
				  <div class="col-md-12"></div>
            </div>
            <div class="panel-body">
			 
			<div>
     <?php if(count($allfolder)>0): ?>
		 <?php $__currentLoopData = $allfolder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    <div class = "raspberry col-md-2">
      <a href="<?php echo e(url('view')); ?>/document?foldid=<?php echo e($folder->id); ?>&foldername=<?php echo e($folder->name); ?>&type=me"> <img src="<?php echo e(asset('upload/empfol.png')); ?>"/>
			<?php $name= str_replace(' ','&lt;br/&gt;',$folder->name); ?>
        <p><?php echo htmlspecialchars_decode($name); ?></p></a>
    </div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	<?php echo $allfolder->render(); ?>

	<?php else: ?>
		
	<div class="alert alert-info">
	<h3>No Folder Found, Click on the Plus Button at the buttom of this page to add folder</h3>
	
	</div>
	<?php endif; ?>
</div>
<?php if(Auth::user()->role==3): ?>
		<div class="site-action" data-plugin="actionBtn">
    <button type="button" data-toggle="modal" data-target="#addfolder" class="site-action-toggle btn-raised btn btn-success btn-floating">
      <i class="front-icon wb-plus animation-scale-up" aria-hidden="true"></i>
      <i class="back-icon wb-close animation-scale-up" aria-hidden="true"></i>
    </button>
  </div>
<?php endif; ?>
  </div>
          </div>
		  </div>
		 
		  <div class="modal fade modal-success in" id="addfolder" aria-labelledby="exampleModalSuccess" role="dialog" tabindex="-1" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Add Folder</h4>
                        </div>
                        <div class="modal-body">
                           Folder Name : </br>
						  <input type='text' class="form-control" id="foldername" />
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="savefolder" class="btn btn-primary">Save changes</button>
						  <script>
						  
						  </script>
                        </div>
                      </div>
                    </div> 
                  </div>
				  
				 
		  
		  
		  
		  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>