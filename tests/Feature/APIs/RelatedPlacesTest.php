<?php

namespace Tests\APIs;

use App\Entity;
use App\EntityTag;
use App\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RelatedPlacesTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function it_return_related_places_to_the_given_entity_based_on_common_tags()
    {

        /**
         *
         * When I return related places to a given entity then i will get the entities which are created by this
         * entity, that contains the parent as an entity
         * Or the entities that has the same tag
         * Or the entities created by the same user
         * Or the entities that has some commonalities between them
         *
         */
        $this->withoutExceptionHandling();

        $entities = factory(Entity::class, 5)->create();
        $tags = factory(Tag::class, 3)->create();

        // tag (0) => entity (0 - 1, 5)
        factory(EntityTag::class)->create([
            'tag_id' => $tags[0]->id,
            'entity_id' => $entities[0]->id
        ]);
        factory(EntityTag::class)->create([
            'tag_id' => $tags[0]->id,
            'entity_id' => $entities[1]->id
        ]);
        factory(EntityTag::class)->create([
            'tag_id' => $tags[0]->id,
            'entity_id' => $entities[4]->id
        ]);

        // tag(1) => entity (0 - 2)
        factory(EntityTag::class)->create([
            'tag_id' => $tags[1]->id,
            'entity_id' => $entities[0]->id
        ]);
        factory(EntityTag::class)->create([
            'tag_id' => $tags[1]->id,
            'entity_id' => $entities[2]->id
        ]);


        $response = $this->get(route('api.relatedPlacesController.index', [
            'entity' => $entities[0]->id
        ]));

        $response
            ->assertJsonCount(3)
            ->assertOk();

    }

}
