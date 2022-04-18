<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemRepostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('dpaisa')->hasTable('system_reposts')) {
            Schema::connection('dpaisa')->create('system_reposts', function (Blueprint $table) {
                $table->id();
                $table->foreignId("admin_id");
                $table->foreignId("user_id");
                $table->string("pre_transaction_id");
                $table->integer("amount");
                $table->string("type");
                $table->integer("update_balance")->default(0);
                $table->integer("latest_date")->default(0);
                $table->text("description")->nullable();
                $table->integer("before_balance")->nullable();
                $table->integer("after_balance")->nullable();
                $table->integer("before_bonus_balance")->nullable();
                $table->integer("after_bonus_balance")->nullable();
                $table->string("status");
                $table->string("transaction_type");
                $table->string("before_transaction_status")->nullable();
                $table->string("after_transaction_status")->nullable();
                $table->text("error_description")->nullable();
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
        Schema::connection('dpaisa')->dropIfExists('system_reposts');
    }
}
