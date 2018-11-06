<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class AddAvatarTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function only_members_can_add_avatars()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->json('POST', 'api/users/1/avatar');
            //->assertStatus(401);
    }

    /** @test */
    public function a_valid_avatar_must_be_provided()
    {
        $this->signIn();

        $this->expectException('Illuminate\Validation\ValidationException');

        $this->json('POST', 'api/users/'. auth()->id() .'/avatar', [
            'avatar' => 'not_valid_image'
        ]);
    }

    /** @test */
    public function a_user_may_add_an_avatar_to_their_profile()
    {
        $this->signIn();

        $file = UploadedFile::fake()->image('avatar.jpg');

        Storage::fake('public');

        $this->json('POST', 'api/users/'. auth()->id() .'/avatar', [
            'avatar_path' => $file
        ]);

        $this->assertEquals('avatars/' . $file->hashName(), auth()->user()->avatar_path);

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());
    }
}