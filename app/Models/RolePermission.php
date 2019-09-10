<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
	protected $table='role_permission';

    protected $fillable = [
        'role_id', 'permission_id'
    ];

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    public function roles(){
    	return $this->belongTo('App\Models\Role');
    }

    public function permission(){
    	return $this->belongsTo('App\Models\Permission');
    }
} 
