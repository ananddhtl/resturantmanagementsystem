@extends('admin.layouts.main')

@section('title')
    Edit user
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Edit user</strong>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary float-end"><i class="bx bx-list-ul"></i>
                Manage users</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name <b>*</b></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter the name..."
                        value="{{ $user->name }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email <b>*</b></label>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="Enter the email..." value="{{ $user->email }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="address" class="form-label">Address </label>
                    <input type="address" class="form-control" id="address" name="address"
                        placeholder="Enter the address..." value="{{ $user->address }}">
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="phone" class="form-label">Phone </label>
                    <input type="phone" class="form-control" id="phone" name="phone"
                        placeholder="Enter the phone number..." value="{{ $user->phone }}">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Image </label>
                    <div class="d-flex">
                        <input type="text" class="form-control" id="image" name="image"
                            placeholder="Enter the image..." image-picker="true"
                            value="{{ $user->profileImage->file_name ?? '' }}" readonly>
                        @include('components.image-modal-button')
                    </div>
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="role" class="form-label">Role <b>*</b></label>
                    <select type="role" class="form-control" id="role" name="role">
                        <option selected disabled>Select a role</option>
                        <option value="admin">Admin</option>
                        <option value="chef">Chef</option>
                        <option value="waiter">Waiter</option>
                        <option value="user">User</option>
                    </select>
                    @error('role')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <script>
                        let role = "{{ $user->role }}";
                        document.getElementById('role').value = role
                    </script>
                </div>
                <button type="submit" class="btn btn-primary">Edit user</button>
            </form>
            @include('components.image-modal')
        </div>
    </div>
@endsection
