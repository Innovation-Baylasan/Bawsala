<?php

namespace Tests\Unit;

use App\EntityTag;
use App\Entity;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class EntityTagTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_belong_to_entity_and_tag()
    {
        $entity = factory(Entity::class)->create();
        $tag = factory(Tag::class)->create();
//
        $entityTag = factory(EntityTag::class)->create([
            'entity_id' => $entity->id,
            'tag_id' => $tag->id
        ]);
//
//        // Test that it belongs to a tag
//        $this->assertEquals($tag->fresh()->toArray(), $entityTag->tag->toArray());
//
//        // Test that it belongs to an entity
//        $this->assertEquals($entity->fresh()->toArray(), $entityTag->entity->toArray());
    }
}
