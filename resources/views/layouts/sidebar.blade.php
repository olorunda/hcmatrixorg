<div class="site-menubar">
    <div class="site-menubar-body">
      <div>
        <div>

          <?php
            $training_array = array('add-training', 'trainings-list', 'add-training-material', 'training-material-list', 'add-survey', 'survey-list', 'trainings-applied', 'enrollments-all', 'emp-trainings-list', 'emp-trainings-status', 'training-schedule-calendar', 'training-survey-list', 'trainings-applied','filled-surveys-list','filled-surveys','filled-surveys-view');
            $succession_array = array('successor-list','employee-hierarchy','nominate-successor','successorapprove','vacancy-list');
            $health_array = array('diagnosis-details','my-diagnosis-details','sick-leave-request');
            $payroll_array = array('holiday-list','basicpay-list','allowance-list','payroll-list','emp-payroll-list','edit-weekend_days','edit-casual_leaves','edit-payslip-details','my-expenses','employee-expenses');
            $leave_array = array('my-leaves','daily-attendance','employee-leaves','view-daily-attendance','daily-attendance-list','daily-attendance-settings','day-att-emp-list');
          ?>
         <script>
  function url(url){

   window.location=url;
 }
</script> 
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('home')}}')">
    <i class="site-menu-icon  wb-home" aria-hidden="true"></i>
    <span class="site-menu-title">Home</span>

  </a>
</li>

@if(Auth::user()->role==3)
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('hr/executiveview')}}')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
    <span class="site-menu-title">Executive View</span>

  </a>
</li>
@endif
@if(Auth::user()->role>=1)
	<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('outlookevent')}}')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
    <span class="site-menu-title">Calender Events</span>

  </a>
</li>
@endif
	@if(Auth::user()->role==3 ||   Auth::user()->role==2 || Auth::user()->role==1)
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('view/attendancecalender')}}')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
    <span class="site-menu-title">Attendance 360</span>

  </a>
</li>
	@endif
		@if(Auth::user()->role==3 ||   Auth::user()->role==2 || Auth::user()->role==1 )
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('project/management')}}')">
    <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
    <span class="site-menu-title">Project Management</span>

  </a>
</li>
	@endif
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('employee')}}/profile_{{Auth::user()->id}}')">
    <i class="site-menu-icon  wb-user" aria-hidden="true"></i>
    <span class="site-menu-title">Profile</span>

  </a>
  </li>
  
  @if(Auth::user()->role==2 || Auth::user()->role==3)
	  
<li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('employee')}}/list')">
    <i class="site-menu-icon  wb-list" aria-hidden="true"></i>
    <span class="site-menu-title">Manage Employee</span>

  </a>
  </li>
  @endif
  
  @if(Auth::user()->role==3)
   <li class="site-menu-item has-sub menuborder ">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
      <span class="site-menu-title">Global Settings</span>
      <span class="site-menu-arrow"></span>
    </a>
 
    <ul class="site-menu-sub">
    
	   <li class="site-menu-item">
        <a class="animsition-link" href="{{url('hr')}}/settings">
          <span class="site-menu-title">All Settings</span>
        </a>
      </li> 
    </ul>

  </li>
  
  <!--  Role Management -->
 

    @endif
	

  @if(Auth::user()->role>0)
	  
 <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
      <span class="site-menu-title">Record Management</span>
      <span class="site-menu-arrow"></span>
    </a>  
  <ul class="site-menu-sub">
  @if(Auth::user()->role==2 || Auth::user()->role==3)
      <li class="site-menu-item">
        <a class="animsition-link" href="{{url('view')}}/docadmin">
          <span class="site-menu-title">Record Management</span>
        </a>
      </li>
	@endif
	  <li class="site-menu-item">
        <a class="animsition-link"   @if(Auth::user()->role==1) href="{{url('view')}}/docadmin" @else href="{{url('view')}}/mydocument" @endif >
          <span class="site-menu-title">My Documents</span>
        </a>
      </li>
  </ul>
  </li>
  @endif
  
  @if(Auth::user()->role!=0 )
  <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)">
      <i class="site-menu-icon  wb-stats-bars" aria-hidden="true"></i>
      <span class="site-menu-title">Performance Management</span>
      <span class="site-menu-arrow"></span>
    </a>
	@endif
    @if(Auth::user()->role==1 )
    <ul class="site-menu-sub">
      <li class="site-menu-item">
        <a class="animsition-link" href="{{url('employee')}}/goalsview">
          <span class="site-menu-title">Manage Goals</span>
        </a>
      </li>
      <li class="site-menu-item">
        <a class="animsition-link" href="{{url('employee')}}/performance">
          <span class="site-menu-title">View Performance</span>
        </a>
      </li>
     <li class="site-menu-item">
        <a class="animsition-link" href="{{url('employee')}}/myquery">
          <span class="site-menu-title">View Query</span>
        </a>
      </li>
	  <li class="site-menu-item">
        <a class="animsition-link" href="{{url('review360')}}">
          <span class="site-menu-title">Employee Review 360</span>
        </a>
      </li>
    </ul>
    @endif
    @if(Auth::user()->role==2 ||Auth::user()->role==3)
    <ul class="site-menu-sub">
      <li class="site-menu-item menuborder {{active(['lm/objectives_a'])}}">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url('employee')}}/objective')">
          <span class="site-menu-title">Objective settings</span>
        </a>
      </li>
      <li class="site-menu-item  {{active(['lm/objectives_c'])}}">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url('lm')}}/objectives_c')">
          <span class="site-menu-title">Performance Management</span>
        </a>
      </li>
    <li class="site-menu-item  {{active(['lm/query'])}}">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url('lm')}}/query')">
          <span class="site-menu-title">Discipline Management</span>
        </a>
      </li>
	  <li class="site-menu-item">
        <a class="animsition-link" href="{{url('review360')}}">
          <span class="site-menu-title">Employee Review 360</span>
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
      <span class="site-menu-title">Absence Management</span>
      <span class="site-menu-arrow"></span>
    </a>
	  <ul class="site-menu-sub">
 <li class="site-menu-item has-sub menuborder" >
  <a href="javascript:void(0)" onclick="url('{{url('employee')}}/absence')">

    <span class="site-menu-title">Leave Request</span>

  </a>
</li>
	
  @if(Auth::user()->role==2 || Auth::user()->role==3 )
      <li class="site-menu-item menuborder ">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url('manage')}}/absence')">
          <span class="site-menu-title">View Request</span>
        </a>
      </li>   
    <li class="site-menu-item menuborder ">
        <a class="animsition-link" href="javascript:void(0)" onclick="url('{{url('manage')}}/leavestat')">
          <span class="site-menu-title">Leave Statistics</span>
        </a>
      </li>
	    <li class="site-menu-item has-sub menuborder">
    <a href="javascript:void(0)" onclick="url('{{url('hr')}}/attendance')">
      <span class="site-menu-title">Attendance Management</span>
   
    </a>
	</li>
	    @endif
		
	   </ul>
	
      </li> 
	 @endif



  
            <?php
            $training_array = array('add-training', 'trainings-list', 'add-training-material', 'training-material-list', 'add-survey', 'survey-list', 'trainings-applied', 'enrollments-all', 'emp-trainings-list', 'emp-trainings-status', 'training-schedule-calendar', 'training-survey-list', 'trainings-applied','filled-surveys-list','filled-surveys','filled-surveys-view');
            $succession_array = array('successor-list','employee-hierarchy','nominate-successor','successorapprove','vacancy-list');
            $health_array = array('diagnosis-details','my-diagnosis-details','sick-leave-request');
            $payroll_array = array('holiday-list','basicpay-list','allowance-list','payroll-list','emp-payroll-list','edit-weekend_days','edit-casual_leaves','edit-payslip-details','my-expenses','employee-expenses');
            $leave_array = array('my-leaves','daily-attendance','employee-leaves','view-daily-attendance','daily-attendance-list','daily-attendance-settings','day-att-emp-list');
          ?>
         

          
             <li class="site-menu-item has-sub {{in_array(Request::path(), $training_array) ? 'active open' : ''}}">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Training and Development</span>
                <span class="site-menu-arrow"></span>
              </a>
              

              <!--If admin User-->
              @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
          
                <!--<li class="site-menu-item {{{ (Request::is('add-training') ? ' active' : '') }}}">
                  <a href="{{ url('/add-training')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Add Training</span>                    
                  </a>
                </li>-->
				
				      <ul class="site-menu-sub">
                
                <li class="site-menu-item {{{ (Request::is('trainings-list') ? ' active' : '') }}}">
                  <a href="{{ url('/trainings-list')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Trainings</span>                    
                  </a>
				  </li>
                <!--<li class="site-menu-item {{{ (Request::is('add-training-material') ? ' active' : '') }}}">
                  <a href="{{ url('/add-training-material')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Add Training Materials</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item {{{ (Request::is('training-material-list') ? ' active' : '') }}}">
                  <a href="{{ url('/training-material-list') }}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Materials</span>                    
                  </a>
                </li>
                <!--<li class="site-menu-item {{{ (Request::is('add-survey') ? ' active' : '') }}}">
                  <a href="{{ url('/add-survey')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Add Training Survey</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item menuborder {{{ ((Request::is('survey-list') || Request::is('add-survey')) ? ' active' : '') }}}">
                  <a href="{{ url('/survey-list')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Surveys</span>                    
                  </a>
                </li>                
                <?php $survey_subarray = array('filled-surveys-list','filled-surveys','filled-surveys-view'); ?>
                <li class="site-menu-item menuborder {{in_array(Request::path(), $survey_subarray) ? 'active' : ''}}">
                  <a href="{{ url('/filled-surveys-list')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Filled Surveys</span>                    
                  </a>
                </li>
                <li class="site-menu-item menuborder {{{ (Request::is('enrollments-all') ? ' active' : '') }}}">
                  <a href="{{ url('/enrollments-all')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Enrolled Training Status</span>                    
                  </a>
                </li>
				
				</li>
              </ul>    
            @endif

            <!--If Employee-->
            @if(Auth::user()->role==Config::get('constants.roles.Employee'))
              <ul class="site-menu-sub">
                <li class="site-menu-item menuborder {{{ (Request::is('emp-trainings-list') ? ' active' : '') }}}">
                  <a href="{{ url('/emp-trainings-list')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Select Elective Training </span>                    
                  </a>
                </li>
                <li class="site-menu-item menuborder {{{ (Request::is('emp-trainings-status') ? ' active' : '') }}}">
                  <a href="{{ url('/emp-trainings-status')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Status </span>                    
                  </a>
                </li>
                <li class="site-menu-item menuborder {{{ (Request::is('training-schedule-calendar') ? ' active' : '') }}}">
                  <a href="{{url('/training-schedule-calendar')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Schedules FY</span>                    
                  </a>
                </li> 
                <!--<li class="site-menu-item has-sub">
                  <a href="#">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Save Training to Outlook Calendar</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item menuborder {{{ (Request::is('training-survey-list') ? ' active' : '') }}}">
                  <a href="{{url('/training-survey-list') }}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Surveys</span>                    
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
                    <span class="site-menu-title">Training Applied</span>                    
                  </a>
                </li>-->
                <li class="site-menu-item menuborder {{{ (Request::is('enrollments-all') ? ' active' : '') }}}">
                  <a href="{{ url('/enrollments-all')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Enrolled Training Status</span>                    
                  </a>
                </li>
              </ul>    
            @endif
            </li>
          @if(Auth::user()->role==Config::get('constants.roles.Admin_User') || Auth::user()->role==Config::get('constants.roles.People_Manager'))
            <li class="site-menu-item has-sub {{in_array(Request::path(), $succession_array) ? 'active open' : ''}}">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                <span class="site-menu-title">Succession Planning</span>
                <span class="site-menu-arrow"></span>
              </a>
              @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('employee-hierarchy') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/employee-hierarchy')}}">
                    <span class="site-menu-title">Employees Hirerachy</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('successor-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/successor-list')}}">
                    <span class="site-menu-title">Successors List</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('vacancy-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/vacancy-list')}}">
                    <span class="site-menu-title">Vacancy List</span>
                  </a>
                </li>
              </ul>
              @endif
              @if(Auth::user()->role==Config::get('constants.roles.People_Manager'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('successor-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/successor-list')}}">
                    <span class="site-menu-title">Nominated Successors</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('nominate-successor') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/nominate-successor')}}">
                    <span class="site-menu-title">Select Successors<!-- (Internal -> select from list, External -> New entry)--></span>
                  </a>
                </li>
                <!--
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Readyness of Candidate</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Training Requirement for Candidate</span>
                  </a>
                </li>-->
              </ul>
              @endif
              </li>
              @endif
             <li class="site-menu-item has-sub {{in_array(Request::path(), $health_array) ? 'active open' : ''}}">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                <span class="site-menu-title">Employee Health</span>
                <span class="site-menu-arrow"></span>
              </a>
              @if(Auth::user()->role==Config::get('constants.roles.Doctor'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('diagnosis-details') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/diagnosis-details')}}">
                    <span class="site-menu-title">Diagnosis Details</span>
                  </a>
                </li>
              </ul>
              @endif 
              @if(Auth::user()->role==Config::get('constants.roles.Admin_User') || Auth::user()->role==Config::get('constants.roles.People_Manager'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('sick-leave-request') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/sick-leave-request')}}">
                    <span class="site-menu-title">Sick Leave Requests</span>
                  </a>
                </li>
                <!--<li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Medical Trends</span>
                  </a>
                </li>-->               
              </ul>
              @endif              
              @if(Auth::user()->role==Config::get('constants.roles.Employee') || Auth::user()->role==Config::get('constants.roles.Factory_Employee'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('my-diagnosis-details') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/my-diagnosis-details')}}">
                    <span class="site-menu-title">Diagnosis Details</span>
                  </a>
                </li>
              </ul>
              @endif
              </li>
              <li class="site-menu-item has-sub {{in_array(Request::path(), $payroll_array) ? 'active open' : ''}}">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                <span class="site-menu-title">Payroll</span>
                <span class="site-menu-arrow"></span>
              </a>
              @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
              <!--<ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('holiday-calendar') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/holiday-calendar')}}">
                    <span class="site-menu-title">Holiday Calendar</span>
                  </a>
                </li>
              </ul>-->
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('edit-weekend_days') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/edit-weekend_days')}}">
                    <span class="site-menu-title">Default Weekend Days</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('edit-casual_leaves') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/edit-casual_leaves')}}">
                    <span class="site-menu-title">No. of Casual Leaves Per Month</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('edit-payslip-details') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/edit-payslip-details')}}">
                    <span class="site-menu-title">Payslip logo & watermark</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('holiday-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/holiday-list')}}">
                    <span class="site-menu-title">Holiday List</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('basicpay-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/basicpay-list')}}">
                    <span class="site-menu-title">Basic Pay</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('allowance-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/allowance-list')}}">
                    <span class="site-menu-title">Salary components</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('employee-expenses') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/employee-expenses')}}">
                    <span class="site-menu-title">All Employee Expenses</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('payroll-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/payroll-list')}}">
                    <span class="site-menu-title">Payroll Details</span>
                  </a>
                </li>
              </ul>  
              @endif    
              @if(Auth::user()->role==Config::get('constants.roles.People_Manager'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('employee-expenses') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/employee-expenses')}}">
                    <span class="site-menu-title">All Employee Expenses</span>
                  </a>
                </li>
              </ul>  
              @endif    
              @if(Auth::user()->role!=Config::get('constants.roles.Admin_User'))
              
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('emp-payroll-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/emp-payroll-list')}}">
                    <span class="site-menu-title">Payroll Details</span>
                  </a>
                </li>
              </ul> 
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('my-expenses') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/my-expenses')}}">
                    <span class="site-menu-title">My Expenses</span>
                  </a>
                </li>
              </ul>
              
              @endif        
            </li> 
            <li class="site-menu-item has-sub {{in_array(Request::path(), $leave_array) ? 'active open' : ''}}">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                <span class="site-menu-title">Leave and Attendance</span>
                <span class="site-menu-arrow"></span>
              </a>
              @if(Auth::user()->role==Config::get('constants.roles.Employee') || Auth::user()->role==Config::get('constants.roles.Factory_Employee') || Auth::user()->role==Config::get('constants.roles.People_Manager'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('my-leaves') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/my-leaves')}}">
                    <span class="site-menu-title">My Leaves</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ ((Request::is('daily-attendance') || Request::is('view-daily-attendance')) ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/daily-attendance')}}">
                    <span class="site-menu-title">Daily Attendance</span>
                  </a>
                </li>
              </ul>
              @endif
			  @if(Auth::user()->role==Config::get('constants.roles.People_Manager'))
              <!--<ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('my-leaves') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/my-leaves')}}">
                    <span class="site-menu-title">My Leaves</span>
                  </a>
                </li>
              </ul> -->
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('day-att-emp-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/day-att-emp-list')}}">
                    <span class="site-menu-title">Employee Daily Attendance</span>
                  </a>
                </li>
              </ul>
              @endif
			  @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('employee-leaves') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/employee-leaves')}}">
                    <span class="site-menu-title">All Employee Leaves</span>
                  </a>
                </li>
              </ul>
             
              
              @endif
            </li>  
			
    
	  

 
   </div>
    </div>
   
  </div>
   