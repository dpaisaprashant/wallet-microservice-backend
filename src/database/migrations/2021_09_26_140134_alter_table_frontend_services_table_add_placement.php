<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableFrontendServicesTableAddPlacement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::connection('dpaisa')->hasTable("frontend_services")) {

            if (! Schema::connection('dpaisa')->hasColumn("frontend_services","placement")) {
                Schema::connection('dpaisa')->table('frontend_services', function (Blueprint $table) {
                    $table->string('placement');
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
