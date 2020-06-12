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
            'nombre' => 'Ingeniería Civil en Computación',
            'codigo_carrera' => 3407,
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil Industrial',
            'codigo_carrera' => 3406,
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil en Obras Civiles',
            'codigo_carrera' => 3408,
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil de Minas',
            'codigo_carrera' => 3409,
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil Mecatrónica',
            'codigo_carrera' => 3404,
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil Mecánica',
            'codigo_carrera' => 3405,
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil Eléctrica',
            'codigo_carrera' => 3410,
        ]);
    }
}
