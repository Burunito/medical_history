<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';
    
    protected $fillable = [
        'user_id',
        'table',
        'action',
        'data',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
