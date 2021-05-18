<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Iniciar Sesión | {{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon-->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body class="login-page" style="background-color: #3F51B5">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>{{ config('app.name', 'Laravel') }}</b></a>
            <small>Distribuidora de Viveres</small>
        </div>
        <div class="card">
            <div class="body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="msg">Ingrese sus credenciales para iniciar sesión</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line @error('username') error @enderror">
                            <input type="text" class="form-control"
                                name="username"
                                placeholder="Usuario" required
                                autofocus>
                        </div>
                        @error('username')
                            <label id="username-error" class="error" for="username">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line @error('password') error @enderror">
                            <input type="password" class="form-control"
                                name="password" placeholder="Contraseña" required>
                        </div>
                        @error('password')
                            <label id="password-error" class="error" for="password">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label for="rememberme">Recuerdame</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">INICIAR</button>
                        </div>
                    </div>
                    {{-- <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registrarme</a>
                            @endif
                        </div>
                        <div class="col-xs-6 align-right">
                            @if (Route::has('password.request'))
                            <a class="" href="{{ route('password.request') }}">
                                ¿Olvido su contraseña?
                            </a>
                            @endif
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.messages_es.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/pages/examples/sign-in.js') }}"></script>
</body>

</html>
