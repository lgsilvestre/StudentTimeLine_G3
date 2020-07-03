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

        $sec_compu = Role::create([
            'name' => 'Secretaria de Escuela - Ing. civil en Computación', //Se refiere a la secretaría de escuela
            'slug' => 'secretariaComputacion',
        ]);
        $sec_indu = Role::create([
            'name' => 'Secretaria de Escuela - Ing. civil Industrial', //Se refiere a la secretaría de escuela
            'slug' => 'secretariaIndustrial',
        ]);
        $sec_obras = Role::create([
            'name' => 'Secretaria de Escuela - Ing. civil en Obras civiles', 
            'slug' => 'secretariaObras',
        ]);
        $sec_mecatronica = Role::create([
            'name' => 'Secretaria de Escuela - Ing. civil Mecatrónica ', 
            'slug' => 'secretariaMecatronica',
        ]);
        $sec_mecanica = Role::create([
            'name' => 'Secretaria de Escuela - Ing. civil Mecánica', 
            'slug' => 'secretariaMecanica',
        ]);
        $sec_minas = Role::create([
            'name' => 'Secretaria de Escuela - Ing. civil en Minas', 
            'slug' => 'secretariaMinas',
        ]);
        $sec_electrica = Role::create([
            'name' => 'Secretaria de Escuela - Ing. civil Eléctrica', 
            'slug' => 'secretariaElectrica',
        ]);

        $sec_juegos = Role::create([
            'name' => 'Secretaria de Escuela - Ing. en Desarrollo de videojuegos y Realidad Virtual', 
            'slug' => 'secretariaVideojuegos',
        ]);
        $sec_bioinformatica = Role::create([
            'name' => 'Secretaria de Escuela - Ing. civil en Bioinformatica', 
            'slug' => 'secretariaBioinformatica',
        ]);
        
        $sec_juegos->givePermissionTo('bioinformatica.addUser');
        $sec_bioinformatica->givePermissionTo('videojuegos.addUser');
        $sec_compu->givePermissionTo('computacion.addUser');
        $sec_indu->givePermissionTo('industrial.addUser');
        $sec_obras->givePermissionTo('obras.addUser');
        $sec_mecatronica->givePermissionTo('mecatronica.addUser');
        $sec_mecanica->givePermissionTo('mecanica.addUser');
        $sec_minas->givePermissionTo('minas.addUser');
        $sec_electrica->givePermissionTo('electrica.addUser');

        
        /* factory(Role::class, 1000)->create(); */
    }
}
