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
            'username' => 'register',
            'email' => 'register@register.com',
            'password' => 'register@12345678',
            'password_confirmation' => 'register@12345678',
        ];
        $response = $this->post(route('api.register.store'), $user);

        $response->assertOk();
    }


    /** @test */
    public function it_should_register_company_user_with_cover_and_avatar()
    {

        $company = [
            'name' => 'User With Image',
            'username' => 'userwithimage',
            'email' => 'userwithimage@register.com',
            'register_as' => 'company',
            'category' => factory(Category::class)->create()->id,
            'location' => '12.23778823,23.2312312',
            'description' => 'This is a company',
            'password' => 'register@12345678',
            'password_confirmation' => 'register@12345678',
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            'cover' => UploadedFile::fake()->image('cover.jpg')
        ];

        $response = $this->post(route('api.register.store'), $company);

        $response
            ->assertJsonFragment([
                "cover" => "/storage/2/conversions/cover-cover.jpg",
                 "avatar" => "/storage/1/conversions/avatar-avatar.jpg"
            ])
            ->assertOk();
    }

    /** @test */
    public function it_should_login_company_user_and_return_response_with_cover_and_avatar()
    {

        $user = [
            'name' => 'User With Image',
            'username' => 'userwithimage',
            'email' => 'userwithimage@register.com',
            'register_as' => 'company',
            'category' => factory(Category::class)->create()->id,
            'location' => '12.23778823,23.2312312',
            'description' => 'This is a company',
            'password' => 'register@12345678',
            'password_confirmation' => 'register@12345678',
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            'cover' => UploadedFile::fake()->image('cover.jpg')
        ];

        $response = $this->post(route('api.register.store'), $user);

        $company = $response->decodeResponseJson();

        $response = $this->post(route('api.login.store'), [
            "email" => $user['email'],
            "password" => $user['password']
        ]);

        $response
            ->assertOk()
            ->assertJsonFragment($company['data']['main_entity']);

    }
}
