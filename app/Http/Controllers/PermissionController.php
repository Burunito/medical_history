<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolePermission;
use App\Models\Permission;
use App\Models\Role;
use App\Http\Requests\PermissionRequest;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Datatables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the permission
     *
     * @param  \App\Permission  $model
     * @return \Illuminate\View\View
     */
    public function index(Permission $model)
    {
      $data = [
        'permission' => 'Rol'
      ];

      return view('permission.index', $data);
    }

    /**
     * Show the form for creating a new permission
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
    	$permisos = Permission::get();
    	$permisos_grupo = [];

    	$permisos = $permisos->each(function($record) use (&$permisos_grupo){
    		$permiso = explode('-', $record->action);
    		if(!isset($permisos_grupo[$permiso[1]]))
    			$permisos_grupo[$permiso[1]] = [];
    		$permisos_grupo[$permiso[1]][] = $record;
    	});

      $data = [
        'permission' => 'Rol',
        'method' => 'create',
      	'permisos' => $permisos_grupo,
      	'url' => 'permission'
      ];

      return view('permission.create', $data);
    }

    /**
     * Store a newly created permission in storage
     *
     * @param  \App\Http\Requests\PermissionRequest  $request
     * @param  \App\Permission  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionRequest $request)
    {
      $role = new Role();
      $role->fill($request->all());
      $role->update();

      if($request->has('permisos')){
        foreach($request->permisos as $permission_id => $value){
          $permiso = new RolePermission();
          $permiso->permission_id = $permission_id;
          $permiso->role_id = $role->id;
          $permiso->save();
        }
      }

      return redirect('/permission')->withStatus(__('Creado con éxito.'));
    }

    /**
     * Show the form for editing the specified permission
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {  
      $permisos = Permission::get();
      $permisos_grupo = [];

      $role = Role::with('role_permission')->find($id);
      $role_permissions = $role->role_permission->pluck('permission_id');
      $permisos = $permisos->each(function($record) use (&$permisos_grupo){
        $permiso = explode('-', $record->action);
        if(!isset($permisos_grupo[$permiso[1]]))
          $permisos_grupo[$permiso[1]] = [];
        $permisos_grupo[$permiso[1]][] = $record;
      });
      $role_permissions = $role_permissions->toArray();
      $data = [
        'method' => 'edit',
        'permission' => 'Rol',
        'record' => $role, 
        'url' => '/permission/'.$role->id,
        'role_permissions' => $role_permissions,
        'permisos' => $permisos_grupo
      ];
      return view('permission.create', $data);
    }

    /**
     * Show the form for editing the specified permission
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\View\View
     */
    public function show($id)
    {  
      $permisos = Permission::get();
      $permisos_grupo = [];

      $role = Role::with('role_permission')->find($id);
      $role_permissions = $role->role_permission->pluck('id');
      $permisos = $permisos->each(function($record) use (&$permisos_grupo){
        $permiso = explode('-', $record->action);
        if(!isset($permisos_grupo[$permiso[1]]))
          $permisos_grupo[$permiso[1]] = [];
        $permisos_grupo[$permiso[1]][] = $record;
      });
      $role_permissions = $role_permissions->toArray();
      $data = [
        'method' => 'show',
        'permission' => 'Rol',
        'record' => $role, 
        'url' => '/permission/'.$role->id,
        'role_permissions' => $role_permissions,
        'permisos' => $permisos_grupo
      ];
      return view('permission.create', $data);
    }

    /**
     * Update the specified permission in storage
     *
     * @param  \App\Http\Requests\PermissionRequest  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
      $role = Role::find($request->id);
      $role->fill($request->all());
      $role->update();

      $role->role_permission()->delete();

      if($request->has('permisos')){
        foreach($request->permisos as $permission_id => $value){
          $permiso = new RolePermission();
          $permiso->permission_id = $permission_id;
          $permiso->role_id = $role->id;
          $permiso->save();
        }
      }

      return redirect('/permission')->withStatus(__('Actualizado con éxito.'));
    }

    /**
     * Remove the specified permission from storage
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
      $rol = Role::find($id);
      $rol->delete();

      return response()->json(['data' => ["msg" => 'Eliminado correctamente'], 'status' => 200], 200);
    }

    /**
     * Remove the specified permission from storage
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
      $rol = Role::withTrashed()->find($id);
      $rol->restore();

      return response()->json(['data' => ["msg" => 'Recuperado correctamente'], 'status' => 200], 200);
    }

    /**
     * Gets all the elements to fill the grid
     * 
     * @param  \App\Permission  $permission
     * @return DatatableJson
     */
    public function grid(Request $request){
      $records = Role::select('*');

      if($request->inactive == 1)
          $records = $records->withTrashed();
      
      if($request->descripcion)
        $records = $records->where('description', 'like', '%'.$request->descripcion.'%');

      if($request->rol)
        $records = $records->where('name', 'like', '%'.$request->rol.'%');

      $dataTable = Datatables::of($records);
      
      return $dataTable->addColumn('actions', function($record){
          $params = [
              'record' => $record,
              'url'=> 'permission', 
              'permission' => 'Rol'
          ];
          return view('common.buttons', $params)->render();
      })
      ->escapeColumns([])
      ->make(true);
    }

    /**
     * Gets all the elements with filters
     *
     * @param  \App\Permission  $permission
     * @return Collection Data
     */
    public function filter(Request $request){       
      $records = Permission::select('*');
      $filters = $request->all();
      foreach($filters as $filter) {
          switch ($filter->type) {
              case 'gt':
                  $records->where($filter->field, '>', $filter->value);
                  break;
              case 'lt':
                  $records->where($filter->field, '<', $filter->value);
                  break;
              case 'eq':
                  $records->where($filter->field, '=', $filter->value);
                  break;
              case 'like':
                  $records->where($filter->field, 'like', '%'.$filter->value.'%');
                  break;
          }
      }

      $records = $records->get();
      return $records;
    }
}
