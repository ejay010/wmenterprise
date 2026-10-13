<?php

test('about page renders successfully', function () {
    $this->get(route('about'))
        ->assertOk()
        ->assertSee('About WM Car Rental')
        ->assertSee('Rock Sound');
});

test('contact page renders successfully', function () {
    $this->get(route('contact'))
        ->assertOk()
        ->assertSee('Get in Touch')
        ->assertSee('(242) 376-1454');
});

test('rental policy page renders successfully', function () {
    $this->get(route('rental-policy'))
        ->assertOk()
        ->assertSee('Rental Policy')
        ->assertSee('$20.00 per quarter tank')
        ->assertSee('$250.00');
});
