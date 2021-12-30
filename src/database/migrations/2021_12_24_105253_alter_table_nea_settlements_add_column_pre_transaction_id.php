<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableNeaSettlementsAddColumnPreTransactionId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('nea_settlements')){
            if (!Schema::hasColumn('nea_settlements','pre_transaction_id')){
                Schema::table('nea_settlements',function (Blueprint $table){
                   $table->string('pre_transaction_id');
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
