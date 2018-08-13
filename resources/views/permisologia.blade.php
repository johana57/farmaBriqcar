<!--#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
developed by: Johana Rivas
e-mail: johanarivas57@gmail.com
#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-->
@extends('adminlte::page')
@section('title', 'Permisologia')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3 col-md-offset-6">
            <div class="btn-group">
                @can('crear_rol')
                    <button type="button" class="btn btn-default margin" data-toggle="modal" data-target="#createRol">
                        <i class="fa fa-plus-circle"></i> Crear rol
                    </button>
                @endcan
                @can('crear_permiso')
                    <button type="button" class="btn btn-default margin" data-toggle="modal" data-target="#createPermission">
                        <i class="fa fa-plus-circle"></i> Crear Permiso
                    </button>
                @endcan
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <h5><strong>{{ session('success') }}</strong></h5>
        </div>
    @endif
    <div class="alert alert-danger hidden" id="alertDanger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
            <h5><strong>{{ 'No se puede eliminar el rol, existen usuarios asociados.' }}</strong></h5>
    </div>
    <div class="alert alert-success hidden" id="succesAlert">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
            <h5><strong>{{ 'Rol eliminado con exito' }}</strong></h5>
    </div>
<!---->    
    <div class="panel panel-default">
        <div class="panel-heading">Roles y permisos</div>
        <div class="panel-body">
            <table id="rolesCreated" class="table table-bordered table-hover dataTable" role="grid" >
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Permisos</th>
                        @if(auth()->user()->can('editar_roles') || auth()->user()->can('eliminar_roles'))
                            <th>Accion</th
                        @endif
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
                            @if(auth()->user()->can('editar_roles') || auth()->user()->can('eliminar_roles'))
                            <td>
                                @can('editar_roles')
                                    <button type="button" class="btn btn-primary open_modal" data-toggle="modal" data-target="#editRole" value="{{$rol -> id}}" >Editar</button>
                                @endcan
                                @can('eliminar_roles')
                                    <button class="btn btn-danger" data-toggle="confirmation" data-title="¿Seguro que quiere eliminar este rol?" data-btn-ok-label="Si" data-btn-ok-class="btn-success"
                                    data-btn-cancel-label="No" data-btn-cancel-class="btn-danger" value="{{$rol -> id}}"
                                    >Eliminar</button>
                                @endcan
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Permisos</th>
                        @if(auth()->user()->can('editar_roles') || auth()->user()->can('eliminar_roles'))
                            <th>Accion</th
                        @endif
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
                                <button type="submit" class="btn btn-primary margin-top-5">Guardar</button>
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
                                <input id="name" type="text" class="form-control" name="name[]" placeholder="Ingrese el nombre del permiso" autofocus="autofocus">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h4 class="modal-title text-light-blue margin-bottom">Para editar un permiso haga click sobre el</h4>
                        <div class="row">
                            @foreach ($permisos as $permiso)
                                <div class="col-md-3 col-lg-3 col-md-3 margin-bottom">
                                    <button type="button" class="btn-reddit"  data-toggle="modal" data-target="#editPermission" value="{{ $permiso -> id }}" id="{{'permiso'.$loop->index}}"><i class="fa fa-edit"></i>{{ $permiso -> name }}</button>
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
                                        <label><input class ="checkbox" type="checkbox" value="{{ $permiso -> id }}" name="permissionsEdit[]" id="{{'permisoRol'.$loop->index}}">{{ $permiso -> name }}</label>
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
    <script src="{{asset('js/dataTableRoles.js')}}"></script>
    <script src="{{asset('js/editRolModal.js')}}"></script>
    <script src="{{asset('js/deleteRolModal.js')}}"></script>
    <script src="{{asset('js/editPermission.js')}}"></script>
@endsection