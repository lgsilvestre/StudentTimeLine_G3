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
        'nombre','ap_Paterno','ap_Materno','rut','matricula','correo','id_carrera',
    ];

    public function carrera(){
        return $this->hasOne('App\Carrera','id_carrera');
    }

    public function observacion_usuario_estudiante(){
        return $this->hasMany('App\Observacion_usuario_estudiante','id_estudiante');
    }
}
