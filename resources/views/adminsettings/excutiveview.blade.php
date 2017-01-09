@extends('layouts.app')

@section('content')
<script>
$(function (){
  setInterval(function(){
   
     $('#time').html(new Date(new Date().getTime()).toLocaleTimeString());

	 
 },1000);

});


</script>
<input type="hidden" value="{{csrf_token()}}" id="token" />
<!-- <div class="page-header">
  <h1 class="page-title">Job/Department Settings</h1>
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
  
</div> -->

<div >

<iframe width="100%" height="800px" src="https://app.powerbi.com/view?r=eyJrIjoiYjZkOGE0NGItNzFlNS00MTY3LWJhODYtZDdhNGUxYzk2MmJhIiwidCI6ImJhMTMwZWNhLTMwMzAtNDhlMS05MDg5LWM5NzkyOTNhZWI3MCIsImMiOjh9" frameborder="0" allowFullScreen="true"></iframe>


</div>
@endsection
