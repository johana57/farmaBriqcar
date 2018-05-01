@extends('adminlte::page')
@section('title', 'Permisologia')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3 col-md-offset-6">
            <div class="btn-group">
                <button type="button" class="btn btn-default margin" data-toggle="modal" data-target="#createRol">
                    <i class="fa fa-plus-circle"></i> Crear rol
                </button>
                <button type="button" class="btn btn-default margin" data-toggle="modal" data-target="#createRol">
                    <i class="fa fa-plus-circle"></i> Crear Permiso
                </button>
            </div>
        </div>
</div>
    <div class="panel panel-default">
        <div class="panel-heading">Roles y permisos</div>
        <div class="panel-body">
            <table id="example" class="table table-bordered table-hover dataTable" role="grid" >
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Permisos</th>
                        <th>Accion</th
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            <td>{{ $rol -> id }}</td>
                            <td>{{ $rol -> name }}</td>
                            <td>@foreach ($rol->permissions as $permission)
                                    {{ $permission -> name. ' ,' }}
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
                        <th>Permisos</th>
                        <th>Accion</th
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(function () {
            $("#example").DataTable();
        });
    </script>
@stop