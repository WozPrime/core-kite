<!DOCTYPE html>
<html lang="en">
<head>
	<title>Idekite Core | Forgot Pass</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" href="{{ secure_asset('dist/css/adminlte.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('vendor/animate/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('vendor/css-hamburgers/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('vendor/select2/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('vendor/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('css/main.css') }}">
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="login-logo font-weight-bold">
                        <img src="{{ secure_asset('images/ikcore2.png') }}" width="250px" height="auto" style="margin-bottom: 30px;">
                    </div>
                    
					<div>
                        <p class="login-box-msg">
                            You forgot your password? Here you can easily retrieve a new
                            password.
                        </p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					
					<div class="wrap-input100 validate-input">
						<input id="email" type="email" class="input100 @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
					</div>

					
                    <div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">Send Password Reset Link</button>
					</div>
                    <div>
                        <p class="mt-3 mb-1">
                            <a href="/login">< Back to Login Page</a>
                        </p>
                    </div>
				</form>

				<div class="login100-more" style="background-image: url({{ secure_asset('images/bg-01.jpg') }});">
				</div>
			</div>
		</div>
	</div>
	
	<script src="{{ secure_asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ secure_asset('vendor/animsition/js/animsition.min.js') }}"></script>
	<script src="{{ secure_asset('vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ secure_asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ secure_asset('vendor/select2/select2.min.js') }}"></script>
	<script src="{{ secure_asset('vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ secure_asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ secure_asset('vendor/countdowntime/countdowntime.js') }}"></script>
	<script src="{{ secure_asset('js/main.js') }}"></script>

</body>
</html>