<?php

namespace Tests\Feature;

use App\Entity;
use App\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserEventsApiTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function it_should_return_user_events()
    {

        // Given a user with 2 events
        $event = factory(Event::class)->create();

        factory(Event::class)->create([
            'creator_id' => $event->user->id
        ]);

        // when this user logs in and call myEvents end point
        $this->signIn($event->user, 'api');

        $response = $this->get(route('api.userEventsController.myEvents'));

        // then the response only contains those 2 events he has created
        $response
            ->assertJsonCount(2, 'data')
            ->assertOk();

    }


    /** @test */
    public function it_should_return_company_events()
    {

        $this->withoutExceptionHandling();

        $user = $this->createCompanyUser();

        $this->signIn($user, 'api');

        $event = [
            'entity_id' => factory(Entity::class)->create(),
            'name' => "Event Name",
            'link' => "my link",
            'description' => "http://google.com",
            'start_date' => Carbon::now()->subMonth(),
            'end_date' => Carbon::now(),
            'latitude' => 3.5,
            'longitude' => 9.6
        ];

        $this->post(route('api.events.store'), $event);

        $response = $this->get(route('api.userEventsController.myEvents'));

        $response->assertJsonCount(1, 'data')
            ->assertOk();

    }

}
