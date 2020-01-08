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
            'icon' => 'required|image|max:2048',
            'icon_png' => 'required|image|max:2048'
        ]);

        // Category SVG Icon
        $icon = $request->file('icon');
        $icon->move(public_path('images') . '/categoryIcon', $iconPath = rand() . '.' . $icon->getClientOriginalExtension());
        // Category PNG Icon for mobile phone
        $iconPng = $request->file('icon_png');
        $iconPng->move(public_path('images') . '/categoryIcon', $iconPngPath = rand() . '.' . $iconPng->getClientOriginalExtension());


        Category::create([
            'name' => $request->name,
            'icon' => $iconPath,
            'icon_png' => $iconPngPath
        ]);

        return redirect('/admin/categories')
            ->with('success', 'Data added successfully.');

    }

    /**
     * Display the specified category.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return View('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  Category $category
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
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, Request $request)
    {
        $iconPath = $request->old_icon;
        $icon = $request->file('icon');
        // PNG icon for mobile phone
        $iconPngPath = $request->oldIconPngName;
        $iconPng = $request->file('icon_png');

        $request->validate([
            'name' => 'required',
            'icon' => 'sometimes|image|max:2048',
            'icon_png' => 'sometimes|image|max:2048',
        ]);

        // SVG Icon for web
        if ($icon) {
            $iconPath = rand() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('images') . '/categoryIcon', $iconPath);
        }
        // PNG icon for mobile
        // Category PNG Icon for mobile phone
        if ($iconPng) {
            $iconPngPath = rand() . '.' . $iconPng->getClientOriginalExtension();
            $iconPng->move(public_path('images') . '/categoryIcon', $iconPngPath);
        }


        $category->update([
            'name' => $request->name,
            'icon' => $iconPath,
            'icon_png' => $iconPngPath
        ]);

        return redirect('/admin/categories')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified category from database.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Data deleted successfully');
    }
}
