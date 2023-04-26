<?php

namespace App\Http\Controllers\Videos;

use Validator;
use App\Models\Videos;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Videos as VideoResource;
use App\Http\Controllers\Admin\BaseController as BaseController;

class VideosController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $i = 1;
        $videos = Videos::with('category')->with('subcategory')->get();
        if ($videos->isEmpty()) {
            return response()->json(['error' => 'No Videos Found'], 404);
        }
        return $this->sendResponse(new VideoResource($videos), 'All Videos.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::with('subcategories')->get();
        return view('admin.videos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'url' => 'required',
            'status' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|max:2048',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $existingProduct = Videos::where('slug', $request->input('slug'))->first();

        if ($existingProduct) {
            return response()->json(['error' => 'Product already exists for this product type.'], 422);
        }

        $video = new Videos();
        $video->name = $request->input('name');
        $video->slug = $request->input('name');
        $video->description = $request->input('description');
        $video->url = $request->input('url');
        $video->status = $request->input('status');
        $video->category_id = $request->input('category_id');
        $video->subcategory_id = $request->input('subcategory_id');

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $video['image'] = "$profileImage";
        }

        $video->save();

        return $this->sendResponse(new VideoResource($video), 'Video Saved.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $videos = Videos::find($id);
        return $this->sendResponse(new VideoResource($videos), 'Video Fetched.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::all();
        $videos = Videos::find($id);
        if (!$videos) {
            return redirect()->back()->withErrors(['message' => 'Video not found']);
        }
        return view('admin.videos.edit', compact('videos', 'category', 'id'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videos $video)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'url' => 'required',
            'status' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }


        $video->name = $request->input('name');
        $video->slug = $request->input('name');
        $video->description = $request->input('description');
        $video->url = $request->input('url');
        $video->status = $request->input('status');
        $video->category_id = $request->input('category_id');

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $video['image'] = "$postImage";
        }else{
            unset($video['image']);
        }

        $video->save();

        return $this->sendResponse(new VideoResource($video), 'Video updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $video = Videos::find($id);

        if(!$video){
            return $this->sendError('Video not found', 404);
        }

        $video->delete($id);
        return $this->sendResponse(new VideoResource($video), 'Video deleted successfully!');

    }

}
