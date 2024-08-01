<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAakashSmsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('dpaisa')->hasTable('system_reposts')) {
            Schema::connection('dpaisa')->create('aakash_smses', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string("mobile_no", 15);
                $table->string("description")->nullable();
                $table->string("rate", 5)->nullable();
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
        Schema::connection('dpaisa')->dropIfExists('aakash_smses');
    }
}
