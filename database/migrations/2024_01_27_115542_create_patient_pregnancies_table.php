<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientPregnanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_pregnancies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('diagnose_id')->nullable()->constrained('diagnoses')->nullOnDelete();
            $table->foreignId('appointment_id')->constrained('appointments')->cascadeOnDelete();
            $table->integer('children')->nullable()->default(0);
            $table->string('last_childbirth')->nullable();
            $table->boolean('diabetes')->nullable()->default(0);
            $table->boolean('pressure')->nullable()->default(0);
            $table->text('other_diseases')->nullable();
            $table->integer('week')->nullable();
            $table->integer('month')->default(1);
            $table->date('last_menstrual_period')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('child_gender')->nullable();
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
        Schema::dropIfExists('patient_pregnancies');
    }
}
