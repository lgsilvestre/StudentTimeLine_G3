<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role; 

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrador',
            'slug' => 'admin',
            'special' => 'all-access',
        ]);

        Role::create([
            'name' => 'Profesor',
            'slug' => 'profe',
        ]);

        Role::create([
            'name' => 'Secretaria de Escuela', //Se refiere a la secretaría de escuela
            'slug' => 'secretaria',
        ]);
    }
}
