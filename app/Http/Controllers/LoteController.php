<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lote;
use App\Http\Requests\LoteRequest;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Datatables;

class LoteController extends Controller
{
    /**
     * Display a listing of the lote
     *
     * @param  \App\Lote  $model
     * @return \Illuminate\View\View
     */
    public function index(Lote $model)
    {
      $data = [
        'permission' => 'Lote'
      ];

      return view('lote.index', $data);
    }

    /**
     * Show the form for creating a new lote
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
      $data = [
        'method' => 'create',
        'permission' => 'Lote',
        'url' => 'lote'
      ];

      return view('lote.create', $data);
    }

    /**
     * Store a newly created lote in storage
     *
     * @param  \App\Http\Requests\LoteRequest  $request
     * @param  \App\Lote  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoteRequest $request, Lote $model)
    {
    	$model->fill($request->all());
    	$model->save();

      return redirect('/lote')->withStatus(__('Creado con éxito.'));
    }

    /**
     * Show the form for editing the specified lote
     *
     * @param  \App\Lote  $lote
     * @return \Illuminate\View\View
     */
    public function edit(Lote $lote)
    {  
      $data = [
        'method' => 'edit',
        'record' => $lote,
        'permission' => 'Lote',
        'url' => '/lote/'.$lote->id
      ];

      return view('lote.create', $data);
    }

    /**
     * Show the form for editing the specified lote
     *
     * @param  \App\Lote  $lote
     * @return \Illuminate\View\View
     */
    public function show(Lote $lote)
    {  
      $data = [
        'method' => 'show',
        'record' => $lote,
        'permission' => 'Lote',
        'url' => '/lote'
      ];

      return view('lote.create', $data);
    }

    /**
     * Update the specified lote in storage
     *
     * @param  \App\Http\Requests\LoteRequest  $request
     * @param  \App\Lote  $lote
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LoteRequest $request, Lote $lote)
    {
      $lote->fill($request->all());
      $lote->update();

      return redirect('/lote')->withStatus(__('Actualizado con éxito.'));
    }

    /**
     * Remove the specified lote from storage
     *
     * @param  \App\Lote  $lote
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Lote  $lote)
    {
      $lote->delete();

      return response()->json(['data' => ["msg" => 'Eliminado correctamente'], 'status' => 200], 200);
    }

    /**
     * Remove the specified lote from storage
     *
     * @param  \App\Lote  $lote
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Lote  $lote)
    {
      $lote->withTrashed()->restore();

      return response()->json(['data' => ["msg" => 'Recuperado correctamente'], 'status' => 200], 200);
    }

    /**
     * Gets all the elements to fill the grid
     * 
     * @param  \App\Lote  $lote
     * @return DatatableJson
     */
    public function grid(Request $request){
      $records = Lote::select('*')->orderBy('id', 'DESC');

      if($request->inactive == 1)
        $records = $records->withTrashed();
      
      if($request->nombre)
        $records = $records->where('lotes.nombre', 'like', '%'.$request->nombre.'%');

      $dataTable = Datatables::of($records);
      
      return $dataTable->addColumn('actions', function($record){
        $params = [
          'record' => $record,
          'url'=> 'lote', 
          'permission' => 'Lote'
        ];
        return view('common.buttons', $params)->render();
      })
      ->escapeColumns([])
      ->make(true);
    }

    /**
     * Gets all the elements with filters
     *
     * @param  \App\Lote  $lote
     * @return Collection Data
     */
    public function filter(Request $request){       
      $records = Lote::select('*');
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
