<?php

namespace App\Exports;

use App\Estudiante;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;


class RangoEstudianteExport implements FromView
{
    use Exportable;

    private $fecha_inicio;
    private $fecha_final;

    public function __construct($fecha_inicio,$fecha_final){
        $this->fecha_inicio = $fecha_inicio;
        //le sumo un dia a la fecha final ya que si no no toma el <= al comparar.
        $this->fecha_final = strtotime($fecha_final."+ 1 day");

        $this->fecha_final = date("Y-m-d",$this->fecha_final);
    }
    public function view(): View
    {   
        return view('Estudiante.rangoexport' , [
            'estudiantes' => Estudiante::all(),
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_final' => $this->fecha_final,
        ]);
    }
}
