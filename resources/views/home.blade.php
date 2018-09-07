<!--#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
developed by: Johana Rivas
e-mail: johanarivas57@gmail.com
#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-->
@extends('adminlte::page')
@section('title', 'Inicio')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><h4 class="text-light-blue">Inicio</h4></div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
                Bienvenido, has iniciado sesión como:
                <B>{{ session('status') }}
                {{ Auth::user()->name }} <span class="caret"></span>
                </B> 
        </div>
    </div>
</div>
@endsection