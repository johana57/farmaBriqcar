<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as BasePermission;
use OwenIt\Auditing\Contracts\Auditable;

use Spatie\Activitylog\Traits\LogsActivity;

class Permission extends BasePermission 
{
    public static function defaultPermissions(){
        return [           
            'ver_roles',
            'crear_rol',
            'crear_permiso',
            'editar_roles',
            'eliminar_roles',
            'ver_usuario',
            'ver_seguridad',
            'editar_rol_usuario',
        ];
    }
}
