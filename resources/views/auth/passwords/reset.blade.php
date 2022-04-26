<!DOCTYPE html>
<html lang="en">
<head>
	<title>Reset Password</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('tampilan_login')}}/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('tampilan_login')}}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('tampilan_login')}}/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('tampilan_login')}}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('tampilan_login')}}/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('tampilan_login')}}/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{asset('tampilan_login')}}/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

			@error('username')
            <div class="container">
                <div class="alert alert-danger" role="alert">
                <center>{{ $message }}</center>
                </div>
            </div>
            @enderror
			@error('password')
            <div class="container">
                <div class="alert alert-danger" role="alert">
                <center>{{ $message }}</center>
                </div>
            </div>
            @enderror

				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('tampilan_login')}}/images/ca.png" alt="IMG" height="400" width="400">
				</div>

				<form class="login100-form validate-form" action="{{ route('password.update') }}" method="post" >
                @csrf

                <input type="hidden" name="token" value="{{$token}}">
				
					<span class="login100-form-title">
						Reset Password
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Isikan Email">
						<input class="input100 @error('email') is-invalid @enderror" type="text" name="email"  value="{{ $email ?? old('email') }}" placeholder="masukkan email">
                        <span class="text-danger">@error('email'){{$message}}@enderror</span>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>

					</div>

					<div class="wrap-input100 validate-input" data-validate = "Isikan Passwords">
						<input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Masukkan Password">
						<span class="text-danger">@error('password'){{$message}}@enderror</span>
                        <span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "konfirmasi Passwords">
						<input class="input100 @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Konfirmasi Password">
						<span class="text-danger">@error('password_confirmation'){{$message}}@enderror</span>
                        <span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Reset Password
						</button>

                        <a href="{{ route('register') }}" class="mt-2" style="font-size:14pt; font-family: Arial, Helvetica, sans-serif; "><b>Register</b></a>
					</div>
					<div class="container">
					<center>
					<a href="{{ route('password.request') }}" class="mt-2" style="font-size:14pt; font-family: Arial, Helvetica, sans-serif; "><b>Forgot Password</b></a>
					</center>
					</div>
				</form>
			</div>
		</div>
	</div>
<!--===============================================================================================-->	
	<script src="{{asset('tampilan_login')}}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('tampilan_login')}}/vendor/bootstrap/js/popper.js"></script>
	<script src="{{asset('tampilan_login')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('tampilan_login')}}/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('tampilan_login')}}/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
	$('.js-tilt').tilt({
		scale: 1.1
	})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('tampilan_login')}}/js/main.js"></script>
</body>
</html>