 
@extends('layouts.app_guest')
	 
	
@section('content')
<script src="../../global/vendor/jquery/jquery.js"></script>
<script>
  function url(url)
  { 
    window.location=url;
  }
  function urlN(url, name)
  {
    window.open(url, name, 'width=500,height=600');
  }
</script>
<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
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
  .IN-widget {
    padding-top: 0px;
    padding-right: .572rem;
    padding-bottom: 0px;
    padding-left: 0px;
    padding-right: .572rem;
  }
</style>
<div class="page-header">
  <h1 class="page-title">JOBS</h1>
  <ol class="breadcrumb">
	@if(Auth::guest())
	<li class="breadcrumb-item"><a href="{{ url('available_jobs/joblist') }}">Available Jobs</a></li>
    <li class="breadcrumb-item active">You are here</li>
	@else
    <li class="breadcrumb-item"><a href="{{ url('/available_jobs/applied') }}">Positions Applied For</a></li>
    <li class="breadcrumb-item active"><a href="{{ url('available_jobs/joblist') }}">Available Jobs</a></li>
	@endif
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
          <span class="counter-number font-weight-medium" id="time">{{date('h:i s a')}}</span>

        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="col-md-3">
    <div class="panel panel-bordered">
      <div class="panel-heading">
        <h3 class="panel-title">Filter Jobs</h3>
      </div>
      <div class="panel-body">
        <form id="searchForm" method="get" action="{{ url('available_jobs/filter') }}">
          <input type="hidden" name="vKey" id="vKey" value="{{ csrf_token() }}">
          <div class="row">
            <div class="form-group">
              <label class="control-label sm-select-label">Years of Experience</label>
              <select class="sm-select form-control" id="experience" name="experience">
                <option value="0">-all-</option>
                <option value="1">Entry Level</option>
                <option value="2">1 - 3 Years</option>
                <option value="3">3 - 5 Years</option>
                <option value="4">5 - 7 Years</option>
                <option value="5">7 - 10 Years</option>
                <option value="6">10 - 15 Years</option>
                <option value="7">15+</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label sm-select-label">Job Type</label>
              <select class="sm-select form-control" id="jobtype" name="jobtype">
                <option value="0">-all-</option>
                @if(count($joblevels) == 1)
                <option value="{{ $joblevels['id'] }}">{{ $joblevels['level'] }}</option>
                @elseif(count($joblevels) > 1)
                @foreach($joblevels as $joblevel)
                <option value="{{ $joblevel->id }}">{{ $joblevel->level }}</option>
                @endforeach
                @else
                @endif
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label sm-select-label">Employement Type</label>
              <select class="sm-select form-control" id="emptype" name="emptype">
                <option value="0">-all-</option>
                @if(count($jobtypes) > 0 && count($jobtypes) == 1)
                <option value="{{ $jobtypes['id'] }}">{{ $jobtypes['work_type'] }}</option>
                @elseif(count($jobtypes) > 0 && count($jobtypes) > 1)
                @foreach($jobtypes as $jobtype)
                <option value="{{ $jobtype->id }}">{{ $jobtype->work_type }}</option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label sm-select-label">Department</label>
              <select class="sm-select form-control" id="deptfil" name="deptfil">
                <option value="0">-all-</option>
                @if(count($jobdepts) == 1)
                <option value="{{ $jobdepts['id'] }}">{{ $jobdepts['dept'] }}</option>
                @elseif(count($jobdepts) > 1)
                @foreach($jobdepts as $jobdept)
                <option value="{{ $jobdept->id }}">{{ $jobdept->dept }}</option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label sm-select-label">Date Posted</label>
              <select class="sm-select form-control" id="dateposted" name="dateposted">
                <option value="0">-all-</option>
                <option value="1">Today</option>
                <option value="2">Yesterday</option>
                <option value="3">Last week</option>
                <option value="4">2 weeks</option>
                <option value="5">Last 30 days</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label sm-select-label">Location</label>
              <select class="sm-select  form-control" id="location" name="location">
                <option value="0">-all-</option>
                @foreach($states as $state)
                <option value="{{ $state->id }}">{{$state->state}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-warning btn-raised btn-animate btn-animate-side" style="width: 200px;margin: 0px auto;margin-left: 20px;margin-right: 25px;">
              <span><i class="icon fa fa-filter" aria-hidden="true"></i>Filter</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-9"> 
    @if(count($results) > 0)
    @foreach($results as $result)
    <div class="panel" style="margin-bottom: 4px;">
      <div class="panel-body">
        <div class="panel-group panel-group-simple" id="siteMegaAccordion{{$result->id}}" aria-multiselectable="true" role="tablist">
          <div class="ribbon ribbon-clip ribbon-reverse ribbon-success">
            <span class="ribbon-inner" data-toggle="tooltip" title="Apply" onclick="url('{{url('available_jobs')}}/jobs?id={{$result->id}}')">
              Apply Here
            </span>
          </div>
          <div class="panel">
            <div class="panel-heading" id="siteMegaAccordionHeadingOne{{$result->id}}" role="tab">
              <a class="panel-title" data-toggle="collapse" href="#siteMegaCollapseOne{{$result->id}}" data-parent="#siteMegaAccordion{{$result->id}}" aria-expanded="false" aria-controls="siteMegaCollapseOne{{$result->id}}">
                <h4 class="text-warning">Experience</h4>
              </a>
              <span class="text-default">
                {{$result->title}}
              </span>
              <div class="page-header-actions">
                <a href="http://www.facebook.com/share.php?u={{url('available_jobs')}}/jobs?id={{$result->id}}&title={{$result->title}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn btn-tagged social-facebook">
                    <span class="btn-tag"><i class="icon wb-share" aria-hidden="true"></i></span>Facebook</a>
					
				<a href="http://www.linkedin.com/shareArticle?mini=true&url={{url('available_jobs')}}/jobs?id={{$result->id}}&title={{$result->title}}&source={{url('/')}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn btn-tagged social-linkedin">
                    <span class="btn-tag"><i class="icon wb-share" aria-hidden="true"></i></span>Linkedin</a>
					
					<a href="http://twitter.com/home?status={{$result->title}}+{{url('available_jobs')}}/jobs?id={{$result->id}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"  class="btn btn-tagged social-twitter">
                    <span class="btn-tag"><i class="icon wb-share" aria-hidden="true"></i></span>Twitter</a>
					
					<a href="https://plus.google.com/share?url={{url('available_jobs')}}/jobs?id={{$result->id}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"    class="btn btn-tagged social-google-plus">
                    <span class="btn-tag"><i class="icon wb-share" aria-hidden="true"></i></span>Google+</a>
              </div>
            </div>
            <div class="panel-collapse collapse" id="siteMegaCollapseOne{{$result->id}}" aria-labelledby="siteMegaAccordionHeadingOne{{$result->id}}" role="tabpanel">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <h4>EXPERIENCE REQUIRED</h4>
                    <ul>
                      <li>
                        {{$result->required_exp}}
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-12 col-xs-12">
                    <h4>JOB DESCRIPTION</h4>
                    <ul>
                      <li>
                        {{$result->job_desc}}
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-12 col-xs-12">
                    <h4>EDUCATIONAL REQUIREMENTS</h4>
                    <ul>
                      <li>
                        {{$result->qualification}}
                      </li>
                    </ul>
                  </div>
                 <div class="col-md-12 col-xs-12 pull-right">
                  <button type="button" class="btn btn-raised btn-success btn-lg" onclick="url('{{url('available_jobs')}}/jobs?id={{$result->id}}')"><i class="icon wb-dropright"></i> Apply</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  @else
  <div id="avail_jobs_sect">
    @if(count($jobs) <= 0)
    <h4>No Jobs Posted Yet. please check back later.</h4>
    @elseif(count($jobs) == 1)
    <div class="panel" style="margin-bottom: 4px;">
      <div class="panel-body">
        <div class="panel-group panel-group-simple" id="siteMegaAccordion{{$jobs['id']}}" aria-multiselectable="true" role="tablist">
          <div class="ribbon ribbon-clip ribbon-reverse ribbon-success">
            <span class="ribbon-inner" data-toggle="tooltip" title="Apply" onclick="url('{{url('available_jobs')}}/jobs?id={{$jobs['id']}}')">
              Apply Here
            </span>
          </div>
          <div class="panel">
            <div class="panel-heading" id="siteMegaAccordionHeadingOne{{$jobs['id']}}" role="tab">
              <a class="panel-title" data-toggle="collapse" href="#siteMegaCollapseOne{{$jobs['id']}}" data-parent="#siteMegaAccordion{{$jobs['id']}}" aria-expanded="false" aria-controls="siteMegaCollapseOne{{$jobs['id']}}">
                <h4 class="text-warning">Experience</h4>
              </a>
              <span class="text-default">
                {{$jobs['title']}}
              </span>
              <div class="page-header-actions">
                result
              </div>
            </div>
            <div class="panel-collapse collapse" id="siteMegaCollapseOne{{$jobs['id']}}" aria-labelledby="siteMegaAccordionHeadingOne{{$jobs['id']}}" role="tabpanel">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <h4>EXPERIENCE REQUIRED</h4>
                    <ul>
                      <li>
                        {{$jobs['required_exp']}}
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-12 col-xs-12">
                    <h4>JOB DESCRIPTION</h4>
                    <ul>
                      <li>
                        {{$jobs['job_desc']}}
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-12 col-xs-12">
                    <h4>EDUCATIONAL REQUIREMENTS</h4>
                    <ul>
                      <li>
                        {{$jobs['qualification']}}
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-12 col-xs-12">
                    <h4>OTHER SKILLS</h4>
                    <ul>
                      <li>
                        {{$jobs['otherskill']}}
                      </li>

                    </ul>
                  </div>
                  <div class="col-md-12 col-xs-12 pull-right">
                    <button type="button" class="btn btn-raised btn-success btn-lg" onclick="url('{{url('available_jobs')}}/jobs?id={{$jobs['id']}}')"><i class="icon wb-dropright"></i> Apply</button>
					<p></p>
					<a href="http://www.facebook.com/share.php?u={{url('available_jobs')}}/jobs?id={{$result->id}}&title={{$result->title}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn btn-tagged social-facebook">
                    <span class="btn-tag"><i class="icon wb-share" aria-hidden="true"></i></span>Facebook</a>
					
				<a href="http://www.linkedin.com/shareArticle?mini=true&url={{url('available_jobs')}}/jobs?id={{$result->id}}&title={{$result->title}}&source={{url('/')}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn btn-tagged social-linkedin">
                    <span class="btn-tag"><i class="icon wb-share" aria-hidden="true"></i></span>Linkedin</a>
					
					<a href="http://twitter.com/home?status={{$result->title}}+{{url('available_jobs')}}/jobs?id={{$result->id}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"  class="btn btn-tagged social-twitter">
                    <span class="btn-tag"><i class="icon wb-share" aria-hidden="true"></i></span>Twitter</a>
					
					<a href="https://plus.google.com/share?url={{url('available_jobs')}}/jobs?id={{$result->id}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"    class="btn btn-tagged social-google-plus">
                    <span class="btn-tag"><i class="icon wb-share" aria-hidden="true"></i></span>Google+</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @else
    @foreach($jobs as $job)
    <div class="panel" style="margin-bottom: 4px;">
      <div class="panel-body">
        <div class="panel-group panel-group-simple" id="siteMegaAccordion{{$job->id}}" aria-multiselectable="true" role="tablist">
          <div class="ribbon ribbon-clip ribbon-reverse ribbon-success">
            <span class="ribbon-inner" data-toggle="tooltip" title="Apply" onclick="url('{{url('available_jobs')}}/jobs?id={{$job->id}}')">
              Apply Here
            </span>
          </div>
          <div class="panel">
            <div class="panel-heading" id="siteMegaAccordionHeadingOne{{$job->id}}" role="tab">
              <a class="panel-title" data-toggle="collapse" href="#siteMegaCollapseOne{{$job->id}}" data-parent="#siteMegaAccordion{{$job->id}}" aria-expanded="false" aria-controls="siteMegaCollapseOne{{$job->id}}">
                <h4 class="text-warning">Experience</h4>
              </a>
              <span class="text-default">
                {{$job->title}}
              </span>
              <div class="page-header-actions">
                
              </div>
            </div>
            <div class="panel-collapse collapse" id="siteMegaCollapseOne{{$job->id}}" aria-labelledby="siteMegaAccordionHeadingOne{{$job->id}}" role="tabpanel">
              <div class="panel-body">
                <div class="row">
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
                      <li>
                        {{$job->qualification}}
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-12 col-xs-12 pull-right">
                    <button type="button" class="btn btn-raised btn-success btn-lg" onclick="url('{{url('available_jobs')}}/jobs?id={{$job->id}}')"><i class="icon wb-dropright"></i> Apply</button>
					<p></p>
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
    @endif
  </div>
  @endif
</div>
</div>
@endsection
