@extends('layouts.app')
@section('title', 'Recibos')

@section('content')

<section class="content">
    <div class="container-fluid">
        {{-- <div class="block-header">
            <h2>
                RECIBOS DE COBRO
                <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small>
            </h2>
        </div> --}}

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Lista de Recibos
                            {{-- <small>Description text here...</small> --}}
                        </h2>
                        <ul class="header-dropdown m-r-0">
                            <li>
                                <a href="{{ route('recibos.create') }}" data-toggle="tooltip" data-placement="auto"
                                    data-original-title="Agregar"
                                    class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                                    <i class="material-icons">add_circle</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped table-hover dataTable js-exportable" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nro.</th>
                                        <th>Fecha</th>
                                        <th>Tipo de Relacion</th>
                                        <th>Cajera</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>

@endsection

@section('styles')
<!-- JQuery DataTable Css -->
<link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endsection

@section('scripts')
<!-- Jquery DataTable Plugin Js -->
<script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<!-- tooltips-popovers -->
<script src="../../js/pages/ui/tooltips-popovers.js"></script>

<script>
    $(document).ready(function(){
        //Tooltip
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });

        $("#table").DataTable({
            language: table_es_lang,
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],

        })
    })
</script>
@endsection
