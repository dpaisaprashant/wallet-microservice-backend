<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusToMainBalanceFundTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('dpaisa')->hasTable('bonus_to_main_balance_fund_transfers')) {
            Schema::connection('dpaisa')->create('bonus_to_main_balance_fund_transfers', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->integer('amount');
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('dpaisa')->dropIfExists('bonus_to_main_balance_fund_transfers');
    }
}
