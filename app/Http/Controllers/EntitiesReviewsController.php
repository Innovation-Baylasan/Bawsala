<?php

namespace App\Http\Controllers;

use App\Entity;
use Illuminate\Http\Request;

class EntitiesReviewsController extends Controller
{
    public function store(Entity $entity)
    {
        $attributes = request()->validate([
            'review' => 'required'
        ]);

        $entity->review($attributes['review']);

        return back();
    }
}
