<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantRevenueRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('dpaisa')->hasTable('merchant_revenue_records')){
            Schema::connection('dpaisa')->create('merchant_revenue_records', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->foreignId('user_transaction_event_id');
                $table->string('pre_transaction_id');
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
        Schema::dropIfExists('merchant_revenue_records_tabel');
    }
}
