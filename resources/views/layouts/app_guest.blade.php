<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>HCMatrix</title>
  <link rel="apple-touch-icon" href="{{asset('assets/images/apple-touch-icon.png')}}">
  <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{asset('global/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('global/css/bootstrap-extend.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/site.min.css')}}">
  
  <link rel="stylesheet" href="{{asset('assets/css/documents.css')}}">
  <!--<link rel="stylesheet" href="assets/css/nprogress.css')}}">
-->
<!-- Plugins -->

<link rel="stylesheet" href="{{asset('assets/examples/css/uikit/modals.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/animsition/animsition.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/asscrollable/asScrollable.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/switchery/switchery.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/intro-js/introjs.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/slidepanel/slidePanel.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/flag-icon-css/flag-icon.css')}}">
<link rel="stylesheet" href="{{asset('assets/examples/css/dashboard/v1.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">

<link rel="stylesheet" href="{{asset('global/vendor/dropify/dropify.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/chartist/chartist.css')}}">

<link href="{{asset('global/vendor/select2/select2.css')}}" rel="stylesheet" >
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert.css')}}">

<link rel="stylesheet" href="{{asset('global/vendor/jvectormap/jquery-jvectormap.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/morris/morris.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/magnific-popup/magnific-popup.css')}}">
<link rel="stylesheet" href="{{asset('assets/examples/css/advanced/lightbox.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')}}">
<link rel="stylesheet" href="{{asset('assets/examples/css/dashboard/v1.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/ladda/ladda.css')}}">
<link rel="stylesheet" href="{{asset('assets/examples/css/uikit/buttons.css')}}">
<link rel="stylesheet" href="{{asset('global/fonts/font-awesome/font-awesome.css')}}">
<link rel="stylesheet" type="text/css')}}" href="{{asset('assets/css/sweetalert.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/bootstrap-markdown/bootstrap-markdown.css')}}">
<script src="{{asset('assets/js/sweetalert.min.js')}}"></script>

<link rel="stylesheet" href="{{asset('global/vendor/toastr/toastr.css')}}">
<link rel="stylesheet" href="../../assets/examples/css/advanced/toastr.css">
<!-- Fonts -->
<link rel="stylesheet" href="{{asset('global/fonts/weather-icons/weather-icons.css')}}">
<link rel="stylesheet" href="{{asset('global/fonts/web-icons/web-icons.min.css')}}">
<link rel="stylesheet" href="{{asset('global/fonts/brand-icons/brand-icons.min.css')}}">
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
<link rel="stylesheet" href="../../../global/vendor/select2/select2.css">
<link rel="stylesheet" href="../../assets/examples/css/structure/ribbon.css">
<style type="text/css">
  .fm-padd-border {
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    -webkit-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    transition: all .2s ease-in-out;
  }
  span.ribbon-inner {
    cursor: pointer;
  }
  #my-dropzone {
    font-family: "Segoe UI";
    border: 1px solid rgb(228, 234, 236);
    font-size: 18px;
    color: black;
    height: 100px;
    background-repeat: no-repeat;
    background-position: center;
    padding: 20px;
    padding-top: -10px;
  }
  .dz-preview {
    position: relative;
    top: -30px;
  }
  .sm-select {
    width: 200px;
    margin: 0px auto;
    background: #ccc;
    display: block;
  } 
  .sm-select-label {
    width: 200px;
    margin: 0px auto;
    display: block;
  }
</style>
<link rel="stylesheet" href="../../../global/vendor/formvalidation/formValidation.css">
<link rel="stylesheet" href="../../assets/examples/css/forms/validation.css">
<link rel="stylesheet" href="{{asset('global/vendor/bootstrap-datepicker/bootstrap-datepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/dropzone.min.css')}}">
<link rel="stylesheet" href="../../assets/examples/css/advanced/animation.css">
  <!--[if lt IE 9]>
    <script src="{{asset('global/vendor/html5shiv/html5shiv.min.js')}}"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="{{asset('global/vendor/media-match/media.match.min.js')}}"></script>
    <script src="{{asset('global/vendor/respond/respond.min.js')}}"></script>
    <![endif]-->
    <!-- Scripts -->
    <script src="{{asset('global/vendor/breakpoints/breakpoints.js')}}"></script>
    <script>
      Breakpoints();
    </script>

    <style>
      .menuborder{
        #  border-bottom: 2px groove rgb(24, 61, 80);
      } 
    </style>
    <script src="{{asset('global/vendor/jquery/jquery.js')}}"></script>
    <!--<script type="text/javascript">
      $(function(){
        $("#searchForm").submit(function(e){
          e.preventDefault();
          var experience          = $("#experience").val();
          var jobtype             = $("#jobtype").val();
          var emptype             = $("#emptype").val();
          var deptfil             = $("#deptfil").val();
          var dateposted          = $("#dateposted").val();
          var location            = $("#location").val();
          var token               = $("#vKey").val();

          /*var formData = {'experience':experience, 'jobtype':jobtype, 'emptype':emptype, 'deptfil':deptfil, 'dateposted':dateposted, 'location':location, '_token':token};*/
          window.location = {{ Request::url() }} +"/available_jobs/joblist/filter/?experience=" + experience + "/&jobtype=" + jobtype + "/&emptype=" + emptype + "/&deptfil=" + deptfil + "/&dateposted=" + dateposted + "/&location=" + location;
        });
      })
    </script>-->

  </head>
  <body class="animsition dashboard site-menubar-fold site-menubar-keep" style="margin-left: -7%">

  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <nav style="background:#ffde20;" class="site-navbar navbar navbar-default navbar-inverse navbar-fixed-top navbar-mega" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided" data-toggle="menubar">
              <span class="sr-only">Toggle navigation</span>
              <span class="hamburger-bar"></span>
            </button>
            <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
            data-toggle="collapse">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
          </button>
          <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
            <img class="navbar-brand-logo" src="../assets/images/logo.png" title="HCMatrix">
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
		  
        <!-- End Navbar Toolbar -->
        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
          <!--<li class="nav-item dropdown">
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
          </li>--
          <li class="nav-item dropdown">
            <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
            data-animation="scale-up" role="button">
            <span class="avatar avatar-online">
              <img src="../../global/portraits/5.jpg" alt="...">
              <i></i>
            </span>
          </a>
          <div class="dropdown-menu" role="menu">
            <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
            <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-payment" aria-hidden="true"></i> Billing</a>
            <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Settings</a>
            <div class="dropdown-divider" role="presentation"></div>
            <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
          aria-expanded="false" data-animation="scale-up" role="button">
          <i class="icon wb-bell" aria-hidden="true"></i>
          <span class="label label-pill label-danger up">5</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
          <div class="dropdown-menu-header">
            <h5>NOTIFICATIONS</h5>
            <span class="label label-round label-danger">New 5</span>
          </div>
          <div class="list-group">
            <div data-role="container">
              <div data-role="content">
                <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                  <div class="media">
                    <div class="media-left p-r-10">
                      <i class="icon wb-order bg-red-600 white icon-circle" aria-hidden="true"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">A new order has been placed</h6>
                      <time class="media-meta" datetime="2016-06-12T20:50:48+08:00">5 hours ago</time>
                    </div>
                  </div>
                </a>
                <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                  <div class="media">
                    <div class="media-left p-r-10">
                      <i class="icon wb-user bg-green-600 white icon-circle" aria-hidden="true"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">Completed the task</h6>
                      <time class="media-meta" datetime="2016-06-11T18:29:20+08:00">2 days ago</time>
                    </div>
                  </div>
                </a>
                <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                  <div class="media">
                    <div class="media-left p-r-10">
                      <i class="icon wb-settings bg-red-600 white icon-circle" aria-hidden="true"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">Settings updated</h6>
                      <time class="media-meta" datetime="2016-06-11T14:05:00+08:00">2 days ago</time>
                    </div>
                  </div>
                </a>
                <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                  <div class="media">
                    <div class="media-left p-r-10">
                      <i class="icon wb-calendar bg-blue-600 white icon-circle" aria-hidden="true"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">Event started</h6>
                      <time class="media-meta" datetime="2016-06-10T13:50:18+08:00">3 days ago</time>
                    </div>
                  </div>
                </a>
                <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                  <div class="media">
                    <div class="media-left p-r-10">
                      <i class="icon wb-chat bg-orange-600 white icon-circle" aria-hidden="true"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">Message received</h6>
                      <time class="media-meta" datetime="2016-06-10T12:34:48+08:00">3 days ago</time>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="dropdown-menu-footer">
            <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
              <i class="icon md-settings" aria-hidden="true"></i>
            </a>
            <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
              All notifications
            </a>
          </div>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Messages"
        aria-expanded="false" data-animation="scale-up" role="button">
        <i class="icon wb-envelope" aria-hidden="true"></i>
        <span class="label label-pill label-info up">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
        <div class="dropdown-menu-header" role="presentation">
          <h5>MESSAGES</h5>
          <span class="label label-round label-info">New 3</span>
        </div>
        <div class="list-group" role="presentation">
          <div data-role="container">
            <div data-role="content">
              <a class="list-group-item" href="javascript:void(0)" role="menuitem">
                <div class="media">
                  <div class="media-left p-r-10">
                    <span class="avatar avatar-sm avatar-online">
                      <img src="../../global/portraits/2.jpg" alt="..." />
                      <i></i>
                    </span>
                  </div>
                  <div class="media-body">
                    <h6 class="media-heading">Mary Adams</h6>
                    <div class="media-meta">
                      <time datetime="2016-06-17T20:22:05+08:00">30 minutes ago</time>
                    </div>
                    <div class="media-detail">Anyways, i would like just do it</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item" href="javascript:void(0)" role="menuitem">
                <div class="media">
                  <div class="media-left p-r-10">
                    <span class="avatar avatar-sm avatar-off">
                      <img src="../../global/portraits/3.jpg" alt="..." />
                      <i></i>
                    </span>
                  </div>
                  <div class="media-body">
                    <h6 class="media-heading">Caleb Richards</h6>
                    <div class="media-meta">
                      <time datetime="2016-06-17T12:30:30+08:00">12 hours ago</time>
                    </div>
                    <div class="media-detail">I checheck the document. But there seems</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item" href="javascript:void(0)" role="menuitem">
                <div class="media">
                  <div class="media-left p-r-10">
                    <span class="avatar avatar-sm avatar-busy">
                      <img src="../../global/portraits/4.jpg" alt="..." />
                      <i></i>
                    </span>
                  </div>
                  <div class="media-body">
                    <h6 class="media-heading">June Lane</h6>
                    <div class="media-meta">
                      <time datetime="2016-06-16T18:38:40+08:00">2 days ago</time>
                    </div>
                    <div class="media-detail">Lorem ipsum Id consectetur et minim</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item" href="javascript:void(0)" role="menuitem">
                <div class="media">
                  <div class="media-left p-r-10">
                    <span class="avatar avatar-sm avatar-away">
                      <img src="../../global/portraits/5.jpg" alt="..." />
                      <i></i>
                    </span>
                  </div>
                  <div class="media-body">
                    <h6 class="media-heading">Edward Fletcher</h6>
                    <div class="media-meta">
                      <time datetime="2016-06-15T20:34:48+08:00">3 days ago</time>
                    </div>
                    <div class="media-detail">Dolor et irure cupidatat commodo nostrud nostrud.</div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="dropdown-menu-footer" role="presentation">
          <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
            <i class="icon wb-settings" aria-hidden="true"></i>
          </a>
          <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
            See all messages
          </a>
        </div>
      </div>
    </li>
    <li class="nav-item" id="toggleChat">
      <a class="nav-link" data-toggle="site-sidebar" href="javascript:void(0)" title="Chat"
      data-url="site-sidebar.tpl">
      <i class="icon wb-chat" aria-hidden="true"></i>
    </a>
  </li>
</ul>
 End Navbar Toolbar Right -->
        <!--<div class="navbar-brand navbar-brand-center">
          <a href="index.html">
            <img class="navbar-brand-logo" src="../assets/images/logo.png" title="HCMatrix">
          </a>
        </div>-->
      </div>
      <!-- End Navbar Collapse -->
    </div>
  </nav>
  <div class="site-menubar" style="background: #f1f4f5;">
    <div class="site-menubar-body" style="background: #f1f4f5;">
      <div style="background: #f1f4f5;">
        <div style="background: #f1f4f5;">
          <ul class="site-menu" data-plugin="menu" style="background: #f1f4f5;">
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Page -->
  <div class="page">
    <div class="page-content container-fluid">
      <div class="row" data-plugin="matchHeight" data-by-row="true">
      <div class="col-xxl-12 col-lg-12 col-xs-12">
         @yield('content')
       </div>
     </div>
   </div>
 </div>
 <!-- End Page -->
 <!-- Footer -->
 <footer class="site-footer">
  <div class="site-footer-legal">&copy; 2016 <a href="http://www.snapnet.com.ng">Snapnet Limited</a></div>
  <div class="site-footer-right">
    Developed By  <a href="http://www.snapnet.com.ng">Snapnet Limited</a>
  </div>
</footer>
<script src="{{asset('global/vendor/babel-external-helpers/babel-external-helpers.js')}}"></script>


<script src="{{asset('global/vendor/tether/tether.js')}}"></script>
<script src="{{asset('global/vendor/bootstrap/bootstrap.js')}}"></script>
<script src="{{asset('global/vendor/animsition/animsition.js')}}"></script>
<script src="{{asset('global/vendor/mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('global/vendor/asscrollbar/jquery-asScrollbar.js')}}"></script>
<script src="{{asset('global/vendor/asscrollable/jquery-asScrollable.js')}}"></script>
<script src="{{asset('global/vendor/ashoverscroll/jquery-asHoverScroll.js')}}"></script>
<!-- Plugins -->
<script src="{{asset('global/vendor/switchery/switchery.min.js')}}"></script>
<!--<script src="{{asset('global/js/Plugin/jquery-appear.min.js')}}"></script>-->
<script src="{{asset('global/vendor/intro-js/intro.js')}}"></script>
<script src="{{asset('global/vendor/screenfull/screenfull.js')}}"></script>
<script src="{{asset('global/vendor/slidepanel/jquery-slidePanel.js')}}"></script>
<script src="{{asset('global/vendor/skycons/skycons.js')}}"></script>
<!--<script src="{{asset('global/vendor/chartist/chartist.min.js')}}"></script>-->
<script src="{{asset('global/vendor/raphael/raphael-min.js')}}"></script>
<script src="{{asset('global/vendor/morris/morris.min.js')}}"></script>
<!--<script src="{{asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js')}}"></script>-->
<script src="{{asset('global/vendor/aspieprogress/jquery-asPieProgress.min.js')}}"></script>
<script src="{{asset('global/vendor/jvectormap/jquery-jvectormap.min.js')}}"></script>
<script src="{{asset('global/vendor/jvectormap/maps/jquery-jvectormap-au-mill-en.js')}}"></script>
<script src="{{asset('global/vendor/matchheight/jquery.matchHeight-min.js')}}"></script>
<!-- Scripts -->
<script src="{{asset('global/js/State.js')}}"></script>
<script src="{{asset('global/js/Component.js')}}"></script>
<script src="{{asset('global/js/Plugin.js')}}"></script>
<script src="{{asset('global/js/Base.js')}}"></script>
<script src="{{asset('global/js/Config.js')}}"></script>
<script src="{{asset('assets/js/Section/Menubar.js')}}"></script>
<script src="{{asset('assets/js/nprogress.js')}}"></script>
<script src="{{asset('assets/js/Section/GridMenu.js')}}"></script>
<script src="{{asset('assets/js/Section/Sidebar.js')}}"></script>
<script src="{{asset('assets/js/Section/PageAside.js')}}"></script>
<script src="{{asset('assets/js/Plugin/menu.js')}}"></script>
<script src="{{asset('global/js/config/colors.js')}}"></script>
<script src="{{asset('assets/js/config/tour.js')}}"></script>
<script src="{{asset('global/vendor/ladda/spin.min.js')}}"></script>
<script src="{{asset('global/vendor/ladda/ladda.min.js')}}"></script>
<script src="{{asset('global/vendor/switchery/switchery.min.js')}}"></script>
<script src="{{asset('global/vendor/intro-js/intro.js')}}"></script>
<script src="{{asset('global/vendor/screenfull/screenfull.js')}}"></script>
<script src="{{asset('global/vendor/slidepanel/jquery-slidePanel.js')}}"></script>
<script>
  Config.set('assets', 'assets');
</script>
<!-- Page -->
<script src="{{asset('assets/js/Site.js')}}"></script>
<script src="{{asset('global/js/Plugin/asscrollable.js')}}"></script>
<script src="{{asset('global/js/Plugin/slidepanel.js')}}"></script>

<script src="{{asset('global/js/Plugin/switchery.js')}}"></script>
<script src="{{asset('global/js/Plugin/matchheight.js')}}"></script>
<script src="{{asset('global/js/Plugin/dropify.min.js')}}"></script>
<script src="{{asset('global/js/Plugin/jvectormap.js')}}"></script>
<script src="{{asset('global/js/Plugin/loading-button.js')}}"></script>
<script src="{{asset('global/js/Plugin/more-button.js')}}"></script>
<script src="{{asset('global/js/Plugin/ladda.js')}}"></script>
<script src="{{asset('global/js/Plugin/slidepanel.js')}}"></script>
<script src="{{asset('global/js/Plugin/switchery.js')}}"></script>

<script src="{{asset('global/js/Plugin/toastr.js')}}"></script>
<script src="{{asset('global/vendor/toastr/toastr.js')}}"></script>
<script src="{{asset('assets/examples/js/dashboard/v1.js')}}"></script>
<script src="../../../global/vendor/select2/select2.full.min.js"></script>
<script src="../../../global/js/Plugin/select2.js"></script>
<script type="text/javascript">
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  })
</script>
<script src="../../../global/vendor/jquery-appear/jquery.appear.js"></script>
<script src="../../../global/js/Plugin/jquery-appear.js"></script>
<script src="../../../global/js/Plugin/material.js"></script>
<script src="../../../global/vendor/formvalidation/formValidation.min.js"></script>
<script src="../../../global/vendor/formvalidation/framework/bootstrap4.min.js"></script>
<script src="../../assets/examples/js/forms/validation.js"></script>
<script src="../../../global/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="../../../global/js/Plugin/bootstrap-datepicker.js"></script>
<script src="{{asset('assets/js/dropzone.min.js')}}"></script>
<script src="../../assets/examples/js/advanced/animation.js"></script>
<script src="{{asset('global/vendor/select2/select2.full.min.js')}}"></script>
<script src="{{asset('global/js/Plugin/select2.js')}}"></script>

<script src="{{asset('global/vendor/moment/moment.min.js')}}"></script>
<script src="{{asset('global/vendor/fullcalendar/fullcalendar.js')}}"></script>
<script type="text/javascript">
  $(function(){
    console.log("Page Loaded 2");
  })
</script>
</body>
</html>