<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionTypeMerchantRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('dpaisa')->hasTable('wallet_transaction_type_merchant_revenues')){
            Schema::connection('dpaisa')->create('wallet_transaction_type_merchant_revenues', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable(); //send to frontend
                $table->unsignedBigInteger('wallet_transaction_type_id');
                $table->string('merchant_revenue_type');
                $table->string('merchant_revenue_value');
                $table->string('slab_from')->nullable();
                $table->string('slab_to')->nullable();
                $table->string('description')->nullable();
                $table->foreignId('user_id');
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
        Schema::dropIfExists('wallet_transaction_type_merchant_revenues');
    }
}
