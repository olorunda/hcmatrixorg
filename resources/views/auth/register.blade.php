<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>HCMatrix | Register </title>
  <link rel="apple-touch-icon" href="{{asset('assets/images/apple-touch-icon.png')}}">
  <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{asset('global/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('global/css/bootstrap-extend.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/site.min.css')}}">
  <!-- Plugins -->
  <link rel="stylesheet" href="{{asset('global/vendor/animsition/animsition.css')}}">
  <link rel="stylesheet" href="{{asset('global/vendor/asscrollable/asScrollable.css')}}">
  <link rel="stylesheet" href="{{asset('global/vendor/switchery/switchery.css')}}">
  <link rel="stylesheet" href="{{asset('global/vendor/intro-js/introjs.css')}}">
  <link rel="stylesheet" href="{{asset('global/vendor/slidepanel/slidePanel.css')}}">
  <link rel="stylesheet" href="{{asset('global/vendor/flag-icon-css/flag-icon.css')}}">
  <link rel="stylesheet" href="{{asset('assets/examples/css/pages/login-v2.css')}}">
  <!-- Fonts -->
  <link rel="stylesheet" href="{{asset('global/fonts/web-icons/web-icons.min.css')}}">
  <link rel="stylesheet" href="{{asset('global/fonts/brand-icons/brand-icons.min.css')}}">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
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
  </head>
  <body class="animsition page-login-v2 layout-full page-dark">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Page -->
        <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
          <div class="page-content">
            <div class="page-brand-info">
              <div class="brand">
                <img class="brand-img" src="{{asset('assets/images/logo@2x.png')}}" alt="...">
                <h2 class="brand-text font-size-40"></h2>
              </div>
              <p class="font-size-20">RECRUIT, RETAIN, REWARD</p>
            </div>
            <div class="page-login-main animation-slide-right animation-duration-1" style="background-color: hsla(255, 0%, 0%, 0.4); color: white;">
              <div class="brand hidden-md-up">
                <img class="brand-img" src="{{asset('assets/images/logo-blue@2x.png')}}" alt="...">
                <h3 class="brand-text font-size-40"></h3>
              </div>
              <h3 class="font-size-24" style="color: white;">Create A New Account</h3>
              <p>Create a private HCMatrix Account</p>
              <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label class="sr-only" for="inputName">Full Name</label>
                  <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">

                  @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="sr-only" for="inputEmail">Email</label>
                  <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email') }}" placeholder="Email">
                  @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label class="sr-only" for="inputPassword">Password</label>
                  <input type="password" class="form-control" id="inputPassword" name="password"
                  placeholder="Password">
                  @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="form-group">
                  <label class="sr-only" for="inputPasswordCheck">Retype Password</label>
                  <input type="password" class="form-control" id="inputPasswordCheck" name="password_confirmation"
                  placeholder="Confirm Password">
                </div>
                <div class="form-group clearfix">
                  <div class="checkbox-custom checkbox-inline checkbox-primary pull-xs-left">
                    <input type="checkbox" id="inputCheckbox" name="term" required="required">
                    <label for="inputCheckbox">By clicking Sign Up, you agree to our <a href="#">Terms</a>.</label>
                  </div>
                  <p class="m-l-40"></p>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
              </form>
              <p>Have account already? Please go to <a href="login">Sign In</a></p>
              <footer class="page-copyright" style="color: white;">
                <p style="display: none;">WEBSITE BY amazingSurge</p>
                <p style="color: white;">&copy; {{ date('Y') }}. All RIGHT RESERVED.</p>
                <div class="social">
                  <a class="btn btn-icon btn-round social-twitter" href="javascript:void(0)">
                    <i class="icon bd-twitter" aria-hidden="true"></i>
                  </a>
                  <a class="btn btn-icon btn-round social-facebook" href="javascript:void(0)">
                    <i class="icon bd-facebook" aria-hidden="true"></i>
                  </a>
                  <a class="btn btn-icon btn-round social-google-plus" href="javascript:void(0)">
                    <i class="icon bd-google-plus" aria-hidden="true"></i>
                  </a>
                  <a href="javascript:void(0)" class="btn btn-icon btn-round">
                    <img class="img-circle" src="{{asset('assets/images/office.png')}}" style="width: 36px;height: 36px;margin-left: -20px;">
                  </a>
                </div>
              </footer>
            </div>
          </div>
        </div>
        <!-- End Page -->
        <!-- Core  -->
        <script src="{{asset('global/vendor/babel-external-helpers/babel-external-helpers.js')}}"></script>
        <script src="{{asset('global/vendor/jquery/jquery.js')}}"></script>
        <script src="{{asset('global/vendor/tether/tether.js')}}"></script>
        <script src="{{asset('global/vendor/bootstrap/bootstrap.js')}}"></script>
        <script src="{{asset('global/vendor/animsition/animsition.js')}}"></script>
        <script src="{{asset('global/vendor/mousewheel/jquery.mousewheel.js')}}"></script>
        <script src="{{asset('global/vendor/asscrollbar/jquery-asScrollbar.js')}}"></script>
        <script src="{{asset('global/vendor/asscrollable/jquery-asScrollable.js')}}"></script>
        <script src="{{asset('global/vendor/ashoverscroll/jquery-asHoverScroll.js')}}"></script>
        <!-- Plugins -->
        <script src="{{asset('global/vendor/switchery/switchery.min.js')}}"></script>
        <script src="{{asset('global/vendor/intro-js/intro.js')}}"></script>
        <script src="{{asset('global/vendor/screenfull/screenfull.js')}}"></script>
        <script src="{{asset('global/vendor/slidepanel/jquery-slidePanel.js')}}"></script>
        <script src="{{asset('global/vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>
        <!-- Scripts -->
        <script src="{{asset('global/js/State.js')}}"></script>
        <script src="{{asset('global/js/Component.js')}}"></script>
        <script src="{{asset('global/js/Plugin.js')}}"></script>
        <script src="{{asset('global/js/Base.js')}}"></script>
        <script src="{{asset('global/js/Config.js')}}"></script>
        <script src="{{asset('assets/js/Section/Menubar.js')}}"></script>
        <script src="{{asset('assets/js/Section/GridMenu.js')}}"></script>
        <script src="{{asset('assets/js/Section/Sidebar.js')}}"></script>
        <script src="{{asset('assets/js/Section/PageAside.js')}}"></script>
        <script src="{{asset('assets/js/Plugin/menu.js')}}"></script>
        <script src="{{asset('global/js/config/colors.js')}}"></script>
        <script src="{{asset('assets/js/config/tour.js')}}"></script>
        <script>
          Config.set('assets', '{{asset('assets')}}';
        </script>
        <!-- Page -->
        <script src="{{asset('assets/js/Site.js')}}"></script>
        <script src="{{asset('global/js/Plugin/asscrollable.js')}}"></script>
        <script src="{{asset('global/js/Plugin/slidepanel.js')}}"></script>
        <script src="{{asset('global/js/Plugin/switchery.js')}}"></script>
        <script src="{{asset('global/js/Plugin/jquery-placeholder.js')}}"></script>
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