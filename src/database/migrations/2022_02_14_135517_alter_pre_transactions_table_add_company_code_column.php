<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPreTransactionsTableAddCompanyCodeColumn extends Migration
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

            if (! Schema::hasColumn("pre_transactions", "company_code")) {
                Schema::connection('dpaisa')->table('pre_transactions', function (Blueprint $table) {
                    $table->integer('company_code')->nullable();
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
