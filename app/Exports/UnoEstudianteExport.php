<?php

namespace App\Exports;

use App\Estudiante;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;


class UnoEstudianteExport implements FromView
{
    use Exportable;

    private $rut;

    public function __construct($rut){
        $this->rut=$rut;
    }
    public function view(): View
    {   
        
        return view('Estudiante.unoexport' , [
            'estudiante' => Estudiante::where('rut','=',$this->rut)->firstOrFail(),
        ]);
    }
}
