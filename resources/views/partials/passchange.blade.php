<script>
	
		
$(function(){
 
				
			
			
			 
$(document).ajaxStart(function(){

	$('#savepasschn').text('{{_t('Changing password')}}...');

	}).ajaxStop(function(){

	$('#savepasschn').text('{{_t('Save changes')}}');

	});

	$('#savepasschn').click(function(){
		var oldpass=$('#oldpass').val();
		var newpass=$('#newpass').val();
		var passconfirm=$('#passconf').val();
		csrf=$('#xss').val();

//alert(passconfirm);

	if(oldpass=="" || newpass==""  || passconfirm ==""){


		toastr.error('{{_t('Please Fill all Fields')}}');
	}

	else{
		if(newpass==passconfirm){
	
			$.post('{{url('change')}}/password',{

				_token:csrf,
				oldpass:oldpass,
				newpass:newpass

		},function(data,status,xhr){

			if(xhr.status==200){
				if(data=="incorrect"){
					toastr.error('{{_t('Password Incorrect, You have to login again')}}');
					window.location.reload();
					return;
		}

		toastr.success('{{_t('Password Successfully Changed')}}');
		return;
	}
		toastr.error('{{_t('Unable to change password')}}');

	});


	}
	else{

			$('#passchh').html('<div class="alert alert-danger">{{_t('Password Not Match')}}</div>');
			toastr.error('{{_t('Password Not Match')}}');

		}

	}

	});



});



</script> 
<div class="modal fade modal-warning in" id="myModal" aria-labelledby="exampleModalDanger" role="dialog" tabindex="-1" style="display: none; padding-right: 17px;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">{{_t('Change Password')}}
						  </h4>
                        </div>
                        <div class="modal-body">
                         	<div  id="passchh">
					
                    </div>   
	   <div>
	   <input type="hidden"  id="xss" value="{{csrf_token()}}" >
	  <b style="color:green">{{_t('Old Password')}}</b>
	    <input type="password"  required placeholder="Old Password" id="oldpass"   class="form-control"><br>
		  <b style="color:green">{{_t('New Password')}}</b> 
	   <input type="password"  required placeholder="New Password" id="newpass"   class="form-control"><br>
	     <b style="color:green">{{_t('Confirm Password')}}</b> 
		<input type="password"  required placeholder="New Password Confirm" id="passconf"   class="form-control">
	 
	    </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">{{_t('Close')}}</button>
                          <button type="button" class="btn btn-primary" id="savepasschn">{{_t('Save changes')}}</button>
                        </div>
                      </div>
                    </div>
                  </div>
 
			
				