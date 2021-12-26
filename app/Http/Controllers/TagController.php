<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(CategoryRequest $request)
    {
        $file = $request->file('image');
        $imageName = uniqid() . '-' . $file->getClientOriginalName();
        $file->move(public_path(). '/uploads/', $imageName);
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->image = $imageName;

        if($tag->save())
            return redirect()->route('tags.index')->with('success', 'Tag created successfully!');
        else
            return redirect()->back()->with('error', 'Tag created fail!');
    }


    public function show(Tag $tag)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $tag = Tag::find($id);
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "required"
        ]);

        if($validated) {
            $tag = Tag::find($id);
            $tag->name = $request->name;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = uniqid() . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/', $imageName);
                $tag->image = $imageName;
            }
            if($tag->update())
                return redirect()->route('tags.index')->with('success', 'Tag Updated successfully!');
            else
                return redirect()->back()->with('error', 'Tag updated Fail!');
        }


    }


    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        return redirect()->back();
    }
}
