<?php

namespace Database\Seeders;

use App\Models\Estacion;
use Illuminate\Database\Seeder;

class EstacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Estacion::create(['codigo' => 'A', 'name' => 'estacion1']);
        Estacion::create(['codigo' => 'B', 'name' => 'estacion2']);
        Estacion::create(['codigo' => 'C', 'name' => 'estacion3']);
        Estacion::create(['codigo' => 'D', 'name' => 'estacion4']);
        Estacion::create(['codigo' => 'T', 'name' => 'ESTACION TUCUPITA']);

    }
}
