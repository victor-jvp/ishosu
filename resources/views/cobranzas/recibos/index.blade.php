@extends('layouts.app')
@section('title', 'Recibos')

@section('content')

<section class="content">
    <div class="container-fluid">
        {{-- <div class="block-header">
            <h2>
                RECIBOS DE COBRO
                <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small>
            </h2>
        </div> --}}

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Lista de Recibos
                            {{-- <small>Description text here...</small> --}}
                        </h2>
                        <ul class="header-dropdown m-r-0">
                            <li>
                                <a href="{{ route('cobranzas.create') }}" data-toggle="tooltip" data-placement="auto"
                                   data-original-title="Relacionar Recibos"
                                   class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                                    <i class="material-icons">assignment</i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('recibos.create') }}" data-toggle="tooltip" data-placement="auto"
                                    data-original-title="Nuevo Recibo"
                                    class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                                    <i class="material-icons">add_circle</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped table-hover dataTable js-exportable" width="100%">
                                <thead class="bg-indigo">
                                    <tr>
                                        <th>Nro.</th>
                                        <th>Fecha</th>
                                        <th>Tipo Documento</th>
                                        <th>Cod. Cliente</th>
                                        <th>Cliente</th>
                                        <th>Nro. Documento</th>
                                        <th>Monto Documento</th>
                                        <th>Monto Recibido</th>
                                        <th>Realizado por</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($recibos as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->FECHA->format("d/m/Y") }}</td>
                                        <td>{{ $item->TIPO_DOC }}</td>
                                        <td>{{ $item->factura->CODICLIE }}</td>
                                        <td>{{ $item->factura->cliente->NOMBCLIE }}</td>
                                        <td>{{ $item->NUMEDOCU }}</td>
                                        <td>{{number_format( ($item->TIPO_MONEDA == "usd") ? $item->MONTO_DOC_USD: $item->MONTO_DOC_VEF, 2, ".", "," ) }}</td>
                                        <td>{{number_format( $item->montoRecibido, 2, ".", "," ) }}</td>
                                        <td>{{ $item->createdBy->name }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route("recibos.edit", $item->id) }}" class="btn btn-default btn-sm waves-effect"
                                                       data-toggle="tooltip" data-placement="auto"
                                                       data-original-title="Detalles"><i class="material-icons">visibility</i>
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
<link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endsection

@section('scripts')
<!-- Jquery DataTable Plugin Js -->
<script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<!-- tooltips-popovers -->
<script src="../../js/pages/ui/tooltips-popovers.js"></script>

<script>
    $(document).ready(function(){
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
            sorting: [
                [0, 'desc']
            ]
        })
    })
</script>
@endsection
