<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo','id_autor','nombre_autor','tipo_observacion','fecha','descripcion','modulo','created_at','nombre_categoria','semestre','fecha_limite','id_estudiante',
    ];
    protected $table = 'observacion';
    
    public function observacion_usuario_estudiante(){
        return $this->hasMany('App\Observacion_usuario_estudiante','id_observacion');
    }
    
    public function estudiante(){
        return $this->belongsTo('App\Estudiante','id_estudiante');
    }


}
