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
        $nombre = explode(' ',$row[4]);
        
        return new Estudiante([
            'nombre'                        => $nombre[2].' '.$nombre[3],
            'ap_Paterno'                    => $nombre[0],
            'ap_Materno'                    => $nombre[1],
            'rut'                           => $row[3],
            'matricula'                     => $row[2],
            'correo'                        => $row[5],
            'id_carrera'                    => $row[0],
            'sexo'                          => $row[6],
            'fech_nac'                      => $row[7],
            'plan'                          => $row[8],
            'año_ingreso'                   => $row[9],
            'estado_actual'                 => $row[11],
            'comuna'                        => $row[12],
            'region'                        => $row[13],
            'creditos_aprobados'            => $row[14],
            'nivel'                         => $row[15],
            'porc_avance'                   => $row[16],
            'ult_ptje_prioridad'            => $row[17],
            'regular'                       => $row[18],  
            'prom_aprobadas'                => $row[19],
            'prom_cursados'                 => $row[20],
            'num_observaciones'             => 0,
        ]);
    }
}
