<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use App\Models\Permission;

class ValidatePermission
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::id();

        if($request->ajax() && (! $this->authorizePermission($permission, $user)))
        {
            return response()->json(['data' => 'Unauthorized', 'status' => 403], 403);
        }

        if(!$user){
            return redirect()->guest(route('login'));
        }

        if(! $this->authorizePermission($permission, $user)) {
            abort(403);
         }
         
        return $next($request);
    }

    public function authorizePermission($permission, $user)
    {
        $permisos = User::with('rol.role_permission.permission')->find($user);
        if(!$permisos->rol)
            return false;

        if($permisos->rol->role_permission)
            return false;

        $permisos = $permisos->rol->role_permission->pluck('permission_id');

        $permisos = Permission::whereIn('id', $permisos)->get();

        $permisos = $permisos->pluck('action');

        if(!in_array($permission, $permisos))
            return false;

      return true;
    }
}
