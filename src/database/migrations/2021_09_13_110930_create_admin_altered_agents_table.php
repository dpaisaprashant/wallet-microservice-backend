<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminAlteredAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_altered_agents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id');
            $table->foreignId('agent_id');
            $table->json('agent_before')->nullable();
            $table->json('agent_after')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_created_agents');
    }
}
