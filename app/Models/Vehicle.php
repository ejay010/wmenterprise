<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleFactory> */
    use HasFactory;

    protected $fillable = [
        'class',
        'gearbox',
        'year',
        'color',
        'license_plate',
        'make',
        'model',
        'max_passengers',
        'fuel_type',
        'daily_rate',
        'status',
        'description',
    ];

    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }

    public function featuredImage()
    {
        return $this->hasOne(VehicleImage::class)->where('is_featured', true);
    }
}
