<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';


// Admin Portal Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/vehicles', \App\Livewire\Admin\VehicleList::class)->name('vehicles.index');
    Route::get('/vehicles/create', \App\Livewire\Admin\VehicleForm::class)->name('vehicles.create');
    Route::get('/vehicles/{vehicle}/edit', \App\Livewire\Admin\VehicleForm::class)->name('vehicles.edit');
    Route::get('/agreements', \App\Livewire\Admin\AgreementList::class)->name('agreements.index');
});

// Client Booking Flow Routes
Route::get('/catalog', \App\Livewire\Client\VehicleCatalog::class)->name('catalog');
Route::get('/vehicle/{vehicle}', \App\Livewire\Client\VehicleDetail::class)->name('vehicle.show');
Route::get('/checkout/{vehicle}', \App\Livewire\Client\Checkout::class)->name('checkout');

// PDF Download Route
Route::get('/agreements/{agreement}/pdf', function (\App\Models\RentalAgreement $agreement) {
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.rental-agreement', ['agreement' => $agreement]);
    return $pdf->stream('agreement-' . $agreement->id . '.pdf');
})->name('agreements.pdf');
