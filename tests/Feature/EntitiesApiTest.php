<?php

namespace Tests\Feature;

use App\Category;
use App\Entity;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\User;



class EntitiesApiTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void {

        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->entities = factory(Entity::class, 2)->create([
            'user_id' => $this->user->id
        ]);

        // Add Review
        $this->entities[0]->review('Nice work', $this->user);
        $this->entities[0]->review('Nice work', $this->user);
        $this->entities[0]->review('Nice work', $this->user);
        $this->entities[0]->review('Nice work', $this->user);

        // Add Rating
        $this->entities[0]->rate(5, $this->user);
        $this->entities[0]->rate(1, factory(User::class)->create());
        $this->entities[0]->rate(2, factory(User::class)->create());
        $this->entities[0]->rate(2, factory(User::class)->create());

        $this->user->follow($this->entities[0]);
        factory(User::class)->create()->follow($this->entities[0]);

        factory(Entity::class, 2)->create();

    }

    /** @test */
    public function it_passes_test()
    {

        $response = $this->get('/');

        $response->assertStatus(200);

    }

    /** @test */
    public function it_should_return_all_entities () {

        $this->withoutExceptionHandling();

        $response = $this->get(route('api.entities.index'));

        $response
            ->assertOk();

    }

    /** @test */
    public function it_should_filter_entities () {

        $response = $this->get(route('api.entities.index', [
            'q' => $this->entities[0]->name
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => $this->entities[0]->name
            ]);

    }

    /** @test */
    public function it_should_get_entity_nearby_entities()
    {

        $response = $this->get(route('api.entities.index', [
            '@lat' => $this->entities[0]->latitude,
            '@long' => $this->entities[0]->longitude,
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => $this->entities[0]->name
            ]);

    }


    /** @test */
    public function it_should_show_entity_by_passing_id()
    {

        $this->signIn($this->user, 'api');

        $response = $this->get(route('api.entities.show', [
            'entity' => $this->entities[0]->id
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => $this->entities[0]->name
            ]);

    }



    /** @test */
    public function it_should_show_specific_entity_reviews_not_more_than_4 () {

        $this->signIn($this->user, 'api');

        $response = $this->get(route('api.entities.show', [
            'entity' => $this->entities[0]->id
        ])); //->decodeResponseJson();

        $response
            ->assertOk()
            ->assertJsonCount(4, 'data.reviews');
    }

    /** @test */
    public function it_should_show_specific_entity_total_reviews_count () {

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
    public function it_should_show_specific_entity_logged_in_user_following_status_true_if_followed () {

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
    public function it_should_show_specific_entity_logged_in_user_following_status_false_if_not_followed () {

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
    public function it_should_show_specific_entity_not_logged_in_user_following_status_false () {

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
    public function it_should_show_specific_entity_average_rating () {

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
    public function it_should_show_specific_entity_logged_in_user_rating()
    {

        $this->signIn($this->user, 'api');

        $response = $this->get(route('api.entities.show', [
            'entity' => $this->entities[0]->id
        ])); //->decodeResponseJson();

        $myRating = $this->entities[0]->ratings()->where('user_id', $this->user->id)->value('rating');

        $response
            ->assertOk()
            ->assertJsonFragment([
                "my_rating" => "$myRating"
            ]);
    }


    /** @test */
    public function it_should_show_specific_entity_not_logged_in_user_rating_as_0 () {

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
    function it_should_allow_authenticated_user_to_create_entity()
    {

        $this->withoutExceptionHandling();

        $this->signIn(factory(User::class)->create(), 'api');

        $entity = [
            'category_id' => factory(Category::class)->create()->id,
            'name' => "My Entity",
            'cover' => "https://placeimg.com/640/360/tech",
            'avatar' => "https://www.gravatar.com/avatar/?s=200",
            'description' => "This is a very great description",
            'latitude' => 3.5,
            'longitude' => 9.6
        ];

        $response = $this->json('post', route('api.entities.store'), $entity);

        $response
            ->assertJsonFragment($entity)
            ->assertJsonFragment([
                'message' => 'Entity created successfully'
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
    public function it_should_return_user_entities_user_following_status () {

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



}
