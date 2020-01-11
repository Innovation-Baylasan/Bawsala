<?php

namespace App\Http\Controllers\Api;

use App\Entity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntitiesRatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param Request $request
     * @param Entity $entity
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Request $request, Entity $entity)
    {
        $entity->rate($request->rating);

        return response([
            'message' => 'rated successfully'
        ], 200);
    }
}
