<?php

namespace Tests\Apis;

use App\Entity;
use App\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserEventsTest extends TestCase
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
}
