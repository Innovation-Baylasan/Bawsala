<?php

namespace Tests\Feature;

use App\Entity;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CompanyManagingTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @test
     *
     */
    public function its_create_entity_when_company_user_register()
    {

        $this->withoutExceptionHandling();

        $attributes = [
            'name' => 'amaze center',
            'email' => 'amaze-center@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'register_as' => 'company',
            'description' => 'hi there am description',
            'location' => '12.356566,12.356566',
            'category' => 1,
            'username' => 'amaze_center'
        ];

        $response = $this->json('POST', route('api.register.store'), $attributes)
            ->assertOk();


        $entity = Entity::where('name', 'amaze center')->first();

        $this->assertDatabaseHas('entities', [
            'description' => $entity->description,
            'name' => $entity->name,
        ]);

        $this->assertDatabaseHas('users', ['email' => 'amaze-center@gmail.com']);

    }

    /**
     * @test
     */
    public function only_companies_can_create_entities()
    {

        $this->signIn();

        $this->post('/entities', factory(Entity::class)->raw())
            ->assertForbidden();

        Auth::logout();

        $attributes = [
            'name' => 'amaze center',
            'email' => 'amaze-center@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'registerAs' => 'company',
            'description' => 'hi there am description',
            'location' => '12.356566,12.356566',
            'category' => 1,
            'username' => 'amaze_center'
        ];

        $this->post('/entities', factory(Entity::class)->raw())
            ->assertRedirect();

    }
}
