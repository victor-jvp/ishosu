<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Comprobante de Pago - {{ $recibo->idZero }}</title>

    <style type="text/css">
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
        .table-bordered, .table-bordered tr td{
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
            <th colspan="9" style="font-size: 10pt; background-color: lightgrey">COMPROBANTE DE PAGO</th>
        </tr>
        <tr>
            <td class="text-center" rowspan="2" colspan="3" style="width: 150px; font-size: 11pt; font-weight: bold">{{ $recibo->idZero }}</td>
            <td class="text-right">{{ __("CLIENTE:") }}</td>
            <td class="text-center">
                <b>{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->CODICLIE : $recibo->notaEntrega->CODICLIE }}</b>
            </td>
            <td class="text-center" colspan="4">
                <b>{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->cliente->NOMBCLIE : $recibo->notaEntrega->cliente->NOMBCLIE }}</b>
            </td>
        </tr>
        <tr>
            <td class="text-right">{{ __("RUTA:") }}</td>
            <td class="text-center">
                <b>{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->CODIRUTA : $recibo->notaEntrega->CODIRUTA }}</b>
            </td>
            <td class="text-right">{{ __("FECHA:") }}</td>
            <td class="text-center"><b>{{ $recibo->FECHA->format("d/m/Y") }}</b></td>
            <td class="text-right" colspan="">{{ __("TASA:") }}</td>
            <td class="text-right" style="font-size: 10pt"><b>{{number_format( $recibo->TASA_CAMB, 2, ".", "," ) }}</b></td>
        </tr>
        <tr class="text-center">
            <td colspan="4"></td>
            <td>{{ __("MONTO FACTURA") }}</td>
            <td colspan="2">{{ __("MONTO A PAGAR") }}</td>
            <td class="text-right">{{ __("MONTO RECIBIDO EN $:") }}</td>
            <td class="text-right" style="font-size: 10pt">
                <b>{{ __("$ ".number_format($recibo->montoRecibido, 2, ".", ",")) }}</b>
            </td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td class="text-center" >
                <b>Bs. {{ number_format(($recibo->TIPO_DOC == "FA") ? $recibo->factura->TOTADOCU : $recibo->notaEntrega->TOTADOCU, 2, ".", ",") }}</b>
            </td>
            <td colspan="2" class="text-center">
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
            <td class="text-right">{{ __("DIFERENCIA:") }}</td>
            <td class="text-right" style="font-size: 10pt">
                @php
                    $diferencia = $facturaDolar - $recibo->montoRecibido;
                @endphp
                <b>$ {{ number_format($diferencia, 2, ".", ",") }}</b>
            </td>
        </tr>
        <tr>
            <td class="text-center" colspan="4">RENTENCION IVA:</td>
            <td class="text-center" colspan="2">
                <input type="checkbox" id="si" style="display: inline;"/><label for="si">SI</label>
                <input type="checkbox" id="no" style="display: inline;"/><label for="no">NO</label>
            </td>
            <td colspan="3">
                <table class="table-bordered" style="width: 100%;">
                    <tr class="text-right">
                        <td>SALDO:</td>
                        <td style="font-size: 10pt; font-weight: bold">0.00</td>
                    </tr>
                    <tr class="text-right">
                        <td>TOTAL CANCELACION $:</td>
                        <td style="font-size: 10pt; font-weight: bold">0.00</td>
                    </tr>
                    <tr class="text-right">
                        <td>TOTAL CANCELACION FACTURA BS:</td>
                        <td style="font-size: 10pt; font-weight: bold">0.00</td>
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
                        <td class="text-center" style="font-size: 9pt; font-weight: bold">{{ number_format($sumTotalUsd, 2) }}</td>
                        <td class="text-center" style="font-size: 9pt; font-weight: bold">{{ number_format($sumTotalVef, 2) }}</td>
                    </tr>
                </table>
            </td>
            <td colspan="2" style="text-align: center; font-size: 10pt; font-weight: bold; vertical-align: baseline; text-decoration: underline">
                RECIBI CONFORME
            </td>
        </tr>
        <tr style="font-size: 9pt">
            <td colspan="5" style="padding: 5px 5px 15px;">
                Cajera: <b>{{ $recibo->createdBy->name }}</b>
            </td>
            <td colspan="2" style="padding: 5px 5px 15px;">Hora de Entrega:</td>
            <td colspan="2" style="padding: 5px 5px 15px;">Firma y Nombre</td>
        </tr>
    </table>
    @if($x < ($copies-1))
    <hr style="border-top: 1px dotted; border-bottom: none;">
    @endif
    @endfor

</body>

</html>
