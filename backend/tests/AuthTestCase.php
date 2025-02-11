<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class AuthTestCase extends BaseTestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loginAndGetCsrfToken();
    }
    protected function loginAndGetCsrfToken(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson('/sanctum/csrf-cookie');
        $response->assertNoContent();
        $this->actingAs($user);

        $this->user = $user;
    }
}
