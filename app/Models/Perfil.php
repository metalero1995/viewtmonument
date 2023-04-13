<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//SoftDeletes sirve para los eliminados lógicos
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model
{
    protected $table = 'perfiles';
    protected $primaryKey = 'PerfilID';
    use HasFactory, SoftDeletes;

    //Aquí usamos/activamos softDeletes

}

