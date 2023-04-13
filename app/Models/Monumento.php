<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monumento extends Model
{
    protected $table = 'monumentos';
    protected $primaryKey = 'id_monumento';

    use HasFactory, SoftDeletes;

    public function ciudad(){
        return $this->hasOne('App\Models\Ciudad', 'id_ciudad', 'id_ciudad');
    }
    

    public function tipoMonumento(){
        return $this->hasOne('App\Models\CatalogoMonumento', 'tipo_monumento', 'tipo_monumento');
    }

    public function imagen(){
        return $this->hasOne('App\Models\Imagen', 'id_monumento', 'id_monumento');
    }
}
