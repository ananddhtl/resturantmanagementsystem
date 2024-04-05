@extends('admin.layouts.main')

@section('title')
    Manage tables
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Manage tables</strong>
            <a href="{{ route('admin.tables.create') }}" class="btn btn-sm btn-primary float-end"><i class="bx bx-plus"></i>
                Add
                table</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tables as $table)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $table->name }}</td>
                                <td><span class="badge bg-secondary">{{ $table->status ? 'Reserved' : 'Unreserved' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tables.edit', $table->id) }}" class="btn btn-sm btn-primary"><i
                                            class="bx bx-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $table->id }}">
                                        <i class="bx bx-trash"></i>
                                    </button>

                                    <div class="modal fade" id="delete{{ $table->id }}" tabindex="-1"
                                        aria-labelledby="deleteLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel">Delete table</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this table?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('admin.tables.destroy', $table->id) }}"
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
                                <td colspan="4" class="text-center">No tables found...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="my-3">
                {{ $tables->links() }}
            </div>
        </div>
    </div>
@endsection
