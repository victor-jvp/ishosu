<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Comprobante de Pago - {{ $relacion->idZero }}</title>

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
            font-size: 7pt;
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

<table style="width: 100%;">
    <tr>
        <th style="font-size: 10pt;" colspan="2">RELACION DE EFECTIVO RECIBIDO</th>
    </tr>
    <tr>
        <th style="font-size: 9pt;" colspan="2">TIPO DE MONEDA: {{ $relacion->TIPO_MONEDA }}</th>
    </tr>
    <tr>
        <td style="font-size: 9pt;">CAJA 01:</td>
    </tr>
    <tr>
        <td>ANALISTA DE CAJA: <b>{{ $relacion->createdBy->name }}</b></td>
    </tr>
</table>

<br>

<table class="table-bordered" style="width: 100%;">
    <tbody>
    <tr style="background-color: lightgrey">
        <td class="text-center" style="font-weight: bold;">Nº RECIBO</td>
        <td class="text-center" style="font-weight: bold;">FECHA</td>
        <td class="text-center" style="font-weight: bold;">CODIGO</td>
        <td class="text-center" style="font-weight: bold;">CLIENTE</td>
        <td class="text-center" style="font-weight: bold;">RUTA</td>
        <td class="text-center" style="font-weight: bold;">NRO. DOC.</td>
        <td class="text-center" style="font-weight: bold;">MONTO DOC.</td>
        <td class="text-center" style="font-weight: bold;">TOTAL {{ $relacion->TIPO_MONEDA }}<br>RECIBIDOS</td>
        <td class="text-center" style="font-weight: bold;">SALDO DOC.</td>
        <td class="text-center" style="font-weight: bold;">VUELTO</td>
    </tr>
    @php
        $totalMontoDoc = 0;
        $totalRecibidos = 0;
        $totalSaldoDoc = 0;
        $totalVuelto = 0;
    @endphp
    @foreach($relacion->recibos as $recibo)
        @php

            $nDecimals = ($recibo->TIPO_MONEDA == "VEF") ? 2 : 3;

            $totalMontoDoc += $recibo->MONTO_DOC - $recibo->MONTO_RET;
            $totalRecibidos += $recibo->montoRecibido;
            $totalSaldoDoc += $recibo->SALDO_DOC;
            $totalVuelto += $recibo->VUELTO;
        @endphp

        <tr>
            <td class="text-center" style="padding: 3px;">{{ $recibo->idZero }}</td>
            <td class="text-center" style="padding: 3px;">{{ $recibo->FECHA->format("d/m/Y") }}
                <br>{{ $recibo->FECHA->format("h:i a") }}</td>
            <td class="text-right"
                style="padding: 3px;">{{ $recibo->CODICLIE ?? '' }}</td>
            <td class=""
                style="padding: 3px;">{{ $recibo->NOMBCLIE ?? '' }}</td>
            <td>{{ $recibo->CODIRUTA." - ". $recibo->NOMBVEND }}</td>
            <td class="text-center" style="padding: 3px;">{{ $recibo->NUMEDOCU }}</td>
            <td class="text-right">
                {{ number_format($recibo->MONTO_DOC - $recibo->MONTO_RET, 2) }}
            </td>
            <td class="text-right" style="padding: 3px;">{{ number_format( $recibo->montoRecibido, 2, ".", "," ) }}</td>
            <td class="text-right">{{ number_format($recibo->SALDO_DOC, 2) }}</td>
            <td class="text-right">{{ number_format($recibo->VUELTO, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr class="text-right">
        <td colspan="6" style="padding: 3px; font-size: 9pt;">TOTAL:</td>
        <td style="padding: 3px; font-size: 9pt;">{{ number_format($totalMontoDoc, 2) }}</td>
        <td style="padding: 3px; font-size: 9pt;">{{ number_format($totalRecibidos, 2) }}</td>
        <td style="padding: 3px; font-size: 9pt;">{{ number_format($totalSaldoDoc, 2) }}</td>
        <td style="padding: 3px; font-size: 9pt;">{{ number_format($totalVuelto, 2) }}</td>
    </tr>
    </tfoot>
</table>

<br><br>
<hr>

<table style="width: 100%">
    <tr>
        <td>ANALISTA DE CAJA: <b>{{ $relacion->createdBy->name }}</b></td>
        <td>REVISADO POR: __________________________</td>
    <tr>
        <td>FECHA Y HORA: {{ date("d/m/Y h:i a") }}</td>
    </tr>
    <tr>
        <td>FIRMA: __________________________</td>
        <td>FIRMA: __________________________</td>
    </tr>
</table>

<script type="text/php">
    if (isset($pdf)) {
        $text = "Página {PAGE_NUM} / {PAGE_COUNT}";
        $size = 10;
        $font = $fontMetrics->getFont("Verdana");
        $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
        $x = ($pdf->get_width() - $width) / 2;
        $y = $pdf->get_height() - 35;
        $pdf->page_text($x, $y, $text, $font, $size);
    }
</script>

</body>

</html>
