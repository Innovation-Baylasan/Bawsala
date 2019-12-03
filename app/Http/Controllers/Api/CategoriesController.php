<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * return all categories paginated in 15 per page
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        return response(Category::paginate(15), 200);
    }

    /**
     * return a single category
     *
     * @param \App\Category $category
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response($category, 200);
    }
}
