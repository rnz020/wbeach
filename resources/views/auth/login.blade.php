<!DOCTYPE html>
<html>

<head>
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <title>AbsoluteAdmin - A Responsive Bootstrap 3 Admin Dashboard Template</title>
  <meta name="keywords" content="HTML5 Bootstrap 3 Admin Template UI Theme" />
  <meta name="description" content="AbsoluteAdmin - A Responsive HTML5 Admin UI Framework">
  <meta name="author" content="AbsoluteAdmin">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font CSS (Via CDN) -->
  <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>

  <!-- Theme CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/assets/skin/default_skin/css/theme.css') }}">

  <!-- Admin Forms CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/assets/admin-tools/admin-forms/css/admin-forms.min.css') }}">

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
   <![endif]-->
</head>

<style>
    h1{
        color:#fff;
        margin-top: 10px;
    font-size: 40px;
    font-weight: 700;

    line-height: 44px;
    }
    
     .description {
    margin: 20px 0 30px 0;
}
.medium-paragraph {
    font-size: 18px;
    line-height: 34px;
}

.description p {
    opacity: 0.8;
        color: #fff;
}
</style>

<body class="external-page sb-l-c sb-r-c">

  <!-- Start: Main -->
  <div id="main" class="animated fadeIn">

    <!-- Start: Content-Wrapper -->
    <section id="content_wrapper">

      <!-- begin canvas animation bg -->
      <div id="canvas-wrapper">
        <canvas id="demo-canvas"></canvas>
      </div>

      <!-- Begin: Content -->
      <section id="content">
          <div class="row"> 
    <div class="col-sm-6">
        <h1>Registrate!</h1>
        <div class="description">
							<p class="medium-paragraph">
								Por favor identificate para saber quien eres y que permisos tienes. It comes with a lot of new features. Check it out now!
							</p>
						</div>
    </div>  
    <div class="col-sm-6">
        <div class="admin-form theme-info" id="login1">

          <div class="row mb15 table-layout">

            <div class="col-xs-6 va-m pln">
              <a href="dashboard.html" title="Return to Dashboard">
                <img src="{{ asset('bower_components/assets/img/logos/logo_white.png') }}" title="AdminDesigns Logo" class="img-responsive w250">
              </a>
            </div>

            <div class="col-xs-6 text-right va-b pr5">
              <div class="login-links">
                <a href="{{ url('/login') }}" class="active" title="Sign In">Sign In</a>
                <span class="text-white"> | </span>
                <a href="{{ url('/register') }}" class="" title="Register">Register</a>
              </div>

            </div>

          </div>

          <div class="panel panel-info mt10 br-n">

            <div class="panel-heading heading-border bg-white">
              <span class="panel-title hidden">
                <i class="fa fa-sign-in"></i>Register</span>
<!--              <div class="section row mn">
                <div class="col-sm-4">
                  <a href="#" class="button btn-social facebook span-left mr5 btn-block">
                    <span>
                      <i class="fa fa-facebook"></i>
                    </span>Facebook</a>
                </div>
                <div class="col-sm-4">
                  <a href="#" class="button btn-social twitter span-left mr5 btn-block">
                    <span>
                      <i class="fa fa-twitter"></i>
                    </span>Twitter</a>
                </div>
                <div class="col-sm-4">
                  <a href="#" class="button btn-social googleplus span-left btn-block">
                    <span>
                      <i class="fa fa-google-plus"></i>
                    </span>Google+</a>
                </div>
              </div>-->
            </div>

            <!-- end .form-header section -->
            <form method="post" action="{{ url('/login') }}" id="contact">
                {{ csrf_field() }}
              <div class="panel-body bg-light p30">
                <div class="row">
                  <div class="col-sm-12 pr30">

<!--                    <div class="section row hidden">
                      <div class="col-md-4">
                        <a href="#" class="button btn-social facebook span-left mr5 btn-block">
                          <span>
                            <i class="fa fa-facebook"></i>
                          </span>Facebook</a>
                      </div>
                      <div class="col-md-4">
                        <a href="#" class="button btn-social twitter span-left mr5 btn-block">
                          <span>
                            <i class="fa fa-twitter"></i>
                          </span>Twitter</a>
                      </div>
                      <div class="col-md-4">
                        <a href="#" class="button btn-social googleplus span-left btn-block">
                          <span>
                            <i class="fa fa-google-plus"></i>
                          </span>Google+</a>
                      </div>
                    </div>-->

                    <div class="section {{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="username" class="field-label text-muted fs18 mb10">Username</label>
                      <label for="username" class="field prepend-icon">
                        <input type="emal" name="email" id="email" class="gui-input" placeholder="Enter username">
                        <label for="username" class="field-icon">
                          <i class="fa fa-user"></i>
                        </label>
                      </label>
                      @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <!-- end section -->
                    <div class="section {{ $errors->has('password') ? ' has-error' : '' }}" >
                      <label for="username" class="field-label text-muted fs18 mb10">Password</label>
                      <label for="password" class="field prepend-icon">
                          <input type="password" name="password" id="password" class="gui-input" required placeholder="Enter password">
                        <label for="password" class="field-icon">
                          <i class="fa fa-lock"></i>
                        </label>
                      </label>
                            @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                    </div>
                    <!-- end section -->

                  </div>
<!--                  <div class="col-sm-5 br-l br-grey pl30">
                    <h3 class="mb25"> You'll Have Access To Your:</h3>
                    <p class="mb15">
                      <span class="fa fa-check text-success pr5"></span> Unlimited Email Storage</p>
                    <p class="mb15">
                      <span class="fa fa-check text-success pr5"></span> Unlimited Photo Sharing/Storage</p>
                    <p class="mb15">
                      <span class="fa fa-check text-success pr5"></span> Unlimited Downloads</p>
                    <p class="mb15">
                      <span class="fa fa-check text-success pr5"></span> Unlimited Service Tickets</p>
                  </div>-->
                </div>
              </div>
              <!-- end .form-body section -->
              <div class="panel-footer clearfix p10 ph15">
                <button type="submit" class="button btn-primary mr10 pull-right">Sign In</button>
                <label class="switch ib switch-primary pull-left input-align mt10">
                  <input type="checkbox" name="remember" id="remember" checked>
                  <label for="remember" data-on="YES" data-off="NO"></label>
                  <span>Remember me</span>
                </label>
              </div>
              <!-- end .form-footer section -->
            </form>
          </div>
        </div>
    </div>
</div>
      </section>
      <!-- End: Content -->

    </section>
    <!-- End: Content-Wrapper -->

  </div>
  <!-- End: Main -->

  <!-- BEGIN: PAGE SCRIPTS -->

  <!-- jQuery -->
   <script type="text/javascript" src="{{ asset('bower_components/vendor/jquery/jquery-1.11.1.min.js') }}"></script>
   <script type="text/javascript" src="{{ asset('bower_components/vendor/jquery/jquery_ui/jquery-ui.min.js') }}"></script>

  <!-- CanvasBG Plugin(creates mousehover effect) -->
   <script type="text/javascript" src="{{ asset('bower_components/vendor/plugins/canvasbg/canvasbg.js') }}"></script>

  <!-- Theme Javascript -->
   <script type="text/javascript" src="{{ asset('bower_components/assets/js/utility/utility.js') }}"></script>
   <script type="text/javascript" src="{{ asset('bower_components/assets/js/demo/demo.js') }}"></script>
   <script type="text/javascript" src="{{ asset('bower_components/assets/js/main.js') }}"></script>

  <!-- Page Javascript -->
  <script type="text/javascript">
  jQuery(document).ready(function() {

//    "use strict";
//
//    // Init Theme Core      
//    Core.init();
//
//    // Init Demo JS
//    Demo.init();
//
//    // Init CanvasBG and pass target starting location
//    CanvasBG.init({
//      Loc: {
//        x: window.innerWidth / 2,
//        y: window.innerHeight / 3.3
//      },
//    });

  });
  </script>

  <!-- END: PAGE SCRIPTS -->

</body>

</html>
