<?php

namespace App\Http\Controllers\Api;

use App\Entity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\task;

class RelatedPlacesController extends Controller
{
    /**
     * This end point is responsible for returning a related entities to
     * a specific entity using the first measure which is the similar tags
     *
     * @param Entity $entity
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index(Entity $entity)
    {

        return $entity->relatedPlaces();

    }

}
