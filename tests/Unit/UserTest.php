<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    // an alternative way to name the test is 'has_projects' since we are already dealing with the user class
    public function test_a_user_has_projects(): void
    {
        // given that we have a user
        $user = User::factory()->create();

        // we expect to have an instance of an eloquent HasMany relationship
        $this->assertInstanceOf(Collection::class, $user->projects );
    }
}
