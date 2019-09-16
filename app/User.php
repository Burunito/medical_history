<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $table='users';

    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rol()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    public function hasPermission($permission)
    {
       $has_permission = DB::table('role_permission')
                    ->join('permission','permission.id','role_permission.permission_id')
                    ->where('role_id', $this->role_id)
                    ->where('permission.action','=',$permission)
                    ->first();

        return $has_permission ? true : false;
    }
}
