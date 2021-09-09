<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontendPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('dpaisa')->hasTable('frontend_partners')){
            Schema::connection('dpaisa')->create('frontend_partners',function (Blueprint $table){
                $table->id();
                $table->string('image');
                $table->string('name');
                $table->text('link')->nullable();
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
        Schema::connection('dpaisa')->dropIfExists('frontend_partners');
    }
}
