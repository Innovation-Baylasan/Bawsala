<?php

namespace Tests\APIs;

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

class EventsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    function users_can_get_events()
    {

        factory(Event::class, 5)->create();

        $response = $this->get(route('api.events.index'));

        $response
            ->assertJsonCount(Event::count(), 'data')
            ->assertOk();

    }

    /** @test */
    function users_can_create_event()
    {


        $this->withoutExceptionHandling();

        $this->signIn(($user = factory(User::class)->create()), 'api');

        $entity = factory(Entity::class)->create([
            'user_id' => $user->id
        ]);

        $event = [
            'entity_id' => $entity->id,
            'name' => "Event Name",
            'link' => "https://website.com",
            'description' => "This is a very great description",
            'start_date' => Carbon::now()->subMonth(),
            'end_date' => Carbon::now(),
            'latitude' => 3.5,
            'longitude' => 9.6,
            'cover' => UploadedFile::fake()->image('cover.jpg')
        ];

        $response = $this->post(route('api.events.store'), $event);

        $response
            ->assertJsonFragment([
                "picture" => "/storage/1/conversions/cover-cover.jpg"
            ])
            ->assertStatus(201);

    }


    /** @test */
    public function users_can_delete_their_own_events()
    {

        // Given a user with 2 events
        $event = factory(Event::class)->create();

        factory(Event::class)->create([
            'creator_id' => $event->user->id
        ]);

        // when this user logs in and call myEvents end point
        $this->signIn($event->user, 'api');

        $response = $this->delete(route('api.events.destroy', [
            'event' => $event->id
        ]));

        // then the response only contains those 2 events he has created
        $response
            ->assertOk();

    }

    /** @test */
    public function users_cannot_delete_others_events()
    {

        // Given a user with 2 events
        $event = factory(Event::class)->create();

        factory(Event::class)->create([
            'creator_id' => ($forignUser = factory(User::class)->create())->id
        ]);

        // when this user logs in and call myEvents end point
        $this->signIn($forignUser, 'api');

        $response = $this->delete(route('api.events.destroy', [
            'event' => $event->id
        ]));

        // then the response only contains those 2 events he has created
        $response
            ->assertStatus(403);

    }

}
