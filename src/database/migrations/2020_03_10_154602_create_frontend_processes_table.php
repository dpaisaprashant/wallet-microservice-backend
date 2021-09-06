<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontendProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('frontend_processes')) {
            Schema::connection('dpaisa')->create('frontend_processes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title');
                $table->string('icon')->nullable();
                $table->string('image')->nullable();
                $table->text('description');
                $table->integer('sequence');
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
        Schema::connection('dpaisa')->dropIfExists('frontend_processes');
    }
}
