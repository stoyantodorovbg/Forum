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

        $this->post(route('register'), [
            'name' => 'Gosho',
            'email' => 'test@email.com',
            'password' => 'foobar',
            'password_confirmation' => 'foobar'
        ]);

        event(new Registered(create('App\User')));

        Mail::assertQueued(ConfirmEmail::class);
    }

    /** @test */
    public function users_can_confirm_their_email_addresses()
    {
        Mail::fake();

        $this->post(route('register'), [
            'name' => 'Gosho',
            'email' => 'test@email.com',
            'password' => 'foobar',
            'password_confirmation' => 'foobar'
        ]);

        $user = User::where('email', 'test@email.com')->first();

        $this->assertFalse($user->confirmed);

        $this->assertNotNull($user->confirmation_token);

        $this->get(route('register.confirm',
            [ 'token' => $user->confirmation_token ]
        ))->assertRedirect('/threads');

        $this->assertTrue($user->fresh()->confirmed);
    }

    /** @test */
    public function confirming_anInvalid_token()
    {
        $this->get(route('register.confirm',
            [ 'token' => 'invalid' ]
        ))->assertRedirect('/threads')
            ->assertSessionHas('flash', 'Unknown token.');
    }
}