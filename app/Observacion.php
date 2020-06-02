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
        'titulo','tipo','fecha','descripcion','categoria','modulo','created_at',
    ];
    protected $table = 'observacion';
    
    public function observacion_usuario_estudiante(){
        return $this->hasMany('App\Observacion_usuario_estudiante','id_observacion');
    }
    
}
