@extends('layouts.app')
@section('title', 'Modificar Estación')

@section('content')

<section class="content">
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
                            Estaciones
                        </a>
                    </li>
                    <li class="active">
                        Modificar
                    </li>
                </ol>
            </div>

            <form method="POST" action="{{ route('config.estaciones.update', $estacion->id) }}" id="form_submit">
                @csrf

                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Datos de la Estación {{ $estacion->name }}
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
                                    <div class="col-sm-6">
                                        <label for="codigo">Codigo</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="codigo" name="codigo" max="3"
                                                    required value="{{ $estacion->codigo }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="name">Nombre de Estación</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $estacion->name }}">
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
