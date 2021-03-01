<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNPayToDpaisaClearanceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('n_pay_to_dpaisa_clearance_transactions')) {
            Schema::connection('dpaisa')->create('n_pay_to_dpaisa_clearance_transactions', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('gateway_ref_no');
                $table->string('card_no');
                $table->string('customer_transaction_id');
                $table->string('sct_id');
                $table->string('amount');
                $table->string('service_charge');
                $table->string('net_amount');
                $table->string('sct_npay_status');
                $table->string('cbs_status');
                $table->string('transaction_date');
                $table->integer('clearance_id')->unsigned();
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
        Schema::connection('dpaisa')->dropIfExists('n_pay_to_dpaisa_clearance_transactions');
    }
}
