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

<body>

@for($x = 0; $x < $copies; $x++)
    <table class="table-bordered" style="width: 100%;">
        <tr>
            <th colspan="10" style="font-size: 10pt; background-color: lightgrey">COMPROBANTE DE PAGO</th>
        </tr>
        <tr>
            <td class="text-center" rowspan="2" colspan="3"
                style="width: 150px; font-size: 11pt; font-weight: bold">{{ $recibo->idZero }}</td>
            <td class="text-right">CLIENTE:</td>
            <td class="text-center" colspan="3">
                <b>{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->CODICLIE : $recibo->notaEntrega->CODICLIE }}
                    -
                    {{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->cliente->NOMBCLIE : $recibo->notaEntrega->cliente->NOMBCLIE }}</b>
            </td>
            <td class="text-left" colspan="3">RUTA: {{--TODO: NOMBRE DEL ASESOR DE VENTAS--}}
                <b>{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->CODIRUTA."-".$recibo->factura->ruta->NOMBVEND : $recibo->notaEntrega->CODIRUTA."-".$recibo->notaEntrega->ruta->NOMBVEND }}</b>
            </td>
        </tr>
        <tr>
            <td class="text-right">{{ __("FECHA DOC.:") }}</td>
            <td class="text-center"><b>{{ $recibo->FECHA->format("d/m/Y") }}</b></td>
            <td class="text-right">NUMERO DOC.:</td>
            <td class="text-center"><b>{{ $recibo->NUMEDOCU }}</b></td>
            <td class="text-right" colspan="">{{ __("TASA:") }}</td>
            <td class="text-right" colspan="2" style="font-size: 10pt">
                <b>{{number_format( $recibo->TASA_CAMB, 2, ".", "," ) }}</b>
            </td>
        </tr>
        <tr>
            <td class="text-right" colspan="4" rowspan="2">FECHA DE
                RECIBO {{ $recibo->FECHA->format("d/m/Y h:i a") }}
            </td>
            <td class="text-center">{{ __("MONTO DOC. Bs.") }}</td>
            <td class="text-center">{{ __("MONTO DOC. $") }}</td>
            <td class="text-center">{{ __("TOTAL A COBRAR") }}</td>
            <td class="text-right">{{ __("MONTO RECIBIDO $:") }}</td>
            <td class="text-right" colspan="2" style="font-size: 10pt">
                <b>{{ __("$ ".number_format($recibo->montoRecibido, 2, ".", ",")) }}</b>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <b>Bs. {{ number_format(($recibo->TIPO_DOC == "FA") ? $recibo->factura->TOTADOCU : $recibo->notaEntrega->TOTADOCU, 2, ".", ",") }}</b>
            </td>
            <td class="text-center">
                @php
                    if($recibo->TIPO_DOC == "FA")
                    {
                        $facturaDolar = $recibo->factura->TOTADOCU / $recibo->factura->CAMBDOL;
                    }else{
                        $facturaDolar = $recibo->notaEntrega->TOTADOCU / $recibo->notaEntrega->CAMBDOL;
                    }
                @endphp
                <b>$ {{ number_format($facturaDolar, 2, ".", ",") }}</b>
            </td>
            <td class="text-center"><b>{{ "0.00" }}</b></td>
            <td class="text-right">{{ __("DIFERENCIA:") }}</td>
            <td class="text-right" colspan="2" style="font-size: 10pt">
                @php
                    $diferencia = $facturaDolar - $recibo->montoRecibido;
                @endphp
                <b>$ {{ number_format($diferencia, 2, ".", ",") }}</b>
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
                           <th>{{ number_format($recibo->montoRecibido, 2) ?? "0.00" }}</th>
                           <th>{{ number_format($recibo->SALDO_DOC, 2) ?? "0.00" }}</th>
                        @else
                            <th>0.00</th>
                            <th>0.00</th>
                        @endif
                    </tr>
                </table>
            </td>
            <td class="text-center">
                RENTENCION IVA<br>
                <input type="checkbox" id="si" style="display: inline;"/><label for="si">SI</label>
                <input type="checkbox" id="no" style="display: inline;"/><label for="no">NO</label>
            </td>
            <td class="text-right">MONTO RETENIDO: {{ __("0.00") }} Bs.</td>
{{--            <td class="text-right" colspan="2">VUELTO</td>--}}
{{--            <td class="text-right">{{ __("0.00") }}</td>--}}

            <td colspan="4">
                <table class="table-bordered" style="width: 100%;">
                    <tr class="text-right">
                        <td>VUELTO:</td>
                        <td><b>$ {{ number_format($recibo->VUELTO, 2) ?? "0.00" }}</b></td>
                    </tr>
                    <tr class="text-right">
                        <td>SALDO DOCUMENTO:</td>
                        <td><b>$ {{ number_format($recibo->SALDO_DOC, 2) ?? "0.00" }}</b></td>
                    </tr>
                    <tr class="text-right">
                        <td>TOTAL CANCELADO $:</td>
                        <td><b>$ {{ number_format( ($recibo->TIPO_DOC == "FA") ? $recibo->factura->total_cobrado : $recibo->notaEntrega->total_cobrado, 2) }}</b></td>
                    </tr>
                    <tr class="text-right">
                        <td>TOTAL CANCELADO BS.:</td>
                        <td><b>$ {{ number_format( ($recibo->TIPO_DOC == "FA") ? $recibo->factura->total_cobrado * $recibo->TASA_CAMB : $recibo->notaEntrega->total_cobrado * $recibo->TASA_CAMB, 2) }}</b></td>
                    </tr>
                </table>
            </td>
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
                            $cantidad = "";
                            $denominacion = $item;
                            $totalUsd = 0;
                            $totalVef = 0;
                        @endphp
                        @foreach($recibo->reciboDet as $bill)
                            @if($bill->DENOMINACION == $item)
                                @php
                                    $cantidad = $bill->CANTIDAD;
                                    $denominacion = $bill->DENOMINACION;
                                    $totalUsd = $bill->DENOMINACION * $bill->CANTIDAD;
                                    $totalVef = $totalUsd * $recibo->TASA_CAMB;

                                $sumTotalUsd += $totalUsd;
                                $sumTotalVef += $totalVef;
                                @endphp
                            @endif
                        @endforeach
                        <tr class="text-center">
                            <td>{{ $cantidad }}</td>
                            <td>{{ number_format($denominacion, 2, ".", ",") }}</td>
                            <td>{{ number_format($totalUsd, 2) }}</td>
                            <td>{{ number_format($totalVef, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="text-center" style="font-size: 9pt; font-weight: bold">TOTAL</td>
                        <td class="text-center"
                            style="font-size: 9pt; font-weight: bold">{{ number_format($sumTotalUsd, 2) }}</td>
                        <td class="text-center"
                            style="font-size: 9pt; font-weight: bold">{{ number_format($sumTotalVef, 2) }}</td>
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
    @if($x < ($copies-1))
        <hr style="border-top: 1px dotted; border-bottom: none;">
    @endif
@endfor

</body>

</html>
