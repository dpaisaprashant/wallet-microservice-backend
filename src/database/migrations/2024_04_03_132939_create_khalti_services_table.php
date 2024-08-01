<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhaltiServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khalti_services', function (Blueprint $table) {
            $table->id();
            // $table->string('slug');
            // $table->string('process');
            // $table->string('icon')->nullable();
            // $table->boolean('status');
            // $table->string('type');
            // $table->boolean('change');
            $table->string('label');
            $table->string('image')->nullable();
            $table->json('service');
            $table->boolean('step')->default(true);
            $table->json('forms')->nullable();
            $table->json('paymentDetail');
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
        Schema::dropIfExists('khalti_services');
    }
}
