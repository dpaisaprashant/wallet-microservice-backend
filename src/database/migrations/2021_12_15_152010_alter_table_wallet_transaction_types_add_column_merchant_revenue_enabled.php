<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableWalletTransactionTypesAddColumnMerchantRevenueEnabled extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::connection('dpaisa')->hasTable("wallet_transaction_types")) {

            if (! Schema::connection('dpaisa')->hasColumn("wallet_transaction_types","merchant_revenue_enabled")) {
                Schema::connection('dpaisa')->table('wallet_transaction_types', function (Blueprint $table) {
                    $table->integer('merchant_revenue_enabled')->default(0);
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
