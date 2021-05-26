@extends('layouts.app')
@section('title', 'Recibos')

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

                                    <div class="col-sm-4">
                                        <p><b>Tipo de Documento</b></p>
                                        <input name="tipo_doc" type="radio" id="tipo_doc_fa" value="FA"
                                               class="tipo_doc with-gap radio-col-indigo" checked/>
                                        <label for="tipo_doc_fa">Factura</label>

                                        <input name="tipo_doc" type="radio" id="tipo_doc_ne" value="NE"
                                               class="tipo_doc with-gap radio-col-indigo"/>
                                        <label for="tipo_doc_ne">Nota de Entrega</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3" id="div_fa">
                                        <p><b>Nro. Factura</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control show-tick" data-live-search="true" required
                                                        data-container="body" data-size="10"
                                                        data-title="Seleccione..." name="nro_documento" id="nro_fa">
                                                    @foreach ($facturas as $item)
                                                        <option
                                                            value="{{ $item->NUMEDOCU }}">{{ $item->NUMEDOCU }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3" id="div_ne">
                                        <p><b>Nro. Nota de Entrega</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control show-tick" data-live-search="true" required
                                                        data-container="body" data-size="10"
                                                        data-title="Seleccione..." name="nro_documento" id="nro_ne">
                                                    @foreach ($notas as $item)
                                                        <option
                                                            value="{{ $item->NUMEDOCU }}">{{ $item->NUMEDOCU }}</option>
                                                    @endforeach
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
                                                       readonly autofocus>
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
                                        <p><b>Codigo Ruta</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="id_ruta" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <p><b>Ruta</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="ruta" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <p><b>Cliente</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="cliente" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-2">
                                        <p><b>Total Doc. Bs.</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto" id="monto_doc_vef"
                                                       name="monto_doc_vef" readonly value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <p><b>Total Doc. $</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto" id="monto_doc_usd"
                                                       readonly name="monto_doc_usd" value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <p><b>Tasa de Cambio</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto" id="tasa_cambio" readonly
                                                       name="tasa_cambio" value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <p><b>Vuelto</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto" id="vuelto" value="0"
                                                       name="vuelto">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <p><b>Saldo Documento</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto" id="saldo_doc" readonly
                                                       name="saldo_doc" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <p><b>Total Cobrado Doc $.</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto" id="total_cobrado"
                                                       name="total_cobrado" readonly value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <p><b>Total Gravable Bs.</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto" id="total_grav"
                                                     readonly value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <p><b>Total Monto Ret. Bs.</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control monto" id="monto_doc_ret"
                                                    name="monto_doc_ret" readonly value="0">
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
                                                <input type="text" class="form-control cant" id="cant_billetes">
                                                <label class="form-label">Cantidad</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="form-control show-tick" data-live-search="true"
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
                                                data-container="body" data-size="10"
                                                data-title="Banco Emisor" id="banco_e">
                                            @foreach ($banks_e as $item)
                                                <option data-subtext="{{ $item->code }}"
                                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control show-tick dropup" data-live-search="true"
                                                data-container="body" data-size="10"
                                                data-title="Banco Receptor" id="banco_r">
                                            @foreach ($banks_r as $item)
                                                <option data-subtext="{{ $item->code }}"
                                                        value="{{ $item->id }}">{{ $item->name }}</option>
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
        var dolares = "{{ $dolares }}"
        var bolivares = "{{ $bolivares }}"
        var table_montos
        var simbolo

        $(document).ready(function () {
            table_montos = $("#table_montos").DataTable({
                language: table_es_lang,
                info: false,
                paging: false,
                searching: false,
                ordering: false,
                columnDefs: [
                    {targets: 6, className: "dt-body-right"},
                    {targets: [0, 1], visible: false, className: "dt-center"},
                    {targets: 7, width: "10%"}
                ]
            })

            $(".tipo_moneda").change(function (e) {
                UpdateDenominacion(e)
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

            $("#nro_ne, #nro_fa").on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                LoadDocData($(this).val())
            })

            $("#vuelto").change(function (e) {
                UpdateMontos()
            })

            UpdateDenominacion()
            ChangeTipoDoc()
            ChangeTipoPago()

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
                                if (result.type == "success") {
                                    if (result.print) {
                                        let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-500,top=-500`;
                                        window.open(result.print,'popUpWindow',params)
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
                                swal('Error en el proceso', 'Error al procesar los datos. Intente nuevamente', 'error')
                            }
                        }
                    })
                });
            }
        });

        function ChangeTipoPago() {
            if ($("#tipo_pago_tran").prop("checked")) {
                table_montos.columns([0, 1]).visible(false).draw()
                table_montos.columns([2,3,4,5]).visible(true).draw()
                $("#fields_efectivo").hide()
                $("#fields_transferencia").show()

            } else {
                table_montos.columns([0, 1]).visible(true).draw()
                table_montos.columns([2,3,4,5]).visible(false).draw()
                $("#fields_efectivo").show()
                $("#fields_transferencia").hide()
            }

            CleanTableMontos()
        }

        function ChangeTipoDoc() {
            if ($("#tipo_doc_fa").prop("checked")) { // Si es una factura
                $("#div_fa").show();
                $("#div_ne").hide();
                $("#nro_fa").prop('disabled', false)
                $("#nro_ne").prop('disabled', true)
                $("#tasa_cambio").prop("readonly", true)
            } else { // Si es una nota de entrega
                $("#div_fa").hide();
                $("#div_ne").show();
                $("#nro_fa").prop('disabled', true)
                $("#nro_ne").prop('disabled', false)
                $("#tasa_cambio").prop("readonly", false)
            }

            CleanDocFields()
        }

        function CleanDocFields() {
            $("#id_ruta, #ruta, #cliente, #fecha_documento, #id_cliente").val(null)
            $("#monto_doc_vef, #monto_doc_usd, #tasa_cambio, #vuelto, #saldo_doc, #total_cobrado").val(0)
            $("#nro_fa, #nro_ne").val(null).selectpicker('refresh')

            $("#div_ret_iva").hide()
        }

        function CleanTableMontos() {
            table_montos.rows().data().clear().draw()
            $("#total_recibido").html(0.00)
        }

        function UpdateMontos() {
            if ($("#vuelto").inputmask('unmaskedvalue') === "") {
                $("#vuelto").val(0)
            }
            let total_recibido = parseFloat(table_montos.column(6).data().sum())
            let vuelto = parseFloat($("#vuelto").inputmask('unmaskedvalue'))

            let monto_factura
            if ($("#tipo_moneda_usd").prop("checked")) {
                monto_factura = parseFloat($("#monto_doc_usd").inputmask('unmaskedvalue') ?? 0)
            } else {
                monto_factura = parseFloat($("#monto_doc_vef").inputmask('unmaskedvalue') ?? 0)
            }
            const total_cobrado = parseFloat($("#total_cobrado").inputmask('unmaskedvalue'))
            $("#total_recibido").html(total_recibido.toFixed(2))
            const saldo_doc = parseFloat(monto_factura - total_cobrado - total_recibido + vuelto)
            $("#saldo_doc").val(saldo_doc.toFixed(2))
        }

        function AddBilletes() {

            const cantidad = $("#cant_billetes").val()
            if (cantidad == "") {
                swal("Aviso", 'El campo "Cantidad" no puede ser vacio.', "warning")
                return
            }
            const denominacion = $("#denominacion").val()
            if (denominacion == "") {
                swal("Aviso", 'El campo "Denominacion" no puede ser vacio.', "warning")
                return
            }

            const total = parseFloat(cantidad * denominacion)

            table_montos.row.add([
                parseInt(cantidad) + `<input type="hidden" name="bill_cant[]" value="${parseInt(cantidad)}">`,
                parseFloat(denominacion) + `${simbolo}<input type="hidden" name="bill_deno[]" value="${parseFloat(denominacion)}">`,
                "",
                "",
                "",
                "",
                total.toFixed(2),
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
                $("#banco_e").find('option:selected').html() + `<input type="hidden" name="tran_bank_e[]" value="${banco_e}">`,
                $("#banco_r").find('option:selected').html() + `<input type="hidden" name="tran_bank_r[]" value="${banco_r}">`,
                moment(fecha_pago).format("DD/MM/YYYY") + `<input type="hidden" name="tran_fecha[]" value="${fecha_pago}">`,
                referencia + `<input type="hidden" name="tran_ref[]" value="${referencia}"><input type="hidden" name="tran_monto[]" value="${monto_trans}">`,
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

        function LoadDocData(nro_documento) {
            if (nro_documento == "") {
                return
            }
            const tipo_doc = $("input[name=tipo_doc]:checked").val()

            $.ajax({
                url: "{{ route('documentos.details') }}",
                dataType: 'JSON',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: {
                    id: nro_documento,
                    tipo_doc: tipo_doc,
                },
                success: function (resp) {
                    if (resp == null) {
                        swal("Aviso", "La consulta del documento no tiene información. Intente nuevamente", "warning")
                        return
                    }

                    $("#fecha_documento").val(moment(resp.FECHA).format("YYYY-MM-DD"))
                    $("#id_cliente").val(resp.CODICLIE)
                    $("#cliente").val((resp.cliente.NOMBCLIE).trim())
                    $("#ret_iva").prop("checked", false);


                    $("#id_ruta").val(resp.CODIRUTA)
                    $("#ruta").val(resp.ruta.NOMBVEND)
                    $("#monto_doc_vef").val(resp.TOTADOCU)
                    $("#tasa_cambio").val(resp.CAMBDOL)

                    const montoFacturaUsd = (resp.TOTADOCU / resp.CAMBDOL)
                    $("#monto_doc_usd").val(montoFacturaUsd.toFixed(2))
                    $("#total_cobrado").val(resp.total_cobrado.toFixed(2))

                    if (resp.cliente.AGENTERET) {
                        const impBruto = parseFloat(resp.IMPUBRUT);
                        const iva = parseFloat(resp.IMPU1);
                        const totalIva = impBruto * ( iva / 100);
                        const montoRet = totalIva * (75 / 100);
                        $("#total_grav").val(impBruto.toFixed(2))
                        $("#monto_doc_ret").val(montoRet.toFixed(2))

                        $("#div_ret_iva").show()
                    } else {
                        $("#total_grav").val(0)
                        $("#monto_doc_ret").val(0)

                        $("#div_ret_iva").hide()
                    }

                    $("#agente_ret").prop("checked", resp.cliente.AGENTERET)

                    UpdateMontos();
                },
                error: function (resp) {

                    if (result == undefined || result == null) {
                        swal('Error en el proceso',
                            'Error al procesar los datos. Intente nuevamente',
                            'error')
                    } else {
                        swal(result.title, result.message, result.result);
                    }

                }
            })
        }
    </script>
@endsection
