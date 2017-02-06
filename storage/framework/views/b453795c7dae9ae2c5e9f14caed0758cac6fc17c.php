<?php $__env->startSection('content'); ?>
<style>

.ui-timepicker-wrapper{
	z-index:999999999;
}

</style>
<script>
 function createeventd(){ 
 
		subject=$('#subject').val();
		description=$('#description').val();
		//showas=$('#showas').val();
		reminder=$('#reminder').val();
		startdate=$('#startdate').val();
		starttime=$('#starttime').val();
		enddate=$('#enddate').val();
		endtime=$('#endtime').val();
		locations=$('#location').val();
		attendees=$('#attendees').val();
		attendeestype=$('#attendees').val();
		<?php if(Auth::user()->role>1): ?>
		$attopt=$('#attopt').val();
		<?php endif; ?>

		$.get('<?php echo e(url('createvent')); ?>',{
			
		subject:subject,
		description:description,
		startdate:startdate,
		starttime:starttime,
		enddate:enddate,
		endtime:endtime,
		<?php if(Auth::user()->role>1): ?>
		attopt:$attopt,
		<?php endif; ?>
		attendees:attendees,
		location:locations,
		//showas:showas,
		reminder:reminder
		},function(data,status,xhr){
			
			if(xhr.status==200){
				
				toastr.success('Event Successfully Created');
				
				setTimeout(function(){
					
				window.location.reload();
				
				},2000);
				return;
				
			}
			toastr.error('Some Error Occurred');	
		});
		
 
 }
 
$(function (){
	
	
	
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);
 
 $('#attopt').change(function(){
							$attopt=$('#attopt').val();
							if($attopt==4){
								$('#attendees').removeClass('hide');
							}
							else{
								$('#attendees').addClass('hide');
							}
							
							
						});
 //creat event
	
    $('#calendar').fullCalendar({
         noEventsMessage:'No Event For today',
		 allDayText:'My Events',
		 eventLimit: true,
		  defaultView: 'month',
          header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			events: {
				url: '<?php echo e(url('view/myevent')); ?>',
				error: function() {
					$('#script-warning').show();
				},
					color: '#263238',     // an option!
					textColor: 'yellow' // an option!
				
			}
		
    }); 

}); 


</script>
<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="token" />
<div class="page-header">
  <h1 class="page-title">My Events</h1>
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
<!--MODAL  -->
<div class="modal fade modal-warning" id="eventcreate" aria-labelledby="exampleModalWarning" role="dialog"  aria-hidden="true" style="display: none;  ">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">CREATE AN EVENT</h4>
                        </div>
                        <div class="modal-body">
						<br><b>Subject:</b><br> 
						<input type="text" class="form-control"   placeholder="placeholder" id="subject">
						<br><b>Description:</b><br> 
						<textarea class="form-control"   placeholder="description" id="description"></textarea><br>
						<?php if(Auth::user()->role==1): ?>
							<?php   $hide=""; ?>
							<?php elseif(Auth::user()->role==2|| Auth::user()->role==3): ?>
							<?php   $hide="hide" ?>
							 <?php else: ?>
								 <?php   $hide=""; ?>
							<?php endif; ?>
						<b>Attendees:</b><br>
						
						<select  data-plugin="select2" data-placeholder="Choose Option" id="attopt" >
						
					   <option value="1">All Direct Report</option>
					   <?php if(Auth::user()->role==3): ?>
					   <option value="2">All Line Managers</option>
					   <option value="3">All Employees</option>
					   <?php endif; ?>
					    <option value="4">Custom</option>
					   
					   </select><br>
						<textarea class="form-control <?php echo e($hide); ?>"   placeholder="please enter the emailaddress of the attendees separated bt a comma e.g test@email.com,test2@email.com" id="attendees"></textarea><br>
						<b>Location:</b><br> 
						<textarea class="form-control"   placeholder="description" id="location"></textarea>
					   <br><b>Reminder</b><br> 
					   <select  data-plugin="select2" data-placeholder="Choose Option" id="reminder" >
					   <option value="true">Yes</option>
					   <option value="false">No</option>
					   </select>
						<br><b>Start:</b><br> 
					<div class="input-group  " >
                    <span class="input-group-addon">
                      <i class="icon wb-calendar" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control datepair-date datepair-start" id="startdate" data-plugin="datepicker">
                 
                    <span class="input-group-addon">
                      <i class="icon wb-time" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control datepair-time datepair-start ui-timepicker-input" id="starttime"  data-plugin="timepicker" autocomplete="off">
                  </div>
					<br><b>End:</b><br> 
				  	<div class="input-group  " >
                    <span class="input-group-addon">
                      <i class="icon wb-calendar" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control datepair-date datepair-start" id="enddate" data-plugin="datepicker">
                 
                    <span class="input-group-addon">
                      <i class="icon wb-time" aria-hidden="true"></i>
                    </span>
                    <input type="text"  class="form-control datepair-time datepair-start ui-timepicker-input" id="endtime" data-plugin="timepicker" autocomplete="off">
                  </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" onclick="createeventd()" class="btn btn-primary">Create Event</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  
<!--MODAL  -->
<div class="panel panel-primary panel-line">
            <div class="panel-heading">
              <h3 class="panel-title">My Outlook Event
			  <button data-target="#eventcreate"  data-toggle="modal" type="button" class="pull-right btn btn-icon btn-default btn-outline"><i class="icon wb-pencil" title="create event" aria-hidden="true"></i></button>
			  </h3>
            </div>
            <div class="panel-body">
			 
			<div id="calendar">
			
			
			</div>
			
			</div>
          </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>