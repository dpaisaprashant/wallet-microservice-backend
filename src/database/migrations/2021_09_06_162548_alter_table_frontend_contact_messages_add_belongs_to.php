<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableFrontendContactMessagesAddBelongsTo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::connection('dpaisa')->hasTable("frontend_contact_messages")) {
            if (! Schema::connection('dpaisa')->hasColumn("frontend_contact_messages","belongs_to")) {
                Schema::connection('dpaisa')->table('frontend_contact_messages', function (Blueprint $table) {
                    $table->string('belongs_to');
                });
            }
        }
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
