<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario_carrera extends Model
{
    
    protected $fillable = [
        'id_carrera', 'id_usuario'
    ];

    protected $table = 'carrera_usuario';

    public function usuario(){
        return $this->belongsTo('App\User','id_usuario');
    }

    public function carrera(){
        return $this->belongsTo('App\Carrera','id_carrera');
    }

    
}
