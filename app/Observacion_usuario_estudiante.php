<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion_usuario_estudiante extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_observacion','id_estudiante','id_usuario'
    ];

    
    protected $table = 'usuario_observacion_estudiante';

    public function observacion(){
        return $this->belongsTo('App\Observacion','id_observacion');
    }
    public function estudiante(){
        return $this->belongsTo('App\Estudiante','id_estudiante');
    }
    public function usuario(){
        return $this->belongsTo('App\User','id_usuario');
    }
    
}
