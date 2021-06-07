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

            <div class="block-header">
                <ol class="breadcrumb">
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons">money</i> Cobranzas
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
                            <h2>
                                Lista de Recibos
                                {{-- <small>Description text here...</small> --}}
                            </h2>
                            <ul class="header-dropdown m-r-0">
                                <li>
                                    <button type="button" data-toggle="tooltip" data-placement="auto"
                                            data-original-title="Relacionar Recibos" id="btnModalRelacionar"
                                            class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                                        <i class="material-icons">assignment</i>
                                    </button>
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
                            <form action="{{ route('cobranzas.store') }}" method="post" id="submit_relacion">
                                @csrf()
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-hover dataTable js-exportable"
                                           width="100%">
                                        <thead class="bg-indigo">
                                        <tr>
                                            <th>Nro.</th>
                                            <th>Fecha</th>
                                            <th>Tipo Doc.</th>
                                            <th>Nro. Doc.</th>
                                            <th>Cod. Cliente</th>
                                            <th>Cliente</th>
                                            <th>Moneda</th>
                                            <th class="text-center">Monto<br>Documento</th>
                                            <th class="text-center">Monto<br>Recibo</th>
                                            <th class="text-center">Monto<br>Retenido</th>
                                            <th class="text-center">%<br>Descuento</th>
                                            <th>Vuelto</th>
                                            <th>Saldo</th>
                                            @if (Auth::user()->hasRole(["Admin", "Supervisor"]))
                                            <th>Realizado por</th>
                                            @endif
                                            <th>Opciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($recibos as $item)

                                            @php($nDecimals = ($item->TIPO_MONEDA == "VEF") ? 2 : 3)

                                            <tr>
                                                <td>
                                                    @if (Auth::user()->hasRole(["Admin", "Supervisor"]))
                                                    <input type="checkbox" id="md_checkbox_{{ $item->id }}"
                                                        class="filled-in chk-col-indigo" checked value="{{ $item->id }}"
                                                        name="recibos[]">
                                                    <label for="md_checkbox_{{ $item->id }}">
                                                        <b>{{ str_pad($item->id,"6","0",STR_PAD_LEFT) }}</b>
                                                    </label>
                                                    @else
                                                    <b>{{ $item->idZero }}</b>
                                                    <input type="hidden" name="recibos[]" value="{{ $item->id }}">
                                                    @endif
                                                </td>
                                                <td>{{ $item->FECHA->format("d/m/Y") }}</td>
                                                <td>{{ $item->tipoDocumento->DESCR }}</td>
                                                <td>{{ $item->NUMEDOCU }}</td>
                                                <td>{{ ($item->TIPO_DOC == "FA") ? $item->factura->CODICLIE : $item->notaEntrega->CODICLIE }}</td>
                                                <td>{{ ($item->TIPO_DOC == "FA") ? $item->factura->cliente->NOMBCLIE : $item->notaEntrega->cliente->NOMBCLIE }}</td>
                                                <td>{{ $item->TIPO_MONEDA }}</td>
                                                <td>{{number_format( $item->MONTO_DOC, $nDecimals, ".", "," ) }}</td>
                                                <td>{{number_format( $item->montoRecibido, $nDecimals, ".", "," ) }}</td>
                                                <td>{{number_format( $item->MONTO_RET, $nDecimals, ".", "," ) }}</td>
                                                <td>{{number_format( $item->PORC, 2) }}</td>
                                                <td>{{number_format( $item->VUELTO, $nDecimals, ".", "," ) }}</td>
                                                <td>
                                                    @if ($item->TIPO_MONEDA == "VEF")
                                                        {{number_format( $item->SALDO_DOC / $item->TASA_CAMB, $nDecimals, ".", "," ) }}
                                                    @else
                                                        {{number_format( $item->SALDO_DOC, $nDecimals, ".", "," ) }}
                                                    @endif
                                                </td>
                                                @if (Auth::user()->hasRole(["Admin", "Supervisor"]))
                                                <td>{{ $item->createdBy->name }}</td>
                                                @endif
                                                <td>
                                                    <div class="btn-group" role="group">
                                                         {{-- <a href="{{ route("recibos.edit", $item->id) }}"
                                                           class="btn btn-default btn-sm waves-effect"
                                                           data-toggle="tooltip" data-placement="auto"
                                                           data-original-title="Modificar"><i class="material-icons">edit</i>
                                                        </a> --}}
                                                        <a href="{{ route("recibos.show", $item->id) }}" target="_blank"
                                                           class="btn btn-default btn-sm waves-effect"
                                                           data-toggle="tooltip" data-placement="auto"
                                                           data-original-title="Detalles"><i class="material-icons">visibility</i>
                                                        </a>
                                                        @if ($item->TIPO_MONEDA == "USD")
                                                        <a href="{{ route("recibos.print", $item->id) }}" target="_blank"
                                                           class="btn btn-default btn-sm waves-effect"
                                                           data-toggle="tooltip" data-placement="auto"
                                                           data-original-title="Imprimir"><i class="material-icons">print</i>
                                                        </a>
                                                        @endif
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

                                <!-- Modal Small Size -->
                                <div class="modal fade" id="relacionModal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="smallModalLabel">Datos de los recibos a
                                                    relacionar</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <p><b>Tipo de relación</b></p>
                                                        <input name="tipo_moneda" type="radio" id="tipo_moneda_usd"
                                                               value="USD" class="tipo_moneda with-gap radio-col-indigo"
                                                               checked/>
                                                        <label for="tipo_moneda_usd">Dolares</label>

                                                        <input name="tipo_moneda" type="radio" id="tipo_moneda_vef"
                                                               value="VEF"
                                                               class="tipo_moneda with-gap radio-col-indigo"/>
                                                        <label for="tipo_moneda_vef">Bolivares</label>
                                                    </div>

                                                    <div class="col-xs-12">
                                                        <p><b>Comentarios</b></p>
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea name="comentario" id="comentario"
                                                                          class="form-control no-resize"
                                                                          rows="4" placeholder="..."></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link waves-effect"
                                                        onclick="RelacionarRecibos()">
                                                    PROCESAR
                                                </button>
                                                <button type="button" class="btn btn-link waves-effect"
                                                        data-dismiss="modal">CANCELAR
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
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
                    {targets: [7,8,9,10,11,12], className: "dt-body-right"},
                    {targets: {{ (Auth::user()->hasRole(["Admin", "Supervisor"])) ? 14 : 13 }}, sorting: false}
                ]
            })
            $("#btnModalRelacionar").click(function (e) {
                $("#relacionModal").modal("show")
            })
        })

        function RelacionarRecibos() {
            swal({
                title: "Confirmar",
                text: "Confirme realizar el proceso de relacion de los recibos seleccionados.",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#2b982b",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                const form = $("#submit_relacion")
                $.ajax({
                    url: $(form).attr('action'),
                    dataType: 'JSON',
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                    url: `{{ url("cobranzas/recibos/") }}/${id}`,
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
