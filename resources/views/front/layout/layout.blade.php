<!DOCTYPE html>
<html class="no-js" lang="en-US">
  <head>
    <meta charset="UTF-8" />
    <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>
      Multi Vendor E-commerce | myCommerce
    </title>
    <!-- Standard Favicon -->
    <link rel="shortcut icon" href="{{ url('front/images/main-logo/favicon.png') }}" />
    <!-- Base Google Font for Web-app -->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:400,700"
      rel="stylesheet"
    />
    <!-- Google Fonts for Banners only -->
    <link
      href="https://fonts.googleapis.com/css?family=Raleway:400,800"
      rel="stylesheet"
    />
    <!-- TailwindCSS -->
    {{-- @vite('resources/css/app.css') --}}
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{ url('front/css/bootstrap.min.css') }}" />
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="{{ url('front/css/fontawesome.min.css') }}" />
    <!-- Ion-Icons 4 -->
    <link rel="stylesheet" href="{{ url('front/css/ionicons.min.css') }}" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ url('front/css/animate.min.css') }}" />
    <!-- Owl-Carousel -->
    <link rel="stylesheet" href="{{ url('front/css/owl.carousel.min.css') }}" />
    <!-- Jquery-Ui-Range-Slider -->
    <link rel="stylesheet" href="{{ url('front/css/jquery-ui-range-slider.min.css') }}" />
    <!-- Utility -->
    <link rel="stylesheet" href="{{ url('front/css/utility.css') }}" />
    <!-- Main -->
    <link rel="stylesheet" href="{{ url('front/css/bundle.css') }}" />
    <!-- Custom -->
    <link rel="stylesheet" href="{{ url('front/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ url('admin/vendors/select2/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ url('admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
  </head>
  <body>
    <!-- Loader -->
    <div class="loader">
      <img src="{{asset('front/images/loaders/loader.gif')}}" alt="loading..." />
   </div>
    <!-- app -->
    <div id="app">
      <!-- Header -->
        @include('front.layout.header')
      <!-- Header /- -->

      <!-- Contents -->
        @yield('content')
      <!-- Contents /- -->

      <!-- Footer -->
        @include('front.layout.footer')
      <!-- Footer /- -->
      <!-- Modals -->
      {{-- @include('front.layout.modals') --}}
      <!-- Modals /- -->
    </div>
    <!-- app /- -->
    <!--[if lte IE 9]>
      <div class="app-issue">
        <div class="vertical-center">
          <div class="text-center">
            <h1>You are using an outdated browser.</h1>
            <span
              >This web app is not compatible with following browser. Please
              upgrade your browser to improve your security and
              experience.</span
            >
          </div>
        </div>
      </div>
      <style>
        #app {
          display: none;
        }
      </style>
    <![endif]-->
    <!-- NoScript -->
    <noscript>
      <div class="app-issue">
        <div class="vertical-center">
          <div class="text-center">
            <h1>JavaScript is disabled in your browser.</h1>
            <span
              >Please enable JavaScript in your browser or upgrade to a
              JavaScript-capable browser.</span
            >
          </div>
        </div>
      </div>
      <style>
        #app {
          display: none;
        }
      </style>
    </noscript>
    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
      window.ga = function () {
        ga.q.push(arguments);
      };
      ga.q = [];
      ga.l = +new Date();
      ga("create", "UA-XXXXX-Y", "auto");
      ga("send", "pageview");
    </script>
    <script
      src="https://www.google-analytics.com/analytics.js"
      async
      defer
    ></script>
    <!-- Modernizr-JS -->
    <script
      type="text/javascript"
      src="{{ url('front/js/vendor/modernizr-custom.min.js') }}"
    ></script>
    <!-- NProgress -->
    <script type="text/javascript" src="{{ url('front/js/nprogress.min.js') }}"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="{{ url('front/js/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="{{ url('front/js/bootstrap.min.js') }}"></script>
    <!-- Popper -->
    <script type="text/javascript" src="{{ url('front/js/popper.min.js') }}"></script>
    <!-- ScrollUp -->
    <script type="text/javascript" src="{{ url('front/js/jquery.scrollUp.min.js') }}"></script>
    <!-- Elevate Zoom -->
    <script type="text/javascript" src="{{ url('front/js/jquery.elevatezoom.min.js') }}"></script>
    <!-- jquery-ui-range-slider -->
    <script
      type="text/javascript"
      src="{{ url('front/js/jquery-ui.range-slider.min.js') }}"
    ></script>
    <!-- jQuery Slim-Scroll -->
    <script type="text/javascript" src="{{ url('front/js/jquery.slimscroll.min.js') }}"></script>
    <!-- jQuery Resize-Select -->
    <script
      type="text/javascript"
      src="{{ url('front/js/jquery.resize-select.min.js') }}"
    ></script>
    <!-- jQuery Custom Mega Menu -->
    <script
      type="text/javascript"
      src="{{ url('front/js/jquery.custom-megamenu.min.js') }}"
    ></script>
    <!-- jQuery Countdown -->
    <script
      type="text/javascript"
      src="{{ url('front/js/jquery.custom-countdown.min.js') }}"
    ></script>
    <!-- Owl Carousel -->
    <script type="text/javascript" src="{{ url('front/js/owl.carousel.min.js') }}"></script>
    <!-- Main -->
    <script type="text/javascript" src="{{ url('front/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/custom.js') }}"></script>
    {{-- Custom --}}
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('admin/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ url('admin/js/select2.js') }}"></script>
    @include('front.layout.scripts')
  </body>
</html>
