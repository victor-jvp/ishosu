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
        <th style="font-size: 10pt;">RELACION DE Bs. RECIBIDOS</th>
    </tr>
</table>

<br>

<table class="table-bordered" style="width: 100%;">
    <thead>
    <tr style="background-color: lightgrey">
        <td class="text-center" colspan="5" style="font-weight: bold;"></td>
        <td class="text-center"  style="font-weight: bold;"></td>
        <td class="text-center" colspan="2" style="font-weight: bold;">AREA DE COBRANZAS</td>
    </tr>
    <tr style="background-color: lightgrey">
        <td class="text-center" style="font-weight: bold;">Nº RECIBO</td>
        <td class="text-center" style="font-weight: bold;">FECHA</td>
        <td class="text-center" style="font-weight: bold;">CODIGO</td>
        <td class="text-center" style="font-weight: bold;">CLIENTE</td>
        <td class="text-center" style="font-weight: bold;">NRO. DOC.</td>
        <td class="text-center" style="font-weight: bold;">DATOS BANCARIOS</td>
        <td class="text-center" style="font-weight: bold;">FECHA ENTREGA</td>
        <td class="text-center" style="font-weight: bold;">FIRMA</td>
    </tr>
    </thead>
    <tbody>
    @foreach($relacion->recibos as $recibo)
        <tr>
            <td class="text-center" style="padding: 5px;">{{ $recibo->idZero }}</td>
            <td class="text-center" style="padding: 5px;">{{ $recibo->FECHA->format("d/m/Y") }}</td>
            <td class="text-right"
                style="padding: 5px;">{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->CODICLIE : $recibo->notaEntrega->CODICLIE }}</td>
            <td class=""
                style="padding: 5px;">{{ ($recibo->TIPO_DOC == "FA") ? $recibo->factura->cliente->NOMBCLIE : $recibo->notaEntrega->cliente->NOMBCLIE }}</td>
            <td class="text-center" style="padding: 5px;">{{ $recibo->NUMEDOCU }}</td>
            <td>
                <table style="width: 100%;">
                @foreach($recibo->reciboDet as $item)
                    <tr>
                        <td>{{ $item->REFERENCIA }}</td>
                        <td>-Banco Emisor-</td>
                        <td>-Banco Receptor-</td>
                        <td class="text-right">{{ $item->MONTO }}</td>
                    </tr>
                @endforeach
                </table>
            </td>
            <td class="text-right" style="padding: 5px;">______________</td>
            <td class="text-right" style="padding: 5px;">______________</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr class="text-right" style="">
        <td colspan="5" style="padding: 5px; font-size: 9pt;">TOTAL:</td>
        <td style="padding: 5px; font-size: 9pt;">0.00</td>
        <td colspan="2"></td>
    </tr>
    </tfoot>
</table>

</body>

</html>
