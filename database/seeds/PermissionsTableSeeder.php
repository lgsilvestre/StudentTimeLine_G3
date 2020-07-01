<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission; 

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //permisos de usuario
        Permission::create([
            'name' => 'Navegar categorias',
            'slug' => 'categoria.index',
            'description' => 'Lista y navega todas las categorias de observaciones',
        ]);
        Permission::create([
            'name' => 'Navegar Usuarios del sistema',
            'slug' => 'users.index',
            'description' => 'Lista y navega todos los usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Navegar los modulos de las carreras',
            'slug' => 'modulos.index',
            'description' => 'Lista y navega todos los modulos del sistema',
        ]);
        Permission::create([
            'name' => 'Añadir estudiante',
            'slug' => 'estudiante.add',
            'description' => 'Podra añadir estudiante de la carrera que se le asigne',
        ]);

        /** 
         * 
         * Añadir usuarios por carrera
         * 
         * 
        */
        
        Permission::create([
            'name' => 'Añadir usuario carrera ing civil en computación',
            'slug' => 'computacion.addUser',
            'description' => 'Podra añadir usuario de la carrera ing civil en computación',
        ]);
        Permission::create([
            'name' => 'Añadir usuario carrera ing civil industrial',
            'slug' => 'industrial.addUser',
            'description' => 'Podra añadir usuario de la carrera ing civil industrial',
        ]);
        Permission::create([
            'name' => 'Añadir usuario carrera ing civil mecanica',
            'slug' => 'mecanica.addUser',
            'description' => 'Podra añadir usuario de la carrera ing civil mecanica',
        ]);
        Permission::create([
            'name' => 'Añadir usuario carrera ing civil electrica',
            'slug' => 'electrica.addUser',
            'description' => 'Podra añadir usuario de la carrera ing civil electrica',
        ]);
        Permission::create([
            'name' => 'Añadir usuario carrera ing civil en obras civiles',
            'slug' => 'obras.addUser',
            'description' => 'Podra añadir usuario de la carrera ing civil en obras civiles',
        ]);
        Permission::create([
            'name' => 'Añadir usuario carrera ing civil en minas',
            'slug' => 'minas.addUser',
            'description' => 'Podra añadir usuario de la carrera ing civil en minas',
        ]);
        Permission::create([
            'name' => 'Añadir usuario carrera ing civil mecatronica',
            'slug' => 'mecatronica.addUser',
            'description' => 'Podra añadir usuario de la carrera ing civil mecatronica',
        ]);
        Permission::create([
            'name' => 'Añadir usuario carrera ing civil en Bioinformatica',
            'slug' => 'bioinformatica.addUser',
            'description' => 'Podra añadir usuario de la carrera ing civil en Bioinformatica',
        ]);
        Permission::create([
            'name' => 'Añadir usuario carrera ing civil en Desarrollo de Videojuegos y Realidad Virtual',
            'slug' => 'videojuegos.addUser',
            'description' => 'Podra añadir usuario de la carrera ing civil en Desarrollo de Videojuegos y Realidad Virtual',
        ]);
        
        
    }
}
