<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableFrontendNewsAddPriority extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::connection('dpaisa')->hasTable("frontend_news")) {

            if (! Schema::connection('dpaisa')->hasColumn("frontend_news","priority")) {
                Schema::connection('dpaisa')->table('frontend_news', function (Blueprint $table) {
                    $table->integer('priority');
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
