<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Auth;

class CreateStoreProcedureAudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Auth::user()){
            $id = Auth::user()->name;
        }else{
            
            $id = get_current_user();
        }
        $result = DB::unprepared("
CREATE OR REPLACE FUNCTION fn_log_audit() RETURNS trigger AS
$$
 
BEGIN
  IF (TG_OP = 'DELETE') THEN 
    INSERT INTO tbl_audit VALUES (default, TG_TABLE_NAME, 'D',OLD, NULL, now(), '$id');
    RETURN OLD;
    
  ELSIF (TG_OP = 'UPDATE') THEN
    INSERT INTO tbl_audit VALUES (default, TG_TABLE_NAME, 'U',OLD, NULL, now(), '$id');
    RETURN NEW;
    
  ELSIF (TG_OP = 'INSERT') THEN
    INSERT INTO tbl_audit VALUES (default, TG_TABLE_NAME, 'I',NULL, NEW, now(), '$id');
    RETURN NEW;
 
  END IF;
  RETURN NULL;
END;
$$
LANGUAGE 'plpgsql' VOLATILE COST 100;");
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
