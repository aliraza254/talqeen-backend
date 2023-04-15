<?php

namespace App\Http\Controllers\Videos;

use Validator;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Controllers\Admin\BaseController as BaseController;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $i = 1;
//        $categories = Category::with('subcategories')->get();
//        return view('admin.category.index', compact('categories','i'));
//        return $this->sendResponse(new CategoryResource($categories), 'All Categories.');
        try {
            $i = 1;
            $categories = Category::with('subcategories')->get();
            if ($categories->isEmpty()) {
                throw new \Exception('No categories found.');
            }
            return $this->sendResponse(new CategoryResource($categories), 'All Categories.');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 404);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = $request->input('name');

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $category->image = $profileImage;
        }

        $category->save();

        return $this->sendResponse(new CategoryResource($category), 'Category Saved.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        return $this->sendResponse(new CategoryResource($category), 'View Single Category.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->withErrors(['message' => 'Video not found']);
        }
        return view('admin.category.edit', compact('category', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $category->name = $request->input('name');
        $category->slug = $request->input('name');

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $category['image'] = "$profileImage";
        }else{
            unset($category['image']);
        }

        $category->save();

        return $this->sendResponse(new CategoryResource($category), 'Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $categories, $id)
    {
        $categories->destroy($id);
        return $this->sendResponse(new CategoryResource($categories), 'Video deleted successfully!');
    }
}
