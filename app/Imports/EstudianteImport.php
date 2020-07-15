<?php

namespace App\Imports;

use App\Estudiante;
use Maatwebsite\Excel\Concerns\ToModel; 
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Rut;

class EstudianteImport implements ToModel, WithHeadingRow, WithValidation
{

    private $id_carrera;

    public function __construct($id_carrera){
        $this->id_carrera = $id_carrera;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $nombre = explode(' ',$row['nbe_alumno']);

        return new Estudiante([
            'nombre'                        => $nombre[2].' '.$nombre[3],
            'ap_Paterno'                    => $nombre[0],
            'ap_Materno'                    => $nombre[1],
            'rut'                           => $row['run'],
            'matricula'                     => $row['matricula'],
            'correo'                        => $row['correo'],
            'id_carrera'                    => $this->id_carrera,
            'sexo'                          => $row['sexo'],
            'fech_nac'                      => $row['fecha_nac'],
            'plan'                          => $row['plan'],
            'año_ingreso'                   => $row['anho_ingreso'],
            'estado_actual'                 => $row['sit_actual'],
            'comuna'                        => $row['comuna'],
            'region'                        => $row['region'],
            'creditos_aprobados'            => $row['cred_aprobados'],
            'nivel'                         => $row['nivel'],
            'porc_avance'                   => $row['porc_avance'],
            'ult_ptje_prioridad'            => $row['ult_ptje_prioridad'],
            'regular'                       => $row['regular'],  
            'prom_aprobadas'                => $row['prom_aprobadas'],
            'prom_cursados'                 => $row['prom_cursadas'],
            'num_observaciones'             => 0,
        ]);

    }

    public function headingRow(): int
    {
        return 6;
    }

    public function rules(): array
        {
            return [
                '*.matricula' => ['required','unique:estudiante,matricula'],
                '*.run' => ['cl_rut','unique:estudiante,rut'],
                '*.correo' => ['email','unique:estudiante,correo'],
            ];
        }

}
