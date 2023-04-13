<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delimitacion extends Model
{
    protected $table = 'delimitaciones';
    protected $primaryKey = 'id_delimitacion';
    use HasFactory;
    //use SoftDeletes;

    public function ciudad(){
        return $this->hasOne('App\Models\Ciudad','id_ciudad','id_ciudad');
    }
    /*
    public function estado(){
        return $this->hasOne('App\Models\Estado','id_estado','id_estado');
    }
    public function pais(){
        return $this->hasOne('App\Models\Pais','id_pais','id_pais');
    }*/
}