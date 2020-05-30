<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use App\User;
class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Rol::busqueda($request->get('busqueda'))->paginate(15);
        $users = User::all();
        return view('rol.index',compact('roles','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create',compact('permissions'));
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
        
        $role = Role::create($request->all());
        $role->permissions()->sync($request->get('permissions'));
        $roles = Role::all()->paginate(15);

        return redirect()->route('roles.index',$roles)
            ->with('info','Rol guardado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::all();
        $cantidad_usuarios = 0;
        $permisos = $role->special;
        if($permisos==null){
            $permisos = $role->permissions;
        }
        foreach($users as $user){
            if($user->hasRole($role->slug)){
                $cantidad_usuarios+=1;
                return view('roles.show',compact('role','cantidad_usuarios','permisos'));
            }
        }
        return view('roles.show',compact('role','cantidad_usuarios','permisos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = Permission::get();
        return view('roles.edit',compact('role','permissions'));
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
         if($role->slug == $request->slug && $nombreantiguo == $nombrenuevo){
            
        }   
        //solo validar el nombre si los slugs son iguales
        elseif($role->slug == $request->slug){
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
        $role->update($request->all());

        //actualizar permisos
        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.index',$roles)
            ->with('success','Rol actualizado con éxito');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Role::findOrFail($request->get('idrol'));
        $rol-> delete();
        $roles = Role::all()->paginate(15);
         
        return redirect()->route('roles.index',$roles)
            ->with('success','Rol eliminado con éxito');
    }

}
