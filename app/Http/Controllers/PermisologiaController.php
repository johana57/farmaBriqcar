<?php
//#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
////developed by: Johana Rivas
////e-mail: johanarivas57@gmail.com
//#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Activitylog\Models\Activity;

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
    public function storePermission(Request $request){
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
        $roles = Role::findById($id);
        $permissions =  $roles->permissions()->get();
        $dataNameRol[] = $roles;
        
        foreach($permissions as $permission){
            $dataNamePermission[] = $permission['id'];
        }

        $data = array_merge($dataNameRol, $dataNamePermission);
        return response()->json($data);
    }
    
    public function updateRole(Request $request, $id){
        $this->validate($request, [
            'name'=>'required|max:20|min:4',
//            'permissions'=>'required',
            ]
        );
        $role = Role::findById($id);
        $role->name = $request->name;
        $role->save();
        $permissions = $request->get('permissionsEdit', []);
//        var_dump($permissions); die();
        $role->syncPermissions($permissions);
        return redirect('permisologia')->with('success','Rol modificado con exito!');
    }
    
    public function deleteRole(Request $request, $id){
        $role = Role::findById($id);
        $user = User::role($role->name)->get();
        $rows = $user->count();
        
        if($rows >= 1){
            echo 1;
        }
        else{
            $permissions =  $role->permissions()->get();
            $role->revokePermissionTo($permissions);
            $role->delete();
            echo 0;
        }

//        $permissions =  $role->permissions()->get();
//        $role->revokePermissionTo($permissions);
//        return redirect('permisologia')->with('success','Rol eliminado con exito!');
    }
    
    public function editPermission(Request $request, $id){
        $permission = Permission::findById($id);
        $data = $permission;
        return response()->json($data);
    }
    
    public function updatePermission(Request $request, $id){
        $permission = Permission::findById($id);
        $permission->name = $request->namePermission;
        $permission->save();
        return redirect('permisologia')->with('success','Permiso modificado con exito!');
    }
}