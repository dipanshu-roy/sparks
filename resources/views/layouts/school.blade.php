<!DOCTYPE html>
<html lang="en">

<head>

	<title>Spark School Dashboard</title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Spark Admin" />
	<meta name="keywords"
		content="Spark Admin">
	<meta name="author" content="Codedthemes" />

	<!-- Favicon icon -->
	<link href="{{ asset('web/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('web/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
	<!-- fontawesome icon -->
	<!-- <link rel="stylesheet" href="{{asset('admin/fontawesome/css/fontawesome-all.min.css')}}"> -->
	<!-- animation css -->
	<link rel="stylesheet" href="{{asset('admin/plugins/animation/css/animate.min.css')}}">
 
	<!-- vendor css -->
	<link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
	<style>
    .notification {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #d4edda;
      color: #155724;
      padding: 15px 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      font-family: sans-serif;
      font-size: 16px;
      opacity: 0;
      transform: translateX(100%);
      transition: all 0.5s ease;
      z-index: 9999;
    }

    .notification.show {
      opacity: 1;
      transform: translateX(0);
    }
	.school-logo{
			width:50px;
			height:50px;
	}

	
	.notification-error {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: red;
      color: #fff;
      padding: 15px 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      font-family: sans-serif;
      font-size: 16px;
      opacity: 0;
      transform: translateX(100%);
      transition: all 0.5s ease;
      z-index: 9999;
    }

    .notification-error.show {
      opacity: 1;
      transform: translateX(0);
    }
  </style>
</head>

<body class="">
	<!-- [ Pre-loader ] start -->
	<!-- <div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div> -->
	<!-- [ Pre-loader ] End -->

	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menupos-fixed menu-light brand-blue ">
		<div class="navbar-wrapper ">
			<div class="navbar-brand header-logo">
				<a href="{{route('school.dashboard')}}" class="b-brand">
					<img src="{{asset('web/logo.svg')}}" alt="" class="logo images"> 
				</a>
				<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
			</div>
			<div class="navbar-content scroll-div">
				<ul class="nav pcoded-inner-navbar">
					
					<li class="nav-item {{ request()->routeIs('school.dashboard') ? 'active' : '' }}">
						<a href="{{route('school.dashboard')}}" class="nav-link"><span class="pcoded-micon "><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
				 
					<li class="nav-item {{ request()->routeIs('school.profile') ? 'active' : '' }}">
						<a href="{{route('school.profile')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Profile</span></a>
					</li>

					

					<li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Computer Requirements</span></a>
						<ul class="pcoded-submenu">
						<li class="nav-item {{ request()->routeIs('technical.assesment') ? 'active' : '' }}">
						<a href="{{route('technical.assesment')}}">Technical Assesment</a></li>					
						<li class=""><a href="#" class="">Computer Lab Certification</a></li>							 							 
						</ul>
					</li>




					<li class="nav-item {{ request()->routeIs('school.share.link') ? 'active' : '' }}">
						<a href="{{route('school.share.link')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Share Link</span></a>
					</li>
					<li class="nav-item">
						<a href="{{route('student.verification')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Student Verification </span></a>
					</li>

					<li class="nav-item">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext"> Change Password</span></a>
					</li>


					<li class="nav-item">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Logout </span></a>
					</li>

					
				</ul>
			
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->

	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
		<div class="m-header">
			<a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
			<a href="index.html" class="b-brand">
				<img src="../assets/images/logo.svg" alt="" class="logo images">
				<img src="../assets/images/logo-icon.svg" alt="" class="logo-thumb images">
			</a>
		</div>
		<a class="mobile-menu" id="mobile-header" href="#!">
			<i class="feather icon-more-horizontal"></i>
		</a>
		<div class="collapse navbar-collapse">
			<a href="#!" class="mob-toggler"></a>
			
			<ul class="navbar-nav ml-auto">
				<li>
				@php
					$user = Auth::guard('school')->user();
				@endphp	
				<img src="{{asset($user->image)}}" class="img-radius school-logo" ></li>
				
				<li>
					<div class="dropdown drp-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon feather icon-settings"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-notification">
							<div class="pro-head">
								<img src="{{asset('admin/images/user/avatar-1.jpg')}}" class="img-radius" alt="User-Profile-Image">
								<!-- <span>John Doe</span> -->

								<form method="POST" action="{{ route('school.logout') }}">
								@csrf                        
									<a href="route('school.logout')"
										onclick="event.preventDefault();
													this.closest('form').submit();" class="dud-logout" title="Logout">
										<i class="feather icon-log-out"></i>
									</a>
								</form>

							</div>
							<!-- <ul class="pro-body">
								<li><a href="#!" class="dropdown-item"><i class="feather icon-settings"></i> Settings</a></li>
								<li><a href="#!" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
								<li><a href="message.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
								<li><a href="auth-signin.html" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
							</ul> -->
						</div>
					</div>
				</li>
			</ul>
		</div>
	</header>
	<!-- [ Header ] end -->
	@yield('content')

	
	@if(session('success'))
        <div id="successPopup" class="notification">
            ✅ {{ session('success') }}
        </div>
	@endif

	@if(session('error'))
    <div id="successPopup" class="notification-error">
        ❌ {{ session('error') }}
    </div>
	@endif

	<!-- Warning Section start -->
	<!-- Older IE warning message -->
	<!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="../assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="../assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="../assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="../assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="../assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
	<!-- Warning Section Ends -->

	<!-- Required Js -->
	


	<script src="{{asset('admin/js/vendor-all.min.js')}}"></script>
	<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('admin/js/pcoded.min.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	@stack('scripts')
	<script>
  window.onload = function() {
    const popup = document.getElementById("successPopup");
    popup.classList.add("show");

    // Auto-hide after 3 seconds (optional)
    setTimeout(() => {
      popup.classList.remove("show");
    }, 3000);
  };
</script>
</body>

</html>
