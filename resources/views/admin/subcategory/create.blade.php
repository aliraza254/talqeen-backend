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
                <form method="post" action="{{ route('admin.subcategory.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="subCategory">Sub Category Name</label>
                        <input type="text" id=subCategory" name="name" class="form-control" style="border: 1px solid #ced4da; border-radius: 0.25rem;">
                    </div>
                    <div class="form-group">
                        <label for="videoStatus">Status</label>
                        <select id="videoStatus" name="category_id" class="form-control custom-select">
                            <option selected disabled>Select Status</option>
                            @foreach($category as $single)
                            <option value="{{ $single->id }}">{{ $single->name }}</option>
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
