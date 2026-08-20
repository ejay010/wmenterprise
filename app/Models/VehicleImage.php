<?php

namespace App\Models;

use Database\Factories\VehicleImageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class VehicleImage extends Model
{
    /** @use HasFactory<VehicleImageFactory> */
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'image_path',
        'is_featured',
    ];

    /**
     * Get the resolved public URL for the image (works for both local public storage & AWS S3).
     */
    public function getUrlAttribute(): string
    {
        return Storage::url($this->image_path);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
