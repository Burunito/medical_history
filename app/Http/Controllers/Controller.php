<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct($modelo = false ){
    		if($modelo){
	        $this->middleware('permission:READ-'.$modelo)->only(['show','index', 'all', 'filter']);
	        $this->middleware('permission:EDIT-'.$modelo)->only(['edit','update']);
	        $this->middleware('permission:DELETE-'.$modelo)->only(['destroy','recover']);
	        $this->middleware('permission:ADD-'.$modelo)->only(['create','store']);
    		}
   }
}
