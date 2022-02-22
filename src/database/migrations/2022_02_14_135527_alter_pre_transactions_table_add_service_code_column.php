<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPreTransactionsTableAddServiceCodeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::connection('dpaisa')->hasTable("pre_transactions")) {

            if (! Schema::connection('dpaisa')->hasColumn("pre_transactions", "service_code")) {
                Schema::connection('dpaisa')->table('pre_transactions', function (Blueprint $table) {
                    $table->integer('service_code')->nullable();
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
