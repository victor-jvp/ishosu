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
        <th style="font-size: 10pt;" colspan="2">RELACION DE PAGOS EN TRANSFERENCIA</th>
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

    <tr style="background-color: lightgrey;">
        <td class="text-center" colspan="5" style="font-weight: bold;">AREA DE CAJA</td>
        <td class="text-center" colspan="5" style="font-weight: bold;">DATOS BANCARIOS</td>
        <td class="text-center" colspan="2" style="font-weight: bold;">AREA DE COBRANZAS</td>
    </tr>
    <tr style="background-color: lightgrey; padding: 8px">
        <td class="text-center" style="font-weight: bold;">Nº RECIBO</td>
        <td class="text-center" style="font-weight: bold;">FECHA RECIBO</td>
        <td class="text-center" style="font-weight: bold;">CODIGO</td>
        <td class="text-center" style="font-weight: bold;">CLIENTE</td>
        <td class="text-center" style="font-weight: bold;">NRO. DOC.</td>
        <td class="text-center" style="font-weight: bold;">FECHA PAGO</td>
        <td class="text-center" style="font-weight: bold;">REFERENCIA</td>
        <td class="text-center" style="font-weight: bold;">BANCO EMISOR</td>
        <td class="text-center" style="font-weight: bold;">BANCO RECEPTOR</td>
        <td class="text-center" style="font-weight: bold;">MONTO</td>
        <td class="text-center" style="font-weight: bold;">FECHA ENTREGA</td>
        <td class="text-center" style="font-weight: bold;">FIRMA</td>
    </tr>
    @php
        $sumMonto = 0;
        $nDecimals = ($relacion->TIPO_MONEDA == "VEF") ? 2 : 3;
    @endphp
    @foreach($relacion->recibos as $recibo)
        <tr style="font-size: 6.5pt !important">
            <td class="text-center" style="padding: 3px;">{{ $recibo->idZero }}</td>
            <td class="text-center" style="padding: 3px;">{{ $recibo->FECHA->format("d/m/Y") }}</td>
            <td class="text-center"
                style="padding: 3px;">{{ $recibo->CODICLIE ?? "" }}</td>
            <td class=""
                style="padding: 3px;">{{ $recibo->NOMBCLIE ?? "" }}</td>
            <td class="text-center" style="padding: 3px;">{{ $recibo->NUMEDOCU }}</td>
            @if ($recibo->TIPO_PAGO == 'T')
            <td class="text-center">
                @foreach ($recibo->reciboDet as $det)
                {{ (!is_null($det->FECHA_PAGO)) ? $det->FECHA_PAGO->format("d/m/Y") : "" }}<br>
                @endforeach
            </td>
            <td class="text-center">
                @foreach ($recibo->reciboDet as $det)
                {{ $det->REFERENCIA ?? "" }}<br>
                @endforeach
            </td>
            <td>
                @foreach ($recibo->reciboDet as $det)
                {{ $det->bank_e->NOMBRE ?? "" }}<br>
                @endforeach
            </td>
            <td>
                @foreach ($recibo->reciboDet as $det)
                {{ $det->bank_r->NOMBBANC ?? "" }}<br>
                @endforeach
            </td>
            <td class="text-right">
                @foreach ($recibo->reciboDet as $det)
                    {{ number_format($det->MONTO ?? 0, 2)  }}<br>
                    @php($sumMonto += $det->MONTO)
                @endforeach
            </td>
            @else
            <td colspan="4" class="text-center">- EFECTIVO -</td>
            <td class="text-right">
                {{ number_format($recibo->montoRecibido, 2) }}
                @php($sumMonto += $recibo->montoRecibido)
            </td>
            @endif
            <td style="padding: 3px; width: 6%"></td>
            <td style="padding: 3px; width: 6%"></td>
        </tr>
    @endforeach

    <tfoot>
    <tr class="text-right" style="">
        <td colspan="9" style="padding: 3px; font-size: 9pt;">TOTAL:</td>
        <td style="padding: 3px; font-size: 8pt;">{{ number_format($sumMonto, 2) }}</td>
        <td colspan="2"></td>
    </tr>
    </tfoot>
</table>

<table style="width: 100%">
    <tr>
        <td>ANALISTA DE CAJA: <b>{{ $relacion->createdBy->name }}</b></td>
        <td>ANALISTA DE CONFIRMACION: __________________________</td>
    <tr>
        <td>FECHA Y HORA: {{ date("d/m/Y h:i a") }}</td>
        <td>FECHA Y HORA DE RECEPCION:</td>
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
