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

    /**
     * Setup function.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->entity = factory(Entity::class)->create();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    function it_can_be_rated_by_logged_in_user()
    {
        $response = $this->post('/entities/' . $this->entity->id . '/rating', [
            "rating" => 3
        ]);
        $response->assertStatus(200);
    }
}
