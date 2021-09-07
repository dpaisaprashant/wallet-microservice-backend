<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontendHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('frontend_headers')) {
            Schema::connection('dpaisa')->create('frontend_headers', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('top_title');
                $table->string('bottom_title');
                $table->text('sub_title');
                $table->string('google_link')->nullable();
                $table->string('apple_link')->nullable();
                $table->string('button_text')->nullable();
                $table->string('button_link')->nullable();
                $table->string('image');
                $table->string('google_image')->nullable();
                $table->string('apple_image')->nullable();
                $table->string('service_header')->nullable();
                $table->text('service_description')->nullable();
                $table->integer('sequence')->nullable();
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
        Schema::connection('dpaisa')->dropIfExists('frontend_headers');
    }
}
