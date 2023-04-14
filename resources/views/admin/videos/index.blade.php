<x-admin-layout>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Videos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Videos</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('admin.videos.create') }}" class="btn btn-success float-right"> Add Video </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            Videos Name
                        </th>
                        <th style="width: 30%">
                            Category
                        </th>
                        <th style="width: 30%">
                            Sub Category
                        </th>
                        <th style="width: 8%" class="text-center">
                            Status
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($videos as $video)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> <a> {{ $video->name }} </a> </td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        {{ $video->category ? $video->category->name : '' }}
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        {{ $video->subcategory ? $video->subcategory->name : '' }}
                                    </li>
                                </ul>
                            </td>
                            <td class="project-state">
                                @if( $video->status == 'published' )
                                    <span class="badge badge-success">Published</span>
                                @else
                                    <span class="badge badge-danger">Draft</span>
                                @endif
                            </td>
                            <td class="project-actions text-right">
                                <form action="{{ route('admin.videos.destroy',$video->id) }}" method="POST">
                                    <a class="btn btn-primary" href="{{ route('admin.videos.edit', $video->id) }}"><i class="fas fa-pen"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>

</x-admin-layout>
