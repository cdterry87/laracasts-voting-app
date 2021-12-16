<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;
    
    /** @test */
    public function can_check_if_user_is_admin()
    {
        $user = User::factory()->make([
            'name' => 'Chase',
            'email' => 'chase.terry87@gmail.com'
        ]);

        $userB = User::factory()->make([
            'name' => 'Chase',
            'email' => 'chase@example.com'
        ]);


        $this->assertTrue($user->isAdmin());
        $this->assertFalse($userB->isAdmin());
    }
}
