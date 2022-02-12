<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialChallengesWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('social_challenges_winners'))
        {
            Schema::connection('dpaisa')->create('social_challenges_winners', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->foreignId('social_challenge_id');
                $table->dateTime('won_at');
                $table->text('description')->nullable();
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
        Schema::connection('dpaisa')->dropIfExists('social_challenges_winners');
    }
}
