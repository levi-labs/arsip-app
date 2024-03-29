<!DOCTYPE html>
<html lang="en">

<head>
    <title>Aplikasi Arsip</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Sistem Arsip Toko Tirta" />
    <meta name="keywords" content="Sistem Arsip Toko Tirta" />
    <meta name="author" content="Toko Bangunan Tirta" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/animation/css/animate.min.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        body {
            background-color: rgb(72, 99, 218) !important;
        }
    </style>

</head>

<body>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="auth-wrapper">
                <div class="auth-content">
                    {{-- <div class="auth-bg">
                        <span class="r"></span>
                        <span class="r s"></span>
                        <span class="r s"></span>
                        <span class="r"></span>
                    </div> --}}
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="mb-4">
                                <img src="{{ asset('/assets/images/logotirta.png') }}" alt="logotirta" width="100vw;">
                                {{-- <i class="feather icon-unlock auth-icon"></i> --}}
                                <h3 class="mb-4">Login</h3>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="username" name="username">

                                </div>
                                <div class="input-group mb-4">
                                    <input type="password" class="form-control" placeholder="password" name="password">

                                </div>

                                <button type="submit" class="btn btn-primary shadow-2 mb-4">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Required Js -->
    <script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

</body>

</html>
