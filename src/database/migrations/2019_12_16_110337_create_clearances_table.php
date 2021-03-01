<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClearancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('clearances')) {
            Schema::connection('dpaisa')->create('clearances', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('admin_id')->unsigned();
                $table->string('dispute_status')->nullable();
                $table->string('clearance_status')->nullable();
                $table->integer('total_transaction_count');
                $table->double('total_transaction_amount');
                $table->double('total_transaction_commission');
                $table->date('transaction_from_date');
                $table->date('transaction_to_date');
                $table->string('image');
                $table->string('clearance_type');
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
        Schema::connection('dpaisa')->dropIfExists('clearances');
    }
}
