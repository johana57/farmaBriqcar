<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Contracts\Permission;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $users = User::with('roles')->get();
        return view('usuarios', compact('users','roles'));
    }
}
