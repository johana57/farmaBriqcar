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
        return view('permisologia', compact('roles'));
    }
}
