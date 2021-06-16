@extends('layouts.app')
@section('title', 'Nuevo Recibo')

@section('content')

    <section class="content">
        <form method="POST" action="{{ route("recibos.store") }}" id="form_submit">
            @csrf

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
                            Nuevo
                        </li>
                    </ol>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Registrar Recibo
                                    {{-- <small>Different sizes and widths</small> --}}
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
                                {{-- <h2 class="card-inside-title">Floating Label Examples</h2> --}}
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <p><b>Tipo de Documento</b></p>
                                        <input name="tipo_doc" type="radio" id="tipo_doc_fa" value="FA"
                                               class="tipo_doc with-gap radio-col-indigo" checked/>
                                        <label for="tipo_doc_fa">Factura</label>

                                        <input name="tipo_doc" type="radio" id="tipo_doc_ne" value="NE"
                                               class="tipo_doc with-gap radio-col-indigo"/>
                                        <label for="tipo_doc_ne">Nota de Entrega</label>

                                        <input name="tipo_doc" type="radio" id="tipo_doc_nd" value="ND"
                                               class="tipo_doc with-gap radio-col-indigo"/>
                                        <label for="tipo_doc_nd">Nota de Débito</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <p><b>Moneda</b></p>
                                        <input name="tipo_moneda" type="radio" id="tipo_moneda_usd" value="USD"
                                               class="tipo_moneda with-gap radio-col-indigo" checked/>
                                        <label for="tipo_moneda_usd">Dolares</label>

                                        <input name="tipo_moneda" type="radio" id="tipo_moneda_vef" value="VEF"
                                               class="tipo_moneda with-gap radio-col-indigo"/>
                                        <label for="tipo_moneda_vef">Bolivares</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <p><b>Tipo de Pago</b></p>
                                        <input name="tipo_pago" type="radio" id="tipo_pago_efec" value="E"
                                               class="tipo_pago with-gap radio-col-indigo" checked/>
                                        <label for="tipo_pago_efec">Efectivo</label>

                                        <input name="tipo_pago" type="radio" id="tipo_pago_tran" value="T"
                                               class="tipo_pago with-gap radio-col-indigo"/>
                                        <label for="tipo_pago_tran">Transferencia</label>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <p><b>Nro. Documento</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control ms" required name="nro_documento"
                                                        id="nro_documento">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <p><b>Fecha Documento</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="date" class="form-control" id="fecha_documento" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <p><b>Codigo Cliente</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="id_cliente"
                                                       name="id_cliente"
                                                       readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3" id="div_ret_iva">
                                        <p><b>Es Agente de Retencion</b></p>
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
                                        <p><b>Codigo Ruta</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="id_ruta" name="id_ruta" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <p><b>Vendedor</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="vendedor" readonly name="vendedor">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <p><b>Cliente</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="cliente" readonly name="cliente">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <table class="table table-bordered table-hover table-condensed"
                                               style="width: 100%">
                                            <thead class="bg-grey">
                                            <th class="text-center" width="20%">Datos del Documento</th>
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
                                    <div class="col-sm-7" style="margin-bottom: -20px">

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p><b>Tasa de Cambio Doc.</b></p>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto" id="tasa_cambio"
                                                               name="tasa_cambio" value="0" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <p><b>Tipo de cobro</b></p>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="hidden" name="tipo_cobro" id="h_tipo_cobro">
                                                        <select class="form-control show-tick" required
                                                                data-container="body" data-title="Seleccione..." id="tipo_cobro">
                                                            <option value="total">Total del Documento</option>
                                                            <option value="desc">Descuento</option>
                                                            <option value="espec">Negociación Especial</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p><b>Total a Cobrar</b></p>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto"
                                                               id="total_a_cobrar"
                                                               name="total_a_cobrar" readonly value="0">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <p><b>%</b></p>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto" id="porcentaje"
                                                               name="porcentaje" value="0" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <p><b>Monto Desc.</b></p>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto" id="monto_desc"
                                                               name="monto_desc" readonly value="0">
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
                                                               name="monto_ret" readonly value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" style="margin-bottom: 0px">
                                                <input type="checkbox" id="chk_monto_ret" class="filled-in chk-col-blue"
                                                       disabled>
                                                <label for="chk_monto_ret">Aplicar Monto de Retención</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4" style="margin-bottom: 0px">
                                                <p><b>Saldo Doc.</b></p>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto" id="saldo_doc"
                                                               name="saldo_doc" readonly value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" style="margin-bottom: 0px">
                                                <p><b>Vuelto</b></p>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control monto" id="vuelto"
                                                               name="vuelto" value="0">
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
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Denominacion</th>
                                                <th class="text-center">Banco Emisor</th>
                                                <th class="text-center">Banco Receptor</th>
                                                <th class="text-center">Fecha de Pago</th>
                                                <th class="text-center">Referencia</th>
                                                <th class="text-center">Total Recibo</th>
                                                <th>Opciones</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                            <tr>
                                                <td class="font-bold" colspan="6">Total</td>
                                                <td class="text-right font-bold" id="total_recibido">0.00</td>
                                                <td></td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="row" id="fields_efectivo">
                                    <div class="col-sm-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto" id="cant_billetes">
                                                <label class="form-label">Cantidad</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="form-control show-tick dropup" data-live-search="true"
                                                data-dropup-auto="false"
                                                data-title="Denominación" id="denominacion">
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" onclick="AddBilletes()"
                                                class="btn btn-primary btn-circle-lg waves-effect waves-circle waves-float"
                                                data-toggle="tooltip" data-placement="auto"
                                                data-original-title="Agregar">
                                            <i class="material-icons">add_circle</i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row" id="fields_transferencia">
                                    <div class="col-sm-4">
                                        <select class="form-control show-tick dropup " data-live-search="true"
                                                data-dropup-auto="false" data-container="body" data-size="10"
                                                data-title="Banco Emisor" id="banco_e">
                                            @foreach ($banks_e as $item)
                                                <option data-subtext="{{ $item->CODIGO }}" value="{{ $item->CODIGO }}">
                                                    {{ $item->NOMBRE }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control show-tick dropup" data-live-search="true"
                                                data-dropup-auto="false" data-container="body" data-size="10"
                                                data-title="Banco Receptor" id="banco_r">
                                            @foreach ($banks_r as $item)
                                                <option data-subtext="{{ $item->CODIBANC }}" value="{{ $item->CODIBANC }}">
                                                    {{ $item->NOMBBANC }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="date" class="form-control" id="fecha_pago"
                                                       value="{{ date("Y-m-d") }}">
                                                <label class="form-label">Fecha del Pago</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="referencia">
                                                <label class="form-label">Referencia</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto" id="monto_trans">
                                                <label class="form-label">Monto Recibido</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" onclick="AddTransferencia()"
                                                class="btn btn-primary btn-circle-lg waves-effect waves-circle waves-float"
                                                data-toggle="tooltip" data-placement="auto"
                                                data-original-title="Agregar">
                                            <i class="material-icons">add_circle</i>
                                        </button>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <h2 class="card-inside-title">Comentario</h2>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="1" class="form-control no-resize auto-growth" name="comentario"
                                                          placeholder="..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 text-right">
                                        <button type="submit" data-toggle="tooltip" data-placement="auto"
                                                data-original-title="Guardar"
                                                class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                                            <i class="material-icons">save</i>
                                        </button>
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
    <!-- Select2 Css -->
    <link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <!-- Select Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- Select2 Plugin Js -->
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/i18n/es.js') }}"></script>

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
        var dolares = "{{ $dolares }}"
        var bolivares = "{{ $bolivares }}"
        var table_montos
        var simbolo
        var total_a_cobrar = 0

        $(document).ready(function () {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            table_montos = $("#table_montos").DataTable({
                language: table_es_lang,
                info: false,
                paging: false,
                searching: false,
                ordering: false,
                columnDefs: [{
                    targets: 6,
                    className: "dt-body-right"
                },
                    {
                        targets: [0, 1],
                        visible: false,
                        className: "dt-center"
                    },
                    {
                        targets: 7,
                        width: "10%"
                    }
                ]
            })

            $(".tipo_moneda").change(function (e) {
                UpdateDenominacion(e)
                UpdateTipoCobro()
                UpdateTotalACobrar()
                UpdateMontos()
            })

            $(".tipo_doc").change(function (e) {
                ChangeTipoDoc()
                UpdateMontos()
            })

            $(".tipo_pago").change(function (e) {
                ChangeTipoPago()
                UpdateMontos()
            })

            $("#tipo_cobro").on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                UpdateTipoCobro($(this).val())
                $("#h_tipo_cobro").val($(this).val())
            })

            $("#vuelto").change(function (e) {
                UpdateMontos()
            })

            $("#porcentaje").change(function (e) {
                UpdateTotalACobrar()
            })

            $("#total_a_cobrar").change(function (e) {
                UpdateMontos()
                if ($("#tipo_doc_ne").prop("checked")) { // si es una nota de entrega dividir el total factura entre el total a cobrar
                    const total_cobrar = $(this).inputmask("unmaskedvalue");
                    const total_factura = $("#total_vef").inputmask("unmaskedvalue");
                    if (total_cobrar > 0){
                        const saldo = parseFloat( total_factura ?? 0 ) / parseFloat( total_cobrar ?? 0 )
                        $("#tasa_cambio").val(saldo.toFixed(2))
                    }else{
                        $("#tasa_cambio").val(0)
                    }
                }
            })

            $("#chk_monto_ret").change(function (e) {
                if ($(this).prop("checked")) {
                    const moneda = ($("#tipo_moneda_usd").prop("checked")) ? "usd" : "vef"
                    const iva = $(`#iva_${moneda}`).inputmask("unmaskedvalue")
                    const monto_ret = parseFloat(iva * (75 / 100))

                    if (moneda == "usd")
                    {
                        $("#monto_ret").val(monto_ret.toFixed(3))
                    }else{
                        $("#monto_ret").val(monto_ret.toFixed(2))
                    }

                } else {
                    $("#monto_ret").val(0)
                }

                UpdateMontos()
            })

            UpdateDenominacion()
            ChangeTipoDoc()
            ChangeTipoPago()

            //Tooltip
            $('body').tooltip({
                selector: '[data-toggle="tooltip"]'
            });
            //Textarea auto growth
            autosize($('textarea.auto-growth'));
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


            //Selector Nro Doc carga via ajax
            $("#nro_documento").select2({
                placeholder: 'Buscar un documento',
                language: "es",
                minimumInputLength: 3,
                ajax: {
                    url: "{{ route('documentos.ajaxSearchById') }}",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    delay: 500,
                    type: "POST",
                    data: (params) => {
                        let tipo = "FA"
                        if ($("#tipo_doc_ne").prop("checked")) {
                            tipo = "NE"
                        }
                        if ($("#tipo_doc_nd").prop("checked")) {
                            tipo = "ND"
                        }
                        const query = {
                            id: params.term,
                            tipo: tipo
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    }
                }
            })
        })

        $("#nro_documento").on("select2:select", function (e) {
            let data = e.params.data
            LoadDocData(data);
        })

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
                                    if (result.print) {
                                        let params =
                                            `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-500,top=-500`;
                                        window.open(result.print, 'popUpWindow',
                                            params)
                                    }
                                    window.location.href = result.goto
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

        function UpdateTotalACobrar() {
            moneda = ($("#tipo_moneda_usd").prop("checked")) ? "usd" : "vef"

            total_a_cobrar = parseFloat($(`#subtotal_${moneda}`).inputmask('unmaskedvalue'))
            if (total_a_cobrar <= 0) {
                total_a_cobrar = parseFloat($(`#total_${moneda}`).inputmask('unmaskedvalue'))
            }
            const porc = $("#porcentaje").inputmask("unmaskedvalue")
            let monto_desc = 0

            if (porc == null || porc == 0) {
                result = total_a_cobrar
            }else{
                console.log(monto_desc)
                monto_desc = total_a_cobrar * (porc / 100)
                result = total_a_cobrar - monto_desc
            }

            if (moneda = "usd") {
                $("#total_a_cobrar").val(result.toFixed(3))
                $("#monto_desc").val(monto_desc.toFixed(3))
            } else {
                $("#total_a_cobrar").val(result.toFixed(2))
                $("#monto_desc").val(monto_desc.toFixed(2))
            }

            UpdateMontos()
        }

        function UpdateTipoCobro() {
            $("#total_a_cobrar").prop("readonly", true)
            $("#porcentaje").prop("disabled", true).val(null)
            tipo_cobro = $("#tipo_cobro").val()
            moneda = ($("#tipo_moneda_usd").prop("checked")) ? "usd" : "vef"
            if (tipo_cobro == "total") {
                total_a_cobrar = parseFloat($(`#total_${moneda}`).inputmask('unmaskedvalue'))
            }
            if (tipo_cobro == "desc") {
                total_a_cobrar = parseFloat($(`#subtotal_${moneda}`).inputmask('unmaskedvalue'))
                if (total_a_cobrar <= 0) {
                    total_a_cobrar = parseFloat($(`#total_${moneda}`).inputmask('unmaskedvalue'))
                }
                $("#total_a_cobrar").prop("readonly", false)
                $("#monto_desc").val(0)
                $("#porcentaje").prop("disabled", false).val(0).focus()
            }
            if (tipo_cobro == "espec") {
                total_a_cobrar = 0
                $("#total_a_cobrar").prop("readonly", false).focus()
            }

            if (moneda = "usd") {
                $("#total_a_cobrar").val(total_a_cobrar.toFixed(3))
            } else {
                $("#total_a_cobrar").val(total_a_cobrar.toFixed(2))
            }

            UpdateMontos()
        }

        function ChangeTipoPago() {
            if ($("#tipo_pago_tran").prop("checked")) {
                table_montos.columns([0, 1]).visible(false).draw()
                table_montos.columns([2, 3, 4, 5]).visible(true).draw()
                $("#fields_efectivo").hide()
                $("#fields_transferencia").show()

            } else {
                table_montos.columns([0, 1]).visible(true).draw()
                table_montos.columns([2, 3, 4, 5]).visible(false).draw()
                $("#fields_efectivo").show()
                $("#fields_transferencia").hide()
            }

            CleanTableMontos()
        }

        function ChangeTipoDoc() {
            if ($("#tipo_doc_fa").prop("checked") || $("#tipo_doc_nd").prop(
                "checked")) { // Si es una factura o una nota de debito
                $("#nro_fa").prop('disabled', false)
                $("#nro_ne").prop('disabled', true)
                // $("#tasa_cambio").prop("readonly", false)
                $("#tipo_cobro").prop("disabled", false).selectpicker("val", null)
                $("#total_a_cobrar").prop("readonly", true)
            }
            if ($("#tipo_doc_ne").prop("checked")) { // Si es una nota de entrega
                $("#nro_fa").prop('disabled', true)
                $("#nro_ne").prop('disabled', false)
                // $("#tasa_cambio").prop("readonly", true)
                $("#tipo_cobro").prop("disabled", true).selectpicker("val", "espec")
                $("#total_a_cobrar").prop("readonly", false)
            }

            CleanDocFields()
        }

        function CleanDocFields() {
            $("#nro_documento").val(null).trigger("change");
            total_a_cobrar = 0;

            $("#id_ruta, #vendedor, #cliente, #fecha_documento, #id_cliente").val(null)
            $("#tasa_cambio, #vuelto, #saldo_doc, #total_a_cobrar").val(0)
            $("#subtotal_vef, #subtotal_usd, #descuento_vef, #descuento_usd, #exento_vef, #exento_usd").val(0)
            $("#base_vef, #base_usd, #iva_vef, #iva_usd, #total_vef, #total_usd").val(0)

            $("#monto_ret_vef, #monto_ret_usd").val(0)
            $("#ret_iva").prop("checked", false)
        }

        function CleanTableMontos() {
            table_montos.rows().data().clear().draw()
            $("#total_recibido").html(0.00)
        }

        function UpdateMontos() {
            let vuelto = parseFloat( $("#vuelto").inputmask('unmaskedvalue') ?? 0 )
            const total_recibido = parseFloat(table_montos.column(6).data().sum())


            total_a_cobrar = parseFloat($("#total_a_cobrar").inputmask('unmaskedvalue'))

            let saldo_doc = 0

            if ($("#chk_monto_ret").prop("checked")) {
                const monto_ret = parseFloat($("#monto_ret").inputmask('unmaskedvalue') ?? 0)
                saldo_doc = parseFloat(total_a_cobrar - total_recibido + vuelto - monto_ret)
            } else {
                saldo_doc = parseFloat(total_a_cobrar - total_recibido + vuelto)
            }
            if ($("#tipo_moneda_usd").prop("checked")) { //si la moneda es usd, truncar a 3 decimales
                $("#saldo_doc").val( saldo_doc.toFixed(3))
                $("#total_recibido").html(total_recibido.toFixed(3))
            }else{ // si es vef redondear a 2
                $("#saldo_doc").val( saldo_doc.toFixed(2))
                $("#total_recibido").html(total_recibido.toFixed(2))
            }

            // if ($("#tipo_doc_ne").prop("checked")) { // Si es nota de entrega calcular la tasa de cambio
            //     const tasa_camb = parseFloat($("#total_vef").inputmask('unmaskedvalue') ?? 0) / total_recibido
            //     // console.log(monto_factura, total_recibido, tasa_camb)
            //     $("#tasa_cambio").val(tasa_camb.toFixed(2))
            // }
        }

        function AddBilletes() {

            const input_total_cobrar = $("#total_a_cobrar").val()
            if (input_total_cobrar == "" || input_total_cobrar == 0) {
                swal("Aviso", 'El campo "Total a Cobrar" no puede ser vacio. Debe seleccionar un tipo de cobro', "warning")
                return
            }

            let cantidad = $("#cant_billetes").inputmask("unmaskedvalue")
            if (cantidad == "") {
                swal("Aviso", 'El campo "Cantidad" no puede ser vacio.', "warning")
                return
            }
            let denominacion = $("#denominacion").val()
            if (denominacion == "") {
                swal("Aviso", 'El campo "Denominacion" no puede ser vacio.', "warning")
                return
            }
            if (denominacion == "Centimos..." && cantidad >= 1) {
                swal("Aviso", 'El campo "Cantidad" no puede ser mayor o igual a 1.', "warning")
                return
            }

            if (denominacion == "Centimos...") {
                denominacion = cantidad
                cantidad = 1
            }
            const total = parseFloat(cantidad * denominacion)
            const nDecimals = ($("#tipo_moneda_usd").prop("checked")) ? 3 : 2

            table_montos.row.add([
                parseFloat(cantidad) + `<input type="hidden" name="bill_cant[]" value="${parseFloat(cantidad)}">`,
                parseFloat(denominacion) +
                `${simbolo}<input type="hidden" name="bill_deno[]" value="${parseFloat(denominacion)}">`,
                "",
                "",
                "",
                "",
                total.toFixed(nDecimals),
                `<div class="btn-group" role="group">
                <button type="button" onclick="RemoveRowTable(this)" class="btn btn-default btn-sm waves-effect"
                    data-toggle="tooltip" data-placement="auto"
                    data-original-title="Remover"><i class="material-icons">delete</i>
                </button>
            </div>`
            ]).draw()

            UpdateMontos()

            $("#denominacion").val(null).selectpicker('refresh')
            $("#cant_billetes").val(null).focus();
        }

        function AddTransferencia() {
            const banco_e = $("#banco_e").val()
            if (banco_e == "") {
                swal("Aviso", 'El campo "Banco Emisor" es requerido', "warning")
                return
            }
            const banco_r = $("#banco_r").val()
            if (banco_r == "") {
                swal("Aviso", 'El campo "Banco Receptor" es requerido.', "warning")
                return
            }
            const fecha_pago = $("#fecha_pago").val()
            if (fecha_pago == "") {
                swal("Aviso", 'El campo "Fecha Pago"  no es válido.', "warning")
                return
            }
            const referencia = $("#referencia").val().trim()
            if (referencia == "") {
                swal("Aviso", 'El campo "Referencia" no puede ser vacio.', "warning")
                return
            }
            const monto_trans = parseFloat($("#monto_trans").inputmask('unmaskedvalue'))
            if (monto_trans == "") {
                swal("Aviso", 'El campo "Monto" no puede ser vacio o menor que cero.', "warning")
                return
            }

            table_montos.row.add([
                "",
                "",
                $("#banco_e").find('option:selected').html() +
                `<input type="hidden" name="tran_bank_e[]" value="${banco_e}">`,
                $("#banco_r").find('option:selected').html() +
                `<input type="hidden" name="tran_bank_r[]" value="${banco_r}">`,
                moment(fecha_pago).format("DD/MM/YYYY") +
                `<input type="hidden" name="tran_fecha[]" value="${fecha_pago}">`,
                referencia +
                `<input type="hidden" name="tran_ref[]" value="${referencia}"><input type="hidden" name="tran_monto[]" value="${monto_trans}">`,
                monto_trans.toFixed(2),
                `<div class="btn-group" role="group">
                <button type="button" onclick="RemoveRowTable(this)" class="btn btn-default btn-sm waves-effect"
                    data-toggle="tooltip" data-placement="auto"
                    data-original-title="Remover"><i class="material-icons">delete</i>
                </button>
            </div>`
            ]).draw()

            UpdateMontos()

            $("#referencia, #monto_trans").val(null)
            $("#fecha_pago").val(moment().format("YYYY-MM-DD"))
            $("#banco_e, #banco_r").val(null).selectpicker('refresh')
            $("#banco_e").focus();
        }

        function RemoveRowTable(btn) {
            var tr = $(btn).parents('tr');
            var row = table_montos.row(tr);
            row.remove().draw(false);

            UpdateMontos()
        }

        function UpdateDenominacion(e) {
            if (table_montos.rows().count() > 0) {
                swal({
                    title: "Cambio de Moneda",
                    text: "La lista de billetes contiene datos y se procederá a vaciarla. ¿Confirma continuar con el cambio?",
                    type: "warning",
                    showCancelButton: true,
                    // confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Aceptar",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {
                        CleanTableMontos()
                    } else {
                        if ($("#tipo_moneda_usd").prop('checked')) {
                            $("#tipo_moneda_vef").prop('checked', true)
                        } else {
                            $("#tipo_moneda_usd").prop('checked', true)
                        }
                        return
                    }
                });
            }

            let denominacion

            if ($("#tipo_moneda_usd").prop('checked')) {
                denominacion = dolares.split(",")
                simbolo = "$"
            } else {
                denominacion = bolivares.split(",")
                simbolo = "Bs"
            }
            let options = ""
            $("#denominacion").html(null).selectpicker("refresh")
            denominacion.forEach(e => {
                options += `<option value="${e}">${e}${simbolo}</option>`
            });
            $("#denominacion").html(options).selectpicker('refresh')
        }

        function LoadDocData(resp) {

            $("#fecha_documento").val(moment(resp.FECHA).format("YYYY-MM-DD"))
            $("#id_cliente").val(resp.CODICLIE)
            $("#cliente").val((resp.cliente.NOMBCLIE).trim())
            $("#id_ruta").val(resp.CODIRUTA ?? null)
            $("#vendedor").val((resp.ruta) ? resp.ruta.NOMBVEND : null)
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
                    cambdol = resp.fa_afectada.CAMBDOL
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

            $("#monto_doc_vef").val()
            $("#tasa_cambio").val(cambDol)

            $("#monto_doc").val(0)

            $("#ret_iva").prop("checked", resp.cliente.AGENTERET)
            $("#chk_monto_ret").prop("checked", false).prop("disabled", !resp.cliente.AGENTERET)

            UpdateMontos();
        }

        function toTrunc(value, n) {
            return Math.floor(value * Math.pow(10, n)) / (Math.pow(10, n));
        }

    </script>
@endsection
