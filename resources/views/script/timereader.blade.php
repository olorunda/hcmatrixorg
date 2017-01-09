
 
<?php  //$jobdetail=app('App\Http\Controllers\EmployeeController')->getjobdetail(Auth::user()->job_id) ?>
<script>
function url(url){
	
	window.location=url;
}

   $(function(){
	
	setInterval(function(){
		$.get('employee/time',function(data,status,xhr){
			
			$('#time').html(data);
			
		});	
		
		
	},1000);

	
});
</script>
<div class="page-header">
                <h1 class="page-title">Home</h1>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active">You are Here</li>
                </ol>
                <div class="page-header-actions">
                  <div class="row no-space w-250 hidden-sm-down">
                   
                    <div class="col-sm-6 col-xs-12">
                      <div class="counter">
                        <span class="counter-number font-weight-medium">{{date('Y-m-d')}}</span>
                      
                      </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                      <div class="counter">
                        <span class="counter-number font-weight-medium" id="time">{{date('h:i s a')}}</span>
                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>