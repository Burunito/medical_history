<?php

namespace App\Http\Controllers;
use App\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
  function __construct(){
    parent::__construct('POKEMON');
  }

  public function index(Request $request){
    if($request->ajax())
    {
      $pokemon = Pokemon::all();
    	return response()->json(
    		$pokemon
    	, 200);

    }
  	return view('pokemon.index');
  }

  public function store(Request $request)
  {
    if($request->ajax())
    {
      $pokemon = new Pokemon();
      $pokemon->name = $request->input('name');
      $pokemon->picture = $request->input('picture');
      $pokemon->description = $request->input('description');
      $pokemon->save();

      return response()->json([
        'message' => 'Pokemon ha sido creado',
        'pokemon' => $pokemon
      ], 200);
    }
  }
}
