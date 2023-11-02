<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env("APP_NAME")}}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
</head>
<body>
    <div class="container @if(Route::is("register")) right-panel-active  @endif " id="container">
        <div class="form-container sign-up-container">
            <form action="{{route("register")}}" method="POST">
                @csrf
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>

                <input type="text" name="name" placeholder="Name *" value="{{old("name")}}" required/>
                @error('name') <span class="error">{{$message}}</span> @enderror

                <input type="email" name="email" placeholder="Email *" value="{{old("email")}}" required/>
                @error('email') <span class="error">{{$message}}</span> @enderror

                <input type="text" name="phone" placeholder="Phone *" value="{{old("phone")}}" required/>
                @error('phone') <span class="error">{{$message}}</span> @enderror

                <input type="password" name="password" placeholder="Password *" required />
                @error('password') <span class="error">{{$message}}</span> @enderror

                <input type="password" name="password_confirmation" placeholder="Confirm Password *" required />
                @error('password_confirmation') <span class="error">{{$message}}</span> @enderror

                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="{{route("login")}}" method="POST">
                @csrf
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" name="email" placeholder="Email *" value="{{old("email")}}" required/>
                @error('email') <span class="error">{{$message}}</span> @enderror

                <input type="password" name="password" placeholder="Password *" required/>
                @error('password') <span class="error">{{$message}}</span> @enderror

                <a href="#">Forgot your password?</a>
                <button>Log In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <a href="{{route("login")}}" class="ghost" id="signIn">Log In</a>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <a href="{{route("register")}}" class="ghost" id="signUp">Sign Up</a>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="{{asset("js/script.js")}}"></script> --}}
</body>
</html>