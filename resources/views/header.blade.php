<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ucfirst(request()->path()) }} Kings - Restaurant</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="index.html" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Kings food</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="/" class="nav-item nav-link {{request()->is('/') ? 'active' : '' }}">Home</a>
                        <a href="about-us" class="nav-item nav-link {{request()->is('about') ? 'active' : '' }}">About</a>
                        <a href="services" class="nav-item nav-link {{request()->is('service') ? 'active' : '' }}">Service</a>
                        <a href="menu" class="nav-item nav-link {{request()->is('menu') ? 'active' : '' }}">Menu</a>
                        @if(Auth::check())
                            <!-- If user is logged in, show Cart link -->
                            <a href="cart" class="nav-item nav-link {{request()->is('cart') ? 'active' : '' }}">Cart</a>
                        @else
                            <!-- If user is not logged in, show Login link -->
                            <a href="login" class="nav-item nav-link {{request()->is('login') ? 'active' : '' }}">Login</a>
                        @endif
                        <a href="contact-us" class="nav-item nav-link {{request()->is('contact') ? 'active' : '' }}">Contact</a>
                    </div>
                    <a href="booking" class="btn btn-primary py-2 px-4 {{request()->is('booking') ? 'active' : '' }}">Book A Table</a>
                    @if(Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li class="nav-item nav-link"><a :href="route('logout')"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();"><i class="fa fa-lock"></i>
                                Log out</a>
                        </li>	
                    </form>
                    @endif
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">@if(request()->is('contact-us')) {{'Contact Us'}} @elseif(request()->is('about-us')) {{'About Us'}} @else {{ucfirst(request()->path()) }} @endif</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">@if(request()->is('contact-us')) {{'Contact Us'}} @elseif(request()->is('about-us')) {{'About Us'}} @else {{ucfirst(request()->path()) }} @endif</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->
