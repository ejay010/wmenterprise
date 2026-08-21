<?php

use App\Livewire\Admin\AgreementList;
use App\Livewire\Admin\VehicleForm;
use App\Livewire\Admin\VehicleList;
use App\Livewire\Client\Checkout;
use App\Livewire\Client\ThankYou;
use App\Livewire\Client\VehicleCatalog;
use App\Livewire\Client\VehicleDetail;
use App\Models\RentalAgreement;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

// Admin Portal Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/vehicles', VehicleList::class)->name('vehicles.index');
    Route::get('/vehicles/create', VehicleForm::class)->name('vehicles.create');
    Route::get('/vehicles/{vehicle}/edit', VehicleForm::class)->name('vehicles.edit');
    Route::get('/agreements', AgreementList::class)->name('agreements.index');
});

// Client Booking Flow Routes
Route::get('/catalog', VehicleCatalog::class)->name('catalog');
Route::get('/vehicle/{vehicle}', VehicleDetail::class)->name('vehicle.show');
Route::get('/checkout/{vehicle}', Checkout::class)->name('checkout');
Route::get('/booking/thank-you/{order}', ThankYou::class)->name('booking.thank-you');

// PDF Download Route
Route::get('/agreements/{agreement}/pdf', function (RentalAgreement $agreement) {
    $pdf = Pdf::loadView('pdf.rental-agreement', ['agreement' => $agreement]);

    return $pdf->stream('agreement-'.$agreement->id.'.pdf');
})->name('agreements.pdf');
