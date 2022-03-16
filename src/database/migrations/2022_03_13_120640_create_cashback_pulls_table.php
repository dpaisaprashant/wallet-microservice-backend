<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashbackPullsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('dpaisa')->hasTable('cashback_pulls')) {
            Schema::connection('dpaisa')->create('cashback_pulls', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger("user_id")->index();
                $table->unsignedBigInteger("admin_id")->nullable()->index();

                //new pre transaction id for this transaction
                $table->string("pre_transaction_id")->index()->nullable();

                //pre transaction id of refunded transaction
                $table->string("refunded_pre_transaction_id")->index();
                //transaction event id of refunded transaction
                $table->unsignedBigInteger("refunded_transaction_event_id")->index();
                //transaction event id of pulled cashback
                $table->unsignedBigInteger("pulled_cashback_transaction_event_id")->index();
                //commission id of pulled cashback
                $table->unsignedBigInteger("pulled_cashback_commission_id")->index();

                $table->text("description")->nullable();

                $table->integer("amount");
                $table->integer("before_balance");
                $table->integer("after_balance");
                $table->integer("before_bonus_balance");
                $table->integer("after_bonus_balance");
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
        Schema::dropIfExists('user_prize_codes');
    }
}
