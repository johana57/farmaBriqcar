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
                <button type="button" class="btn btn-default margin" data-toggle="modal" data-target="#createPermission">
                    <i class="fa fa-plus-circle"></i> Crear Permiso
                </button>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <h5><strong>{{ session('success') }}</strong></h5>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Roles y permisos</div>
        <div class="panel-body">
            <table id="rolesCreated" class="table table-bordered table-hover dataTable" role="grid" >
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
                            <td>
                                @foreach ($rol->permissions as $permission)
                                    {{ $permission -> name. ' ,' }}
                                @endforeach
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary open_modal" data-toggle="modal" data-target="#editRole" value="{{$rol -> id}}" >Editar</button>
                                <button class="btn btn-danger" data-toggle="confirmation" data-title="¿Seguro que quiere eliminar este rol?" data-btn-ok-label="Si" data-btn-ok-class="btn-success"
                                   data-btn-cancel-label="No" data-btn-cancel-class="btn-danger" value="{{$rol -> id}}"
                                >Eliminar</button>
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
<!--create rol-->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="createRol">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-light-blue" id="crearRolModal">Crear rol</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="saveRol">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" placeholder="Ingrese el nombre del rol" autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h4 class="modal-title text-light-blue">Por favor indique los permisos asociados al rol</h4>
                        <div class="row">
                            @foreach ($permisos as $permiso)
                                <div class="col-md-3 col-lg-3 col-md-3">
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="{{ $permiso -> id }}" name="permissions[]" id="{{'permiso'.$loop->index}}">{{ $permiso -> name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
<!--Create Permission-->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="createPermission">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-light-blue" id="crearRolModal">Crear Permiso</h4>
                    <h5 class="modal-title" id="crearRolModal">Para crear mas de un permiso por favor ingrese los nombres separados por coma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="savePermission">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name[]" placeholder="Ingrese el nombre del permiso" autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h4 class="modal-title text-light-blue">Para editar un permiso haga click sobre el</h4>
                        @foreach ($permisos as $permiso)
                            <div class="col-md-3 col-lg-3 col-md-3">
                                <button type="button" class="btn-reddit"  data-toggle="modal" data-target="#editPermission" value="{{ $permiso -> id }}" id="{{'permiso'.$loop->index}}"><i class="fa fa-edit"></i>{{ $permiso -> name }}</button>
                            </div>
                        @endforeach
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
</div>
<!--Edit Role-->
<div id="editRole" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-light-blue" id="crearRolModal">Editar rol</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="" id="updateRol">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-12">
                                <input id="nameRol" type="text" class="form-control" name="name" autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h4 class="modal-title text-light-blue">Por favor indique los permisos asociados al rol</h4>
                        <div class="row">
                            @foreach ($permisos as $permiso)
                                <div class="col-md-3 col-lg-3 col-md-3">
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="{{ $permiso -> id }}" name="permissionsEdit[]" id="{{'permiso'.$loop->index}}">{{ $permiso -> name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
<!--Edit Permission-->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="editPermission">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-light-blue" id="crearRolModal">Editar Permiso</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="" id="updatePermission">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-12">
                                <input id="namePermission" type="text" class="form-control" name="namePermission" autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/dataTable.js')}}"></script>
    <script src="{{asset('js/editRolModal.js')}}"></script>
    <script src="{{asset('js/deleteRolModal.js')}}"></script>
    <script src="{{asset('js/editPermission.js')}}"></script>
@endsection