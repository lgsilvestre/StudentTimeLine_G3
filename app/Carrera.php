<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];
    protected $table = 'carrera';
    
    public function usuario_carrera(){
        return $this->hasMany('App\Usuario_carrera','id_carrera');
    }

    public function estudiante(){
        return $this->hasMany('App\Observacion_usuario_estudiante','id_estudiante');
    }
}
