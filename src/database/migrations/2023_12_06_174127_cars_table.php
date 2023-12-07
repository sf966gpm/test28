<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id');
            $table->tinyInteger('vehicle_year')->nullable();
            $table->integer('mileage')->nullable();
            $table->string('color', 7)->nullable();
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('car_model_id')
                ->references('id')->on('car_models')->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
