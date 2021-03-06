<?php

namespace App\Imports;

use App\Estudiante;
use Maatwebsite\Excel\Concerns\ToModel; 
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Rut;
use App\Carrera;

class EstudianteImport implements ToModel, WithHeadingRow, WithValidation
{

    private $id_carrera;
    private $carrera;
    public function __construct($id_carrera){
        $this->id_carrera = $id_carrera;
        $carrera = Carrera::find($this->id_carrera);
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        $nombre = explode(' ',$row['nbe_alumno']);
        $UNIX_DATE = ($row['fecha_nac'] - 25569) * 86400; //Dando formato a la columna fecha.
        $rut = Rut::parse($row['run'])->fix()->format();//dando formato al rut, para que queden todos iguales.
        $sit_actual_min = strtolower($row['sit_actual']);
        if($sit_actual_min=="regular"){
            $sit_actual_min="Regular";
        }else{
            $sit_actual_min="No regular";
        }
        return new Estudiante([
            'nombre'                        => $nombre[2].' '.$nombre[3],
            'ap_Paterno'                    => $nombre[0],
            'ap_Materno'                    => $nombre[1],
            'rut'                           => $rut,
            'matricula'                     => $row['matricula'],
            'correo'                        => $row['correo'],
            'id_carrera'                    => $this->id_carrera,
            'sexo'                          => $row['sexo'],
            'fech_nac'                      => gmdate("Y-m-d", $UNIX_DATE),
            'plan'                          => $row['plan'],
            'año_ingreso'                   => $row['anho_ingreso'],
            'estado_actual'                 => $sit_actual_min,
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
    /**
     * Funcion para validar los datos que se ingresan en el excel.
     */
    public function rules(): array
        {
            $carrera = Carrera::find($this->id_carrera);
            return [
                '*cod_carrera' => [Rule::in($carrera->codigo_carrera)],
                '*.cod_carrera' => ['required'],
                '*.matricula' => ['required','unique:estudiante,matricula'],
                '*.nbe_alumno' =>['required'],
                '*.sexo' =>['required'],
                '*.regular'=>['required'],
                '*.run' => ['required','cl_rut','unique:estudiante,rut'],
                '*.correo' => ['email','unique:estudiante,correo'],
                '*.anho_ingreso'=>['required'],
                '*.sit_actual' =>['required'],
                '*.plan' =>['required'],
                '*.comuna' =>['required'],
                '*.region' => ['required'],
                '*.cred_aprobados' => ['required'],
                '*.nivel' => ['required'],
                '*.porc_avance' => ['required'],
                '*.ult_ptje_prioridad' => ['required'],
                '*.regular' => ['required'],
                '*.prom_aprobadas' => ['required'],
                '*.prom_cursadas' => ['required'],
            ];
        }
    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            '*cod_carrera.in' => 'Existen estudiantes con codigos de otra carrera.',
        ];
    }

}
