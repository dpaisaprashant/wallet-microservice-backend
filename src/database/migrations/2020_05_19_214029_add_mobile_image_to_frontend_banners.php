<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMobileImageToFrontendBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('frontend_banners')) {
        Schema::connection('dpaisa')->table('frontend_banners', function (Blueprint $table) {
            $table->string('mobile_image')->nullable();
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
        Schema::connection('dpaisa')->table('frontend_banners', function (Blueprint $table) {
            $table->dropColumn('mobile_image');
        });
    }
}
