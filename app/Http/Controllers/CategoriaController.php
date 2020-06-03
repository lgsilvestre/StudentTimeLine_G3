<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        /**$categoria = Categoria::all();
        return redirect()->route('categoria.index',$categorias)->with([
            'message'=> 'La categoria ha sido ingresada correctamente.'
        ]);*/
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
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nombre'=> 'required|string',
        ]);

        $categoria = Categoria::find($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->save();    

        /**$categorias = Categoria::all();

        return redirect()->route('categoria.index',$categorias)->with([
            'message'=>'La categoria ha sido actualizada correctamente']);
            */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categoria::destroy($id);
        $categorias = Categoria::all();
        /*
        return redirect()->route('categoria.index',$categorias)->with([
            'message'=>'La categoria ha sido eliminada correctamente']);*/
    }
}
