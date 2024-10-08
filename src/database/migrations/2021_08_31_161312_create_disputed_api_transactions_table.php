<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisputedApiTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disputed_api_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pre_transaction_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('ref_stan')->nullable();
            $table->string('api_response')->nullable();
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
        Schema::dropIfExists('disputed_api_transactions');
    }
}
