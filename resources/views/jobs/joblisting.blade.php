@extends('layouts.app_guest')

@section('content')
<script src="../../global/vendor/jquery/jquery.js"></script>
<script>
  function url(url)
  {	
   window.location=url;
 }
</script>
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
<br>
<div class="col-md-12">
  <div class="col-md-3">
    <div class="panel panel-bordered">
      <div class="panel-heading">
        <h3 class="panel-title">Filter Jobs</h3>
      </div>
      <div class="panel-body">
        <form id="searchForm">
          <input type="hidden" name="vKey" id="vKey" value="{{ csrf_token() }}">
          <div class="row">
            <div class="form-group">
            <label class="control-label sm-select-label">Years of Experience</label>
              <select class="sm-select form-control" id="experience">
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
              <select class="sm-select form-control" id="jobtype">
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
              <select class="sm-select form-control" id="emptype">
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
              <select class="sm-select form-control" id="deptfil">
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
              <select class="sm-select form-control" id="dateposted">
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
              <select class="sm-select  form-control" id="location">
                <option value="0">-all-</option>
                @foreach($states as $state)
                <option value="{{ $state->id }}">{{$state->state}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-warning btn-raised btn-animate btn-animate-side" style="width: 200px;margin: 0px auto;margin-left: 25px;margin-right: 25px;">
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
                <button type="button" class="btn btn-icon social-facebook" data-placement="top" data-toggle="tooltip" title="Like">
                  <i class="icon bd-facebook" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-icon social-twitter" data-placement="bottom" data-toggle="tooltip" title="Tweet">
                  <i class="icon bd-twitter" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-icon social-linkedin" data-placement="left" data-toggle="tooltip" title="Share">
                  <i class="icon bd-linkedin" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-icon btn-danger" data-placement="top" data-toggle="tooltip" title="Send as mail">
                  <i class="icon wb-link-intact"></i>
                </button>
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
                  <div class="col-md-12 col-xs-12">
                    <h4>OTHER SKILLS</h4>
                    <ul>
                      <li>
					  {{$result->otherskill}}
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
                  <button type="button" class="btn btn-icon social-facebook" data-placement="top" data-toggle="tooltip" title="Like">
                    <i class="icon bd-facebook" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-icon social-twitter" data-placement="bottom" data-toggle="tooltip" title="Tweet">
                    <i class="icon bd-twitter" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-icon social-linkedin" data-placement="left" data-toggle="tooltip" title="Share">
                    <i class="icon bd-linkedin" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-icon btn-danger" data-placement="top" data-toggle="tooltip" title="Send as mail">
                    <i class="icon wb-link-intact"></i>
                  </button>
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
                  <button type="button" class="btn btn-icon social-facebook" data-placement="top" data-toggle="tooltip" title="Like">
                    <i class="icon bd-facebook" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-icon social-twitter" data-placement="bottom" data-toggle="tooltip" title="Tweet">
                    <i class="icon bd-twitter" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-icon social-linkedin" data-placement="left" data-toggle="tooltip" title="Share">
                    <i class="icon bd-linkedin" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-icon btn-danger" data-placement="top" data-toggle="tooltip" title="Send as mail">
                    <i class="icon wb-link-intact"></i>
                  </button>
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
                    <div class="col-md-12 col-xs-12">
                      <h4>OTHER SKILLS</h4>
                      <ul>
                        <li>
						{{$job->otherskill}}
                        </li>
                       
                      </ul>
                    </div>
                    <div class="col-md-12 col-xs-12 pull-right">
                      <button type="button" class="btn btn-raised btn-success btn-lg" onclick="url('{{url('available_jobs')}}/jobs?id={{$job->id}}')"><i class="icon wb-dropright"></i> Apply</button>
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
