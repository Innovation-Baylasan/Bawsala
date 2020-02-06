<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EntitiesReviewApiTest extends TestCase
{

    use DatabaseMigrations;


    /**
     @test
     */
    public function test_user_can_review_an_entity()
    {

        $this->signIn($user = factory('App\User')->create(), 'api');

        $entity = factory('App\Entity')->create();

        $response = $this->post(route('api.entitiesReviews.store', [
            'entity' => $entity->id
        ]), [
            'review' => "This is a very nice entity"
        ]);

        $response->assertStatus(200)->assertJsonFragment([
            "writer" => $user->name,
            "review" => "This is a very nice entity",
            "entity_id" => $entity->id
        ]);

    }

}
