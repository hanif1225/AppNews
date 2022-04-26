
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Form Register</title>
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
            @error('name')
            <div class="container">
                <div class="alert alert-danger" role="alert">
                <center>{{ $message }}</center>
                </div>
            </div>
            @enderror
            @error('username')
            <div class="container">
                <div class="alert alert-danger" role="alert">
                <center>{{ $message }}</center>
                </div>
            </div>
            @enderror
            @error('no_hp')
            <div class="container">
                <div class="alert alert-danger" role="alert">
                <center>{{ $message }}</center>
                </div>
            </div>
            @enderror
            @error('email')
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
        <!-- hapus -->
            
            
                <div class="card-body container">
                    <center>
                    <form class="form validate-form" action="{{ route('register') }}" method="post" >
                        @csrf
                        <span class="login100-form-title">
                        FORM REGISTER
                        </span>

                        <div class="wrap-input100 validate-input col-10" data-validate = "Isikan Nama">
                            <input class="input100 @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="Isikan Nama" >
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
					    </div>

                        <div class="wrap-input100 validate-input col-10" data-validate = "Isikan Username">
                            <input class="input100 @error('username') is-invalid @enderror" type="text" name="username" value="{{ old('username') }}" placeholder="Isikan Username"  >
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-book"></i>
                            </span>
					    </div>

                        <div class="wrap-input100 validate-input col-10" data-validate = "Isikan No HP">
                            <input class="input100 @error('no_hp') is-invalid @enderror" type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Isikan No HP"  >
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-mobile"></i>
                            </span>
					    </div>

                        <div class="wrap-input100 validate-input col-10" data-validate = "Isikan Email">
                            <input class="input100 @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Isikan Email" >
                            <span class="symbol-input100">
                                <i class="fa fa-envelope"></i>
                            </span>
					    </div>

                        <div class="wrap-input100 validate-input col-10" data-validate = "Isikan Password">
                            <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Isikan Password" >
                            <span class="symbol-input100">
                                <i class="fa fa-key"></i>
                            </span>
					    </div>

                        <div class="wrap-input100 validate-input col-10" data-validate = "Konfirmasi Password">
                            <input class="input100" type="password" name="password_confirmation" placeholder="Konfirmasi Password"  >
                            <span class="symbol-input100">
                                <i class="fa fa-key"></i>
                            </span>
					    </div>

                        <div class="container-login100-form-btn col-10">
                            <button class="login100-form-btn">
                                Register
                            </button>

                            <a href="{{ route('login') }}" class="mt-2" style="font-size:14pt; font-family: Arial, Helvetica, sans-serif; "><b>Login</b></a>
                        </div>

                    </form>
                    </center>
                </div>
            
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
