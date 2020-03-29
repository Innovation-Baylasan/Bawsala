<?php

namespace Tests\APIs;

use App\Category;
use App\Entity;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CategoryEntitiesTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    public function users_can_filter_entities_to_a_single_category()
    {
        $this->withoutExceptionHandling();
        $category = factory(Category::class)->create();

        factory(Entity::class, 5)->create([
            'category_id' => $category->id
        ]);

        $this->get(route('api.categoryEntities.index', $category))
            ->assertOk()
            ->assertJsonCount(5);

    }
}
