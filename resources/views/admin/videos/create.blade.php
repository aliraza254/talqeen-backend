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
                <form method="post" action="{{ route('admin.videos.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="videoName">Video Name</label>
                        <input type="text" id="videoName" name="name" class="form-control" style="border: 1px solid #ced4da; border-radius: 0.25rem;">
                    </div>
                    <div class="form-group">
                        <label for="videoDescription">Video Description</label>
                        <textarea id="videoDescription" name="description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="videoUrl">Video URL</label>
                        <input type="text" name="url" id="videoUrl" class="form-control" style="border: 1px solid #ced4da; border-radius: 0.25rem;">
                    </div>
                    <div class="form-group">
                        <label for="videoImage">Video Image</label>
                        <input type="file" id="videoImage" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="videoStatus">Status</label>
                        <select id="videoStatus" name="status" class="form-control custom-select">
                            <option selected disabled>Select Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="videoCategory">Category</label>
                        <select id="videoCategory" name="category_id" class="form-control custom-select">
                            <option selected disabled>Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="videoSubCategory">Sub Category</label>
                        <select id="videoSubCategory" name="subcategory_id" class="form-control custom-select">
                            <option selected disabled>Select Sub Category</option>
                            @foreach($categories as $category)
                                @foreach($category->subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success float-right" style="background-color: #28a745;"> Submit </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

</x-admin-layout>
