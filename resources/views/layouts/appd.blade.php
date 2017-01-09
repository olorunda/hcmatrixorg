<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>HCMatrix</title>
  <link rel="apple-touch-icon" href="../assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="../assets/images/favicon.ico">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="../../global/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../global/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="../assets/css/site.min.css">
  <!-- Plugins -->
  <link rel="stylesheet" href="../../global/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="../../global/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="../../global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="../../global/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="../../global/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="../../global/vendor/flag-icon-css/flag-icon.css">
  <link rel="stylesheet" href="{{asset('assets/css/nprogress.css')}}">
  <link rel="stylesheet" href="../../../global/vendor/dropify/dropify.css">
  <link rel="stylesheet" href="../../global/vendor/chartist/chartist.css">
  <link rel="stylesheet" href="../../global/vendor/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../../global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
  <link rel="stylesheet" href="../assets/examples/css/dashboard/v1.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert.css')}}">
 
 <!-- Fonts -->
  <link rel="stylesheet" href="../../global/fonts/weather-icons/weather-icons.css">
  <link rel="stylesheet" href="../../global/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="../../global/fonts/brand-icons/brand-icons.min.css">
  <link rel="stylesheet" href="../../../../global/fonts/font-awesome/font-awesome.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

  @if(active('employee/objective'))
  <link rel="stylesheet" href="{{asset('assets/css/documents.css')}}">
  <link rel="stylesheet" href="../../../global/vendor/ladda/ladda.css">
  @elseif(active('lm/objectives_c'))
  <link rel="stylesheet" href="../../../../global/vendor/tablesaw/tablesaw.css">
  <link rel="stylesheet" href="../../../assets/examples/css/apps/contacts.css">
  <link rel="stylesheet" href="{{asset('assets/css/objectives.css')}}">
  <link rel="stylesheet" href="../../../global/vendor/toastr/toastr.css">
  <link rel="stylesheet" href="../../assets/examples/css/advanced/toastr.css">
  @elseif(active(['lm/objectives_a']))
  <link rel="stylesheet" href="../../../global/vendor/editable-table/editable-table.css">
  <link rel="stylesheet" href="../../../global/vendor/summernote/summernote.css">
  <link rel="stylesheet" href="../../../global/vendor/select2/select2.css">
  @elseif(active('lm/rate'))
  <link rel="stylesheet" href="../../../global/vendor/select2/select2.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert.css')}}">
  <link rel="stylesheet" href="../../../global/vendor/morris/morris.css">
  <link rel="stylesheet" href="../../assets/examples/css/advanced/rating.css">
  <style type="text/css">
    textarea {
      resize: none;
    }
  </style>
  @endif
  <!--[if lt IE 9]>
    <script src="../../global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="../../global/vendor/media-match/media.match.min.js"></script>
    <script src="../../global/vendor/respond/respond.min.js"></script>
    <![endif]-->
    <!-- Scripts -->
    <script src="../../global/vendor/breakpoints/breakpoints.js"></script>
    <script>
      Breakpoints();
    </script>
    <style>
      .menuborder{
      #  border-bottom: 2px groove rgb(24, 61, 80);    
      }
	  .site-menubar{
	  
	    background-image: url('{{asset('upload/bg.jpg')}}');
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
	  background-image: url('{{asset('upload/bg2.jpg')}}');
}

.site-menu>.site-menu-item.open {
    background: hsla(201, 19%, 17%, 0.08);
}

.site-menubar-unfold .site-menu-category {
	color:#f9f9f9;
}
    </style>
  </head>

  @if(active('lm/objectives_c'))
  <body class="animsition app-contacts page-aside-left">
    @else
    <body class="animsition dashboard">
      @endif
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <nav style="background-color:#077a3b" class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
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
          <img class="navbar-brand-logo" src="../assets/images/logo.png" title="Remark">
          <span class="navbar-brand-text hidden-xs-down"> HCMatrix</span>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
        data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon wb-search" aria-hidden="true"></i>
      </button>
    </div>
    <div style="background-color:#ffde20;" class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
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
      </ul>
      <!-- End Navbar Toolbar -->
      <!-- Navbar Toolbar Right -->
      <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
        <li class="nav-item hidden-float" style="margin-top:15px;">
          <select class="form-control " id="fiscalyear" onchange="setfy()"> 
           <option value="{{date('Y')}}">- Fiscal Year -</option>

           @for($i=2016; $i<=date('Y'); $i++ )

           <option value="{{$i}}">{{$i}}</option>
           @endfor
         </select>

       </li>
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
                  <img src="../../global/portraits/5.jpg" alt="...">
                  <i></i>
                </span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="{{url('profile')}}" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Settings</a>
                <div class="dropdown-divider" role="presentation"></div>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem" onclick="logout()"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
                <input type="hidden" id="logout" name="token" value="{{csrf_token()}}" /> 
              </div>
            </li>
          </ul>
          <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
          <form role="search">
            <div class="form-group">
              <div class="input-search">
                <i class="input-search-icon wb-search" aria-hidden="true"></i>
                <input type="text" class="form-control" name="site-search" placeholder="Search...">
                <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
                data-toggle="collapse" aria-label="Close"></button>
              </div>
            </div>
          </form>
        </div>
        <!-- End Site Navbar Seach -->
      </div>
    </nav>
    <div class="site-menubar">
      <div class="site-menubar-body">
        <div>
          <div>
            <ul class="site-menu" data-plugin="menu">
              <li class="site-menu-category">Welcome {{strtoupper(Auth::user()->name)}}</li>

              <!-- SUBMENU ICON  -->           
              @include('partials.sidebar')
              <!-- SUBMENU ICON  --> 

            </DIV>
          </div>
        </div>
      </div>
      <!-- Page -->
      @if(active('lm/objectives_c'))
      @yield('content')
      @else
      <div class="page">
        <div class="page-content container-fluid">

          @yield('content')


        </div>
      </div>
      @endif
      <!-- End Page -->
      <!-- Footer -->
      <footer class="site-footer">
        <div class="site-footer-legal">© 2016 <a href="http://www.snapnet.com.ng">Snapnet Nigeria</a></div>
        <div class="site-footer-right">
          Developed By  <a href="http://www.snapnet.com.ng">Snapnet Nigeria</a>
        </div>
      </footer>
      <!-- Core  -->
      <script src="../../global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
      <script src="../../global/vendor/jquery/jquery.js"></script>
      <script src="../../global/vendor/tether/tether.js"></script>
      <script src="../../global/vendor/bootstrap/bootstrap.js"></script>
      <script src="../../global/vendor/animsition/animsition.js"></script>
      <script src="../../global/vendor/mousewheel/jquery.mousewheel.js"></script>
      <script src="../../global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
      <script src="../../global/vendor/asscrollable/jquery-asScrollable.js"></script>
      <script src="../../global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
      <!-- Plugins -->
      <script src="../../global/vendor/switchery/switchery.min.js"></script>
      <script src="../../global/vendor/intro-js/intro.js"></script>
      <script src="../../global/vendor/screenfull/screenfull.js"></script>
      <script src="../../global/vendor/slidepanel/jquery-slidePanel.js"></script>
      <script src="../../global/vendor/skycons/skycons.js"></script>
      <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
  <!--<script src="../../global/vendor/chartist/chartist.min.js"></script>
  <script src="../../global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js"></script>-->
  <script src="../../global/vendor/aspieprogress/jquery-asPieProgress.min.js"></script>
  <script src="../../global/vendor/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="../../global/vendor/jvectormap/maps/jquery-jvectormap-au-mill-en.js"></script>
  <script src="../../global/vendor/matchheight/jquery.matchHeight-min.js"></script>
  <!-- Scripts -->
  <script src="../../global/js/State.js"></script>
  <script src="../../global/js/Component.js"></script>
  <script src="../../global/js/Plugin.js"></script>
  <script src="../../global/js/Base.js"></script>
  <script src="../../global/js/Config.js"></script>
  <script src="../assets/js/Section/Menubar.js"></script>
  <script src="../assets/js/Section/GridMenu.js"></script>
  <script src="../assets/js/Section/Sidebar.js"></script>
  <script src="../assets/js/Section/PageAside.js"></script>
  <script src="../assets/js/Plugin/menu.js"></script>
  <script src="../../global/js/config/colors.js"></script>
  <script src="../assets/js/config/tour.js"></script>
  <script>
    Config.set('assets', '../assets');
  </script>
  <!-- Page -->
  <script src="../assets/js/Site.js"></script>
  <script src="../../global/js/Plugin/asscrollable.js"></script>
  <script src="../../global/js/Plugin/slidepanel.js"></script>
  <script src="../../global/js/Plugin/switchery.js"></script>
  <script src="../../global/js/Plugin/matchheight.js"></script>
  <script src="../../global/js/Plugin/dropify.min.js"></script>
  <script src="../../global/js/Plugin/jvectormap.js"></script>
  <script src="../assets/examples/js/dashboard/v1.js"></script>
  <script>
 function setfy(){

	  var year=document.getElementById('fiscalyear').value;
	  $.get('{{url('setfy')}}/'+year,function(data,status,xhr){
		
		if(xhr.status==200){
			window.location.reload();
		}
	});	
		
	  
  }
    function logout(){
      var token=$('#logout').val();
      $.post('{{url('logout')}}',{_token:token }, function(data,status,xhr){
       window.location.reload();

     });
    }

  </script>

  @if(active('employee/objective'))
  <script type="text/javascript" src="{{asset('assets/js/App/Documents.js')}}"></script>
  <script src="../../../global/vendor/jquery-appear/jquery.appear.js"></script>
  <script src="../../../global/js/Plugin/jquery-appear.js"></script>
  <script src="../../../global/js/Plugin/loading-button.js"></script>
  <script src="../../../global/js/Plugin/more-button.js"></script>
  <script src="../../../global/vendor/ladda/spin.min.js"></script>
  <script src="../../../global/vendor/ladda/ladda.min.js"></script>
  <script src="../../../global/js/Plugin/ladda.js"></script>
  <script src="../../../global/js/Plugin/peity.js"></script>
  <script src="../../assets/examples/js/tables/jqtabledit.js"></script>
  @elseif(active('lm/objectives_c'))
  <script src="../../../../global/js/Plugin/tablesaw.js"></script>
  <script src="../../../../global/js/Plugin/sticky-header.js"></script>
  <script src="../../../../global/js/Plugin/action-btn.js"></script>
  <script src="../../../../global/js/Plugin/asselectable.js"></script>
  <script src="../../../../global/js/Plugin/editlist.js"></script>
  <script src="../../../../global/js/Plugin/aspaginator.js"></script>
  <script src="../../../../global/js/Plugin/animate-list.js"></script>
  <script src="../../../../global/js/Plugin/jquery-placeholder.js"></script>
  <script src="../../../../global/js/Plugin/material.js"></script>
  <script src="../../../../global/js/Plugin/selectable.js"></script>
  <script src="../../../../global/js/Plugin/bootbox.js"></script>
  <script src="../../../assets/js/BaseApp.js"></script>
  <script src="../../../assets/js/App/Contacts.js"></script>
  <script src="../../../assets/examples/js/apps/contacts.js"></script>
  <script src="../../../global/vendor/toastr/toastr.js"></script>
  <script src="../../../global/js/Plugin/toastr.js"></script>
  <script src="{{asset('assets/js/lmemps.js')}}"></script>
  @elseif(active(['lm/objectives_a']))
  <script src="../../../global/vendor/editable-table/mindmup-editabletable.js"></script>
  <script src="../../../global/vendor/editable-table/numeric-input-example.js"></script>
  <script src="../../../global/js/Plugin/editable-table.js"></script>
  <script src="../../assets/examples/js/tables/editable.js"></script>
  <script src="../../../global/vendor/summernote/summernote.min.js"></script>
  <script src="../../../global/js/Plugin/summernote.js"></script>
  <script src="../../assets/examples/js/forms/editor-summernote.js"></script>
  <script src="../../../global/vendor/select2/select2.full.min.js"></script>
  <script src="../../../global/js/Plugin/select2.js"></script>
  <script src="../../../global/vendor/jquery-appear/jquery.appear.js"></script>
  <script src="../../../global/js/Plugin/jquery-appear.js"></script>
  <style type="text/css">
    .hide {
      display: none;
    }
  </style>
  @elseif(active('lm/rate'))
  <script src="../../../global/vendor/select2/select2.full.min.js"></script>
  <script src="../../../global/js/Plugin/select2.js"></script>
   <script src="{{asset('assets/js/nprogress.js')}}"></script>
  <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
  <script src="../../../global/vendor/raphael/raphael-min.js"></script>
  <script src="../../../global/vendor/morris/morris.min.js"></script>
  <script src="../../assets/examples/js/charts/morris.js"></script>
  <script src="../../../global/vendor/raty/jquery.raty.js"></script>
  <!--<script src="../../../global/js/Plugin/raty.js"></script>-->
  <script src="{{asset('assets/js/myrate.js')}}"></script>
  @endif
  	<script>
	$(function(){
			
	 $(document).ajaxStart(function(){
		 
		NProgress.start();
	     
	}).ajaxStop(function(){
		
		
		NProgress.done();
		 
	});
	 
	 
	});
 
 </script>
</body>
</html>