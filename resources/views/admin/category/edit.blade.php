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
                <form method="POST" action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="videoName">Video Name</label>
                        <input type="text" id="videoName" name="name" value="{{ $category->name }}" class="form-control" style="border: 1px solid #ced4da; border-radius: 0.25rem;">
                    </div>
                    <div class="form-group">
                        <label for="videoStatus">Status</label>
                        <select id="videoStatus" name="status" class="form-control custom-select">
                            <option selected disabled>Select Status</option>
                            <option value="published" @if($category->status == 'published'){{'selected'}}@endif>Published</option>
                            <option value="draft" @if($category->status == 'draft'){{'selected'}}@endif>Draft</option>
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
