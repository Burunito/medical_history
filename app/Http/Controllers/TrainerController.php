<?php

namespace App\Http\Controllers;

use App\Trainer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTrainerRequest;
class TrainerController extends Controller
{
    function __construct(){
      parent::__construct('TRAINER');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $trainers = [];
      return view("trainer.index", compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    { 
      $request->user()->authorizeRoles('admin');
      return view("trainer.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrainerRequest $request)
    {      

      $trainer = new Trainer();

      if($request->hasFile('avatar'))
      {
        $file = $request->file('avatar');
        $name = time().$file->getClientOriginalName();
        $file->move(public_path().'/images/', $name);
        $trainer->avatar = $name;
      }

      $trainer->name = $request->input('name');
      $trainer->description = $request->input('description');
      $trainer->slug = $trainer->name;
      
      $trainer->save();
      return redirect()->route('trainer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trainer $trainer)
    {
      //$trainer = Trainer::where('slug', '=', $slug)->firstOrFail();
      //$trainer = Trainer::find($id);
      return view('trainer.show', compact('trainer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainer $trainer)
    {
      return view('trainer.edit', compact('trainer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainer $trainer)
    {
      $trainer->fill($request->except('avatar'));

      if($request->hasFile('avatar'))
      {
        $file = $request->file('avatar');
        $name = time().$file->getClientOriginalName();
        $file->move(public_path().'/images/', $name);
        $trainer->avatar = $name;
      }
      
      $trainer->save();

      return redirect()->route('trainer.show', [$trainer])->with('status', 'Entrenador Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainer $trainer)
    {
      $file_path = public_path().'/images/'.$trainer->avatar;
      \File::delete($file_path);
      $trainer->delete();
      return redirect()->route('trainer.index');
    }
}
