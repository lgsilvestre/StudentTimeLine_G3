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
            'name' => 'Ingenieria Civil en Computacion',
        ]);
        Carrera::create([
            'name' => 'Ingenieria Civil Industrial',
        ]);
        Carrera::create([
            'name' => 'Ingenieria Civil en Obras Civiles',
        ]);
        Carrera::create([
            'name' => 'Ingenieria Civil de Minas',
        ]);
        Carrera::create([
            'name' => 'Ingenieria Civil Mecatronica',
        ]);
        Carrera::create([
            'name' => 'Ingenieria Civil Mecanica',
        ]);
        Carrera::create([
            'name' => 'Ingenieria Civil Electrica',
        ]);
    }
}
