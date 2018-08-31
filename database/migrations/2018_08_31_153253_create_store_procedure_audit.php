<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreProcedureAudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE OR REPLACE FUNCTION fn_log_audit() RETURNS trigger AS
$$
BEGIN
  IF (TG_OP = 'DELETE') THEN 
    INSERT INTO tbl_audit VALUES (default, TG_TABLE_NAME, 'D',OLD, NULL, now(), USER);
    RETURN OLD;
    
  ELSIF (TG_OP = 'UPDATE') THEN
    INSERT INTO tbl_audit VALUES (default, TG_TABLE_NAME, 'U',OLD, NULL, now(), USER);
    RETURN NEW;
    
  ELSIF (TG_OP = 'INSERT') THEN
    INSERT INTO tbl_audit VALUES (default, TG_TABLE_NAME, 'I',NULL, NEW, now(), USER);
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
