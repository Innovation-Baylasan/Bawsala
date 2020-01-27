<?php

namespace Tests\Feature;

use App\Category;
use App\Entity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class CategoryEntitiesApiTest extends TestCase
{

    use RefreshDatabase;

    private $category;
    private $entities;

    function setUp(): void
    {

        parent::setUp(); // TODO: Change the autogenerated stub

        $this->category = factory(Category::class)->create();

        $this->entities = factory(Entity::class, 5)->create([
            'category_id' => $this->category->id
        ]);

    }

    /**
     @test
     */
    public function test_getting_entities_by_category_id()
    {

        $response = $this->get(route('api.categoryEntities.index', [
            'category' => $this->category->id
        ]));

        $response
            ->assertOk()
            ->assertJsonCount(5)
            ->assertJsonFragment([
                'category_id' => $this->category->id
            ]);

    }
}