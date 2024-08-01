<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableLoadTestFundsAddBeforeAfterBonusBalanceFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::connection('dpaisa')->hasTable("load_test_funds")) {

            if (! Schema::connection('dpaisa')->hasColumn("load_test_funds", "before_bonus_balance")) {
                Schema::connection('dpaisa')->table('load_test_funds', function (Blueprint $table) {
                    $table->integer('before_bonus_balance')->nullable();
                });
            }

            if (! Schema::connection('dpaisa')->hasColumn("load_test_funds", "after_bonus_balance")) {
                Schema::connection('dpaisa')->table('load_test_funds', function (Blueprint $table) {
                    $table->integer('after_bonus_balance')->nullable();
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
