@extends('adminlte::page')
@section('title', 'Inicio')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
       
            @can('crear_solicitud')
                You are logged in!
                {{ session('status') }}
                {{ Auth::user()->name }} <span class="caret"></span>
            @else
                Usted no tiene la permisologia suficiente.
            @endcan
        </div>
    </div>
</div>
@endsection
