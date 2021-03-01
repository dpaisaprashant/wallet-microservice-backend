<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisputesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('dpaisa')->hasTable('disputes')) {
            Schema::connection('dpaisa')->create('disputes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('transaction_id')->index();
                $table->string('transaction_type')->index();
                $table->string('dispute_type'); // [clearance, single]
                $table->string('vendor_type'); // [npay, paypoint]
                $table->string('vendor_status')->nullable();
                $table->double('vendor_amount')->nullable();
                $table->unsignedBigInteger('clearance_id')->nullable();
                $table->double('user_amount')->nullable();
                $table->string('user_status')->nullable();
                $table->string('source')->nullable(); // [null, dpaisa, npay]
                $table->string('handler')->nullable(); // [null, automatic, manual reimburse, manual deduct, clearance]
                $table->string('user_dispute_status')->nullable(); // [started, processing, cleared]
                $table->string('clearance_dispute_status')->nullable(); // [started, processing, cleared]
                $table->double('reposted_amount')->nullable();
                $table->string('reposted_status')->nullable();
                $table->string('reposted_ref_no')->nullable();
                $table->string('reposted_handler')->nullable(); // [null, deduction, reimburse]
                $table->text('description')->nullable();
                $table->unsignedBigInteger('admin_id');
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
        Schema::connection('dpaisa')->dropIfExists('disputes');
    }
}
