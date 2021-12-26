<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableNeaSettlementsAddColumnJsonResponse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('nea_settlements')){
            if (!Schema::hasColumn('nea_settlements','json_response')){
                Schema::table('nea_settlements',function (Blueprint $table){
                    $table->text('json_response');
                });
            }
        }
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
