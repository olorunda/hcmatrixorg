 @if($class=="")
 <script>
 
 $(function(){
	 
		
				
				$('#add_academics').submit(function(){
					event.preventDefault();
				var type=sessionStorage.getItem('academictype');
				if(type==1){
					createacademic();
					return ;
				}
				
				updateacademic();
					
				}); 
	 
	 
 });
 function updateacademic(){
				
							qualification=$('#qualification').val();
							year=$('#year').val();
							institution=$('#institution').val();
							grade=$('#grade').val();
							course=$('#course').val();
				
					if(qualification=="nil"){
						toastr.error("{{_t('Please Select a qualification')}}");
						return;
					}
					id=sessionStorage.getItem('academicid');
						$.get('{{url('addacademics')}}/'+id,{
							qualification:qualification,
							year:year,
							institution:institution,
							grade:grade,
							course:course
							
						},function(data,status,xhr){
							
							if(xhr.status==200){
								
								toastr.success("{{_t('Academics Information Updated Successfully')}}");
								setTimeout(function(){
									
									window.location.reload();
									
								},2000);
								return ;
							}
							toastr.error("{{_t('Unable to Update Academics Informtion , Plese try again')}}"+data);
							return ;
							
						});
			
		}
		
		function createacademic(){
			
							qualification=$('#qualification').val();
							year=$('#year').val();
							institution=$('#institution').val();
							grade=$('#grade').val();
							course=$('#course').val();
				
				 
					if(qualification=="nil"){
						toastr.error("{{_t('Please Select a qualification')}}");
						return;
					}
					//id=sessionStorage.getItem('skillid');
						$.get('{{url('addacademics')}}/'+0,{
							qualification:qualification,
							year:year,
							institution:institution,
							grade:grade,
							course:course
							
						},function(data,status,xhr){
							
							if(xhr.status==200){
								
								toastr.success("{{_t('Academics Information added Successfully')}}");
								setTimeout(function(){
									
									window.location.reload();
									
								},2000);
								return ;
							}
							toastr.error("{{_t('Unable to add Academic Information , Plese try again')}}"+data);
							return ;
							
						});
			
						
			
		}
		
		
		//cmoe here agaain
 function editacademic(qualification,id,year,institution,grade,course){
		
					 $('#qualification').val(qualification);
						$('#year').val(year);
						$('#institution').val(institution);
						$('#grade').val(grade);
						$('#course').val(course);
					sessionStorage.setItem('academicid',id);
					sessionStorage.setItem('academictype',0);
				 $('#academicdynamics').text('{{_t('Update Academic')}}');
		
		
	}
	function fallbackacademic(){
			sessionStorage.setItem('academictype',1);
		 $('#academicdynamics').text('{{_t('Add Academic')}}'); 
	 
	}
	
	function academicdelete(id){
		
		swal({
			title: "{{_t('Are you sure?')}}",
			text: "{{_t('You are about to delete academic information')}}",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "{{_t('Yes, delete it!')}}",
			closeOnConfirm: false
		},
	function(){
		
			$.get('{{url('deleteacademics')}}/'+id,function(data,status,xhr){
			
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
 
 <div class="modal fade modal-danger in" id="addacademics" aria-labelledby="exampleModalDanger" role="dialog"  style="display: none; padding-right: 17px;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">{{_t('Manage Academic Information')}}
						  </h4>
                        </div>
                        <div class="modal-body">
                     
	   <div>
		
	   
	   <form id="add_academics"  >
	   	
	  <b style="color:green">{{_t('Qualification')}}</b>
	    <select data-plugin="select2" id="qualification">
		<option value="nill">{{_t('Choose Qualification')}}</option>
		<option value="School/Certificate">{{_t('School/Certificate')}}</option>
		<option value="ND">ND</option>
		<option value="HND">HND</option>
		<option value="BSC">BSC</option>
		<option value="BEng">BEng</option>
		<option value="MEng">MEng</option>
		</select>
		<br>
		 <b style="color:green">{{_t('Institution')}}</b> 
	   <input type="text"  required placeholder="Name of Institution" id="institution"   class="form-control"><br>
	      <b style="color:green">{{_t('Year')}}</b> 
	   <input type="text"  data-plugin="datepicker" required placeholder="Graduation year" id="year"   class="form-control"><br>
		 <b style="color:green">{{_t('Course')}}</b> 
	   <input type="text"  required placeholder="skill name" id="course"   class="form-control"><br> 
	   <b style="color:green">{{_t('CGPA/Grade/Score')}}</b> 
	   <input type="text"  required placeholder="grade" id="grade"   class="form-control"><br> 
	
	   
		 
	    </div>  </div>
                    
                        <div class="modal-footer">
                          <a role="button" class="btn btn-default" data-dismiss="modal">{{_t('Close')}}</a>
						  <button type="submit"   class="pull-right btn btn-primary" id="academicdynamics">{{_t('Add Academic')}}</button>
                        </div>
						</form>
						   
                    
                      </div>
                    </div>
                  </div>
 @endif

 <div class="panel">
                    <div style="text-color:red;" class="panel-heading" id="exampleHeadingDefaultThreeacademics" role="tab">
                      <a style="text-decoration:none;" class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThreeacademics" data-parent="#exampleAccordionDefault" aria-expanded="true" aria-controls="exampleCollapseDefaultThree">
                      {{_t('Academic(s)')}}( <button onclick="fallbackacademic()" data-toggle="modal" data-target="#addacademics" class="{{$class}} btn btn-sm btn-outline btn-pure btn-success"><i class="icon wb-plus"></i>{{_t('Add')}}</button> )<button class="pull-right btn btn-sm btn-icon btn-pure btn-default"><i class="icon wb-plus"></i></button>
                    </a>
                    </div>
                    <div class="panel-collapse collapse" id="exampleCollapseDefaultThreeacademics" aria-labelledby="exampleHeadingDefaultThreeacademics" role="tabpanel" aria-expanded="false">
              <div class="container">  
				@if(count($academics)>0)
          <table class="table table-hover dataTable table-striped w-full" id="exampleTableSearch" data-plugin="dataTable">
            <thead>
              <tr>
			    <th>{{_t('Qualification')}}</th>
                <th>{{_t('Year')}}</th>
                <th>{{_t('Institution')}}</th>
                <th>{{_t('CGPA/Grade/Score')}}</th> 
                <th>{{_t('Course')}}</th> 
                <th>{{_t('Action')}}</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>{{_t('Qualification')}}</th>
                <th>{{_t('Year')}}</th>
                <th>{{_t('Institution')}}</th>
                <th>{{_t('CGPA/Grade/Score')}}</th> 
                <th>{{_t('Course')}}</th> 
                <th>{{_t('Action')}}</th>
              </tr>
            </tfoot>
            <tbody >
			@foreach($academics as $academic)
              <tr>
			  		 	
              
                <td>{{$academic->qualification}}</td>
                <td>{{$academic->year}}  </td>
                <td>{{$academic->institution}}</td>
                <td>{{$academic->grade}}</td>
                <td>{{$academic->course}}</td>
              
                <td>
				<a  {{$disable}}  style="cursor:pointer;" onclick="editacademic('{{$academic->qualification}}','{{$academic->id}}','{{$academic->year}}','{{$academic->institution}}','{{$academic->grade}}','{{$academic->course}}')" class="{{$class}} btn btn-sm btn-icon btn-pure btn-default" data-toggle="modal" data-target="#addacademics"><i class="icon wb-edit" aria-hidden="true"></i></a>
				<a {{$disable}} style="cursor:pointer;" onclick="academicdelete('{{$academic->id}}',1)"  class="{{$class}} btn btn-sm btn-icon btn-pure btn-default" ><i class="icon wb-trash" aria-hidden="true"></i></a>
				</td>
               
              </tr>
			 @endforeach
           </tbody>
		 
          </table>
		  @else
			  <h3 class="text-center alert alert-success">{{_t('No Academics Information Found')}}</h3>
		  @endif
		  
        </div>
        </div>
      </div>
       