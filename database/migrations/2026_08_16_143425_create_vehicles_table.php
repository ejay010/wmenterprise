<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('class')->nullable();
            $table->string('gearbox')->nullable();
            $table->string('make');
            $table->string('model');
            $table->integer('max_passengers')->nullable();
            $table->string('fuel_type')->default('Gas');
            $table->decimal('daily_rate', 8, 2)->default(0);
            $table->string('status')->default('available');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
