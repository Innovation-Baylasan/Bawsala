<?php

namespace Tests\Feature;

use App\Entity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;


class EntityRatingTest extends TestCase
{

    use RefreshDatabase;

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
