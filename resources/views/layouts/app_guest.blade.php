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
    <script type="text/javascript">
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
          window.location = "/available_jobs/joblist/filter/" + experience + "/" + jobtype + "/" + emptype + "/" + deptfil + "/" + dateposted + "/" + location;
        });
      })
    </script>

  </head>
  <body class="animsition site-menubar-fold site-menubar-keep">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
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
            <!--<img class="navbar-brand-logo" src="{{asset('assets/images/logo.png')}}" title="HCMatrix">-->
            <span class="navbar-brand-text hidden-xs-down"> HCMatrix</span>
          </div>
        </div>
        <div class="navbar-container container-fluid">
          <!-- Navbar Collapse -->
          <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
              <li class="nav-item hidden-sm-down" id="toggleFullscreen">
                <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                  <span class="sr-only">Toggle fullscreen</span>
                </a>
              </li>
            </ul>
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
                <span class="flag-icon flag-icon-gb"></span> English
              </a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-fr"></span> French
              </a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-cn"></span> Chinese
              </a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-de"></span> German
              </a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-nl"></span> Dutch
              </a>
            </div>
          </li>
        </ul>
        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->
    </div>
  </nav>

  <div class="site-menubar">
    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu" data-plugin="menu">
            <li class="site-menu-item has-sub menuborder" >
              <a href="javascript:void(0)" onclick="url('{{url('/')}}')">
                <i class="site-menu-icon  wb-home" aria-hidden="true"></i>
                <span class="site-menu-title">Home</span>

              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Page -->
  <div class="page">
    <div class="page-content container-fluid">
      @yield('content')
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
  <!-- Core  -->
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