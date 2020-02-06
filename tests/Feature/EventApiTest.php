<?php

namespace Tests\Feature;

use App\Category;
use App\Entity;
use App\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class EventApiTest extends TestCase
{
    use DatabaseMigrations;

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
            'link' => "my link",
            'description' => "This is a very great description",
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
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
            'link' => "my link",
            'description' => "This is a very great description",
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
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
            'link' => "my link",
            'description' => "This is a very great description",
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
            'latitude' => 3.5,
            'longitude' => 9.6,
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            'cover' => UploadedFile::fake()->image('cover.jpg')
        ];

        $response = $this->json('post', route('api.events.store'), $event);

        $response->assertStatus(201);

    }


    /** @test */
    public function it_should_return_user_events()
    {

        $this->withoutExceptionHandling();

        $event = factory(Event::class)->create();

        $this->signIn($event->user, 'api');


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

        $response->assertJsonCount(1, 'data')
            ->assertOk();

    }

}
