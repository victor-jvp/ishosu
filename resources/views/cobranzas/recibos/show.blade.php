@extends('layouts.app')
@section('title', 'Recibo '.$recibo->idZero)

@section('content')

    @php
        $nDecimals = ($recibo->TIPO_MONEDA == "USD") ? 3 : 2;
    @endphp

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
                            Recibos
                        </a>
                    </li>
                    <li class="active">
                        Ver
                    </li>
                </ol>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Recibo de cobro Nro. {{ $recibo->idZero }}
                                {{-- <small>Different sizes and widths</small> --}}
                            </h2>
                            <ul class="header-dropdown m-r-0">
                                <li>
                                    <a href="{{ route('recibos.print', $recibo->id) }}" data-toggle="tooltip"
                                        data-placement="auto" data-original-title="Imprimir Recibo" target="_blank"
                                        class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                                        <i class="material-icons">print</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            {{-- <h2 class="card-inside-title">Floating Label Examples</h2> --}}
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <p><b>Tipo de Documento</b></p>
                                    <input type="radio" {{ ($recibo->TIPO_DOC == "FA") ? "checked" : "" }} disabled
                                           class="tipo_doc with-gap radio-col-indigo"/>
                                    <label for="tipo_doc_fa">Factura</label>

                                    <input type="radio" {{ ($recibo->TIPO_DOC == "NE") ? "checked" : "" }} disabled
                                           class="tipo_doc with-gap radio-col-indigo"/>
                                    <label for="tipo_doc_ne">Nota de Entrega</label>

                                    <input type="radio" {{ ($recibo->TIPO_DOC == "ND") ? "checked" : "" }} disabled
                                           class="tipo_doc with-gap radio-col-indigo"/>
                                    <label for="tipo_doc_nd">Nota de Débito</label>
                                </div>

                                <div class="col-sm-4">

                                    <p><b>Moneda</b></p>
                                    <input type="radio" disabled id="tipo_moneda_usd"
                                           class="tipo_moneda with-gap radio-col-indigo" {{ ($recibo->TIPO_MONEDA == "USD") ? "checked" : "" }}/>
                                    <label for="">Dolares</label>

                                    <input type="radio" disabled id="tipo_moneda_vef"
                                           class="tipo_moneda with-gap radio-col-indigo" {{ ($recibo->TIPO_MONEDA == "VEF") ? "checked" : "" }}/>
                                    <label for="">Bolivares</label>
                                </div>

                                <div class="col-sm-4">
                                    <p><b>Tipo de Pago</b></p>
                                    <input type="radio" {{ ($recibo->TIPO_PAGO == "E") ? "checked" : "" }} disabled
                                           class="tipo_pago with-gap radio-col-indigo"/>
                                    <label for="">Efectivo</label>


                                    <input type="radio" {{ ($recibo->TIPO_PAGO == "T") ? "checked" : "" }} disabled
                                           class="tipo_pago with-gap radio-col-indigo"/>
                                    <label for="">Transferencia</label>
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
                                                   value="{{ $recibo->CODICLIE ?? '' }}"
                                                   disabled>
                                            <label class="form-label">Codigo Cliente</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="div_ret_iva">
                                    <p><b>Es agente de retención</b></p>
                                    <div class="switch">
                                        <label>
                                            NO
                                            <input type="checkbox" id="ret_iva" disabled><span
                                                class="lever switch-col-blue"></span>
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
                                                   value="{{ $recibo->CODIRUTA ?? '' }}"
                                                   disabled>
                                            <label class="form-label">Codigo Ruta</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   value="{{ $recibo->NOMBVEND ?? '' }}"
                                                   disabled>
                                            <label class="form-label">Vendedor</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   value="{{ $recibo->NOMBCLIE ?? '' }}"
                                                   disabled>
                                            <label class="form-label">Cliente</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <table class="table table-bordered table-hover table-condensed" style="width: 100%">
                                        <thead class="bg-grey">
                                        <th class="text-center">Datos del Documento</th>
                                        <th class="text-center" style="width: 30%;">Bs.</th>
                                        <th class="text-center" style="width: 30%;">$</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th class="text-right">Subtotal</th>
                                            <td class="text-right" style="padding-bottom: 0px">
                                                <div class="form-group" style="margin-bottom: 0px">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto"
                                                               id="subtotal_vef" value="0" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right" style="padding-bottom: 0px">
                                                <div class="form-group" style="margin-bottom: 0px">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto"
                                                               id="subtotal_usd" value="0" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Descuento</th>
                                            <td class="text-right" style="padding-bottom: 0px">
                                                <div class="form-group" style="margin-bottom: 0px">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto"
                                                               id="descuento_vef" value="0" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right" style="padding-bottom: 0px">
                                                <div class="form-group" style="margin-bottom: 0px">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto"
                                                               id="descuento_usd" value="0" disabled>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Exento</th>
                                            <td class="text-right" style="padding-bottom: 0px">
                                                <div class="form-group" style="margin-bottom: 0px">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto"
                                                               id="exento_vef" value="0" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right" style="padding-bottom: 0px">
                                                <div class="form-group" style="margin-bottom: 0px">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto"
                                                               id="exento_usd" value="0" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Base Imponible</th>
                                            <td class="text-right" style="padding-bottom: 0px">
                                                <div class="form-group" style="margin-bottom: 0px">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto" id="base_vef"
                                                               value="0" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right" style="padding-bottom: 0px">
                                                <div class="form-group" style="margin-bottom: 0px">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto" id="base_usd"
                                                               value="0" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Iva 16%</th>
                                            <td class="text-right" style="padding-bottom: 0px">
                                                <div class="form-group" style="margin-bottom: 0px">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto" id="iva_vef"
                                                               value="0" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right" style="padding-bottom: 0px">
                                                <div class="form-group" style="margin-bottom: 0px">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto" id="iva_usd"
                                                               value="0" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Total</th>
                                            <td class="text-right" style="padding-bottom: 0px">
                                                <div class="form-group" style="margin-bottom: 0px">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto" id="total_vef"
                                                               value="0" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right" style="padding-bottom: 0px">
                                                <div class="form-group" style="margin-bottom: 0px">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto" id="total_usd"
                                                               value="0" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-6" style="margin-bottom: -20px">

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p><b>Tasa de Cambio Doc.</b></p>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control monto" id="tasa_cambio"
                                                           name="tasa_cambio" disabled
                                                           value="{{ number_format($recibo->TASA_CAMB, $nDecimals) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <p><b>Total Cobrado Doc.</b></p>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control monto" id="total_cobrado"
                                                           name="total_cobrado" disabled
                                                           value="{{ number_format(($recibo->MONTO_DOC - $recibo->MONTO_RET), $nDecimals) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p><b>Total a Cobrar</b></p>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control monto" id="total_a_cobrar"
                                                           name="total_a_cobrar" disabled
                                                           value="{{ number_format($recibo->MONTO_DOC - $recibo->MONTO_RET, $nDecimals) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <p><b>Tipo de cobro</b></p>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select class="form-control show-tick"
                                                            data-container="body" data-title="Seleccione..."
                                                            disabled id="tipo_cobro">
                                                        <option
                                                            {{ $recibo->TIPO_COBRO == "total" ? "selected" : "" }} value="total">
                                                            Total del Documento
                                                        </option>
                                                        <option
                                                            {{ $recibo->TIPO_COBRO == "desc" ? "selected" : "" }}
                                                            value="desc">
                                                            Descuento
                                                        </option>
                                                        <option
                                                            {{ $recibo->TIPO_COBRO == "espec" ? "selected" : "" }}
                                                            value="espec">
                                                            Negociación Especial
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <p><b>%</b></p>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control monto" id="porcentaje"
                                                           name="porcentaje" value="{{ $recibo->PORC }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <p><b>Monto Desc.</b></p>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control monto" id="monto_desc"
                                                           name="monto_desc"
                                                           value="{{ number_format($recibo->MONTO_DESC, $nDecimals) }}"
                                                           readonly
                                                           value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4" style="margin-bottom: 0px">
                                            <p><b>Total Monto Ret.</b></p>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control monto" id="monto_ret"
                                                           name="monto_ret" disabled
                                                           value="{{ number_format($recibo->MONTO_RET, $nDecimals) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4" style="margin-bottom: 0px">
                                            <input type="checkbox" id="chk_monto_ret" class="filled-in chk-col-blue"
                                                   disabled {{ ($recibo->MONTO_RET > 0) ? "checked" : "" }}>
                                            <label for="chk_monto_ret">Aplicar Monto de Retención</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4" style="margin-bottom: 0px">
                                            <p><b>Saldo Doc.</b></p>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control monto" id="saldo_doc"
                                                           name="saldo_doc" disabled
                                                           value="{{ number_format( $recibo->SALDO_DOC, $nDecimals) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4" style="margin-bottom: 0px">
                                            <p><b>Vuelto</b></p>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control monto" id="vuelto"
                                                           name="vuelto"
                                                           value="{{ number_format($recibo->VUELTO, $nDecimals) }}"
                                                           disabled>
                                                </div>
                                            </div>
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
                                                <th class="text-center">Banco Emisor</th>
                                                <th class="text-center">Banco Receptor</th>
                                                <th class="text-center">Fecha de Pago</th>
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
                                                    <td class="text-right">{{ number_format($item->CANTIDAD * $item->DENOMINACION, $nDecimals, ".", ",") }}</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td class="text-center">{{ $item->bank_e->NOMBRE }}</td>
                                                    <td class="text-center">{{ $item->bank_r->NOMBBANC }}</td>
                                                    <td class="text-center">{{ $item->FECHA_PAGO->format("d/m/Y") }}</td>
                                                    <td class="text-center">{{ $item->REFERENCIA }}</td>
                                                    <td class="text-right">{{ number_format($item->MONTO, $nDecimals, ".", ",") }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            @if ($recibo->TIPO_PAGO == "E")
                                                <td class="font-bold text-right" colspan="2">Total</td>
                                                <td class="text-right font-bold">{{ number_format($recibo->monto_recibido, $nDecimals, ".", ",") }}</td>
                                            @else
                                                <td class="font-bold text-right" colspan="4">Total</td>
                                                <td class="text-right font-bold">{{ number_format($recibo->monto_recibido, $nDecimals, ".", ",") }}</td>
                                            @endif
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h2 class="card-inside-title">Comentario</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                                <textarea rows="1" class="form-control no-resize auto-growth" disabled
                                                          placeholder="...">{{ $recibo->COMENTARIO ?? "" }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
    <!-- Autosize Plugin Js -->
    <script src="{{ asset('plugins/autosize/autosize.js') }}"></script>

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
            //Textarea auto growth
            autosize($('textarea.auto-growth'));

            LoadDocData()
        })

        function toTrunc(value, n) {
            return Math.floor(value * Math.pow(10, n)) / (Math.pow(10, n));
        }

        function LoadDocData() {
            $.ajax({
                url: "{{ route('documentos.ajaxSearchById') }}",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    id: "{{ $recibo->NUMEDOCU }}",
                    tipo: "{{ $recibo->TIPO_DOC }}"
                },

                success: (result) => {
                    let resp = result.results[0]

                    $("#chk_monto_ret").prop("checked", "{{ ($recibo->MONTO_RET > 0) ? true : false }}")

                    $("#fecha_documento").val(moment(resp.FECHA).format("YYYY-MM-DD"))
                    //Fill doc table data

                    const totalIva = resp.IMPUBRUT
                    const totalBrut = resp.TOTABRUT
                    const exento = (resp.TIPODOCU == "ND") ? resp.EXENTO : parseFloat(resp.TOTADOCU - resp.TOTABRUT)
                    const totalDocu = (resp.TIPODOCU == "ND") ? resp.EXENTO + resp.TOTABRUT : resp.TOTADOCU
                    const baseImp = totalDocu - totalIva
                    const montoRet = totalIva * (75 / 100);
                    const descuento = (resp.TIPODOCU != "ND") ? resp.DESCUENTOG : 0
                    let cambdol = 0;
                    if (resp.TIPODOCU == "ND") {
                        if (resp.TIPOAFEC == "FA") {
                            cambDol = resp.fa_afectada.CAMBDOL
                        } else {
                            cambDol = resp.ne_afectada.CAMBDOL
                        }
                    } else {
                        cambDol = resp.CAMBDOL
                    }

                    $("#subtotal_vef").val(totalBrut)
                    $("#subtotal_usd").val((totalBrut / cambDol).toFixed(3))
                    $("#descuento_vef").val(descuento)
                    $("#descuento_usd").val((descuento / cambDol).toFixed(3))
                    $("#exento_vef").val(exento.toFixed(2))
                    $("#exento_usd").val((exento / cambDol).toFixed(3))
                    $("#base_vef").val(baseImp.toFixed(2))
                    $("#base_usd").val((baseImp / cambDol).toFixed(3))
                    $("#iva_vef").val(totalIva)
                    $("#iva_usd").val((totalIva / cambDol, 3).toFixed(3))
                    $("#total_vef").val(totalDocu.toFixed(2))
                    $("#total_usd").val((totalDocu / cambDol).toFixed(3))

                    // $("#monto_doc_vef").val()
                    // $("#tasa_cambio").val(cambDol)

                    // const moneda = ($("#tipo_moneda_usd").prop("checked")) ? "usd" : "vef"
                    // total_cobrado_usd = resp.total_cobrado
                    // total_cobrado_vef = resp.total_cobrado * resp.CAMBDOL

                    // if (moneda == "usd")
                    // {
                    //     $("#total_cobrado").val(toTrunc(total_cobrado_usd, 3))
                    // }else{
                    //     $("#total_cobrado").val(total_cobrado_vef.toFixed(2))
                    // }

                    $("#ret_iva").prop("checked", resp.cliente.AGENTERET)

                    // UpdateMontos()
                }
            })
        }

        function UpdateMontos() {
            let vuelto = parseFloat($("#vuelto").inputmask('unmaskedvalue') ?? 0)
            const total_recibido = parseFloat(table_montos.column(2).data().sum())
            $("#total_recibido").html(total_recibido.toFixed(2))

            /* const total_cobrado = parseFloat( $("#total_cobrado").inputmask('unmaskedvalue') )
            total_a_cobrar = parseFloat($("#total_a_cobrar").inputmask('unmaskedvalue'))

            let saldo_doc = 0

            if ($("#chk_monto_ret").prop("checked")) {
            const monto_ret = parseFloat($("#monto_ret").inputmask('unmaskedvalue') ?? 0)
                saldo_doc = parseFloat(total_a_cobrar  - total_recibido + vuelto - monto_ret)
            } else {
                saldo_doc = parseFloat(total_a_cobrar  - total_recibido + vuelto)
            }

            const moneda = ($("#tipo_moneda_usd").prop("checked")) ? "usd" : "vef"
            if (moneda == "usd") {
                $("#saldo_doc").val( toTrunc(saldo_doc, 3) )
            }else{
                $("#saldo_doc").val( saldo_doc.toFixed(2) )
            } */

            if ($("#tipo_doc_ne").prop("checked")) { // Si es nota de entrega calcular la tasa de cambio
                const tasa_camb = parseFloat($("#total_vef").inputmask('unmaskedvalue') ?? 0) / total_recibido
                // console.log(monto_factura, total_recibido, tasa_camb)
                $("#tasa_cambio").val(tasa_camb.toFixed(2))
            }
        }

    </script>
@endsection
