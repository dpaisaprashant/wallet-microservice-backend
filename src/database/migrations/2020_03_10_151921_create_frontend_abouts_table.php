<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontendAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('frontend_abouts')) {
            Schema::connection('dpaisa')->create('frontend_abouts', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title');
                $table->string('image');
                $table->text('description');
                $table->string('belongs_to');
                $table->timestamps();
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
        Schema::connection('dpaisa')->dropIfExists('frontend_abouts');
    }
}
