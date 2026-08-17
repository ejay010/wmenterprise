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
        Schema::create('rental_agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('drivers_license')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('pickup_location')->nullable();
            $table->date('pickup_date')->nullable();
            $table->time('pickup_time')->nullable();
            $table->string('return_location')->nullable();
            $table->date('return_date')->nullable();
            $table->time('return_time')->nullable();
            $table->decimal('price_per_day', 8, 2)->default(0);
            $table->decimal('deposit', 8, 2)->default(0);
            $table->decimal('total_due', 10, 2)->default(0);
            $table->string('payment_type')->nullable(); // Cash, Credit Card, Direct Deposit
            $table->boolean('agreed_to_terms')->default(false);
            $table->string('renter_name')->nullable();
            $table->longText('renter_signature')->nullable();
            $table->string('company_representative_name')->nullable();
            $table->longText('company_signature')->nullable();
            $table->date('signed_at')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_agreements');
    }
};
