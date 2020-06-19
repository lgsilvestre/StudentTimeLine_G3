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
        'nombre','codigo_carrera','imagen',
    ];
    protected $table = 'carrera';
    
    public function usuario_carrera(){
        return $this->hasMany('App\Usuario_carrera','id_carrera');
    }

    public function estudiantes(){
        return $this->hasMany('App\Estudiante','id_carrera');
    }

    public function modulos(){
        return $this->hasMany('App\Modulo_carrera','id_carrera');
    }
}
