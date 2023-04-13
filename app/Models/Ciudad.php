<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ciudad extends Model
{
    protected $table = 'ciudades';
    protected $primaryKey = 'id_ciudad';
    use HasFactory;

    //Aquí usamos/activamos softDeletes
    use SoftDeletes;

    public function pais(){
        return $this->hasOne('App\Models\Pais','id_pais','id_pais');
    }
    public function estado(){
        return $this->hasOne('App\Models\Estado','id_estado','id_estado');
    }
}
