<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title><?php echo e($page_title); ?> | HCMatrix</title>
 
 
 <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/css/bootstrap.min.css')); ?>" />

  <link rel="apple-touch-icon" href="<?php echo e(URL::asset('classic/base/assets/images/apple-touch-icon.png')); ?>">
  <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.ico')); ?>">  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/css/bootstrap-extend.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/base/assets/css/site.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('css/style.css')); ?>">
  <!-- Plugins -->
  <!--<link rel="stylesheet" href="classic/global/vendor/animsition/animsition.css">-->
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/asscrollable/asScrollable.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/switchery/switchery.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/intro-js/introjs.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/slidepanel/slidePanel.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/flag-icon-css/flag-icon.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/datatables-bootstrap/dataTables.bootstrap.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/datatables-fixedheader/dataTables.fixedHeader.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/datatables-responsive/dataTables.responsive.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/base/assets/examples/css/tables/datatable.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('global/vendor/jt-timepicker/jquery-timepicker.css')); ?>"> 
	   
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/chartist/chartist.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/jvectormap/jquery-jvectormap.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/base/assets/examples/css/dashboard/v1.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/bootstrap-table/bootstrap-table.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/fullcalendar/fullcalendar.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/bootstrap-touchspin/bootstrap-touchspin.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/vendor/jquery-selective/jquery-selective.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/base/assets/examples/css/apps/calendar.css')); ?>">
  <!-- Fonts -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/fonts/glyphicons/glyphicons.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/fonts/font-awesome/font-awesome.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/fonts/material-design/material-design.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/fonts/weather-icons/weather-icons.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/fonts/web-icons/web-icons.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('classic/global/fonts/brand-icons/brand-icons.min.css')); ?>">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
   <link rel="stylesheet" href="<?php echo e(URL::asset('css/jquery.orgchart.css')); ?>">

  <!--[if lt IE 9]>
    <script src="classic/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="classic/global/vendor/media-match/media.match.min.js"></script>
    <script src="classic/global/vendor/respond/respond.min.js"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="<?php echo e(URL::asset('classic/global/vendor/breakpoints/breakpoints.js')); ?>"></script>
  <script>
  Breakpoints();
  </script>
  <style>
  .site-menubar{
	  
	    background-image: url('<?php echo e(asset('upload/bg.jpg')); ?>');
  }
.site-menu-item:hover{
	background:rgba(7, 122, 59, 0.37)
}

  .site-menu-item a {
    display: block;
    color: hsla(219, 100%, 100%, 0.99);
}
.site-menubar-fold .site-menu>.site-menu-item>.site-menu-sub{
	 background: hsla(201, 19%, 17%, 0.08);
	  background-image: url('<?php echo e(asset('upload/bg2.jpg')); ?>');
}

.site-menu>.site-menu-item.open {
    background: hsla(201, 19%, 17%, 0.08);
}

.site-menubar-unfold .site-menu-category {
	color:#f9f9f9;
}
  
  
  
  </style>
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
        <img class="navbar-brand-logo" src="<?php echo e(URL::asset('assets/images/logo.png')); ?>" title="HCMatrix">
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
                <img src="<?php echo e(URL::asset('classic/global/portraits/5.jpg')); ?>" alt="...">
                <i></i>
              </span>
            </a>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="<?php echo e(url('/viewprofile')); ?>" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
              <div class="dropdown-divider" role="presentation"></div>
              <a class="dropdown-item" href="<?php echo e(url('/logout')); ?>" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
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
          <ul class="site-menu" data-plugin="menu">
            <li class="site-menu-category">Welcome <?php echo e(strtoupper(Auth::user()->name)); ?></li>
			
			<!-- SUBMENU ICON  -->           
		 <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<!-- SUBMENU ICON  --> 
			
         </DIV>
      </div>
    </div>
  </div>
   