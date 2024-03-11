<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}">
    <title>Register | {{ config('app.name') }}</title>
    <style>
        .container.register-box {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container.register-box form {
            width: 600px;
        }
    </style>
</head>

<body>

    <div class="container register-box">
        <form action="{{ route('auth.register') }}" method="POST">
            <h3 class="text-center">Register to {{ config('app.name') }}</h3>
            <hr>
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="form-label">Name <b>*</b></label>
                <input type="name" class="form-control" id="name" name="name"
                    placeholder="Enter your name...">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email <b>*</b></label>
                <input type="email" class="form-control" id="email" name="email"
                    placeholder="Enter your email...">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password <b>*</b></label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Enter your password...">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password <b>*</b></label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    placeholder="Retype your password...">
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn primary-bg w-100">Register</button>
            <div class="my-3 text-center">
                <strong>Already registered? <a class="primary-text"
                        href="{{ route('auth.show.login') }}">Login</a></strong>
            </div>
        </form>
    </div>

    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
</body>

</html>
