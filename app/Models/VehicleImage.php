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
     * Get the resolved public URL for the image.
     */
    public function getUrlAttribute(): string
    {
        if (! $this->image_path) {
            return 'https://placehold.co/600x400?text=No+Image';
        }

        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        $disk = config('filesystems.default') === 's3' ? 's3' : 'public';

        return Storage::disk($disk)->url($this->image_path);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
