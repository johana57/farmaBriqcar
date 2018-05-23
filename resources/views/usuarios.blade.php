@extends('adminlte::page')
@section('title', 'Usuarios')
@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Usuarios</div>
        <div class="panel-body">
            <table id="example" class="table table-bordered table-hover dataTable" role="grid" >
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>rol</th>
                        <th>Accion</th
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user -> id }}</td>
                            <td>{{ $user -> name }}</td>
                            <td>{{ $user -> username }}</td>
                            <td>
                                @foreach ($user->roles as $rol)
                                    {{ $rol -> name }}
                                @endforeach
                            </td>
                            <td>
                                <a class="btn btn-primary"><i class="fa fa-edit"></i> Editar rol</a>
                            </td>
                        </tr>
                  @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>rol</th>
                        <th>Accion</th
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('js/dataTable.js')}}"></script>
@endsection