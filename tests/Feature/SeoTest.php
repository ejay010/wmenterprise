<?php

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('sitemap.xml renders valid XML with public routes and available vehicles', function () {
    $vehicle = Vehicle::factory()->create(['status' => 'available']);

    $response = $this->get('/sitemap.xml');

    $response->assertOk()
        ->assertHeader('Content-Type', 'text/xml; charset=UTF-8')
        ->assertSee(route('home'))
        ->assertSee(route('catalog'))
        ->assertSee(route('about'))
        ->assertSee(route('contact'))
        ->assertSee(route('rental-policy'))
        ->assertSee(route('vehicle.show', $vehicle));
});

test('robots.txt disallows sensitive admin and checkout endpoints', function () {
    $content = file_get_contents(public_path('robots.txt'));

    expect($content)
        ->toContain('Disallow: /admin/')
        ->toContain('Disallow: /checkout/')
        ->toContain('Sitemap:');
});

test('home page includes SEO metadata, Open Graph, and AutoRental JSON-LD schema', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('<meta name="description"', false)
        ->assertSee('<link rel="canonical"', false)
        ->assertSee('<meta property="og:title"', false)
        ->assertSee('<meta property="og:site_name"', false)
        ->assertSee('"@type": "AutoRental"', false)
        ->assertSee('"name": "WM Car Rental"', false);
});

test('vehicle detail page includes Vehicle Schema.org JSON-LD structured data', function () {
    $vehicle = Vehicle::factory()->create(['status' => 'available']);

    $this->get(route('vehicle.show', $vehicle))
        ->assertOk()
        ->assertSee('"@type"', false)
        ->assertSee('Vehicle')
        ->assertSee('Product')
        ->assertSee($vehicle->make.' '.$vehicle->model)
        ->assertSee((string) $vehicle->daily_rate);
});

test('site.webmanifest reflects WM Car Rental branding', function () {
    $manifest = json_decode(file_get_contents(public_path('site.webmanifest')), true);

    expect($manifest['name'])->toBe('WM Car Rental')
        ->and($manifest['short_name'])->toBe('WM Rental');
});

test('legacy layout-test route redirects to home', function () {
    $this->get('/layout-test')
        ->assertRedirect('/');
});
