@extends('admin.layouts.main')

@section('title')
    Manage files
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Manage files</strong>
            <a href="{{ route('admin.files.create') }}" class="btn btn-sm btn-primary float-end"><i class="bx bx-plus"></i> Add
                file</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">File Title</th>
                            <th scope="col">File Name</th>
                            <th scope="col">Preview</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($files as $file)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $file->file_title }}</td>
                                <td>{{ $file->file_name }}</td>
                                <td>
                                    <a class="d-block" target="_blank" href="{{ url('uploads/' . $file->file_name) }}">
                                        <img src="{{ asset('uploads/' . $file->file_name) }}" alt="{{ $file->file_title }}"
                                            width="30" height="30" style="object-fit: cover">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.files.edit', $file->id) }}" class="btn btn-sm btn-primary"><i
                                            class="bx bx-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $file->id }}">
                                        <i class="bx bx-trash"></i>
                                    </button>

                                    <div class="modal fade" id="delete{{ $file->id }}" tabindex="-1"
                                        aria-labelledby="deleteLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel">Delete file</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this file?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('admin.files.destroy', $file->id) }}"
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
                                <td colspan="5" class="text-center">No Files Found...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="my-3">
                {{ $files->links() }}
            </div>
        </div>
    </div>
@endsection
