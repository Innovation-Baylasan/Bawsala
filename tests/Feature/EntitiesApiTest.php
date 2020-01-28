<?php

namespace Tests\Feature;

use App\Category;
use App\Entity;
use Carbon\Carbon;
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
    function it_should_allow_authenticated_user_to_create_entity()
    {

        $this->withoutExceptionHandling();

        $this->signIn(factory(User::class)->create(), 'api');

        $entity = [
            'category_id' => factory(Category::class)->create()->id,
            'name' => "My Entity",
            'cover' => "https://placeimg.com/640/360/tech",
            'avatar' => "https://www.gravatar.com/avatar/?s=200",
            'description' => "This is a very great description",
            'latitude' => 3.5,
            'longitude' => 9.6
        ];

        $response = $this->json('post', route('api.entities.store'), $entity);

        $response
            ->assertJsonFragment($entity)
            ->assertJsonFragment([
                'message' => 'Entity created successfully'
            ])
            ->assertStatus(201);

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
