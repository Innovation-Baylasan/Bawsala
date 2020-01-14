<?php

namespace App\Http\Controllers;

use App\Entity;

class EntitiesFollowersController extends Controller
{
    public function update(Entity $entity)
    {
        $user = auth()->user();

        $method = $user->isFollowing($entity) ? 'unFollow' : 'follow';

        $user->{$method}($entity);

        return back();
    }
}
