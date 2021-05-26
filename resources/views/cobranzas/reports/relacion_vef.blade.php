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
        <td>ANALISTA DE CAJA: {{ __("CAJERA 01") }}</td>
        <td class="text-right">Pág: 01 de 02</td>
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

    @foreach($relacion->recibos as $recibo)
        <tr>
            <td class="text-center" style="padding: 5px;">{{ $recibo->idZero }}</td>
            <td class="text-center" style="padding: 5px;">{{ $recibo->FECHA->format("d/m/Y") }}</td>
            <td class="text-right"
                style="padding: 5px;">{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->CODICLIE : $recibo->notaEntrega->CODICLIE }}</td>
            <td class=""
                style="padding: 5px;">{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->cliente->NOMBCLIE : $recibo->notaEntrega->cliente->NOMBCLIE }}</td>
            <td class="text-center" style="padding: 5px;">{{ $recibo->NUMEDOCU }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
{{--            <td>--}}
{{--                <table style="width: 100%;">--}}
{{--                @foreach($recibo->reciboDet as $item)--}}
{{--                    <tr>--}}
{{--                        <td>dd/mm/yyyy</td>--}}
{{--                        <td>{{ $item->REFERENCIA }}</td>--}}
{{--                        <td class="text-center">-Banco Emisor-</td>--}}
{{--                        <td class="text-center">-Banco Receptor-</td>--}}
{{--                        <td class="text-right">{{ number_format($item->MONTO, 2) }}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </table>--}}
{{--            </td>--}}
            <td class="text-right" style="padding: 5px;"></td>
            <td class="text-right" style="padding: 5px;"></td>
        </tr>
    @endforeach

    <tfoot>
    <tr class="text-right" style="">
        <td colspan="9" style="padding: 5px; font-size: 9pt;">TOTAL:</td>
        <td style="padding: 5px; font-size: 9pt;">0.00</td>
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

</body>

</html>
