@extends('layouts.app')
@section('content')
<?php
function niceDate($date)
{
	return date("l, jS \of F, Y. h:i:s A", strtotime($date));
}
?>
<input type="hidden" value="{{csrf_token()}}" id="token" />
<script>


function query(id,name){
	
	$('#title').text('Query '+name);
	sessionStorage.setItem('name',name);
	sessionStorage.setItem('userid',id);
}

 function assignrole(employeeid,empname){
	//alert(empname);
	$('#empname').html(empname);
	sessionStorage.setItem('employeeid',employeeid);
}

function url(url){
	
	window.location=url;
}

function lockemp(empid){
	
	
			$('#icon'+empid).toggleClass('wb-link');
			$('#icon'+empid).toggleClass('wb-link-broken');
			
	$.get('{{url('disableemp')}}/'+empid,function(data,status,xhr){
		
		
		if(xhr.status==200){
			console.log(data);
			if(data==1){
			toastr.success('Employee Disabled');
		}
		else{
			toastr.success('Employee Enabled');
	
		}
		}
		else{
			toastr.error('Some Error occurred');
		}
		
	});
}
	
	
	function mapemployee(){
		
		lmid=$('#linemanager').val();
		//	alert('dfdfe');
		if($('.emparrlist').is(':checked')){
			
		}
		else{
			
			toastr.error('Please Select at lease one employee to Map');
			return ;
		}
	    var valuearr=$('.emparrlist:checked').map(function() {return this.value;}).get();
		console.log(valuearr);
		var i=0;
		//$.each(valuearr,function(index,element){
			
			for( i=0; i<valuearr.length; i++){
				//console.log(valuearr[i]);
			$.get('{{url('hr/assignlm')}}/'+valuearr[i]+'/'+lmid,function(data,status,xhr){
				
				if(xhr.status==200){
					
					sessionStorage.setItem('status',1);
				}
				else{
					sessionStorage.setItem('status',0);
				
				}
				
			
			
			}); 
				}
			if(sessionStorage.getItem('status')==1){
				toastr.success('Employee(s) Succefully Mapped');
					setTimeout(function(){
						
					window.location.reload();	
						
					},2000);
			}
			else{
			toastr.error('Some error occurred');	
			}
			
		
		
	}
	
$(function(){
	
	/**
	* MAPP Employee TO LINE Manager BLOCK
	*
	*
	*
	**/
	
	$('select').select2();
	
$('#checkall').click(function(){

	$('.emparrlist').prop('checked',this.checked);



});
	
	/**
	* MAPP Employee TO LINE Manager BLOCK
	*
	*
	*
	**/
	
	$('#assign').click(function(){
		
		empid=sessionStorage.getItem('employeeid');
        role=$('#assignedrole').val();
		if(role==2){
			rolename='Line-Manager';
			
		}
		else if(role==3){
			rolename="Admin-HR";
		}
		else{
			rolename="Employee";
		}
		
		$.get('{{url('hr/assignerole')}}?empid='+empid+'&role='+role,function(data,status,xhr){
			//come here
			if(xhr.status==200){
				$('#role'+empid).html(rolename);
				currentlmcount=$('#lmcount').text();
		
				vv=eval(currentlmcount+1);
				$('#lmcount').text(vv);
				toastr.success("Role Assignment Successfull");
			}
			
			else{
			toastr.error("Some Error Occurred:"+data);
				
			}
			
		});
		
		
	});
	
	//dropzone
	var myDropzone = new Dropzone("div#my-dropzone-files", { 
	
	url: "{{url('issue/query')}}",
	maxFilesize: 1,
	parallelUploads:1,
	acceptedFiles:'image/*,application/pdf',
	maxFiles:1,
	autoProcessQueue:false
	
	});
	
	myDropzone.on("sending", function(file, xhr, formData) {
  // Will send the filesize along with the file as POST data.

     var template=$('#qtemplate').val();
	 var qtypeid=$('#qtype').val();
	 var userid=sessionStorage.getItem('userid');
	 var token=$('#token').val();
	 
  formData.append("template", template);
  formData.append("qtypeid", 0);
  formData.append("userid", userid);
  formData.append("_token", token);
  formData.append("filesize", file.size);
  
   });
   
   //success upload
   myDropzone.on("success",function(file,response){
	   
			
		   toastr.success('Query Successfully Issued');
	  	 myDropzone.removeFile(file);
  
   });
   
    myDropzone.on("error", function(file,response) {
                   // sessionStorage.setItem("error", 1);
                   // $("#disp").html(response);
                  toastr.error('Some error Occurred:'+response);
				 myDropzone.removeFile(file);
                });
   
	
		 $('#issueother').hide();
		 $('#dropboxpane').hide();
	//jhdhdh
  $('#issueother').click(function(){
	
	myDropzone.processQueue();
	 
	 });
	
	
$('#issuequery').click(function(){
	
	 var template=$('#qtemplate').val();
	 var qtypeid=$('#qtype').val();
	 var userid=sessionStorage.getItem('userid');
	 var token=$('#token').val();
	 
	 $.post('{{url('issue')}}/query',{
		 template:template,
		 qtypeid:qtypeid,
		 userid:userid,
		 _token:token
		 
		 
	 },function (data,status,xhr){
		 console.log(data);
		 if(xhr.status==200){
			 
			 toastr.success('Query Has been Issued to '+sessionStorage.getItem('name'));
			 return 0;
		 }
		 toastr.error('Some Error Occurred');
		 
		 
	 });
	
	
});
//fdjhkfedhfehj

	  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);
 $('#qtype').change(function(){
	 
	 
	 id=$('#qtype').val();
	if(id=="others"){
		 $('#tpane').hide();
		 $('#issuequery').hide();
		 $('#issueother').show();
		 $('#dropboxpane').show();
		 
	}
	else{
		 $('#tpane').show();
	
		 $('#issuequery').show();
		 $('#issueother').hide();
		 $('#dropboxpane').hide();
	 template=$('#'+id).val();
	 
	 $('#qtemplate').val(template);
	 
	}
	 
 });
});

</script>
   

<div class="page container-fluid" >
    <div class="page-header">
  <h1 class="page-title">@if(Auth::user()->role==2) {{Auth::user()->name}}'s Direct Report @else Admin-Hr's Direct Report @endif</h1>
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
          <span class="counter-number font-weight-medium" id="time"></span>
        </div>
      </div>
    </div>
  </div>
</div>
@if(Auth::user()->role==3)
	<div class="col-md-12 col-lg-12 col-xs-12">
<div class="col-lg-6 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix" >
                <div class="pull-xs-left white" style="cursor:pointer;" onclick="url('{{url('employee/list')}}')">
                  <i class="icon icon-circle icon-2x wb-user bg-red-600" aria-hidden="true"></i>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number jobm">{{app('App\Repositories\GlobalSettingRepository')->getlmcount(5)}}</span>
                    <span class="counter-number-related text-capitalize">Employees</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">in Total</div>
                </div>
              </div>
              <!-- End Card -->
            </div>
			<div class="col-lg-6 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white" style="cursor:pointer;" onclick="url('{{url('employee/linemanager')}}')">
                  <i class="icon icon-circle icon-2x wb-clipboard bg-red-600" aria-hidden="true"></i>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number " id="lmcount">{{app('App\Repositories\GlobalSettingRepository')->getlmcount(2)}}</span>
                    <span class="counter-number-related ">Line-Manager(s)</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">in Total</div>
                </div>
              </div>
			  </div>
			  </div>
	
	@endif		
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
		  @if(Auth::user()->role==3)
		
		  
		  <div class="col-md-2">
		  <button class="btn btn-outline btn-success" data-toggle="modal" data-target="#lmlist"><i class="wb wb-clipboard"></i>&nbsp;&nbsp;Map Employee To Line-Manager</button>
		  </div>
		  @endif
		  <br>
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
						@if(Auth::user()->role==3)
						<span style="margin-left:9px;" class="checkbox-custom checkbox-primary">
                          <input class="selectable-all emparrlist" value="{{$employee->id}}" type="checkbox" id="">
                          <label></label>
                        </span>
						@endif
						 <img src="{{url('upload')}}/{{$employee->image}}" alt="{{$employee->name}}">
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
						 
						<br><span>
                          <i class="icon icon-color wb-map" aria-hidden="true"></i>&nbsp;Role: <span id="role{{$employee->id}}"> @if($employee->role==1) Employee @endif @if($employee->role==2) <b>Line-Manager</b> @endif
						  @if($employee->role==3) <b>Admin-HR</b>
						  
						  @endif  
							</span>
                        </span>                        
						<br><span>
                          <i class="icon icon-color wb-user" aria-hidden="true"></i>&nbsp;Report to:
						  @if(Auth::user()->id==$employee->linemanager_id)
							 You 
						  @else
						  <?php $name=app('App\Repositories\EmployeeRepository')->manager($employee->linemanager_id)['name']; ?>
						  {{$name}}
						  @endif
                        </span>
						@if(Auth::user()->role==3)
						<br><span>
                          <i class="icon icon-color fa fa-user-plus" aria-hidden="true"></i>&nbsp;Assign Role: <button type="button" title="Assign Role" class="btn btn-pure btn-primary fa fa-user-plus " data-toggle="modal" data-target="#assignrole"onclick="assignrole('{{$employee->id}}','{{$employee->name}}')"></i></button>
						  					  
                        </span>
						@endif
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
                       </div>
					   @if(Auth::user()->id==$employee->id)
						 @else
                      <div  class="media-right" >
                    <div class="btn-group-vertical" aria-label="Vertical button group" role="group">
					
					<!-- Make LINE MANAGER -->
                  
					<!-- Make LINE MANAGER -->
					
					 <button type="button" data-toggle="modal"  data-target="#viewemp{{$employee->id}}" title="View Profile" class="btn btn-outline btn-primary"><i class="icon wb-eye" aria-hidden="true"></i></button>
					 
					 <a role="button" target="_blank" href="{{url('searchdoc')}}?foldid=gen&q={{str_replace(' ','+',$employee->name)}}" title="View Document" class="btn btn-outline btn-primary"><i class="icon wb-briefcase" aria-hidden="true"></i></a>
                    <button type="button" title="Query Employee" class="btn btn-outline btn-warning" data-target="#querymod" onclick="query('{{$employee->id}}','{{$employee->name}}')" data-toggle="modal" ><i class="icon wb-hammer" aria-hidden="true"></i></button>
					@if(Auth::user()->role==3)
						
						@if($employee->locked==0)
						<?php 
					$type="wb-link";
					
					?>
						@else
						<?php  $type="wb-link-broken"; 
							
					?>	
					@endif
                    <button type="button" id="disable" title="Disable/Enable Employee" class="btn btn-outline btn-danger" onclick="lockemp({{$employee->id}})"><i id="icon{{$employee->id}}" class="icon {{$type}}" aria-hidden="true"></i></button> 
				
				
					@endif
                     </div>
                      </div>
						@endif
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
</div>
  <div class="modal fade modal-3d-sign" id="querymod" aria-labelledby="exampleModalTitle" role="dialog"  aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="title"></h4>
                        </div>
                        <div class="modal-body" id="query">
                       
						  <form>
                            <div class="row">
							<div class="col-xl-4 col-xs-12">
							<b>Select Query Types:</b>
							</div>
                              <div class="col-xs-12 col-xl-8 form-group">
							     @if(count($querytype)>0)
									 @foreach($querytype as $types) 
							     <input type="hidden" value="{{$types->template}}" id="{{$types->id}}"/>
								 @endforeach
								  @endif
								  
						         <select id="qtype" data-plugin="select2" type="text" class="form-control" >
								  <option >-Select query Type--</option>
								
								 @if(count($querytype)>0)
									 @foreach($querytype as $types)
								
								  <option value="{{$types->id}}">{{$types->title}}</option>
									@endforeach
								  @endif
								  <option value="others">Others</option>
								
								 </select>
								
                               
                              </div> 

							  <div class="col-xs-12 col-xl-12 form-group" id="tpane">
							      <textarea  data-provide="markdown" data-iconlibrary="fa" data-height="400px" class="md-input" rows="5"  style=""  id="qtemplate">
									</textarea>
							    
						       
								
                               
                              </div>
							   <div class="col-xs-12 col-xl-12 form-group" id="dropboxpane">
							   <b>Upload Query Letter:</b><br>
							        <div style="" class="dropzone" id="my-dropzone-files" name="my-dropzone-files">

                                                

                                            </div>
                               
                              </div>
							  
                              </div>
                          </form>
							
						
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="issuequery" class="btn btn-primary">Issue Query</button>  
						  <button type="button" id="issueother" class="btn btn-primary">Issue Query</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  <!-- ASSIGN ROLE -->
				  <div class="modal fade modal-3d-flip-vertical" id="assignrole" aria-labelledby="exampleModalTitle" role="dialog"  style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Assign Role to <span id="empname"></span></h4>
                        </div>
                        <div class="modal-body">
                          <br><span>Select Role</span>
						  <select id="assignedrole" data-plugin="select2" class="form-control">
						  <option value="1">Employee</option>
						  <option value="2">Line-Manager</option>
						  <option value="3">Admin-HR</option>
						  
						  </select>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="assign">Assign</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  <!-- ASSIGN ROLE -->
				  
				  <!--MAP EMPLOYEE TO LINE-MANAGER -->
				  <div class="modal fade modal-rotate-from-bottom" id="lmlist" aria-labelledby="exampleModalTitle" role="dialog"  aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Map Linemanager to Employee</h4>
                        </div>
                        <div class="modal-body">
                          <div class="modal-body">
                          <br><span>Select Line Manager</span>
						  <select id="linemanager">
						  @if(count($lms)>0)
						  @foreach($lms as $lm)
						  <option value="{{$lm->id}}">{{$lm->name}}</option>
						  @endforeach
						  @else
							<option>-No Line Manager-</option>
						   
						  @endif
						  </select>
                        </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" onclick="mapemployee()" class="btn btn-primary">Map Selected Employee</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  <!--MAP EMPLOYEE TO LINE-MANAGER -->
				  
				  
@endsection