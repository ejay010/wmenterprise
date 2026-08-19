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
        //
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('year')->nullable();
            $table->string('color')->nullable();
            $table->string('license_plate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('year');
            $table->dropColumn('color');
            $table->dropColumn('license_plate');
        });
    }
};
