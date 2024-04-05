@extends('admin.layouts.main')

@section('title')
    Manage users
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Manage users</strong>
            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary float-end"><i class="bx bx-plus"></i> Add
                user</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Role</th>
                            <th scope="col">Preview</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->phone }}</td>
                                <td><span class="badge bg-success">{{ $user->role }}</span></td>
                                <td>
                                    @isset($user->profileImage)
                                        <a target="_blank" href="{{ url('uploads/' . $user->profileImage->file_name) }}"><img
                                                src="{{ asset('uploads/' . $user->profileImage->file_name) }}"
                                                alt="{{ $user->profileImage->file_name }}" width="50" height="50"></a>
                                    @endisset
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary"><i
                                            class="bx bx-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $user->id }}">
                                        <i class="bx bx-trash"></i>
                                    </button>

                                    <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1"
                                        aria-labelledby="deleteLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel">Delete user</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this user?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
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
                                <td colspan="5" class="text-center">No users found...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="my-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
