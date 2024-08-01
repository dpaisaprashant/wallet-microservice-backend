<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableFrontendHeadersTableNullableSubtitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::connection('dpaisa')->hasTable("frontend_headers")) {
            if (Schema::connection('dpaisa')->hascolumn("frontend_headers",'sub_title')) {
                Schema::connection('dpaisa')->table('frontend_headers', function (Blueprint $table) {
                    $table->text('sub_title')->nullable()->change();
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
