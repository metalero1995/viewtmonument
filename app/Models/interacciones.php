<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class interacciones extends Model
{
    protected $table = 'interacciones';
    protected $primaryKey = 'id_interacciones';

    use HasFactory;

    public function monumento()
    {
        return $this->belongsTo('App\Models\Monumento', 'id_monumentos','id_monumento');
    }
}
