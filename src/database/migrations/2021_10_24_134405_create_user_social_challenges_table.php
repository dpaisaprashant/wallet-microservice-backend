<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSocialChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('user_social_challenges'))
        {
            Schema::connection('dpaisa')->create('user_social_challenges', function (Blueprint $table) {
                $table->id();
                $table->foreignId('social_challenge_id');
                $table->foreignId('user_id');
                $table->text('link');
                $table->text('embed_link')->nullable();
                $table->text('caption')->nullable();
                $table->string('challenge_status')->nullable();
                $table->string('special1')->nullable();
                $table->string('special2')->nullable();
                $table->string('special3')->nullable();
                $table->string('special4')->nullable();
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
        Schema::dropIfExists('user_social_challenges');
    }
}
