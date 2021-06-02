<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class TipoDocumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TipoDocumento::create([
            "TIPO_DOC" => "FA",
            "DESCR"    => "Factura"
        ]);
        TipoDocumento::create([
            "TIPO_DOC" => "NE",
            "DESCR"    => "Nota de entrega"
        ]);
        TipoDocumento::create([
            "TIPO_DOC" => "ND",
            "DESCR"    => "Nota de Débito"
        ]);
    }
}
