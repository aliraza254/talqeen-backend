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
                <form method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="videoCategory">Category Name</label>
                        <input type="text" id=videoCategory" name="name" class="form-control" style="border: 1px solid #ced4da; border-radius: 0.25rem;">
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
