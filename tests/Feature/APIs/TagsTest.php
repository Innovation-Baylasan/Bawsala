<?php

namespace Tests\APIs;

use App\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TagsTest extends TestCase
{

    use DatabaseMigrations;


    /**
     * @test
     */
    public function it_should_return_default_take_tags()
    {
        factory(Tag::class, 5)->create();

        $response = $this->get(route('api.tags.index'));

        $response
            ->assertJsonCount(5, 'data')
            ->assertOk();

    }


    /**
     * @test
     */
    public function it_should_return_tags_with_take_10()
    {
        $tags = factory(Tag::class, 10)->create();

        $response = $this->get(route('api.tags.index', [
            'take' => 10
        ]));

        $response
            ->assertJsonCount(10, 'data')
            ->assertOk();

    }

    /**
     * @test
     */
    public function it_should_search_tags()
    {

        $tags = factory(Tag::class, 2)->create();

        $response = $this->get(route('api.tags.index', [
            'q' => $tags[0]->name
        ]));

        $response
            ->assertJsonCount(2, 'data.0')
            ->assertJsonFragment([
                'label' => $tags[0]->name,
            ])
            ->assertOk();

    }


}
