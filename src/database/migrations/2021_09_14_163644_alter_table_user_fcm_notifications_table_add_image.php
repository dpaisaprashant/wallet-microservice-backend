<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUserFcmNotificationsTableAddImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::connection('dpaisa')->hasTable('user_fcm_notifications')) {
            if (!Schema::connection('dpaisa')->hasColumn('user_fcm_notifications','image')){
                Schema::connection('dpaisa')->table('user_fcm_notifications', function (Blueprint $table) {
                    $table->string('image')->nullable();
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
