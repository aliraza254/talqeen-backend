<x-admin-layout>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Videos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.videos.index') }}">Videos</a></li>
                        <li class="breadcrumb-item active">Add Video</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content-header">
        <div class="card card-primary">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.videos.update', $videos->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="videoName">Video Name</label>
                        <input type="text" id="videoName" name="name" value="{{ $videos->name }}" class="form-control" style="border: 1px solid #ced4da; border-radius: 0.25rem;">
                    </div>
                    <div class="form-group">
                        <label for="videoDescription">Video Description</label>
                        <textarea id="videoDescription" name="description" class="form-control" rows="4">{{ $videos->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="videoUrl">Video URL</label>
                        <input type="text" name="url" id="videoUrl" value="{{ $videos->url }}" class="form-control" style="border: 1px solid #ced4da; border-radius: 0.25rem;">
                    </div>
                    <div class="form-group">
                        <label for="videoImage">Video Image</label>
                        <input type="file" id="videoImage" name="image" value="{{ $videos->image }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="videoStatus">Status</label>
                        <select id="videoStatus" name="status" class="form-control custom-select">
                            <option selected disabled>Select Status</option>
                            <option value="published" @if($videos->status == 'published'){{'selected'}}@endif>Published</option>
                            <option value="draft" @if($videos->status == 'draft'){{'selected'}}@endif>Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="videoCategory">Category</label>
                        <select id="videoCategory" name="category_id" class="form-control custom-select">
                            <option selected disabled>Select Category</option>
                            @foreach($category as $single)
                                <option value="{{ $single->id }}" @if($videos->category_id == $single->id){{'selected'}}@endif>{{ $single->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="videoSubCategory">Sub Category</label>
                        <select id="videoSubCategory" name="subcategory_id" value="{{ $videos->subcategory_id }}" class="form-control custom-select">
                            <option selected disabled>Select Sub Category</option>
                            <option value="1">On Hold</option>
                            <option value="1">Canceled</option>
                            <option value="1">Success</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success float-right" style="background-color: #28a745;"> Update </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

</x-admin-layout>
