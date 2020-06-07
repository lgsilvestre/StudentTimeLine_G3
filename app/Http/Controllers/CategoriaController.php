<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            
            return datatables()->eloquent(Categoria::query())->toJson();
        }
        return view('Categoria.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nombre'=> 'required|string'
        ]);
        $categoria = new Categoria;  
          
        $categoria->nombre = $request->get('nombre');
        $categoria->save();

        return redirect()->action('CategoriaController@index')
            ->with('success','Categoria creada con éxito'); 
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
        $categoria = Categorias::find($id);
        return view('categoria.edit',compact('categoria'));
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
        $validate = $request->validate([
            'nombre'=> 'required|string',
        ]);

        $categoria = Categoria::find($request->id);
        $categoria->nombre=$request->get('nombre');
        $categoria->save();     

        return redirect()->action('CategoriaController@index')
            ->with('success','Categoria editada con éxito'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Categoria::destroy($request->get('id'));
        $categorias = Categoria::all();
        
        return redirect()->action('CategoriaController@index')
            ->with('success','Categoria eliminada con éxito'); 
    }
}
