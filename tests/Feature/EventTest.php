<?php

namespace Tests\Feature;

use App\Entity;
use App\Event;
use Faker\Provider\DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    function it_should_return_stored_entities()
    {

//        $this->signIn();
        $event = factory(Event::class)->create();
        $respose = $this->get('/api/events/');
        $respose
            ->assertOk();

    }

    /** @test */
    function it_should_create_event_for_an_entity()
    {


        $this->withoutExceptionHandling();

        $this->signIn();
        $entity = factory(Entity::class)->create();
        $event = [
            'entity_id' => $entity->id,
            'event_picture' => "picture",
            'event_name' => "Event Name",
            'registration_link' => "my link",
            'description' => "This is a very great description",
            'application_start_datetime' => DateTime::dateTime(),
            'application_end_datetime' => DateTime::dateTime(),
            'latitude' => 3.5,
            'longitude' => 9.6
        ];
        $respose = $this->post('/api/events/store/', $event);
        $respose
            ->assertStatus(201);

    }

}
