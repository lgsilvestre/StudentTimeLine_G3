<?php

namespace App\Exports;

use App\Estudiante;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class RangoEstudianteExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Estudiante::all();
    }

    public function view(): View
    {
        return view('Estudiante.rangoexport', [
            'Estudiantes' => Estudiante::all()
        ]);
    }
}
