<?php

namespace App\Models;

use Database\Factories\VehicleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /** @use HasFactory<VehicleFactory> */
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
