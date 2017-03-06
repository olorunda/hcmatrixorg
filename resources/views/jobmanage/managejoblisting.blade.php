@extends('layouts.app')

@section('content')
<script src="../../global/vendor/jquery/jquery.js"></script>
<script>
  function url(url)
  {	
   window.location=url;
 }
 
 function modifypos(id){
	    
		
		
		title=$('#jobtitle'+id).val();
		job_desc=$('#jobjob_desc'+id).val();
		date_expire=$('#jobdate_expire'+id).val();
		 required_exp=$('#jobrequired_exp'+id).val();
		 qualification=$('#jobqualification'+id).val();
		 jobref=$('#jobjob_ref'+id).val();
	     otherskill=$('#jobotherskill'+id).val();
		 locations=$('#joblocation_id'+id).val();
		 specid=$('#jobspec_id'+id).val();
		 
		 typeid=$('#jobtype_id'+id).val();
		 levelid=$('#joblevel_id'+id).val();
		 minsal=$('#jobmin_sal'+id).val();
		 maxsal=$('#jobmax_sal'+id).val();
		 minexp=$('#jobmin_exp'+id).val();
		 maxexp=$('#jobmax_exp'+id).val(); 
		 
		 
		   $('#requirement').val($('#jobqualification'+id).val());
		
		 $('#hidemod').show();
		 $('#showhide').hide();
		  $('#sumjob').addClass('mod');
		  $('#sumjob').removeClass('add');
		$('#title').val(title);
		$('#jobref').val(jobref);
		$( "#jobref" ).prop( "disabled", true );
		$('#description').val(job_desc);
	   
		$('#state').prop('selectedIndex', locations);
		$('#specid').prop('selectedIndex', specid);
		$('#levelid').prop('selectedIndex', typeid);
		$('#typeid').prop('selectedIndex', levelid);
		$('#expdate').val(date_expire);
	
		$('#jobref').val($('#jobjob_ref'+id).val());
		
		$('#requiredexp').val($('#jobrequired_exp'+id).val());
		
	    $('#requirement').val($('#jobqualification'+id).val());
		$('#otherskill').val($('#jobotherskill'+id).val());
		
		

	 
	 
 }
 function showadd(){
	 
	 
	  
		
		$('#title').val('');
		$('#jobref').val('');
		$( "#jobref" ).prop( "disabled", false );
		$('#description').val('');
	   
		
		$('#expdate').val('');
	
		$('#jobref').val('');
		
		$('#requiredexp').val('');
		
	    $('#requirement').val('');
		$('#otherskill').val('');
		
		
	 
 $('#hidemod').hide();
	 $('#showhide').show();
	 $('#sumjob').addClass('add');
	 $('#sumjob').removeClass('mod');
		 
 }
 function jobsend(type){
		 var range=$('#range').val().split(';');
		 var expyear=$('#expyear').val().split(';');
	
			var title=$('#title').val();
			var departid=$('#departid').val();
			var taketest=$('#taketest').val();
			var description=$('#description').val();
			var requirement=$('#requirement').val();
			var otherskill=$('#otherskill').val();
			var token=$('#token').val();
			var expdate=$('#expdate').val();
			var experiencereq=$('#experiencereq').val();
			var state=$('#state').val();
			var jobref=$('#jobref').val();
			var typeid=$('#typeid').val();
			var requiredexp=$('#requiredexp').val();
			var specid=$('#specid').val();
			var levelid=$('#levelid').val();
					if(specid==null){
				toastr.error("Some Fields are blank");	
					return;
					}
			//return alert(specid);
						
	$.post('{{url('savelisting')}}/'+type,{
		
		title:title,
		departid:departid,
		taketest:taketest,
		levelid:levelid,
		description:description,
		state:state,
		requirement:requirement,
		_token:token,
		otherskill:otherskill,
		froms:range[0],
		to:range[1],
		min_exp:expyear[0],
		max_exp:expyear[1],
		state:state,
		job_ref:jobref,
		type_id:typeid,
		spec_id:specid,
		required_exp:requiredexp,
		experiencereq:experiencereq,
		exp_date:expdate
	},function(data,status,xhr){
		//alert(data);
		if(xhr.status!=200){
			
				return toastr.error('Some error occurred');
			}
			else{
				if(type==1){
					toastr.success('Job Successfully Added');
				}
				else{
				toastr.success('Job Modified Successfully');	
			
				}
			setTimeout(function(){ window.location.reload(); },2000);
			}
		
	});	 
	 
	 
 }
 
 
 
 $(function(){
	 $('#hidemod').hide();
      $('#sumjob').removeClass('mod');
	
	//modify table
	 $('.mod').click(function(){
		 
		 event.preventDefault();
		 jobsend(2);
	 });
	 
	 
	 $('.add').click(function(){
		 
		 event.preventDefault();
		jobsend(1);			
							 
	 }); 
	 
 });
 
</script>
<input type="hidden" id="token" value="{{csrf_token()}}" />
<style type="text/css">
  .panel-group .panel-title:after, .panel-group .panel-title:before {
    position: absolute;
    top: 15px;
    right: 30px;
    font-family: "Web Icons";
    -webkit-transition: all .3s linear 0s;
    -o-transition: all .3s linear 0s;
    transition: all .3s linear 0s;
    color: #f0ad4e !important;
    border-color: #d43f3a;
    font-size: 18px;
  }
  a > h4:hover{
    color: #04c;
  }
</style>
<h1 class="page-title" style="position: relative;left: 10px;top: -10px;margin-bottom: -10px;">Jobs</h1>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="javascript:void(0)">Available Jobs</a></li>
  <li class="breadcrumb-item active">You are Here</li>
</ol>

<div class="row">
  <div class="col-md-4 col-xs-12" style="background-color:white; margin-right: -25px; margin-top:-13px; margin-right:-10px; border-radius:5px;">
    <input required  type="text"  id="schexpyear" data-plugin="ionRangeSlider" data-min=0 data-max=25 data-from=2  data-prefix="Year(s)"  data-type="double" data-grid="true">
  </div>
  <div class="col-md-4 col-xs-12" style="margin-right: -25px;">
    <select class="form-control" id="departid" data-plugin="select2" data-allow-clear="true">
      <option value="0">Departments (all)</option>
	  	@if(count($specs)>0)
									@foreach($specs as $spec)
							<option value="{{$spec->id}}">{{$spec->spec}}</option>
									@endforeach
									@endif
    </select>
  </div>
  <div class="col-md-4 col-xs-12">
    <button type="button" class="btn btn-sm btn-icon btn-warning pull-right" style="position: relative;top: 2px;left: 45px;"><i class="icon wb-search"></i></button>
    <select class="form-control" id="location" data-plugin="select2" data-allow-clear="true" style="width: 100%;margin-right: -55px;">
      <option value="0">Location (all)</option>
      @foreach($states as $state)
      <option value="{{$state->id}}">{{$state->state}}</option>
      @endforeach
    </select>
  </div>
</div>
<br>

@if(count($availablejob))
@foreach($availablejob as $job)
<div class="panel" style="margin-bottom: 4px;">
  <div class="panel-body">
   <div class="ribbon ribbon-clip ribbon-reverse ribbon-success">
    <span style="cursor:pointer"  class="ribbon-inner" title="Apply" onclick="modifypos('{{$job->id}}')" data-target="#addjobs" data-toggle="modal">
	Modify Job
    </span>
<input type="hidden" id="jobtitle{{$job->id}}" value='{{$job->title}}' />
<input type="hidden" id="jobjob_desc{{$job->id}}" value='{{$job->job_desc}}' />
<input type="hidden" id="jobrequired_exp{{$job->id}}" value='{{$job->required_exp}}' />
<input type="hidden" id="jobdate_expire{{$job->id}}"  value='{{$job->date_expire}}' />
<input type="hidden" id="jobqualification{{$job->id}}"   value='{{$job->qualification}}' />
<input type="hidden" id="jobjob_ref{{$job->id}}"  value='{{$job->job_ref}}' />
<input type="hidden" id="jobotherskill{{$job->id}}"  value='{{$job->otherskill}}' />
<input type="hidden" id="joblocation_id{{$job->id}}"  value='{{$job->location_id}}' />
<input type="hidden" id="jobspec_id{{$job->id}}"  value='{{$job->spec_id}}' />
<input type="hidden" id="jobtype_id{{$job->id}}"  value='{{$job->type_id}}' />
<input type="hidden" id="joblevel_id{{$job->id}}"  value='{{$job->level_id}}' />
<input type="hidden" id="jobmin_sal{{$job->id}}"  value='{{$job->min_sal}}' />
<input type="hidden" id="jobmax_sal{{$job->id}}"  value='{{$job->max_sal}}' />
<input type="hidden" id="jobmin_exp{{$job->id}}"  value='{{$job->min_exp}}' />
<input type="hidden" id="jobmax_exp{{$job->id}}"  value='{{$job->max_exp}}' />
  </div>
  <div  class="ribbon ribbon-clip">
     <span style="cursor:pointer" onclick="url('{{url('applicant')}}/job?id={{$job->id}}')" class="ribbon-inner" >View Applicants</span>
  </div>
    <div class="panel-group panel-group-simple" id="siteMegaAccordion" aria-multiselectable="true" role="tablist">
      <div class="panel">
        <div class="panel-heading" id="siteMegaAccordionHeadingThree" role="tab">
          <a class="panel-title" data-toggle="collapse" href="#siteMegaCollapseThree{{$job->id}}" data-parent="#siteMegaAccordion" aria-expanded="false" aria-controls="siteMegaCollapseThree{{$job->id}}">
            <h4 class="text-warning">{{$job->title}}</h4>
            <span class="text-default">
			{{substr($job->job_desc,1,300)}}...
            </span>
          </a>
        </div>
        <div class="panel-collapse collapse" id="siteMegaCollapseThree{{$job->id}}" aria-labelledby="siteMegaAccordionHeadingThree" role="tabpanel">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <h4>SUMMARY</h4>
                <ul>
                  <li>
				  {{$job->job_desc}}
                  </li>
                </ul>
              </div>
              <div class="col-md-12 col-xs-12">
                <h4>EXPERIENCE REQUIRED</h4>
                <ul>
                  <li>
				  {{$job->required_exp}}
                  </li>
                  
                </ul>
              </div>
              <div class="col-md-12 col-xs-12">
                <h4>JOB DESCRIPTION</h4>
                <ul>
                  <li>
                   {{$job->job_desc}}
                  </li>
                </ul>
              </div>
              <div class="col-md-12 col-xs-12">
                <h4>EDUCATIONAL REQUIREMENTS</h4>
                <ul>
                  <li>{{$job->qualification}}</li>
                </ul>
              </div>
              <div class="col-md-12 col-xs-12">
                <h4>OTHER SKILLS</h4>
                <ul>
                  <li>
				  {{$job->otherskill}}
                  </li>
                  </ul>
              </div>
              <div class="col-md-12 col-xs-12 pull-right">
			  
			 <a href="http://www.facebook.com/share.php?u={{url('available_jobs')}}/jobs?id={{$job->id}}&title={{$job->title}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn btn-tagged social-facebook">
                    <span class="btn-tag"><i class="icon wb-share" aria-hidden="true"></i></span>Facebook</a>
					
				<a href="http://www.linkedin.com/shareArticle?mini=true&url={{url('available_jobs')}}/jobs?id={{$job->id}}&title={{$job->title}}&source={{url('/')}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn btn-tagged social-linkedin">
                    <span class="btn-tag"><i class="icon wb-share" aria-hidden="true"></i></span>Linkedin</a>
					
					<a href="http://twitter.com/home?status={{$job->title}}+{{url('available_jobs')}}/jobs?id={{$job->id}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"  class="btn btn-tagged social-twitter">
                    <span class="btn-tag"><i class="icon wb-share" aria-hidden="true"></i></span>Twitter</a>
					
					<a href="https://plus.google.com/share?url={{url('available_jobs')}}/jobs?id={{$job->id}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"    class="btn btn-tagged social-google-plus">
                    <span class="btn-tag"><i class="icon wb-share" aria-hidden="true"></i></span>Google+</a>
              </div>
            </div>
          </div>
        </div>
      </div>
	 
	

    </div>
  </div>
</div>

@endforeach

 {!! $availablejob->render() !!}
 @else
	 <h3 style="align:center" class="text-center text-danger">No Job Posing Has Been Made This Year , Click on the Plus Button to add below to add new Job posting </h3>
@endif
	@include('partials.addjob')
  <div class="site-action" data-plugin="actionBtn">
	  <button type="button" onclick="showadd()" class="site-action-toggle btn-raised btn btn-success btn-floating pull-left"  data-target="#addjobs" data-toggle="modal" >
      <i class="front-icon wb-plus animation-scale-up" aria-hidden="true"></i>
      <i class="back-icon wb-close animation-scale-up" aria-hidden="true"></i>
    </button>
	</div>
@endsection
