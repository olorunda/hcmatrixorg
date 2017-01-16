@extends('layouts.app')

@section('content')

<?php $month=['1'=>'Janunary','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December']; ?>
<script>
$(function(){	
	/****
	*
	*
	****/
	
	$('#jobrole').change(function(){
							
							
			jobrole=$('#jobrole').val();
							
			$.get('{{url('getleaveday')}}',{
				jobrole:jobrole
								
			},function(data,status,xhr){
							
				if(xhr.status==200){
										
										
					$('#leaveday').val(data);
					
			}
								
		});
							
	});
						
					
						
						$('#saveattach').click(function(){
							
							jobrole=$('#jobrole').val();
							leaveday=$('#leaveday').val();
							
							$.get('{{url('attachleave/role')}}',{
								jobrole:jobrole,
								leaveday:leaveday
								
							},function(data,status,xhr){
								
								if(xhr.status==200){
									
									
									toastr.success("Leave Settings Save Successfully");
								return ;
								}
								toastr.error("Some error Occurred");
								
								
							});
							
							
							
						});
						
						
	/**
	*
	*IMPORT EMPLOYEE RECORD
	*
	*
	***/
	var myDropzone = new Dropzone("div#my-dropzone-files", { 
	
	url: "{{url('import/emloyee')}}",
	maxFilesize: 1,
	parallelUploads:1,
	acceptedFiles:'.csv',
	maxFiles:1,
	autoProcessQueue:false
	
	});
	
	myDropzone.on("sending", function(file, xhr, formData) {
  // Will send the filesize along with the file as POST data.

   token=$('#token').val();
  formData.append("_token", token);
  formData.append("filesize", file.size);
  
   });
   
   //success upload
   myDropzone.on("success",function(file,response){
	   
			
		   toastr.success('Import Successfull');
	  	 myDropzone.removeFile(file);
  
   });
   
    myDropzone.on("error", function(file,response) {
                   // sessionStorage.setItem("error", 1);
                   // $("#disp").html(response);
                  toastr.error('Some error Occurred:'+response);
				 myDropzone.removeFile(file);
                });
   
	//jhdhdh
  $('#importemployee').click(function(){
	
	myDropzone.processQueue();
	 
	 });

	
	/**
	*
	*IMPORT EMPLOYEE RECORD ENDS
	*
	*
	***/
	//modify template
	$('#modifyqtemplate').click(function(){
	
	 var template=$('#qtemplate1').val();
	 //back here
	 var title=$('#qtitledeit').val();
	 var qtypeid=$('#qtype1').val();
	
	 var token=$('#token').val();
	 
	 $.post('{{url('modify')}}/query',{
		 template:template,
		 title:title,
		 qtypeid:qtypeid,
		 _token:token
		 
	 },function (data,status,xhr){
		 console.log(data);
		 if(xhr.status==200){
			 
			 toastr.success('Query Has been Modified Successfully');
			 		toastr.success("Query Template Successfully Saved");
					
			setTimeout(function(){
				
				window.location.reload();
				
			},2000);
		 }
		 toastr.error('Some Error Occurred');
		 
		 
	 });
	
	
});
	//come here
	//save query template handler
	$('#saveqtemplate').click(function(){
		
		title=$('#qtype').val();
		
		template=$('#qtemplate').val();
		if(template=="" || title==""){
			toastr.error("Some Fields are Empty");
			return ;
		}
		$.get('{{url('savequery')}}?title='+title+'&template='+template,function(data,status,xhr){
			
			if(xhr.status==200){
				toastr.success("Query Template Successfully Saved");
			
			setTimeout(function(){
				
				window.location.reload();
				
			},2000);
			
			}
			else{
				toastr.error("Some Error Occurred:"+data);
			}
			
		});
		
		
	});
	
	
	$('#edit').hide();
	$('#add').hide();
	$('#saveqtemplate').hide();
	$('#actiontype').change(function(){
		
		
		atype=$('#actiontype').val();
		if(atype=="add"){
			$('#add').show();
			$('#edit').hide();
			$('#modifyqtemplate').hide();
			$('#saveqtemplate').show();
				
		}
		else{
			$('#edit').show();
			$('#add').hide();
			
			$('#modifyqtemplate').show();
			$('#saveqtemplate').hide();
		}
	});
	
	/** LEAVE FUNCTION REMODED **/
	
	$('#modifyqtemplatel').click(function(){
	
	 var templatel=$('#qtemplate1l').val();
	 //back here
	 var titlel=$('#qtitledeitl').val();
	 var qtypeidl=$('#qtype1l').val();
	
	 var token=$('#token').val();
	 
	 $.post('{{url('modify')}}/leave',{
		 daynum:templatel,
		 title:titlel,
		 qtypeidl:qtypeidl,
		 _token:token
		 
	 },function (data,status,xhr){
		 console.log(data);
		 if(xhr.status==200){
			 
			 toastr.success('Leave Has been Modified Successfully');
			 		
			setTimeout(function(){
				
				window.location.reload();
				
			},2000);
			return ;
		 }
		 toastr.error('Some Error Occurred');
		 
		 
	 });
	
	
});
	//come here
	//save query template handler
	$('#saveqtemplatel').click(function(){
		
		title=$('#qtypel').val();
		
		template=$('#qtemplatel').val();
		if(template=="" || title==""){
			toastr.error("Some Fields are Empty");
			return ;
		}
		$.get('{{url('saveleave')}}?title='+title+'&daynum='+template,function(data,status,xhr){
			
			if(xhr.status==200){
				toastr.success("Leave Successfully Saved");
			
			setTimeout(function(){
				
				window.location.reload();
				
			},2000);
			
			}
			else{
				toastr.error("Some Error Occurred:"+data);
			}
			
		});
		
		
	});
	$('#editps').hide();
	$('#savehols').hide();
	$('#editl').hide();
	$('#addl').hide();
	$('#saveqtemplatel').hide();
	$('#actiontypel').change(function(){
		
		
		atype=$('#actiontypel').val();
		if(atype=="add"){
			$('#addl').show();
			$('#editl').hide();
			 $('#savemodhols').hide();
			$('#modifyqtemplatel').hide();
			$('#saveqtemplatel').show();
			$('#savehols').hide();
				
	$('#addps').hide();	
		}
		else if(atype=="edit"){
			$('#editl').show();
			$('#addl').hide();
			$('#editps').hide();
			 $('#savemodhols').hide();
	//am here ..start here ...now after meeting .....
			$('#addps').hide();
			$('#modifyqtemplatel').show();
			$('#saveqtemplatel').hide();
			$('#savehols').hide();
		}
		else if(atype=="pub"){
			$('#editl').hide();
			$('#addl').hide();
			$('#editps').hide();
			$('#addps').show();
			$('#editps').hide();
			 $('#savemodhols').hide();
			$('#modifyqtemplatel').hide();
			$('#saveqtemplatel').hide();
			$('#savehols').show();
		}
		else{
			$('#editl').hide();
			$('#addl').hide();
			$('#savehols').hide();
			 $('#savemodhols').show();
			$('#addps').hide();
			$('#editps').show();
			$('#modifyqtemplatel').hide();
			$('#saveqtemplatel').hide();
			
		}
		
					
	});
	//save job 
	$('#savemodhols').click(function(){
	
		modto=$('#modholto').val();
		modfrom=$('#modholfrom').val();
		modholname=$('#modholname').val();
		holid=$('#qtype1lp').val();
		token=$('#token').val();
		$.post('{{url('mod/holiday')}}',{
			
			modto:modto,
			modfrom:modfrom,
			modholname:modholname,
			holid:holid,
			_token:token
			
			
		},function(data,status,xhr){
			
			if(xhr.status==200){
				
				
				toastr.success('Modification Successfull');
				setTimeout(function(){
					
					window.location.reload();
					
				},2000);
				return ;
			}
			toastr.error("Some Error Occurred:"+data);
			
			
		});
		
		
	});
	
	
	
	
	//hols aDD BTN
	$('#savehols').click(function(){
		holname=$('#holname').val();
		holfrom=$('#holfrom').val();
		holto=$('#holto').val();
		
		$.get('{{url('save/holiday')}}?holname='+holname+'&holfrom='+holfrom+'&holto='+holto,function(data,status,xhr){
			
			if(xhr.status==200){
				
				toastr.success("Holidays Added");
				
				setTimeout(function(){
					
					window.location.reload();
					
				},2000);
				return;
			}
			
			toastr.error("Some error Occurred");

		});
		
		
	});
	
	$('#addps').hide();
	//edit temp
	 $('#qtype1l').change(function(){
	 
	 
	 id=$('#qtype1l').val();
	if(id==0){
			 $('#qtemplate1l').prop("disabled",true);
		
	       $('#qtitledeitl').prop("disabled",true);
	       $('#modifyqtemplatel').prop("disabled",true);
	return ;
	}
		
		
	 template=$('#'+id+'l').val();
	 
	$('#qtitledeitl').prop("disabled",false);
	
	       $('#modifyqtemplatel').prop("disabled",false);
	$('#qtitledeitl').val($('#qtype1l option:selected').text() );
	 $('#qtemplate1l').prop("disabled",false);
	 $('#qtemplate1l').val(template);
	 
	
	 
 }); 
 $('#savemodhols').hide();
 //modify public holiday
 $('#qtype1lp').change(function(){
	 
	 
	 id=$('#qtype1lp').val();
	if(id==0){
			 $('#modholname').prop("disabled",true);
		
	       $('#modholfrom').prop("disabled",true);
	       $('#modholto').prop("disabled",true);
	return ;
	}
		
		
	 holfrom=$('#phfrom'+id).val();
	 holto=$('#phto'+id).val();
	  $('#modholname').prop("disabled",false);
		
	       $('#modholfrom').prop("disabled",false);
	       $('#modholto').prop("disabled",false);
		   
		 $('#modholname').val($('#qtype1lp option:selected').text());
		
	       $('#modholfrom').val(holfrom);
	       $('#modholto').val(holto);
		   
	
	 
 });
 
 

	/** LEAVE FUNCTION REMODED ENDS **/
	
	  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);
	 
	//edit temp
	 $('#qtype1').change(function(){
	 
	 
	 id=$('#qtype1').val();
	if(id==0){
			 $('#qtemplate1').prop("disabled",true);
		
	       $('#qtitledeit').prop("disabled",true);
	       $('#modifyqtemplate').prop("disabled",true);
	return ;
	}
		
		
	 template=$('#'+id).val();
	$('#qtitledeit').prop("disabled",false);
	
	       $('#modifyqtemplate').prop("disabled",false);
	$('#qtitledeit').val($('#qtype1 option:selected').text() );
	 $('#qtemplate1').prop("disabled",false);
	 $('#qtemplate1').val(template);
	 
	
	 
 });
	
	
	//
		$('#actiontype').change(function(){
			
			
			
			
		});
	
						//get fiscal
						$('#getfiscal').click(function(){
							$.get('{{url('getfiscal')}}',function(data,status,xhr){
								
								if(xhr.status==200){
									
						$("#startmont").select2("trigger", "select", {
						data: { id: data.start_month }
								});
								
						$("#graceperiod").select2("trigger", "select", {
						data: { id: data.grace }
								});

						$("#review").select2("trigger", "select", {
						data: { id: data.end_month }
								});
									
							
									
								}
								
							});
							
							
							
						});
				
						//save fiscal
						$('#savefiscal').click(function(){
							
							startmont=$('#startmont').val();
								grace=$('#graceperiod').val();
								endmonth=$('#review').val();
								token=$('#token').val();
								
								$.post('{{url('savefiscal')}}',{
									
									startmont:startmont,
									grace:grace,
									endmonth:endmonth,
									_token:token
									
									
								},function(data,status,xhr){
									
									if(xhr.status==200){
										toastr.success('Settings Saved');
									}
									else{
										toastr.error('Some Error Occurred:'+data);
									}
									
								});
								
							
						});
						
						
	});					
</script>
<input type="hidden" value="{{csrf_token()}}" id="token" />
<div class="page-header">
  <h1 class="page-title">All Settings</h1>
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


<div class="col-md-6 col-xs-12">
          <!-- Card -->
		     <div class="card card-block p-30 bg-brown-600">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Employee</span>
                <span class="counter-number-related text-capitalize">Management</span>
              </div>
              <div class="counter-label text-capitalize"><a href="{{url('employee/list')}}" class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></a>
			  &nbsp;
			  <a href="javascript:void(0)" data-toggle="modal" data-target="#importemp" title="Import Employee" class="btn btn-icon btn-danger btn-round"><i class="fa fa-upload" aria-hidden="true"></i></a></div>
            </div>
          </div>
          </div>
		  
		  <div class="col-md-6 col-xs-12">
          <div class="card card-block p-30 bg-yellow-600">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Job/Department</span>
                <span class="counter-number-related text-capitalize">Settings</span>
              </div>
              <div class="counter-label text-capitalize"><a href="{{url('hr/jobdepsettings')}}" class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></a></div>
            </div>
          </div>
		  
		  
          <!-- End Card -->
        </div>
		<div class="col-md-6 col-xs-12">
          <!-- Card -->
          <div class="card card-block p-30 bg-red-600">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Leave</span>
                <span class="counter-number-related text-capitalize">Settings</span>
              </div>
              <div class="counter-label text-capitalize"><button data-toggle="modal" data-target="#leave" type="button" class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></button>
			  <button data-toggle="modal" data-target="#attachtorole" type="button" class="btn btn-icon btn-warning btn-round"><i class="icon  wb-plus-circle" aria-hidden="true"></i></button></div>
            </div>
          </div>
          <!-- End Card -->
        </div>
		<div class="col-md-6 col-xs-12">
          <!-- Card -->
          <div class="card card-block p-30 bg-green-600">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Fiscal</span>
                <span class="counter-number-related text-capitalize">Year Settings</span>
              </div>
              <div class="counter-label text-capitalize"><button data-toggle="modal" data-target="#fiscalyears" type="button" id="getfiscal"  class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></button></div>
            </div>
          </div>
		 
          <!-- End Card -->
        </div>
		<div class="col-md-6 col-xs-12">
          <!-- Card -->
          <div class="card card-block p-30 bg-purple-600">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Disciplinary</span>
                <span class="counter-number-related text-capitalize">Settings</span>
              </div>
              <div class="counter-label text-capitalize"><button data-toggle="modal" data-target="#querysettings" id="qsett" type="button" class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></button></div>
            </div>
          </div>
          <!-- End Card -->
        </div>
		<div class="col-md-6 col-xs-12">
          <!-- Card -->
          <div class="card card-block p-30 bg-blue-600">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Pilot Goal</span>
                <span class="counter-number-related text-capitalize">Settings</span>
              </div>
              <div class="counter-label text-capitalize"><button data-toggle="modal" data-target="#pilotgoals" type="button" class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></button></div>
            </div>
          </div>
          <!-- End Card -->
        </div>
		
		<div class="col-md-6 col-xs-12">
          <!-- Card -->
          <div class="card card-block p-30 bg-green-800">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Payroll</span>
                <span class="counter-number-related text-capitalize">Settings</span>
              </div>
              <div class="counter-label text-capitalize"><button data-toggle="modal" data-target="" type="button" class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></button></div>
            </div>
          </div>
          <!-- End Card -->
        </div>	
		<div class="col-md-6 col-xs-12">
          <!-- Card -->
          <div class="card card-block p-30 bg-green-800">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Attendance</span>
                <span class="counter-number-related text-capitalize">Settings</span>
              </div>
              <div class="counter-label text-capitalize"><button data-toggle="modal" data-target="#setbiztime" type="button" class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></button></div>
            </div>
          </div>
          <!-- End Card -->
        </div>
		
		<div class="col-md-6 col-xs-12">
          <!-- Card -->
          <div class="card card-block p-30 bg-red-800">
            <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-settings" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-xs-left">
              <div class="counter-number-group">
                <span class="counter-number">Notifications & Alert</span>
                <span class="counter-number-related text-capitalize">Settings</span>
              </div>
              <div class="counter-label text-capitalize"><button data-toggle="modal" data-target="#notification" type="button" class="btn btn-icon btn-warning btn-round"><i class="icon wb-settings" aria-hidden="true"></i></button></div>
            </div>
          </div>
          <!-- End Card -->
        </div>
		

<div class="modal fade modal-3d-flip-horizontal modal-success" id="importemp" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Import Employee</h4>
                        </div>
                        <div class="modal-body">
                         <div class="col-xs-12 col-xl-12 form-group" id="dropboxpane">
							   <b>Upload Employee Record:</b><br>
							        <div style="" class="dropzone" id="my-dropzone-files" name="my-dropzone-files">

                                                

                                            </div>
                               
                              </div>
						
						
                        </div>
                        <div class="modal-footer">
                         
                          <button type="button" id="importemployee" class="btn btn-primary"><i class="fa fa-upload" ></i>&nbsp;&nbsp;Import</button>
                        </div>
                      </div>
                    </div>
                  </div>
	
<!-- MODALS BEGINS -->
 <!-- FISCAL MODAL STARTS -->
<div class="modal fade modal-success modal-rotate-from-left" id="fiscalyears" aria-labelledby="exampleModalTitle" role="dialog"   style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Set Fiscal Year</h4>
                        </div>
                        <div class="modal-body">
                        <p>Start Month:</p>
						<select id="startmont" data-plugin="select2" >
 						@foreach($month as $id=>$months)
						<option value="{{$id}}">{{$months}}</option>
						@endforeach
						
						</select><br>
						 <p>Review:</p>
						<select id="review" data-plugin="select2" >
 						
						<option value="1">Every Month</option>
						<option value="2">Every 2 Months</option>
						<option value="3">Every 3 Months</option>
						<option value="4">Every 4 Months</option>
						<option value="6">Every 6 Months</option>
						<option value="12">Every Year</option>
						
						
						</select>
						<br>
						 <p>Grace Period:</p>
						<select id="graceperiod" data-plugin="select2" >
 						
						<option value="1">One Week</option>
						<option value="2">Two Weeks</option>
						<option value="3">Three Weeks</option>
						<option value="4">Four Weeks</option>
						
						
						</select>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="savefiscal" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
<!-- FISCAL MODAL ENDS -->
<div class="modal fade modal-info modal-rotate-from-left" id="querysettings" aria-labelledby="exampleModalTitle" role="dialog"   style="display: none;" aria-hidden="true">

                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Add Query Template</h4>
                        </div>
                        <div class="modal-body">
                        <p>Action Type</p>
						<select data-plugin="select2" id="actiontype">
						
						<option >--Select Action--</option>
						<option value="edit">Edit</option>
						<option value="add">Add</option>
						
						</select>
						<br>
						
						<!-- aDD aCTION -->
						<div id="add">
						 <p>Query Type</p>
						<input type="text" placeholder="Enter query Type .." class="form-control" id="qtype" /><br>
						
						<p>Template</p>
						 <textarea  data-provide="markdown" data-iconlibrary="fa" data-height="400px" class="md-input" rows="5"  style=""  placeholder="Enter Query Template" id="qtemplate">
									</textarea>
									<br>
						
						</div>
						<!-- EDIT ACTION -->
						<div id="edit">
						
						<div class="col-xl-4 col-xs-12">
							<b>Select Query Types:</b>
							</div>
                              <div class="col-xs-12 col-xl-8 form-group">
							     @if(count($querytype)>0)
									 @foreach($querytype as $types) 
							     <input type="hidden" value="{{$types->template}}" id="{{$types->id}}"/>
								 @endforeach
								  @endif
								  
						         <select id="qtype1" data-plugin="select2" type="text" class="form-control" >
								  <option value="0">-Select query Type--</option>
								
								 @if(count($querytype)>0)
									 @foreach($querytype as $types)
								
								  <option value="{{$types->id}}">{{$types->title}}</option>
									@endforeach
								  @endif
								 </select>
								


						</div>
						
							<b>Title:</b><br>
							 
							      <input type="text" id="qtitledeit" class="form-control" disabled>
							    
						       <br>
								
							  <div class="" id="tpane">
							      <textarea disabled data-provide="markdown" data-iconlibrary="fa" data-height="400px" class="md-input"  rows="5"  style=""  id="qtemplate1">
									</textarea>
							    
						       
								
                               
                              </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="saveqtemplate" class="btn btn-primary">Save changes</button>
						  <button type="button" id="modifyqtemplate" class="btn btn-primary" disabled>Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>

<!-- QUERY SETTINGS ENDS -->
<!-- MODALS ENDS -->

@include('partials.leavesetting')
@include('partials.notificationsetting')
@include('partials.pilotsetting')
@include('partials.attendancesetting')

<!-- here modal importemp -->
	@endsection
<!-- QUERY SETTINGS START -->
