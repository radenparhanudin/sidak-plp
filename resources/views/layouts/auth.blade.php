<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Formasi MENPAN E Kantor">
    <meta name="author" content="Raden Parhanudin">
    <meta name="keywords" content="Formasi, MENPAN, E, Kantor">
    <title>{{ config('app.name') }} | Log in</title>
    <link rel="icon" href="{{ asset('template/backend') }}/dist/img/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('template/backend') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('template/backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('template/backend') }}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
    <div class="login-box" style="min-width: 450px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-center px-5 py-3">
                <a href="{{ route('login') }}" class="h5 text-dark text-uppercase">
                    <img src="{{ asset('template/backend') }}/dist/img/logo.png" width="85px" class="rounded mx-auto d-block py-2">
                    <b>SIDAK</b> Pasca Libur Panjang
                </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg text-primary">Login dengan menggunakan akun MySAPK</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-4 offset-md-8">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt mr-2"></i>Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('template/backend') }}/plugins/jquery.min.js"></script>
    <script src="{{ asset('template/backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template/backend') }}/dist/js/adminlte.min.js"></script>
</body>
</html>
