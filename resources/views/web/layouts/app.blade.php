<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

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

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ url('img/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ url('img/apple-touch-icon.html') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('img/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('img/apple-touch-icon-114x114.png') }}">

</head>

<body class="relative vertical-nav">

    <!-- Preloader -->
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>

    <main class="main-wrapper">

        <header class="nav-type-2">

            <nav class="navbar">
                <div class="container header-wrap relative">

                    <div class="row">

                        <div class="navbar-header">
                            <!-- Logo -->
                            <div class="logo-container">
                                <div class="logo-wrap">
                                    <a href="{{ route('web.index') }}">
                                        <img class="logo-dark" src="img/logo_dark.png" alt="logo">
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
                        <div class="clear"></div>

                        <div class="nav-wrap">

                            <!-- Cart -->
                            <div class="nav-cart clearfix hidden-sm hidden-xs">
                                <div class="nav-cart-outer">
                                    <div class="nav-cart-inner">
                                        <a href="{{ route('cart.index') }}" class="nav-cart-icon">
                                            {{ Cart::count() }}
                                        </a>
                                    </div>
                                </div>
                                <div class="nav-cart-amount">
                                    <a href="#"> {{ Cart::total() }}</a>
                                </div>
                            </div> <!-- end cart -->

                            <div class="collapse navbar-collapse" id="navbar-collapse">
                                <ul class="nav navbar-nav">

                                    <li class="dropdown">
                                        <a href="{{ route('web.index') }}">Home</a><i class="fa fa-angle-down dropdown-trigger"></i>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#">Shop</a><i class="fa fa-angle-down dropdown-trigger"></i>
                                        <ul class="dropdown-menu">
                                            <li><a href="shop-catalog.html">Catalog no Sidebar</a></li>
                                            <li><a href="shop-catalog-sidebar.html">Catalog With Sidebar</a></li>
                                            <li><a href="shop-single.html">Single Product</a></li>
                                            <li><a href="shop-cart.html">Cart</a></li>
                                            <li><a href="shop-checkout.html">Checkout</a></li>
                                        </ul>
                                    </li>


                                    <li class="mobile-links hidden-lg hidden-md">
                                        <a href="#">My Account</a>
                                    </li>

                                    <!-- Mobile search -->
                                    <li id="mobile-search" class="hidden-lg hidden-md">
                                        <form method="get" class="mobile-search">
                                            <input type="search" class="form-control" placeholder="Search...">
                                            <button type="submit" class="search-button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </form>
                                    </li>

                                </ul> <!-- end menu -->
                            </div> <!-- end collapse -->

                            <!-- Search -->
                            <form class="relative mt-60 hidden-sm hidden-xs">
                                <input type="search" class="searchbox mb-0" placeholder="Search">
                                <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
                            </form>

                            <div class="social-icons mt-40 nobase hidden-sm hidden-xs">
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </div>

                            <div class="copyright hidden-sm hidden-xs">
                                <span>
                                    &copy; 2017 Zenna Theme,<br> Made by <a href="http://deothemes.com/">DeoThemes</a>
                                </span>
                            </div>

                        </div> <!-- end nav-wrap -->

                    </div> <!-- end row -->
                </div> <!-- end container -->
            </nav> <!-- end navbar -->
        </header>

        <div class="content-wrapper oh">

            @yield('web-content')

        </div> <!-- end content wrapper -->
    </main> <!-- end main wrapper -->

    <!-- jQuery Scripts -->
    <script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/scripts.js') }}"></script>

</body>

</html>
