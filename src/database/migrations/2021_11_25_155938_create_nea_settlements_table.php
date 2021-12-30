<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeaSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nea_settlements', function (Blueprint $table) {
            $table->id();
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('transaction_count');
            $table->bigInteger('transaction_sum');
            $table->string('bank_account_name');
            $table->string('bank_account_number');
            $table->string('bank_name');
            $table->string('bank_code');
            $table->string('branch_name')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('nea_branch_code')->nullable();
            $table->string('nea_branch_name')->nullable();
            $table->text('description')->nullable();
            $table->string('status');
            $table->integer('non_real_time_bank_transfer_id');
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
        Schema::dropIfExists('nea_settlements');
    }
}
