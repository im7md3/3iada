<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrthodonticPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orthodontic_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orthodontic_id')->nullable()->constrained('orthodontics', 'id')->cascadeOnDelete();
            $table->foreignId('prescription_id')->nullable()->constrained('prescriptions', 'id')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('strength')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('orthodontic_prescriptions');
    }
}
