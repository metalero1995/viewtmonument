<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Valoracion extends Model
{
    protected $table = 'valoracion';
    protected $primaryKey = 'tipo_comentario';
    use HasFactory;
    use SoftDeletes;
}
