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
            border-collapse: collapse;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .table-bordered td {
            border-style: solid;
            border-width: 0.1px;
            padding: 0px;
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
        <th colspan="10" style="font-size: 10pt; background-color: lightgrey; border: solid; border-color: black; border-width: 0.1px;">COMPROBANTE DE PAGO</th>
    </tr>
    <tr>
        <td class="text-center" rowspan="2" style="font-size: 11pt; font-weight: bold">
            {{ $recibo->idZero }}</td>
        <td class="text-right" style="padding-right: 3px">CLIENTE:</td>
        <td class="text-center" colspan="5">
            <b>{{ $document->CODICLIE ." - ". $recibo->NOMBCLIE }}</b>
        </td>
        <td class="text-center" rowspan="2" colspan="3" style="width: 300px;">FECHA: <b>{{ $recibo->FECHA->format("d/m/Y") }}<br>{{ $recibo->FECHA->format("h:i a") }}</b></td>
    </tr>
    <tr>
        <td class="text-right" style="padding-right: 3px">RUTA:</td>
        <td class="text-center" colspan="5">
            <b>{{ $document->CODIRUTA." - ".$recibo->NOMBVEND }}</b>
        </td>
    </tr>
    <tr>
        <td class="text-right" style="padding: 4px 4px">CONDICIONES: </td>
        <td class="text-center" colspan="2">
            RET. IVA:
            <input type="checkbox" id="si"
                   {{ ($recibo->MONTO_RET > 0) ? "checked" : "" }} style="display: inline;"/><label for="si">SI</label>
            <input type="checkbox" id="no"
                   {{ ($recibo->MONTO_RET <= 0) ? "checked" : "" }} style="display: inline;"/><label for="no">NO</label>
        </td>
        <td colspan="2" class="text-center"><label>NEGOCIACION ESPECIAL: </label><input type="checkbox" {{ ($recibo->TIPO_COBRO == "espec") ? "checked" : "" }} style="display: inline;"/></td>
        <td colspan="2" class="text-center"><label> DESCUENTO: </label><input type="checkbox" {{ ($recibo->TIPO_COBRO == "desc") ? "checked" : "" }} style="display: inline;"/></td>
        <td colspan="3" class="text-center"><label style="font-size: 6pt">TASA CAMBIO:</label><br><b style="font-size: 9pt">Bs. {{number_format( $recibo->TASA_CAMB, 2, ".", "," ) }}</b></td>
    </tr>
    <tr>
        <td class="text-right" style="padding-right: 5px"><b>{{ strtoupper($recibo->tipoDocumento->DESCR) }}:</b></td>
        <td class="text-center"><b>{{ $recibo->NUMEDOCU }}</b></td>
        <td class="text-right" style="padding-right: 5px;">{{ __("FECHA DE EMISION:") }}</td>
        <td class="text-center"><b>{{ $document->FECHA->format("d/m/Y") }}</b></td>
        <td class="text-center">{{ __("MONTO Bs.: ") }}<b>Bs. {{ number_format($document->TOTADOCU, 2) }}</b></td>
        <td colspan="3" class="text-center">{{ __("MONTO $: ") }}<br><b>$ {{ number_format($document->TOTADOCU / $document->CAMBDOL, 3) }}</b></td>
        <td colspan="2" class="text-center" >{{ __("NEG.ESP.: ") }}<br><b>Bs. {{ number_format($recibo->MONTO_DOC, $nDecimals) }}</b></td>
{{--        <td class="text-center" colspan="3">--}}
{{--            @if($recibo->TIPO_DOC != "NE")--}}
{{--            {{ __("ND / NC: ") }}<br><b>Bs. {{ number_format( ($document->TOTADOCU / $document->CAMBDOL) - $recibo->MONTO_DOC, $nDecimals) }}</b>--}}
{{--            @endif--}}
{{--        </td>--}}
    </tr>
    <tr>
        <td class="text-right" style="padding-right: 5px">{{ __("FORMA DE PAGO: ") }}</td>
        <td class="text-center" colspan="3"><b style="padding: 3px;">{{ $recibo->TIPO_MONEDA }} -
                {{ ($recibo->TIPO_PAGO == "T") ? "TRANSFERENCIA" : "EFECTIVO" }}</b>
        </td>
        <td class="text-center" colspan="6" style="padding: 5px 5px;"><b><u>DESGLOSE DE PAGO</u></b></td>
    </tr>
    <tr>
        <td colspan="4" style="vertical-align: baseline;">
            <table class="table-bordered" style="width: 100%;">
                <tr>
                    <td class="text-center"><b>{{ __("Nº") }}</b></td>
                    <td class="text-center"><b>{{ __("DENOM.") }}</b></td>
                    <td class="text-center"><b>{{ __("SUBTOTAL") }}</b></td>
                </tr>
                @php
                    $sumTotal = 0;
                @endphp
                @foreach ($billetes as $item)
                    @php
                        $cantidad = 0;
                        $denominacion = $item;
                        $total = 0;
                    @endphp
                    @foreach($recibo->reciboDet as $bill)
                        @if($bill->DENOMINACION == $item)
                            @php
                                $cantidad = $bill->CANTIDAD;
                                $denominacion = $bill->DENOMINACION;
                                $total = $bill->DENOMINACION * $bill->CANTIDAD;

                                $sumTotal += $total;
                            @endphp
                        @endif
                    @endforeach
                    <tr class="text-center">
                        <td>{{ $cantidad }}</td>
                        <td>{{ number_format($denominacion, 2, ".", ",") }}</td>
                        <td>{{ number_format($total, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" class="text-center" style="font-size: 9pt; font-weight: bold">TOTAL</td>
                    <td class="text-center" style="font-size: 9pt; font-weight: bold">{{ number_format($sumTotal, 2) }}</td>
                </tr>
            </table>
        </td>
        <td colspan="6" style="vertical-align: baseline;">
            <table style="width: 100%;">
                <tr class="text-right">
                    <td style="padding-right: 1%; width: 40%;">MONTO. RET.: </td>
                    <td style="padding-right: 1%; width: 20%;"><b>$ {{ number_format((($recibo->MONTO_RET / $recibo->TASA_CAMB)  * -1) ?? 0, 3)  }}</b></td>
                    <td style="padding-right: 1%; width: 30%;"><b>Bs. {{ number_format(($recibo->MONTO_RET *-1) ?? 0, 2)  }}</b></td>
                </tr>
                @if($recibo->TIPO_DOC != "NE")
                <tr class="text-right">
                    <td style="padding-right: 1%;">ND /NC:</td>
                    <td style="padding-right: 1%;"><b>Bs.
                        {{ number_format( bcdiv( ($document->TOTADOCU / $document->CAMBDOL) - $recibo->MONTO_DOC, 1, 3) * $recibo->TASA_CAMB, 2) }}
                    </td>
                    <td style="padding-right: 1%;"><b>$
                    {{  number_format( bcdiv( ($document->TOTADOCU / $document->CAMBDOL) - $recibo->MONTO_DOC, 1, 3), 3) }}
                </tr>
                @endif
                <tr class="text-right">
                    <td style="padding-right: 1%;">MONTO RECIBIDO: </td>
                    <td style="padding-right: 1%;"><b>$
                            {{ number_format( $recibo->montoRecibido / $recibo->TASA_CAMB ?? 0, 3)  }}</b></td>
                    <td style="padding-right: 1%;"><b>Bs. {{ number_format($recibo->montoRecibido ?? 0, 2)  }}</b></td>
                </tr>
                <tr class="text-right">
                    <td style="padding-right: 1%;">VUELTO:</td>
                    <td style="padding-right: 1%;"><b>$
                            {{ number_format( $recibo->VUELTO / $recibo->TASA_CAMB ?? 0, 3)  }}</b></td>
                    <td style="padding-right: 1%;"><b>Bs. {{ number_format($recibo->VUELTO ?? 0, 2)  }}</b></td>
                </tr>
                <tr class="text-right">
                    <td style="padding-right: 1%;">TOTAL A PAGAR: </td>
                    <td style="padding-right: 1%;"><b>$
                            {{ number_format(( ($recibo->MONTO_DOC - $recibo->MONTO_RET) / $recibo->TASA_CAMB) ?? 0, 3)  }}</b></td>
                    <td style="padding-right: 1%;"><b>Bs.
                            {{ number_format(( $recibo->MONTO_DOC - $recibo->MONTO_RET) ?? 0, 2)  }}</b></td>
                </tr>
                <tr class="text-right">
                    <td style="padding-right: 1%;">SALDO:</td>
                    <td style="padding-right: 1%;"><b>$
                            {{ number_format( $recibo->SALDO_DOC * $recibo->TASA_CAMB, 3) }}</b></td>
                    <td style="padding-right: 1%;"><b>Bs. {{ number_format($recibo->SALDO_DOC, 2) }}</b></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;font-size: 9pt;font-weight: bold;text-decoration: underline; border: none;">RECIBI CONFORME</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="font-size: 9pt">
        <td colspan="4" style="padding: 1px 3px 15px;">
            Analista de Caja: <b>{{ $recibo->createdBy->name }}</b><br>
            <u>Comentario:</u> {{ $recibo->COMENTARIO ?? "" }}
        </td>
        <td colspan="" style="padding: 1px 3px; vertical-align: top">Hora de Entrega:</td>
        <td colspan="5" style="padding: 1px 3px; vertical-align: top">Firma y Nombre</td>
    </tr>
</table>
</body>

</html>
