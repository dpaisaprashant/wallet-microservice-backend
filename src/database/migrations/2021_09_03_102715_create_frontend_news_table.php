<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontendNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('dpaisa')->hasTable('frontend_news')){
            Schema::connection('dpaisa')->create('frontend_news',function (Blueprint $table){
                $table->id();
                $table->string('heading');
                $table->string('sub_heading')->nullable();
                $table->text('news_link')->nullable();
                $table->string('image');
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
        Schema::connection('dpaisa')->dropIfExists('frontend_news');
    }
}
