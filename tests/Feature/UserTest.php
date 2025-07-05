<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = \App\Models\User::where('email', 'noob1@gmail.com')->firstOrFail();

        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        print_r(auth()->user()->toArray()); // user now logged in in auth

        
    }
}
