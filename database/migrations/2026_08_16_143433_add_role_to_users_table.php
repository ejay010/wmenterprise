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
            $table->string('role')->default('registered')->after('email');
            $table->string('phone')->nullable()->after('role');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->string('drivers_license')->nullable()->after('date_of_birth');
            $table->string('address')->nullable()->after('drivers_license');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'date_of_birth', 'drivers_license', 'address']);
        });
    }
};
