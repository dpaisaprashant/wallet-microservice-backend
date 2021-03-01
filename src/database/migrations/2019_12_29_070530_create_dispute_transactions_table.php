<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisputeTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('dispute_transactions')) {
            Schema::connection('dpaisa')->create('dispute_transactions', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('dispute_id')->unsigned();
                $table->unsignedBigInteger('transaction_id')->index();
                $table->string('transaction_type')->index();
                $table->string('dispute_status')->nullable();
                $table->double('disputed_amount')->nullable();
                $table->double('refund_amount')->nullable();
                $table->text('description')->nullable();
                $table->integer('cleared_clearance_id')->nullable()->unsigned();
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
        Schema::connection('dpaisa')->dropIfExists('dispute_transactions');
    }
}
