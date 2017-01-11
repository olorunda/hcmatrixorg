@extends('layouts.app')

@section('content')
<script src="../../global/vendor/jquery/jquery.js"></script>

<?php  $jobdetail=app('App\Http\Controllers\EmployeeController')->getjobdetail(Auth::user()->job_id) ?>
<script>
  function url(url){

   window.location=url;
 }

 $(function(){
  $('#clockin').thooClock();
  	
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

  //clockin
 $('#clocking').click(function(){
	 
	$.get('employee/clock',function(data,status,xhr){
		
	if(xhr.status==200){
		
		
		toastr.success(data);
	}
	else{
		
		
		toastr.error("Some Error Occurred:"+data);
	}
	
		
		
	});
	}); 
	
	//clock out
	$('#clockout').click(function(){
	 
	$.get('employee/clockout',function(data,status,xhr){
		
	if(xhr.status==200){
		
		
		toastr.success(data);
	}
	else{
		
		
		toastr.error("Some Error Occurred:"+data);
	}
	
		
		
	});
	}); 
	 
 });
</script>
<style>
 


</style>
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
<div >

  @if(Auth::user()->role!=0 )
<div class="col-md-12 col-xs-12 col-md-12">
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel">
    <div class="card card-shadow card-shadow1">
      <div class="card-block bg-white p-30">
        <button onclick="url('{{url('/employee/profile')}}')" type="button" class="btn btn-floating btn-sm btn-warning">
          <i class="fa fa-user"></i>
        </button>
        <span class="m-l-15 font-weight-400">Profile</span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
	
  </div>
  
    @if(Auth::user()->role>=2)
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel marg" >
    <div class="card card-shadow card-shadow1" >
      <div class="card-block bg-white p-30">
        <button onclick="url('{{url('manage/absence')}}')" type="button" class="btn btn-floating btn-sm btn-success">
          <i class="fa fa-plane"></i>
        </button>
        <span class="m-l-15 font-weight-400">Absence Mgt</span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
  </div>
  @endif
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel marg">
    <div class="card card-shadow card-shadow1">
      <div class="card-block bg-white p-30">
        <button @if(Auth::user()->role>=2)  onclick="url('{{url('employee/objective')}}')" 
		@else  onclick="url('{{url('employee/performance')}}')"      @endif type="button" class="btn btn-floating btn-sm btn-primary">
          <i class="fa fa-signal"></i>
        </button>
        <span class="m-l-15 font-weight-400">Performance</span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 col-xs-12 info-panel marg" >
    <div class="card card-shadow card-shadow1">
      <div class="card-block bg-white p-30">
        <button type="button" class="btn btn-floating btn-sm btn-info">
          <i class="fa fa-book"></i>
        </button>
        <span class="m-l-15 font-weight-400">Training </span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 col-xs-12 info-panel @if(Auth::user()->role>=2) @else marg @endif" >
    <div class="card card-shadow card-shadow1">
      <div class="card-block bg-white p-30">
        <button type="button" class="btn btn-floating btn-sm btn-warning">
          <i class="fa fa-money"></i>
        </button>
        <span class="m-l-15 font-weight-400">Finance</span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
  </div>
    <div class="col-xl-3 col-md-6 col-xs-12 info-panel @if(Auth::user()->role>=2) marg  @else  @endif">
    <div class="card card-shadow card-shadow1">
      <div class="card-block bg-white p-30">
        <button type="button" class="btn btn-floating btn-sm btn-danger">
          <i class="fa fa-heartbeat"></i>
        </button>
        <span class="m-l-15 font-weight-400">Health</span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
  </div>
  @if(Auth::user()->role>=2)
   <div class="col-xl-3 col-md-6 col-xs-12 info-panel marg">                    
    <div class="card card-shadow card-shadow1">
      <div class="card-block bg-white p-30">
        <button onclick="url('{{url('hr/attendance')}}')" type="button" class="btn btn-floating btn-sm btn-info">
          <i class="fa fa-calendar"></i>
        </button>
        <span class="m-l-15 font-weight-400">Attendance</span>
        <div class="content-text text-xs-center m-b-0">

        </div>
      </div>
    </div>
  </div>
  @endif
</div>
</div>
@endif
<div class="col-md-12 col-xs-12 col-md-12">
<style>
#personalCompletedWidget .overlay-background{
	background: #077a3b;
	#background: url('{{url('assets/images/fmn.png')}}');
	background-color: hsla(124, 40%, 20%, 0.6);
}
.overlay-panel {
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	padding: 0px;
	color: #fff;
}
canvas{
	
	width:63%;
	height:100%;
}
 
</style>

<!-- Personal -->
        <div class="col-md-6">
          <div id="personalCompletedWidget" class="card card-shadow">
            <div class="card-header text-xs-center card-header-transparent cover overlay">
              <img class="cover-image" src="../../../global/photos/placeholder.png">
              <div class="overlay-panel overlay-background vertical-align">
                <div class="vertical-align-middle">
                  <a class="avatar avatar-100" href="javascript:void(0)">
                    <img alt="" src="../../../global/portraits/4.jpg">
                  </a>
                  <div class="font-size-20">{{Auth::user()->name}}</div>
                  <div class="font-size-14">{{$jobdetail['title']}}</div>
				  
				  <!--<ul class="list-inline font-size-18 m-b-35">
        <li class="list-inline-item">
          <a class="blue-grey-400" href="{{Auth::user()->twitter}}" target="_blank">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
        </li>
        <li class="list-inline-item m-l-10">
          <a class="blue-grey-400" href="{{Auth::user()->facebook}}" target="_blank"">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
        </li>
        <li class="list-inline-item m-l-10">
          <a class="blue-grey-400" href="{{Auth::user()->dribble}}" target="_blank">
            <i class="icon bd-dribbble" aria-hidden="true"></i>
          </a>
        </li>
        <li class="list-inline-item m-l-10">
          <a class="blue-grey-400" href="{{Auth::user()->instagram}}" target="_blank">
            <i class="icon bd-instagram" aria-hidden="true"></i>
          </a>
        </li>
      </ul>-->
                </div>
              </div>
            </div>
            <div class="card-block">
              <div class="row text-xs-center m-b-20">
			  <!--<p class="m-b-35">{{$jobdetail['description']}}
      </p>-->
	  
                @if(Auth::user()->age == 0)
        @if(session()->has('preview_job'))
          <button type="button" class="btn btn-primary p-x-40" onclick="url('{{url('job')}}/default?job_id={{session('preview_job')}}')">Complete Job Application
          </button>
        @else
          <button type="button" class="btn btn-primary p-x-40" onclick="url('{{url('available_jobs')}}/joblist')">Available Jobs
          </button>
        @endif
      @else
      <button type="button" class="btn btn-primary p-x-40" onclick="url('employee/profile')">View Profile</button>
      @endif
              </div>
              
            </div>
          </div>
        </div>
        <!-- End Personal -->

<!--
<div class="col-md-6" style="margin-left:-13px;">
  <div class="card card-shadow">
    <div class="card-block text-xs-center bg-white p-40">
      <div class="avatar avatar-100 m-b-20">
        <img src="{{asset('upload')}}/{{Auth::user()->image}}" alt="{{Auth::user()->image}}">
      </div>
      <p class="font-size-20 blue-grey-700">{{Auth::user()->name}}</p>
      <p class="blue-grey-400 m-b-20">{{$jobdetail['title']}}</p>
      <p class="m-b-35">{{$jobdetail['description']}}
      </p>
      <ul class="list-inline font-size-18 m-b-35">
        <li class="list-inline-item">
          <a class="blue-grey-400" href="{{Auth::user()->twitter}}" target="_blank">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
        </li>
        <li class="list-inline-item m-l-10">
          <a class="blue-grey-400" href="{{Auth::user()->facebook}}" target="_blank"">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
        </li>
        <li class="list-inline-item m-l-10">
          <a class="blue-grey-400" href="{{Auth::user()->dribble}}" target="_blank">
            <i class="icon bd-dribbble" aria-hidden="true"></i>
          </a>
        </li>
        <li class="list-inline-item m-l-10">
          <a class="blue-grey-400" href="{{Auth::user()->instagram}}" target="_blank">
            <i class="icon bd-instagram" aria-hidden="true"></i>
          </a>
        </li>
      </ul>
      @if(Auth::user()->age == 0)
        @if(session()->has('preview_job'))
          <button type="button" class="btn btn-primary p-x-40" onclick="url('{{url('job')}}/default?job_id={{session('preview_job')}}')">Complete Job Application
          </button>
        @else
          <button type="button" class="btn btn-primary p-x-40" onclick="url('{{url('available_jobs')}}/joblist')">Available Jobs
          </button>
        @endif
      @else
      <button type="button" class="btn btn-primary p-x-40" onclick="url('employee/profile')">View Profile</button>
      @endif
    </div>
  </div>
  
</div>-->
<div class="col-md-6">
  <div class="card card-shadow" style="padding:0 0 5px 0;">
    <div class="card-block text-xs-center bg-white p-40">
     
	<div id="clockin"  >
	
	
	</div><br><br> 
	  <button type="button" class="btn btn-danger btn-outline p-x-40" id="clocking"><i class="fa fa-clock"></i>Clock In</button>
	   <button type="button" class="btn btn-success btn-outline p-x-40" id="clockout"><i class="fa fa-clock"></i>Clock Out</button>
	 </div>
  </div>
</div>
</div>
@endsection
