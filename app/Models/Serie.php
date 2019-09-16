<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serie extends Model
{
    use SoftDeletes;
    protected $table='series';

    protected $fillable = [
        'serie',
        'usuario_id',
        'lote_id',
        'fecha_caducidad'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];
}
