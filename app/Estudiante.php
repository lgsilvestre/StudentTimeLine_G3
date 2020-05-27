<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','ap_Paterno','ap_Materno','rut','matricula','correo','id_carrera','sexo','fech_nac',
        'plan','año_ingreso','estado_actual','comuna','region','creditos_aprobados','nivel','porc_avance',
        'ult_ptje_prioridad','regular','prom_aprobadas','prom_cursados',
    ];
    protected $table = 'estudiante';

    public function carrera(){
        return $this->belongsTo('App\Carrera','id_carrera');
    }

    public function observacion_usuario_estudiante(){
        return $this->hasMany('App\Observacion_usuario_estudiante','id_estudiante');
    }
}
