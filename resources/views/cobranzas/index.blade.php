@extends('layouts.app')
@section('title', 'Cobranzas')

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
                        <i class="material-icons">money</i> Cobranzas
                    </a>
                </li>
                <li class="active">
                    Relaciones
                </li>
            </ol>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Lista de Relaciones
                            {{-- <small>Description text here...</small> --}}
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table id="table"
                                class="table table-striped table-hover dataTable js-exportable"
                                width="100%">
                                <thead class="bg-indigo">
                                    <tr>
                                        <th>Nro.</th>
                                        <th>Fecha</th>
                                        <th>Tipo de Relacion</th>
                                        <th>Comentario</th>
                                        <th>Realizado por</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($relaciones as $item)
                                    <tr>
                                        <td><b>{{ $item->idzero }}</b></td>
                                        <td>{{ $item->FECHA->format("d/m/Y") }}</td>
                                        <td>{{ $item->TIPO_MONEDA }}</td>
                                        <td>{{ $item->COMENTARIO }}</td>
                                        <td>{{ $item->createdBy->name }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route("cobranzas.show", $item->id) }}"
                                                   class="btn btn-default btn-sm waves-effect"
                                                   data-toggle="tooltip" data-placement="auto"
                                                   data-original-title="Detalles"><i class="material-icons">visibility</i>
                                                </a>
                                                <a href="{{ route("cobranzas.print", $item->id) }}" target="_blank"
                                                   class="btn btn-default btn-sm waves-effect"
                                                   data-toggle="tooltip" data-placement="auto"
                                                   data-original-title="Detalles"><i class="material-icons">print</i>
                                                </a>
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
        $("#table").DataTable({
            language: table_es_lang,
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            columnDefs: [
                {targets: 5, sorting: false}
            ]
        })
    })
</script>
@endsection
