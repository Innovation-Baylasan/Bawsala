<?php

namespace Tests\Unit;

use App\Entity;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

class EntityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup function.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->entity = factory(Entity::class)->create();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    function it_can_be_rated()
    {
        $this->entity->rate(5, $this->user);

        $this->assertCount(1, $this->entity->ratings);
    }

    /** @test */
    function it_can_calculate_the_average_rating()
    {
        $this->entity->rate(5, $this->user);
        $this->entity->rate(1, factory(User::class)->create());

        $this->assertEquals(3, $this->entity->rating());
    }

    /** @test */
    function it_can_fetch_a_users_rating()
    {
        $this->entity->rate(5, $this->user);

        $this->assertEquals(5, $this->entity->ratingFor($this->user));
    }

    /** @test */
    function it_cannot_be_rated_above_5()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->entity->rate(6);
    }

    /** @test */
    function it_cannot_be_rated_below_1()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->entity->rate(-1);
    }

    /** @test */
    function it_can_only_be_rated_once_per_user()
    {
        $this->actingAs($this->user);

        $this->entity->rate(5);
        $this->entity->rate(1);

        $this->assertEquals(1, $this->entity->rating());
    }

}
