<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Category::latest()->paginate(5);

        // dd($data);

        return view('admin.categories.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'icon' => 'required|image|max:2048'
        ]);

        $icon = $request->file('icon');
        $new_icon_name = rand() . '.' . $icon->getClientOriginalExtension();
        $icon->move(public_path('images').'/categoryIcon', $new_icon_name);

        $form_data = array(
            'name' => $request->name,
            'icon' => $new_icon_name
        );

        Category::create($form_data);

        return redirect('/admin/categories')
            ->with('success', 'Data added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Category::findOrFail($id);

        return View('admin.categories.show', compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Category::findOrFail($id);

        return view('admin.categories.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $icon_name = $request->old_icon;
        $icon = $request->file('icon');
        if ($icon != '')
        {
            $request->validate([
                'name' => 'required',
                'icon' => 'image|max:2048'
            ]);
            $icon_name = rand().'.'.$icon->getClientOriginalExtension();
            $icon->move(public_path('images').'/categoryIcon', $icon_name);
        }
        else
        {
            $request->validate([
                'name' => 'required'
            ]);
        }

        $form_data = array(
            'name' => $request->name,
            'icon' => $icon_name
        );

        Category::whereId($id)->update($form_data);

        return redirect('/admin/categories')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::findOrFail($id);
        $data->delete();

        return redirect('/admin/categories')
            ->with('success', 'Data deleted successfully');
    }
}
