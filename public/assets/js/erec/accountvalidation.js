$(function(){

	$(document).ajaxStart(function(){
		$("#ajaxload").css("display", "block");
	});
	$(document).ajaxComplete(function(){
		$("#ajaxload").css("display", "none");
	});

	$("#email").on('keyup', function(){
		var confirmMail = validateEmail($(this).val());
		if(!confirmMail)
		{
			$("#emailerr").html("E-Mail is not Valid.").fadeIn("slow");
			return false;
		}
		else
		{
			$("#emailerr").html("").fadeOut("slow");
			return true;
		}
	});

	$("#password").on('keyup', function(){
		var pwd = $(this).val();
		var cpwd = $("#cpassword").val();
		if(!pwd || pwd == '')
		{
			$("#pwderr").html("Password is required and cannot be empty!").fadeIn("slow");
			$("#submitAccount").attr('disabled', 'disabled');
			return false;
		}
		else if(pwd.length < 8)
		{
			$("#pwderr").html("Password is too small. Must be at least 8 characters long.").fadeIn("slow");
			$("#submitAccount").attr('disabled', 'disabled');
			return false;
		}
		else if(pwd.length >= 8)
		{
			if(pwd == $("#email").val())
			{
				$("#pwderr").html("Password and E-Mail cannot be the same. Please enter a valid Password").fadeIn("slow");
				$("#submitAccount").attr('disabled', 'disabled');
				return false;
			}
			else if(!pwdTest(pwd).result)
			{
				$("#pwderr").html("Password does not comply with our standard. See below for Password format").fadeIn("slow");
				$("#submitAccount").attr('disabled', 'disabled');
				return false;
			}
			else
			{
				if(cpwd != '' && pwd != cpwd)
				{
					$("#pwderr").html("Passwords do not match. Please review Passwords and try again.").fadeIn("slow");
					$("#submitAccount").attr('disabled', 'disabled');
					return false;
				}
				else
				{
					$("#pwderr").html("Password is valid").removeClass("text-danger").addClass("text-success").fadeIn("slow");
					$("#submitAccount").removeAttr('disabled');
					return true;
				}
			}
		}
	});

	$("#cpassword").on('keyup', function(){
		var cpwd = $(this).val();
		if(!cpwd || cpwd == '')
		{
			$("#cpwderr").html("Confirm Password is required and cannot be empty").fadeIn("slow");
			$("#submitAccount").attr('disabled', 'disabled');
			return false;
		}
		else if(cpwd.length < 8)
		{
			$("#cpwderr").html("Password is too small. Must be at least 8 characters long.").fadeIn("slow");
			$("#submitAccount").attr('disabled', 'disabled');
			return false;
		}
		else if(cpwd.length >= 8)
		{
			if(cpwd == $("#email").val())
			{
				$("#cpwderr").html("Password and E-Mail cannot be the same. Please enter a valid Password.").fadeIn("slow");
				$("#submitAccount").attr('disabled', 'disabled');
				return false;
			}
			else if(!pwdTest(cpwd).result)
			{
				$("#cpwderr").html("Password does not comply with our standard. See below for Password format").fadeIn("slow");
				$("#submitAccount").attr('disabled', 'disabled');
				return false;
			}
			else
			{
				if (cpwd != $("#password").val())
				{
					$("#cpwderr").html("Passwords do not match. Please review your Passwords and try again").fadeIn("slow");
					$("#submitAccount").attr('disabled', 'disabled');
					return false;
				}
				else 
				{
					$("#cpwderr").html("Passwords verified.").removeClass("text-danger").addClass("text-success").fadeIn("slow");
					$("#submitAccount").removeAttr('disabled');
					return true;
				}
			}
		}
	});

	$("#submitAccount").click(function(e) {
		e.preventDefault();
		var jobid = $("#jobid").val();
		var email = $("#email").val();
		var pwd = $("#password").val();
		var cpwd = $("#cpassword").val();
		var token = $("#_account_token").val();
		var formData = {'email':email, 'password':pwd, 'password_confirmation':cpwd, 'jobid':jobid, '_token':token, 'type':1};

		$.post('/job', formData, function(data,xhr,status){
			if(data.id)
			{
				swal('Success', 'Account created.', 'success');
				$("#accountContainer").hide();
				$("#biodataContainer").fadeIn("slow");
				$("#correspondenceContainer").hide();
				$("#educationContainer").hide();
				$("#employmentContainer").hide();
				$("#professionalContainer").hide();
				$("#skillsContainer").hide();
				$("#referencesContainer").hide();
				$("#additionalContainer").hide();
				$("#previewContainer").hide();
				$("#biolink").removeClass("text-danger").addClass("text-primary");
			}
			else
			{
				if(data.email)
				{
					var response;
					if(data.email.length == 1)
					{
						response = data.email;
					}
					else
					{
						for(var i = 0; i < data.email.length; i++)
						{
							response += "<p>"+data.email[i]+"</p>";
						}
					}
					swal({
						title: "Warning!",
						text: "" + response,
						html: true
					});
				}
				if(data.password)
				{
					var response;
					if(data.password.length == 1)
					{
						response = data.password;
					}
					else
					{
						for(var i = 0; i < data.password.length; i++)
						{
							response += "<p>"+data.password[i]+"</p>";
						}
					}
					swal({
						title: "Warning!",
						text: "" + response,
						html: true
					});
				}
			}
		});
	});






});

function validateEmail(mail)   
{  
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))  
	{  
		return true;
	}
	return false;
}

function pwdTest(pwd)
{
	var anUpperCase = /[A-Z]/;
	var aLowerCase = /[a-z]/; 
	var aNumber = /[0-9]/;
	var aSpecial = /[!|@|#|$|%|^|&|*|(|)|-|_]/;
	var obj = {};
	obj.result = true;

	var numUpper = 0;
	var numLower = 0;
	var numNums = 0;
	var numSpecials = 0;
	for(var i=0; i<pwd.length; i++){
		if(anUpperCase.test(pwd[i]))
			numUpper++;
		else if(aLowerCase.test(pwd[i]))
			numLower++;
		else if(aNumber.test(pwd[i]))
			numNums++;
		else if(aSpecial.test(pwd[i]))
			numSpecials++;
	}

	if(numUpper < 1 || numLower < 1 || numNums < 1 || numSpecials < 1){
		obj.result=false;
		obj.error="Wrong Format!";
		return obj;
	}
	return obj;
}

function job(stage)
{
	var token = $("#_gen_token").val();

	var formData = {'stage':stage, '_token':token};
	$.get('stages', formData, function(data,xhr,status){
		///console.log(data);
	});
}