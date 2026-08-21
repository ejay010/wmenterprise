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
        Schema::table('users', function (Blueprint $table) {
            $table->string('drivers_license_image')->nullable()->after('remember_token');
        });

        Schema::table('rental_agreements', function (Blueprint $table) {
            $table->string('drivers_license_image')->nullable()->after('drivers_license');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('drivers_license_image');
        });

        Schema::table('rental_agreements', function (Blueprint $table) {
            $table->dropColumn('drivers_license_image');
        });
    }
};
