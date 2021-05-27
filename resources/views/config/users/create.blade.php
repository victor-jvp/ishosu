@extends('layouts.app')
@section('title', 'Nuevo Recibo')

@section('content')

    <section class="content">
        <form method="POST" action="{{ route("users.store") }}" id="form_submit">
            @csrf

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

                <div class="row clearfix">
                    <
                </div>
            </div>
        </form>
    </section>

@endsection

@section('styles')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
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

    </script>
@endsection
