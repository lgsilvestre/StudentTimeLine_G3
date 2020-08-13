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
            'codigo_carrera' => 34007,
            'imagen' => 'icc.jpg',
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil Industrial',
            'codigo_carrera' => 34006,
            'imagen' => 'ici.jpg',
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil en Obras Civiles',
            'codigo_carrera' => 34037,
            'imagen' => 'icoc.jpg',
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil de Minas',
            'codigo_carrera' => 34068,
            'imagen' => 'minas.jpg',
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil Mecatrónica',
            'codigo_carrera' => 34066,
            'imagen' => 'mkt.jpg',
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil Mecánica',
            'codigo_carrera' => 34039,
            'imagen' => 'icm.jpg',
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil Eléctrica',
            'codigo_carrera' => 34078,
            'imagen' => 'ice.jpg',
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil en Bioinformática',
            'codigo_carrera' => 34009,
            'imagen' => 'icb.jpg',
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería en Desarrollo de Videojuegos y Realidad Virtual',
            'codigo_carrera' => 34079,
            'imagen' => 'idvrv.jpg',
        ]);
    }
}
