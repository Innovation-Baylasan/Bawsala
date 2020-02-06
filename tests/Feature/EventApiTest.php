<?php

namespace Tests\Feature;

use App\Entity;
use App\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\User;

class EventApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    function it_should_return_stored_entities()
    {

        $event = factory(Event::class)->create();

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
            'picture' => "picture",
            'name' => "Event Name",
            'link' => "my link",
            'description' => "This is a very great description",
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
            'latitude' => 3.5,
            'longitude' => 9.6
        ];

        $response = $this->json('post', route('api.events.store'), $event);

        $response->assertStatus(201);

    }

    /** @test */
    function it_should_create_event_for_a_registered_company_user()
    {


        $this->withoutExceptionHandling();

        $this->signInAsCompany(factory(User::class)->create(), 'api');

        $entity = factory(Entity::class)->create();

        $event = [
            'entity_id' => $entity->id,
            'event_picture' => "picture",
            'event_name' => "Event Name",
            'registration_link' => "my link",
            'description' => "This is a very great description",
            'application_start_datetime' => Carbon::now(),
            'application_end_datetime' => Carbon::now(),
            'latitude' => 3.5,
            'longitude' => 9.6
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
