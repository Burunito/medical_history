<?php

use Illuminate\Database\Seeder;
use App\Models\RolePermission;
use App\Models\Permission;
use App\Models\Role;
use App\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
        'Agregar-Rol',
        'Eliminar-Rol',
        'Actualizar-Rol',
        'Mostrar-Rol',
        'Recuperar-Rol',
        'Agregar-Usuario',
        'Eliminar-Usuario',
        'Actualizar-Usuario',
        'Mostrar-Usuario',
        'Recuperar-Usuario',
        'Agregar-Permiso',
        'Eliminar-Permiso',
        'Actualizar-Permiso',
        'Mostrar-Permiso',
        'Recuperar-Permiso',
        'Agregar-Lote',
        'Eliminar-Lote',
        'Actualizar-Lote',
        'Mostrar-Lote',
        'Recuperar-Lote',
        'Agregar-Numero de Serie',
        'Mostrar-Numero de Serie',
        'Generar-Numero de Serie',
        'Desactivar-Numero de Serie',
        'Reactivar-Numero de Serie'
      ];

      $role = Role::where('name', 'admin')->first();
      foreach($permissions as $permission) {
        if(Permission::where('action', $permission)->first())
            continue;
        $record = new Permission();
        $record->action = $permission;
        $record->save();

        $role_permission = new RolePermission();
        $role_permission->permission_id = $record->id;
        $role_permission->role_id = $role->id;
        $role_permission->save();
      }
    }
}