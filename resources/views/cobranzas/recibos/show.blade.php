@extends('layouts.app')
@section('title', 'Recibos')

@section('content')

    <section class="content">
        <form method="POST" action="{{ route("recibos.update", $recibo->id) }}" id="form_submit">
            @csrf
            @method("PUT")

            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Recibo de cobro Nro. {{ $recibo->idZero }}
                                    {{-- <small>Different sizes and widths</small> --}}
                                </h2>
                            </div>
                            <div class="body">
                                {{-- <h2 class="card-inside-title">Floating Label Examples</h2> --}}
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <p><b>Moneda</b></p>
                                        <input type="radio" disabled
                                               class="tipo_moneda with-gap radio-col-indigo" {{ ($recibo->TIPO_MONEDA == "USD") ? "checked" : "" }}/>
                                        <label for="">Dolares</label>

                                        <input type="radio" disabled
                                               class="tipo_moneda with-gap radio-col-indigo" {{ ($recibo->TIPO_MONEDA == "VEF") ? "checked" : "" }}/>
                                        <label for="">Bolivares</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <p><b>Tipo de Pago</b></p>
                                        <input type="radio" {{ ($recibo->TIPO_PAGO == "T") ? "checked" : "" }} disabled
                                               class="tipo_pago with-gap radio-col-indigo"/>
                                        <label for="">Transferencia</label>

                                        <input type="radio" {{ ($recibo->TIPO_PAGO == "E") ? "checked" : "" }} disabled
                                               class="tipo_pago with-gap radio-col-indigo"/>
                                        <label for="">Efectivo</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <p><b>Tipo de Documento</b></p>
                                        <input type="radio" {{ ($recibo->TIPO_DOC == "FA") ? "checked" : "" }} disabled
                                               class="tipo_doc with-gap radio-col-indigo"/>
                                        <label for="tipo_doc_fa">Factura</label>

                                        <input type="radio" {{ ($recibo->TIPO_DOC == "NE") ? "checked" : "" }} disabled
                                               class="tipo_doc with-gap radio-col-indigo"/>
                                        <label for="tipo_doc_ne">Nota de Entrega</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" value="{{ $recibo->NUMEDOCU }}"
                                                       disabled>
                                                <label
                                                    class="form-label">Nro. {{ ($recibo->TIPO_DOC == "FA") ? "Factura" : "Nota de Entrega" }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="date" class="form-control"
                                                       value="{{ $recibo->FECHA->format("Y-m-d") }}" disabled>
                                                <label class="form-label">Fecha Documento</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control"
                                                       value="{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->CODICLIE : $recibo->notaEntrega->CODICLIE }}"
                                                       disabled>
                                                <label class="form-label">Codigo Cliente</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3" id="div_ret_iva">
                                        <p><b>Retencion de Iva</b></p>
                                        <div class="switch">
                                            <label>
                                                NO
                                                <input type="checkbox" id="ret_iva" name="ret_iva"><span
                                                    class="lever"></span>
                                                SI
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control"
                                                       value="{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->CODIRUTA : $recibo->notaEntrega->CODIRUTA }}"
                                                       disabled>
                                                <label class="form-label">Codigo Ruta</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control"
                                                       value="-Informacion no implementada-"
                                                       disabled>
                                                <label class="form-label">Ruta</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control"
                                                       value="{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->cliente->NOMBCLIE : $recibo->notaEntrega->cliente->NOMBCLIE }}"
                                                       disabled>
                                                <label class="form-label">Codigo Cliente</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto"
                                                       value="{{ $recibo->MONTO_DOC_VEF }}"
                                                       disabled>
                                                <label class="form-label">Monto Documento Bs.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto"
                                                       value="{{ $recibo->MONTO_DOC_USD }}"
                                                       disabled>
                                                <label class="form-label">Monto Documento $</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto"
                                                       value="{{ $recibo->TASA_CAMB }}"
                                                       disabled>
                                                <label class="form-label">Tasa de Cambio</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto"
                                                       value="{{ $recibo->VUELTO }}"
                                                       disabled>
                                                <label class="form-label">Vuelto</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto"
                                                       value="{{ $recibo->SALDO_CLI }}"
                                                       disabled>
                                                <label class="form-label">Saldo de Cliente</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 table-responsive" style="margin-bottom: 0px">
                                        <table id="table_montos" class="table table-bordered table-striped table-hover"
                                               width="100%">
                                            <thead>
                                            <tr>
                                                @if ($recibo->TIPO_PAGO == "E")
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-center">Denominacion</th>
                                                @else
                                                    <th class="text-center">Referencia</th>
                                                @endif
                                                <th class="text-center">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($recibo->reciboDet as $item)
                                                @if ($recibo->TIPO_PAGO == "E")
                                                    <tr>
                                                        <td>{{ number_format($item->CANTIDAD, 2, ".", ",") }}</td>
                                                        <td>{{ number_format($item->DENOMINACION, 2, ".", ",") }}</td>
                                                        <td class="text-right">{{ number_format($item->CANTIDAD * $item->DENOMINACION, 2, ".", ",") }}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>{{ $item->REFERENCIA }}</td>
                                                        <td class="text-right">{{ number_format($item->MONTO, 2, ".", ",") }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                @if ($recibo->TIPO_PAGO == "E")
                                                    <td class="font-bold text-right" colspan="2">Total</td>
                                                    <td class="text-right font-bold">{{ number_format($recibo->monto_recibido, 2, ".", ",") }}</td>
                                                @else
                                                    <td class="font-bold text-right">Total</td>
                                                    <td class="text-right font-bold">{{ number_format($recibo->monto_recibido, 2, ".", ",") }}</td>
                                                @endif
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

        jQuery.fn.dataTable.Api.register('sum()', function () {
            return this.flatten().reduce(function (a, b) {
                if (typeof a === 'string') {
                    a = a.replace(/[^\d.-]/g, '') * 1;
                }
                if (typeof b === 'string') {
                    b = b.replace(/[^\d.-]/g, '') * 1;
                }

                return a + b;
            }, 0);
        });

    </script>

    <script>
        var table_montos

        $(document).ready(function () {
            table_montos = $("#table_montos").DataTable({
                language: table_es_lang,
                info: false,
                paging: false,
                searching: false,
                ordering: false
            })

            //Tooltip
            $('body').tooltip({
                selector: '[data-toggle="tooltip"]'
            });

            //Input Mask
            $(".monto").inputmask({
                alias: 'decimal',
                groupSeparator: '.',
                autoGroup: true,
                removeMaskOnSubmit: true,
            });
            $(".cant").inputmask({
                alias: 'integer',
                groupSeparator: '.',
                autoGroup: true,
            });
        })

    </script>
@endsection
