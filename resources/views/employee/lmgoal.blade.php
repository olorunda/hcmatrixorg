@extends('layouts.app')

@section('content')

<?php

	
	 $deadline = app('App\Http\Controllers\LMController')->checkDeadline(); 
	 $review   = app('App\Http\Controllers\LMController')->review(); 
		
	 if($deadline=='open' || $review=='open'){
		 $disable='';
	 }

	else{
		$disable='disabled';
	}
	
?>
  <script src="../../global/vendor/jquery/jquery.js"></script>
 <script>
 $(function(){
	 	 $('.status').hide();
	 	 $('.status1').hide();
	 $(document).ajaxStart(function(){
		 $('.status1').show();
		 $('.status').hide();
		 
		 
	 }).ajaxStop(function(){
			 $('.status1').hide();
			 $('.status').show(); 
			 
		 setTimeout(function(){
			 
			 $('.status').hide(); 
		 },1000);
	 });
	 
	  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);
 });
  function url(url) {
    window.parent.location= url;
   }

   
   function save(e,goalid,type){
	 
	 		 $('.status1').show();
		 $('.status').hide();
		 e.which=e.which || e.keyCode;
		
		 if(e.which==13 || e.which==46){
		 
		   var emp_comment=document.getElementById('emp_comment'+goalid).value;
		 $.post('{{url('employee')}}',{
			 id:'{{Auth::user()->id}}',
			 goalid:goalid,
			 emp_comment:emp_comment,
			 _token:$('#token').val()
			 },function(data,status,xhr){
			console.log(data); 
		 });
		 
		 }
	  
		 
	   }
	   
	function addaspiration(){
		@if(active('employeet/4'))
			<?php  $create='ca';  ?>
		@else
			<?php  $create='some';  ?>
		@endif
		var objective=document.getElementById('objective').value;
		var commitment=document.getElementById('commitment').value;
		var token=$('#token').val();
		
		$.post('{{url('employee')}}',{
			
			create:'{{$create}}',
			objective:objective,
			commitment:commitment,
			_token:token
			
		},function(data,status,xhr){
			console.log(xhr.status);
		if(xhr.status==200){
			
			window.location.reload();
		}
		
		});
		
	}
   
 </script>

<input type="hidden" id="token" value="{{csrf_token()}}" />

<div class="page-header">
  <h1 class="page-title">	@if (is_active('employeet/1'))
			Line Manager's Goal For {{date('Y')}}
				
				@endif
				@if (is_active('employeet/2'))
				Pilot Goal For {{date('Y')}}
			
				@endif
				@if (is_active('employeet/3'))
				IDP Goals For {{date('Y')}}
			
				@endif
				@if (is_active('employeet/4'))
				Career Aspiration
				@endif  </h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('employee')}}/goalsview">Objective Settings</a></li>
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
          <span class="counter-number font-weight-medium" id="time"></span>
        </div>
      </div>
    </div>
  </div>
</div>

 <div class="example-wrap" >
                            <div >
					  @if(count($lmgoal)>0)
						  
					  <?php $i=1; ?>
					@foreach($lmgoal as $lmgoals)
					  
					  <!-- JUST ADDED -->
					  <div class="panel" style="margin-bottom: 4px;">
  <div class="panel-body">
   <div class="ribbon ribbon-clip ribbon-reverse ribbon-warning">
    <span style="cursor:pointer"  class="ribbon-inner" title="Apply" >
	Commitment {{$i++}}
    </span>
  </div>
    <div class="panel-group panel-group-simple" id="siteMegaAccordion" aria-multiselectable="true" role="tablist">
      <div class="panel">
        <div class="panel-heading" id="siteMegaAccordionHeadingThree" role="tab">
         
          <a class="panel-title" data-toggle="collapse" href="#siteMegaCollapseThree{{$lmgoals->id}}" data-parent="#siteMegaAccordion" aria-expanded="false" aria-controls="siteMegaCollapseThree{{$lmgoals->id}}">
            <h4 class="text-warning">Commitment {{$i-1}}</h4>
            <span class="text-default">
			{{$lmgoals->commitment}}
            </span>
			
					     <?php  $comment=app('App\Repositories\EmployeeRepository')->getcomment($lmgoals->id,'emp_comment');  ?>
                   
          </a>
        </div>
        <div class="panel-collapse collapse" id="siteMegaCollapseThree{{$lmgoals->id}}" aria-labelledby="siteMegaAccordionHeadingThree" role="tabpanel">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <h4>Objectives</h4>
                <ul>
                  <li>
				  {{$lmgoals->objective}}
                  </li>
                </ul>
              </div>
              <div class="col-md-12 col-xs-12">
                <h4>My Comment</h4>
                <ul>
                  <li>
				  <div classs="col-md-6"><span class="status1 text-warning"><b>Status:Writing..</b></span>
				 <span class="status text-success"><b> Status:Saved..</b></span>
				 @if($disable!="")
				 @if($comment['emp_comment']=="")
					  {{trim($comment['emp_comment'])}}
				  @else
					  No Comment Yet
					  @endif
					  @else
				  <textarea {{$disable}} data-provide="markdown" data-iconlibrary="fa" data-width="" class="md-input" rows="5"  style=""  onkeypress="save(event,'{{$lmgoals->id}}','1')" id="emp_comment{{$lmgoals->id}}">
					 {{trim($comment['emp_comment'])}} </textarea>
					 @endif
					 </div>
                  </li>
                  
                </ul>
              </div>
              <div class="col-md-12 col-xs-12">
                <h4>Line Manager's Comment</h4>
                <ul>
                  <li>
                  @if($comment['lm_comment']=="") No Comment Yet @else {{$comment['lm_comment']}} @endif
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

					  @endforeach
                    
					@if (is_active('employeet/3')||is_active('employeet/4'))
						
					
				  
				   <div class="site-action" data-plugin="actionBtn">
	  <button type="button" data-target="#moregoals" data-toggle="modal" id="examplePopupForm" class="site-action-toggle btn-raised btn btn-success btn-floating pull-left" >
      <i class="front-icon wb-plus animation-scale-up" aria-hidden="true"></i>
      <i class="back-icon wb-close animation-scale-up" aria-hidden="true"></i>
    </button>
	</div>
				  @endif
				  @else
					<p style="margin-top:500px; font-size:30px; margin:20px;" class=" center-block alert alert-success" id="notfound">
				@if (is_active('employeet/1'))
				Goals Has Not been added by your line manager for this year
				@endif
				@if (is_active('employeet/2'))
				Pilot Goals has not been added this year
				@endif
				@if (is_active('employeet/3'))
					Individual Personal goal has Not been add by you , Click <a id="examplePopupForm"  data-toggle="modal" href="javascript::void(0)" data-target="#moregoals">Here</a> to add IDP
			 	@endif
				@if (is_active('employeet/4'))
				No Career aspiration found this Year 	 click <a id="examplePopupForm"  data-toggle="modal" href="javascript::void(0)" data-target="#moregoals">here</a> to add your career aspiration @endif
				@endif
				</p>
				
			
						<!--JUST ADDED -->
						<div class="modal fade modal-3d-flip-horizontal" id="moregoals" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
						 <div class="modal-dialog modal-sidebar modal-md">
                            <div class="modal-content">
                          <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title">@if(is_active('employeet/3')) Add Individual Development Plan For {{date('Y')}} @else 
			  Add Career Aspirations
			  @endif</h4>
                              </div>
							  
                              <div class="modal-body">
				<form class="" id="goalform">
			
			  <b>Objectives</b>:<br><br>
					
				   <textarea {{$disable}} data-provide="markdown" data-iconlibrary="fa" id="objective" class="md-input" rows="5" style="width: 100%; resize: none;" ></textarea><br>
				   
                    <b>Commitment</b>:<br><br>
				   <textarea {{$disable}} data-provide="markdown" data-iconlibrary="fa"  id="commitment" class="md-input" rows="5" style="width: 200px; resize: none;" ></textarea>
				    
			
                  </form>
				   <div class="modal-footer">
				   <div  style="margin-left:80px;">
                             	<button {{$disable}} type="button" id="addesc" class=" btn btn-squared  btn-success" onclick="addaspiration()"><i class="wb wb-plus"></i>&nbsp;&nbsp;Add </button>
                                <button type="button" class="btn btn-warning btn-squared " data-dismiss="modal"><i class="wb wb-close"></i>&nbsp;&nbsp;Close</button>
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>
					<!--ENDED -->
                </div>
				
			</div>
			</div>
			</div>
	
			@endsection