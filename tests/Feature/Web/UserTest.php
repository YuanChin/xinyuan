<?php

namespace Tests\Feature\Web;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_screen_can_be_rendered()
    {
        $user = User::factory()->create([
            'email_verified_at' => Date::now(),
        ]);

        $response = $this->get(route('users.show', $user->id));
        
        $response->assertStatus(200);
    }

    public function test_edit_screen_can_be_rendered()
    {
        $user = User::factory()->create([
            'email_verified_at' => Date::now(),
        ]);

        $response = $this->actingAs($user)
            ->get(route('users.edit', $user->id));
        
        $response->assertStatus(200);
    }

    public function test_the_user_can_update_the_information()
    {
        $user = User::factory()->create([
            'email_verified_at' => Date::now(),
        ]);

        $file = UploadedFile::fake()->image('test.jpg');

        $response = $this->actingAs($user)->put(route('users.update', $user), [
            'name' => 'Test_User',
            'email' => 'test@example.com',
            'description' => 'I am a test user.',
            'avarar' => $file
        ]);

        $response->assertRedirect(route('users.show', $user->id));
    }
}
