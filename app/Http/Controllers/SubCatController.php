<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\SubCat;
use Illuminate\Http\Request;

class SubCatController extends Controller
{
    public function index($id)
    {
        $cat = Category::find($id)->load('subcats');
        return view('subcats.index', compact('cat'));
    }


    public function create($id)
    {
        $cat = Category::find($id);
        return view('subcats.create', compact('cat'));
    }

    public function store(CategoryRequest $request, $id)
    {
        $file = $request->file('image');
        $imageName = uniqid() . '-' . $file->getClientOriginalName();
        $subCat = new SubCat();
        $subCat->category_id = $id;
        $subCat->name = $request->input('name');
        $subCat->image = $imageName;
        if ($subCat->save()) {
            $file->move(public_path() . '/uploads/', $imageName);
            return redirect()->route('categories.subcats.index', $id)->with('success', 'Category created successfully!');
        } else {
            return redirect()->back()->with('error', 'Category created Fail!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCat  $subCat
     * @return \Illuminate\Http\Response
     */
    public function show(SubCat $subCat)
    {
        //
    }


    public function edit($id)
    {
        $subcat = SubCat::find($id);
        return view('subcats.edit', compact('subcat'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "required"
        ]);

        if($validated) {
            $subcat = SubCat::find($id);
            $subcat->name = $request->name;
            if($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = uniqid() . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/', $imageName);
                $subcat->image = $imageName;
            }
            if ($subcat->update()) {
                return redirect()->route('categories.subcats.index', $subcat->category_id)->with('success', 'Sub category updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Sub category created Fail!');
            }
        }

    }


    public function destroy($id)
    {
        $subcat = SubCat::find($id);
        $subcat->delete();
        return redirect()->back();
    }
}
