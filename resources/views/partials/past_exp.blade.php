 	<?php  function getyear($date,$type=0){
					if($type==0){
						$getyear=explode(' ',$date);
						return $getyear[0];
					}
					else{
						
						$getyear=explode('-',$date);
						$remtime=explode(' ',$getyear[2]);
						return [$getyear[0],$getyear[1],$remtime[0]];
						//return $ydm;
					}
					
				}
	?>
	@if($class=="")
 <script>
 
 $(function(){
	 
		
				
				$('#add_exp').submit(function(){
					event.preventDefault();
				var type=sessionStorage.getItem('exptype');
				if(type==1){
					createxp();
					return ;
				}
				
				updateexp();
					
				}); 
	 
	 
 });
 function updateexp(){
				
				
				   organization=$('#organization').val();
					role=$('#role').val();
					froms=$('#from').val();
					to=$('#to').val();
				 
			       if(organization==""||role==""||froms==""||to==""){
						toastr.error("Some Filled Blank");
						return;
					}
					id=sessionStorage.getItem('expid');
						$.get('{{url('addexperience')}}/'+id,{
							organization:organization,
							role:role,
							froms:froms,
							to:to
						},function(data,status,xhr){
							
							if(xhr.status==200){
								
								toastr.success("{{_t('Experience Updated Successfully')}}");
								setTimeout(function(){
									
									window.location.reload();
									
								},2000);
								return ;
							}
							toastr.error("{{_t('Unable to Update Experience(s) , Plese try again')}}"+data);
							return ;
							
						});
			
		}
		
		function createxp(){
			 
					organization=$('#organization').val();
					role=$('#role').val();
					froms=$('#from').val();
					to=$('#to').val();
				 
			       if(organization==""||role==""||froms==""||to==""){
						toastr.error("{{_t('Some Filled Blank')}}");
						return;
					}
				 
					//id=sessionStorage.getItem('expid');
						$.get('{{url('addexperience')}}/'+0,{
							organization:organization,
							role:role,
							froms:froms,
							to:to
							
						},function(data,status,xhr){
							
							if(xhr.status==200){
								
								toastr.success("{{_t('Experience added Successfully')}}");
								setTimeout(function(){
									
									window.location.reload();
									
								},2000);
								return ;
							}
							toastr.error("{{_t('Unable to Add Experience(s) , Plese try again')}}"+data);
							return ;
							
						});
			
						
			
		}
		
 function editexp(organization,id,froms,to,role){
		
				 
					 $('#organization').val(organization);
					 $('#role').val(role);
					 $('#from').val(froms);
					 $('#to').val(to);
					 sessionStorage.setItem('expid',id);
					 sessionStorage.setItem('exptype',0);
					 $('#experiencedynamics').text('{{_t('Update Experience(s)')}}');
		
		
	}
	function fallbackexp(){
			sessionStorage.setItem('exptype',1);
		 $('#experiencedynamics').text('{{_t('Add Experience(s)')}}'); 
	 
	}
	
	function expdelete(id){
		
		swal({
			title: "{{_t('Are you sure?')}}",
			text: "{{_t('You are about to delete skill')}}",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "{{_t('Yes, delete it!')}}",
			closeOnConfirm: false
		},
	function(){
		
			$.get('{{url('deleteskills')}}/'+id,function(data,status,xhr){
			
			if(xhr.status==200){
				toastr.success("{{_t('Successfully Deleted')}}");
				swal("{{_t('Deleted!')}}", "{{_t('Successfull')}}", "success");

				setTimeout(function(){
					
					
					window.location.reload();
					
				},2000);
				return ;
				
			}
			toastr.error("{{_t('Some error Occurred')}}");
			return ;
			
		});
	
  		
		
		});
		
	}
	
 
 
 </script>
 <div class="modal fade modal-danger in" id="addexp" aria-labelledby="exampleModalDanger" role="dialog"  style="display: none; padding-right: 17px;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">{{_t('Manage Experience')}}
						  </h4>
                        </div>
                        <div class="modal-body">
                     
	   <div>
		
	   <form id="add_exp"  >
	   <b style="color:green">{{_t('Organization')}}</b> 
	   <input type="text"  required placeholder="organization name" id="organization"   class="form-control"><br> 
	   <b style="color:green">{{_t('Role')}}</b> 
	   <input type="text"  required placeholder="Application Developer" id="role"   class="form-control"><br> 
	   <b style="color:green">{{_t('From')}}</b> 
	   <input type="text"  required   data-plugin="datepicker" id="from" name="start"  class="form-control"><br> 
	   <b style="color:green">{{_t('to')}}</b> 
	   <input type="text"  required  data-plugin="datepicker" id="to"  name="end"  class="form-control"><br>
	  
	    </div>  </div>
                    
                        <div class="modal-footer">
                          <a role="button" class="btn btn-default" data-dismiss="modal">{{_t('Close')}}</a>
						  <button type="submit"   class="pull-right btn btn-primary" id="experiencedynamics">{{_t('Add Experience(s)')}}</button>
                        </div>
						</form>
						   
                    
                      </div>
                    </div>
                  </div>
 @endif

 <div class="panel">
                    <div style="text-color:red;" class="panel-heading" id="exampleHeadingDefaultThreeexp" role="tab">
                      <a style="text-decoration:none;" class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThreeexp" data-parent="#exampleAccordionDefault" aria-expanded="true" aria-controls="exampleCollapseDefaultThree">
                      {{_t('Experience(s)')}}( <button onclick="fallbackexp()" data-toggle="modal" data-target="#addexp" class="{{$class}} btn btn-sm btn-outline btn-pure btn-success"><i class="icon wb-plus"></i>{{_t('Add')}}</button> )<button class="pull-right btn btn-sm btn-icon btn-pure btn-default"><i class="icon wb-plus"></i></button>
                    </a>
                    </div>
                    <div class="panel-collapse collapse" id="exampleCollapseDefaultThreeexp" aria-labelledby="exampleHeadingDefaultThreeexp" role="tabpanel" aria-expanded="false">
              <div class="container">  
				@if(count($experiences)>0)
          <table class="table table-hover dataTable table-striped w-full" id="exampleTableSearch" data-plugin="dataTable">
            <thead>
			  <tr>
                 <th>{{_t('Organization')}}</th>
                <th>{{_t('Date From')}}</th>
                <th>{{_t('Date To')}}</th>
				 <th>{{_t('Experience')}}</th>
                <th>{{_t('Role')}}</th> 
                <th>{{_t('Action')}}</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                 <th>{{_t('Organization')}}</th>
                <th>{{_t('Date From')}}</th>
                <th>{{_t('Date To')}}</th>
				 <th>{{_t('Experience')}}</th>
                <th>{{_t('Role')}}</th> 
                <th>{{_t('Action')}}</th>
              </tr>
            </tfoot>
            <tbody >
				 
			@foreach($experiences as $experience)
              <tr> 
                <td>{{$experience->organization}}</td>
                <td>{{getyear($experience->from)}} </td>
                <td>{{getyear($experience->to)}}</td>
				<td>
			<?php $date=getyear($experience->from,1);  ?>	{{$experience->from->createFromDate($date[0],$date[1],$date[2])->diff($experience->to)->format('%y yr(s), %m mth(s) and %d day(s)')}}</td>
			
                <td>{{$experience->role}}</td>
              
                <td>
				<a {{$disable}} style="cursor:pointer;" onclick="editexp('{{$experience->organization}}','{{$experience->id}}','{{$experience->from}}','{{$experience->to}}','{{$experience->role}}')" class="{{$class}} btn btn-sm btn-icon btn-pure btn-default" data-toggle="modal" data-target="#addexp"><i class="icon wb-edit" aria-hidden="true"></i></a>
				<a {{$disable}} style="cursor:pointer;" onclick="expdelete('{{$experience->id}}',1)"  class="{{$class}} btn btn-sm btn-icon btn-pure btn-default" ><i class="icon wb-trash" aria-hidden="true"></i></a>
				</td>
               
              </tr>
			 @endforeach
           </tbody>
		 
          </table>
		  @else
			  <h3 class="text-center alert alert-success">{{_t('No Experience Found')}}</h3>
		  @endif
		  
        </div>
        </div>
      </div>
       