<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrthodonticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orthodontics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('patient_id')->nullable()->constrained('patients', 'id')->cascadeOnDelete();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments', 'id')->cascadeOnDelete();
            $table->text('main_complaint')->nullable();
            $table->text('signs_and_symptoms')->nullable();
            $table->text('diagnoses')->nullable();
            $table->text('treatment_plan')->nullable();
            $table->text('treatment_done')->nullable();
            $table->text('visit_notes')->nullable();
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
        Schema::dropIfExists('orthodontics');
    }
}
