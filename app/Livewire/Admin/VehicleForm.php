<?php

namespace App\Livewire\Admin;

use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

/**
 * The VehicleForm component handles both creating a new vehicle and editing an existing one.
 */
class VehicleForm extends Component
{
    // Livewire requires this trait to handle file uploads securely.
    use WithFileUploads;

    // We store the vehicle model here if we are editing. If creating, it's null.
    public ?Vehicle $vehicle = null;

    // Form fields mapped to the database schema
    public $make;
    public $model;
    public $year;
    public $license_plate;
    public $daily_rate;
    public $status = 'available'; // Default status
    public $description;

    // Variables for handling image uploads
    public $new_images = []; // Temporary array to hold newly uploaded images
    public $existing_images = []; // Array to display already uploaded images
    public $featured_image_id = null; // Tracks which image is featured

    /**
     * The mount method is called once when the component is first loaded.
     * We use it to populate the form if we are editing an existing vehicle.
     */
    public function mount(Vehicle $vehicle = null)
    {
        if ($vehicle && $vehicle->exists) {
            $this->vehicle = $vehicle;
            
            // Populate our public properties with the database values
            $this->make = $vehicle->make;
            $this->model = $vehicle->model;
            $this->year = $vehicle->year;
            $this->license_plate = $vehicle->license_plate;
            $this->daily_rate = $vehicle->daily_rate;
            $this->status = $vehicle->status;
            $this->description = $vehicle->description;

            // Load existing images
            $this->existing_images = $vehicle->images()->get();
            
            // Find the featured image ID
            $featured = $this->existing_images->where('is_featured', true)->first();
            if ($featured) {
                $this->featured_image_id = $featured->id;
            }
        }
    }

    /**
     * Save the vehicle (handles both create and update operations).
     */
    public function save()
    {
        // 1. Validate the user input to ensure data integrity
        $this->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'required|string|max:255',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|in:available,maintenance',
            'description' => 'nullable|string',
            'new_images.*' => 'image|max:5120', // Ensure uploaded files are images (max 5MB)
        ]);

        // 2. Save the primary Vehicle record
        if ($this->vehicle && $this->vehicle->exists) {
            // Update existing vehicle
            $this->vehicle->update([
                'make' => $this->make,
                'model' => $this->model,
                'year' => $this->year,
                'license_plate' => $this->license_plate,
                'daily_rate' => $this->daily_rate,
                'status' => $this->status,
                'description' => $this->description,
            ]);
        } else {
            // Create a new vehicle
            $this->vehicle = Vehicle::create([
                'make' => $this->make,
                'model' => $this->model,
                'year' => $this->year,
                'license_plate' => $this->license_plate,
                'daily_rate' => $this->daily_rate,
                'status' => $this->status,
                'description' => $this->description,
            ]);
        }

        // 3. Process newly uploaded images
        foreach ($this->new_images as $photo) {
            // Store the file in the 'public/vehicles' storage disk
            $path = $photo->store('vehicles', 'public');
            
            // Create a database record linking the image to the vehicle
            $image = $this->vehicle->images()->create([
                'image_path' => $path,
                'is_featured' => false,
            ]);

            // If no featured image is set yet, make the first uploaded one featured by default
            if (!$this->featured_image_id) {
                $this->setFeaturedImage($image->id);
            }
        }

        // Clear the temporary upload array so it doesn't try to upload again on the next render
        $this->new_images = [];

        // 4. Provide feedback to the user and redirect back to the list
        $this->dispatch('toast', message: 'Vehicle saved successfully.', type: 'success');
        $this->redirectRoute('admin.vehicles.index', navigate: true);
    }

    /**
     * Mark an image as the featured image for the vehicle.
     * 
     * @param int $imageId
     */
    public function setFeaturedImage($imageId)
    {
        // First, ensure the vehicle actually has this image
        if ($this->vehicle && $this->vehicle->images()->where('id', $imageId)->exists()) {
            
            // Set all other images for this vehicle to false
            $this->vehicle->images()->update(['is_featured' => false]);
            
            // Set the selected image to true
            $this->vehicle->images()->where('id', $imageId)->update(['is_featured' => true]);
            
            // Update our component's state
            $this->featured_image_id = $imageId;
            $this->existing_images = $this->vehicle->images()->get(); // Refresh list
        }
    }

    /**
     * Delete an existing image from storage and database.
     * 
     * @param int $imageId
     */
    public function deleteImage($imageId)
    {
        $image = VehicleImage::find($imageId);
        
        if ($image && $image->vehicle_id === $this->vehicle->id) {
            // Delete the physical file from the disk
            Storage::disk('public')->delete($image->image_path);
            
            // Delete the database record
            $image->delete();

            // Refresh our component's state
            $this->existing_images = $this->vehicle->images()->get();
            
            // If we deleted the featured image, we reset our tracker
            if ($this->featured_image_id === $imageId) {
                $this->featured_image_id = null;
                // Optionally make the next available image featured automatically
                if ($this->existing_images->count() > 0) {
                    $this->setFeaturedImage($this->existing_images->first()->id);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.vehicle-form')->layout('layouts.app');
    }
}
