<?php

namespace App\Imports;

use App\Estudiante;
use Maatwebsite\Excel\Concerns\ToModel; 

class EstudianteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Estudiante([
            'nombre'                        => $row[6],
            'ap_Paterno'                    => $row[4],
            'ap_Materno'                    => $row[5],
            'rut'                           => $row[3],
            'matricula'                     => $row[2],
            'correo'                        => $row[20],
            'id_carrera'                    => $row[0],
            'sexo'                          => $row[21],
            'fech_nac'                      => $row[22],
            'plan'                          => $row[7],
            'año_ingreso'                   => $row[8],
            'estado_actual'                 => $row[10],
            'comuna'                        => $row[11],
            'region'                        => $row[12],
            'creditos_aprobados'            => $row[13],
            'nivel'                         => $row[14],
            'porc_avance'                   => $row[15],
            'ult_ptje_prioridad'            => $row[16],
            'regular'                       => $row[17],  
            'prom_aprobadas'                => $row[18],
            'prom_cursados'                 => $row[19],
            'num_observaciones'             => 0,
        ]);
    }
}
