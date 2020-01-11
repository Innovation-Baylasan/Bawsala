<?php

namespace App\Http\Controllers\Api;

use App\Entity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntitiesFollowingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param Entity $entity
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Entity $entity)
    {
        auth()->user()->follow($entity);

        return response([
            'message' => 'followed successfully'
        ], 200);
    }

    /**
     * @param Entity $entity
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Entity $entity)
    {
        auth()->user()->unFollow($entity);


        return response([
            'message' => 'unfollowed successfully'
        ], 200);
    }
}
