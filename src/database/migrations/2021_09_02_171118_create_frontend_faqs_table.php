<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontendFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::connection('dpaisa')->hasTable('frontend_faqs')){
            Schema::connection('dpaisa')->create('frontend_faqs',function (Blueprint $table){
                $table->id();
                $table->string('question');
                $table->text('answer');
                $table->string('question_type')->nullable();
                $table->string('icon')->nullable();
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
        Schema::connection('dpaisa')->dropIfExists('frontend_faqs');
    }
}
