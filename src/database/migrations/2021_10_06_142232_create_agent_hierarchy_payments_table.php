<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentHierarchyPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('dpaisa')->hasTable('agent_hierarchy_payments')) {
            Schema::connection('dpaisa')->create('agent_hierarchy_payments', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('pre_transaction_id');
                $table->integer('parent_agent_id')->nullable();
                $table->integer('sub_agent_id')->nullable();
                $table->string('service')->nullable();
                $table->integer('amount')->nullable();
                $table->string('status')->nullable();
                $table->json('response_json')->nullable();
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
        Schema::dropIfExists('agent_hierarchy_payments');
    }
}
