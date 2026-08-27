<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Regular customer
        User::factory()->create([
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
            'role' => 'registered',
        ]);

        // Sample Vehicles
        \App\Models\Vehicle::create([
            'make' => 'Toyota',
            'model' => 'Camry',
            'year' => '2023',
            'max_passengers' => 5,
            'license_plate' => 'ABC-1234',
            'daily_rate' => 45.00,
            'status' => 'available',
            'description' => 'A reliable and comfortable sedan.',
            'class' => 'Sedan',
            'gearbox' => 'Automatic',
        ]);

        \App\Models\Vehicle::create([
            'make' => 'Honda',
            'model' => 'CR-V',
            'year' => '2024',
            'max_passengers' => 5,
            'license_plate' => 'XYZ-9876',
            'daily_rate' => 60.00,
            'status' => 'available',
            'description' => 'Spacious SUV perfect for families.',
            'class' => 'SUV',
            'gearbox' => 'Automatic',
        ]);
        
        \App\Models\Vehicle::create([
            'make' => 'Ford',
            'model' => 'Mustang',
            'year' => '2022',
            'max_passengers' => 4,
            'license_plate' => 'FAST-01',
            'daily_rate' => 85.00,
            'status' => 'available',
            'description' => 'Sporty convertible for a fun weekend.',
            'class' => 'Sports',
            'gearbox' => 'Manual',
        ]);
    }
}
