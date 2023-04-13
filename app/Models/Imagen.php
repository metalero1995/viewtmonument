<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imagen extends Model
{
    protected $table = 'imagenes';
    protected $primaryKey = 'id_imagenes';
    use HasFactory, SoftDeletes;

    public function tamano(){
        return $this->hasOne('App\Models\CatalogoImagen', 'tipo_imagen', 'tipo_imagen');
    }

    public function monumento(){
        return $this->hasOne('App\Models\Monumento', 'id_monumento', 'id_monumento');
    }
}
