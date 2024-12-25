<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrthodonticVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orthodontic_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orthodontic_id')->nullable()->constrained('orthodontics', 'id')->cascadeOnDelete();
            $table->foreignId('patient_id')->nullable()->constrained('patients', 'id')->cascadeOnDelete();
            $table->text('diagnoses')->nullable();
            $table->text('evaluation')->nullable();
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
        Schema::dropIfExists('orthodontic_visits');
    }
}
