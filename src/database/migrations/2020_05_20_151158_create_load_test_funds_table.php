<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadTestFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('load_test_funds')) {
<<<<<<< HEAD

            Schema::connection('dpaisa')->create('load_test_funds', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id')->index();
                $table->text('description')->nullable();
                $table->integer('before_amount');
                $table->integer('after_amount');
                $table->timestamps();
            });
        }
=======
        Schema::connection('dpaisa')->create('load_test_funds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->text('description')->nullable();
            $table->integer('before_amount');
            $table->integer('after_amount');
            $table->timestamps();
        });
>>>>>>> dc27076269d6fb6f565fac3508064df5220bf4ff
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('dpaisa')->dropIfExists('load_test_funds');
    }
}
