<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoMonumento extends Model
{
    protected $table = 'catalogo_monumentos';
    protected $primaryKey = 'tipo_monumento';
    use HasFactory;
}
