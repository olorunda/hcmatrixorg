@if(Auth::user()->role==0)
	@extends('layouts.app_guest')
	@else
@extends('layouts.app')
	@endif

@section('content')
<script>
$(function (){
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

});


</script>
<input type="hidden" value="{{csrf_token()}}" id="token" />
<div class="page-header">
  <h1 class="page-title">Jobs Applied For</h1>
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
<div class="page-content" >
<div class="panel panel-primary panel-line">
            <div class="panel-heading">
              <h3 class="panel-title">Job Applied For</h3>
            </div>
            <div class="panel-body">
	<div class="table-responsive">
		<table class="table table-hover">
		<thead class="bg-blue-grey-100">
			<tr>
			<th>Job Title</th>
			<th>Date Applied</th>
			</tr>
		</thead>
		<tbody>
		@if(count($appliedfor) > 0)
			@foreach($appliedfor as $job)
			
			<tr>
				<td><a target="_blank" style="text-decoration:none" href="{{url('available_jobs/jobs?id=')}}{{$job->id}}" >{{$job->title}}</a></td>
				<?php $carbondate=Carbon\Carbon::parse($job->appdate); ?>
				<td> {{$carbondate->diffForHumans()}} </td>
			</tr>
			
			@endforeach
		@else
			<div class="alert alert-danger">
				<h3>You have not applied for any job yet.</h3>
			</div>
		@endif
		</tbody>
		</table>
		
		{{ $appliedfor->links() }}
		
	</div>
	</div>
          </div>
</div>
 
@endsection
