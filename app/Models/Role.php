<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table='roles';

    protected $fillable = [
        'name', 'descripcion'
    ];

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    public function role_permission(){
    	return $this->hasMany('App\Models\RolePermission');
    }

    public function users(){
        return $this->hasMany('App\Models\User');
    }
}
