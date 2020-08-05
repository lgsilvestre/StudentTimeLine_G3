<?php

namespace App\Exports;

use App\Estudiante;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;


class TodoEstudianteExport implements FromView
{
    use Exportable;

    public function view(): View
    {   
        return view('Estudiante.todoexport',[
            'estudiantes' => Estudiante::all(),
        ]);
    }
}
