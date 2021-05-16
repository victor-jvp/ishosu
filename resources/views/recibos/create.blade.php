@extends('layouts.app')
@section('title', 'Recibos')

@section('content')

<section class="content">
    <form method="POST" action="{{ route("recibos.store") }}" id="form_submit">
        @csrf

        <div class="container-fluid">
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
                                <div class="col-sm-3">
                                    <p><b>Moneda</b></p>
                                    <input name="tipo_moneda" type="radio" id="tipo_moneda_usd" value="usd"
                                        class="tipo_moneda with-gap radio-col-indigo" checked />
                                    <label for="tipo_moneda_usd">Dolares</label>

                                    <input name="tipo_moneda" type="radio" id="tipo_moneda_vef" value="vef"
                                        class="tipo_moneda with-gap radio-col-indigo" />
                                    <label for="tipo_moneda_vef">Bolivares</label>
                                </div>

                                <div class="col-sm-3">
                                    <p><b>Tipo de Pago</b></p>
                                    <input name="tipo_recibo" type="radio" id="tipo_recibo_tran" value="transferencia"
                                        class="tipo_recibo with-gap radio-col-indigo" checked />
                                    <label for="tipo_recibo_tran">Transferencia</label>

                                    <input name="tipo_recibo" type="radio" id="tipo_recibo_efec" value="efectivo"
                                        class="tipo_recibo with-gap radio-col-indigo" />
                                    <label for="tipo_recibo_efec">Efectivo</label>
                                </div>

                                <div class="col-sm-3">
                                    <p><b>Nro. Documento</b></p>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control show-tick" data-live-search="true" required
                                                data-title="Seleccione..." name="nro_documento">
                                                @foreach ($facturas as $item)
                                                <option {{ $item->NUMEDOCU }}>{{ $item->NUMEDOCU }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <p><b>Fecha Factura</b></p>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" class="form-control" id="fecha_factura"
                                                name="fecha_factura" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <p><b>Codigo Cliente</b></p>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="id_cliente" name="id_cliente"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <p><b>Cliente</b></p>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="cliente" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <p><b>Codigo Ruta</b></p>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="id_ruta" name="id_ruta"
                                                disabled>
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
                                <div class="col-sm-3">
                                    <p><b>Monto Factura Bs.</b></p>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="monto_factura_vef" disabled
                                                    value="0" step="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <p><b>Monto Factura $</b></p>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="monto_factura_usd" disabled
                                                    value="0" step="1" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="cant_billetes" step="1" min="1">
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
                                        data-toggle="tooltip" data-placement="auto" data-original-title="Agregar">
                                        <i class="material-icons">add_circle</i>
                                    </button>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="total_billetes" value="0" min="0.01" step="1"
                                                readonly required name="total">
                                            <label class="form-label">Total Billetes</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 table-responsive">
                                    <table id="table_billetes" class="table table-bordered table-striped table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>Cantidad</th>
                                                <th>Denominacion</th>
                                                <th>Total</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
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
<link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<!-- JQuery DataTable Css -->
<link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endsection

@section('scripts')
<!-- Select Plugin Js -->
<script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<!-- Jquery Validation Plugin Css -->
<script src="../../plugins/jquery-validation/jquery.validate.js"></script>
<script src="../../js/jquery.validate.messages_es.js"></script>
<!-- tooltips-popovers -->
<script src="../../js/pages/ui/tooltips-popovers.js"></script>

<script>
    var dolares = "{{ $dolares }}"
    var bolivares = "{{ $bolivares }}"
    var table_billetes

    $(document).ready(function () {
        table_billetes = $("#table_billetes").DataTable({
            language: table_es_lang,
            info: false,
            paging: false,
            searching: false,
            ordering: false
        })

        $(".tipo_moneda").change(function (e) {
            UpdateDenominacion(e)
        })

        UpdateDenominacion()

        //Tooltip
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
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

			data = $("#form_create");

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
					data: data.serialize(),
					success: function (result) {
						swal({
							title: result.title,
							text: result.message,
							type: result.result,
							showCancelButton: false,
							closeOnConfirm: false
						}, function (resp) {
							window.location.href = `{{ route('recibos.index') }}/${resp.id}`
						});
					},
					error: function (result) {

						if (result == undefined || result == null) {
							swal('Error en el proceso',
								'Error al procesar los datos. Intente nuevamente',
								'error')
						} else {
							swal(result.title, result.message, result.result);
						}

					}
				})
			});
		}
    });

    function AddBilletes() {
        const cantidad = $("#cant_billetes").val()
        const denominacion = $("#denominacion").val()

        if (cantidad == "") {
            swal("Aviso", 'El campo "Cantidad" no puede ser vacio.', "warning")
            return
        }
        if (denominacion == "") {
            swal("Aviso", 'El campo "Denominacion" no puede ser vacio.', "warning")
            return
        }

        const total = parseFloat(cantidad * denominacion)

        table_billetes.row.add([
            parseInt(cantidad) + `<input type="hidden" name="bill_cant[]" value="${parseInt(cantidad)}">`,
            parseFloat(denominacion) + `<input type="hidden" name="bill_deno[]" value="${parseFloat(denominacion)}">`,
            total,
            `<div class="btn-group" role="group">
                <button type="button" onclick="RemoveBillete(this)" class="btn btn-default btn-sm waves-effect"
                    data-toggle="tooltip" data-placement="auto"
                    data-original-title="Remover"><i class="material-icons">delete</i>
                </button>
            </div>`
        ]).draw()

        let total_billetes = parseFloat($("#total_billetes").val())
        $("#total_billetes").val(total_billetes += total)

        $("#cant_billetes").val(null)
        $("#denominacion").val(null).selectpicker('refresh')
    }

    function RemoveBillete(btn) {
        var tr = $(btn).parents('tr');
        var row = table_billetes.row(tr);
        const total = parseFloat(row.data()[2])
        row.remove().draw(false);

        let total_billetes = parseFloat($("#total_billetes").val())
        $("#total_billetes").val(total_billetes -= total)
    }

    function UpdateDenominacion(e) {
        if(table_billetes.rows().count() > 0) {
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
                    table_billetes.rows().clear().draw();
                     $("#total_billetes").val(0)
                }else{
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
        let simbolo

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
            options += `<option value="${e}">${e} ${simbolo}</option>`
        });
        $("#denominacion").html(options).selectpicker('refresh')
    }
</script>
@endsection
