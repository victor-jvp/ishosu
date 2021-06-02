<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Bank::create(['code' => '0196', 'name' => 'ABN AMRO BANK', 'tipo' => 'E']);
        Bank::create(['code' => '0172', 'name' => 'BANCAMIGA BANCO MICROFINANCIERO, C.A.', 'tipo' => 'E']);
        Bank::create(['code' => '0171', 'name' => 'BANCO ACTIVO BANCO COMERCIAL, C.A.', 'tipo' => 'E']);
        Bank::create(['code' => '0166', 'name' => 'BANCO AGRICOLA', 'tipo' => 'E']);
        Bank::create(['code' => '0175', 'name' => 'BANCO BICENTENARIO', 'tipo' => 'E']);
        Bank::create(['code' => '0128', 'name' => 'BANCO CARONI, C.A. BANCO UNIVERSAL', 'tipo' => 'E']);
        Bank::create(['code' => '0164', 'name' => 'BANCO DE DESARROLLO DEL MICROEMPRESARIO', 'tipo' => 'E']);
        Bank::create(['code' => '0102', 'name' => 'BANCO DE VENEZUELA S.A.I.C.A.', 'tipo' => 'A']);
        Bank::create(['code' => '0114', 'name' => 'BANCO DEL CARIBE C.A.', 'tipo' => 'A']);
        Bank::create(['code' => '0149', 'name' => 'BANCO DEL PUEBLO SOBERANO C.A.', 'tipo' => 'E']);
        Bank::create(['code' => '0163', 'name' => 'BANCO DEL TESORO', 'tipo' => 'E']);
        Bank::create(['code' => '0176', 'name' => 'BANCO ESPIRITO SANTO, S.A.', 'tipo' => 'E']);
        Bank::create(['code' => '0115', 'name' => 'BANCO EXTERIOR C.A.', 'tipo' => 'E']);
        Bank::create(['code' => '0003', 'name' => 'BANCO INDUSTRIAL DE VENEZUELA.', 'tipo' => 'E']);
        Bank::create(['code' => '0173', 'name' => 'BANCO INTERNACIONAL DE DESARROLLO, C.A.', 'tipo' => 'E']);
        Bank::create(['code' => '0105', 'name' => 'BANCO MERCANTIL C.A.', 'tipo' => 'E']);
        Bank::create(['code' => '0191', 'name' => 'BANCO NACIONAL DE CREDITO', 'tipo' => 'E']);
        Bank::create(['code' => '0116', 'name' => 'BANCO OCCIDENTAL DE DESCUENTO.', 'tipo' => 'E']);
        Bank::create(['code' => '0138', 'name' => 'BANCO PLAZA', 'tipo' => 'E']);
        Bank::create(['code' => '0108', 'name' => 'BANCO PROVINCIAL BBVA', 'tipo' => 'E']);
        Bank::create(['code' => '0104', 'name' => 'BANCO VENEZOLANO DE CREDITO S.A.', 'tipo' => 'E']);
        Bank::create(['code' => '0168', 'name' => 'BANCRECER S.A. BANCO DE DESARROLLO', 'tipo' => 'E']);
        Bank::create(['code' => '0134', 'name' => 'BANESCO BANCO UNIVERSAL', 'tipo' => 'E']);
        Bank::create(['code' => '0177', 'name' => 'BANFANB', 'tipo' => 'E']);
        Bank::create(['code' => '0146', 'name' => 'BANGENTE', 'tipo' => 'E']);
        Bank::create(['code' => '0174', 'name' => 'BANPLUS BANCO COMERCIAL C.A', 'tipo' => 'E']);
        Bank::create(['code' => '0190', 'name' => 'CITIBANK.', 'tipo' => 'E']);
        Bank::create(['code' => '0121', 'name' => 'CORP BANCA.', 'tipo' => 'E']);
        Bank::create(['code' => '0157', 'name' => 'DELSUR BANCO UNIVERSAL', 'tipo' => 'E']);
        Bank::create(['code' => '0151', 'name' => 'FONDO COMUN', 'tipo' => 'E']);
        Bank::create(['code' => '0601', 'name' => 'INSTITUTO MUNICIPAL DE CRÉDITO POPULAR', 'tipo' => 'E']);
        Bank::create(['code' => '0169', 'name' => 'MIBANCO BANCO DE DESARROLLO, C.A.', 'tipo' => 'E']);
        Bank::create(['code' => '0137', 'name' => 'SOFITASA', 'tipo' => 'E']);
    }
}
