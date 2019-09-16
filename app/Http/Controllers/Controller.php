<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct($modelo = null){
  		if($modelo){
        $this->middleware('permission:Mostrar-'.$modelo)->only(['show','index', 'all', 'filter']);
        $this->middleware('permission:Eliminar-'.$modelo)->only(['destroy']);
        $this->middleware('permission:Recuperar-'.$modelo)->only(['restore']);
        $this->middleware('permission:Agregar-'.$modelo)->only(['create','store']);
        $this->middleware('permission:Actualizar-'.$modelo)->only(['update','store']);
  		}
   }
}
