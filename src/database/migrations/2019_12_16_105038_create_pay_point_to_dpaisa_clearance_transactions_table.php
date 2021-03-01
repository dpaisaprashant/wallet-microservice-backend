<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayPointToDpaisaClearanceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('pay_point_to_dpaisa_clearance_transactions')) {
            Schema::connection('dpaisa')->create('pay_point_to_dpaisa_clearance_transactions', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('dealer_name');
                $table->string('institution');
                $table->string('company_name');
                $table->string('service_code');
                $table->string('registration_date');
                $table->string('account');
                $table->string('amount');
                $table->string('amount_transferred');
                $table->string('commission');
                $table->string('currency')->default('NPR');
                $table->string('refStan');
                $table->string('status');
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
        Schema::dropIfExists('pay_point_to_dpaisa_clearance_transactions');
    }
}
