<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Comprobante de Pago - {{ $recibo->idZero }}</title>

    <style>
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

    <table class="table-bordered" style="width: 100%;">

        <tr>
            <th colspan="6" style="font-size: 10pt; background-color: lightgrey">COMPROBANTE DE PAGO</th>
        </tr>

        <tr>
            <td class="text-center" rowspan="2" colspan="2"
                style="width: 150px; font-size: 11pt; font-weight: bold">{{ $recibo->idZero }}</td>
            <td class="text-right">{{ __("CLIENTE:") }}</td>
            <td class="text-center">
                <b>{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->CODICLIE : $recibo->notaEntrega->CODICLIE }}</b>
            </td>
            <td class="text-center" colspan="2" style="padding: 5px;">
                <b>{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->cliente->NOMBCLIE : $recibo->notaEntrega->cliente->NOMBCLIE }}</b>
            </td>
        </tr>

        <tr>
            <td class="text-right" style="padding: 5px;">{{ __("RUTA:") }}</td>
            <td class="text-center">
                <b>{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->CODIRUTA : $recibo->notaEntrega->CODIRUTA }}</b>
            </td>
            <td class="text-right">{{ __("FECHA:") }}</td>
            <td class="text-center"><b>{{ $recibo->FECHA->format("d/m/Y") }}</b></td>
        </tr>

        <tr>
            <td colspan="3"></td>
            <td class="text-right" style="padding: 5px;">NUMERO DOC:</td>
            <td class="text-center" colspan="2" style="font-weight: bold; font-size: 10pt">{{ $recibo->NUMEDOCU }}</td>
        </tr>

        <tr>
            <td colspan="2" class="text-right">Tipo de Cobro:</td>
            <td colspan="4"><b>
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
        </tr>

        <tr>
            <td colspan="4">
                <table class="table-bordered" style="width: 100%">
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
            <td colspan="2"
                style="text-align: center; font-size: 10pt; font-weight: bold; vertical-align: baseline; text-decoration: underline">
                RECIBI CONFORME
            </td>
        </tr>

        <tr style="font-size: 9pt">
            <td colspan="3" style="padding: 5px 5px 15px;">
                Cajera: <b>{{ $recibo->createdBy->name }}</b>
            </td>
            <td colspan="" style="padding: 5px 5px 15px;">Hora de Entrega:</td>
            <td colspan="2" style="padding: 5px 5px 15px;">Firma y Nombre</td>
        </tr>

    </table>

</body>

</html>
