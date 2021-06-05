<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Comprobante de Pago - {{ $recibo->idZero }}</title>

    <style type="text/css">
        @page {
            margin: 30px 20px 20px 20px;
            /* padding: 0px 0px 0px 0px; */
        }
        * {
            font-family: Verdana, Arial, sans-serif;
            font-size: 8pt;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .table-bordered, .table-bordered tr td {
            border-style: solid;
            border-width: 0.1px;
            border-collapse: collapse;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>

</head>

@php
    $nDecimals = ($recibo->TIPO_MONEDA == "VEF") ? 2 : 3;
    $document = 0;
    if ($recibo->TIPO_DOC == "FA"){
        $document = $recibo->factura;
    }else if($recibo->TIPO_DOC == "NE") {
        $document = $recibo->notaEntrega;
    }else{
        $document = $recibo->notaDebito;
    }
@endphp

<body>
    <table class="table-bordered" style="width: 100%;">
        <tr>
            <th colspan="10" style="font-size: 10pt; background-color: lightgrey">COMPROBANTE DE PAGO</th>
        </tr>
        <tr>
            <td class="text-center" rowspan="2" colspan="3" style="width: 150px; font-size: 11pt; font-weight: bold">
                {{ $recibo->idZero }}</td>
            <td class="text-right">CLIENTE:</td>
            <td class="text-center" colspan="3">
                <b>{{ $document->CODICLIE }}
                    -
                    {{ ($recibo->TIPO_DOC == "FA") ? $document->cliente->NOMBCLIE : $recibo->notaEntrega->cliente->NOMBCLIE }}</b>
            </td>
            <td class="text-left" colspan="3">RUTA:
                <b>{{ ($recibo->TIPO_DOC == "FA") ? $document->CODIRUTA."-".$document->ruta->NOMBVEND : $recibo->notaEntrega->CODIRUTA."-".$recibo->notaEntrega->ruta->NOMBVEND }}</b>
            </td>
        </tr>
        <tr>
            <td class="text-right">{{ __("FECHA DOC.:") }}</td>
            <td class="text-center"><b>{{ $recibo->FECHA->format("d/m/Y") }}</b></td>
            <td class="text-right">NUMERO DOC.:</td>
            <td class="text-center"><b>{{ $recibo->NUMEDOCU }}</b></td>
            <td class="text-right" colspan="">{{ __("TASA:") }}</td>
            <td class="text-right" colspan="2" style="font-size: 10pt; width: 150px">
                <b>{{number_format( $recibo->TASA_CAMB, $nDecimals, ".", "," ) }}</b>
            </td>
        </tr>
        <tr>
            <td class="text-right" colspan="4" rowspan="2">FECHA DE RECIBO {{ $recibo->FECHA->format("d/m/Y h:i a") }}
            </td>
            <td class="text-center">{{ __("MONTO DOC. Bs.") }}</td>
            <td class="text-center">{{ __("MONTO DOC. $") }}</td>
            <td class="text-center">{{ __("TOTAL A PAGAR") }}</td>
            <td class="text-right">{{ __("MONTO RECIBIDO $:") }}</td>
            <td class="text-right" colspan="2" style="font-size: 10pt">
                <b>{{ __("$ ".number_format($recibo->montoRecibido, $nDecimals, ".", ",")) }}</b>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <b>Bs. {{ number_format(($recibo->TIPO_DOC == "FA") ? $document->TOTADOCU : $recibo->notaEntrega->TOTADOCU, $nDecimals, ".", ",") }}</b>
            </td>
            <td class="text-center">
                @php
                if($recibo->TIPO_DOC == "FA" || $recibo->TIPO_DOC == "ND")
                {
                    $facturaDolar = $document->TOTADOCU / $document->CAMBDOL;
                }else{
                    $facturaDolar = $recibo->notaEntrega->TOTADOCU / $recibo->notaEntrega->CAMBDOL;
                }
                $totalCobrar = $recibo->MONTO_DOC - $recibo->MONTO_RET;
                @endphp
                <b>$ {{ number_format($facturaDolar, $nDecimals, ".", ",") }}</b>
            </td>
            <td class="text-center"><b>{{ number_format($totalCobrar, $nDecimals) }}</b></td>
            <td class="text-right">{{ __("DIFERENCIA:") }}</td>
            <td class="text-right" colspan="2" style="font-size: 10pt">
                @php
                $diferencia = $totalCobrar - $recibo->montoRecibido;
                @endphp
                <b>$ {{ number_format($diferencia, $nDecimals, ".", ",") }}</b>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <table style="width: 100%; border-collapse: collapse; max-height: 100%;">
                    <tr class="text-center">
                        <th>ABONO</th>
                        <th>RESTA</th>
                    </tr>
                    <tr class="text-center">
                        @if ($recibo->SALDO_DOC > 0)
                        <th>{{ number_format($recibo->montoRecibido, $nDecimals) ?? "0.00" }}</th>
                        <th>{{ number_format($recibo->SALDO_DOC, $nDecimals) ?? "0.00" }}</th>
                        @else
                        <th>0.00</th>
                        <th>0.00</th>
                        @endif
                    </tr>
                </table>
            </td>
            <td class="text-center">
                RENTENCION IVA<br>
                <input type="checkbox" id="si" {{ ($recibo->MONTO_RET > 0) ? "checked" : "" }} style="display: inline;"/><label for="si">SI</label>
                <input type="checkbox" id="no" {{ ($recibo->MONTO_RET <= 0) ? "checked" : "" }} style="display: inline;" /><label for="no">NO</label>
            </td>
            <td class="text-center">MONTO RETENIDO: <br><b>{{ number_format($recibo->MONTO_RET, $nDecimals) }} </b></td>
            {{--            <td class="text-right" colspan="2">VUELTO</td>--}}
            {{--            <td class="text-right">{{ __("0.00") }}</td>--}}

            <td colspan="4">
                <table class="table-bordered" style="width: 100%;">
                    <tr class="text-right">
                        <td>VUELTO:</td>
                        <td><b>$ {{ number_format($recibo->VUELTO, $nDecimals) ?? "0.00" }}</b></td>
                    </tr>
                    <tr class="text-right">
                        <td>SALDO DOCUMENTO:</td>
                        <td><b>$ {{ number_format($recibo->SALDO_DOC, $nDecimals) ?? "0.00" }}</b></td>
                    </tr>
                    <tr class="text-right">
                        <td>TOTAL CANCELADO $:</td>
                        <td><b>$
                                {{ number_format( ($recibo->TIPO_DOC == "FA") ? $document->total_cobrado : $recibo->notaEntrega->total_cobrado, $nDecimals) }}</b>
                        </td>
                    </tr>
                    <tr class="text-right">
                        <td>TOTAL CANCELADO BS.:</td>
                        <td><b>Bs.
                                {{ number_format( ($recibo->TIPO_DOC == "FA") ? $document->total_cobrado * $recibo->TASA_CAMB : $recibo->notaEntrega->total_cobrado * $recibo->TASA_CAMB, $nDecimals) }}</b>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="text-right">Tipo de Cobro:</td>
            <td><b>
                @switch($recibo->TIPO_COBRO)
                @case("total")
                    Monto total del documento.
                    @break
                @case("desc")
                    Descuento al {{ $recibo->PORC }} %
                    @break
                @default
                    Negociación Especial.
                @endswitch</b>
            </td>
            @if ($recibo->TIPO_COBRO == "desc")
            <td class="text-right">Monto Descuento:</td>
            <td class="text-right"><b>{{ number_format($recibo->MONTO_DESC, $nDecimals) }}</b></td>
            @else
            <td colspan="2"></td>
            @endif
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="7">
                <table class="table-bordered" style="width: 100%">
                    <tr>
                        <td class="text-center"><b>{{ __("Nº") }}</b></td>
                        <td class="text-center"><b>{{ __("DENOM.") }}</b></td>
                        <td class="text-center"><b>{{ __("TOTAL $") }}</b></td>
                        <td class="text-center"><b>{{ __("MONTO BS") }}</b></td>
                    </tr>
                    @php
                    $sumTotalUsd = 0;
                    $sumTotalVef = 0;
                    @endphp
                    @foreach ($billetes as $item)
                    @php
                        $denominacion = $item;
                        if ($item != "0.5") {
                            $valCantidad = App\Models\ReciboDet::where("id_recibo", $recibo->id)->where("DENOMINACION", $item)->sum("CANTIDAD");
                            $valDenominacion = App\Models\ReciboDet::where("id_recibo", $recibo->id)->where("DENOMINACION", $item)->max("DENOMINACION");
                        }else{
                            $valCantidad = 0;
                            if (App\Models\ReciboDet::where("id_recibo", $recibo->id)->where("DENOMINACION", "<", 1)->count() > 0 ) {
                                $valCantidad = 1;
                                $valDenominacion = App\Models\ReciboDet::where("id_recibo",$recibo->id)->where("DENOMINACION", "<", 1)->max("DENOMINACION");
                                $denominacion = $valDenominacion;
                            }
                        }
                        $totalUsd = $valCantidad * $valDenominacion;
                        $totalVef = $totalUsd * $recibo->TASA_CAMB;
                        $sumTotalUsd += $totalUsd;
                        $sumTotalVef += $totalVef;
                    @endphp
                    <tr class="text-center">
                        <td>{{ $valCantidad }}</td>
                        <td>{{ number_format($denominacion, $nDecimals, ".", ",") }}</td>
                        <td>{{ number_format($totalUsd, $nDecimals) }}</td>
                        <td>{{ number_format($totalVef, $nDecimals) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="text-center" style="font-size: 9pt; font-weight: bold">TOTAL</td>
                        <td class="text-center" style="font-size: 9pt; font-weight: bold">
                            {{ number_format($sumTotalUsd, $nDecimals) }}</td>
                        <td class="text-center" style="font-size: 9pt; font-weight: bold">
                            {{ number_format($sumTotalVef, $nDecimals) }}</td>
                    </tr>
                </table>
            </td>
            <td colspan="3"
                style="text-align: center; font-size: 10pt; font-weight: bold; vertical-align: baseline; text-decoration: underline">
                RECIBI CONFORME
            </td>
        </tr>

        <tr style="font-size: 9pt">
            <td colspan="5" style="padding: 5px 5px 15px;">
                Analista de Caja: <b>{{ $recibo->createdBy->name }}</b>
            </td>
            <td colspan="2" style="padding: 5px 5px 15px;">Hora de Entrega:</td>
            <td colspan="3" style="padding: 5px 5px 15px;">Firma y Nombre</td>
        </tr>
    </table>
</body>

</html>
