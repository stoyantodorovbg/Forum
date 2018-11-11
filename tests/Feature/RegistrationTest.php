<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_confirmation_email_is_sent_upon_registration()
    {
        Mail::fake();

        event(new Registered(create('App\User')));

        Mail::assertSent(ConfirmEmail::class);
    }

    /** @test */
    public function users_can_confirm_their_email_addresses()
    {
        $this->post('/register', [
            'name' => 'Gosho',
            'email' => 'test@email.com',
            'password' => 'foobar',
            'password_confirmation' => 'foobar'
        ]);

        $user = User::where('email', 'test@email.com')->first();

        $this->assertFalse($user->confired);

        $this->assertNotNull($user->confirmation_token);

        $response = $this->get('/register/confirm?token=' . $user->conirmation_token);

        $this->assertTrue($user->fresh()->confirmed);

        $this->assertRedirect('/threads');
    }
}