<!--#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
developed by: Johana Rivas
e-mail: johanarivas57@gmail.com
#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-->
@extends('adminlte::page')
@section('title', 'Registro de operciones')
@section('content')
<div class="box"> 
    <div class="panel panel-default">
        <div class="panel-heading"><h4 class="text-light-blue">Registro de operaciones</h4></div>
        <div class="panel-body">
            <table id="registroOpe" class="table table-bordered table-hover dataTable" role="grid" >
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Operacion</th>
                        <th>Tabla afectada</th>
                        <th>Registro Antiguo</th>
                        <th>Registro Nuevo</th>
                        <th>Realizado por</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($audit as $auditoria)
                        @if($auditoria->Operation == 'I')
                            <tr class="success">
                                <td>{{ $auditoria ->pk_audit}}</td>
                                <td class="success">{{ "Inserto" }}</td>
                                <td>{{ $auditoria ->TableName}}</td>
                                <td>{{ $auditoria -> OldValue }}</td>
                                <td>{{ $auditoria -> NewValue }}</td>
                                <td>{{ $auditoria -> UserName }}</td>
                                <td>{{ $auditoria -> UpdateDate }}</td>
                            </tr>
                            @elseif($auditoria->Operation == 'U')
                                <tr class="warning">
                                    <td>{{ $auditoria ->pk_audit}}</td>
                                    <td class="success">{{ "Edito" }}</td>
                                    <td>{{ $auditoria ->TableName}}</td>
                                    <td>{{ $auditoria -> OldValue }}</td>
                                    <td>{{ $auditoria -> NewValue }}</td>
                                    <td>{{ $auditoria -> UserName }}</td>
                                    <td>{{ $auditoria -> UpdateDate }}</td>
                                </tr>
                            @else($auditoria->Operation == 'D')
                                 <tr class="danger">
                                    <td>{{ $auditoria ->pk_audit}}</td>
                                    <td class="success">{{ "Elimino" }}</td>
                                    <td>{{ $auditoria ->TableName}}</td>
                                    <td>{{ $auditoria -> OldValue }}</td>
                                    <td>{{ $auditoria -> NewValue }}</td>
                                    <td>{{ $auditoria -> UserName }}</td>
                                    <td>{{ $auditoria -> UpdateDate }}</td>
                                </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Operacion</th>
                        <th>Tabla afectada</th>
                        <th>Registro Antiguo</th>
                        <th>Registro Nuevo</th>
                        <th>Realizado por</th>
                         <th>Fecha</th>
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