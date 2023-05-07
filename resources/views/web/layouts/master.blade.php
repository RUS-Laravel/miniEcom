
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from deothemes.com/envato/zenna/html/shop-single.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jul 2021 20:48:21 GMT -->
<head>
  <title>{{ config('app.name') }} - @yield('title')</title>

  <meta charset="utf-8">
  <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="">
  
  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7COpen+Sans:400,400i,600,700' rel='stylesheet'>

  <!-- Css -->
  <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ url('css/magnific-popup.css') }}" />
  <link rel="stylesheet" href="{{ url('css/font-icons.css') }}" />
  <link rel="stylesheet" href="{{ url('css/sliders.css') }}" />
  <link rel="stylesheet" href="{{ url('css/style.css') }}" />
  <link rel="stylesheet" href="{{ url('css/custom.css') }}" />
@stack('css')
  <!-- Favicons -->
  <link rel="shortcut icon" href="{{ url('img/favicon.ico') }}">
  <link rel="apple-touch-icon" href="{{ url('img/apple-touch-icon.html') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ url('img/apple-touch-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ url('img/apple-touch-icon-114x114.png') }}">

</head>

<body class="relative">

  <!-- Preloader -->
  <div class="loader-mask">
    <div class="loader">
      <div></div>
      <div></div>
    </div>
  </div>

  <main class="main-wrapper">

    <header class="nav-type-1">

      <!-- Fullscreen search -->
      <div class="search-wrap">
        <div class="search-inner">
          <div class="search-cell">
            <form method="get">
              <div class="search-field-holder">
                <input type="search" class="form-control main-search-input" placeholder="Search for">
                <i class="ui-close search-close" id="search-close"></i>
              </div>            
            </form>
          </div>
        </div>        
      </div> <!-- end fullscreen search -->

      <!-- Top Bar -->
      <div class="top-bar hidden-xs">
        <div class="container">
          <div class="top-bar-links flex-parent">
            <ul class="top-bar-currency-language">
              <li>
                Currency: <a href="#">USD<i class="fa fa-angle-down"></i></a>
                <div class="currency-dropdown">
                  <ul>
                    <li><a href="#">USD</a></li>
                    <li><a href="#">EUR</a></li>
                  </ul>
                </div>
              </li>
              <li class="language">
                Language: <a href="#">ENG<i class="fa fa-angle-down"></i></a>
                <div class="language-dropdown">
                  <ul>
                    <li><a href="#">English</a></li>
                    <li><a href="#">Spanish</a></li>
                    <li><a href="#">German</a></li>
                    <li><a href="#">Chinese</a></li>
                  </ul>
                </div>
              </li>
            </ul>

            <ul class="top-bar-acc">
              <li class="top-bar-link"><a href="#">My Wishlist</a></li>
              <li class="top-bar-link"><a href="#">Newsletter</a></li>
              <li class="top-bar-link"><a href="{{route('login.account')}}">Login</a></li>                 
            </ul>

          </div>
        </div>
      </div> <!-- end top bar -->

      <nav class="navbar navbar-static-top">
        <div class="navigation" id="sticky-nav">
          <div class="container relative">

            <div class="row flex-parent">

              <div class="navbar-header flex-child">
                <!-- Logo -->
                <div class="logo-container">
                  <div class="logo-wrap">
                    <a href="{{route('web.index')}}">
                      <img class="logo-dark" src="{{url('img/logo_dark.png')}}" alt="logo">
                    </a>
                  </div>
                </div>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <!-- Mobile cart -->
                <div class="nav-cart mobile-cart hidden-lg hidden-md">
                  <div class="nav-cart-outer">
                    <div class="nav-cart-inner">
                      <a href="#" class="nav-cart-icon">
                        <span class="nav-cart-badge">2</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div> <!-- end navbar-header -->

              <div class="nav-wrap flex-child">
                @include('web.layouts.menu')
              </div> <!-- end col -->

              <div class="flex-child flex-right nav-right hidden-sm hidden-xs">
                @include('web.layouts.cart')
              </div>
          
            </div> <!-- end row -->
          </div> <!-- end container -->
        </div> <!-- end navigation -->
      </nav> <!-- end navbar -->
    </header>

    <div class="content-wrapper oh">
        @yield('content')
  
        <!-- Newsletter -->
        <section class="newsletter" id="subscribe">
            <div class="container">
              <div class="row">
                <div class="col-sm-12 text-center">
                  <h4>Get the latest updates</h4>
                  <form class="relative newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="Enter your email">
                    <input type="submit" class="btn btn-lg btn-dark newsletter-submit" value="Subscribe">
                  </form>
                </div>
              </div>
            </div>       
          </section>
    
          <!-- Footer Type-1 -->
          <footer class="footer footer-type-1">
            <div class="container">
              <div class="footer-widgets">
                <div class="row">
    
                  <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="widget footer-about-us">
                      <img src="{{url('img/logo_dark.png')}}" alt="" class="logo">
                      <p class="mb-30">Zenna Shop is a very slick and clean eCommerce template.</p>
                      <div class="footer-socials">
                        <div class="social-icons nobase">
                          <a href="#"><i class="fa fa-twitter"></i></a>
                          <a href="#"><i class="fa fa-facebook"></i></a>
                          <a href="#"><i class="fa fa-google-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div> <!-- end about us -->
    
                  <div class="col-md-2 col-md-offset-1 col-sm-6 col-xs-12">
                    <div class="widget footer-links">
                      <h5 class="widget-title bottom-line left-align grey">Information</h5>
                      <ul class="list-no-dividers">
                        <li><a href="#">Our stores</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Business with us</a></li>
                        <li><a href="#">Delivery information</a></li>
                      </ul>
                    </div>
                  </div>
    
                  <div class="col-md-2 col-sm-6 col-xs-12">
                    <div class="widget footer-links">
                      <h5 class="widget-title bottom-line left-align grey">Account</h5>
                      <ul class="list-no-dividers">                  
                        <li><a href="#">My account</a></li>
                        <li><a href="#">Wishlist</a></li>
                        <li><a href="#">Order history</a></li>
                        <li><a href="#">Specials</a></li>
                      </ul>
                    </div>
                  </div>
    
                  <div class="col-md-2 col-sm-6 col-xs-12">
                    <div class="widget footer-links">
                      <h5 class="widget-title bottom-line left-align grey">Useful Links</h5>
                      <ul class="list-no-dividers">
                        <li><a href="#">Shipping Policy</a></li>
                        <li><a href="#">Stores</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Terms &amp; Conditions</a></li>
                      </ul>
                    </div>
                  </div>
    
                  <div class="col-md-2 col-sm-6 col-xs-12">
                    <div class="widget footer-links">
                      <h5 class="widget-title bottom-line left-align grey">Service</h5>
                      <ul class="list-no-dividers">
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Warranty</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contact</a></li>
                      </ul>
                    </div>
                  </div>
    
                </div>
              </div>    
            </div> <!-- end container -->
    
            <div class="bottom-footer">
              <div class="container">
                <div class="row">
    
                  <div class="col-sm-6 copyright sm-text-center">
                    <span>
                      &copy; 2017 Zenna Theme, Made by <a href="http://deothemes.com/">DeoThemes</a>
                    </span>
                  </div>
    
                  <div class="col-sm-6 col-xs-12 footer-payment-systems text-right sm-text-center mt-sml-10">
                    <i class="fa fa-cc-paypal"></i>
                    <i class="fa fa-cc-visa"></i>
                    <i class="fa fa-cc-mastercard"></i>
                    <i class="fa fa-cc-discover"></i>
                    <i class="fa fa-cc-amex"></i>
                  </div>
    
                </div>
              </div>
            </div> <!-- end bottom footer -->
          </footer> <!-- end footer -->
    
          <div id="back-to-top">
            <a href="#top"><i class="fa fa-angle-up"></i></a>
          </div>
    
        </div> <!-- end content wrapper -->
      </main> <!-- end main wrapper -->
    
      <!-- jQuery Scripts -->
      <script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
      <script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
      <script type="text/javascript" src="{{url('js/plugins.js')}}"></script>  
      <script type="text/javascript" src="{{url('js/scripts.js')}}"></script>
        @stack('js')
    </body>
    
    <!-- Mirrored from deothemes.com/envato/zenna/html/shop-catalog-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jul 2021 20:48:21 GMT -->
    </html>