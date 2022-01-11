<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableFrontendHeadersTableAddSequence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::connection('dpaisa')->hasTable("frontend_headers")) {

            if (! Schema::connection('dpaisa')->hasColumn("frontend_headers","sequence")) {
                Schema::connection('dpaisa')->table('frontend_headers', function (Blueprint $table) {
                    $table->integer('sequence')->nullable();
                });
            }
        }

        if (Schema::connection('dpaisa')->hasTable("frontend_headers")) {

            if (! Schema::connection('dpaisa')->hasColumn("frontend_headers","belongs_to")) {
                Schema::connection('dpaisa')->table('frontend_headers', function (Blueprint $table) {
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
