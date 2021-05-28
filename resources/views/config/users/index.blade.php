@extends('layouts.app')
@section('title', 'Usuarios')

@section('content')

<section class="content">
    <div class="container-fluid">
        {{-- <div class="block-header">
            <h2>
                RECIBOS DE COBRO
                <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small>
            </h2>
        </div> --}}
        <div class="block-header">
            <ol class="breadcrumb">
                <li>
                    <a href="javascript:void(0);">
                        <i class="material-icons">settings</i> Configuraciones
                    </a>
                </li>
                <li class="active">
                    Usuarios
                </li>
            </ol>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Lista de Usuarios Registrados
                            {{-- <small>Description text here...</small> --}}
                        </h2>
                        <ul class="header-dropdown m-r-0">
                            <li>
                                <a href="{{ route('config.users.create') }}" data-toggle="tooltip" data-placement="auto"
                                    data-original-title="Nuevo"
                                    class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                                    <i class="material-icons">add_circle</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped table-hover dataTable js-exportable"
                                width="100%">
                                <thead class="bg-indigo">
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Estacion</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usuarios as $item)
                                    <tr>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route("config.users.edit", $item->id) }}"
                                                    class="btn btn-default btn-sm waves-effect" data-toggle="tooltip"
                                                    data-placement="auto" data-original-title="Detalles"><i
                                                        class="material-icons">edit</i>
                                                </a>
                                                <button type="button" onclick="DeleteRow({{ $item->id }})"
                                                    class="btn btn-default btn-sm waves-effect" data-toggle="tooltip"
                                                    data-placement="auto" data-original-title="Borrar"><i
                                                        class="material-icons">delete</i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>

@endsection

@section('styles')
<!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

<script>
    $(document).ready(function () {
        //Tooltip
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });

        $("#table").DataTable({
            language: table_es_lang,
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            columnDefs: [{
                targets:    5,
                sorting: false
            }],
            sorting: [
                [0, 'desc']
            ]
        })
    })

    function DeleteRow(id) {
        swal({
            title: "Confirmar",
            text: "Confirme eliminar el registro.",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#2b982b",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                url: `{{ url("cobranzas/relaciones/") }}/${id}`,
                dataType: 'JSON',
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                timeout: 10000,
                success: function (result) {
                    swal({
                        title: result.title,
                        text: result.text,
                        type: result.type,
                        showCancelButton: false,
                        closeOnConfirm: true
                    }, function () {
                        if (result.type == "success") window.location.href = result.goto
                    });
                },
                error: function (error) {
                    console.log(error.error)
                    swal(error.title, error.message, error.result);
                },
                statusCode: {
                    500: function () {
                        swal('Error en el proceso',
                            'Error al procesar los datos. Intente nuevamente', 'error')
                    }
                }
            })
        });
    }
</script>
@endsection
