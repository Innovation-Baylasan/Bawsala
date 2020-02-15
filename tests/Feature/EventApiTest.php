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

        factory(Event::class, 5)->create();

        $response = $this->get(route('api.events.index'));

        $response
            ->assertJsonCount(Event::count(), 'data')
            ->assertOk();

    }

    /** @test */
    function it_should_create_event_for_a_registered_user()
    {


        $this->withoutExceptionHandling();

        $event = [
            'entity_id' => factory(Entity::class)->create()->id,
            'name' => "Event Name",
            'link' => "my link",
            'description' => "This is a very great description",
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
            'latitude' => 3.5,
            'longitude' => 9.6
        ];

        $this->signIn(factory(User::class)->create(), 'api');

        $response = $this->json('post', route('api.events.store'), $event);

        $response
            ->assertStatus(201);
    }


    /** @test */
    function it_should_create_event_for_a_registered_user_with_cover()
    {


        $this->withoutExceptionHandling();

        $this->signIn(($user = factory(User::class)->create()), 'api');

        $entity = factory(Entity::class)->create([
            'user_id' => $user->id
        ]);

        $event = [
            'entity_id' => $entity->id,
            'name' => "Event Name",
            'link' => "https://myevent_website.com",
            'description' => "This is a very great description",
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
            'latitude' => 3.5,
            'longitude' => 9.6,
            'cover' => UploadedFile::fake()->image('cover.jpg')
        ];

        $response = $this->post(route('api.events.store'), $event);

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
            'cover' => UploadedFile::fake()->image('cover.jpg')
        ];

        $response = $this->json('post', route('api.events.store'), $event);

        $response->assertStatus(201);

    }


    /** @test */
    public function it_should_delete_events_created_by_the_authenticated_user()
    {

        // Given a user with 2 events
        $event = factory(Event::class)->create();

        factory(Event::class)->create([
            'creator_id' => $event->user->id
        ]);

        // when this user logs in and call myEvents end point
        $this->signIn($event->user, 'api');

        $response = $this->delete(route('api.events.destroy',[
            'event' => $event->id
        ]));

        // then the response only contains those 2 events he has created
        $response
            ->assertOk();

    }

    /** @test */
    public function it_should_deny_delete_events_not_created_by_original_user()
    {

        // Given a user with 2 events
        $event = factory(Event::class)->create();

        factory(Event::class)->create([
            'creator_id' => ($forignUser = factory(User::class)->create())->id
        ]);

        // when this user logs in and call myEvents end point
        $this->signIn($forignUser, 'api');

        $response = $this->delete(route('api.events.destroy',[
            'event' => $event->id
        ]));

        // then the response only contains those 2 events he has created
        $response
            ->assertStatus(403);

    }

}
