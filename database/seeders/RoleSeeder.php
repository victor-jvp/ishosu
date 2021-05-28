<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Supervisor']);
        $role3 = Role::create(['name' => 'Analista de Caja']);

        Permission::create(['name' => 'config.users.index'])->assignRole($role1);
        Permission::create(['name' => 'config.users.create'])->assignRole($role1);
        Permission::create(['name' => 'config.users.update'])->assignRole($role1);
        Permission::create(['name' => 'config.users.delete'])->assignRole($role1);

        Permission::create(['name' => 'recibos.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'recibos.create'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'recibos.update'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'recibos.delete'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'relaciones.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'relaciones.create'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'relaciones.update'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'relaciones.delete'])->syncRoles([$role1, $role2, $role3]);
    }
}
