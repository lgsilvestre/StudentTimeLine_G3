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
        ]);
        Carrera::create([
            'nombre' => 'Ingenieria Civil Industrial',
        ]);
        Carrera::create([
            'nombre' => 'Ingenieria Civil en Obras Civiles',
        ]);
        Carrera::create([
            'nombre' => 'Ingenieria Civil de Minas',
        ]);
        Carrera::create([
            'nombre' => 'Ingenieria Civil Mecatronica',
        ]);
        Carrera::create([
            'nombre' => 'Ingenieria Civil Mecanica',
        ]);
        Carrera::create([
            'nombre' => 'Ingenieria Civil Electrica',
        ]);
    }
}
