<?php

namespace Tests\Feature;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CategoriesApiTest extends TestCase
{
    use RefreshDatabase;

    private $categories;

    public function setUp(): void {

        parent::setUp();

        $this->categories = factory(Category::class, 16)->create();

    }

    /** @test */
    public function test_getting_categories_in_pagination()
    {

        $response = $this->get(route('api.categories.index'));
        $response
            ->assertOk()
            ->assertJsonFragment([
                "total" => 16,
                "per_page" => 15,
                "current_page" => 1
            ]);

    }

    /** @test */
    public function test_getting_categories_in_next_page()
    {

        $response = $this->get(route('api.categories.index', [
            'page' => 2
        ]));
        $response
            ->assertOk()
            ->assertJsonFragment([
                "total" => 16,
                "per_page" => 15,
                "current_page" => 2
            ]);

    }

    /** @test */
    public function test_getting_category_item()
    {

        $response = $this->get(route('api.categories.show', [
            'category' => $this->categories[0]->id
        ]));

        $response
            ->assertOk()
            ->assertJsonFragment([
                "id" => $this->categories[0]->id
            ]);

    }

}
