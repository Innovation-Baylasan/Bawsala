<?php

namespace App\Http\Controllers;

use App\Entity;
use Illuminate\Http\Request;

class EntitiesRatingController extends Controller
{
    public function store(Entity $entity)
    {
        request()->validate([
            'rating' => ['required', 'in:1,2,3,4,5']
        ]);
        $entity->rate(request('rating'));
    }
}
