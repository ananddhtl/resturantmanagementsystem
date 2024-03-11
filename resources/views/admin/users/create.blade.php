@extends('admin.layouts.main')

@section('title')
    Add user
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Add user</strong>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary float-end"><i class="bx bx-list-ul"></i>
                Manage users</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name <b>*</b></label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Enter the name...">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email <b>*</b></label>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="Enter the email...">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password <b>*</b></label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter the password...">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="address" class="form-label">Address </label>
                    <input type="address" class="form-control" id="address" name="address"
                        placeholder="Enter the address...">
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="phone" class="form-label">Phone </label>
                    <input type="phone" class="form-control" id="phone" name="phone"
                        placeholder="Enter the phone number...">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Image </label>
                    <div class="d-flex">
                        <input type="text" class="form-control" id="image" name="image"
                            placeholder="Enter the image..." image-picker="true" readonly>
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
                </div>
                <button type="submit" class="btn btn-primary">Add user</button>
            </form>
            @include('components.image-modal')
        </div>
    </div>
@endsection
