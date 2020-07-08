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
        $secretaria = Role::create([
            'name' =>'Secretaría de Escuela',
            'slug' =>'secretaria',
        ]);
       
        $secretaria->givePermissionTo('modulos.index','categoria.index','estudiante.add','addUser');
        
        /* factory(Role::class, 1000)->create(); */
    }
}
