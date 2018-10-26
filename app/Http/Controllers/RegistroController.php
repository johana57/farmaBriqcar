<?php
//#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
////developed by: Johana Rivas
////e-mail: johanarivas57@gmail.com
//#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TblAudit as Audit;

class RegistroController extends Controller
{
    public function index()
    {
       $audit = Audit::all();
       return view('registros/registros', compact('audit'));
    }
}
