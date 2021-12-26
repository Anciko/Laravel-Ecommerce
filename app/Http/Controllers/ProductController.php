<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCat;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $cats = Category::all();
        $subcats = SubCat::all();
        $tags = Tag::all();
        return view('products.create', compact('cats','subcats', 'tags'));
    }


    public function store(ProductRequest $request)
    {
        $files = $request->file('images');
        $images = "";
        foreach($files as $file) {
            $imagName = uniqid() . '-' . $file->getClientOriginalName();
            $file->move(public_path().'/uploads/', $imagName);
            $images .=  $imagName . ',';
        }

        $images = rtrim($images, ',');
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->subcat_id = $request->subcat_id;
        $product->tag_id = $request->tag_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->images = $images;
        $product->colors = $request->colors;
        $product->sizes = $request->sizes;
        $product->description = $request->desc;

        if($product->save())
            return redirect()->route('products.index')->with('success', 'Product created successfully!');
        else
            return redirect()->back()->with('error', 'Product crated Fail!');

    }


    public function show(Product $product)
    {

    }


    public function edit($id)
    {
        $cats = Category::all();
        $subcats = SubCat::all();
        $tags = Tag::all();
        $product = Product::find($id);
        return view('products.edit', compact('product', 'cats','subcats','tags'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "required",
            "price" => "required",
            "colors" => "required",
            "sizes" => "required",
            "desc" => "required"
        ]);

        if($validated) {
            $product = Product::find($id);
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->subcat_id = $request->subcat_id;
            $product->tag_id = $request->tag_id;
            $product->price = $request->price;
            $product->colors = $request->colors;
            $product->description = $request->desc;
            if($request->hasFile('image')) {
                $files = $request->file('images');
                $images = "";
                foreach ($files as $file) {
                    $imagName = uniqid() . '-' . $file->getClientOriginalName();
                    $file->move(public_path() . '/uploads/', $imagName);
                    $images .=  $imagName . ',';
                }

                $images = rtrim($images, ',');
                $product->images = $images;
            }
            if($product->update())
                return redirect()->route('products.index')->with('success', 'Product updated successfully!');
            else
                return redirect()->back()->with('error', 'Product updated Fail!');
        }
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->back();
    }
}
