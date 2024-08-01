<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserKYCValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('dpaisa')->hasTable('user_k_y_c_validations')) {
            Schema::connection('dpaisa')->create('user_k_y_c_validations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('kyc_id');
                $table->integer('first_name');
                $table->integer('middle_name');
                $table->integer('last_name');
                $table->integer('date_of_birth');
                $table->integer('fathers_name');
                $table->integer('mothers_name');
                $table->integer('grand_fathers_name');
                $table->integer('spouse_name');
                $table->integer('email');
                $table->integer('occupation');
                //PERMANENT ADDRESS
                $table->integer('province');
                $table->integer('zone');
                $table->integer('district');
                $table->integer('municipality');
                $table->integer('ward_no');

                //TEMPORARY ADDRESS
                $table->integer('tmp_province');
                $table->integer('tmp_zone');
                $table->integer('tmp_district');
                $table->integer('tmp_municipality');
                $table->integer('tmp_ward_no');


                $table->integer('document_type');
                $table->integer('id_no');
                $table->integer('c_issued_date');
                $table->integer('c_issued_from');
                $table->integer('p_photo');
                $table->integer('id_photo_front');
                $table->integer('id_photo_back');
                $table->integer('o_photo');
                $table->integer('gender');
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('user_k_y_c_validations');
    }
}
