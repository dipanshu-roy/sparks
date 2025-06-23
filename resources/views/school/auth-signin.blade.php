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
	<meta name="description" content="Flash Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
	<meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, Flash Able, Flash Able bootstrap admin template">
	<meta name="author" content="Codedthemes" />

	<!-- Favicon icon -->
	<link href="{{ asset('web/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('web/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
	<!-- fontawesome icon -->
	<link rel="stylesheet" href="{{asset('admin/fonts/fontawesome/css/fontawesome-all.min.css')}}">
	<!-- animation css -->
	<link rel="stylesheet" href="{{asset('admin/plugins/animation/css/animate.min.css')}}">

	<!-- vendor css -->
	<link rel="stylesheet" href="{{asset('admin/css/style.css')}}">




</head>

@php $code = request('code'); @endphp

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content container">
		<div class="card">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="card-body">
						
						<img src="{{asset('web/logo.svg')}}" alt="" class="img-fluid mb-4">
						<h2 class="mb-3 f-w-400">School Login </h2>
						<form method="POST" action="{{ url('school-login') }}">
						@csrf
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-user"></i></span>
							</div>
							<input type="text" name="school_id" value="{{ $code??''}}" class="form-control" placeholder="Registration ID">
							
						</div>
						<x-input-error :messages="$errors->get('school_id')" class="mt-2 text-danger" />

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-lock"></i></span>
							</div>
							<input type="password" name="password" class="form-control" placeholder="Password">
						 
						</div>

						<x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />

						
						<button type="submit" class="btn btn-primary mb-4">Login</button>
						</form>
						<p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html" class="f-w-400">Click here</a></p>
						 
					</div>
					
				</div>
				<div class="col-md-6 d-none d-md-block">
					<img src="https://sparkolympiads.com/assets/img/grid/grid-5.png" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="../assets/js/vendor-all.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>





</body>

</html>
