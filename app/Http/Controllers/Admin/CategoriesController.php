<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * return a view with all categories
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all()
            ->each(function ($categoy) {
                $categoy->append('path');
            });

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * return a view for single category
     *
     * @param \App\Category $category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        $entities = $category->entities()
            ->with('user')->paginate(10);

        return view('admin.categories.show', compact('category', 'entities'));
    }

    /**
     * return a view to create category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }
}
