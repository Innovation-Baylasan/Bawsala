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

        Category::create([
            'name' => $request->name,
            'icon' => $request->file('icon')->store('icons'),
            'icon_png' => $request->file('icon_png')->store('markers')
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

        $category->update([
            'name' => $request->name,
            'icon' => $request->file('icon')->store('icons'),
            'icon_png' => $request->file('icon_png')->store('markers')
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
     * validate the request for creating of updating category
     * and return the validated attributes
     *
     * @return array
     */
    public function validateRequest()
    {
        return request()->validate([
            'name' => 'required',
            'icon' => 'required|image|max:2048',
            'icon_png' => 'required|image|max:2048'
        ]);
    }
}
