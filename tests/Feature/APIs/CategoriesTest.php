<?php

namespace Tests\APIs;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CategoriesTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function users_can_show_a_single_category()
    {

        $response = $this->get(route(
            'api.categories.show',
            $category = factory(Category::class)->create()
        ));

        $response
            ->assertOk()
            ->assertJsonFragment([
                "id" => $category->id
            ]);

    }

}
