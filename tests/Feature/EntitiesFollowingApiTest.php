<?php

namespace Tests\Feature;

use App\Entity;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EntitiesFollowingApiTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $entity;

    function setUp(): void
    {

        parent::setUp(); // TODO: Change the autogenerated stub

        $this->user = factory(User::class)->create();

        $this->entity = factory(Entity::class)->create();


    }

    /**
     @test
     */
    public function test_user_can_follow_an_entity()
    {

        $this->signIn($this->user, 'api');

        $response = $this->post(route('api.entitiesFollowing.store', [
            'entity' => $this->entity->id
        ]));

        $response
            ->assertOk()
            ->assertJsonFragment([
                "message" => "followed successfully"
            ]);

    }


    /**
    @test
     */
    public function test_unauthenticated_user_can_not_follow_an_entity()
    {

        $response = $this->post(route('api.entitiesFollowing.store', [
            'entity' => $this->entity->id
        ]));

        $response
            ->assertRedirect();

    }


    /**
    @test
     */
    public function test_user_can_un_follow_an_entity()
    {

        $this->signIn($this->user, 'api');

        $this->user->follow($this->entity);

        $response = $this->delete(route('api.entitiesFollowing.destroy', [
            'entity' => $this->entity->id
        ]));

        $response
            ->assertOk()
            ->assertJsonFragment([
                'message' => 'unfollowed successfully'
            ]);

    }
}