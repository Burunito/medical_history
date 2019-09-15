<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $table='lotes';

    protected $fillable = [
        'nombre'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];
}
