<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisputeHandlersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('dispute_handlers')) {
            Schema::connection('dpaisa')->create('dispute_handlers', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('admin_id')->nullable();
                $table->unsignedBigInteger('dispute_id');
                $table->string('handler'); // reimburse, deduction, clearance
                $table->string('reposted_status')->nullable();
                $table->double('reposted_amount')->nullable();
                $table->string('reposted_ref_no')->nullable();
                $table->string('reposted_handler')->nullable();
                $table->unsignedBigInteger('cleared_clearance_id')->nullable();
                $table->string('reposted_clearance_status')->nullable();
                $table->double('reposted_clearance_amount')->nullable();
                $table->double('reposted_clearance_ref_no')->nullable();
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
        Schema::connection('dpaisa')->dropIfExists('dispute_handlers');
    }
}
