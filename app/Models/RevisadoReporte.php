<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RevisadoReporte extends Model
{
    protected $table = 'estatus_reportes';
    protected $primaryKey = 'revisado_reporte';
    use HasFactory, SoftDeletes;


}
