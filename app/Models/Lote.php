<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lote extends Model
{
	  use SoftDeletes;
    protected $table='lotes';

    protected $fillable = [
      'nombre'
    ];

    protected $hidden = [
      'created_at', 
      'updated_at'
    ];
}
