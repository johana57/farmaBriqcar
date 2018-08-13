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

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('usuarios', compact('users','roles'));
    }
    
    public function editUserRol(Request $request, $id){
        $user = User::findOrFail($id);
        $user->getRoleNames();
        return response()->json($user);
    }
    
    public function updateUserRol(Request $request, $id){
        $user = User::findOrFail($id);
        $role = $request->get('roles', []);
        $user->syncRoles($role);
        activity()
                ->performedOn($user)
                ->log('update');
        $user->save();
        return redirect('usuarios')->with('success','Rol asignado con exito!');
    }
}
