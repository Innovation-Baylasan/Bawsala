<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;

class CategoryEntitiesController extends Controller
{
    public function index(Category $category)
    {
        return response($category->load('entities'), 200);
    }
}
