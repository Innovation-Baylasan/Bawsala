<?php

namespace App\Http\Controllers\Api;

use App\Entity;
use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;

class EntitiesReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Entity $entity)
    {
        return response($entity->reviews, 200);
    }

    /**
     * @param Request $request
     * @param Entity $entity
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request, Entity $entity)
    {
        $entity->review($request->review);

        return response($entity, 200);
    }

    /**
     * @param Review $review
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return response([
            'message' => 'review deleted'
        ], 200);
    }
}
