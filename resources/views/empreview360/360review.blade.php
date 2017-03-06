@extends('layouts.app')

@section('content')

<style>
.thumbnail {
    padding:0px;
}
.panel {
	position:relative;
}
.panel>.panel-heading:after,.panel>.panel-heading:before{
	position:absolute;
	top:11px;left:-16px;
	right:100%;
	width:0;
	height:0;
	display:block;
	content:" ";
	border-color:transparent;
	border-style:solid solid outset;
	pointer-events:none;
}
.panel>.panel-heading:after{
	border-width:7px;
	border-right-color:#f7f7f7;
	margin-top:1px;
	margin-left:2px;
}
.panel>.panel-heading:before{
	border-right-color:#ddd;
	border-width:8px;
}


</style>
<?php

function niceDate($date)
{
	return date("l, jS \of F, Y. h:i:s A", strtotime($date));
}
 
?>
<script>
	function reviewed(id,name,lmid){
	 
		 	sessionStorage.setItem('count',0);
		$('#prev').show();		
	 $('#next').show();	
		
		$.get('{{url('countreview')}}',{
			
			empid:id
			
		},function(data,status,xhr){

	if((Math.ceil(data/5))-1<=0){
	 $('#prev').hide();		
	 $('#next').hide();		
	}
	 
	
	sessionStorage.setItem('max',(Math.ceil(data/5))-1);

	
	});

	$('#next').click(function(){
 
	max=sessionStorage.getItem('max');
		
		if(sessionStorage.getItem('count')>=1){
		 $('#prev').show();	
	}
	else{
		 $('#prev').hide();	
	}
	
	var counter= sessionStorage.getItem('count');
	counter++;
//	alert($('#max').val());
	sessionStorage.setItem('count',counter);
	
	id=$('#reviewer').val();
	name=$('#namereview').html();
	lmid=$('#lmid').val();
	 $('#myreviews').html("");
	reviewfunc(id,counter);
	if(sessionStorage.getItem('count')==max){
		 $('#next').hide();
		 $('#prev').show();
  		 
	}
	});
	
   $('#prev').hide();	
	
	//previous button condition
	$('#prev').click(function(){
	    	max=sessionStorage.getItem('max');
		
		min=1;
	var counter= sessionStorage.getItem('count');
	counter--;
	 sessionStorage.setItem('count',counter);
	
	id=$('#reviewer').val();
	name=$('#namereview').html();
	lmid=$('#lmid').val();
	$('#myreviews').html("");
	 reviewfunc(id,counter);
	//getreview( );
	
	if(sessionStorage.getItem('count')<max){
		 $('#prev').show();	
		 $('#next').show();	
	}
		if(sessionStorage.getItem('count')<=0){
		 $('#prev').hide();	
		 
	}
	else{
		 $('#prev').show();	
	}
	
	});
	
	$('#reviewer').val(id);
	$('#namereview').html(name);
	$('#lmid').val(lmid);
	$('#myreviews').html("");
	
	reviewfunc(id,0);
	 
	}

	function reviewfunc(id,skip){
		skip=skip*5;
		$.get('{{url('getrecentreview')}}',{
		
		empid:id,
		skip:skip,
		reviewerid:{{\Auth::user()->id}},
		
		
	},function(data,status,xhr){
		
		
		if(xhr.status==200){
			
			$.each(data,function(index,element){
				
				if(element.name="{{Auth::user()->name}}"){
					name="You";
				}
				else{
					
					name=element.name;
				}
			$('#myreviews').append(
			'<div class="col-sm-2"> <div class="thumbnail"> <img class="img-responsive user-photo" style="height:50px; weight:50px;" src="{{asset('storage')}}/{{Auth::user()->image}}"> </div>  </div>  <div class="col-sm-10"> <div class="panel panel-default"> <div class="panel-heading"> <strong>'+
			name
			+' </strong> <span class="text-muted">commented @'+element.created_at+'</span> </div> <div class="panel-body">'+element.review+'</div></div> </div>');
			});
			return ;
		}
		console.log("Some error occurred");
	});
	
		
	}
$(function (){
	
	
//jquery pagination
//implement the count
	  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

 
	
	
		 $('#savereview').click(function(){
					
			review=$('#reviewmessage').val();
		 		
	empid=$('#reviewer').val();
	reviewee=$('#namereview').text();;
	lmid=$('#lmid').val();
							
			 $.get('{{url('savereview')}}',{
								
					 review:review,
					 empid:empid,
					 reviewee:reviewee,
					 lmid:lmid
								
				 },function(data,status,xhr){
								
				 if(xhr.status==200){
									
					 toastr.success('Review Successfully');
									
						 setTimeout(function(){
										
										window.location.reload();
									},2000);
									
								return ;	
								}
								toastr.error('Some Error Occurred');
									
								
							});
							
							
						});
});


</script>
<input type="hidden" value="{{csrf_token()}}" id="token" />
<div class="page-header">
  <h1 class="page-title">Employee 360 Review</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
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
          <span class="counter-number font-weight-medium" id="time">08:32:56 am</span>
        </div>
      </div>
    </div>
  </div>
  
</div>
	<div class="col-md-12 col-xs-12">
    <div class="container-fluid">
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body">
		@if(Auth::user()->role==3)
		  <div class="col-md-1"><span style="margin-left:15.2px;" class="checkbox-custom checkbox-primary">
                          <input class="selectable-all" type="checkbox" id="checkall">
                          <label></label>
                        </span></div>
					@endif
          <form class="page-search-form" role="search" method="GET" action="{{url('employee/list')}}">
            <div class="input-search input-search-dark col-md-4">
              <i class="input-search-icon wb-search" aria-hidden="true"></i>
              <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search Users">
              <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
            </div>
			
          </form>
		  <br>
		  <div class="modal fade modal-fall" id="reviewemp" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-success">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Write Review for <span id="namereview"></span> </h4>
                        </div>
                        <div class="modal-body">
						
						
						<div class="container">
 
						<div class="row">
						<div id="myreviews">
			
</div><!-- /container -->

						
						</div>
						</div>
                         <b>Review :</b><br/>
						 <textarea  data-provide="markdown" data-iconlibrary="fa"  id="reviewmessage" class="md-input" rows="5" style="width: 200px; resize: none;" ></textarea>
                        </div>
						<input type="hidden" id="reviewer" />
						<input type="hidden" id="lmid" />
						 
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger pull-left" id="prev" >Previous</button>
                          <button type="button" class="btn btn-success" id="next" >Next</button>
                          <button type="button" id="savereview" class="btn btn-primary">Save Review</button>
                        </div>
                      </div>
                    </div>
                  </div>
		 <div class="pull-right" style="margin-top:-15px;" >
		 About {{$employees->total()}} Result(s)</div>
          <div class="nav-tabs-horizontal " >
             <div ><br>
              <div class=""  role="tabpanel">
			  
				@if(count($employees)>0)
                <ul class="list-group">
			@foreach($employees as $employee)
			@if($employee->id==Auth::user()->id)
			
				@else
					
				@include('partials.empprofile')
				
               <li class="list-group-item">
                    <div class="media">
                      <div class="media-left">
                        <div class="avatar ">
						 
						 <img src="{{asset('storage')}}/{{$employee->image}}" alt="{{$employee->name}}">
                          <i></i>
                        </div>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading">
                          {{$employee->name}}
                          
                        </h4>
                         <span>
                          <i class="icon icon-color wb-map" aria-hidden="true"></i>                          {{$employee->address}}
                        </span>                        
						 
						<br> 
						
					 
						
						<span>
                          <i class="icon icon-color wb-map" aria-hidden="true"></i>&nbsp;Role: <span id="role{{$employee->id}}"> @if($employee->role==1) Employee @endif @if($employee->role==2) <b>Line-Manager</b> @endif
						  @if($employee->role==3) <b>Admin-HR</b>
						  
						  @endif  
							</span>
                        </span>                        
						<br> 
						 <span>
                          <i class="icon icon-color wb-pencil" aria-hidden="true"></i>                          Review 
						<button type="button" title="Write Review" class="btn btn-pure btn-primary icon icon-color wb-pencil" data-toggle="modal" data-target="#reviewemp" onclick="reviewed('{{$employee->id}}','{{$employee->name}}','{{$employee->linemanager_id}}')"></i></button>
                        </span>                        
						 
						<br>
						<div>
                          <a class="text-action" href="mailto:">
                            <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                          </a>
                          <a class="text-action" href="{{$employee->instagram}}">
                            <i class="icon icon-color bd-instagram" aria-hidden="true"></i>
                          </a>
                          <a class="text-action" href="{{$employee->twitter}}">
                            <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                          </a>
                          <a class="text-action" href="{{$employee->facebook}}">
                            <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                          </a>
                          <a class="text-action" href="{{$employee->dribble}}">
                            <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                          </a>
                        </div>
					 
                          <script>
						  <?php  $getrating=app('App\Http\Controllers\EmpController360')->getrate($employee->id,Auth::user()->id);  ?>
						  
						//doing somting magical? 
						  $(function(){
 
						  	$('#rating{{$employee->id}}').raty({ starType: 'i' });
							@if(session('FY')<date('Y'))
							$('#rating{{$employee->id}}').raty('score', {{$getrating['rating']}});
							$('#rating{{$employee->id}}').raty('readOnly', true);
							@elseif(date('m')<12)
							$('#rating{{$employee->id}}').raty('score', {{$getrating['rating']}});
							$('#rating{{$employee->id}}').raty('readOnly', true);
							
							@else
							@if($getrating['rated']==0)						
							$('#rating{{$employee->id}}').raty('score', {{$getrating['rating']}});
						     
							$('#rating{{$employee->id}}').click(function(){
							  
							  swal({
				title: "Confirm",
  text: "",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Rate",
  closeOnConfirm: false
},
function(){
 
							  score=$('#rating{{$employee->id}}').raty('score');   
							  $.get('{{url('rateemployee')}}',{
								  
								  score:score,
								  empid:{{$employee->id}},
								  empname:"{{$employee->name}}",
								  lmid:{{$employee->linemanager_id}}
								  
							  },function(data,status,xhr){
								  
								 if(xhr.status==200){
									 
									 $('#rating{{$employee->id}}').raty('readOnly', true);
									  swal("Rated", "Successfully Rated Employee", "success");
									 toastr.success('Rating Successfull');
									   
									 setTimeout(function(){
										 
										window.location.reload(); 
										 
									 },2000);
									return; 
								 }
								   swal("Error", "Some Error Occurred", "error");
								 toastr.error("Some Error Occurred");
								
								 
							 });
							
						});
						 
						  }); 
							@else
							$('#rating{{$employee->id}}').raty('score', {{$getrating['rating']}});
							$('#rating{{$employee->id}}').raty('readOnly', true);
							 @endif
							
							
						   @endif
						  });
						  </script>
						
							<span   id="rating{{$employee->id}}"></span>
								<br/>   
                             <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;( Total Rating: {{$getrating['rating']}})</span>
						             
						 
                       </div>
					      <div  class="media-right" >
                    <div class="btn-group-vertical" aria-label="Vertical button group" role="group">
					
					<!-- Make LINE MANAGER -->
                  
					<!-- Make LINE MANAGER -->
					
					 <button type="button" data-toggle="modal"  data-target="#viewemp{{$employee->id}}" title="View Profile" class="btn btn-outline btn-primary"><i class="icon wb-eye" aria-hidden="true"></i></button>
					 </div>
					 </div>
				   </div>
                  </li>
				  <hr>
				  	@endif
                @endforeach
			
				</ul>
                @else
					
				No Result Found
				@endif
				{!!  $employees->render() !!}
				</div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Panel -->
    </div>
  </div>
@endsection
