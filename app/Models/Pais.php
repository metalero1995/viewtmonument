<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pais extends Model
{
    protected $table = 'paises';
    protected $primaryKey = 'id_pais';
    use HasFactory;

    //Aquí usamos/activamos softDeletes
    use SoftDeletes;
}
