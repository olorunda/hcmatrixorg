<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title>HCMatrix</title>
  <link rel="apple-touch-icon" href="<?php echo e(asset('assets/images/apple-touch-icon.png')); ?>">
  <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.ico')); ?>">
  <!-- Stylesheets -->
  <link type="text/css" rel="stylesheet" href="<?php echo e(asset('assets/css/dropzone.min.css')); ?>">
  
  <link rel="stylesheet" href="<?php echo e(asset('global/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/TimeCircles.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/css/bootstrap-extend.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/site.min.css')); ?>">
   <link type="text/css" href="<?php echo e(asset('assets/css/pdfSlider.css')); ?>" rel="stylesheet"/>
   
  <script src="<?php echo e(asset('assets/getorgchart/getorgchart.js')); ?>"></script>
   <link type="text/css" href="<?php echo e(asset('assets/getorgchart/getorgchart.css')); ?>" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/clockpicker/clockpicker.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('global/vendor/jt-timepicker/jquery-timepicker.css')); ?>">
	   <link rel="stylesheet" href="<?php echo e(asset('global/vendor/bootstrap-datepicker/bootstrap-datepicker.css')); ?>">
	   
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/documents.css')); ?>">
   <link rel="stylesheet" href="<?php echo e(asset('global/vendor/tablesaw/tablesaw.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/nprogress.css')); ?>">
 <?php if(active(session('locale').'/employee/profile_*')): ?>
	   <link rel="stylesheet" href="<?php echo e(asset('global/vendor/datatables-bootstrap/dataTables.bootstrap.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/datatables-fixedheader/dataTables.fixedHeader.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/datatables-responsive/dataTables.responsive.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/tables/datatable.css')); ?>">
   <?php endif; ?>
   
 
  <!-- Plugins -->
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/multi-select/multi-select.css')); ?>">
   <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/uikit/modals.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/animsition/animsition.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/asscrollable/asScrollable.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/switchery/switchery.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/intro-js/introjs.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/slidepanel/slidePanel.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/flag-icon-css/flag-icon.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/dashboard/v1.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/sweetalert.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/font-awesome.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/typeaheadjs.css')); ?>">
   
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/ionrangeslider/ionrangeslider.min.css')); ?>">  
  
  <link rel="stylesheet" href="<?php echo e(asset('global/css/raty.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/bootstrap-markdown/bootstrap-markdown.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/dropify/dropify.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/chartist/chartist.css')); ?>">
 
  <link href="<?php echo e(asset('global/vendor/select2/select2.css')); ?>" rel="stylesheet" >
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/sweetalert.css')); ?>">
  <link href="<?php echo e(asset('assets/css/jquery.contextMenu.min.css')); ?>" rel="stylesheet" type="text/css" />

    
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/jvectormap/jquery-jvectormap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/morris/morris.css')); ?>">
	 <link rel="stylesheet" href="<?php echo e(asset('global/vendor/magnific-popup/magnific-popup.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/advanced/lightbox.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/dashboard/v1.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/ladda/ladda.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/uikit/buttons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/fonts/font-awesome/font-awesome.css')); ?>">
	<link rel="stylesheet" type="text/css')}}" href="<?php echo e(asset('assets/css/sweetalert.css')); ?>">
	  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/bootstrap-markdown/bootstrap-markdown.css')); ?>">
	   <script src="<?php echo e(asset('assets/js/sweetalert.min.js')); ?>"></script>
	   
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/toastr/toastr.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/advanced/toastr.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/fullcalendar.min.css')); ?>">
	     <?php if(active(session('locale').'/manage/*') || active(session('locale').'/leave') || active(session('locale').'/sort/*') || active(session('locale').'/search')): ?>
	 
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/tablesaw/tablesaw.css')); ?>">
 
  <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/apps/contacts.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/objectives.css')); ?>">
  
	  <?php endif; ?>
  <!-- Fonts -->
  <link rel="stylesheet" href="<?php echo e(asset('global/fonts/weather-icons/weather-icons.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/fonts/web-icons/web-icons.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/fonts/brand-icons/brand-icons.min.css')); ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">
   <?php if(active(session('locale').'/employee/objective')): ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/documents.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/ladda/ladda.css')); ?>">
  <?php elseif(active(session('locale').'/lm/objectives_c')): ?>
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/tablesaw/tablesaw.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/apps/contacts.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/objectives.css')); ?>">
  <?php elseif(active(['lm/objectives_a'])): ?>
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/editable-table/editable-table.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/summernote/summernote.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/select2/select2.css')); ?>">
  <style type="text/css">
        .hide {
          display: none;
        }
      </style>
  <?php elseif(active(session('locale').'/lm/rate')): ?>
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/select2/select2.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/morris/morris.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/advanced/rating.css')); ?>">
  <style type="text/css')}}">
    textarea {
      resize: none;
    }
	.modal { position: absolute; } 
  </style>
  
  <?php elseif(active(session('locale').'/lm/goals')): ?>
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/summernote/summernote.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/select2/select2.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/webui-popover/webui-popover.css')); ?>">
  <style type="text/css')}}">
    textarea {
      resize: none;
      height: 100px;
    }
  </style>
  <?php elseif(active(session('locale').'/employee/absence') || active(session('locale').'/manage/*')): ?>
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/select2/select2.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/chartist/chartist.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/aspieprogress/asPieProgress.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/dashboard/ecommerce.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/bootstrap-datepicker/bootstrap-datepicker.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/dropify/dropify.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('global/vendor/toastr/toastr.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/advanced/toastr.css')); ?>">
  <style type="text/css">
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
  </style>
  <?php endif; ?>

  <style>
  <?php if(active(session('locale').'/view/attendancecalender')): ?>
  .fc-content{
	  
	  background-color:#53a26c;
	  background-color:rgba(7, 122, 59, 0.72);
  }
  .fc-title{
	  
	 color:white; 
  }
  .fc-unthemed .fc-divider, .fc-unthemed .fc-list-heading td, .fc-unthemed .fc-popover .fc-header {
    background: #10663a;

}
 
 .fc-list-heading-alt,.fc-list-heading-main{
	color:white; 
 }
  <?php endif; ?>
  
  <?php if(active(session('locale').'/view/docadmin')|| active(session('locale').'/view/mydocument')): ?>
  div.raspberry {
    float: left;
    margin: 2px;
}
#ctxMenu{
    display:none;
    z-index:100;
}
menu {
    position:absolute;
    display:block;
    left:0px;
    top:0px;
    height:20px;
    width:20px;
    padding:0;
    margin:0;
    border:1px solid;
    background-color:white;
    font-weight:normal;
    white-space:nowrap;
}
menu:hover{
    background-color:#eef;
    font-weight:bold;
}
menu:hover > menu{
    display:block;
}
menu > menu{
    display:none;
    position:relative;
    top:-20px;
    left:100%;
    width:55px;
}
menu[title]:before{
    content:attr(title);
}
menu:not([title]):before{
    content:"\2630";
}
div p {
    text-align: center;
}
<?php endif; ?>
  .page-header{
	 
<?php if(active(session('locale').'/applicant/job')): ?>
<?php else: ?>	
	  margin-top: <?php if(active(session('locale').'/employee/list')): ?> -25px <?php elseif(active(session('locale').'/manage/*')||active(session('locale').'/leave') ||active(session('locale').'/lm/*')|| active(session('locale').'/search')): ?>  <?php else: ?> -40px; <?php endif; ?> <?php endif; ?>
  }
  .pdfSlider_close{
	  
	  display:none;
  }
  .pdfSlider_next{
	  
	  z-index:9999999;
  }
  .popover{
	  z-index:99999999;
  }
  .select2-container--open{
        z-index:9999999;        
    }
  .hide{
	  
	  display:none;
  }
  #my-dropzone-files{
	background-image:url('<?php echo e(url('upload/picture.png')); ?>'); background-repeat:no-repeat; background-position:center;
}
.zoom {
  max-width: 600px; 
  overflow: hidden;
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
.jsZoomTouch:after {
  content: 'Pinch to Zoom';
  position: absolute;
  top: 0;
  right: 0;
}<br type="_moz">

  </style>

 
  <!--[if lt IE 9]>
    <script src="<?php echo e(asset('global/vendor/html5shiv/html5shiv.min.js')); ?>"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="<?php echo e(asset('global/vendor/media-match/media.match.min.js')); ?>"></script>
    <script src="<?php echo e(asset('global/vendor/respond/respond.min.js')); ?>"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="<?php echo e(asset('global/vendor/breakpoints/breakpoints.js')); ?>"></script>
  <script>
  
  Breakpoints();

  
 
 
  function setfy(){

	  var year=document.getElementById('fiscalyear').value;
	  $.get('<?php echo e(url('setfy')); ?>/'+year, function(data,status,xhr){
		
		if(xhr.status==200){
			
			 
			window.location.reload();
			 
		}
	});	
		
	  
  }

  function logout(){
	
    
	  $.get('<?php echo e(url('logout')); ?>', function(data,status,xhr){
		  
		//  console.log(data);
		  
			  window.location.reload();
		
	  });
  }

 

  </script>
 
  <style>
  .menuborder{
	 #  border-bottom: 2px groove rgb(24, 61, 80);
  } 
  body{
	  font-family:helvetica;
  }
  </style>
  <?php if(active(session('locale').'/job/*')): ?>
<link rel="stylesheet" href="<?php echo e(asset('global/vendor/select2/select2.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/structure/ribbon.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.min.css')); ?>">
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
</style>
<link rel="stylesheet" href="<?php echo e(asset('global/vendor/formvalidation/formValidation.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/forms/validation.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('global/vendor/bootstrap-datepicker/bootstrap-datepicker.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/examples/css/advanced/animation.css')); ?>">
<?php endif; ?>
   <script src="<?php echo e(asset('global/vendor/jquery/jquery.js')); ?>"></script>
<script>
 $(function(){
 
	 <?php if(active(session('locale').'/lm/rate')): ?>
		 <?php else: ?>
	
	 $(document).ajaxStart(function(){
		 $.LoadingOverlay("show",{
			 image       : "",
			fontawesome : "fa fa-spinner fa-spin"
			 
		 });
		NProgress.start();
	     
	}).ajaxStop(function(){
		
		$.LoadingOverlay("hide", true);
		NProgress.done();
		 
	});
	
	 <?php endif; ?>
	
    $.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
        var token = $('meta[name="csrf-token"]').attr('content'); // or _token, whichever you are using

        if (token) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
        }
    });
	 
 }); 

</script>
</head>
<?php if(active(session('locale').'/manage/absence') || active(session('locale').'/leave') || active(session('locale').'/sort/*') || active(session('locale').'/search')|| active(session('locale').'/applicant/*')): ?>
	<body class="animsition app-contacts page-aside-left site-menubar-fold"   >
<?php elseif(active(session('locale').'/lm/query')|| active(session('locale').'/lm/querytype/*') || active(session('locale').'/employee/list')|| active(session('locale').'/employee/linemanager')): ?>
<body class="animsition app-forum page-aside-left site-menubar-fold" style="animation-duration: 800ms; opacity: 1;">
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
        <img class="navbar-brand-logo" src="<?php echo e(asset('assets/images/logo.png')); ?>" title="HCMatrix">
        <span class="navbar-brand-text hidden-xs-down"> HCMatrix</span>
      </div>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
      data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon wb-search" aria-hidden="true"></i>
      </button>
    </div>
    <div  class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div  class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
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
              <span class="sr-only"><?php echo e(_t('Toggle Search')); ?></span>
            </a>
          </li>
        </ul>
        <!-- End Navbar Toolbar -->
        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
          <li class="nav-item hidden-float" style="margin-top:15px;">
            <select class="form-control " id="fiscalyear" onchange="setfy()"> 
             <option  >- <?php echo e(_t('Fiscal Year')); ?> -</option>

            
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
                <img src="<?php echo e(asset('global/portraits/5.jpg')); ?>" alt="..">
                <i></i>
              </span>
            </a>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="<?php echo e(url('employee/profile')); ?>" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> <?php echo e(_t('Profile')); ?></a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> <?php echo e(_t('Settings')); ?></a>
              <div class="dropdown-divider" role="presentation"></div>
              <a class="dropdown-item" href="<?php echo e(url('logout')); ?>" role="menuitem" ><i class="icon wb-power" aria-hidden="true"></i> <?php echo e(_t('Logout')); ?></a>
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
              <input type="text" class="form-control" name="site-search" placeholder="Search..">
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
            <li class="site-menu-category"><?php echo e(_t('Welcome :name',['name'=>Auth::user()->name])); ?></li>
			
			<!-- SUBMENU ICON  -->           
		 <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<!-- SUBMENU ICON  --> 
			
         </DIV>
      </div>
    </div>
  </div>
  
  <!-- Page -->
<?php if(active(session('locale').'/manage/absence') || active(session('locale').'/leave') || active(session('locale').'/sort/*') || active(session('locale').'/search')|| active(session('locale').'/applicant/*') || active(session('locale').'/lm/query')||active(session('locale').'/lm/querytype/*') || active(session('locale').'/employee/list')||active(session('locale').'/employee/linemanager')): ?>
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
    <div class="site-footer-legal">© 2016 <a href="http://www.snapnet.com.ng">Snapnet Limited</a></div>
    <div class="site-footer-right">
	<?php echo e(_t('Developed By ')); ?> <a href="http://www.snapnet.com.ng">Snapnet Limited</a>
    </div>
  </footer>
  <!-- Core  -->
  <script src="<?php echo e(asset('global/vendor/babel-external-helpers/babel-external-helpers.js')); ?>"></script>
 

  <script src="<?php echo e(asset('global/vendor/tether/tether.js')); ?>"></script>
   <?php if(active(session('locale').'/employee/absence') || active(session('locale').'/manage/*') || active(session('locale').'/applicant/*')): ?>
		<?php if(active(session('locale').'/manage/absence')): ?>
	 <script src="<?php echo e(asset('global/vendor/bootstrap/bootstrap.js')); ?>"></script>
 
	<?php endif; ?>
	   <?php else: ?>
  <script src="<?php echo e(asset('global/vendor/bootstrap/bootstrap.js')); ?>"></script>
  <?php endif; ?>
  <?php if(active(session('locale').'/manage/leavestat') || active(session('locale').'/manage/positions')): ?>
	    <script src="<?php echo e(asset('global/vendor/bootstrap/bootstrap.js')); ?>"></script>
 
	<?php endif; ?>

  <script src="<?php echo e(asset('global/vendor/animsition/animsition.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/mousewheel/jquery.mousewheel.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/asscrollbar/jquery-asScrollbar.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/asscrollable/jquery-asScrollable.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/ashoverscroll/jquery-asHoverScroll.js')); ?>"></script>
  <!-- Plugins -->
  <script src="<?php echo e(asset('global/vendor/switchery/switchery.min.js')); ?>"></script>
  <!--<script src="<?php echo e(asset('global/js/Plugin/jquery-appear.min.js')); ?>"></script>-->
  <script src="<?php echo e(asset('global/vendor/intro-js/intro.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/screenfull/screenfull.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/slidepanel/jquery-slidePanel.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/skycons/skycons.js')); ?>"></script>
  <!--<script src="<?php echo e(asset('global/vendor/chartist/chartist.min.js')); ?>"></script>-->
  <script src="<?php echo e(asset('global/vendor/raphael/raphael-min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/morris/morris.min.js')); ?>"></script>
  <!--<script src="<?php echo e(asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js')); ?>"></script>-->
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
    <script src="<?php echo e(asset('global/vendor/ladda/spin.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/ladda/ladda.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/switchery/switchery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/intro-js/intro.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/screenfull/screenfull.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/slidepanel/jquery-slidePanel.js')); ?>"></script>
  <script>
  Config.set('assets', 'assets');
  </script>
  <!-- Page -->
  <script src="<?php echo e(asset('assets/js/Site.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/asscrollable.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/slidepanel.js')); ?>"></script>
   <script src="<?php echo e(asset('global/vendor/marked/marked.js')); ?>"></script>
   <script src="<?php echo e(asset('global/vendor/bootstrap-markdown/bootstrap-markdown.js')); ?>"></script>
   
  <script src="<?php echo e(asset('assets/examples/js/advanced/lightbox.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/to-markdown/to-markdown.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/switchery.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/matchheight.js')); ?>"></script>
    <script src="<?php echo e(asset('global/vendor/ionrangeslider/ion.rangeSlider.min.js')); ?>"></script>
	
  <script src="<?php echo e(asset('global/js/Plugin/ionrangeslider.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/dropify.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/jvectormap.js')); ?>"></script>
    <script src="<?php echo e(asset('global/js/Plugin/loading-button.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/more-button.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/ladda.js')); ?>"></script>
    <script src="<?php echo e(asset('global/js/Plugin/slidepanel.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/switchery.js')); ?>"></script>
  
  <script src="<?php echo e(asset('global/js/Plugin/toastr.js')); ?>"></script>
    <script src="<?php echo e(asset('global/vendor/toastr/toastr.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/examples/js/dashboard/v1.js')); ?>"></script>
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
  <?php elseif(active(session('locale').'/lm/objectives_c')||active(session('locale').'/employee/*')): ?>
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
     <script src="<?php echo e(asset('assets/js/sweetalert.min.js')); ?>"></script>
 
  <script src="<?php echo e(asset('global/js/Plugin/jquery-appear.js')); ?>"></script>
 
  <?php elseif(active(session('locale').'/lm/rate')): ?>
  <script src="<?php echo e(asset('global/vendor/select2/select2.full.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/select2.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/sweetalert.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/raphael/raphael-min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/morris/morris.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/examples/js/charts/morris.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/raty/jquery.raty.js')); ?>"></script>
  <!--<script src="<?php echo e(asset('global/js/Plugin/raty.js')); ?>"></script>-->
  <script src="<?php echo e(asset('assets/js/myrate.js')); ?>"></script>
    <?php elseif(active(session('locale').'/job/*')): ?>
      <script src="<?php echo e(asset('global/vendor/select2/select2.full.min.js')); ?>"></script>
      <script src="<?php echo e(asset('global/js/Plugin/select2.js')); ?>"></script>
      <script type="text/javascript">
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
      </script>
      <script src="<?php echo e(asset('global/vendor/jquery-appear/jquery.appear.js')); ?>"></script>
      <script src="<?php echo e(asset('global/js/Plugin/jquery-appear.js')); ?>"></script>
      <script src="<?php echo e(asset('global/js/Plugin/material.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/formvalidation/formValidation.min.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/formvalidation/framework/bootstrap4.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/examples/js/forms/validation.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/bootstrap-datepicker/bootstrap-datepicker.js')); ?>"></script>
      <script src="<?php echo e(asset('global/js/Plugin/bootstrap-datepicker.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/dropzone.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/examples/js/advanced/animation.js')); ?>"></script>
      <script src="<?php echo e(asset('global/js/Plugin/panel.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/examples/js/uikit/panel-actions.js')); ?>"></script>
      
  <?php elseif(active(session('locale').'/lm/goals')): ?>
  <script src="<?php echo e(asset('assets/js/Site.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/asscrollable.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/slidepanel.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/switchery.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/select2/select2.full.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/select2.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/webui-popover/jquery.webui-popover.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/webui-popover.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/data.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/summernote/summernote.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/summernote.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/examples/js/forms/editor-summernote.js')); ?>"></script>
  <?php endif; ?>
 <?php if(active(session('locale').'/manage/absence') || active(session('locale').'/leave') || active(session('locale').'/sort/*') || active(session('locale').'/search')|| active(session('locale').'/applicant/*')): ?>


  <?php endif; ?>
  
  <?php if(active(session('locale').'/manage/*')  || active(session('locale').'/sort/*') ): ?>

<?php if(active(session('locale').'/manage/absence') || active(session('locale').'/leave') || active(session('locale').'/search')): ?>
	<?php else: ?>
  <script src="<?php echo e(asset('assets/js/Site.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/asscrollable.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/slidepanel.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/switchery.js')); ?>"></script>
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
  <script src="<?php echo e(asset('global/js/jqextendputdelete.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/BaseApp.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/App/Contacts.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/examples/js/apps/contacts.js')); ?>"></script>
  <?php endif; ?>
  <?php endif; ?>
 <?php if(active(session('locale').'/employee/absence') || active(session('locale').'/manage/*') || active(session('locale').'/applicant/*')): ?>
	 
 <?php if( active(session('locale').'/manage/*') ): ?>
	 <?php else: ?>
      <script src="<?php echo e(asset('global/vendor/bootstrap/bootstrap.js')); ?>"></script>
  <?php endif; ?>
      <script src="<?php echo e(asset('global/vendor/select2/select2.full.min.js')); ?>"></script>
      <script src="<?php echo e(asset('global/js/Plugin/select2.js')); ?>"></script>
      <script src="<?php echo e(asset('global/js/Plugin/aspieprogress.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/examples/js/dashboard/ecommerce.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/bootstrap-datepicker/bootstrap-datepicker.js')); ?>"></script>
	  
      <script src="<?php echo e(asset('global/js/Plugin/bootstrap-datepicker.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/dropify/dropify.min.js')); ?>"></script>
      <script src="<?php echo e(asset('global/js/Plugin/dropify.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/dropzone.min.js')); ?>"></script>
      <script src="<?php echo e(asset('global/vendor/toastr/toastr.js')); ?>"></script>
      <script src="<?php echo e(asset('global/js/Plugin/toastr.js')); ?>"></script>
      

     <?php endif; ?>
	 
	 <script type="text/javascript" src="<?php echo e(asset('assets/js/dropzone.min.js')); ?>"></script>
	   <script src="<?php echo e(asset('global/vendor/multi-select/jquery.multi-select.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/select2/select2.full.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/js/Plugin/select2.js')); ?>"></script>
  
  <script src="<?php echo e(asset('global/vendor/multi-select/jquery.multi-select.js')); ?>"></script>
   <script src="<?php echo e(asset('global/vendor/tablesaw/tablesaw.jquery.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/TimeCircles.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/pdfSlider.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/jquery.thooClock.js')); ?>"></script>
             <script src="<?php echo e(asset('assets/js/jquery.contextMenu.min.js')); ?>" type="text/javascript"></script>

    <script src="<?php echo e(asset('assets/js/jquery.ui.position.min.js')); ?>" type="text/javascript"></script>
	 <?php if(active(session('locale').'/employee/profile_*')): ?>
  <script src="<?php echo e(asset('global/vendor/datatables/jquery.dataTables.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/datatables-fixedheader/dataTables.fixedHeader.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/datatables-bootstrap/dataTables.bootstrap.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/datatables-responsive/dataTables.responsive.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/datatables-tabletools/dataTables.tableTools.js')); ?>"></script>
  <?php endif; ?>
	<?php if(active(session('locale').'/manage/leavestat')): ?>
		  <script src="<?php echo e(asset('assets/examples/js/charts/morris.js')); ?>"></script>
	<?php endif; ?>
			      <script src="<?php echo e(asset('global/vendor/datepair/datepair.min.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/datepair/jquery.datepair.min.js')); ?>"></script>
    <script src="<?php echo e(asset('global/vendor/jt-timepicker/jquery.timepicker.min.js')); ?>"></script>
	  <script src="<?php echo e(asset('global/vendor/clockpicker/bootstrap-clockpicker.min.js')); ?>"></script>
	  <script src="<?php echo e(asset('global/js/Plugin/clockpicker.js')); ?>"></script>
  <script src="<?php echo e(asset('global/vendor/bootstrap-datepicker/bootstrap-datepicker.js')); ?>"></script>
	 <script src="<?php echo e(asset('global/js/Plugin/datepair.js')); ?>"></script>	 
	<script src="<?php echo e(asset('global/vendor/raty-js/jquery.raty.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/nprogress.js')); ?>"></script>
  <?php if(active(session('locale').'/project/*')): ?>
	  <script src="<?php echo e(asset('assets/js/bootstrap-typeahead.min.js')); ?>" type="text/javascript"></script>
  <?php endif; ?>
  <?php if(active(session('locale').'/lm/goals')): ?>
	  
  <?php else: ?>
  <script src="https://cdn.jsdelivr.net/jquery.loadingoverlay/latest/loadingoverlay.min.js"></script>	
<?php endif; ?> 
  <script src="<?php echo e(asset('global/vendor/moment/moment.min.js')); ?>"></script>
   <script src="<?php echo e(asset('global/vendor/fullcalendar/fullcalendar.js')); ?>"></script>
	
   
  	
</body>
</html>