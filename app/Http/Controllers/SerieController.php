<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Lote;
use App\Http\Requests\SerieRequest;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Datatables;
use Carbon\Carbon;
use Auth;

class SerieController extends Controller
{
    protected $string_length = 5;
    /**
     * Display a listing of the serie
     *
     * @param  \App\Serie  $model
     * @return \Illuminate\View\View
     */
    public function index(Serie $model)
    {
      $lotes = Lote::get();
      $data = [
        'lotes' => $lotes,
        'permission' => 'Numero de Serie'
      ];

      return view('serie.index', $data);
    }

    /**
     * Show the form for creating a new serie
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
      $lotes = Lote::get();
      $data = [
        'lotes' => $lotes,
        'method' => 'create',
        'permission' => 'Numero de Serie',
        'url' => 'serie'
      ];

      return view('serie.create', $data);
    }

    /**
     * Store a newly created serie in storage
     *
     * @param  \App\Http\Requests\SerieRequest  $request
     * @param  \App\Serie  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SerieRequest $request, Serie $model)
    {
      set_time_limit(500);
      $data = $request->all();
      $fecha_caducidad = Carbon::createFromFormat('d/m/Y', $data['fecha_caducidad'])->format('Y-m-d');
      for($i=0; $i < $data['cantidad']; $i++) { 
        do{
          $serie = str_random($this->string_length);
          $diferente = Serie::where('serie', $serie)
                            ->where('fecha_caducidad', $fecha_caducidad)
                            ->where('lote_id', $data['lote_id'])
                            ->first();
        }while($diferente);

        $num_serie = new Serie();
      	$num_serie->serie = $serie;
        $num_serie->usuario_id = Auth::id();
        $num_serie->lote_id = $data['lote_id'];
        $num_serie->fecha_caducidad = $fecha_caducidad;
      	$num_serie->save();
      }

      return redirect('/serie')->withStatus(__('Creados con éxito.'));
    }

    /**
     * Show the form for editing the specified serie
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\View\View
     */
    public function edit(Serie $serie)
    {  
      $data = [
        'method' => 'edit',
        'record' => $serie,
        'permission' => 'Numero de Serie',
        'url' => '/serie/'.$serie->id
      ];

      return view('serie.create', $data);
    }

    /**
     * Show the form for editing the specified serie
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\View\View
     */
    public function show(Serie $serie)
    {  
      $data = [
        'method' => 'show',
        'record' => $serie,
        'permission' => 'Numero de Serie',
        'url' => '/serie'
      ];

      return view('serie.create', $data);
    }

    /**
     * Update the specified serie in storage
     *
     * @param  \App\Http\Requests\SerieRequest  $request
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SerieRequest $request, Serie $serie)
    {
      $serie->fill($request->all());
      $serie->update();

      return redirect('/serie')->withStatus(__('Actualizado con éxito.'));
    }

    /**
     * Remove the specified serie from storage
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
      $serie = Serie::find($id);
      $serie->activo = 0;
      $serie->update();

      return response()->json(['data' => ["msg" => 'Eliminado correctamente'], 'status' => 200], 200);
    }

    /**
     * Remove the specified serie from storage
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
      $serie = Serie::find($id);
      $serie->activo = 1;
      $serie->update();

      return response()->json(['data' => ["msg" => 'Recuperado correctamente'], 'status' => 200], 200);
    }

    /**
     * Gets all the elements to fill the grid
     * 
     * @param  \App\Serie  $serie
     * @return DatatableJson
     */
    public function grid(Request $request){
      $records = Serie::select('series.*', 'lotes.nombre as lote', 'users.name as usuario')
                      ->selectRaw('DATE_FORMAT(series.created_at, "%d/%m/%Y") as fecha')
                      ->selectRaw('DATE_FORMAT(series.fecha_caducidad, "%d/%m/%Y") as fecha_caducidad_format')
                      ->join('lotes', 'lotes.id', 'series.lote_id')
                      ->join('users', 'users.id', 'series.usuario_id')
                      ->orderBy('series.id', 'DESC');

      if($request->fecha)
        $records = $records->having('fecha', $request->fecha);

      if($request->fecha_caducidad)
        $records = $records->having('fecha_caducidad_format', $request->fecha_caducidad);

      if($request->lote)
        $records = $records->where('lote_id', $request->lote);

      if($request->serie)
        $records = $records->where('serie', 'like', '%'.$request->serie.'%');

      $dataTable = Datatables::of($records);
      
      return $dataTable->addColumn('actions', function($record){
        $params = [
          'record' => $record,
          'url'=> 'serie', 
          'permission' => 'Numero de Serie'
        ];
        return view('serie.buttons', $params)->render();
      })
      ->editColumn('activo', function($record){
        return $record->activo ? 'Si' : 'No';
      })
      ->escapeColumns([])
      ->make(true);
    }

    /**
     * Gets all the elements with filters
     *
     * @param  \App\Serie  $serie
     * @return Collection Data
     */
    public function filter(Request $request){       
      $records = Serie::select('*');
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
