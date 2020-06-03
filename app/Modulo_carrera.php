<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo_carrera extends Model
{
    
    protected $fillable = [
        'descripcion' , 'id_carrera'
    ];

    protected $table = 'modulo';

    public function carrera(){
        return $this->belongsTo('App\Carrera','id_carrera');
    }

}
