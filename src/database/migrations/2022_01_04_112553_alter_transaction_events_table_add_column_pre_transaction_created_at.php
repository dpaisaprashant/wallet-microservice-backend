<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransactionEventsTableAddColumnPreTransactionCreatedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::connection('dpaisa')->hasTable("transaction_events")) {

            if (! Schema::connection('dpaisa')->hasColumn("transaction_events","pre_transaction_created_at")) {
                Schema::connection('dpaisa')->table('transaction_events', function (Blueprint $table) {
                    $table->dateTime('pre_transaction_created_at',6)->nullable();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
