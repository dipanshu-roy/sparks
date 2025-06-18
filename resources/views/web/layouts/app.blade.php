<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>India’s First Fully Online Olympiad</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicons -->
    <link href="{{ asset('web/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('web/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,200..900;1,200..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('web/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">
    <header id="header" class="header fixed-top">
        <div class="branding d-flex align-items-cente">
            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                    <img src="{{ asset('web/assets/img/logo.svg') }}" alt="">
                </a>
                <nav id="navmenu" class="navmenu">
                    <ul></ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
                {{-- <div class="d-flex header-button-container">
                    <a href="#about" class="button-header-registration-top-header-button btn-get-started">Register</a>
                </div> --}}
            </div>
        </div>
    </header>
    <main class="main">
        @yield('content')
    </main>
    <footer id="footer" class="footer accent-background">
        <div class="container footer-top">
            <div class="row">
                <div class="">
                    <img src="{{ asset('web/assets/img/Spark-Logo-footer.svg') }}" class="img-fluid" alt="footer logo" />
                </div>
            </div>
            <hr>
            <div class="row gy-4">
                <div class="col-lg-4 col-md-12 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Faq's</a></li>
                        <li><a href="#">Blogs</a></li>
                        <li><a href="#">School Support</a></li>
                        <li><a href="#">Test Prep Resources</a></li>
                        <li><a href="#">EdAssess Login</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-about">
                    <h4>Contact Info</h4>
                    <p>Email:info@sparkolympiads.com</p>
                    <p>Call:+91 8447477275</p>
                </div>
                <div class="col-lg-4 col-md-12 footer-contact text-right">
                    <h4>Join Us</h4>
                    <div class="social-links social-footer d-flex mt-4 text-right">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container copyright text-right mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">SPARK Olympiads</strong> <span>All Rights Reserved</span></p>
        </div>
    </footer>
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    {{-- 
    <script src="{{ asset('web/assets/vendor/php-email-form/validate.js') }}"></script>
    
    <script src="{{ asset('web/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
     --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('web/assets/js/main.js') }}"></script>
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 3000);
        });
        document.addEventListener('DOMContentLoaded', function () {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
        });
    </script>
    <script>
        document.getElementById('otp_check').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0 && value.charAt(0) === '0') {
                value = value.slice(1);
            }
            e.target.value = value.slice(0, 6);
        });
    </script>

    @stack('scripts')

</body>

</html>
