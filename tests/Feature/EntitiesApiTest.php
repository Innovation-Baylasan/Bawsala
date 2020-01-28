<?php

namespace Tests\Feature;

use App\Entity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;


class EntitiesApiTest extends TestCase
{

    use RefreshDatabase;

    private $user;
    private $entities;

    public function setUp(): void {

        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->entities = factory(Entity::class, 2)->create([
            'user_id' => $this->user->id
        ]);

        factory(Entity::class, 2)->create();

    }

    /** @test */
    public function it_passes_test()
    {

        $response = $this->get('/');

        $response->assertStatus(200);

    }

    /** @test */
    public function it_should_return_all_entities () {

        $this->withoutExceptionHandling();

        $response = $this->get(route('api.entities.index'));

        $response
            ->assertOk();

    }

    /** @test */
    public function it_should_filter_entities () {

        $response = $this->get(route('api.entities.index', [
            'q' => $this->entities[0]->name
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => $this->entities[0]->name
            ]);

    }

    /** @test */
    public function it_should_get_entity_nearby_entities () {

        $response = $this->get(route('api.entities.index', [
            '@lat' => $this->entities[0]->latitude,
            '@long' => $this->entities[0]->longitude,
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => $this->entities[0]->name
            ]);

    }


    /** @test */
    public function it_should_show_entity_by_passing_id () {

        $response = $this->get(route('api.entities.show', [
            'entity' => $this->entities[0]->id
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => $this->entities[0]->name
            ]);

    }


    /** @test */
    public function it_should_return_user_entities () {

        $this->withoutExceptionHandling();

        $this->signIn($this->user, 'api');

        $response = $this->get(route('api.entities.myEntities'));

        $response
            ->assertJsonCount(2, 'data')
            ->assertOk();

    }

}
