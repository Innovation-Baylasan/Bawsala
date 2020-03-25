<?php

namespace Tests\Feature;

use App\Category;
use App\Entity;
use App\Tag;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\User;


class EntitiesApiTest extends TestCase
{

    use DatabaseMigrations;


    /** @test */
    public function entities_can_be_filtered_by_name()
    {
        $entity = factory(Entity::class)->create();

        factory(Entity::class)->create();

        $this->get(route('api.entities.index', ['q' => $entity->name,]))
            ->assertOk()
            ->assertJsonFragment(['name' => $entity->name]);

    }


    /** @test */
    public function it_should_show_specific_entity_reviews_not_more_than_4()
    {

        $this->signIn($this->user, 'api');

        $response = $this->get(route('api.entities.show', [
            'entity' => $this->entities[0]->id
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonCount(4, 'data.reviews');
    }

    /** @test */
    public function it_should_show_specific_entity_total_reviews_count()
    {

        $this->signIn($this->user, 'api');

        $response = $this->get(route('api.entities.show', [
            'entity' => $this->entities[0]->id
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonFragment([
                "reviews_count" => $this->entities[0]->reviews()->count()
            ]);
    }


    /** @test */
    public function it_should_show_specific_entity_logged_in_user_following_status_true_if_followed()
    {

        $this->signIn($this->user, 'api');

        $response = $this->get(route('api.entities.show', [
            'entity' => $this->entities[0]->id
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonFragment([
                "current_following_status" => true
            ]);
    }

    /** @test */
    public function it_should_show_specific_entity_logged_in_user_following_status_false_if_not_followed()
    {

        $this->signIn(factory(User::class)->create(), 'api');

        $response = $this->get(route('api.entities.show', [
            'entity' => $this->entities[0]->id
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonFragment([
                "current_following_status" => false
            ]);
    }

    /** @test */
    public function it_should_show_specific_entity_not_logged_in_user_following_status_false()
    {

        $response = $this->get(route('api.entities.show', [
            'entity' => $this->entities[0]->id
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonFragment([
                "current_following_status" => false
            ]);
    }


    /** @test */
    public function it_should_show_specific_entity_average_rating()
    {

        $response = $this->get(route('api.entities.show', [
            'entity' => $this->entities[0]->id
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonFragment([
                "average_rating" => "2.50"
            ]);
    }


    /** @test */
    public function it_shows_user_his_rating_for_requested_entity()
    {

        $this->signIn(factory(User::class)->create(), 'api');

        $entity = factory(Entity::class)->create();

        $response = $this->get(route('api.entities.show', $entity));

        $response->assertOk()->assertJsonFragment([
            "my_rating" => $entity->ratingFor(auth()->user())
        ]);
    }


    /** @test */
    public function it_should_show_specific_entity_not_logged_in_user_rating_as_0()
    {

        $response = $this->get(route('api.entities.show', [
            'entity' => $this->entities[0]->id
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonFragment([
                "my_rating" => "0"
            ]);
    }


    /** @test */
    function it_should_allow_only_company_user_to_create_entity()
    {

        $entity = [
            'category_id' => factory(Category::class)->create()->id,
            'name' => "My Entity",
            'cover' => UploadedFile::fake()->image('cover.jpg'),
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            'description' => "This is a very great description",
            'latitude' => 3.5,
            'longitude' => 9.6
        ];

        $this->signIn(factory(User::class)->create(), 'api');

        $this->json('post', route('api.entities.store'), $entity)->assertStatus(403);

        $this->signIn($this->createCompanyUser(), 'api');

        $this->json('post', route('api.entities.store'), $entity)
            ->assertJsonFragment([
                'name' => 'My Entity'
            ])
            ->assertStatus(201);

    }


    /** @test */
    public function it_should_return_user_entities()
    {

        $this->withoutExceptionHandling();

        $this->signIn($this->user, 'api');

        $response = $this->get(route('api.entities.myEntities'));

        $response
            ->assertJsonCount(2, 'data')
            ->assertOk();

    }


    /** @test */
    public function it_should_return_user_entities_user_following_status()
    {

        $this->withoutExceptionHandling();

        $this->signIn($this->user, 'api');

        $response = $this->get(route('api.entities.myEntities'));

        $response
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

        $this->signIn($this->createCompanyUser(), 'api');

        $response = $this->json('post', route('api.entities.store'), $entity);

        $response
            ->assertJsonFragment([
                Tag::all()
            ])
            ->assertStatus(201);

    }


    /** @test */
    public function it_should_ignore_duplicated_tags()
    {

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

        $this->signIn($this->createCompanyUser(), 'api');

        $response = $this->json('post', route('api.entities.store'), $entity);

        $response->assertJsonCount(2, 'data.tags')
            ->assertStatus(201);

    }


}
