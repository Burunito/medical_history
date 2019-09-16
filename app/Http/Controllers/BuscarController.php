<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Lote;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BuscarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $lotes = Lote::select('id', 'nombre')->withTrashed()->get();
        $data = [
            'lotes' => $lotes
        ];
        return view('buscar.index', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function buscar(Request $request)
    {
        $date = Carbon::createFromFormat('d/m/Y', $request->fecha)->format('Y-m-d');
        $serie = Serie::where('serie', $request->serie)
                         ->where('fecha_caducidad', $date)
                         ->where('lote_id', $request->lote)
                         ->first();

        if($serie){
            $response = $serie->activo == 1 ? 'El medicamento es original.' : 'El medicamento ya fue consultado, podria haber sido utilidazo con anterioridad';
            $serie->activo = 0;
            $serie->update();
        }
        else
            $response = 'El medicamento no se encuentra registrado en nuestra base de datos';
        $data = [
            'mensaje' => $response
        ];
        return view('buscar.resultado', $data);
    }
}
