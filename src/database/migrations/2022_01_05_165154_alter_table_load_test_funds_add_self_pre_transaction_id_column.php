<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableLoadTestFundsAddSelfPreTransactionIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::connection('dpaisa')->hasTable('load_test_funds')){
            if (!Schema::connection('dpaisa')->hasColumn('load_test_funds','self_pre_transaction_id')){
                Schema::connection('dpaisa')->table('load_test_funds',function (Blueprint $table){
                    $table->string('self_pre_transaction_id');
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
