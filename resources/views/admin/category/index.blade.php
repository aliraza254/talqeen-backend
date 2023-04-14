<x-admin-layout>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Projects</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Projects</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('admin.category.create') }}" class="btn btn-success float-right"> Add Video </a>
                </div>
            </div>
        </div>
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
                        <th style="width: 30%">
                            Category
                        </th>
                        <th style="width: 30%">
                            Sub Category
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> <a> {{ $category->name }} </a> </td>
                            <td>
                                @foreach($category['subcategories'] as $index => $single)
                                    <a>
                                    {{ $single->name }}
                                    @if($index !== count($category['subcategories']) - 1)
                                        ,
                                    @endif
                                    </a>
                                @endforeach
                            </td>
                            <td class="project-actions text-right">
                                <form action="{{ route('admin.category.destroy',$category->id) }}" method="POST">
                                    <a class="btn btn-primary" href="{{ route('admin.category.edit', $category->id) }}"><i class="fas fa-pen"></i></a>
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
