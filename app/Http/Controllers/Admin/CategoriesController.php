<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a view with all categories paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::latest()->paginate(5);

        return view('admin.categories.index', compact('categories'));

    }

    /**
     * Display a view for creating a category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'icon' => 'required|image|max:2048'
        ]);

        $icon = $request->file('icon');

        $icon->move(public_path('images') . '/categoryIcon', $iconPath = rand() . '.' . $icon->getClientOriginalExtension());

        Category::create([
            'name' => $request->name,
            'icon' => $iconPath
        ]);

        return redirect('/admin/categories')
            ->with('success', 'Data added successfully.');

    }

    /**
     * Display the specified category.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return View('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('admin.categories.edit', compact('category'));

    }

    /**
     * Update the specified category in database.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, Request $request)
    {
        $icon_name = $request->old_icon;
        $icon = $request->file('icon');

        $request->validate([
            'name' => 'required',
            'icon' => 'sometimes|image|max:2048'
        ]);

        if ($icon) {
            $icon_name = rand() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('images') . '/categoryIcon', $icon_name);
        }

        $category->update([
            'name' => $request->name,
            'icon' => $icon_name
        ]);

        return redirect('/admin/categories')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified category from database.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Data deleted successfully');
    }
}
