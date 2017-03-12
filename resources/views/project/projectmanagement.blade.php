@extends('layouts.app')

@section('content')
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
<script>
function setprojtype(type=1){
	
	if(type==0){
		sessionStorage.setItem('setprojtype',0);
		$('.assigned_to_id').show();
		$('.client_name').show();
		$('#addpjbtn').text('{{_t('Add Project')}}');
	}
	else{
		$('#addpjbtn').text('{{_t('Update Project')}}');
		sessionStorage.setItem('setprojtype',1);
	}
	
}
function projectid(id){
 
	sessionStorage.setItem('prjid',id);
    sessionStorage.setItem('type',1);
	$('#tskbtn').text('{{_t('Create Task')}}');
}
function completetask(id){
	
	$.get('{{url('project')}}/'+id+'/edit',{
		
		task:"1"
		
	},function(data,status,xhr){
		
		if(xhr.status==200){
			console.log(data);
			if(data==1){
				
			toastr.success('{{_t('Task Mark as Completed')}}');
			$('#status'+id).html('<i class="text text-success">{{_t('completed')}}</i>');	
			}
			else{
				
			toastr.warning('{{_t('Task Mark as Pending')}}');
				$('#status'+id).html('<i class="text text-warning">{{_t('pending')}}</i>');	
			
			}
		}
		else{
			toastr.error('{{_t('Some Error Occurred')}}');
	
		}
		
		
	});
	
}
 function completeproject(id){
	
	$.get('{{url('project')}}/'+id+'/edit',{
		
		projectme:'project'
		
	},function(data,status,xhr){
		
		if(xhr.status==200){
		
			if(data.start==1){
					toastr.success('{{_t('Project Mark as Completed')}}');
			$('#prjstatus'+id).html('<i class="text text-success">{{_t('completed')}}</i>');	
			$('#enddate'+id).html(data.date);	
			}
			else{
					toastr.success('{{_t('Project Mark as Pending')}}');
				$('#prjstatus'+id).html('<i class="text text-warning">{{_t('pending')}}</i>');	
				$('#enddate'+id).html(data.date);
			}
		}
		else{
			toastr.error('{{_t('Some Error Occurred')}}');
	
		}
		
		
	});
	
	
	
 }
$(function (){
	
	
	
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

});


</script>
<style>
  .center {text-align: center; margin-left: auto; margin-right: auto; margin-bottom: auto; margin-top: auto;}
  b{
	  font-weight:bold;
  }

</style>
<input type="hidden" value="{{csrf_token()}}" id="token" />
<div class="page-header">
  <h1 class="page-title">{{_t('Project Management')}}</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('home')}}">{{_t('Home')}}</a></li>
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

<div class="container">
  <div class="row">
    <div style="height:150px;" class="col-lg-4 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white">
                 <a style="text-decoration:none; color:white;" href="{{url(session('locale').'/project')}}/total"> <i class="icon icon-circle icon-2x wb-clipboard bg-red-600" aria-hidden="true"></i></a>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number">{{app('App\Repositories\ProjectRepository')->projectstat(0)}}</span>
                    <span class="counter-number-related text-capitalize">{{_t('projects')}}</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">{{_t('in total')}}</div>
                </div>
              </div>
              <!-- End Card -->
            </div>  
			<div style="height:150px;" class="col-lg-4 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white">
                  <a style="text-decoration:none;color:white;" href="{{url(session('locale').'/project')}}/pending">  <i class="icon icon-circle icon-2x wb-alert bg-yellow-600" aria-hidden="true"></i></a>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number">{{app('App\Repositories\ProjectRepository')->projectstat(2)}}</span>
                    <span class="counter-number-related text-capitalize">{{_t('projects')}}</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">{{_t('is pending')}}</div>
                </div>
              </div>
              <!-- End Card -->
            </div> 
			<div style="height:150px;" class="col-lg-4 col-xs-12">
              <!-- Card -->
              <div class="card card-block p-35 clearfix">
                <div class="pull-xs-left white">
                 <a style="text-decoration:none;color:white;" href="{{url(session('locale').'/project')}}/completed"><i class="icon icon-circle icon-2x  wb-check bg-green-600" aria-hidden="true"></i></a>
                </div>
                <div class="counter counter-md counter text-xs-right pull-xs-right">
                  <div class="counter-number-group">
                    <span class="counter-number">{{app('App\Repositories\ProjectRepository')->projectstat(1)}}</span>
                    <span class="counter-number-related text-capitalize">{{_t('projects')}}</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">{{_t('is completed')}}</div>
                </div>
              </div>
              <!-- End Card -->
            </div>
			<div class="col-md-12" style="margin-top:30px;"></div>
       <div class="col-md-12">
          <div class="panel ">
            <div class="panel-heading">
              <h3 style="display:inline-block" class="panel-title">{{_t('Project List')}}</h3>
			  <div class="col-md-3 form-group pull-right" style="margin-top:10px;">
			  <form action="{{url('project')}}" method="GET" >
                  <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search...">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-primary"><i class="icon wb-search" aria-hidden="true"></i></button>
                    </span>
                  </div>
			</form>
                </div>
            </div>
            <div class="panel-body">
			@if(count($projects)>0)
				
			<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
			<?php  $i=2;  ?>
					@foreach($projects as $project)
					
					@if($i%2==0)
					<?php	$class="panel-warning";   ?>
					@else
					<?php	$class="panel-success";   ?>	
					@endif
                  <div class="panel {{$class}} panel-line">
                    <div class="panel-heading" id="exampleHeadingDefaultOne" role="tab">
                      <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne{{$project->id}}" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultOne">
                      {{$project->name}}({{$project->code}})
					  
                    </a>
                    </div>
                    <div class="panel-collapse collapse" id="exampleCollapseDefaultOne{{$project->id}}" aria-labelledby="exampleHeadingDefaultOne" role="tabpanel" aria-expanded="false" style="height: 0px;">
                      <div class="panel-body">
					  <div class="btn-group">
					  
					  </div>
                        <table class="table table-responsive table-striped " >
								<tr>
									<td><b>{{_t('Action')}}</b></td>
									<td>
					<button style="border:none" title="Mark as Completed" class="btn btn-icon btn-pure btn-success btn-sm"  onclick="completeproject('{{$project->id}}')"><i class="wb-check" ></i></button>
					  
					 @if(Auth::user()->role==3 && Auth::user()->role==2 )
					<button style="border:none" title="Delete Task" class="btn btn-icon btn-pure btn-danger btn-sm"  onclick="deleteproject('{{$project->id}}')"><i class="wb-trash" ></i></button>
					@endif
					
					<button data-target="#addProjectForm" data-toggle="modal" style="border:none" title="Edit Task" class="btn btn-icon btn-pure btn-warning btn-sm"  onclick="editproject('{{$project->id}}','{{$project->name}}','{{$project->code}}','{{getyear($project->start_date,0)}}','{{getyear($project->end_est_date,0)}}','{{$project->remark}}')"><i class="wb-edit" ></i></button> 
					  </td>
								
								</tr><tr>
									<td><b>{{_t('Project Name')}}</b></td>
									<td>{{$project->name}}</td>
								
								</tr>
								<tr>
									<td><b>{{_t('Project Code')}}</b></td>
									<td>{{$project->code}}</td>
								
								</tr>
								<tr>
									<td><b>{{_t('Project Status')}}</b></td>
									<td id="prjstatus{{$project->id}}">@if($project->status==0)  
										<i class="text text-warning">{{_t('pending')}}</i> @else 
										<i class="text text-success">{{_t('completed')}}</i>
											@endif </td>
								
								</tr>
								<tr>
									<td><b>{{_t('Start Date')}}</b></td>
									<td>{{getyear($project->start_date,0)}}
									</td>
								
								</tr>
								<tr>
									<td><b>{{_t('Estimated Ending Date')}}</b></td>
									<td>{{getyear($project->end_est_date,0)}}</td>
								
								</tr>
								<tr>
									<td><b>{{_t('Duration')}}</b></td>
									<td><?php $date=getyear($project->start_date,1); 
											$date1= \Carbon\Carbon::parse($project->start_date);
											$date2= \Carbon\Carbon::parse($project->end_est_date);
									?>	{{$date1->createFromDate($date[0],$date[1],$date[2])->diff($date2)->format('%y yr(s), %m mth(s) and %d day(s)')}}</td>
								
								</tr>
								
								<tr>
									<td><b>{{_t('Actual Ending Date')}}</b></td>
									<td id="enddate">{{getyear($project->actual_ending_date,0)}}</td>
								
								</tr>
								<tr>
									<td><b>{{_t('Early/Late')}}</b></td>
									<td id="enddate">
									<?php 
									
									$enddate=date('Ymd',strtotime($project->end_est_date));
									$actualendate=date('Ymd',strtotime($project->actual_ending_date));
									
									?>
									@if($enddate>=$actualendate) 
										<i class="text text-success">{{_t('Early')}} </i>
									@else
										<i class="text text-danger">{{_t('Late')}}</i>	
									@endif
									
									</td>
								
								</tr>
								<tr>
									<td><b>{{_t('Project Manager')}}</b></td>
									<td>
									<?php  $managers=app('App\Repositories\ProjectRepository')->getname($project->id); ?>
									 @foreach($managers as $manager)
									 {{$manager['name']}},
									 @endforeach
									
									</td>
								
								</tr><tr>
								<?php  $gettasks=app('App\Repositories\ProjectRepository')->gettask($project->id);   ?>
									<td><b>{{_t('Project Task')}}</b></td>
									<td>
									@if(count($gettasks)>0)
										 @if(Auth::user()->role==3 || Auth::user()->role==2)
								  <button class="btn btn-icon btn-danger btn-sm" data-target="#addtasks" data-toggle="modal" onclick="projectid('{{$project->id}}')"><i class="fa fa-add" ></i>Add Task</button><br><br>@endif
										<table>
												@foreach($gettasks as $task )
										    <tr>
											<td style="font-weight:bold">{{$task->name}}</td>
											<td>{{$task->froms}} <b>to</b></td>
											<td>{{$task->tos}}</td>
											<td id="status{{$task->id}}">@if($task->status==0) <i class="text text-warning">{{_t('pending')}}</i> @else <i class="text text-success">{{_t('completed')}}</i>  @endif
											</td>
											<td>  
											<button style="border:none" title="Mark as Completed" class="btn btn-icon btn-pure btn-success btn-sm"  onclick="completetask('{{$task->id}}')"><i class="wb-check" ></i>
											</button>
											 @if(Auth::user()->role==3)
											<button style="border:none" title="Mark as Completed" class="btn btn-icon btn-pure btn-danger btn-sm"  onclick="deletetask('{{$task->id}}')"><i class="wb-trash" ></i>
											</button>
											@endif
											 @if(Auth::user()->role==3 || Auth::user()->role==2)
											<button data-target="#addtasks" data-toggle="modal" style="border:none" title="Edit Task" class="btn btn-icon btn-pure btn-warning btn-sm"  onclick="edittask('{{$task->id}}','{{$task->name}}','{{$task->froms}}','{{$task->tos}}')"><i class="wb-edit" ></i></button>
										    @endif
											</td>
											</tr>
											<?php   $i++; ?>
												@endforeach
										  
										</table>
										 @else
											  @if(Auth::user()->role==3 || Auth::user()->role==2)
											  <button class="btn btn-icon btn-danger btn-sm" data-target="#addtasks" data-toggle="modal" onclick="projectid('{{$project->id}}')"><i class="fa fa-add" ></i>{{_t('Add Task')}}</button>
												@endif
										 
											@endif
									</td>
								
								</tr><tr>
									<td><b>{{_t('Remark')}}</b></td>
									<td>{{$project->remark}}</td>
								
								</tr>
						
						</table>
                      </div>
                    </div>
                  </div>
				  @endforeach
                </div>
			@else
				<h3 class="alert alert-info">{{_t('No Project Found!')}}</h3>
			@endif
		 	  </div>
			  {!! $projects->render() !!}
        </div>
        
    </div>
  </div>
  </div>
  @if(Auth::user()->role==2 || Auth::user()->role==3)
  <button onclick="setprojtype(0)" class="site-action btn-raised btn btn-success btn-floating" data-target="#addProjectForm" data-toggle="modal" type="button">
    <i class="icon wb-plus" aria-hidden="true"></i>
  </button>
  @endif
   @include('partials.addtask')
  @include('partials.addproject')
@endsection
 
    </body>
</html>
