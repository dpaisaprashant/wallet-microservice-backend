<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUpdateKycsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_update_kycs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id');
            $table->foreignId('user_kyc_id');
            $table->json('kyc_before_change')->nullable();
            $table->json('kyc_after_change')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_update_kycs');
    }
}
