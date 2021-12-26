<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $cats = Category::all();
        return view('categories.index', compact('cats'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $file = $request->file('image');
        $imageName = uniqid(). '-' . $file->getClientOriginalName();
        $file->move(public_path() . '/uploads/', $imageName);

        $category = new Category();
        $category->name = $request->name;
        $category->image = $imageName;

        if($category->save())
            return redirect()->route('categories.index')->with('success', 'Category created successfully!');
        else
            return redirect()->back()->with('error', 'Category created Fail!');

    }

    public function show(Category $category)
    {

    }

    public function edit($id)
    {
        $cat = Category::find($id);
        return view('categories.edit', compact('cat'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "required"
        ]);

        if($validated) {
            $cat = Category::find($id);
            $cat->name = $request->name;

            if($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = uniqid() . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/', $imageName);
                $cat->image = $imageName;
            }

            if($cat->update())
                return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
            else
                return redirect()->back()->with('error', 'Category updated Fail!');
        }
    }

    public function destroy($id)
    {
        $cat = Category::find($id);
        $cat->delete();

        return redirect()->back();
    }
}
