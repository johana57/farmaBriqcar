@extends('adminlte::page')
@section('title', 'Usuarios')
@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <h5><strong>{{ session('success') }}</strong></h5>
        </div>
    @endif
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
                        @can('editar_rol_usuario') 
                            <th>Accion</th
                        @endcan
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
                            @can('editar_rol_usuario')
                                <td>
                                    <button type="button" class="btn btn-primary open_modal" data-toggle="modal" data-target="#editUserRol" value="{{ $user -> id }}"><i class="fa fa-edit"></i>Editar</button>
                                </td>
                            @endcan
                        </tr>
                  @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>rol</th>
                        @can('editar_rol_usuario')
                            <th>Accion</th
                        @endcan
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
<!--Edit User Rol-->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="editUserRol">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-light-blue" id="editRolUser">Cambiar rol asignado al usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="" id="updateUserRol">
                        {{ csrf_field() }}
                        
                        <div class="row">
                            @foreach ($roles as $rol)
                                <div class="col-md-3 col-lg-3 col-md-3">
                                    <div class="radio">
                                        <label><input type="radio" value="{{ $rol -> id }}" name="roles[]" id="{{'rol'.$loop->index}}">{{ $rol -> name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-5">
                                <button type="submit" class="btn btn-primary margin-top-5">Guardar cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('js/dataTable.js')}}"></script>
    <script src="{{asset('js/editUserRol.js')}}"></script>
@endsection