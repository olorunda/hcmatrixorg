@if($class=="")
<script>
$(function(){
	
		
				$('#add_depd').submit(function(){
					event.preventDefault();
				var type=sessionStorage.getItem('type');
				if(type==1){
					create();
					return ;
				}
				
				update();
					
				});
			
	
	
});
function update(){
			
				relationship=$('#relationship').val();
					if(relationship=="nil"){
						toastr.error("{{_t('Please Select relationship')}}");
						return;
					}
					name=$('#depname').val();
					dob=$('#depdob').val();
					email=$('#depemail').val();
					depphonenum=$('#depphonenum').val();
					id=sessionStorage.getItem('depid');
						$.get('{{url('adddependant')}}/'+id,{
							dep_name:name,
							dep_dob:dob,
							dep_email:email,
							phone_num:depphonenum,
							relationship:relationship
							
						},function(data,status,xhr){
							
							if(xhr.status==200){
								
								toastr.success("{{_t('Dependant Updated Successfully')}}");
								setTimeout(function(){
									
									window.location.reload();
									
								},2000);
								return ;
							}
							toastr.error("{{_t('Unable to Update Dependant , Plese try again')}}"+data);
							return ;
							
						});
			
		}
		
		function create(){
			
			relationship=$('#relationship').val();
					if(relationship=="nil"){
						toastr.error("{{_t('Please Select relationship')}}");
						return;
					}
					name=$('#depname').val();
					dob=$('#depdob').val();
					email=$('#depemail').val();
					depphonenum=$('#depphonenum').val();
					
						$.get('{{url('adddependant/0')}}',{
							dep_name:name,
							dep_dob:dob,
							dep_email:email,
							phone_num:depphonenum,
							relationship:relationship
							
						},function(data,status,xhr){
							
							if(xhr.status==200){
								
								toastr.success("{{_t('Dependant Added Successfully')}}");
								setTimeout(function(){
									
									window.location.reload();
									
								},2000);
								return ;
							}
							tostr.error("{{_t('Unable to add Dependant , Plese try again')}}"+data);
							return ;
							
						});
						
			
		}
		
	
	function editdep(id,name,dob,relationship,email,phone_num){
		
				$('#depname').val(name);
					$('#depdob').val(dob);
					$('#depemail').val(email);
					$('#depphonenum').val(phone_num);
					sessionStorage.setItem('depid',id);
					sessionStorage.setItem('type',0);
				 $('#dynamics').text('{{_t('Update Dependant')}}');
		 
		
	}
	 
	
	
	function fallback(){
			sessionStorage.setItem('type',1);
		 $('#dynamics').text('{{_t('Add Dependant')}}'); 
	 
	}
			
		function depdelete(id){
		
		swal({
			title: "{{_t('Are you sure?')}}",
			text: "{{_t('You are about to delete dependant')}}",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "{{_t('Yes, delete it!')}}",
			closeOnConfirm: false
		},
	function(){
		
			$.get('{{url('deletedpendant')}}/'+id,function(data,status,xhr){
			
			if(xhr.status==200){
				toastr.success("{{_t('Successfully Deleted')}}");
				swal("Deleted!", "{{_t('Successfull')}}", "success");

				setTimeout(function(){
					
					
					window.location.reload();
					
				},2000);
				return ;
				
			}
			toastr.error("{{_t('Some error')}}");
			return ;
			
		});
	
  		
		
		});
		
	}
					


</script>

<div class="modal fade modal-danger in" id="adddept" aria-labelledby="exampleModalDanger" role="dialog"  style="display: none; padding-right: 17px;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">{{_t('Add Dependant')}}
						  </h4>
                        </div>
                        <div class="modal-body">
                     
	   <div>
	
	   
	   <form id="add_depd"  >
	  
	   <input type="hidden"  id="xss" value="{{csrf_token()}}" >
	  <b style="color:green">{{_t('Relationship')}}</b>
	    <select data-plugin="select2" id="relationship">
		<option value="nill">{{_t('Choose a Relationship')}}</option>
		<option value="Father">{{_t('Father')}}</option>
		<option value="Brother">{{_t('Brother')}}</option>
		<option value="Sister">{{_t('Sister')}}</option>
		<option value="Uncle">{{_t('Uncle')}}</option>
		<option value="Aunt">{{_t('Aunt')}}</option>
		</select>
		<br>
		  <b style="color:green">{{_t('Name')}}</b> 
	   <input type="text"  required placeholder="Full Name" id="depname"   class="form-control"><br>
	     <b style="color:green">{{_t('Date of Birth')}}</b> 
		<input type="text" data-plugin="datepicker" required placeholder="Date of birth" id="depdob"   class="form-control"><br>
		<b style="color:green">{{_t('Email')}}</b> 
		<input type="email" required placeholder="email@mail.com" id="depemail"   class="form-control">
	 
	    </div><br>
		<b style="color:green">{{_t('Phone Number')}}</b> 
		<input type="tel" required placeholder="070xxxx" id="depphonenum"   class="form-control">
	 
	    </div>
                    
                        <div class="modal-footer">
                          <a role="button" class="btn btn-default" data-dismiss="modal">{{_t('Close')}}</a>
						  <button type="submit"   class="btn btn-primary" id="dynamics">{{_t('Add Dependant')}}</button>
                        </div>
						</form>
						    </div>
                      </div>
                    </div>
@endif

 <div class="panel">
                    <div style="text-color:red;" class="panel-heading" id="exampleHeadingDefaultThree" role="tab">
                      <a style="text-decoration:none;" class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree" data-parent="#exampleAccordionDefault" aria-expanded="true" aria-controls="exampleCollapseDefaultThree">
                     {{_t('Dependants(s)')}}( <button onclick="fallback()" data-toggle="modal" data-target="#adddept" class="{{$class}} btn btn-sm btn-outline btn-pure btn-success"><i class="icon wb-plus"></i>{{_t('Add')}}</button> )<button class="pull-right btn btn-sm btn-icon btn-pure btn-default"><i class="icon wb-plus"></i></button>
                    </a>
                    </div>
                    <div class="panel-collapse collapse" id="exampleCollapseDefaultThree" aria-labelledby="exampleHeadingDefaultThree" role="tabpanel" aria-expanded="false">
              <div class="container">  
				@if(count($dependants)>0)
          <table class="table table-hover dataTable table-striped w-full" id="exampleTableSearch" data-plugin="dataTable">
            <thead>
              <tr>
			  				
                <th>{{_t('Name')}}</th>
                <th>{{_t('Date of Birth')}}</th>
                <th>{{_t('Relationship')}}</th>
                <th>{{_t('Email')}}</th>
                <th>{{_t('Phone Number')}}</th>
                 <th>{{_t('Action')}}</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
               <th>{{_t('Name')}}</th>
                <th>{{_t('Date of Birth')}}</th>
                <th>{{_t('Relationship')}}</th>
                <th>{{_t('Email')}}</th>
                <th>{{_t('Phone Number')}}</th>
                 <th>{{_t('Action')}}</th>
              </tr>
            </tfoot>
            <tbody >
			@foreach($dependants as $dependant)
              <tr>
			  
                <td>{{$dependant->name}}</td>
                <td>{{$dependant->dob}}</td>
                <td>{{$dependant->relationship}}</td>
                <td>{{$dependant->email}}</td>
                <td>{{$dependant->phone_num}}</td>
                <td>
				<a  {{$disable}}  style="cursor:pointer;" onclick="editdep('{{$dependant->id}}','{{$dependant->name}}','{{$dependant->dob}}','{{$dependant->relationship}}','{{$dependant->email}}','{{$dependant->phone_num}}')" class="{{$class}} btn btn-sm btn-icon btn-pure btn-default" data-toggle="modal" data-target="#adddept"><i class="icon wb-edit" aria-hidden="true"></i></a>
				<a {{$disable}}  style="cursor:pointer;" onclick="depdelete('{{$dependant->id}}')"  class="{{$class}} btn btn-sm btn-icon btn-pure btn-default" ><i class="icon wb-trash" aria-hidden="true"></i></a>
				</td>
               
              </tr>
			 @endforeach
           </tbody>
		 
          </table>
		  @else
			  <h3 class="text-center alert alert-success">{{_t('No dependant Found')}}</h3>
		  @endif
		  
        </div>
        </div>
      </div>
  