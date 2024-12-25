<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisionTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vision_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->cascadeOnDelete();
            $table->foreignId('patient_id')->nullable()->constrained('patients', 'id')->cascadeOnDelete();
            $table->foreignId('dr_id')->nullable()->constrained('users')->cascadeOnDelete();

            $table->float('right_eye_near_axis')->nullable();
            $table->float('right_eye_near_cylinder')->nullable();
            $table->float('right_eye_near_sphere')->nullable();
            $table->float('right_eye_distance_axis')->nullable();
            $table->float('right_eye_distance_cylinder')->nullable();
            $table->float('right_eye_distance_sphere')->nullable();

            $table->float('left_eye_near_axis')->nullable();
            $table->float('left_eye_near_cylinder')->nullable();
            $table->float('left_eye_near_sphere')->nullable();
            $table->float('left_eye_distance_axis')->nullable();
            $table->float('left_eye_distance_cylinder')->nullable();
            $table->float('left_eye_distance_sphere')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vision_tests');
    }
}
