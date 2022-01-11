<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableFrontendServicesTableAddBelongsTo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::connection('dpaisa')->hasTable("frontend_services")) {

            if (! Schema::connection('dpaisa')->hasColumn("frontend_services","belongs_to")) {
                Schema::connection('dpaisa')->table('frontend_services', function (Blueprint $table) {
                    $table->string('belongs_to');
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
