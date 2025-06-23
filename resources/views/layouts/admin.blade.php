<!DOCTYPE html>
<html lang="en">

<head>

	<title>Spark Olympiad - Admin</title>
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
	<link rel="stylesheet" href="{{asset('admin/fontawesome/css/fontawesome-all.min.css')}}">
	<!-- animation css -->
	<link rel="stylesheet" href="{{asset('admin/plugins/animation/css/animate.min.css')}}">

	<!-- vendor css -->
	<link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


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
				<a href="{{route('dashboard')}}" class="b-brand">
					<img src="{{asset('web/logo.svg')}}" alt="" class="logo images"> 
				</a>
				<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
			</div>
			<div class="navbar-content scroll-div">
				<ul class="nav pcoded-inner-navbar">
					<!-- <li class="nav-item pcoded-menu-caption">
						<label>Navigation</label>
					</li> -->
					<li class="nav-item">
						<a href="{{route('dashboard')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					<!-- <li class="nav-item pcoded-menu-caption">
						<label>UI Element</label>
					</li> -->
					
					<!-- <li class="nav-item pcoded-menu-caption">
						<label>Forms &amp; table</label>
					</li> -->
					<li class="nav-item">
						<a href="{{route('manage.school')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Manage Schools</span></a>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Reports</span></a>
						<ul class="pcoded-submenu">
						<li class=""><a href="#" class="">School Registration </a></li>
						<li class=""><a href="#" class="">Technical Assesment </a></li>
							<li class=""><a href="#" class="">Payment Transactions </a></li>							
							<li class=""><a href="{{route('title.index')}}" class="">Student Login Details</a></li>
							<!-- <li class=""><a href="bc_collapse.html" class="">Collapse</a></li>
							<li class=""><a href="bc_progress.html" class="">Progress</a></li>
							<li class=""><a href="bc_tabs.html" class="">Tabs & pills</a></li>
							<li class=""><a href="bc_typography.html" class="">Typography</a></li> -->
						</ul>
					</li>

					<li class="nav-item">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Manage Users</span></a>
					</li>

					<li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Masters</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="{{route('designation.index')}}" class="">Manage Designation</a></li>
							<li class=""><a href="{{route('board.index')}}" class="">Manage Board</a></li>
							<li class=""><a href="{{route('title.index')}}" class="">Manage Title</a></li>
							<li class=""><a href="{{route('title.index')}}" class="">Settings</a></li>
							<li class="" {{ request()->routeIs('class.index') ? 'active' : '' }}><a href="{{route('class.index')}}" class="">Class</a></li>
							<li class="" {{ request()->routeIs('subject.index') ? 'active' : '' }}><a href="{{route('subject.index')}}" class="">Map Subject</a></li>
							<li class="" {{ request()->routeIs('exam.date') ? 'active' : '' }}><a href="{{route('exam.date')}}" class="">Exam Date</a></li>
							<!-- <li class=""><a href="bc_collapse.html" class="">Collapse</a></li>
							<li class=""><a href="bc_progress.html" class="">Progress</a></li>
							<li class=""><a href="bc_tabs.html" class="">Tabs & pills</a></li>
							<li class=""><a href="bc_typography.html" class="">Typography</a></li> -->
						</ul>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Change Password</span></a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Logout</span></a>
					</li>
					
					<!-- <li class="nav-item">
						<a href="form_elements.html" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Form elements</span></a>
					</li>
					<li class="nav-item">
						<a href="tbl_bootstrap.html" class="nav-link"><span class="pcoded-micon"><i class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Bootstrap table</span></a>
					</li>
					<li class="nav-item pcoded-menu-caption">
						<label>Chart & Maps</label>
					</li>
					<li class="nav-item">
						<a href="chart-morris.html" class="nav-link"><span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span class="pcoded-mtext">Chart</span></a>
					</li>
					<li class="nav-item">
						<a href="map-google.html" class="nav-link"><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Maps</span></a>
					</li>
					<li class="nav-item pcoded-menu-caption">
						<label>Pages</label>
					</li> -->
					<!-- <li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-lock"></i></span><span class="pcoded-mtext">Authentication</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="auth-signup.html" class="" target="_blank">Sign up</a></li>
							<li class=""><a href="auth-signin.html" class="" target="_blank">Sign in</a></li>
						</ul>
					</li> -->
					<!-- <li class="nav-item"><a href="sample-page.html" class="nav-link"><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Sample page</span></a></li>
					<li class="nav-item disabled"><a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-power"></i></span><span class="pcoded-mtext">Disabled menu</span></a></li> -->
				</ul>
				<!-- <div class="card text-center">
					<div class="card-block">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<i class="feather icon-sunset f-40"></i>
						<h6 class="mt-3">Upgrade to pro</h6>
						<p>upgrade for get full themes and 30min support</p>
						<a href="https://codedthemes.com/item/flash-able-bootstrap-admin-template/" target="_blank" class="btn btn-gradient-primary btn-sm text-white m-0">Upgrade</a>
					</div>
				</div> -->
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
					<div class="dropdown drp-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon feather icon-settings"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-notification">
							<div class="pro-head">
								<img src="../assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image">
								<span>John Doe</span>
								 

								<form method="POST" action="{{ route('logout') }}">
								@csrf
							
									<a href="route('logout')"
										onclick="event.preventDefault();
													this.closest('form').submit();" class="dud-logout" title="Logout">
										<i class="feather icon-log-out"></i>
									</a>
									</form>
							</div>							 
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
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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

<script>
  $(document).ready(function() {
    $('.class-select').select2({
      placeholder: "--Select classes--",
      allowClear: true
    });
  });
</script>

</body>

</html>
