@extends('layouts.app')
@section('title', 'Relacion de Recibos')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <ol class="breadcrumb">
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons">money</i> Cobranzas
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            Relaciones
                        </a>
                    </li>
                    <li class="active">
                        Recibos
                    </li>
                </ol>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Relación Nro. <b>{{ $relacion->idZero }}</b></h2>
                            <h2>Moneda: <b>{{ $relacion->TIPO_MONEDA }}</b></h2>
                            <h2>Realizado por: <b>{{ $relacion->createdBy->name }}</b></h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-hover dataTable js-exportable"
                                       width="100%">
                                    <thead class="bg-indigo">
                                    <tr>
                                        <th>Nro.</th>
                                        <th>Fecha</th>
                                        <th>Tipo Documento</th>
                                        <th>Cod. Cliente</th>
                                        <th>Cliente</th>
                                        <th>Nro. Documento</th>
                                        <th class="text-center">Monto<br>Documento</th>
                                        <th class="text-center">Monto<br>Recibo</th>
                                        <th class="text-center">Monto<br>Retenido</th>
                                        <th class="text-center">%<br>Descuento</th>
                                        <th>Saldo</th>
                                        <th>Vuelto</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($relacion->recibos as $item)

                                        @php($nDecimals = ($item->TIPO_MONEDA == "VEF") ? 2 : 3)

                                        <tr>
                                            <td><b>{{ $item->idZero }}</b></td>
                                            <td>{{ $item->FECHA->format("d/m/Y") }}</td>
                                            <td>{{ ($item->TIPO_DOC == "FA") ? "Factura" : "Nota de Entrega" }}</td>
                                            <td>{{ ($item->TIPO_DOC == "FA") ? $item->factura->CODICLIE : $item->notaEntrega->CODICLIE }}</td>
                                            <td>{{ ($item->TIPO_DOC == "FA") ? $item->factura->cliente->NOMBCLIE : $item->notaEntrega->cliente->NOMBCLIE }}</td>
                                            <td>{{ $item->NUMEDOCU }}</td>
                                            <td>{{number_format( $item->MONTO_DOC, $nDecimals, ".", "," ) }}</td>
                                            <td>{{number_format( $item->montoRecibido, $nDecimals, ".", "," ) }}</td>
                                            <td>{{number_format( $item->MONTO_RET, $nDecimals, ".", "," ) }}</td>
                                            <td>{{number_format( $item->PORC, $nDecimals, ".", "," ) }}</td>
                                            <td>{{number_format( $item->SALDO_DOC, $nDecimals, ".", "," ) }}</td>
                                            <td>
                                                @if ($item->VUELTO >0)
                                                    @if (!$item->VUELTO_ENT)
                                                        <a href="javascript:void(0)" data-toggle="tooltip" onclick="EntregarVuelto({{ $item->id }})"
                                                           data-placement="auto" data-original-title="Procesar Entrega">
                                                            {{number_format( $item->VUELTO, $nDecimals, ".", "," ) }}
                                                        </a>
                                                    @else
                                                        <span data-toggle="tooltip" data-placement="auto"
                                                              data-original-title="Vuelto Entregado">{{number_format( $item->VUELTO, $nDecimals, ".", "," ) }}</span>
                                                    @endif
                                                @else
                                                    {{number_format( $item->VUELTO, $nDecimals, ".", "," ) }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route("recibos.show", $item->id) }}"
                                                       class="btn btn-default btn-sm waves-effect"
                                                       data-toggle="tooltip" data-placement="auto"
                                                       data-original-title="Detalles"><i class="material-icons">visibility</i>
                                                    </a>
                                                    <a href="{{ route("recibos.print", $item->id) }}" target="_blank"
                                                       class="btn btn-default btn-sm waves-effect"
                                                       data-toggle="tooltip" data-placement="auto"
                                                       data-original-title="Imprimir"><i class="material-icons">print</i>
                                                    </a>
                                                    @can('recibos.delete')
                                                    <button type="button" onclick="DeleteRow({{ $item->id }})"
                                                            class="btn btn-default btn-sm waves-effect"
                                                            data-toggle="tooltip" data-placement="auto"
                                                            data-original-title="Borrar"><i
                                                            class="material-icons">delete</i>
                                                    </button>
                                                    @endcan
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
    <!-- tooltips-popovers -->
    <script src="{{ asset('js/pages/ui/tooltips-popovers.js') }}"></script>

    <script>
        var table
        $(document).ready(function () {
            //Tooltip
            $('body').tooltip({
                selector: '[data-toggle="tooltip"]'
            });

            table = $("#table").DataTable({
                language: table_es_lang,
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                sorting: [
                    [0, 'desc']
                ],
                columnDefs: [
                    {targets: [6, 7, 8, 9, 10, 11], className: "dt-body-right"},
                    {targets: 12, sorting: false}
                ]
            })
            $("#btnModalRelacionar").click(function (e) {
                $("#relacionModal").modal("show")
            })
        })

        function DeleteRow(id)
        {
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
                    url: `{{ url("cobranzas/relaciones/delete-recibo/") }}/${id}`,
                    dataType: 'JSON',
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                            swal('Error en el proceso', 'Error al procesar los datos. Intente nuevamente', 'error')
                        }
                    }
                })
            });
        }

        function EntregarVuelto(id)
        {
            swal({
                title: "Confirmar",
                text: "Confirme registrar la entrega del vuelto.",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#2b982b",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                $.ajax({
                    url: `{{ url("cobranzas/recibos/marcar-vuelto/") }}/${id}`,
                    dataType: 'JSON',
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                            swal('Error en el proceso', 'Error al procesar los datos. Intente nuevamente', 'error')
                        }
                    }
                })
            });
        }

    </script>
@endsection
