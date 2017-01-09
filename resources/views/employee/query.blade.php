@extends('layouts.app')
@section('content')

<script>

function search(){
	
	

  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("searchfield");
  filter = input.value.toUpperCase();
  table = document.getElementById("querytable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }

	
}

function reply(){
	var email=$('#email').val();
	var comment=$('#comment').val();
	var id=$('#qid').val();
	var title=sessionStorage.getItem('title');
	$.get('{{url('replyquery')}}?comment='+comment+'&id='+id+'&email='+email+'&title='+title+'&empid={{Auth::user()->id}}',function(data,status,xhr){
		
		if(xhr.status==200){
			$('#commentbox').hide();
			$('#realreply').hide();
	        $('#reply').show();
			$('#threadbody').append('<div class="comment media"> <div class="media-left"> <a class="avatar avatar-lg" href="javascript:void(0)"> <img src="{{url('upload')}}/{{Auth::user()->image}}" alt="..."> </a></div> <div class="comment-body media-body"> <a class="comment-author" href="javascript:void(0)">You</a> <div class="comment-content">  <p>'+comment+'</p> </div>   </div></div><hr>');
			
			toastr.success('Query Reply Sent');
			
		}
		else{
			toastr.error('Some Error Occurred');
		}
		
		
	});
	
	
}
$(function(){
	
	$('#reply').click(function(){
			$('#realreply').show();
	        $('#reply').hide();
			$('#commentbox').show();
		
		
	});

	$('.hidespin').hide();
	$(document).ajaxStart(function(){
		$('.mailico').hide();
		$('.hidespin').show();
		
		
		
	}).ajaxStop(function(){
		
		
		$('.hidespin').hide();
		
		$('.mailico').show();
	});
	
});

function thread(qid,template,empname,image,email,qtitle){

	$('#realreply').hide();
	$('#reply').show();
	sessionStorage.setItem('title',qtitle);
	$('#email').val(email);
	$('#table'+qid).removeClass('table-active');
	if(qtitle=="Others"){
		$('#threadbody').html("<img style='width:100%; height:1000px;' src='{{url('storage')}}/"+template+"')}}' />");
		
	}
	
	else{
	$('#threadbody').html(template+'<hr>');
	}
	$('#commentbox').hide();
	
	
	$('#qid').val(qid);
	
	
	$.get('{{url('querythread')}}?qid='+qid,function(data,status,xhr){
		
		
		if(xhr.status==200)
		{
			//console.log(data);
			
			
			
			 $.each(data,function(index,element){
				
				if(element.emp_id=={{Auth::user()->id}}){
				name="You";
				image='{{Auth::user()->image}}';
				
				}
				else{
					name=empname;
				}
				$('#threadbody').append('<div class="comment media"> <div class="media-left"> <a class="avatar avatar-lg" href="javascript:void(0)"> <img src="{{url('upload')}}/'+image+'" alt="..."> </a></div> <div class="comment-body media-body"> <a class="comment-author" href="javascript:void(0)">'+name+'</a> <div class="comment-content">  <p>'+element.comment+'</p> </div>   </div></div><hr>');
				
				
			}); 
			
			
		}	
	else{
	
	toastr.error('some error occurred');
	}		
	});
	
	
}


</script>


				  
<div class="page bg-white" id="hidepage">
	<div class="page-aside">
		<!-- Contacts Sidebar -->
		<div class="page-aside-switch">
			<i class="icon wb-chevron-left" aria-hidden="true"></i>
			<i class="icon wb-chevron-right" aria-hidden="true"></i>
		</div>
		<div class="page-aside-inner page-aside-scroll scrollable is-enabled scrollable-vertical" style="position: relative;">
			<div data-role="container" class="scrollable-container" style="height: 286px; width: 236px;">
				<div data-role="content" class="scrollable-content" style="width: 219px;">
				              <h5 class="page-aside-title">Query Types</h5>
					<div class="page-aside-section">
						<div class="list-group">
						<a class="list-group-item" href="{{url('lm/query')}}" >
                  <i class="icon wb-clipboard" aria-hidden="true"></i>
                  <span class="list-group-item-content">All</span>
                </a>
							 @if(count($querytypes) >0 )
				  @foreach($querytypes as $querytype)
                <a class="list-group-item" href="{{url('lm/querytype')}}/{{$querytype->id}}" >
                  <i class="icon wb-clipboard" aria-hidden="true"></i>
                  <span class="list-group-item-content">{{$querytype->title}}</span>
                </a>
			   @endforeach
               @endif
			    <a class="list-group-item" href="{{url('lm/querytype')}}/0" >
                  <i class="icon wb-clipboard" aria-hidden="true"></i>
                  <span class="list-group-item-content">Others</span>
                </a>
							</div>
						</div>
				</div>
			</div>
		<div class="scrollable-bar scrollable-bar-vertical scrollable-bar-hide is-disabled" draggable="false"><div class="scrollable-bar-handle"></div></div><div class="scrollable-bar scrollable-bar-vertical scrollable-bar-hide is-disabled" draggable="false"><div class="scrollable-bar-handle"></div></div></div>
	</div>
	<!-- Employee Table Content -->
	<div class="page-main">
		<!-- Employee Table Content Header -->
		<div class="page-header">
			<h1 class="page-title">Direct Reports</h1>
			<div class="page-header-actions">
				
					<div class="input-search input-search-dark">
						<i class="input-search-icon wb-search" aria-hidden="true"></i>
						<input type="text" class="form-control" name="q" id="searchfield" onkeyup="search($(this).val())" placeholder="Search: Employee name...">
					</div>
				
			</div>
		</div>
		<!-- Employee Table Content -->
		<div id="contactsContent" class="page-content page-content-table" data-plugin="asSelectable">
			<!-- Actions -->
			<div class="page-content-actions">
			</div>
			<!-- Employees Table -->
			<table class="table table-condensed" id="querytable">
				<thead>
					<tr class="bg-blue-grey-100">
					
						<th>FULLNAME</th>
						<th>QUERY TYPE</th>
						<th>STATUS</th>
						<th>DATE ISSUED</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody id="directempsbody">
				
										<tr>
				
			 @if(count($allqueries) >0 )
				  @foreach($allqueries as $allquery)
			  
					<?php  $gettemplate=app('App\Repositories\EmployeeRepository')->querytypes($allquery->query_type_id);?>
					<tr id="table{{$allquery->id}}" @if(Auth::user()->role>1&&$allquery->lmnew==1 || Auth::user()->role==0&&$allquery->empnew==1) style="text-color:black" class="table-active" @endif  >
					<td class="cell-300">
                
                {{$allquery->name}}
              </td>
						<td class="cell-300">
						@if(isset($gettemplate['title']))
							
							<?php  $title=$gettemplate['title']; ?>
						@else
							<?php $title="Others"; ?>
						@endif
						{{$title}}
						</td>
						<td class="cell-300">@if($allquery->status==0)
						<span class="tag tag-pill tag-warning">Not Answered</span>
							@else($allquery->status==1)
							
						<span class="tag tag-pill tag-success">Answered</span>
						@endif
						</td>
						<td class="cell-300">{{date('F j, Y',strtotime($allquery->created_at))}}</td>
						<td class="cell-300">@if($allquery->status==0) 
							<?php $disabled="disabled"; ?>
						@else
							<?php $disabled=""; ?>
						@endif
						@if($title=="Others")
						<?php	$queryt=$allquery->document;  ?>
						@else
						<?php	$queryt=$allquery->content;  ?>	
						@endif
						
							<button title="View Query Thread" type="button" {{$disabled}} onclick="thread('{{$allquery->id}}','{{str_replace('[name]',$querytype->name,$queryt)}}','{{$allquery->name}}','{{$allquery->image}}','{{$allquery->email}}','{{$title}}')" class="btn btn-floating btn-success btn-sm" data-toggle="modal" data-target="#querythread"><i class="icon wb-eye" aria-hidden="true"></i></button>
						</td>
					</tr>
          @endforeach
		  
		  @else
						<th colspan="5">
							<h3>Hurray!!, No query Issued Yet.</h3>
						</th>
						@endif
					</tr>
									</tbody>
			</table>
		</div>
	</div>
<div class="modal fade modal-newspaper" id="querythread" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Query Thread </h4>
                        </div>
                        <div class="modal-body" id="threadbody">
                        
                        </div>
						<div id="commentbox" style="margin:0 20px 0 20px">
						<br>
					   <input type="hidden" id="qid" />
					   <input type="hidden" id="email" />
						<textarea class="form-control" id="comment" placeholder="Enter Reply Here"></textarea>
						</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="reply">Reply</button>
                          <button type="button" id="realreply" class="btn btn-primary" onclick="reply()"><i class="fa fa-circle-o-notch fa-spin fa-fw hidespin"></i><i class="fa fa-send mailico" ></i>&nbsp;&nbsp;Send Reply</button>
                        </div>
                      </div>
                    </div>
                  </div>
</div>

@endsection