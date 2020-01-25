<?php

namespace Tests\Feature;

use App\Entity;
use App\User;
use http\Exception\InvalidArgumentException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SebastianBergmann\Diff\InvalidArgumentExceptionTest;
use Tests\TestCase;

class EntitiesRatingApiTest extends TestCase
{

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
    public function test_user_can_rate_entity()
    {

        $this->signIn($this->user, 'api');

        $response = $this->put(route('api.entitiesRating.update', [
            'entity' => $this->entity->id
        ]), [
            'rating' => 4
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'rated successfully'
            ]);

    }

    /**
    @test
     */
    public function test_rating_entity_must_be_between_1_5()
    {

        $this->signIn($this->user, 'api');

        $response = $this->put(route('api.entitiesRating.update', [
            'entity' => $this->entity->id
        ]), [
            'rating' => 6
        ]);

        $response
            ->assertStatus(500);

    }


    /**
    @test
     */
    public function test_user_can_not_rate_entity_if_not_authenticated()
    {

        $response = $this->put(route('api.entitiesRating.update', [
            'entity' => $this->entity->id
        ]), [
            'rating' => 4
        ]);

        $response
            ->assertStatus(302);

    }


}
