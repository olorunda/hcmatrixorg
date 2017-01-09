$(document).ready(function(){
	$("#searchfield").on("keyup", function(){
		console.log("text");
		var text = $(this).val();
		console.log(text);
	});
});

 function cat(category)
 {
 	var token = $("#lmtoken").val();
 	if(category == 'A'){category = 'a';}
 	var formData = {'_token':token, 'cat':category};
 	$.get('/lm/searchCat?type='+category, formData, function(data,xhr,status)
 	{
 		var tr = "";
 		if(data.length==0)
 		{
 			$("#directempsbody").html("");
 			tr = "<tr><th colspan='5'><h4>No result Found</h4></th></tr>";
 		}
 		else
 		{
 			$("#directempstable > tbody").html("");
 			$.each(data, function(index,item)
 			{
 				var urlobj = "goaddr('/lm/objectives_a?isemp="+item.id+"')";
 				var urlrate = "goaddr('/lm/rate?isemp="+item.id+"')";
 				if(category=='M')
 				{
 					//tr+="<tr><th><i class='fa fa-male'></i></th><th><img class='img-circle img-bordered img-bordered-primary' alt='avatar' src='../../../upload/"+item.image+"' style='width:50px;height:50px;'> "+item.name+"</th><th>"+item.emp_num+"</th><th>"+jobrole+"</th><th><button type='button' class='btn btn-floating btn-success btn-sm' title='L.M. Goal' onclick='"+urlobj+"'><i class='icon wb-pencil' aria-hidden='true'></i></button><button type='button' class='btn btn-floating btn-danger btn-sm' title='Rate Employee' onclick='"+urlrate+"'><i class='icon wb-star' aria-hidden='true'></i></button></th></tr>";
 					tr+='<tr><th><i class="fa fa-female"></i></th><th><img class="img-circle img-bordered img-bordered-primary" alt="avatar" src="../../../upload/'+item.image+'" style="width:50px;height:50px;"> '+item.name+'</th><th>'+item.emp_num+'</th><th>'+item.job_id+'</th><th><button type="button" class="btn btn-floating btn-success btn-sm" title="L.M. Goal" onclick="'+urlobj+'"><i class="icon wb-pencil" aria-hidden="true"></i></button><button type="button" class="btn btn-floating btn-danger btn-sm" title="Rate Employee" onclick="'+urlrate+'"><i class="icon wb-star" aria-hidden="true"></i></button></th></tr>';
 				}
 				else
 				{
 					//tr+="<tr><th><i class='fa fa-female'></i></th><th><img class='img-circle img-bordered img-bordered-primary' alt='avatar' src='../../../upload/"+item.image+"' style='width:50px;height:50px;'> "+item.name+"</th><th>"+item.emp_num+"</th><th>"+jobrole+"</th><th><button type='button' class='btn btn-floating btn-success btn-sm' title='L.M. Goal' onclick='"+urlobj+"'><i class='icon wb-pencil' aria-hidden='true'></i></button><button type='button' class='btn btn-floating btn-danger btn-sm' title='Rate Employee' onclick='"+urlrate+"'><i class='icon wb-star' aria-hidden='true'></i></button></th></tr>";
 					tr+='<tr><th><i class="fa fa-female"></i></th><th><img class="img-circle img-bordered img-bordered-primary" alt="avatar" src="../../../upload/'+item.image+'" style="width:50px;height:50px;"> '+item.name+'</th><th>'+item.emp_num+'</th><th>'+item.job_id+'</th><th><button type="button" class="btn btn-floating btn-success btn-sm" title="L.M. Goal" onclick="'+urlobj+'"><i class="icon wb-pencil" aria-hidden="true"></i></button><button type="button" class="btn btn-floating btn-danger btn-sm" title="Rate Employee" onclick="'+urlrate+'"><i class="icon wb-star" aria-hidden="true"></i></button></th></tr>';
 				}
 			});
 		}
 		$("#directempstable").append(tr);
 	});
 }

 function goaddr(addr)
 {
 	console.log(addr);
 	window.location=addr;
 }

 function search(searchText)
 {
 	var token = $("#lmtoken").val();
 	if(searchText == ''){searchText=='a'}
 	var formData = {'_token':token, 'q':searchText};
 	$.get('/lm/search?type=search', formData, function(data,xhr,status)
 	{
 		if(data.length==0)
 		{
 			$("#exampleCloseButton").click();
 		}
 		else
 		{
 			var tr;
 			$("#directempstable > tbody").html("");
 			$.each(data, function(index,item)
 			{
 				var urlobj = "goaddr('/lm/objectives_a?isemp="+item.id+"')";
 				var urlrate = "goaddr('/lm/rate?isemp="+item.id+"')";
 				if(item.sex=='M')
 				{
 					//tr+="<tr><th><i class='fa fa-male'></i></th><th><img class='img-circle img-bordered img-bordered-primary' alt='avatar' src='../../../upload/"+item.image+"' style='width:50px;height:50px;'> "+item.name+"</th><th>"+item.emp_num+"</th><th>"+jobrole+"</th><th><button type='button' class='btn btn-floating btn-success btn-sm' title='L.M. Goal' onclick='"+urlobj+"'><i class='icon wb-pencil' aria-hidden='true'></i></button><button type='button' class='btn btn-floating btn-danger btn-sm' title='Rate Employee' onclick='"+urlrate+"'><i class='icon wb-star' aria-hidden='true'></i></button></th></tr>";
 					tr+='<tr><th><i class="fa fa-male"></i></th><th><img class="img-circle img-bordered img-bordered-primary" alt="avatar" src="../../../upload/'+item.image+'" style="width:50px;height:50px;"> '+item.name+'</th><th>'+item.emp_num+'</th><th>'+item.job_id+'</th><th><button type="button" class="btn btn-floating btn-success btn-sm" title="L.M. Goal" onclick="'+urlobj+'"><i class="icon wb-pencil" aria-hidden="true"></i></button><button type="button" class="btn btn-floating btn-danger btn-sm" title="Rate Employee" onclick="'+urlrate+'"><i class="icon wb-star" aria-hidden="true"></i></button></th></tr>';
 				}
 				else
 				{
 					//tr+="<tr><th><i class='fa fa-female'></i></th><th><img class='img-circle img-bordered img-bordered-primary' alt='avatar' src='../../../upload/"+item.image+"' style='width:50px;height:50px;'> "+item.name+"</th><th>"+item.emp_num+"</th><th>"+jobrole+"</th><th><button type='button' class='btn btn-floating btn-success btn-sm' title='L.M. Goal' onclick='"+urlobj+"'><i class='icon wb-pencil' aria-hidden='true'></i></button><button type='button' class='btn btn-floating btn-danger btn-sm' title='Rate Employee' onclick='"+urlrate+"'><i class='icon wb-star' aria-hidden='true'></i></button></th></tr>";
 					tr+='<tr><th><i class="fa fa-female"></i></th><th><img class="img-circle img-bordered img-bordered-primary" alt="avatar" src="../../../upload/'+item.image+'" style="width:50px;height:50px;"> '+item.name+'</th><th>'+item.emp_num+'</th><th>'+item.job_id+'</th><th><button type="button" class="btn btn-floating btn-success btn-sm" title="L.M. Goal" onclick="'+urlobj+'"><i class="icon wb-pencil" aria-hidden="true"></i></button><button type="button" class="btn btn-floating btn-danger btn-sm" title="Rate Employee" onclick="'+urlrate+'"><i class="icon wb-star" aria-hidden="true"></i></button></th></tr>';
 				}
 			});
 		}
 		$("#directempstable").append(tr);
 	});
 }

 function getJobRole(id)
 {
 	var token = $("#lmtoken").val();
 	var retVal = "";
 	var token = $("#lmtoken").val();
 	var formData = {'_token':token, 'id':id};
 	$.get('/lm/job', formData, function(data,xhr,status){
 		retVal = data;
 	});
 	console.log(retVal);
 	return retVal;
 }