<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;

class CategoryActivitiesController extends Controller
{
    public function index(Category $category)
    {
        return response($category->load('activities'), 200);
    }
}
