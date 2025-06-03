<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Categories;
use App\Http\Resources\ProductCategoryResource;


class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::latest()->paginate(10);

       return new ProductCategoryResource($categories, 200, 'List Data Product Category');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = new Categories;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $imageName);
            $category->image = 'images/categories/' . $imageName;
        }


        $category->save();
        return new ProductCategoryResource($category, 201, 'Product Category Created Successfully');
    }



}
