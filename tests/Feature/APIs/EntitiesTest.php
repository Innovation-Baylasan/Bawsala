<?php

namespace Tests\APIs;

use App\Category;
use App\Entity;
use App\Tag;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\User;


class EntitiesTest extends TestCase
{

    use DatabaseMigrations;


    /** @test */
    public function users_can_filter_entities_by_its_name()
    {
        $this->withoutExceptionHandling();

        $entity = factory(Entity::class)->create();

        factory(Entity::class)->create();

        $this->get(route('api.entities.index', ['q' => $entity->name,]))
            ->assertOk()
            ->assertJsonFragment(['name' => $entity->name]);

    }


    /** @test */
    public function it_should_show_specific_entity_reviews_not_more_than_4()
    {

        $this->signIn(factory(User::class)->create(), 'api');

        $entity = factory(Entity::class)->create();

        $entity->review('fa');
        $entity->review('fa');
        $entity->review('fa');
        $entity->review('fa');
        $entity->review('fa');

        $this->withoutExceptionHandling();
        $this->get(route('api.entities.show', $entity))
            ->assertOk()
            ->assertJsonCount(4, 'data.reviews');
    }

    /** @test */
    public function it_should_show_specific_entity_total_reviews_count()
    {

        $this->signIn($user = factory(User::class)->create(), 'api');

        $entity = factory(Entity::class)->create();

        $this->get(route('api.entities.show', $entity))
            ->assertOk()
            ->assertJsonFragment([
                "reviews_count" => $entity->reviews()->count()
            ]);
    }


    /** @test */
    public function it_should_show_specific_entity_logged_in_user_following_status_true_if_followed()
    {

        $this->signIn($user = factory(User::class)->create(), 'api');

        $entity = factory(Entity::class)->create();

        $user->follow($entity);

        $this->get(route('api.entities.show', $entity))->assertOk()
            ->assertJsonFragment(["following" => true]);
    }

    /** @test */
    public function it_should_show_specific_entity_logged_in_user_following_status_false_if_not_followed()
    {


        $this->signIn($user = factory(User::class)->create(), 'api');

        $entity = factory(Entity::class)->create();

        $this->get(route('api.entities.show', $entity))
            ->assertOk()
            ->assertJsonFragment(["following" => false]);
    }

    /** @test */
    public function it_should_show_specific_entity_not_logged_in_user_following_status_false()
    {
        $entity = factory(Entity::class)->create();

        $this->get(route('api.entities.show', $entity))
            ->assertOk()
            ->assertJsonFragment(["following" => false]);
    }


    /** @test */
    public function it_should_show_specific_entity_average_rating()
    {

        $this->signIn(null, 'api');

        $this->get(route('api.entities.show', factory(Entity::class)->create()->rate(2)))
            ->assertOk()
            ->assertJsonFragment(["average_rating" => "2.00"]);
    }


    /** @test */
    public function users_can_get_their_rate_for_a_specific_entity()
    {

        $this->signIn(factory(User::class)->create(), 'api');

        $entity = factory(Entity::class)->create();

        $response = $this->get(route('api.entities.show', $entity));

        $response->assertOk()->assertJsonFragment([
            "my_rating" => $entity->ratingFor(auth()->user())
        ]);
    }


    /** @test */
    public function unauthenticated_users_will_get_0_for_their_rates_for_entities()
    {
        $this->withoutExceptionHandling();

        $this->get(route('api.entities.show', factory(Entity::class)->create()))
            ->assertOk()
            ->assertJsonFragment([
                "my_rating" => "0"
            ]);
    }


    /** @test */
    public function users_can_get_their_created_entities()
    {

        $this->withoutExceptionHandling();

        $this->signIn(factory(User::class)->create(), 'api');

        factory(Entity::class, 2)->create(['user_id' => auth()->id()]);

        $this->get(route('api.entities.myEntities'))
            ->assertJsonCount(2, 'data')
            ->assertOk();

    }

    /** @test */
    public function it_should_get_entity_nearby_entities_within_1km()
    {

        // given we have many entities
        $center = factory('App\Entity')->create(
            [
                'name' => 'center',
                'longitude' => 15.6534368,
                'latitude' => 32.5587282
            ]
        );
        $inrange = factory('App\Entity')->create(
            [
                'name' => 'inrange',
                'longitude' => 15.6534368,
                'latitude' => 32.5587282
            ]
        );

        // 13.2604378,36.4392833
        $outrange = factory('App\Entity')->create(
            [
                'name' => 'outrange',
                'longitude' => 13.2604378,
                'latitude' => 36.4392833
            ]
        );

        //when we ask one for it's neighbrougs
        // then it should return only nearby 1 km
        $response = $this->get(route('api.entities.index', [
            '@lat' => $center->latitude,
            '@long' => $center->longitude,
        ]));

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => $inrange->name
            ]);

    }

    /** @test */
    public function it_should_add_entity_with_tags()
    {

        $entity = [
            'category_id' => factory(Category::class)->create()->id,
            'name' => "My Entity",
            'tags' => ['tag1', 'tag2', 'tag3'],
            'cover' => UploadedFile::fake()->image('cover.jpg'),
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            'description' => "This is a very great description",
            'latitude' => 3.5,
            'longitude' => 9.6
        ];

        $this->signIn(null, 'api');

        $this->json('post', route('api.entities.store'), $entity)
            ->assertJsonFragment([Tag::all()])
            ->assertStatus(201);

    }


    /** @test */
    public function it_should_ignore_duplicated_tags()
    {

        $this->withoutExceptionHandling();
        $entity = [
            'category_id' => factory(Category::class)->create()->id,
            'name' => "My Entity",
            'tags' => ['tag1', 'tag1', 'tag3'],
            'cover' => UploadedFile::fake()->image('cover.jpg'),
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            'description' => "This is a very great description",
            'latitude' => 3.5,
            'longitude' => 9.6
        ];

        $this->signIn(factory('App\User')->create(), 'api');

        $this->json('post', route('api.entities.store'), $entity)
            ->assertStatus(201)
            ->assertJsonCount(2, 'data.tags');
    }


}
