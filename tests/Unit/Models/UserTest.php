<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example
     */

     public function test_has_many_repositories()
     {
        $user = new user;

        $this->assertInstanceOf(Collection::class, $user->repositories);
     }
}