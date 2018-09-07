<!--#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
developed by: Johana Rivas
e-mail: johanarivas57@gmail.com
#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-->
@extends('adminlte::page')
@section('title', 'Inicio')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border" style="background: #eee;">
        <div class="panel-heading" style="padding: 0"><h4 class="text-light-blue">Inicio</h4></div>
    </div>
    <div class="box-body">
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
@endsection