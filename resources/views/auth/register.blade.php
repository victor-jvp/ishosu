<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Registro | {{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">
</head>

<body class="signup-page" style="background-color: #3F51B5">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>{{ config('app.name', 'Laravel') }}</b></a>
            <small>Distribuidora de Viveres</small>
        </div>
        <div class="card">
            <div class="body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="msg">Registrar nuevo usuario</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line @error('name') error @enderror">
                            <input type="text" class="form-control"
                                name="name" placeholder="Nombre de usuario" required autofocus>
                        </div>
                        @error('name')
                            <label id="name-error" class="error" for="name">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line @error('username') error @enderror">
                            <input type="text" class="form-control"
                                name="username" placeholder="Cuenta" required>
                        </div>
                        @error('username')
                            <label id="username-error" class="error" for="username">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line @error('email') error @enderror">
                            <input type="email" class="form-control" name="email"
                                placeholder="Correo electrónico">
                        </div>
                        @error('email')
                            <label id="email-error" class="error" for="email">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line @error('password') error @enderror">
                            <input type="password" class="form-control "
                                name="password" minlength="6"
                                placeholder="Contraseña" required>
                        </div>
                        @error('password')
                            <label id="password-error" class="error" for="password">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password_confirmation" minlength="6"
                                placeholder="Confirme Contraseña" required>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of
                                usage</a>.</label>
                    </div> --}}

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">REGISTRAR</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="{{ route('login') }}">Regresar a inicio de sesión...</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="../../plugins/jquery-validation/jquery.validate.js"></script>
    <script src="../../js/jquery.validate.messages_es.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/examples/sign-up.js"></script>

</body>

</html>
