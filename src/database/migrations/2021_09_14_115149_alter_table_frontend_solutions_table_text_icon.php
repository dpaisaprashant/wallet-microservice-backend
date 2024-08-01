<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableFrontendSolutionsTableTextIcon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::connection('dpaisa')->hasTable("frontend_solutions")) {
            if (Schema::connection('dpaisa')->hascolumn("frontend_solutions",'icon')) {
                Schema::connection('dpaisa')->table('frontend_solutions', function (Blueprint $table) {
                    $table->renameColumn('icon','image');
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
