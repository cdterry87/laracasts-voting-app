<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GravatarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_generate_gravatar_default_image_when_no_email_found_a()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'afakeemail@fakeemail.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://www.gravatar.com/avatar/' . md5($user->email) . '?s=200&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-1.png',
            $gravatarUrl
        );

        // Assert that the gravatar url is a valid url
        $response = Http::get($gravatarUrl);
        $this->assertTrue($response->successful());
    }

    /** @test */
    public function user_can_generate_gravatar_default_image_when_no_email_found_z()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'zfakeemail@fakeemail.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://www.gravatar.com/avatar/' . md5($user->email) . '?s=200&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-26.png',
            $gravatarUrl
        );

        // Assert that the gravatar url is a valid url
        $response = Http::get($gravatarUrl);
        $this->assertTrue($response->successful());
    }

    /** @test */
    public function user_can_generate_gravatar_default_image_when_no_email_found_0()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => '0fakeemail@fakeemail.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://www.gravatar.com/avatar/' . md5($user->email) . '?s=200&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-27.png',
            $gravatarUrl
        );

        // Assert that the gravatar url is a valid url
        $response = Http::get($gravatarUrl);
        $this->assertTrue($response->successful());
    }

    /** @test */
    public function user_can_generate_gravatar_default_image_when_no_email_found_9()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => '9fakeemail@fakeemail.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://www.gravatar.com/avatar/' . md5($user->email) . '?s=200&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-36.png',
            $gravatarUrl
        );

        // Assert that the gravatar url is a valid url
        $response = Http::get($gravatarUrl);
        $this->assertTrue($response->successful());
    }
}
