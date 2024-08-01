<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackendUserWalletUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backend_user_wallet_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('backend_user_id');
            $table->integer('wallet_user_id');
            $table->json('before_properties');
            $table->json('after_properties');
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
        Schema::dropIfExists('backend_user_wallet_users');
    }
}
