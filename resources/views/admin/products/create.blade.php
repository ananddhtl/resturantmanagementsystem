@extends('admin.layouts.main')

@section('title')
    Add product
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Add product</strong>
            <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary float-end"><i
                    class="bx bx-list-ul"></i>
                Manage products</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label for="price" class="form-label">Price <b>*</b></label>
                    <input type="text" class="form-control" id="price" name="price"
                        placeholder="Enter the price...">
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Description <b>*</b></label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter the description..."></textarea>
                    @error('description')
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
                    <label for="category" class="form-label">Category <b>*</b></label>
                    <select type="category" class="form-control" id="category" name="category">
                        <option selected disabled>Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add product</button>
            </form>
            @include('components.image-modal')
        </div>
    </div>
@endsection
