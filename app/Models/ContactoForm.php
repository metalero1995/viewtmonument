<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ContactoForm extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'contactanos';
    
    protected $fillable = [
        'asunto', 'correo','descripcion', 'estatus'
    ];
}
