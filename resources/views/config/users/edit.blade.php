@extends('layouts.app')
@section('title', 'Modificar Usuario')

@section('content')

<section class="content">
    <form method="POST" action="{{ route("config.users.update", $user->id) }}" id="form_submit">
        @csrf
        @method("PUT")

        <div class="container-fluid">
            <div class="block-header">
                <ol class="breadcrumb">
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons">settings</i> Configuraciones
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            Usuarios
                        </a>
                    </li>
                    <li class="active">
                        Nuevo
                    </li>
                </ol>
            </div>

            <form method="POST" action="{{ route('config.users.store') }}">
                @csrf
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Datos del Usuario: {{ $user->name }}
                                    {{-- <small>Description text here...</small> --}}
                                </h2>
                                <ul class="header-dropdown m-r-0">
                                    <li>
                                        <button type="submit" data-toggle="tooltip" data-placement="auto"
                                            data-original-title="Guardar"
                                            class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                                            <i class="material-icons">save</i>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">

                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label for="name">Nombres y Apellidos</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="name" name="name" required
                                                    value="{{ $user->name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="email">Email</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ $user->email }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="estacion_id">Estación</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control show-tick" data-live-search="true"
                                                    data-container="body" data-size="10" data-title="Seleccione..."
                                                    name="estacion_id" id="estacion_id">
                                                    <option value="">-Ninguna-</option>
                                                    @forelse ($estaciones as $item)
                                                    <option {{ ($user->estacion_id == $item->id) ? "selected" : "" }}
                                                        data-subtext="{{ $item->codigo }}"
                                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @empty
                                                    <option value="" disabled>-Sin datos-</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label for="username">Usuario</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="username" name="username"
                                                    required value="{{ $user->username }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="password">Contraseña</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="password"
                                                    name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="password_confirmation">Confirmar Contraseña</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    minlength="6" name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label for="roles">Rol</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control show-tick" data-live-search="true" required
                                                    data-container="body" data-size="10" data-title="Seleccione..."
                                                    name="roles[]" id="roles">
                                                    @foreach ($roles as $item)
                                                    <option {{ ($user->hasRole($item->name)) ? "selected" : "" }}
                                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </form>
</section>

@endsection

@section('styles')
<!-- Bootstrap Select Css -->
<link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
<!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<!-- Select Plugin Js -->
<script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<!-- Jquery Validation Plugin Css -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>
<script src="{{ asset('js/jquery.validate.messages_es.js') }}"></script>
<!-- tooltips-popovers -->
<script src="{{ asset('js/pages/ui/tooltips-popovers.js') }}"></script>
<!-- Moment Js -->
<script src="{{ asset('plugins/momentjs/moment.js') }}"></script>
<!-- Input Mask Plugin Js -->
<script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>

<script>
    $('#form_submit').validate({
        rules:{
            password:{
                minlength:  6
            },
            password_confirmation : {
                minlength : 6,
                equalTo : "#password"
            }
        },
        messages:{
            password_confirmation: {
                equalTo: "Las contraseñas no coinciden."
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function (form) {

            swal({
                title: "Confirmar",
                text: "Confirme realizar el proceso.",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#2b982b",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                $.ajax({
                    url: $(form).attr('action'),
                    dataType: 'JSON',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $(form).serialize(),
                    timeout: 10000,
                    success: function (result) {
                        swal({
                            title: result.title,
                            text: result.text,
                            type: result.type,
                            showCancelButton: false,
                            closeOnConfirm: true
                        }, function () {
                            if (result.type == "success") {
                                window.location.href = result.goto
                            } else {
                                window.location.href
                            }
                        });
                    },
                    error: function (error) {
                        console.log(error.error)
                        swal(error.title, error.message, error.result);
                    },
                    statusCode: {
                        500: function () {
                            swal('Error en el proceso',
                                'Error al procesar los datos. Intente nuevamente',
                                'error')
                        }
                    }
                })
            });
        }
    });

</script>
@endsection
