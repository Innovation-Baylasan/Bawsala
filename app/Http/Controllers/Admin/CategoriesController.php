<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $this->validateRequest($request);

        $iconPath = $request->file('icon')->store('public/icons');

        $markerPath = $request->file('icon_png')->store('public/markers');


        Category::create([
            'name' => $request->name,
            'icon' => $iconPath,
            'icon_png' => $markerPath
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Category $category, Request $request)
    {

        $this->validateRequest($request);

        Storage::delete([$category->icon, $category->icon_png]);

        $iconPath = $request->file('icon')->store('public/icons');

        $markerPath = $request->file('icon_png')->store('public/markers');


        $category->update([
            'name' => $request->name,
            'icon' => $iconPath,
            'icon_png' => $markerPath
        ]);

        return redirect('/admin/categories')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified category from database.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Data deleted successfully');
    }

    /**
     * @param Request $request
     */
    public function validateRequest(Request $request): void
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required|image|max:2048',
            'icon_png' => 'required|image|max:2048'
        ]);
    }
}
