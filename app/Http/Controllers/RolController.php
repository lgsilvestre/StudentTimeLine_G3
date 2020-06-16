<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use App\User;
use DataTables;
class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        /* $roles = Role::all();
        return view('rol.index',compact('roles')); */
        //por si se usara server process de datatables
        if($request->ajax()){
            
            return datatables()->eloquent(Role::query())->toJson();
        }
        return view('rol.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'slug' => 'required|unique:roles|max:18',
            'name' => 'required|unique:roles|min:3|max:45',
        ]);
        
        $Role = Role::create($request->all());
        $roles = Role::all();

        return redirect()->route('roles.index',$roles)
            ->with('info','Role guardado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $Role)
    {
        $users = User::all();
        $cantidad_usuarios = 0;
        $permisos = $Role->special;
        if($permisos==null){
            $permisos = $Role->permissions;
        }
        foreach($users as $user){
            if($user->hasRole($Role->slug)){
                $cantidad_usuarios+=1;
                return view('roles.show',compact('Role','cantidad_usuarios','permisos'));
            }
        }
        return view('roles.show',compact('Role','cantidad_usuarios','permisos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $Role)
    {
        $permissions = Permission::get();
        return view('roles.edit',compact('Role','permissions'));
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
         //no validar nada si se mantienen los mismos parametros
         if($Role->slug == $request->slug && $nombreantiguo == $nombrenuevo){
            
        }   
        //solo validar el nombre si los slugs son iguales
        elseif($Role->slug == $request->slug){
            $validatedData = $request->validate([
                'name' => 'required|unique:roles|min:3|max:190',
            ]);
            
        }
        //validar solo los slugs si los nombres son iguales
        elseif($nombreantiguo == $nombrenuevo){
             
            $validatedData = $request->validate([
                'slug' => 'required|unique:roles|max:18|min:3',
            ]);
        }
        //si ambos son diferentes
        else{
            $validatedData = $request->validate([
                'slug' => 'required|unique:roles|max:18|min:3',
                'name' => 'required|unique:roles|min:3|max:190',
            ]);
            
        }
        //actualizar rol
        $Role->update($request->all());

        //actualizar permisos
        $Role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.index',$roles)
            ->with('success','Role actualizado con éxito');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $rol = Role::findOrFail($request->get('idrol'));
        $rol-> delete();
        $roles = Role::all();
        
        return redirect()->action('RolController@index')
            ->with('success','Rol eliminado con éxito'); 
    }

}
