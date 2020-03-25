<?php

namespace Tests\Feature;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_should_log_a_registered_user_in()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $response = $this->post(route('api.login.store'), [
            "email" => $user->email,
            "password" => "12345678"
        ]);

        $response->assertStatus(200)->assertJsonFragment([
            'token' => $user->api_token
        ]);
    }

    /** @test */
    public function it_should_register_user()
    {
        $this->withoutExceptionHandling();

        $user = [
            'name' => 'Register Me',
            'email' => 'register@register.com',
            'password' => 'register@12345678',
            'password_confirmation' => 'register@12345678',
        ];
        $response = $this->post(route('api.register.store'), $user);

        $response->assertOk();
    }

}
