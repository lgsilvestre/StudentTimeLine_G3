<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modulo_carrera as Modulo;
use App\Carrera;
use DB;

class Modulo_carreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $user = User::find(Auth::user()->id);
        if($user->hasrole('admin')){
                $modulos = DB::table('carrera')
                ->join('modulo', 'carrera.id', '=', 'modulo.id_carrera')
                ->select('modulo.id','modulo.descripcion', 'carrera.nombre','modulo.id_carrera')
                ->get();
                if($request->ajax()){
                        return datatables()->of($modulos)->toJson();
                }
        }else{
                $carreras = $user->usuario_carrera;
                $car = 0;
                foreach($carreras as $carrera){
                        $car = $carrera->id;
                }               
                $modulos = DB::table('carrera')
                ->join('modulo', 'carrera.id', '=', 'modulo.id_carrera')
                ->where('carrera.id','=',$car)
                ->select('modulo.id','modulo.descripcion', 'carrera.nombre','modulo.id_carrera')
                ->get();
                if($request->ajax()){
                        return datatables()->of($modulos)->toJson();
                }
        }
        if($user->id == 1){
            $carreras = Carrera::all();
        }else{
            $carreras = $user->usuario_carrera;
            $collect = [];
            foreach($carreras as $carrera){
                $car = $carrera->carrera;
                $collect[]=$car; 
            }
            $carreras = collect($collect);
        }
        return view('Modulo.index',compact('carreras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carreras = Carrera::all();
    //    return view('modulo.create',compact('carreras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'descripcion'=>'required|string|max:255',
            'carrera' =>'required',
        ]);
        $modulo = Modulo::create([
            'descripcion' => 'au',
            'id_carrera' => 1,
        ]);
        
        $modulo->descripcion=$request->get('descripcion');
        $modulo->id_carrera=$request->get('carrera'); //asignar id directamente
        $modulo->save();
        return redirect()->action('Modulo_carreraController@index')
        ->with('success','Modulo ingresado con éxito'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modulo = Modulo::find($id);
    //    return view ('modulo.edit', compact('modulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validate=$request->validate([
            'descripcion'=>'required|string|max:255',
        ]);
        $modulo = Modulo::find($request->get('id'));
        $modulo->descripcion=$request->get('descripcion');
        $modulo->id_carrera=$request->get('carrera'); //asignar id directamente
        $modulo->save();

        return redirect()->action('Modulo_carreraController@index')
        ->with('success','Modulo actualizado con éxito'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Modulo::destroy($request->get('id'));

        return redirect()->action('Modulo_carreraController@index')
        ->with('success','Modulo eliminado con éxito'); 
    }
}
