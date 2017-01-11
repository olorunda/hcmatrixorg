@extends('layouts.app')

@section('content')
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

 
    setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);	


  
	 $('.col-md-6').fadeIn(1000);
		
		   $('.show').hide(1000);

  });
  
 

 
</script>
  <div class="hide" >
<div class="page-header">
  <h1 class="page-title">Objective Settings</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Objectives Dashboard</a></li>
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
          <span class="counter-number font-weight-medium" id="time">{{date('h:i:s a')}}</span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="documents-wrap app-documents categories" data-plugin="animateList" data-child="li" style="overflow: hidden;">
  <ul class="blocks blocks-100 blocks-xxl-6 blocks-lg-2 blocks-sm-2" data-plugin="matchHeight">

    <li data-plugin="appear" data-animate="scale-up">
      <div class="">
        <div class="category">
          <div class="icon-wrap">
            <i class="text-info icon wb-graph-up" aria-hidden="true"></i>
          </div>
          <h4 class="text-info">PILOT OBJECTIVES</h4>
          <p>Pilot Objectives are set the beginning of the fiscal year for every employee. This speicifies a must meet target for every empployee and is open for review at mid-year and end of the fiscal year review</p>
          <!--<button type="button" class="btn btn-outline btn-info"><i class="icon wb-plus" aria-hidden="true"></i> More</button>-->
          <button type="button" onclick="urlChange('{{url('employeet/2')}}')" class="btn btn-outline btn-info ladda-button" data-style="expand-left" data-plugin="ladda" data-type="progress">
            <span class="ladda-label"><i class="icon wb-plus m-r-10" aria-hidden="true"></i>More</span>
          </button>
        </div>
      </div>
    </li>

    <li data-plugin="appear" data-animate="slide-right">
      <div class="">
        <div class="category">
          <div class="icon-wrap">
            <i class="text-warning icon wb-clipboard" aria-hidden="true"></i>
          </div>
          <h4 class="text-warning">Line Manager's Objectives</h4>
          <p>Line Manager Objectives are stretch goals attached to employees under a line manager as deemed fit by the line manager. These goals must tally with already set Pilot objectives</p>
          <!--<button type="button" class="btn btn-outline btn-warning"><i class="icon wb-plus" aria-hidden="true"></i> More</button>-->
          <button type="button" class="btn btn-outline btn-warning ladda-button" data-style="expand-left" data-plugin="ladda" data-type="progress" onclick="urlChange('{{url('employeet/1')}}')">
            <span class="ladda-label"><i class="icon wb-plus m-r-10" aria-hidden="true"></i>More</span>
          </button>
        </div>
      </div>
    </li>

    <li data-plugin="appear" data-animate="slide-top">
      <div class="">
        <div class="category">
          <div class="icon-wrap">
            <i class="text-success icon wb-briefcase" aria-hidden="true"></i>
          </div>
          <h4 class="text-success">Individual Development Plans</h4>
          <p>
            Individual Development Plan summarizes development plans for each employee
          </p>
          <!--<button type="button" class="btn btn-outline btn-success"><i class="icon wb-plus" aria-hidden="true"></i> More</button>-->
          <button onclick="urlChange('{{url('employeet/3')}}')" type="button" class="btn btn-outline btn-success ladda-button" data-style="expand-left" data-plugin="ladda" data-type="progress">
            <span class="ladda-label"><i class="icon wb-plus m-r-10" aria-hidden="true"></i>More</span>
          </button>
        </div>
      </div>
    </li>

    <li data-plugin="appear" data-animate="slide-bottom">
      <div class="">
        <div class="category">
          <div class="icon-wrap">
            <i class="text-primary icon wb-flag" aria-hidden="true"></i>
          </div>
          <h4 class="text-primary">Career Aspirations</h4>
          <p>
            Discover employees career aspirations. View and monitor employees career path.
          </p>
          <!--<button type="button" class="btn btn-outline btn-primary"><i class="icon wb-plus" aria-hidden="true"></i> More</button>-->
          <button onclick="urlChange('{{url('employeet/4')}}')" type="button" class="btn btn-outline btn-primary ladda-button" data-style="expand-left" data-plugin="ladda" data-type="progress">
            <span class="ladda-label"><i class="icon wb-plus m-r-10" aria-hidden="true"></i>More</span>
          </button>
        </div>
      </div>
    </li>

  </ul>
</div>
<div></div>
</div>
<div class="show">
		@include('partials.modal')
		</div>
@endsection
