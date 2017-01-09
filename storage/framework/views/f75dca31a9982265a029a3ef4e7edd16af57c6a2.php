<?php $__env->startSection('content'); ?>
<script src="../../global/vendor/jquery/jquery.js"></script>

<?php  $jobdetail=app('App\Http\Controllers\EmployeeController')->getjobdetail(Auth::user()->job_id) ?>

<script>
  function url(url){

   window.location=url;
 }
 
 function urlChange(url) {
   $('.hide').slideUp(1000);
   $('.show').show(1000);
    document.getElementById('loaddoc').src = url;
   }
   
 $(function(){

 
  $('.btcal').click(function() {
    window.setTimeout(clickToday, 200);
});


   setInterval(function(){
    $.get('/employee/time',function(data,status,xhr){

     $('#time').html(data);

   });	


  },1000);
   $.get('/leave/statistics',function(data,status,xhr){
 linkinfo= Morris.Bar({
  element: 'absencechart',
  data: data,
  xkey: 'x',
  ykeys: ['y'],
  barGap:1,
  barSizeRatio:0.2,
  barColors: ['#4caf50'],

  labels: ['Number of Applicant']
});
 
       });
  
 });



function clickToday() {
    $('.fc-today-button').click();
}

 function loadcal(){
    $('#calender').fullCalendar({
        
		 allDayText:'Holidays',
		  defaultView: 'month',
          header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			events: {
				url: '<?php echo e(url('manage/getholiday')); ?>',
				error: function() {
					$('#script-warning').show();
				},
					color: '#3b91ad',     // an option!
					textColor: 'white' // an option!
				
			}
		
    });

}
 
</script>

<div class="page-header">
  <h1 class="page-title">Absence Request Statistics  </h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Statistics</a></li>
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
          <span class="counter-number font-weight-medium" id="time"><?php echo e(date('h:i:s a')); ?></span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row" data-plugin="matchHeight" data-by-row="true">
  <!-- First Row -->
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel">
    <div class="card card-shadow">
      <div class="card-block bg-white p-20">
        <button type="button" onclick="loadcal()" class="btcal btn btn-floating btn-sm btn-warning" data-toggle="modal" data-target="#holidays">
          <i class="fa fa-lg fa-plane "></i>
        </button>
		
		<div class="modal fade modal-3d-flip-vertical" id="holidays" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Holiday Calender</h4>
                        </div>
                        <div class="modal-body">
                         <div id="calender" ></div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         
                        </div>
                      </div>
                    </div>
                  </div>
				  
        <span class="m-l-15 font-weight-400">HOLIDAYS</span>
        <div class="content-text text-xs-center m-b-0">
          <i class="text-success icon wb-triangle-up font-size-20"></i>
          <span class="font-size-40 font-weight-100"><?php echo e($count['holscount']); ?></span>
          <p class="blue-grey-400 font-weight-100 m-0">Recognised Public Holidays</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel">
    <div class="card card-shadow">
      <div class="card-block bg-white p-20">
        <button type="button" class="btn btn-floating btn-sm btn-danger">
          <i class="wb wb-home"></i>
        </button>
        <span class="m-l-15 font-weight-400">LEAVE BANK</span>
        <div class="content-text text-xs-center m-b-0">
          <i class="text-success icon wb-triangle-down font-size-20">
          </i>
          <span class="font-size-40 font-weight-100"><?php echo e($count['totalleave']); ?></span>
          <p class="blue-grey-400 font-weight-100 m-0">Total All Staff Yearly Due</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel">
    <div class="card card-shadow">
      <div class="card-block bg-white p-20">
        <button type="button" onclick="url('<?php echo e(url('manage/absence')); ?>')" class="btn btn-floating btn-sm btn-success" data-toggle="modal" data-target="#requests">
          <i class=" wb-calendar"></i>
        </button>
        <span class="m-l-15 font-weight-400">REQUESTS</span>
        <div class="content-text text-xs-center m-b-0">
          <i class="text-danger icon wb-triangle-up font-size-20">
          </i>
          <span class="font-size-40 font-weight-100"><?php echo e($count['request']); ?></span>
          <p class="blue-grey-400 font-weight-100 m-0">
          Leave Requests
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel">
    <div class="card card-shadow">
      <div class="card-block bg-white p-20">
        <button type="button" class="btn btn-floating btn-sm btn-primary" data-toggle="modal" data-target="#categories">
          <i class=" wb-copy"></i>
        </button>
        <span class="m-l-15 font-weight-400">CATEGORIES</span>
        <div class="content-text text-xs-center m-b-0">
          <i class="text-success icon wb-triangle-up font-size-20">
          </i>
          <span class="font-size-40 font-weight-100"><?php echo e($count['leavetype']); ?></span>
          <p class="blue-grey-400 font-weight-100 m-0">Absence Categories</p>
        </div>
      </div>
    </div>
  </div>

  <!-- End First Row -->
  <!-- second Row -->
 
    <!-- End Second Row -->
  </div>

    <div class="card">
              <div class="card-block">
                <h4 class="card-title"><i class="wb-graph-up" ></i>&nbsp;&nbsp;Absence Request Statistics For <?php if(session()->has('FY')): ?> <?php echo e(session('FY')); ?> <?php else: ?> <?php echo e(date('Y')); ?>  <?php endif; ?></h4>
				
                <p class="card-text"><div id="absencechart"></div></p>
               
             
              </div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>