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

    /**
     * Setup function.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
//        $this->user = factory(User::class)->create();
        $this->user = User::create([
            'name' => 'Test User',
            'username' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('test@12345678'),
            'role_id' => 1
        ]);
    }

    /** @test */
    public function it_should_log_a_registered_user_in()
    {
        $response = $this->post('/api/login', [
            "email" => "test@test.com",
            "password" => "test@12345678"
        ]);
        $response->assertStatus(200);
    }

    /** @test */
    public function it_should_register_user()
    {
        $user = [
            'name' => 'Register Me',
            'username' => 'register',
            'email' => 'register@register.com',
            'password' => 'register@12345678',
            'password_confirmation' => 'register@12345678',
            'role_id' => 1
        ];
        $response = $this->post('/api/register', $user);
//        dd($response);
        $response->assertStatus(201);
    }
}
