<?php

namespace Tests\Feature;

use App\Entity;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class EntityRatingTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    function it_can_be_rated_by_logged_in_user()
    {
        $this->signIn();


        $entity = factory(Entity::class)->create();
        $response = $this->post('/entities/' . $entity->id . '/rate', [
            "rating" => 3
        ]);

        $response->assertStatus(200);
    }
}
