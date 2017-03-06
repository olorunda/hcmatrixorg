@extends('layouts.app')

@section('content')
  
<script>
//search


function sort(){
	

}
function urlChange(url) {
   // var site = url+'?toolbar=0&amp;navpanes=0&amp;scrollbar=0';
    document.getElementById('loaddoc').src = url;
}

$(function(){

$('#statusleave').change(function(){
	
	
	var status=$('#statusleave').val();
	window.location='{{url('sort')}}/'+status;
	
	
});
 
	

 $('#statusleave').select2();

$('.btcal').click(function() {
    window.setTimeout(clickToday, 200);
});

});

function clickToday() {
    $('.fc-today-button').click();
}

$(function(){
			
	$('#script-warning').hide();
	
});


function loadcal(type){
    $('#calendar').fullCalendar({
         noEventsMessage:'No Leave Request For today',
		 allDayText:'Leave Request',
		  defaultView: 'listWeek',
          header: {
				left: 'prev,next today',
				center: 'Employee Leave Request Calender',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			events: {
				url: '{{url('manage/getleave')}}',
				error: function() {
					$('#script-warning').show();
				},
					color: '#263238',     // an option!
					textColor: 'yellow' // an option!
				
			}
		
    });

}



	function url(url){
		window.location=url;
	}
	function  submitdecision(comment,type,id,email){
	//alert(email);
		var token=$('#token').val();
	//	return alert(type);
	
		$.post('{{url('manage')}}',{
			
			comment:comment,
			type:type,
			id:id,
			email:email,
			_token:token,
			
		},function (data,status,xhr){
		//console.log(data);
			if(xhr.status==200){
				
				$('#action'+id).hide();
				$('#decide'+id).show();
				$('#lmtext'+id).hide();
				$('#lmcomment'+id).show();
				
				
				if(type==1){
					
					//$('#statusset').html('<span class="tag tag-success">Approved </span>');
					$('#lmcomment'+id).html(comment+'( <span class="tag tag-success">Approved </span> )');
					toastr.success('Leave Approved');
				 swal('success','Leave Approved','success');
				 
				 @if(Auth::user()->role==3)
					 setTimeout(function(){
						 
						 window.location.reload();
						 
					 },2000);
				 
				 @endif
				 
				 return ;
				}
				else{
					
					//$('#statusset').html('<span class="tag tag-danger">Rejected </span>');
					$('#lmcomment'+id).html(comment+'( <span class="tag tag-danger">Rejected</span> )');
					toastr.error('Leave Rejected');
			
			
				swal('Rejected','Leave Rejected','error');
				
				 @if(Auth::user()->role==3)
					 setTimeout(function(){
						 
						 window.location.reload();
						 
					 },2000);
				 
				 @endif
				 return ;
				}
			}
			return swal('Error','Some error occurred','error');
			
			
			
			
		});
		
		
	}
	
	function fixclode(id){
		
		$('#lmtext'+id).show();
		$('#action'+id).toggle();
		$('#decide'+id).show();
		$('#lmtext'+id).toggle(); 
		$('#lmcomment'+id).show();
							 
	}

	function hide(id,email){
					 
					 $('#lmtext'+id).hide();
					 $('#action'+id).hide();
					 
					 $('#accept'+id).click(function(){
						
						//send ajax
					   var comment= $('#commitment'+id).val();
						 submitdecision(comment,1,id,email);
					 }); 


					 $('#decide'+id).click(function(){
						 
						//
							 $('#action'+id).show();
							 $('#decide'+id).hide();
							 $('#lmtext'+id).show(); 
							 $('#lmcomment'+id).hide();
						
						 
					 }); 
					 
					 $('#reject'+id).click(function(){
						   var comment= $('#commitment'+id).val();
						   	 submitdecision(comment,2,id,email);
						// send reject ajax
						 
					 });
					 
					 
				 }

</script>

<div class="page bg-white" >
	<div class="page-aside">
		<!-- Contacts Sidebar -->
		<div class="page-aside-switch">
			<i class="icon wb-chevron-left" aria-hidden="true"></i>
			<i class="icon wb-chevron-right" aria-hidden="true"></i>
		</div>
		<div class="page-aside-inner page-aside-scroll scrollable is-enabled scrollable-vertical">
			<div data-role="container">
				<div data-role="content">
				
					<div class="page-aside-section">
						<div class="list-group">
							<a class="list-group-item" href="javascript:void(0)" onclick="cat('A')">
								<span class="item-right">{{count($directemps)}}</span><i class="icon wb-inbox" aria-hidden="true"></i>All Request
							</a>
							</div>
							<div class="list-group" style="margin:0px 20px 0 20px;">
							<select id="statusleave"   data-plugin="select2" onclick="sort()" class="form-control" >
			
				<option>-Select Criteria-</option>
				<option value="5">All</option>
				<option disabled class="select2-results__group" style="font-size:15px;"><p class="text-center">  -Priority- </p></option>
				<option value="0">Normal</option>
				<option value="1">Medium</option>
				<option value="2">High</option>
				
				<option disabled class="select2-results__group" style="font-size:25px;"><p class="text-center">  -Status- </p></option>
				<option value="3">Approved</option>
				<option value="4">Rejected</option>
			
				</select>
						
                
						</div>
					</div>
					<div class="page-aside-section">
					<h4 class="page-aside-title">Leave Category</h4>
						<div class="page-aside-section">
						@if(count($leavecat)>0)
						
							<input type="hidden" name="lmtoken" id="lmtoken" value="{{csrf_token()}}">
						
							@foreach($leavecat as $leave)
							<div class="list-group">
								<h5>
									<a class="list-group-item" href="{{url('leave')}}?type={{$leave->id}}">
										<span class="item-right"></span><i class="fa fa-plane " aria-hidden="true"></i> {{$leave->name}}
									</a>
								</h5>
								</div>
							@endforeach
						
						
							@endif
							</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<!-- Employee Table Content -->
	<div class="page-main"  >
		<!-- Employee Table Content Header -->
		<div class="page-header">
			<h1 class="page-title">Direct Reports</h1>
			<div class="page-header-actions">
				<form method="GET" action="{{url('search')}}">
					<div class="input-search input-search-dark">
						<i class="input-search-icon wb-search" aria-hidden="true"></i>
						<input type="text" class="form-control" name="q" id="searchfield" onkeyup="search($(this).val())" placeholder="Search: Employee name...">
					</div>
				</form>
			</div>
		</div>
		<!-- Employee Table Content -->
		<div id="contactsContent" class="page-content page-content-table" data-plugin="asSelectable">
			<!-- Actions -->
			<div class="page-content-actions">
			</div>
			<!-- Employees Table -->
			<table class="table table-condensed" id="directempstable">
				<thead>
					<tr>
						
						<th>Name</th>
						<th>ID</th>
						<th>Role</th>
						<th>Type</th>
						<th>Priority</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="directempsbody">
				<input type="hidden" value="{{csrf_token()}}" id="token" />
					@if(count($directemps) > 0)
					@foreach($directemps as $emp)
					<tr>
						
						<td height="10">
							<img  class="img-circle img-bordered img-bordered-primary" alt="avatar" src="{{asset('storage')}}/{{$emp->image}}" style="margin-left:5px; align:center; width: 50px;height: 50px;" /><br>
							{{$emp->name}}
						</td>
						
						<?php  $job=app('App\Http\Controllers\EmployeeController')->getjobdetail($emp->job_id) ?>
						<td height="10">{{$emp->emp_num}}</td>
						<td height="10">{{$job['title']}}</td>
						<?php $leavetype=app('App\Repositories\EmployeeRepository')->leavecat($emp->absencetypes_id); ?>
						<td> {{$leavetype}}  </td>
						<td> @if($emp->priority=='0') <span class="tag tag-success" ><b>Normal</b></span> @elseif($emp->priority=='1') <span class="tag tag-warning" ><b>Medium</b></span> @else <span class="tag tag-danger" ><b>High</b></span> @endif </td>
						<td>@if($emp->status==0) <span class="tag tag-warning">Pending </span> @elseif($emp->status==1) <span class="tag tag-success">Approved </span>@else <span class="tag tag-danger">Rejected </span> @endif</td>
						<td height="10">
							
							<button style="padding:10px;" type="button" class="btn btn-outline btn-icon btn-warning btn-sm" title="View Request" data-target="#viewcomment{{$emp->id}}" onclick="hide('{{$emp->id}}','{{$emp->email}}')" data-toggle="modal" >
								<i class="icon wb-eye" aria-hidden="true"></i>
							</button>
							
						</td>
						<!--VIEW REQUEST -->
					
						
						<!-- mmm-->
						<div class="modal fade modal-3d-flip-horizontal" id="viewcomment{{$emp->id}}" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" data-keyboard="false" data-backdrop="static" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" onclick="fixclode('{{$emp->id}}')" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title"><b><i class="icon  wb-align-justify"></i>&nbsp;&nbsp;Leave Request</b></h4>
                        </div>
                        <div class="modal-body">
                       
			 <div class="example table-responsive">
                <div class="card card-block">
              <h4 class="card-title">{{strtoupper($emp->name)}}</h4>
              <p class="card-text">
			  <div class="col-md-12" style="margin-bottom:10px;">
			  <div class="col-md-4"><b>Leave Type:</b></div>
			  <div class="col-md-8">{{$leavetype}}</div>
			  </div>
			  <div class="col-md-12" style="margin-bottom:10px;">
			    <div class="col-md-4"><b>Reason:</b></div>
			  <div class="col-md-8">{{$emp->reason}}</div>
			  </div>
			  <div class="col-md-12" style="margin-bottom:10px;">
			    <div class="col-md-4"><b>Date:</b></div>
			
			  <div class="col-md-8">{{date('F j, Y',strtotime($emp->startdate))}}&nbsp;&nbsp;&nbsp;&nbsp; <b>To</b>&nbsp;&nbsp;&nbsp;&nbsp; {{date('F j, Y',strtotime($emp->expected_end))}}</div>
			  </div>
			  <div class="col-md-12" style="margin-bottom:10px;">
			     <div class="col-md-4"><b>Status:</b></div>
			  <div class="col-md-8" id="statusset">@if($emp->status==1) <span class="tag tag-success"  >Approved </span>@elseif($emp->status==2) <span class="tag tag-danger">Rejected </span> @else <span class="tag tag-warning">Pending</span> @endif</div>
			  </div>
			    <div class="col-md-12" style="margin-bottom:10px;">
			     <div class="col-md-4"><b>Your Comment:</b></div>
				 <div class="col-md-8" id="lmtext{{$emp->id}}">
				  <textarea  data-provide="markdown" data-iconlibrary="fa"  id="commitment{{$emp->id}}" class="md-input" rows="5" style="width: 100%; resize: none;" >{{$emp->lm_comments}}</textarea>
				 </div>
			
				
			  <div class="col-md-8" id="lmcomment{{$emp->id}}">
			  
			  @if($emp->lm_comments=="") No Comment Yet @else {{$emp->lm_comments}}(@if($emp->lm_approve==1) <span class="tag tag-success">Approved </span>@else <span class="tag tag-danger">Rejected </span> @endif) @endif</div>
			  </div>
			    <div class="col-md-12" style="margin-bottom:10px;">
			     <div class="col-md-4"><b>Admin Comment:</b></div>
			  <div class="col-md-8">@if($emp->admin_comments=="") No Comment Yet @else {{$emp->admin_comments}}( @if($emp->admin_approve==1) <span class="tag tag-success">Approved </span>@else <span class="tag tag-danger">Rejected </span> @endif ) @endif </div>
			  </div> 
			  <div class="col-md-12" style="margin-bottom:10px;">
			     <div class="col-md-4"><b>Board Comment:</b></div>
			  <div class="col-md-8">@if($emp->board_comments=="") No Comment Yet @else {{$emp->board_comments}}( @if($emp->board_approve==1) <span class="tag tag-success">Approved </span>@else <span class="tag tag-danger">Rejected </span> @endif ) @endif</div>
			  </div>
			  </div>
             
            </div>
             </div>
                       
                        <div class="modal-footer">
						   @if($emp->status=="1" || $emp->status=="2")
							@else
							<button type="button" id="decide{{$emp->id}}" class="btn btn-icon btn-success btn-outline"><i class="icon   wb-help-circle" title="Decide" aria-hidden="true"></i>&nbsp;Decide</button>
						    @endif
							<div >
							<div id="action{{$emp->id}}">
						<button type="button" id="accept{{$emp->id}}" class="btn btn-icon btn-success btn-outline"><i class="icon  wb-check" title="Accept" aria-hidden="true"></i></button>
						<button type="button" id="reject{{$emp->id}}" class="btn btn-icon btn-danger btn-outline"><i class="icon  wb-close" title="Reject"  aria-hidden="true"></i></button>
						@if($emp->file!="")
							<button  type="button" onClick="urlChange('{{url('upload')}}/support/{{$emp->file}}')" data-toggle="modal" data-target="#viewdoc"  class="btn btn-icon btn-info btn-outline"><i class="icon wb-file" title="Calender"   aria-hidden="true"></i>&nbsp;View Document</button>
						@endif
						</div>
						@if($emp->status=="1" || $emp->status=="2")
							
						<button  type="button" data-target="#calview"  onclick="loadcal('{{$leavetype}}')" id="button" data-toggle="modal"  class="btcal btn btn-icon btn-info btn-outline"><i class="icon   wb-calendar" title="Calender"   aria-hidden="true"></i>&nbsp;Check Calender</button>
							@else
						<button style="float:left; margin-top:-37px;" type="button" data-target="#calview"  onclick="loadcal('{{$leavetype}}')" id="button" data-toggle="modal"  class="btcal btn btn-icon btn-info btn-outline"><i class="icon   wb-calendar" title="Calender"   aria-hidden="true"></i>&nbsp;Check Calender</button>
					@endif
					
                       	</div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
						
						
						
						
						<!--END VIEW REQUEST -->
					</tr>
					@endforeach
					<tr>
						<th colspan="5">{{ $directemps->links() }}</th>
					</tr>
					@else
					<tr>
						<th colspan="5">
							<h3>No Leave Requests Yet.</h3>
						</th>
					</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	<a class="btn btn-primary btn-outline" id="exampleCloseButton" data-plugin="toastr" data-message="No match found." data-title="Search Box" data-container-id="toast-bottom-right" data-close-button="true" data-tap-to-dismiss="false" data-icon-class="toast-just-text toast-info" href="javascript:void(0)" role="button" style="display: none;">Generate</a>
</div>
<div class="modal fade modal-3d-flip-vertical" id="calview" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title"><b><i class="icon  wb-calendar"></i>&nbsp;&nbsp;Employee 360 Leave Requests</b></h4>
                        </div>
                        <div class="modal-body">
                       <span class="alert alert-danger " id="script-warning">Unable to load event</span>
			        <div id='calendar'></div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>
				  
				     <div id="viewdoc" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content -->
    <div class="modal-content modal-lg" style="margin-left:-15%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
      <div class="modal-body">
    
	   <iframe  id="loaddoc"  style="border:none; width:100%; height:1000px;"  > </iframe>
     </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div> 
</div>
@endsection