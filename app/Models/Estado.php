<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    protected $table = 'estados';
    protected $primaryKey = 'id_estado';
    use HasFactory;

    //Aquí usamos/activamos softDeletes
    use SoftDeletes;

    public function pais(){
        return $this->hasOne('App\Models\Pais','id_pais','id_pais');
    }
}
