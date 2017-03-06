@extends('layouts.app')

@section('content')
<script>
	 
	function movefile(){
		
		 
		if($('.doclist').is(':checked')){
			
		}
		else{
			
			toastr.error('{{_t('Please Select Docment(s) to Move')}}');
			return ;
		}
		
		var foldid=$('#folderid').val();
	    var valuearr=$('.doclist:checked').map(function() {return this.value;}).get();
		console.log(valuearr);
		var i=0;
		//$.each(valuearr,function(index,element){
			
			for( i=0; i<valuearr.length; i++){
				//console.log(valuearr[i]);
			$.get('{{url('move/document')}}?id='+valuearr[i]+'&destination='+foldid,function(data,status,xhr){
				
				if(xhr.status==200){
					
					sessionStorage.setItem('status',1);
				}
				else{
					sessionStorage.setItem('status',0);
				
				}
				
			
			
			}); 
				}
			if(sessionStorage.getItem('status')==1){
				toastr.success('{{_t('Document Successfully Moved')}}');
					setTimeout(function(){
						
					window.location.reload();	
						
					},2000);
			}
			else{
			toastr.error('{{_t('Some error occurred')}}');	
			}
			
		
		
	}
function deletedocs(){
		
		 
		if($('.doclist').is(':checked')){
			
		}
		else{
			
			toastr.error('{{_t('Please Select Docment(s) to delete')}}');
			return ;
		}
	    var valuearr=$('.doclist:checked').map(function() {return this.value;}).get();
		console.log(valuearr);
		var i=0;
		//$.each(valuearr,function(index,element){
			
			for( i=0; i<valuearr.length; i++){
				//console.log(valuearr[i]);
			$.get('{{url('delete/document')}}?id='+valuearr[i],function(data,status,xhr){
				
				if(xhr.status==200){
					
					sessionStorage.setItem('status',1);
				}
				else{
					sessionStorage.setItem('status',0);
				
				}
				
			
			
			}); 
				}
			if(sessionStorage.getItem('status')==1){
				toastr.success('{{_t('Document Successfully Deleted')}}');
					setTimeout(function(){
						
					window.location.reload();	
						
					},2000);
			}
			else{
			toastr.error('{{_t('Some error occurred')}}');	
			}
			
		
		
	}

	


$(function (){
	
	 
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

 

 $('.selectable-all').click(function(){

	$('input:checkbox').prop('checked',this.checked);



});


//upload document 
 //handle csv upload parsing
	 var myDropzone = new Dropzone("div#my-dropzone-files", { 
	
	url: "{{url('document/upload')}}",
	maxFilesize: 1,
	parallelUploads:1,
	acceptedFiles:'.pdf,.csv,.xls,.doc,.docx',
	maxFiles:1,
	autoProcessQueue:false
	
	});
	
	myDropzone.on("sending", function(file, xhr, formData) {
  // Will send the filesize along with the file as POST data.

      
	 var token=$('#token').val();
	 var name=$('#docname').val();
	 
	  
  formData.append("_token", token);
  formData.append("filesize", file.size);
  formData.append("name", name);
formData.append("folderid", '{{$_GET['foldid']}}');
  
   });
   
   //success upload
   myDropzone.on("success",function(file,response){
	  

	  	 myDropzone.removeFile(file);
		 
		 if(response=="Success"){
			 		   toastr.success('{{_t('Document Uploaded Successfully')}}:'+response);
		   
			 
			 setTimeout(function(){
				 
				 @if(Auth::user()->role==2)
					 window.location="{{url('view')}}/document?foldid={{$_GET['foldid']}}&foldername={{$_GET['foldername']}}&type=me";
				 
				 @else
					 
				window.location.reload(); 
				
				@endif
				 
			 },2000);
			 
		 }
		 else{
			 console.log(response);
		 toastr.error('{{_t('Error Uploading Document')}}:'+response);
		   
		 }
  
   });
   
    myDropzone.on("error", function(file,response) {
                   // sessionStorage.setItem("error", 1);
                   // $("#disp").html(response);
                  toastr.error('{{_t('Some error Occurred')}}: '+response);
				 myDropzone.removeFile(file);
                });
   
	
	 
	 $('#uploaddocument').click(function(){
		 
		 var token=$('#token').val();
	 var name=$('#docname').val();
	 if(name==""){
		 
		 toastr.error("{{_t('Please Fill in the document name')}}")
	 }
		myDropzone.processQueue(); 
		 
	 });
	


});


</script>
<input type="hidden" value="{{csrf_token()}}" id="token" />
		  <div class="modal fade modal-3d-flip-horizontal modal-success" id="adddocument" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">{{_t('Upload Document')}}</h4>
                        </div>
                        <div class="modal-body">
						<div class="col-xs-12 col-xl-12 form-group">
						{{_t('Document Name')}} :<br>
						<input type="text" class="form-control" id="docname" />
						</div>
						<br>
                         <div class="col-xs-12 col-xl-12 form-group" id="dropboxpane">
							   <b>{{_t('Upload Document')}}:</b><br>
							        <div style="" class="dropzone" id="my-dropzone-files" name="my-dropzone-files">

                                                

                                            </div>
                               
                              </div>
						
						
                        </div>
                        <div class="modal-footer">
                         
                          <button type="button" id="uploaddocument" class="btn btn-primary"><i class="fa fa-upload" ></i>&nbsp;&nbsp;{{_t('Upload')}}</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  
				  
<div class="page-header">
  <h1 class="page-title">@if(isset($_GET['foldername'])) {{$_GET['foldername']}} @endif</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">{{_t('Home')}}</a></li>
    <li class="breadcrumb-item active">{{_t('You are Here')}}</li>
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
          <div class="panel panel-success panel-line">
            <div class="panel-heading">
            <div class="panel-title "><div style="margin-top:-13px;" class="col-md-4"> <div class="form-group">
			<form method="get" action="{{url('searchdoc')}}">
                    <input type="hidden" name="foldid"  value="{{$_GET['foldid']}}">
                    @if(isset($_GET['type']) || session('type')=='me')
						<?php session(['type'=>'me']) ?>
                    <input type="hidden" name="mysearch"  value="mysearch">
						
						@endif
						
                  <div class="input-group">
				  
                    <input required type="text" name="q" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-default btn-outline" onclick="searchq()" id="searchbtn">Go!</button>
                    </span>
					
					
                  </div>
				  </form>
                </div></div></div>
            <div class="panel-actions">
              
              <a class="panel-action icon wb-trash" onclick="deletedocs()" data-toggle="tooltip" data-original-title="delete" data-container="body" title=""></a>
             <a class="panel-action icon wb-move" data-toggle="modal" data-target="#moveto"  data-toggle="tooltip" data-original-title="Move File" data-container="body" title=""></a>
             
            </div>
          </div>
            <div class="panel-body">
        @if(count($documents)>0)
		<div class="modal fade modal-slide-in-right" id="moveto" aria-labelledby="exampleModalTitle" role="dialog"  aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-warning">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">{{_t('Move Doc')}}</h4>
                        </div>
                        <div class="modal-body">
                          <p>{{_t('Select Folder To Move Selected Document To')}}</p>
						  <select data-plugin="select2" id="folderid">
						  <option value="" >--{{_t('Select Folder')}}--</option>
						  <?php  $folders=app('App\Repositories\XtraRepository')->allfolder(1) ?>
						  @foreach($folders as $folder)
						   <option value="{{$folder->id}}" >{{$folder->name}}</option>
						 
						  @endforeach
						  </select>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" onclick="movefile()" class="btn btn-primary"><i class="icon wb-move"></i>&nbsp;&nbsp;{{_t('Move')}}</button>
                        </div>
                      </div>
                    </div>
                  </div>
          <div class="example-wrap">
            <div class="example">
              <div class="table-responsive">
                <table class="table table-hover" data-role="content" data-plugin="selectable" data-row-selectable="true">
                  <thead class="bg-blue-grey-100">
                    <tr>
                      <th>
                        <span class="checkbox-custom checkbox-primary">
                          <input class="selectable-all"  type="checkbox">
                          <label></label>
                        </span>
                      </th>
                      <th>
                        {{_t('Name')}}
                      </th>
                      <th>
                        {{_t('Uploaded By')}}
                      </th>
					  <th>
                        {{_t('Category')}}
                      </th>
                      
                      <th>
                       {{_t('Date Created')}}
                      </th>
                      <th>{{_t('Action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
				  	@foreach($documents as $document)
                    <tr>
                      <td>
                        <span class="checkbox-custom checkbox-primary">
                          <input class="doclist" value="{{$document->id}}" type="checkbox">
                          <label></label>
                        </span>
                      </td>
                      <td><a href="javascript:void(0)">{{$document->documentname}}</a>
                         
                      </td>
                      <td>{{$document->name}}
                      </td> 
					  <td>{{app('App\Repositories\XtraRepository')->getfolder($document->folder_id)}}
                      </td>
                      
                      <td>
					    <i class="icon wb-time m-l-10" aria-hidden="true"></i>
                        <span><?php $date=Carbon\Carbon::parse($document->created_at) ?>
						{{$date->diffForHumans()}}</span>
                      
                      </td>
                    <td>
				<a role="button" target="_blank" href="{{asset('storage')}}/{{$document->path}}" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="View">
                            <i class="icon wb-eye" aria-hidden="true"></i>
                          </a>
					
					</td>
                    </tr>
                   @endforeach
				   </tbody>
                </table>
              </div>
            </div>
          </div>
		   {!! $documents->render() !!}
		  @else
		 <div style="margin-top:10px;" class="alert alert-danger"><h4>{{_t('Folder Empty')}}</h4></div>
       @endif
	   </div> </div>
	   
	   <div class="site-action" data-plugin="actionBtn">
    <button type="button" data-toggle="modal" data-target="#adddocument" class="site-action-toggle btn-raised btn btn-success btn-floating">
      <i class="front-icon wb-plus animation-scale-up" aria-hidden="true"></i>
      <i class="back-icon wb-close animation-scale-up" aria-hidden="true"></i>
    </button>
  </div>
  
        </div>
@endsection
