<?php

namespace App\Http\Controllers\Videos;

use App\Models\Category;
use Validator;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Resources\Subcategory as SubcategoryResource;
use App\Http\Controllers\Admin\BaseController as BaseController;

class SubcategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $i = 1;
        $subcategory = Subcategory::all();
        return view('admin.subcategory.index', compact('subcategory', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.subcategory.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'category_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $existingProduct = Subcategory::where('slug', $request->input('slug'))->first();

        if ($existingProduct) {
            return response()->json(['error' => 'Product already exists for this product type.'], 422);
        }

        $subcategory = new Subcategory();
        $subcategory->name = $request->input('name');
        $subcategory->slug = $request->input('name');
        $subcategory->category_id = $request->input('category_id');

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $subcategory['image'] = "$profileImage";
        }

        $subcategory->save();

        return $this->sendResponse(new SubcategoryResource($subcategory), 'Video Saved.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subcategory = Subcategory::find($id);
        if (!$subcategory) {
            return redirect()->back()->withErrors(['message' => 'Video not found']);
        }
        return view('admin.category.edit', compact('subcategory', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $subcategory->name = $request->input('name');
        $subcategory->slug = $request->input('name');
        $subcategory->status = $request->input('status');

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $subcategory['image'] = "$profileImage";
        }else{
            unset($subcategory['image']);
        }

        $subcategory->save();

        return $this->sendResponse(new SubcategoryResource($subcategory), 'Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory, $id)
    {
        $subcategory->destroy($id);
        return $this->sendResponse(new SubcategoryResource($subcategory), 'Video deleted successfully!');
    }
}
