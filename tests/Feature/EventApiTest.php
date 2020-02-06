<?php

namespace Tests\Feature;

use App\Category;
use App\Entity;
use App\Event;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class EventApiTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $events;

    public function setUp(): void {

        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->events = factory(Event::class, 2)->create([
            'creator_id' => $this->user->id
        ]);

    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    function it_should_return_stored_events()
    {

        $response = $this->get(route('api.events.index'));

        $response
            ->assertJsonCount(Event::count(), 'data')
            ->assertOk();

    }

    /** @test */
    function it_should_create_event_for_a_registered_user()
    {


        $this->withoutExceptionHandling();

        $this->signIn(factory(User::class)->create(), 'api');

        $entity = factory(Entity::class)->create();

        $event = [
            'entity_id' => $entity->id,
            'name' => "Event Name",
            'registration_link' => "my link",
            'description' => "This is a very great description",
            'start_datetime' => Carbon::now(),
            'end_datetime' => Carbon::now(),
            'latitude' => 3.5,
            'longitude' => 9.6
        ];

        $response = $this->json('post', route('api.events.store'), $event);

        $response
            ->assertStatus(201);
    }


    /** @test */
    function it_should_create_event_for_a_registered_user_with_cover()
    {


        $this->withoutExceptionHandling();

        $this->signIn(factory(User::class)->create(), 'api');

        $entity = factory(Entity::class)->create();

        $event = [
            'entity_id' => $entity->id,
            'name' => "Event Name",
            'registration_link' => "my link",
            'description' => "This is a very great description",
            'start_datetime' => Carbon::now(),
            'end_datetime' => Carbon::now(),
            'latitude' => 3.5,
            'longitude' => 9.6,
            'cover' => UploadedFile::fake()->image('cover.jpg')
        ];

        $response = $this->json('post', route('api.events.store'), $event);

        $response
            ->assertJsonFragment([
                "cover" => "/storage/1/conversions/cover-cover.jpg"
            ])
            ->assertStatus(201);

    }

    /** @test */
    function it_should_create_event_for_a_registered_company_user()
    {


        $this->withoutExceptionHandling();

        $this->signInAsCompany(factory(User::class)->create(), 'api');

        $entity = factory(Entity::class)->create();

        $event = [
            'entity_id' => $entity->id,
            'name' => "Event Name",
            'registration_link' => "my link",
            'description' => "This is a very great description",
            'start_datetime' => Carbon::now(),
            'end_datetime' => Carbon::now(),
            'latitude' => 3.5,
            'longitude' => 9.6,
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            'cover' => UploadedFile::fake()->image('cover.jpg')
        ];

        $response = $this->json('post', route('api.events.store'), $event);

        $response->assertStatus(201);

    }


    /** @test */
    public function it_should_return_user_entities () {

        $this->withoutExceptionHandling();

        $this->signIn($this->user, 'api');

        $response = $this->get(route('api.events.myEvents'));

        $response
            ->assertJsonCount(2, 'data')
            ->assertOk();

    }


    /** @test */
    public function it_should_return_company_entities () {

        $this->withoutExceptionHandling();

        $this->signInAsCompany($this->user, 'api');

        $response = $this->get(route('api.events.myEvents'));

        $response
            ->assertJsonCount(2, 'data')
            ->assertOk();

    }

}
