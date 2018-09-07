<!--#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
developed by: Johana Rivas
e-mail: johanarivas57@gmail.com
#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-->
@extends('adminlte::page')
@section('title', 'Registro de operciones')
@section('content')
<div class="container"> 
    <div class="panel panel-default">
        <div class="panel-heading"><h4 class="text-light-blue">Registro de operaciones</h4></div>
        <div class="panel-body">
            <table id="registroOpe" class="table table-bordered table-hover dataTable" role="grid" >
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Operacion</th>
                        <th>Registro Antiguo</th>
                        <th>Registro Nuevo</th>
                        <th>Realizado por</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Operacion</th>
                        <th>Registro Antiguo</th>
                        <th>Registro Nuevo</th>
                        <th>Realizado por</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('js/dataTableRegistros.js')}}"></script>
@endsection