<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminOTPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_o_t_p_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token', 20);
            $table->unsignedBigInteger('admin_id')->index();
            $table->timestamp('expires_on');
            $table->string('description')->nullable();
            $table->boolean('status')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('admin_o_t_p_s');
    }
}
