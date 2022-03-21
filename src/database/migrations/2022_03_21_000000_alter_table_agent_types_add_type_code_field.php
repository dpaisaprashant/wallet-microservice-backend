<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class AlterTableAgentTypeAddTypeCodeField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dpaisa')->table("agent_types", function (Blueprint $table) {
            if (!Schema::connection('dpaisa')->hasColumn("agent_types", "type_code")) {
                $table->string("type_code")->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
