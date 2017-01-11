<script>
$(function(){
	$("#savebizwrk").click(function(){
		
		start=$('#startbiz').val();
		end=$('#closebiz').val();
	$.get('{{url('setwrkhrs')}}?start='+start+'&end='+end,function(data,status,xhr){
		
		if(xhr.status==200){
			
			toastr.success(data);
		}
		else{
			toastr.error(data);
		}
		
	});	
		
	});
});

</script>

<div class="modal fade modal-success modal-rotate-from-left" id="setbiztime" aria-labelledby="exampleModalTitle" role="dialog"   style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content" style="z-index:99999999">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Set Working Hours</h4>
                        </div>
                        <div class="modal-body">
                       <?php $mm=app('App\Repositories\GlobalSettingRepository')->getworkinghours(); ?>
						 <p>Start of Business:</p>
						<input type="time" class="form-control" value="{{$mm['sob']}}" id="startbiz" data-plugin="clockpicker" />
						<br>
						 <p>Close of Business:</p>
						<input  type="time" class="form-control" id="closebiz" data-plugin="clockpicker" value="{{$mm['cob']}}" />
 						
						
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="savebizwrk" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
