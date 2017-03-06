<?php  $prefix=session('locale'); ?>
<script>
  function url(url){

   window.location=url;
 }
</script> 
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url($prefix.'/home')}}')">
    <i class="site-menu-icon  wb-home" aria-hidden="true"></i>
     <span class="site-menu-title">{{ _t('Home')}}</span>

  </a>
</li>
    <?php
            $training_array = array('add-training', 'trainings-list', 'add-training-material', 'training-material-list', 'add-survey', 'survey-list', 'trainings-applied', 'enrollments-all', 'emp-trainings-list', 'emp-trainings-status', 'training-schedule-calendar', 'training-survey-list', 'trainings-applied','filled-surveys-list','filled-surveys','filled-surveys-view');
            $succession_array = array('successor-list','employee-hierarchy','nominate-successor','successorapprove','vacancy-list','project/vieworgano');
            $health_array = array('diagnosis-details','my-diagnosis-details','sick-leave-request');
            $payroll_array = array('holiday-list','basicpay-list','allowance-list','payroll-list','emp-payroll-list','edit-weekend_days','edit-casual_leaves','edit-payslip-details','my-expenses','employee-expenses');
            $leave_array = array('my-leaves','daily-attendance','employee-leaves','view-daily-attendance','daily-attendance-list','daily-attendance-settings','day-att-emp-list');
          ?>
         
@if(Auth::user()->role==3)
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url($prefix.'/hr/executiveview')}}')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
     <span class="site-menu-title">{{ _t('Executive View')}}</span>

  </a>
</li>
@endif
  @if(Auth::user()->role==Config::get('constants.roles.Admin_User') || Auth::user()->role==Config::get('constants.roles.People_Manager'))
            <li class="site-menu-item has-sub {{in_array(Request::path(), $succession_array) ? 'active open' : ''}}">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                 <span class="site-menu-title">{{ _t('Succession Planning')}}</span>
                <span class="site-menu-arrow"></span>
              </a>
              @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('employee-hierarchy') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/project/vieworgano')}}">
                     <span class="site-menu-title">{{ _t('Employees Hirerachy')}}</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('successor-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/successor-list')}}">
                     <span class="site-menu-title">{{ _t('Successors List')}}</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('vacancy-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/vacancy-list')}}">
                     <span class="site-menu-title">{{ _t('Vacancy List')}}</span>
                  </a>
                </li>
              </ul>
              @endif
              @if(Auth::user()->role==Config::get('constants.roles.People_Manager'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('successor-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/successor-list')}}">
                     <span class="site-menu-title">{{ _t('Nominated Successors')}}</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('nominate-successor') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/nominate-successor')}}">
                     <span class="site-menu-title">{{ _t('Select Successors')}}<!-- (Internal -> select from list, External -> New entry)--></span>
                  </a>
                </li>
               
              </ul>
              @endif
              </li>
              @endif
@if(Auth::user()->role>=1)
	<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url($prefix.'/outlookevent')}}')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
     <span class="site-menu-title">{{_t('Calender Events')}}</span>

  </a>
</li>
@endif
	@if(Auth::user()->role==3 ||   Auth::user()->role==2 || Auth::user()->role==1)
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url($prefix.'/view/attendancecalender')}}')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
     <span class="site-menu-title">{{ _t('Attendance 360')}}</span>

  </a>
</li><li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url($prefix.'/view-daily-attendance')}}?id={{Auth::user()->id}}')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
     <span class="site-menu-title">{{ _t('My Attendance')}}</span>

  </a>
</li>
	@endif
		@if(Auth::user()->role==3 ||   Auth::user()->role==2 || Auth::user()->role==1 )
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url($prefix.'/project/management')}}')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
     <span class="site-menu-title">{{ _t('Project Management')}}</span>

  </a>
</li>
	@endif
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url($prefix.'/employee')}}/profile_{{Auth::user()->id}}')">
    <i class="site-menu-icon  wb-user" aria-hidden="true"></i>
     <span class="site-menu-title">{{ _t('Profile')}}</span>

  </a>
  </li>
  
  @if(Auth::user()->role==2 || Auth::user()->role==3)
	  
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url($prefix.'/employee')}}/list')">
    <i class="site-menu-icon  wb-list" aria-hidden="true"></i>
     <span class="site-menu-title">{{ _t('Manage Employee')}}</span>

  </a>
  </li>
  @endif
  
  @if(Auth::user()->role==3)
   <li class="site-menu-item has-sub menuborder ">
    <a href="javascript:void(0)">
      <i class="site-menu-icon wb-stats-bars " aria-hidden="true"></i>
       <span class="site-menu-title">{{ _t('Global Settings')}}</span>
      <span class="site-menu-arrow"></span>
    </a>
 
    <ul class="site-menu-sub">
    
	   <li class="site-menu-item">
        <a class="animsition-link" href="{{url($prefix.'/hr')}}/settings">
           <span class="site-menu-title">{{ _t('All Settings')}}</span>
        </a>
      </li> 
    </ul>
	<ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('hr/payrollsetting') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url($prefix.'/hr')}}/payrollsetting">
                     <span class="site-menu-title">{{ _t('Payroll')}}</span>
                  </a>
                </li>
              </ul>
         <!--     <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('edit-casual_leaves') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/edit-casual_leaves')}}">
                     <span class="site-menu-title">{{ _t('No. of Casual Leaves Per Month')}}</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('edit-payslip-details') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/edit-payslip-details')}}">
                     <span class="site-menu-title">{{ _t('Payslip logo & watermark')}}</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('holiday-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/holiday-list')}}">
                     <span class="site-menu-title">{{ _t('Holiday List')}}</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('basicpay-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/basicpay-list')}}">
                     <span class="site-menu-title">{{ _t('Basic Pay')}}</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('allowance-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/allowance-list')}}">
                     <span class="site-menu-title">{{ _t('Salary components')}}</span>
                  </a>
                </li>
              </ul>
-->
  </li>
  
  <!--  Role Management -->
 

    @endif
	

  @if(Auth::user()->role>0)
	  
 <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
       <span class="site-menu-title">{{ _t('Record Management')}}</span>
      <span class="site-menu-arrow"></span>
    </a>  
  <ul class="site-menu-sub">
  @if(Auth::user()->role==2 || Auth::user()->role==3)
      <li class="site-menu-item">
        <a class="animsition-link" href="{{url($prefix.'/view')}}/docadmin">
           <span class="site-menu-title">{{ _t('Record Management')}}</span>
        </a>
      </li>
	@endif
	  <li class="site-menu-item">
        <a class="animsition-link"   @if(Auth::user()->role==1) href="{{url($prefix.'/view')}}/docadmin" @else href="{{url($prefix.'/view')}}/mydocument" @endif >
           <span class="site-menu-title">{{ _t('My Documents')}}</span>
        </a>
      </li>
  </ul>
  </li>
  @endif
   @if(Auth::user()->role==3)
	  
<!-- TALENT AQUISITION -->
   <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-user" aria-hidden="true"></i>
       <span class="site-menu-title">{{ _t('Talent Management')}}</span>
      <span class="site-menu-arrow"></span>
    </a>

    
    <ul class="site-menu-sub">
      <li class="site-menu-item menuborder {{active(['lm/objectives_a'])}}">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url($prefix.'/manage')}}/positions')">
           <span class="site-menu-title">{{ _t('Manage/Add Position')}}</span>
        </a>
      </li>
	  @if(Auth::user()->role==3)
	  <li class="site-menu-item menuborder {{active(['employee/uploadapptitude'])}}">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url($prefix.'/employee')}}/uploadapptitude')">
           <span class="site-menu-title">{{ _t('Upload Apptitude Test')}}</span>
        </a>
      </li>
	  @endif
       </ul>
   
  </li>

  @endif

  @if(Auth::user()->role!=0 )
  <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
       <span class="site-menu-title">{{ _t('Performance Management')}}</span>
      <span class="site-menu-arrow"></span>
    </a>
	@endif
    @if(Auth::user()->role==1 )
    <ul class="site-menu-sub">
      <li class="site-menu-item">
        <a class="animsition-link" href="{{url($prefix.'/employee')}}/goalsview">
           <span class="site-menu-title">{{ _t('Manage Goals')}}</span>
        </a>
      </li>
      <li class="site-menu-item">
        <a class="animsition-link" href="{{url($prefix.'/employee')}}/performance">
           <span class="site-menu-title">{{ _t('View Performance')}}</span>
        </a>
      </li>
     <li class="site-menu-item">
        <a class="animsition-link" href="{{url($prefix.'/employee')}}/myquery">
           <span class="site-menu-title">{{ _t('View Query')}}</span>
        </a>
      </li>
	  <li class="site-menu-item">
        <a class="animsition-link" href="{{url($prefix.'/review360')}}">
           <span class="site-menu-title">{{ _t('Employee Review 360')}}</span>
        </a>
      </li>
    </ul>
    @endif
    @if(Auth::user()->role==2 ||Auth::user()->role==3)
    <ul class="site-menu-sub">
      <li class="site-menu-item menuborder {{active(['lm/objectives_a'])}}">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url($prefix.'/employee')}}/objective')">
           <span class="site-menu-title">{{ _t('Objective settings')}}</span>
        </a>
      </li>
      <li class="site-menu-item  {{active(['lm/objectives_c'])}}">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url($prefix.'/lm')}}/objectives_c')">
           <span class="site-menu-title">{{ _t('Performance Management')}}</span>
        </a>
      </li>
    <li class="site-menu-item  {{active(['lm/query'])}}">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url($prefix.'/lm')}}/query')">
           <span class="site-menu-title">{{ _t('Discipline Management')}}</span>
        </a>
      </li>
	  <li class="site-menu-item">
        <a class="animsition-link" href="{{url($prefix.'/review360')}}">
           <span class="site-menu-title">{{ _t('Employee Review 360')}}</span>
        </a>
      </li>
    </ul>
    @endif
  </li>

  <!--absence Management-->
  
  @if(Auth::user()->role!=0 )


  <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon fa fa-hotel" aria-hidden="true"></i>
       <span class="site-menu-title">{{ _t('Absence Management')}}</span>
      <span class="site-menu-arrow"></span>
    </a>
	  <ul class="site-menu-sub">
 <li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url($prefix.'/employee')}}/absence')">

     <span class="site-menu-title">{{ _t('Leave Request')}}</span>

  </a>
</li>
	
  @if(Auth::user()->role==2 || Auth::user()->role==3 )
      <li class="site-menu-item menuborder ">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url($prefix.'/manage')}}/absence')">
           <span class="site-menu-title">{{ _t('View Request')}}</span>
        </a>
      </li>   
    <li class="site-menu-item menuborder ">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url($prefix.'/manage')}}/leavestat')">
           <span class="site-menu-title">{{ _t('Leave Statistics')}}</span>
        </a>
      </li>
	    <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)" onclick="url('{{url($prefix.'/hr')}}/attendance')">
       <span class="site-menu-title">{{ _t('Attendance Management')}}</span>
   
    </a>
	</li>
	    @endif
		
	   </ul>
	
      </li> 
	 @endif
	


  
        

          
             <li class="site-menu-item has-sub {{in_array(Request::path(), $training_array) ? 'active open' : ''}}">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                 <span class="site-menu-title">{{ _t('Training and Development')}}</span>
                <span class="site-menu-arrow"></span>
              </a>
              

              <!--If admin User-->
              @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
          
                <!--<li class="site-menu-item {{{ (Request::is('add-training') ? ' active' : '') }}}">
                  <a href="{{ url('/add-training')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Add Training')}}</span>                    
                  </a>
                </li>-->
				
				      <ul class="site-menu-sub">
                
                <li class="site-menu-item {{{ (Request::is($prefix.'/trainings-list') ? ' active' : '') }}}">
                  <a href="{{ url($prefix.'/trainings-list')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Trainings')}}</span>                    
                  </a>
				  </li>
                <!--<li class="site-menu-item {{{ (Request::is('add-training-material') ? ' active' : '') }}}">
                  <a href="{{ url('/add-training-material')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Add Training Materials')}}</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item {{{ (Request::is($prefix.'/training-material-list') ? ' active' : '') }}}">
                  <a href="{{ url($prefix.'/training-material-list') }}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Training Materials')}}</span>                    
                  </a>
                </li>
                <!--<li class="site-menu-item {{{ (Request::is('add-survey') ? ' active' : '') }}}">
                  <a href="{{ url('/add-survey')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Add Training Survey')}}</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item menuborder {{{ ((Request::is($prefix.'/survey-list') || Request::is($prefix.'/add-survey')) ? ' active' : '') }}}">
                  <a href="{{ url($prefix.'/survey-list')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Training Surveys')}}</span>                    
                  </a>
                </li>                
                <?php $survey_subarray = array('filled-surveys-list','filled-surveys','filled-surveys-view'); ?>
                <li class="site-menu-item menuborder {{in_array(Request::path(), $survey_subarray) ? 'active' : ''}}">
                  <a href="{{ url($prefix.'/filled-surveys-list')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Filled Surveys')}}</span>                    
                  </a>
                </li>
                <li class="site-menu-item menuborder {{{ (Request::is($prefix.'/enrollments-all') ? ' active' : '') }}}">
                  <a href="{{ url($prefix.'/enrollments-all')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Enrolled Training Status')}}</span>                    
                  </a>
                </li>
				
				</li>
              </ul>    
            @endif

            <!--If Employee-->
            @if(Auth::user()->role==Config::get('constants.roles.Employee'))
              <ul class="site-menu-sub">
                <li class="site-menu-item menuborder {{{ (Request::is($prefix.'/emp-trainings-list') ? ' active' : '') }}}">
                  <a href="{{ url($prefix.'/emp-trainings-list')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Select Elective Training ')}}</span>                    
                  </a>
                </li>
                <li class="site-menu-item menuborder {{{ (Request::is('emp-trainings-status') ? ' active' : '') }}}">
                  <a href="{{ url($prefix.'/emp-trainings-status')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Training Status ')}}</span>                    
                  </a>
                </li>
                <li class="site-menu-item menuborder {{{ (Request::is($prefix.'/training-schedule-calendar') ? ' active' : '') }}}">
                  <a href="{{url($prefix.'/training-schedule-calendar')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Training Schedules FY')}}</span>                    
                  </a>
                </li> 
                <!--<li class="site-menu-item has-sub">
                  <a href="#">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Save Training to Outlook Calendar')}}</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item menuborder {{{ (Request::is($prefix.'/training-survey-list') ? ' active' : '') }}}">
                  <a href="{{url($prefix.'/training-survey-list') }}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Training Surveys')}}</span>                    
                  </a>
                </li>
				</li>
              </ul>   
            @endif
            <!--If People_Manager-->
            @if(Auth::user()->role==Config::get('constants.roles.People_Manager'))
              <ul class="site-menu-sub">
                <!--<li class="site-menu-item {{{ (Request::is('trainings-applied') ? ' active' : '') }}}">
                  <a href="{{url('/trainings-applied') }}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Training Applied')}}</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item menuborder {{{ (Request::is($prefix.'/enrollments-all') ? ' active' : '') }}}">
                  <a href="{{ url($prefix.'/enrollments-all')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                     <span class="site-menu-title">{{ _t('Enrolled Training Status')}}</span>                    
                  </a>
                </li>
              </ul>    
            @endif
            </li>
        
             <li class="site-menu-item has-sub {{in_array(Request::path(), $health_array) ? 'active open' : ''}}">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                 <span class="site-menu-title">{{ _t('Employee Health')}}</span>
                <span class="site-menu-arrow"></span>
              </a>
              @if(Auth::user()->role==Config::get('constants.roles.Doctor'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is($prefix.'/diagnosis-details') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url($prefix.'/diagnosis-details')}}">
                     <span class="site-menu-title">{{ _t('Diagnosis Details')}}</span>
                  </a>
                </li>
              </ul>
              @endif 
              @if(Auth::user()->role==Config::get('constants.roles.Admin_User') || Auth::user()->role==Config::get('constants.roles.People_Manager'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is($prefix.'/sick-leave-request') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url($prefix.'/sick-leave-request')}}">
                     <span class="site-menu-title">{{ _t('Sick Leave Requests')}}</span>
                  </a>
                </li>
                <!--<li class="site-menu-item">
                  <a class="animsition-link" href="#">
                     <span class="site-menu-title">{{ _t('Medical Trends')}}</span>
                  </a>
                </li>-->               
              </ul>
              @endif              
              @if(Auth::user()->role==Config::get('constants.roles.Employee') || Auth::user()->role==Config::get('constants.roles.Factory_Employee'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is($prefix.'/my-diagnosis-details') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url($prefix.'/my-diagnosis-details')}}">
                     <span class="site-menu-title">{{ _t('Diagnosis Details')}}</span>
                  </a>
                </li>
              </ul>
              @endif
              </li>
              <li class="site-menu-item has-sub {{in_array(Request::path(), $payroll_array) ? 'active open' : ''}}">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                 <span class="site-menu-title">{{ _t('Payroll')}}</span>
                <span class="site-menu-arrow"></span>
              </a>
              @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
              <!--<ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('holiday-calendar') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/holiday-calendar')}}">
                     <span class="site-menu-title">{{ _t('Holiday Calendar')}}</span>
                  </a>
                </li>
              </ul>-->
              
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is($prefix.'/employee-expenses') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url($prefix.'/employee-expenses')}}">
                     <span class="site-menu-title">{{ _t('All Employee Expenses')}}</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('payroll-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url($prefix.'/payroll-list')}}">
                     <span class="site-menu-title">{{ _t('Payroll Details')}}</span>
                  </a>
                </li>
              </ul>  
              @endif    
              @if(Auth::user()->role==Config::get('constants.roles.People_Manager'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is($prefix.'/employee-expenses') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url($prefix.'/employee-expenses')}}">
                     <span class="site-menu-title">{{ _t('All Employee Expenses')}}</span>
                  </a>
                </li>
              </ul>  
              @endif    
              @if(Auth::user()->role!=Config::get('constants.roles.Admin_User'))
              
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is($prefix.'/emp-payroll-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url($prefix.'/emp-payroll-list')}}">
                     <span class="site-menu-title">{{ _t('Payroll Details')}}</span>
                  </a>
                </li>
              </ul> 
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is($prefix.'/my-expenses') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url($prefix.'/my-expenses')}}">
                     <span class="site-menu-title">{{ _t('My Expenses')}}</span>
                  </a>
                </li>
              </ul>
              
              @endif        
            </li> 
          <!--  <li class="site-menu-item has-sub {{in_array(Request::path(), $leave_array) ? 'active open' : ''}}">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                 <span class="site-menu-title">{{ _t('Leave and Attendance')}}</span>
                <span class="site-menu-arrow"></span>
              </a>
              @if(Auth::user()->role==Config::get('constants.roles.Employee') || Auth::user()->role==Config::get('constants.roles.Factory_Employee') || Auth::user()->role==Config::get('constants.roles.People_Manager'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('my-leaves') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/my-leaves')}}">
                     <span class="site-menu-title">{{ _t('My Leaves')}}</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ ((Request::is('daily-attendance') || Request::is('view-daily-attendance')) ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/daily-attendance')}}">
                     <span class="site-menu-title">{{ _t('Daily Attendance')}}</span>
                  </a>
                </li>
              </ul>
              @endif
			  @if(Auth::user()->role==Config::get('constants.roles.People_Manager'))
              <!--<ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('my-leaves') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/my-leaves')}}">
                     <span class="site-menu-title">{{ _t('My Leaves')}}</span>
                  </a>
                </li>
              </ul>-->
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is($prefix.'/day-att-emp-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{url($prefix.'/day-att-emp-list')}}">
                     <span class="site-menu-title">{{ _t('Employee Daily Attendance')}}</span>
                  </a>
                </li>
              </ul>
              @endif
			  @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
             <!-- <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('employee-leaves') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/employee-leaves')}}">
                     <span class="site-menu-title">{{ _t('All Employee Leaves')}}</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('daily-attendance-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/daily-attendance-list')}}">
                     <span class="site-menu-title">{{ _t('All Employee Attendances')}}</span>
                  </a>
                </li>
              </ul> ->
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('daily-attendance-settings') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/daily-attendance-settings')}}">
                     <span class="site-menu-title">{{ _t('Daily Attendance Settings')}}</span>
                  </a>
                </li>
              </ul>
              @endif
            </li>  
			
    
	  

 