<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRevenueToPayPointToDpaisaClearanceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('dpaisa')->hasColumn('pay_point_to_dpaisa_clearance_transactions', 'revenue')) {
            Schema::connection('dpaisa')->table('pay_point_to_dpaisa_clearance_transactions', function (Blueprint $table) {
                $table->integer('revenue')->nullable();
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
        Schema::connection('dpaisa')->table('pay_point_to_dpaisa_clearance_transactions', function (Blueprint $table) {
            $table->dropColumn('revenue');
        });
    }
}
