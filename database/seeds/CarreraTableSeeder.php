<?php

use Illuminate\Database\Seeder;
use App\Carrera;

class CarreraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carrera::create([
            'nombre' => 'Ingenieria Civil en Computacion',
            'codigo_carrera' => 3407,
        ]);
        Carrera::create([
            'nombre' => 'Ingenieria Civil Industrial',
            'codigo_carrera' => 3406,
        ]);
        Carrera::create([
            'nombre' => 'Ingenieria Civil en Obras Civiles',
            'codigo_carrera' => 3408,
        ]);
        Carrera::create([
            'nombre' => 'Ingenieria Civil de Minas',
            'codigo_carrera' => 3409,
        ]);
        Carrera::create([
            'nombre' => 'Ingenieria Civil Mecatronica',
            'codigo_carrera' => 3404,
        ]);
        Carrera::create([
            'nombre' => 'Ingenieria Civil Mecanica',
            'codigo_carrera' => 3405,
        ]);
        Carrera::create([
            'nombre' => 'Ingenieria Civil Electrica',
            'codigo_carrera' => 3410,
        ]);
    }
}
