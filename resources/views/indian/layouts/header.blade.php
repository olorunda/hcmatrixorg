<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>{{ $page_title }} | HCMatrix</title>
 
 
 <link rel="stylesheet" href="{{ URL::asset('classic/global/css/bootstrap.min.css') }}" />

  <link rel="apple-touch-icon" href="{{ URL::asset('classic/base/assets/images/apple-touch-icon.png') }}">
  <link rel="shortcut icon" href="{{ URL::asset('classic/base/assets/images/favicon.ico') }}">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ URL::asset('classic/global/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/css/bootstrap-extend.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/base/assets/css/site.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
  <!-- Plugins -->
  <!--<link rel="stylesheet" href="classic/global/vendor/animsition/animsition.css">-->
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/asscrollable/asScrollable.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/switchery/switchery.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/intro-js/introjs.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/slidepanel/slidePanel.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/flag-icon-css/flag-icon.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/datatables-bootstrap/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/datatables-fixedheader/dataTables.fixedHeader.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/datatables-responsive/dataTables.responsive.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/base/assets/examples/css/tables/datatable.css') }}">

  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/chartist/chartist.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/jvectormap/jquery-jvectormap.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/base/assets/examples/css/dashboard/v1.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/bootstrap-table/bootstrap-table.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/fullcalendar/fullcalendar.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/bootstrap-touchspin/bootstrap-touchspin.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/vendor/jquery-selective/jquery-selective.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/base/assets/examples/css/apps/calendar.css') }}">
  <!-- Fonts -->
  <link rel="stylesheet" href="{{ URL::asset('classic/global/fonts/glyphicons/glyphicons.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/fonts/font-awesome/font-awesome.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/fonts/material-design/material-design.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/fonts/weather-icons/weather-icons.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/fonts/web-icons/web-icons.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('classic/global/fonts/brand-icons/brand-icons.min.css') }}">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
   <link rel="stylesheet" href="{{ URL::asset('css/jquery.orgchart.css') }}">

  <!--[if lt IE 9]>
    <script src="classic/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="classic/global/vendor/media-match/media.match.min.js"></script>
    <script src="classic/global/vendor/respond/respond.min.js"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="{{ URL::asset('classic/global/vendor/breakpoints/breakpoints.js') }}"></script>
  <script>
  Breakpoints();
  </script>
</head>
<body class="animsition dashboard">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
      data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
      data-toggle="collapse">
        <i class="icon wb-more-horizontal" aria-hidden="true"></i>
      </button>
      <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
        <img class="navbar-brand-logo" src="{{ URL::asset('classic/base/assets/images/logo.png') }}" title="HCMatrix">
        <span class="navbar-brand-text hidden-xs-down"> HCMatrix</span>
      </div>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
      data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon wb-search" aria-hidden="true"></i>
      </button>
    </div>
    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <!--<ul class="nav navbar-toolbar">
          <li class="nav-item hidden-float" id="toggleMenubar">
            <a class="nav-link" data-toggle="menubar" href="#" role="button">
              <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
            </a>
          </li>
          <li class="nav-item hidden-sm-down" id="toggleFullscreen">
            <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
              <span class="sr-only">Toggle fullscreen</span>
            </a>
          </li>
          <li class="nav-item hidden-float">
            <a class="nav-link icon wb-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
            role="button">
              <span class="sr-only">Toggle Search</span>
            </a>
          </li>
        </ul>-->
        <!-- End Navbar Toolbar -->
        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up"
            aria-expanded="false" role="button">
              <span class="flag-icon flag-icon-us"></span>
            </a>            
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-gb"></span> English</a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-fr"></span> French</a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-cn"></span> Chinese</a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-de"></span> German</a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-nl"></span> Dutch</a>
            </div>
          </li>          
          <li class="nav-item dropdown">
            <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
            data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
                <img src="{{ URL::asset('classic/global/portraits/5.jpg') }}" alt="...">
                <i></i>
              </span>
            </a>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="{{ url('/viewprofile')}}" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
              <div class="dropdown-divider" role="presentation"></div>
              <a class="dropdown-item" href="{{ url('/logout')}}" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
            </div>
          </li>
        </ul>
        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->
      <!-- Site Navbar Seach -->     
      <!-- End Site Navbar Seach -->
    </div>
  </nav>
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
         

          <ul class="site-menu" data-plugin="menu">
            <li class="site-menu-category">
             <li class="site-menu-item has-sub {{in_array(Request::path(), $training_array) ? 'active open' : ''}}">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Training and Development</span>
                <span class="site-menu-arrow"></span>
              </a>
              

              <!--If admin User-->
              @if(Auth::user()->role==Config::get('constants.roles.Admin_User'))
              <ul class="site-menu-sub">
                <!--<li class="site-menu-item {{{ (Request::is('add-training') ? ' active' : '') }}}">
                  <a href="{{ url('/add-training')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Add Training</span>                    
                  </a>
                </li>-->
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
                <li class="site-menu-item {{{ ((Request::is('survey-list') || Request::is('add-survey')) ? ' active' : '') }}}">
                  <a href="{{ url('/survey-list')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Surveys</span>                    
                  </a>
                </li>                
                <?php $survey_subarray = array('filled-surveys-list','filled-surveys','filled-surveys-view'); ?>
                <li class="site-menu-item {{in_array(Request::path(), $survey_subarray) ? 'active' : ''}}">
                  <a href="{{ url('/filled-surveys-list')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Filled Surveys</span>                    
                  </a>
                </li>
                <li class="site-menu-item {{{ (Request::is('enrollments-all') ? ' active' : '') }}}">
                  <a href="{{ url('/enrollments-all')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Enrolled Training Status</span>                    
                  </a>
                </li>
              </ul>    
            @endif

            <!--If Employee-->
            @if(Auth::user()->role==Config::get('constants.roles.Employee'))
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('emp-trainings-list') ? ' active' : '') }}}">
                  <a href="{{ url('/emp-trainings-list')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Select Elective Training </span>                    
                  </a>
                </li>
                <li class="site-menu-item {{{ (Request::is('emp-trainings-status') ? ' active' : '') }}}">
                  <a href="{{ url('/emp-trainings-status')}}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Status </span>                    
                  </a>
                </li>
                <li class="site-menu-item {{{ (Request::is('training-schedule-calendar') ? ' active' : '') }}}">
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
                <li class="site-menu-item {{{ (Request::is('training-survey-list') ? ' active' : '') }}}">
                  <a href="{{url('/training-survey-list') }}">
                    <i class="animsition-link" aria-hidden="true"></i>
                    <span class="site-menu-title">Training Surveys</span>                    
                  </a>
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
                <li class="site-menu-item {{{ (Request::is('enrollments-all') ? ' active' : '') }}}">
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
              </ul>-->
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
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('daily-attendance-list') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/daily-attendance-list')}}">
                    <span class="site-menu-title">All Employee Attendances</span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
                <li class="site-menu-item {{{ (Request::is('daily-attendance-settings') ? ' active' : '') }}}">
                  <a class="animsition-link" href="{{ url('/daily-attendance-settings')}}">
                    <span class="site-menu-title">Daily Attendance Settings</span>
                  </a>
                </li>
              </ul>
              @endif
            </li>                
          </ul>
        </div>
      </div>
    </div>
    <div class="site-menubar-footer">
      <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip"
      data-original-title="Settings">
        <span class="icon wb-settings" aria-hidden="true"></span>
      </a>
      <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
        <span class="icon wb-eye-close" aria-hidden="true"></span>
      </a>
      <a href="{{ url('/logout')}}" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
        <span class="icon wb-power" aria-hidden="true"></span>
      </a>
    </div>
  </div>
  <div class="site-gridmenu">
    <div>
      <div>
        <ul>
          <li>
            <a href="#">
              <i class="icon wb-envelope"></i>
              <span>Mailbox</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="icon wb-calendar"></i>
              <span>Calendar</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="icon wb-user"></i>
              <span>Contacts</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="icon wb-camera"></i>
              <span>Media</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="icon wb-order"></i>
              <span>Documents</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="icon wb-image"></i>
              <span>Project</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="icon wb-chat-group"></i>
              <span>Forum</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="icon wb-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- weekend modal start 
    <div id='modal-weekend_calendar' class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="form-horizontal" id="weekend_form" role="form" method="POST" action="{{ url('update_weekend_days') }}" enctype="multipart/form-data">
            {{ csrf_field() }}  
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Update Weekend Days</h4>
          </div>
          <div class="modal-body">
            <div id="update_calendar_div">              
            </div>
            <p class="text-right" id="weekend_btn_div"><input type="button" class="btn btn-primary waves-effect" id="training_btn" value="Update" onclick ="fnUpdateWekend()"></p>
            
          </div>
          <div class="modal-footer">
          </div>
          </form>
        </div>
        
      </div>
    </div>
  <!-- weekend modal end 

  <!-- modal CL start 
    <div id='modal-cl' class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="form-horizontal" id="cl_form" role="form" method="POST" action="{{ url('update_casual_leaves') }}" enctype="multipart/form-data">
            {{ csrf_field() }}  
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Update No. of Casual Leaves</h4>
          </div>
          <div class="modal-body">
            <div class="form-group col-xs-12">
              <div class="col-xs-4"><h4>Job Role</h4></div>
              <div class="col-xs-8"><h4>Casual Leaves / Month</h4></div>
            </div>
            <div id="update_casual_leave_div">              
            </div>
           
            <p class="text-right" id="cl_btn_div"><input type="button" class="btn btn-primary waves-effect" id="leave_btn" value="Update" onclick ="fnUpdateCL()"></p>
            
          </div>
          <div class="modal-footer">
          </div>
          </form>
        </div>
        
      </div>
    </div>
  <!-- modal end 

  <!-- modal Payslip logo & watermark start 
    <div id='modal-ps' class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="form-horizontal" id="ps_form" role="form" method="POST" action="{{ url('update_payslip_details') }}" enctype="multipart/form-data">
            {{ csrf_field() }}  
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Update Payslip Logo / Watermark</h4>
          </div>
          <div class="modal-body">
            <div class="form-group col-xs-12">
              <div class="col-xs-4"><label>Logo</label></div>
                <div class="col-xs-8"><input id="payslip_logo" class="form-control" name="payslip_logo" type="file">
                  <div id="payslip_logo_img"></div>
                <div id="payslip_logo_err"></div>
              </div>
            </div>
            <div class="form-group col-xs-12">
              <div class="col-xs-4"><label>Watermark Text</label></div>
                <div class="col-xs-8"><input id="watermark_text" class="form-control" name="watermark_text" type="text" placeholder="Watermark Text">
                <div id="watermark_text_err"></div>
              </div>
            </div>
           
            <p class="text-right" id="ps_btn_div"><input type="button" class="btn btn-primary waves-effect" id="leave_btn" value="Update" onclick ="fnUpdatePaySlipLogo()"></p>
            
          </div>
          <div class="modal-footer">
          </div>
          </form>
        </div>
        
      </div>
    </div>
  <!-- modal end -->