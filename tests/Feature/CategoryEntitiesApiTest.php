<?php

namespace Tests\Feature;

use App\Category;
use App\Entity;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class CategoryEntitiesApiTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    public function test_getting_entities_by_category_id()
    {
        factory(Entity::class, 5)->create([
            'category_id' => $category = factory(Category::class)->create()
        ]);

        $response = $this->get(route('api.categoryEntities.index', [
            'category' => $category->id
        ]));

        $response->assertOk()
            ->assertJsonCount(5)
            ->assertJsonFragment([
                'id' => $category->id
            ]);

    }
}
