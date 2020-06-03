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
        'titulo','tipo','fecha','descripcion','id_categoria','modulo','created_at',
    ];
    protected $table = 'observacion';
    
    public function observacion_usuario_estudiante(){
        return $this->hasMany('App\Observacion_usuario_estudiante','id_observacion');
    }
    public function categoria(){
        return $this->belongsTo('App\Categoria','id_categoria');
    }
}
