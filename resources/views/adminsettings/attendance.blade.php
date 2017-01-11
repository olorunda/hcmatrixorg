@extends('layouts.app')

@section('content')
 
 
<script>

//query employee

function query(id,name){
	
	$('#title').text('Query '+name);
	sessionStorage.setItem('name',name);
	sessionStorage.setItem('userid',id);
}
	

//query ends
//date search 
function datesearch(type=0){
	
	
	startdate=$('#startdate').val();
	starttime=$('#starttime').val();
	enddate=$('#enddate').val();
	endtime=$('#endtime').val();
	empname=$('#q').val();

	if(empname!=""){
		addionalsearch="&q="+empname;
	}
	else{
		addionalsearch="";
	}
	if(startdate=="" || starttime=="" || enddate=="" || endtime==""){
		toastr.error("Please fill In all fields");
		
		return ;
	}
	
	if(type==1){
		
	window.location='{{url('attendance/timesearch')}}?startdate='+startdate+'&enddate='+enddate+'&starttime='+starttime+'&enddtime='+endtime+'&type=1'+addionalsearch;

	return ;
	}
	window.location='{{url('attendance/timesearch')}}?startdate='+startdate+'&enddate='+enddate+'&starttime='+starttime+'&enddtime='+endtime+'&type=0'+addionalsearch;
}


$(function(){
	
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
<input type="hidden" value="{{csrf_token()}}" id="token" />
<div class="page-header">
  <h1 class="page-title">Attendance Management</h1>
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
          <span class="counter-number font-weight-medium" id="time">08:32:56 am</span>
        </div>
      </div>
    </div>
  </div>
  
</div>

			<div class="col-lg-6 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-30">
                <div class="counter counter-md text-xs-left">
                  <div class="counter-label text-uppercase m-b-5"><b>Total Early Employee(s) Today</b></div>
                  <div class="counter-number-group m-b-10">
                    <span class="counter-number">{{$attstat['early']}}</span>
                  </div>
                  <div class="counter-label">
                    <div class="progress progress-xs m-b-10">
                      <div class="progress-bar progress-bar-danger bg-blue-600" aria-valuenow="70.3" aria-valuemin="0" aria-valuemax="100" style="width: 70.3%" role="progressbar">
                        <span class="sr-only">1%</span>
                      </div>
                    </div>
                    <div class="counter counter-sm text-xs-left">
                      <div class="counter-number-group">
                        <span class="counter-icon blue-600 m-r-5"><i class="wb-graph-up"></i></span>
                        <span class="counter-number">{{round(($attstat['early']/$attstat['total'])*100,1)}}%</span>
                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Card -->
            </div>
			<div class="col-lg-6 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-30">
                <div class="counter counter-md text-xs-left">
                  <div class="counter-label text-uppercase m-b-5"><b>Total Late Employee(s) Today</b></div>
                  <div class="counter-number-group m-b-10">
                    <span class="counter-number">{{$attstat['late']}}</span>
                  </div>
                  <div class="counter-label">
                    <div class="progress progress-xs m-b-10">
                      <div class="progress-bar progress-bar-info bg-red-600" aria-valuenow="70.3" aria-valuemin="0" aria-valuemax="100" style="width: 70.3%" role="progressbar">
                        <span class="sr-only">70.3%</span>
                      </div>
                    </div>
                    <div class="counter counter-sm text-xs-left">
                      <div class="counter-number-group">
                        <span class="counter-icon blue-600 m-r-5"><i class="wb-graph-up"></i></span>
                        <span class="counter-number">{{round(($attstat['late']/$attstat['total'])*100,1)}}%</span>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Card -->
            </div>
			 
<div class="col-md-12 col-xs-12 col-md-12" >
<div class="panel " >
        <div class="panel-body container-fluid">
          <div class="row row-lg">
            

            <div class="col-xl-12 col-xs-12">
              <!-- Example Table Selectable -->
	<div class="col-md-8">
	</div>		  
<div class="col-md-4">

<div class="input-group">
                   
                    <input value="{{old('q')}}" id="q" name="q" class="form-control" type="text" name="round-input-control" placeholder="Enter Employee number or name">  
                    
                  </div></div><div class="col-md-12" style="margin-top:30px;"></div>
              <div class="example-wrap">
			  	<div class="col-md-2"><b>Date Range :</b></div>
                <p id="basicExample">
				
				<div class="col-md-5" style="margin-left:-40px">
			
				<div class="input-group  " >
                    <span class="input-group-addon">
                      <i class="icon wb-calendar" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control datepair-date datepair-start" id="startdate" data-plugin="datepicker">
                 
                    <span class="input-group-addon">
                      <i class="icon wb-time" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control datepair-time datepair-start ui-timepicker-input" id="starttime" data-plugin="timepicker" autocomplete="off">
                  </div>
                  </div>
				  
				  <div class="col-xl-1">
				  to
				  </div>
				  <div class="col-xl-5">
				  <div class="input-group col-xl-5" style="margin-top:-23px; margin-left:15px; ">
                   
                    <span class="input-group-addon">
                      <i class="icon wb-calendar" aria-hidden="true"></i>
                    </span>
                    <input id="enddate" type="text" class="form-control datepair-date datepair-end" name="end" data-plugin="datepicker">
                 
                    <span class="input-group-addon">
                      <i class="icon wb-time" aria-hidden="true"></i>
                    </span>
                    <input id="endtime" type="text" class="form-control datepair-time datepair-end ui-timepicker-input" data-plugin="timepicker" autocomplete="off">
                 
                    <span style="cursor:pointer;" onclick="datesearch()" title="Search" class="input-group-addon">
                    
					<i class="fa fa-search "></i>
                    </span>
					<span style="cursor:pointer;" onclick="datesearch(1)" title="Export to Excel" class="input-group-addon"><i class="fa fa-file-excel-o"></i>
                    
                    </span>
                  </div>
                  </div>
</p><div class="col-md-12" style="margin-bottom:40px;"></div>

                <div class="example">
				  <div class="pull-right">About <b>{{$attendances->total()}}</b> result(s)</div>
				  <div class="col-md-12" style="margin-top:10px;"></div>
                  <table class="table table-hover" data-plugin="selectable" data-row-selectable="true">
                    <thead>
                      <tr class="bg-blue-grey-100">

                        <th>
                          EMPID
                        </th>
                        <th>
                          NAME
                        </th>
                        <th class="hidden-sm-down">
                          CLOCK IN TIME
                        </th>
                        <th class="hidden-sm-down">
                          CLOCK OUT TIME
                        </th> 
						<th class="hidden-sm-down">
                          STATUS
                        </th>
						<th class="hidden-sm-down">
                          ACTION
                        </th>
                      </tr>
                    </thead>
                    <tbody>
					
					@if(count($attendances)>0)
					 @foreach($attendances as $attendance)
                    
                     <tr>
					       <td>{{$attendance->emp_num}}</td>
                        <td>{{$attendance->name}}</td>
                        <td class="hidden-sm-down">
                        <span class="text text-success">
						<b>{{$attendance->created_at}}</b>
						</span>
                        </td>
                        <td class="hidden-sm-down">
						
                        <span class="text text-danger">
						<b>@if($attendance->clockout_time=="") Nill @else {{$attendance->clockout_time}} @endif</b>
					   </span>
                        </td>
						<td>@if($attendance->status=="")
						{{$attendance->status}}
						<?php $latestat=app('App\Repositories\GlobalSettingRepository')->checkearly($attendance->created_at,$attendance->status,$attendance->id,$attendance->ids);  ?>
						@else
							<?php $latestat=$attendance->status; ?>
						@endif
						<span class="tag @if($latestat=='Early') tag-success @else tag-danger @endif">{{$latestat}}</span>
						</td>
						<td>
						 <button type="button" title="Query Employee" class="btn btn-outline btn-warning" data-target="#querymod" onclick="query('{{$attendance->id}}','{{$attendance->name}}')" data-toggle="modal" ><i class="icon wb-hammer" aria-hidden="true"></i></button>
						</td>
                      </tr>
					  @endforeach
					  @else
						<tr>
					<td>
					</td><td>
					</td><td>
					</td>
					<td >
						<b style="font-size:20px;" class="text-success"> No Attendance Report For Today Yet</b>
						</td>

						</tr>
					  @endif
					  
                    </tbody>
                  </table>
				 
				  {{$attendances->render()}}
				
                </div>
              </div>
              <!-- End Example Table Selectable -->
            </div>
          </div>
        </div>
      </div>
</div>
<!-- SET START OF BUSINESS & CLOSE OF BUSINESS -->
<!-- FISCAL MODAL ENDS -->
<!-- QUERY MODAL STARTS -->

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
	
<!-- QUERY MODAL ENDS-->
<!-- SET START OF BUSINESS & CLOSE OF BUSINESS -->

	  @endsection
