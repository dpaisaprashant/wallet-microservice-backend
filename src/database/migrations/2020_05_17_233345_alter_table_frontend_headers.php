<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFrontendHeaders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dpaisa')->table('frontend_headers', function (Blueprint $table) {
            $table->string('google_image')->nullable();
            $table->string('apple_image')->nullable();

            $table->string('service_header')->nullable();
            $table->text('service_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('dpaisa')->table('frontend_headers', function (Blueprint $table) {
            $table->dropColumn('google_image');
            $table->dropColumn('apple_image');
            $table->dropColumn('service_header');
            $table->dropColumn('service_description');
        });
    }
}
