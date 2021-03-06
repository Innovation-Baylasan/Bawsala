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
        return response($entity->reviews()->lateast()->get(), 200);
    }

    /**
     * @param Request $request
     * @param Entity $entity
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request, Entity $entity)
    {
        $review = $entity->review($request->review);

        return response($review, 200);
    }

    /**
     * @param Review $review
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Request $request, Entity $entity)
    {
        $message = $entity->unreview($request->review);
//        $review->delete();

        return response([
            'message' => $message
        ], 200);

    }
}
