<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>India’s First Fully Online Olympiad</title>
    <meta name="description" content="SPARK Olympiads aim to transform how student achievement is measured by providing secure, competency-based, and insightful assessments—delivered fully online, powered by global best practices, and designed to empower students, teachers, and schools through meaningful recognition and actionable feedback.">
    <meta name="keywords" content="SPARK Olympiads,Olympiad,students,teachers">
    <!-- Favicons -->
    <link href="{{ asset('web/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('web/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,200..900;1,200..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('web/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/main.css') }}" rel="stylesheet">
</head>

<body>
    <header id="header" class="header fixed-top">
        <div class="branding d-flex align-items-cente">
            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                    <img src="{{ asset('web/assets/img/logo.svg') }}" alt="">
                </a>
                <nav id="navmenu" class="navmenu">
                    <ul></ul>
                </nav>
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
                    <img src="https://sparkolympiads.com/assets/img/Spark-Logo-footer.svg" class="img-fluid" alt="footer logo" />
                </div>
            </div>
            <hr>
            <div class="row gy-4">
                <div class="col-lg-3 col-md-12 footer-links">
                    <h4>About Us</h4>
                    <ul>
                        <li><a href="https://sparkolympiads.com/mission-vision/mission.php">Mission and Vision</a></li>
                        <li><a href="https://sparkolympiads.com/international-steering-committee/g-balasubramanian.php">International Steering Commitee</a></li>
                        <li><a href="https://sparkolympiads.com/executive-team/nitin-kapoor.php">Executive Team</a></li>
                        <li><a href="https://sparkolympiads.com/about/edxso.php">EDXSO</a></li>
                        <li><a href="https://sparkolympiads.com/about/prometric.php">Prometric</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-links">
                    <h4>School Support</h4>
                    <ul>
                        <li><a href="https://sparkolympiads.com/computer-lab-readiness/index.php">Computer Lab Certification</a></li>
                        <li><a href="#">Registration</a></li>
                        <li><a href="#">School Dashboard</a></li>
                        <li><a href="#">Reports</a></li>
                        <li><a href="https://sparkolympiads.com/awards-and-acolades">Award and Accolades</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-links">
                    <h4>Test Prep Resources</h4>
                    <ul>
                        <li><a href="#">Competency Architecture</a></li>
                        <li><a href="https://sparkolympiads.com/spark-blueprint/">Spark Blueprint</a></li>
                        <li><a href="https://sparkolympiads.com/sample-question/">Sample Questions</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-links">
                    <h4>Contact Info</h4>
                    <ul>
                        <li><a href="mailto:info@sparkolympiads.com">info@sparkolympiads.com</a></li>
                        <li><a href="tel:+918447477275">+91 8447477275</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container copyright text-right mt-4">
            <p class="text-white"> © <span>Copyright 2025</span> <strong class="px-1 sitename">SPARK Olympiads</strong> <span>All Rights  Reserved</span></p>
        </div>
    </footer>
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('web/assets/js/main.js') }}?xx"></script>
    <script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 3000);
    });
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
    });
    </script>
    <script>
    document.getElementById('otp_check').addEventListener('input', function(e) {
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