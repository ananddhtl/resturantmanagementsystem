<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}">
    <title>Login | {{ config('app.name') }}</title>
    <style>
        .container.login-box {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container.login-box form {
            width: 600px;
        }
    </style>
</head>

<body>

    <div class="container login-box">
        <form action="{{ route('auth.login') }}" method="POST">
            <h3 class="text-center">Login to Admin Portal</h3>
            <hr>
            @csrf
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email <b>*</b></label>
                <input type="email" class="form-control" id="email" name="email"
                    placeholder="Enter your email...">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                @session('loginError')
                    <small class="text-danger">{{ $value }}</small>
                @endsession
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password <b>*</b></label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Enter your password...">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn primary-bg w-100">Login</button>
            @if ($registration === true)
                <div class="my-3 text-center">
                    <strong>Don't have an account? <a class="primary-text"
                            href="{{ route('auth.show.register') }}">Register</a></strong>
                </div>
            @endif
        </form>
    </div>

    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
</body>

</html>
