<?php

namespace Tests\Feature;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_users_can_access_faq_management_page(): void
    {
        $petugas = User::factory()->create(['role' => 'petugas']);

        $response = $this->actingAs($petugas)->get('/faqs');

        $response->assertStatus(200);
        $response->assertViewIs('admin.faqs.index');
    }

    public function test_unauthenticated_users_cannot_access_faq_management_page(): void
    {
        $response = $this->get('/faqs');

        $response->assertRedirect('/login');
    }

    public function test_auth_users_can_create_faq(): void
    {
        $petugas = User::factory()->create(['role' => 'petugas']);

        $response = $this->actingAs($petugas)->post('/faqs', [
            'question' => 'What is this?',
            'answer' => 'This is an FAQ.',
            'is_active' => true,
        ]);

        $response->assertRedirect('/faqs');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('faqs', ['question' => 'What is this?', 'is_active' => 1]);
    }

    public function test_public_faq_page_displays_active_faqs(): void
    {
        Faq::create(['question' => 'Active FAQ', 'answer' => 'A1', 'is_active' => true]);
        Faq::create(['question' => 'Inactive FAQ', 'answer' => 'A2', 'is_active' => false]);

        $response = $this->get('/faq');

        $response->assertStatus(200);
        $response->assertSee('Active FAQ');
        $response->assertDontSee('Inactive FAQ');
    }
}
