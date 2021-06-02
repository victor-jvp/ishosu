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
    @php($sumMonto = 0)
    @foreach($relacion->recibos as $recibo)
        <tr style="font-size: 6.5pt !important">
            <td class="text-center" style="padding: 5px;">{{ $recibo->idZero }}</td>
            <td class="text-center" style="padding: 5px;">{{ $recibo->FECHA->format("d/m/Y") }}</td>
            <td class="text-right"
                style="padding: 5px;">{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->CODICLIE : $recibo->notaEntrega->CODICLIE }}</td>
            <td class=""
                style="padding: 5px;">{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->cliente->NOMBCLIE : $recibo->notaEntrega->cliente->NOMBCLIE }}</td>
            <td class="text-center" style="padding: 5px;">{{ $recibo->NUMEDOCU }}</td>
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
                {{ $det->bank_e->name ?? "" }}<br>
                @endforeach
            </td>
            <td>
                @foreach ($recibo->reciboDet as $det)
                {{ $det->bank_r->name ?? "" }}<br>
                @endforeach
            </td>
            <td class="text-right">
                @foreach ($recibo->reciboDet as $det)
                {{ number_format($det->MONTO, 2) ?? "" }}<br>
                @endforeach
            </td>
            <td style="padding: 5px; width: 6%"></td>
            <td style="padding: 5px; width: 6%"></td>
        </tr>

        @php($sumMonto += $det->MONTO)
    @endforeach

    <tfoot>
    <tr class="text-right" style="">
        <td colspan="9" style="padding: 5px; font-size: 9pt;">TOTAL:</td>
        <td style="padding: 5px; font-size: 8pt;">{{ number_format($sumMonto, 2) }}</td>
        <td colspan="2"></td>
    </tr>
    </tfoot>
</table>
<br><br>
<hr>

<table style="width: 100%">
    <tr>
        <td>ANALISTA DE CAJA:</td>
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
