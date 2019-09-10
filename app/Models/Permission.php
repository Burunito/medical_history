<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $table='permission';

    protected $fillable = [
        'user_id', 'role_id'
    ];

    protected $hidden = [
        'created_at', 'deleted_at'
    ];

    public function role_permission(){
    	return $this->hasMany('App\Models\RolePermission');
    }
}
