<?php
namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_authenticate_using_sanctum(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson('/sanctum/csrf-cookie');
        $response->assertNoContent();

        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertNoContent();
    }

    public function test_users_can_not_authenticate_with_invalid_password_using_sanctum(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson('/sanctum/csrf-cookie');
        $response->assertNoContent();

        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout_using_sanctum(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson('/sanctum/csrf-cookie');
        $response->assertNoContent();

        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->postJson('/logout');

        $this->assertGuest();
        $response->assertNoContent();
    }
}
