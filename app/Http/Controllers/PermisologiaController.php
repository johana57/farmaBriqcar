<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisologiaController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permisos = Permission::all();
        return view('permisologia', compact('roles','permisos'));
    }
    
  public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|unique:roles|max:10',
            ]
        );
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        if($request->permissions <> ''){
            $role->permissions()->attach($request->permissions);
        }
        return redirect('permisologia')->with('success','Rol creado con exito!');
    }
}
