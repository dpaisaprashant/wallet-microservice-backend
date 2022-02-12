<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFundWithdraws extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dpaisa')->create('fund_withdraws', function (Blueprint $table) {
            $table->id();
            $table->string('pre_transaction_id');
            $table->string('withdraw_pre_transaction_id');
            $table->foreignId('transaction_event_id')->nullable();
            $table->integer('before_balance');
            $table->integer('after_balance');
            $table->integer('before_bonus_balance');
            $table->integer('after_bonus_balance');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_fund_withdraws');
    }
}
