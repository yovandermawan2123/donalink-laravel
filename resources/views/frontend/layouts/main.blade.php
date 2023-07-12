<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Dona-Link</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="../frontend_template/css/bootstrap.min.css">
    <link rel="stylesheet" href="../frontend_template//css/owl.carousel.min.css">
    <link rel="stylesheet" href="../frontend_template//css/slicknav.css">
    <link rel="stylesheet" href="../frontend_template//css/flaticon.css">
    <link rel="stylesheet" href="../frontend_template//css/progressbar_barfiller.css">
    <link rel="stylesheet" href="../frontend_template//css/gijgo.css">
    <link rel="stylesheet" href="../frontend_template//css/animate.min.css">
    <link rel="stylesheet" href="../frontend_template//css/animated-headline.css">
    <link rel="stylesheet" href="../frontend_template//css/magnific-popup.css">
    <link rel="stylesheet" href="../frontend_template//css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../frontend_template//css/themify-icons.css">
    <link rel="stylesheet" href="../frontend_template//css/slick.css">
    <link rel="stylesheet" href="../frontend_template//css/nice-select.css">
    <link rel="stylesheet" href="../frontend_template//css/style.css">

    <style>
        /* .dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-toggle {
  padding: 10px 20px;
  border: none;
  background-color: #f1f1f1;
  color: #333;
  cursor: pointer;
} */

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  min-width: 200px;
  padding: 10px;
  background-color: #fff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  z-index: 1;
}

.dropdown-item {
    cursor: pointer;
  display: block;
  padding: 5px 10px;
  color: #333;
  text-decoration: none;
  transition: background-color 0.3s;
}

.dropdown-item:hover {
  background-color: #f1f1f1;
}
    </style>
</head>

<body>
    <!-- ? Preloader Start -->
    {{-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="../frontend_template//img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        @include('frontend.layouts.navbar')
        <!-- Header End -->
    </header>
    <!-- header end -->
    <main>
        @yield('content')
    </main>
    <footer>
        @include('frontend.layouts.footer')
    </footer>

    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->

    <script src="../frontend_template/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="../frontend_template/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../frontend_template/js/popper.min.js"></script>
    <script src="../frontend_template/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./../frontend_template/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="../frontend_template/js/owl.carousel.min.js"></script>
    <script src="../frontend_template/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="../frontend_template/js/wow.min.js"></script>
    <script src="../frontend_template/js/animated.headline.js"></script>
    <script src="../frontend_template/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="../frontend_template/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="../frontend_template/js/jquery.nice-select.min.js"></script>
    <script src="../frontend_template/js/jquery.sticky.js"></script>
    <!-- Progress -->
    <script src="../frontend_template/js/jquery.barfiller.js"></script>

    <!-- counter , waypoint,Hover Direction -->
    <script src="../frontend_template/js/jquery.counterup.min.js"></script>
    <script src="../frontend_template/js/waypoints.min.js"></script>
    <script src="../frontend_template/js/jquery.countdown.min.js"></script>
    <script src="../frontend_template/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="../frontend_template/js/contact.js"></script>
    <script src="../frontend_template/js/jquery.form.js"></script>
    <script src="../frontend_template/js/jquery.validate.min.js"></script>
    <script src="../frontend_template/js/mail-script.js"></script>
    <script src="../frontend_template/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="../frontend_template/js/plugins.js"></script>
    <script src="../frontend_template/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')

    

</body>

</html>
