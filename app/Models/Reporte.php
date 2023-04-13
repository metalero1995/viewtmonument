<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reporte extends Model
{
    protected $table = 'reportes';
    protected $primaryKey = 'id_reporte';
    use HasFactory;
    //Aquí usamos/activamos softDeletes
    use SoftDeletes;

    public function revisado()
    {
        return $this->hasOne('App\Models\RevisadoReporte', 'revisado_reporte', 'revisado_reporte');
    }

}
