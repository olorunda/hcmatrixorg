@extends('layouts.app')

@section('content')
<script>
$(function (){
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

});

$(function(){
    $('#calendar').fullCalendar({
         noEventsMessage:'{{_t('No Leave Request For today')}}',
		 allDayText:'{{_t('Employee Present Today')}}',
		 eventLimit: true,
		  defaultView: 'month',
          header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			events: {
				url: '{{url('view/displcal')}}',
				error: function() {
					$('#script-warning').show();
				},
					color: '#263238',     // an option!
					textColor: 'yellow' // an option!
				
			}
		
    });

});

</script>
<input type="hidden" value="{{csrf_token()}}" id="token" />
<div class="page-header">
  <h1 class="page-title">{{_t('View Daily Employee Attendance')}}</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">{{_t('Home')}}</a></li>
    <li class="breadcrumb-item active">{{_t('You are Here')}}</li>
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
          <span class="counter-number font-weight-medium" id="time">08:32:56 am</span>
        </div>
      </div>
    </div>
  </div>
  
</div>
<div class="panel panel-primary panel-line">
            <div class="panel-heading">
              <h3 class="panel-title">{{_t('Employee(s) At Work')}}</h3>
            </div>
            <div class="panel-body">
			<div id="calendar">
			
			
			</div>
			
			</div>
          </div>
@endsection
