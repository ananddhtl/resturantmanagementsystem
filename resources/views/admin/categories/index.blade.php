@extends('admin.layouts.main')

@section('title')
    Manage categories
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Manage categories</strong>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary float-end"><i
                    class="bx bx-plus"></i> Add
                category</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Name</th>
                            <th scope="col">Preview</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @isset($category->image)
                                        <a target="_blank" href="{{ url('uploads/' . $category->image->file_name) }}"><img
                                                src="{{ asset('uploads/' . $category->image->file_name) }}"
                                                alt="{{ $category->image->file_name }}" width="50" height="50"></a>
                                    @endisset
                                </td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="btn btn-sm btn-primary"><i class="bx bx-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $category->id }}">
                                        <i class="bx bx-trash"></i>
                                    </button>

                                    <div class="modal fade" id="delete{{ $category->id }}" tabindex="-1"
                                        aria-labelledby="deleteLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel">Delete category</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this category?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No categories found...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="my-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
