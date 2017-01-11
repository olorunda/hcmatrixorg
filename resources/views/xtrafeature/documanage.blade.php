@extends('layouts.app')

@section('content')
<script>

function manage(e,foldid){
	
	 e.which=e.which || e.keyCode;
		if(e.which==3){
			
		 sessionStorage.setItem('foldid',foldid);
	 }
	}
function dd(e){
	
	e.preventDefault();
	
}

function dd2(e){
	$('#dropdown').hide();
	
	
}
$(function (){
	
	$('#saveedit').click(function(){
		
		var newfoldname=$('#editfoldername').val();
		
		$.get('{{url('edit')}}/folder?id='+sessionStorage.getItem('foldid')+'&newname='+newfoldname,function(data,status,xhr){
			
			if(xhr.status==200){
				toastr.success("Modification Succesfull");
				setTimeout(function(){
					
					window.location.reload();
					
				},2000);
				return;
			}
			toastr.error("Some Error Occurred");
			
			
		});
		
		
	});
	
	@if(Auth::user()->role==3)
	  $.contextMenu({
            selector: '.context-menu-one', 
            callback: function(key, options) {
				if(key=="edit"){
				$('#edit').modal('show');
				mm=$('#name'+sessionStorage.getItem('foldid')).text();
				$('#editfoldername').val(mm);
				 
				}
				if(key=="delete"){
					swal({
  title: "Are you sure?",
  text: "You will not be able to recover this folder once deleted!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(){
	$.get('{{url('delete')}}/folder?id='+sessionStorage.getItem('foldid'),function(data,status,xhr){
		
		if(xhr.status==200){
			 swal("Deleted!", "Folder Succesfully Deleted", "success");
			 setTimeout(function(){
				window.location.reload();
				},2000);
		}
		else{
			toastr.error("Error Occurred");
		}
		
	});
 
});
				}
                
            },
            items: {
                "edit": {name: "Edit", icon: "edit"},
                "delete": {name: "Delete", icon: "delete"},
                
                "close": {name: "close", icon: function(){
                    return 'context-menu-icon context-menu-icon-quit';
                }}
            }
        });

        $('.context-menu-one').on('click', function(e){
            console.log('clicked', this);
        }); 
	
	@endif
//	$('#dropdown').hide();
	
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

 
							  $('#savefolder').click(function(){
								
								$.get('{{url('savefolder?name=')}}'+$('#foldername').val(),function(data,status,xhr){
									if(xhr.status==200){
										
										toastr.success("Folder Created Successfully");
										
										setTimeout(function(){
											
											window.location.reload();
										},2000);
										return ;
									}
									else {
										toastr.error("Some Error Occurred");
									}
									
								});
								  
								  
							  });
							  
							  
						  });
						  

</script>

<input type="hidden" value="{{csrf_token()}}" id="token" />
<div class="page-header">
  <h1 class="page-title">Document Administration</h1>
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
<div  >
<div class="col-lg-6 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white">
                  <i class="icon icon-circle icon-2x wb-clipboard bg-red-600" aria-hidden="true"></i>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number">{{$foldercount}}</span>
                    <span class="counter-number-related text-capitalize">Folders</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">available</div>
                </div>
              </div>
              <!-- End Card -->
            </div>
			<div class="col-lg-6 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white">
                  <i class="icon icon-circle icon-2x wb-clipboard bg-red-600" aria-hidden="true"></i>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number">{{$docucount}}</span>
                    <span class="counter-number-related text-capitalize">Documents</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">Uploaded</div>
                </div>
              </div>
              <!-- End Card -->
            </div>
            </div>
			
	<div class="col-lg-12 col-md-12 col-xs-12" oncontextmenu="dd(event)" onclick="dd2(event)">		 
<div class="panel panel-success panel-line">
            <div class="panel-heading">
              <h3 class="panel-title">All Folders
			 <div class="col-md-4 pull-right">
			  <form method="get"  action="{{url('searchdoc')}}">
                    <input type="hidden" name="foldid"  value="gen">
                    
                  <div class="input-group ">
				  
                    <input required type="text" name="q" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-default btn-outline" onclick="searchq()" id="searchbtn">Search</button>
                    </span>
					
					
                  </div>
				  </form></div></h3>
			  	
				  <div class="col-md-12"></div>
            </div>
            <div class="panel-body">
			 
			<div style="position:relative">
			<?php session(['type'=>'']) ?>
     @if(count($allfolder)>0)
		 @foreach($allfolder as $folder)
    <div  class = "context-menu-one raspberry col-md-2" id="folder{{$folder->id}}"  onmousedown="manage(event,'{{$folder->id}}')">
      <a href="{{url('view')}}/document?foldid={{$folder->id}}&foldername={{$folder->name}}"> <img src="{{asset('upload/empfol.png')}}"/>
			<?php $name= str_replace(' ','&lt;br/&gt;',$folder->name); ?>
        <p id="name{{$folder->id}}">{!!  htmlspecialchars_decode($name) !!}</p></a>
    </div>
	@endforeach
		  <div>

	{!! $allfolder->render() !!}
	@else
		
	<div class="alert alert-info">
	<h3>No Folder Found, Click on the Plus Button at the buttom of this page to add folder</h3>
	
	</div>
	@endif
</div>
@if(Auth::user()->role==3)
		<div class="site-action" data-plugin="actionBtn">
    <button type="button" data-toggle="modal" data-target="#addfolder" class="site-action-toggle btn-raised btn btn-success btn-floating">
      <i class="front-icon wb-plus animation-scale-up" aria-hidden="true"></i>
      <i class="back-icon wb-close animation-scale-up" aria-hidden="true"></i>
    </button>
  </div>
@endif
  </div>
          </div>
		  </div>
	 </div>	 
		  <div   class="modal fade modal-success in" id="addfolder" aria-labelledby="exampleModalSuccess" role="dialog" tabindex="-1" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Add Folder</h4>
                        </div>
                        <div class="modal-body">
                           Folder Name : </br>
						  <input type='text' class="form-control" id="foldername" />
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="savefolder" class="btn btn-primary">Save changes</button>
						  <script>
						  
						  </script>
                        </div>
                      </div>
                    </div> 
                  </div>
				  
				   <div   class="modal fade modal-success in" id="edit" aria-labelledby="exampleModalSuccess" role="dialog" tabindex="-1" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Edit Folder Name</h4>
                        </div>
                        <div class="modal-body">
                           Folder Name : </br>
						  <input type='text' class="form-control" id="editfoldername" />
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="saveedit" class="btn btn-primary">Save changes</button>
						  <script>
						  
						  </script>
                        </div>
                      </div>
                    </div> 
                  </div>
                 
				  
				 
		
		  
		  
		  
@endsection
