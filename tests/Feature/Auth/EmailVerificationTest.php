<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_screen_can_be_rendered()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get('/verify-email');

        $response->assertStatus(200);
    }

    public function test_email_can_be_verified()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $code      = randomNumberCode(1, 9999, 4, 0);
        $expiredAt = now()->addMinutes(3);

        Cache::put("verificationCode_" . $user->id, ['code' => $code], $expiredAt);

        $response = $this->actingAs($user)
                         ->post(route('verification.verify'), ['verification_code' => $code]);

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(RouteServiceProvider::HOME.'?verified=1');
    }

    public function test_email_is_not_verified_with_invalid_hash()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)
                         ->post(route('verification.resend'));

        $response->assertSessionHas('status', '驗證碼已經重新發送！');

        $user = User::factory()->create([
            'email_verified_at' => Date::now(),
        ]);

        $response = $this->actingAs($user)
                         ->post(route('verification.resend'));

        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
