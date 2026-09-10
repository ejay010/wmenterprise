<?php

use App\Livewire\Client\ContactForm;
use App\Mail\AdminContactInquiryMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

test('contact page contains the contact form livewire component', function () {
    $this->get(route('contact'))
        ->assertOk()
        ->assertSeeLivewire(ContactForm::class);
});

test('contact form requires name, email, and message', function () {
    Livewire::test(ContactForm::class)
        ->set('name', '')
        ->set('email', '')
        ->set('message', '')
        ->call('submit')
        ->assertHasErrors(['name', 'email', 'message']);
});

test('contact form requires a valid email format', function () {
    Livewire::test(ContactForm::class)
        ->set('name', 'Jane Doe')
        ->set('email', 'not-an-email')
        ->set('message', 'Hello, this is a test inquiry message.')
        ->call('submit')
        ->assertHasErrors(['email']);
});

test('contact form sends an email to the administrator on successful submission', function () {
    Mail::fake();

    // Create an administrator user in the database
    $admin = User::factory()->create([
        'role' => 'admin',
        'email' => 'admin@wmenterprises.com',
    ]);

    Livewire::test(ContactForm::class)
        ->set('name', 'Alice Johnson')
        ->set('email', 'alice@example.com')
        ->set('phone', '242-555-1234')
        ->set('airport', 'Rock Sound International (RSD)')
        ->set('message', 'We are arriving on Friday and would like to confirm our reservation options.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('submitted', true)
        ->assertSee('Message Sent Successfully!');

    // Verify AdminContactInquiryMail was sent to the admin email address
    Mail::assertSent(AdminContactInquiryMail::class, function ($mail) use ($admin) {
        return $mail->hasTo($admin->email)
            && $mail->senderName === 'Alice Johnson'
            && $mail->senderEmail === 'alice@example.com'
            && $mail->senderPhone === '242-555-1234'
            && $mail->preferredAirport === 'Rock Sound International (RSD)'
            && str_contains($mail->inquiryMessage, 'arriving on Friday');
    });
});

test('contact form can be reset to send another message', function () {
    Mail::fake();

    Livewire::test(ContactForm::class)
        ->set('name', 'Alice Johnson')
        ->set('email', 'alice@example.com')
        ->set('message', 'First inquiry message that is long enough.')
        ->call('submit')
        ->assertSet('submitted', true)
        ->call('sendAnother')
        ->assertSet('submitted', false)
        ->assertDontSee('Message Sent Successfully!');
});
