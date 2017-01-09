@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Login V2 | Remark Admin Template</title>
   <link rel="apple-touch-icon" href="/assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="/assets/images/favicon.ico">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="/global/css/bootstrap.min.css">
  <link rel="stylesheet" href="/global/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="/assets/css/site.min.css">
  <!-- Plugins -->
  <link rel="stylesheet" href="/global/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="/global/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="/global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="/global/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="/global/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="/global/vendor/flag-icon-css/flag-icon.css">
  <link rel="stylesheet" href="/assets/examples/css/pages/forgot-password.css">
  <!-- Fonts -->
  <link rel="stylesheet" href="/global/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
   <!--[if lt IE 9]>
    <script src="/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="/global/vendor/media-match/media.match.min.js"></script>
    <script src="/global/vendor/respond/respond.min.js"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="/global/vendor/breakpoints/breakpoints.js"></script>
  <script>
  Breakpoints();
  </script>
</head>
<body class="animsition page-forgot-password layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page vertical-align text-xs-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle">
      <h2>Reset Password</h2>
     
      <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}
						 <input type="hidden" name="token" value="{{ $token }}">

             	    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <input type="email" class="form-control" id="inputEmail" name="email" value="{{ $email or old('email') }}"  placeholder="Your Email" required>
								@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
		</div>   
	    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <input type="email" class="form-control" id="inputEmail" name="email"   placeholder="Your Email" required>
         @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
		</div>   
	    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

         @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
		</div>   					
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Reset Your Password</button>
        </div>
      </form>
      <footer class="page-copyright">
        <p>WEBSITE BY amazingSurge</p>
        <p>© 2016. All RIGHT RESERVED.</p>
        <div class="social">
          <a href="javascript:void(0)">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-dribbble" aria-hidden="true"></i>
          </a>
        </div>
      </footer>
    </div>
  </div>
  <!-- End Page -->
  <!-- Core  -->
 <script src="/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
  <script src="/global/vendor/jquery/jquery.js"></script>
  <script src="/global/vendor/tether/tether.js"></script>
  <script src="/global/vendor/bootstrap/bootstrap.js"></script>
  <script src="/global/vendor/animsition/animsition.js"></script>
  <script src="/global/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
  <script src="/global/vendor/asscrollable/jquery-asScrollable.js"></script>
  <script src="/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
  <!-- Plugins -->
  <script src="/global/vendor/switchery/switchery.min.js"></script>
  <script src="/global/vendor/intro-js/intro.js"></script>
  <script src="/global/vendor/screenfull/screenfull.js"></script>
  <script src="/global/vendor/slidepanel/jquery-slidePanel.js"></script>
  <script src="/global/vendor/jquery-placeholder/jquery.placeholder.js"></script>
  <!-- Scripts -->
  <script src="/global/js/State.js"></script>
  <script src="/global/js/Component.js"></script>
  <script src="/global/js/Plugin.js"></script>
  <script src="/global/js/Base.js"></script>
  <script src="/global/js/Config.js"></script>
  <script src="/assets/js/Section/Menubar.js"></script>
  <script src="/assets/js/Section/Sidebar.js"></script>
  <script src="/assets/js/Section/PageAside.js"></script>
  <script src="/assets/js/Plugin/menu.js"></script>
  <!-- Config -->
  <script src="/global/js/config/colors.js"></script>
  <script src="/assets/js/config/tour.js"></script>
  <script>
  Config.set('assets', '/assets');
  </script>
  <!-- Page -->
  <script src="/assets/js/Site.js"></script>
  <script src="/global/js/Plugin/asscrollable.js"></script>
  <script src="/global/js/Plugin/slidepanel.js"></script>
  <script src="/global/js/Plugin/switchery.js"></script>
  <script src="/global/js/Plugin/jquery-placeholder.js"></script>
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
</body>
</html>

