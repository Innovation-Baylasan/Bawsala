<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;

class CategoryEntitiesController extends Controller
{
    /**
     * return all entities that are belong to a given
     * category
     *
     * @param \App\Category $category
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        return response($category->entities, 200);
    }
}
