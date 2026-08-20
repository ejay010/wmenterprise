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
        if (! $this->image_path) {
            return 'https://placehold.co/600x400?text=No+Image';
        }

        // If the path is already a complete URL (e.g., placeholder or external asset)
        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        $disk = config('filesystems.default') === 's3' ? 's3' : 'public';

        // If S3 bucket uses private access policy, generate presigned temporary URL
        if ($disk === 's3' && (env('AWS_USE_TEMPORARY_URLS', false) || config('filesystems.disks.s3.visibility') === 'private')) {
            try {
                return Storage::disk('s3')->temporaryUrl($this->image_path, now()->addHours(24));
            } catch (\Throwable $e) {
                // Fall back to standard S3 URL if temporaryUrl fails
            }
        }

        return Storage::disk($disk)->url($this->image_path);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
