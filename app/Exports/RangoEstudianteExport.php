<?php

namespace App\Exports;

use App\Estudiante;
use Maatwebsite\Excel\Concerns\FromCollection;

class RangoEstudianteExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Estudiante::all();
    }
}
