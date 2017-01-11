@extends('layouts.app')

@section('content')
<script src="../../global/vendor/jquery/jquery.js"></script>

<?php  $jobdetail=app('App\Http\Controllers\EmployeeController')->getjobdetail(Auth::user()->job_id) ?>
<script>
  function url(url){

   window.location=url;
 }
 
 function urlChange(url) {
   $('#hide').slideUp(1000);
   $('.show').show(1000);
    document.getElementById('loaddoc').src = url;
   }
   
 $(function(){

   setInterval(function(){
      $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

  },1000);
  
   $('.col-md-6').fadeIn(1000);
		
		   $('.show').hide(1000);

@include('script.morris')
</script>
  <div id="hide" >
<div class="page-header">
  <h1 class="page-title">Performance OverView  </h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Performance Dashboard</a></li>
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
		@if(count($lmgoal)>0)
  <div class="card">
              <div class="card-block">
                <h4 class="card-title"><i class="wb-graph-up" ></i>&nbsp;&nbsp;Pilot Performance Chart For @if(session()->has('FY')) {{session('FY')}} @else {{date('Y')}}  @endif</h4>
				
                <span class="card-text"><div id="pilotchart"></div></span>
               
             
              </div>
            </div> 
			@endif
			  <div class="card">
              <div class="card-block">
                <h4 class="card-title"><i class="wb-pluse" ></i>&nbsp;&nbsp;Pilot Goal Performance Overview For @if(session()->has('FY')) {{session('FY')}} @else {{date('Y')}}  @endif </h4>
                <p class="card-text"><div class="example table-responsive">
				@if(count($lmgoal)>0)
                  <table class="table table-striped">
                    <thead class="bg-blue-grey-100">
					
                      <tr>
                        <th>S/N</th>
                        <th>Objective</th>
                        <th>Committment</th> 
                        <th>LM Rating</th>
                        <th class="text-nowrap">Admin Rating</th>
                        <th class="text-nowrap">Comment(s)</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php $index=1; ?>
					@foreach($lmgoal as $lmgoals)
                    
                      <tr>
                       <td>{{$index++}}</td>
                       <td>{{$lmgoals->objective}}</td>
                       <td>{{$lmgoals->commitment}}</td>
					   <?php  $lmrate=app('App\Repositories\EmployeeRepository')->getrate($lmgoals->id); ?>
                       <td>@if($lmrate['lm_rate']=="") Not Yet Rated @else {{$lmrate['lm_rate']}} @endif </td>
                        <td>@if($lmrate['admin_rate']=="") Not Yet Rated @else {{$lmrate['admin_rate']}} @endif</td>
                        <td><button class="btn btn-outline btn-success" data-target="#viewcomment{{$lmgoals->id}}" data-toggle="modal" type="button"><i class="wb-eye"></i>&nbsp;&nbsp;View</button>
						
						<!-- mmm-->
						<div class="modal fade modal-3d-flip-horizontal" id="viewcomment{{$lmgoals->id}}" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title"><b><i class="icon  wb-align-justify"></i>&nbsp;&nbsp;Comments</b></h4>
                        </div>
                        <div class="modal-body">
                       
			 <div class="example table-responsive">
                  <table class="table table-striped">
                    <thead class="bg-blue-grey-100">
                      <tr>
                        <th>Admin's Comment</th>
                        <th>LM's Comment</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>@if($lmrate['admin_comment']=="") No Comment Yet @else {{$lmrate['admin_comment']}} @endif</td>
                        <td> @if($lmrate['lm_comment']=="") No Comment Yet @else {{$lmrate['lm_comment']}}  @endif</td>
                        
                      </tr>
                    </tbody>
                  </table>
             </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>
						</td>
                      </tr>
					  @endforeach
                      
                      
                    </tbody>
                  </table>
				  @else
					  
				 <p style="margin-top:500px; font-size:30px; margin:20px;" class=" center-block alert alert-success" id="notfound"> Pilot Goal Has Not been Set For This Year</div>
				  @endif
                </div></p>
               
             
              </div>
            </div>
		</div>
		</div>
@endsection
