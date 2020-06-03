<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre',
    ];
    protected $table = 'categoria';

    public function observaciones(){
        return $this->hasMany('App\Observacion','id_categoria');
    }
}
