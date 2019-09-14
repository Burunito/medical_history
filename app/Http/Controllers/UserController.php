<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Datatables;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $data = [
            'url' => 'user'
        ];

        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {  
        $data = [
            'method' => 'create',
            'url' => 'user'
        ];

        return view('users.create', $data);
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('user.index')->withStatus(__('Usuario creado con éxito.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $data = [
            'method' => 'edit',
            'user' => $user,
            'url' => 'user'
        ];

        if ($user->id == 1) {
            return redirect()->route('user.index');
        }

        return view('users.edit', $data);
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        $data = [
            'method' => 'show',
            'user' => $user,
            'url' => 'user'
        ];

        return view('users.edit', $data);
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        $hasPassword = $request->get('password');
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$hasPassword ? '' : 'password']
        ));

        return redirect()->route('user.index')->withStatus(__('Usuario actualizado correctamente.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if($user->id != 1)
            $user->delete();
        else
            return response()->json(['data' => ["msg" => 'No se puede eliminar el administrador'], 'status' => 400], 200);

        return response()->json(['data' => ["msg" => 'Eliminado correctamente'], 'status' => 200], 200);
    }

    /**
     * Gets all the elements to fill the grid
     * 
     * @param  Illuminate\Http\Request  $request
     * @return DatatableJson
     */
    public function grid(Request $request){
      $records = User::select('users.*', 'roles.name as rol')
                    ->join('roles', 'roles.id', 'users.role_id');

      //if($request->inactive != 1)
          //$records = $records->withTrash();

      $dataTable = Datatables::of($records);
      
      return $dataTable->addColumn('actions', function($record){
          $params = [
              'record' => $record,
              'url'=> 'user', 
              'permission' => 'Usuario'
          ];
          return view('common.buttons', $params)->render();
      })
      ->escapeColumns([])
      ->make(true);
    }
}
