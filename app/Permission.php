<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Permission extends \Spatie\Permission\Models\Permission implements Auditable
{
    use \OwenIt\Auditing\Auditable;
}
