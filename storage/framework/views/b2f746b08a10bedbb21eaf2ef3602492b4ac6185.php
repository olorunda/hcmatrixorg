<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>HCMatrix</title>
  <link rel="apple-touch-icon" href="<?php echo e(asset('assets/images/apple-touch-icon.png')); ?>">
  <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.ico')); ?>">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?php echo e(asset('global/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/css/bootstrap-extend.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/site.min.css')); ?>">
  <!-- Plugins -->
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/animsition/animsition.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/pace.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/asscrollable/asScrollable.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/switchery/switchery.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/intro-js/introjs.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/slidepanel/slidePanel.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/flag-icon-css/flag-icon.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/nprogress.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/dropify/dropify.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/chartist/chartist.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/jvectormap/jquery-jvectormap.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')); ?>">
  <link rel="stylesheet" href="assets/examples/css/dashboard/v1.css')}}">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/sweetalert.css')); ?>">
 
 <!-- Fonts -->
  <link rel="stylesheet" href="<?php echo e(asset('global/fonts/weather-icons/weather-icons.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/fonts/web-icons/web-icons.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/fonts/brand-icons/brand-icons.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/fonts/font-awesome/font-awesome.css')); ?>">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

  <?php if(active(session('locale').'/employee/objective')): ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/documents.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/ladda/ladda.css')); ?>">
  <?php elseif(active(session('locale').'/lm/objectives_c')): ?>
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/tablesaw/tablesaw.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/apps/contacts.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/objectives.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/toastr/toastr.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/advanced/toastr.css')); ?>">
  <?php elseif(active(['lm/objectives_a'])): ?>
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/editable-table/editable-table.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/summernote/summernote.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/select2/select2.css')); ?>">
  <?php elseif(active(session('locale').'/lm/rate')): ?>
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/select2/select2.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/sweetalert.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/morris/morris.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/advanced/rating.css')); ?>">
  <style type="text/css">
    textarea {
      resize: none;
    }
  </style>
  <?php endif; ?>
  <!--[if lt IE 9]>
    <script src="<?php echo e(asset('global/vendor/html5shiv/html5shiv.min.js')); ?>"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="<?php echo e(asset('global/vendor/media-match/media.match.min.js"')); ?>></script>
    <script src="<?php echo e(asset('global/vendor/respond/respond.min.js')); ?>"></script>
    <![endif]-->
    <!-- Scripts -->
    <script src="<?php echo e(asset('global/vendor/breakpoints/breakpoints.js')); ?>"></script>
    <script>
      Breakpoints();
    </script>
    <style>
      .menuborder{
      #  border-bottom: 2px groove rgb(24, 61, 80);    
      }
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

  <?php if(active(session('locale').'/lm/objectives_c')): ?>
  <body class="animsition app-contacts page-aside-left">
    <?php else: ?>
    <body class="animsition dashboard">
      <?php endif; ?>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <nav  class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
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
          <img class="navbar-brand-logo" src="<?php echo e(asset('assets/images/logo.png')); ?>" title="Remark">
          <span class="navbar-brand-text hidden-xs-down"> HCMatrix</span>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
        data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon wb-search" aria-hidden="true"></i>
      </button>
    </div>
    <div   class="navbar-container container-fluid">
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
           <option value="<?php echo e(date('Y')); ?>">- Fiscal Year -</option>

           <?php for($i=2016; $i<=date('Y'); $i++ ): ?>

           <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
           <?php endfor; ?>
         </select>

       </li>
            <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up"
            aria-expanded="false" role="button">	
			<?php   
			
					if(session('locale')=='en'):

						$lang='gb';
					elseif(session('locale')=='fr'):
						$lang='fr';
					elseif(session('locale')=='zu'):
						$lang='sa';
					elseif(session('locale')=='yo'||session('locale')=='ig'):
						$lang='ng';
					else:
						$lang='gb';
					endif
			?>
              <span class="flag-icon flag-icon-<?php echo e($lang); ?>"></span>
            </a>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="<?php echo e(url('change/en')); ?>" role="menuitem">
                <span class="flag-icon flag-icon-gb"></span> <?php echo e(_t('English')); ?></a>
              <a class="dropdown-item" href="<?php echo e(url('change/fr')); ?>" role="menuitem">
                <span class="flag-icon flag-icon-fr"></span> <?php echo e(_t('French')); ?></a>
              <a class="dropdown-item" href="<?php echo e(url('change/zu')); ?>" role="menuitem">
                <span class="flag-icon flag-icon-sa"></span> <?php echo e(_t('Zulu')); ?></a>
              <a class="dropdown-item" href="<?php echo e(url('change/yo')); ?>" role="menuitem">
                <span class="flag-icon flag-icon-ng"></span> <?php echo e(_t('Yoruba')); ?></a>
              <a class="dropdown-item" href="<?php echo e(url('change/ig')); ?>" role="menuitem">
                <span class="flag-icon flag-icon-ng"></span> <?php echo e(_t('Igbo')); ?></a>
            </div>
          </li>
              <li class="nav-item dropdown">
                <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img src="<?php echo e(asset('global/portraits/5.jpg')); ?>"> alt="...">
                  <i></i>
                </span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="<?php echo e(url('profile')); ?>" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Settings</a>
                <div class="dropdown-divider" role="presentation"></div>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem" onclick="logout()"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
                <input type="hidden" id="logout" name="token" value="<?php echo e(csrf_token()); ?>" /> 
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
              <li class="site-menu-category">Welcome <?php echo e(strtoupper(Auth::user()->name)); ?></li>

              <!-- SUBMENU ICON  -->           
              <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <!-- SUBMENU ICON  --> 

            </DIV>
          </div>
        </div>
      </div>
      <!-- Page -->
      <?php if(active(session('locale').'/lm/objectives_c')): ?>
      <?php echo $__env->yieldContent('content'); ?>
      <?php else: ?>
      <div class="page">
        <div class="page-content container-fluid">

          <?php echo $__env->yieldContent('content'); ?>


        </div>
      </div>
      <?php endif; ?>
      <!-- End Page -->
      <!-- Footer -->
      <footer class="site-footer">
        <div class="site-footer-legal">© 2016 <a href="http://www.snapnet.com.ng">Snapnet Nigeria</a></div>
        <div class="site-footer-right">
          Developed By  <a href="http://www.snapnet.com.ng">Snapnet Nigeria</a>
        </div>
      </footer>
      <!-- Core  -->
      <script src="<?php echo e(asset('global/vendor/babel-external-helpers/babel-external-helpers.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/jquery/jquery.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/tether/tether.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/bootstrap/bootstrap.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/animsition/animsition.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/mousewheel/jquery.mousewheel.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/asscrollbar/jquery-asScrollbar.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/asscrollable/jquery-asScrollable.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/ashoverscroll/jquery-asHoverScroll.js')); ?>"></script>
      <!-- Plugins -->
      <script src="<?php echo e(asset('global/vendor/switchery/switchery.min.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/intro-js/intro.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/screenfull/screenfull.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/slidepanel/jquery-slidePanel.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/skycons/skycons.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/sweetalert.min.js')); ?>"></script>
  <!--<script src="<?php echo e(asset('global/vendor/chartist/chartist.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js')); ?>"></script>-->
  <script src="<?php echo e(asset('global/vendor/aspieprogress/jquery-asPieProgress.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/jvectormap/jquery-jvectormap.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/jvectormap/maps/jquery-jvectormap-au-mill-en.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/matchheight/jquery.matchHeight-min.js')); ?>"></script>
  <!-- Scripts -->
  <script src="<?php echo e(asset('global/js/State.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Component.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Base.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Config.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/Section/Menubar.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/Section/GridMenu.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/Section/Sidebar.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/Section/PageAside.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/Plugin/menu.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/config/colors.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/config/tour.js')); ?>"></script>
  <script>
    Config.set('assets', 'assets');
  </script>
  <!-- Page -->
  <script src="<?php echo e(asset('assets/js/Site.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/asscrollable.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/slidepanel.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/switchery.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/matchheight.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/dropify.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/jvectormap.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/examples/js/dashboard/v1.js')); ?>"></script>
  <script>
 function setfy(){

	  var year=document.getElementById('fiscalyear').value;
	  $.get('<?php echo e(url('setfy')); ?>/'+year,function(data,status,xhr){
		
		if(xhr.status==200){
			window.location.reload();
		}
	});	
		
	  
  }
    function logout(){
      var token=$('#logout').val();
      $.post('<?php echo e(url('logout')); ?>',{_token:token }, function(data,status,xhr){
       window.location.reload();

     });
    }

  </script>

  <?php if(active(session('locale').'/employee/objective')): ?>
  <script type="text/javascript" src="<?php echo e(asset('assets/js/App/Documents.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/jquery-appear/jquery.appear.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/jquery-appear.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/loading-button.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/more-button.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/ladda/spin.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/ladda/ladda.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/ladda.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/peity.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/examples/js/tables/jqtabledit.js')); ?>"></script>
  <?php elseif(active(session('locale').'/lm/objectives_c')): ?>
  <script src="<?php echo e(asset('global/js/Plugin/tablesaw.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/sticky-header.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/action-btn.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/asselectable.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/editlist.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/aspaginator.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/animate-list.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/jquery-placeholder.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/material.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/selectable.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/bootbox.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/BaseApp.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/App/Contacts.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/examples/js/apps/contacts.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/toastr/toastr.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/toastr.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/lmemps.js')); ?>"></script>
  <?php elseif(active(['lm/objectives_a'])): ?>
  <script src="<?php echo e(asset('global/vendor/editable-table/mindmup-editabletable.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/editable-table/numeric-input-example.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/editable-table.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/examples/js/tables/editable.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/summernote/summernote.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/summernote.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/examples/js/forms/editor-summernote.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/select2/select2.full.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/select2.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/jquery-appear/jquery.appear.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/jquery-appear.js')); ?>"></script>
  <style type="text/css">
    .hide {
      display: none;
    }
  </style>
  <?php elseif(active(session('locale').'/lm/rate')): ?>
  <script src="<?php echo e(asset('global/vendor/select2/select2.full.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/select2.js')); ?>"></script>
   <script src="<?php echo e(asset('assets/js/nprogress.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/sweetalert.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/raphael/raphael-min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/morris/morris.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/examples/js/charts/morris.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/raty/jquery.raty.js')); ?>"></script>
  <!--<script src="<?php echo e(asset('global/js/Plugin/raty.js')); ?>"></script>-->
  <script src="<?php echo e(asset('assets/js/myrate.js')); ?>"></script>
   <?php endif; ?>
   <script src="<?php echo e(asset('js/pace.js')); ?>"></script>
 
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