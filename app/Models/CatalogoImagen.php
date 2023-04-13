<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatalogoImagen extends Model
{
    protected $table = 'catalogo_imagenes';
    protected $primaryKey = 'tipo_imagen';

    use HasFactory, SoftDeletes;
}
