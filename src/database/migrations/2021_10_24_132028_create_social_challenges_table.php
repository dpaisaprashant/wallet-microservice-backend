<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('social_challenges'))
        {
            Schema::connection('dpaisa')->create('social_challenges', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('code')->unique();
                $table->string('type');
                $table->text('description')->nullable();
                $table->text('terms_and_conditions')->nullable();
                $table->integer('status');
                $table->integer('attempts_per_user');
                $table->dateTime('expired_at')->nullable();
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
        Schema::dropIfExists('social_challenges');
    }
}
