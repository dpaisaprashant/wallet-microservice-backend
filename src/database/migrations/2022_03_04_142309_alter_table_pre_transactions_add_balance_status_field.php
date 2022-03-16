<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class AlterTablePreTransactionsAddBalanceStatusField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dpaisa')->table("pre_transactions", function (Blueprint $table) {
            if (!Schema::connection('dpaisa')->hasColumn("pre_transactions", "balance_status")) {
                $table->string("balance_status")->nullable();
            }
        });
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
