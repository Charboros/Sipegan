<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_access_user_management_page(): void
    {
        $petugas = User::factory()->create(['role' => 'petugas']);

        $response = $this->actingAs($petugas)->get('/users');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_user_management_page(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/users');

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.index');
    }

    public function test_admin_can_create_new_user(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/users', [
            'username' => 'newuser',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'petugas',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('users', ['username' => 'newuser', 'role' => 'petugas']);
    }

    public function test_password_confirmation_is_required_when_creating_user(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/users', [
            'username' => 'newuser2',
            'password' => 'password123',
            'password_confirmation' => 'wrongpassword',
            'role' => 'petugas',
        ]);

        $response->assertSessionHasErrors(['password']);
        $this->assertDatabaseMissing('users', ['username' => 'newuser2']);
    }

    public function test_admin_cannot_delete_their_own_account(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->delete("/users/{$admin->id}");

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }
}
