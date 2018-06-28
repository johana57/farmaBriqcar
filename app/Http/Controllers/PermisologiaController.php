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
    
    public function storeRol(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|unique:roles|max:20|min:4',
            'permissions'=>'required',
            ]
        );
        $role = new Role();
        $permission = new Permission();
        $role->name = $request->name;
        $role = $role->create(['name' => $role->name]);
        $permissions = $request->get('permissions', []);
        $role->syncPermissions($permissions);
        
        return redirect('permisologia')->with('success','Rol creado con exito!');
    }
    public function storePermission(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|unique:permissions|max:20',
            ]
        );
        
        $permission = new Permission();
        $permission->name = $request->name;
        
        $text = implode(",", $permission->name);
        $array_perm = explode(",", $text);
        
        for($i = 0; $i < count($array_perm); $i++){
            $permission = Permission::firstOrCreate(['name' => trim($array_perm[$i])]);
        }
        return redirect('permisologia')->with('success','Permiso creado con exito!');
    }
    
    public function editRole(Request $request, $id){
//       $role =  Role::findById($id)->permissions;
        $role = Role::findOrFail($id);
        return Response($role);
    }
}