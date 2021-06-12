<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'username' => 'admin',
            'name'     => 'Super Administrador',
            'email'    => 'superadmin@admin.com',
            'password' => bcrypt("123123")
        ])->assignRole('Admin');

        User::create([
            'username'    => 'vveliz',
            'name'        => 'Victor Veliz',
            'email'       => 'ing.vj15@gmail.com',
            'estacion_id' => 3,
            'password'    => bcrypt("IMAtion2011")
        ])->assignRole('Admin');
    }
}
