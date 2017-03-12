@extends('layouts.app')

@section('content')
<script>
$(function (){
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

	//$('.get-org-chart a').hide();
 
   var peopleElement = document.getElementById("people");
            var orgChart = new getOrgChart(peopleElement, {
                theme: "tal", 
				enablePrint: true,
				 scale: 0.4,
				color: "blue",
				enableDetailsView: false,
				enableEdit:false,
				subtreeSeparation: 200,
                linkType: "M",
				enableZoom: true,
                primaryFields: ["name", "title", "phone", "mail"],
                photoFields: ["image"],
                enableGridView: true,
                dataSource: document.getElementById("orgChartData")
            });
 
 
});
  </script>
  <style>
 
  
  
  
  </style>
<input type="hidden" value="{{csrf_token()}}" id="token" />
<div class="page-header">
  <h1 class="page-title">{{_t('Organisational Chart')}}</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">{{_t('Home')}}</a></li>
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

	<div style="height:100%;width:100%;" id="people"></div>
	@if(count($users)>0)
    <div style="float: right; width: 10%; height:100%; text-align:center; display:none ;" >
        <table id="orgChartData">
            <tr>
                <th>id</th>
                <th>parent id</th>
                <th>name</th>
                <th>phone</th>
                <th>mail</th>
                <th>address</th>
                <th>title</th>
                <th>image</th>
            </tr>
             
          @foreach($users as $user)
			<tr>
                <td>{{$user->id}}</td>
                <td>{{$user->parentId}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->mail}}</td>
                <td>{{$user->address}}</td>
                <td>{{app('App\Http\Controllers\ProjectController')->jobtitle($user->job_id)}} </td>
                <td>{{asset($user->image)}}</td>
			</tr>
			@endforeach
           
         
            
            
            
        </table>
		@endif
    </div>
@endsection

