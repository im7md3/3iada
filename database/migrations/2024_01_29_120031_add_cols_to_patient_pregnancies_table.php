<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToPatientPregnanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_pregnancies', function (Blueprint $table) {
            $table->foreignId('pregnancy_category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->boolean('is_compeleted')->default(0); // 1 = yes, 0 = no

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_pregnancies', function (Blueprint $table) {
            //
        });
    }
}
