<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as BasePermission;
use OwenIt\Auditing\Contracts\Auditable;

use Spatie\Activitylog\Traits\LogsActivity;

class Permission extends BasePermission 
{
    use LogsActivity;
    
    protected static $logFillable = true;
}
