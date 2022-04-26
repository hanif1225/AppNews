<!DOCTYPE html>
<html lang="en">
<head>
	<title>Form Login</title>
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

			@error('email')
            <div class="container">
                <div class="alert alert-danger" role="alert">
                <center>{{ $message }}</center>
                </div>
            </div>
            @enderror

				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('tampilan_login')}}/images/ca.png" alt="IMG" height="400" width="400">
				</div>

				<form class="login100-form validate-form" action="{{ route('password.email') }}" method="post" >
                @csrf
                @if(session('status'))
                    <div class="alert alert-success">
                    {{session('status') }}
                    </div>
				@endif
					<span class="login100-form-title">
						Forgot Password
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Isikan Email">
						<input class="input100 @error('email') is-invalid @enderror" type="email" name="email"  value="{{ old('email') }}" placeholder="Masukkan Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                        <span class="text-danger">@error('email'){{$message}}@enderror</span>

					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Kirim
						</button>

                        <a href="{{ route('register') }}" class="mt-2" style="font-size:12pt; font-family: Arial, Helvetica, sans-serif; "><b>Register</b></a>
					</div>
					<div class="container">
					<center>
					<a href="{{ route('login') }}" class="mt-2" style="font-size:12pt; font-family: Arial, Helvetica, sans-serif; "><b>Login</b></a>
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