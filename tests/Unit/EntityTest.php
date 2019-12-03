<?php

namespace Tests\Unit;

use App\Entity;
use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EntityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function its_belong_to_a_user()
    {
        $user = factory(User::class)->create();

        $entity = factory(Entity::class)->create([
            'user_id' => $user->id
        ]);


        $this->assertEquals($user->fresh()->toArray(), $entity->user->toArray());
    }

    /**
     *
     * @test
     */
    public function its_belong_to_a_category()
    {
        $category = factory(Category::class)->create();

        $entity = factory(Entity::class)->create([
            'category_id' => $category->id
        ]);


        $this->assertEquals($category->toArray(), $entity->category->toArray());
    }
}

