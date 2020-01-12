<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_should_log_a_registered_user_in()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $response = $this->post('/api/login', [
            "email" => $user->email,
            "password" => "12345678"
        ]);

//        dd($response);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_should_register_user()
    {
        $this->withoutExceptionHandling();

        $user = [
            'name' => 'Register Me',
            'username' => 'register',
            'email' => 'register@register.com',
            'password' => 'register@12345678',
            'password_confirmation' => 'register@12345678',
        ];
        $response = $this->post('/api/register', $user);

        $response->assertOk();
    }
}
