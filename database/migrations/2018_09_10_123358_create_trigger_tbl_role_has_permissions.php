<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerTblRoleHasPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if(Auth::user()){
            $user =  Auth::user()->name;
        }else{
            $user = 0;
        }
        $result = DB::unprepared('CREATE TRIGGER tbl_atributos_tg_audit AFTER INSERT OR UPDATE OR DELETE
ON role_has_permissions FOR EACH ROW EXECUTE PROCEDURE fn_log_audit("'.$user.'");');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
