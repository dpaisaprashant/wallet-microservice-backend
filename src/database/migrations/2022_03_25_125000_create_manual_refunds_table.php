<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('dpaisa')->hasTable('manual_refunds')) {
            Schema::connection('dpaisa')->create('manual_refunds', function (Blueprint $table) {
                $table->id();
                $table->foreignId("admin_id");
                $table->foreignId("user_id");
                $table->string("pre_transaction_id");
                $table->integer("amount");
                $table->string("type");
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
        Schema::connection('dpaisa')->dropIfExists('manual_refunds');
    }
}
