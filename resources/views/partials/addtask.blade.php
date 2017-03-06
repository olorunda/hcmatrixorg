 	
	<script>
	function edittask(id,name,froms,tos){
		
					$('#taskname').val(name);
					$('#tenddate').val(tos);
					$('#tstartdate').val(froms);
					sessionStorage.setItem('tskid',id);
					sessionStorage.setItem('type',0);
					$('#tskbtn').text('{{_t('Update Task')}}');
						
	}
	function deletetask(id){
		
		swal({
  title: "{{_t('Are you sure?')}}",
  text: "{{_t('You will not be able to recover deleted Task!')}}",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "{{_t('Yes, delete it!')}}",
  closeOnConfirm: false
},
function(){
	//extend jquery fro put and delete

//extend jquery fro put and delete

		$.delete('{{url('project')}}/'+id,function(data,status,xhr){
			
			if(xhr.status==200){
				
				toastr.success("{{_t('Task Successfully Deleted')}}");
				swal("{{_t('Deleted!')}}", "{{_t('Task deleted Successfully.')}}", "success");
				setTimeout(function(){
					
					window.location.reload();
					
				},2000);
				return ;
			}
			toastr.error("{{_t('Some Error Occurred')}}");
			
		});
		
		
});
		
	}
	function updatetask(){
		
			
					taskid=sessionStorage.getItem('tskid');
					taskname=$('#taskname').val();
					tenddate=$('#tenddate').val();
					tstartdate=$('#tstartdate').val();
				$.get('{{url('project')}}/'+taskid+'/edit',{
					
					tstartdate:tstartdate,
					tenddate:tenddate,
					taskname:taskname,
					taskid:taskid
					
					
				},function (data,status,xhr){
					
					if(xhr.status==200){
						toastr.success("{{_t('Successfully Updated Task')}}");
						setTimeout(function(){
						window.location.reload();
						},2000);
						return ;
					}
					toastr.error("{{_t('Some error occurred')}}");
					
				});
		 
		
	}
	
	function createtask(){
		
			
					projectid=sessionStorage.getItem('prjid');
					taskname=$('#taskname').val();
					tenddate=$('#tenddate').val();
					tstartdate=$('#tstartdate').val();
				$.get('{{url('project')}}/create',{
					
					tstartdate:tstartdate,
					tenddate:tenddate,
					taskname:taskname,
					projectid:projectid
					
					
				},function (data,status,xhr){
					
					if(xhr.status==200){
						toastr.success("{{_t('Successfully Added Task')}}");
						setTimeout(function(){
						window.location.reload();
						},2000);
						return ;
					}
					toastr.error("{{_t('Some error occurred')}}");
					
				});
		 
		
	}
			$(function(){
	jQuery.each( [ "put", "delete" ], function( i, method ) {
  jQuery[ method ] = function( url, data, callback, type ) {
    if ( jQuery.isFunction( data ) ) {
      type = type || callback;
      callback = data;
      data = undefined;
    }

    return jQuery.ajax({
      url: url,
      type: method,
      dataType: type,
      data: data,
      success: callback
    });
  };
});
			$('#submittask').submit(function(){
				
				event.preventDefault();
				
					
					type=sessionStorage.getItem('type');
					 
					if(type==0){
					
						updatetask();
					}
					else if(type==1){
						
						createtask();
					}
				
				
			 });

		 });
			</script>

<div class="modal fade in" id="addtasks" aria-labelledby="addtasks" role="dialog"   style="display: none; padding-right: 17px;">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
          <h4 class="modal-title">{{_t('Create New Task')}}</h4>
        </div>
        <div class="modal-body">
          <form   id="submittask" role="form">
            <div class="form-group">
              <label class="form-control-label m-b-15" for="name">{{_t('Task name')}}:</label>
              <input type="text" class="form-control" id="taskname" name="taskname" placeholder="Project name">
            </div> 
		
			 
			<div class="form-group">
              <label class="form-control-label m-b-15" for="name">{{_t('Start Date')}}:</label>
              <input type="text" data-plugin="datepicker" class="form-control"   id="tstartdate"   placeholder="Project Code">
            </div>
			<div class="form-group">
              <label class="form-control-label m-b-15" for="name">{{_t('End Date')}}:</label>
              <input type="text" data-plugin="datepicker" class="form-control"   id="tenddate"   placeholder="Project Code">
            </div>
		      
        </div>
        <div class="modal-footer text-xs-left">
          <button class="btn btn-primary" id="tskbtn" type="submit">{{_t('Create Task')}}</button>
          <a class="btn btn-sm btn-white" data-dismiss="modal" href="javascript:void(0)">{{_t('Cancel')}}</a>
        </div>
		 </form>
      </div>
    </div>
  </div>