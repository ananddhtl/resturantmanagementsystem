@extends('admin.layouts.main')

@section('title')
    Edit category
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Edit category</strong>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-primary float-end"><i
                    class="bx bx-list-ul"></i>
                Manage categories</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name <b>*</b></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter the name..."
                        value="{{ $category->name }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Image </label>
                    <div class="d-flex">
                        <input type="text" class="form-control" id="image" name="image"
                            placeholder="Enter the image..." image-picker="true"
                            value="{{ $category->image->file_name ?? '' }}" readonly>
                        @include('components.image-modal-button')
                    </div>
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Edit category</button>
            </form>
            @include('components.image-modal')
        </div>
    </div>
@endsection
