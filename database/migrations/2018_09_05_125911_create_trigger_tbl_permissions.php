<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerTblPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Auth::user()){
            $user = $_SERVER['PHP_AUTH_USER'];
        }else{
            $user = 0;
        }
        $result = DB::unprepared('CREATE TRIGGER tbl_atributos_tg_audit AFTER INSERT OR UPDATE OR DELETE
ON permissions FOR EACH ROW EXECUTE PROCEDURE fn_log_audit("'.$user.'");');
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
