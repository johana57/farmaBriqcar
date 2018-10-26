<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblAudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_audit', function (Blueprint $table) {
            $table->increments('pk_audit');
            $table->string('TableName',45);
            $table->char('Operation',1);
            $table->text('OldValue')->nullable();
            $table->text('NewValue')->nullable();
            $table->dateTime('UpdateDate');
            $table->string('UserName',45);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_audit');
    }
}
