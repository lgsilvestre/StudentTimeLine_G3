<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre' => 'Ayudantia',
        ]);
        Categoria::create([
            'nombre' => 'Practica',
        ]);
        Categoria::create([
            'nombre' => 'Copia',
        ]);
        Categoria::create([
            'nombre' => 'Otro',
        ]);
        Categoria::create([
            'nombre' => 'En Observacion - 1 por Tercera',
        ]);
        Categoria::create([
            'nombre' => 'En Observacion - 1 por Segunda',
        ]);
        Categoria::create([
            'nombre' => 'Se Retira',
        ]);
        Categoria::create([
            'nombre' => 'Eliminado por Rendimiento',
        ]);
        Categoria::create([
            'nombre' => 'Titulado',
        ]);
        Categoria::create([
            'nombre' => 'Eliminado Art. 31 E',
        ]);
        Categoria::create([
            'nombre' => 'Eliminado Art. 31 B',
        ]);
    }
}
