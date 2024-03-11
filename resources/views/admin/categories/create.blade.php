@extends('admin.layouts.main')

@section('title')
    Add category
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Add category</strong>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-primary float-end"><i
                    class="bx bx-list-ul"></i>
                Manage categories</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
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
                <button type="submit" class="btn btn-primary">Add category</button>
            </form>
            @include('components.image-modal')
        </div>
    </div>
@endsection
