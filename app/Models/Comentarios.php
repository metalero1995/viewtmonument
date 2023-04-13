<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comentarios extends Model
{
    protected $table = 'comentarios';
    protected $primaryKey = 'id_comentario';
    use HasFactory;

    use SoftDeletes;
    public function usuario(){
        return $this->belongsTo('App\Models\User', 'id_usuario', 'id');
    }
    public function valoracion(){
        return $this->hasOne('App\Models\Valoracion', 'tipo_comentario', 'tipo_comentario');
    }
    public function monumentos(){
        return $this->hasOne('App\Models\Monumento', 'id_monumento', 'id_monumento');
    }
}
