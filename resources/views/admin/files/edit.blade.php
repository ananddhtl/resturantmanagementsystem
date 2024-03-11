@extends('admin.layouts.main')

@section('title')
    Edit file
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Edit file</strong>
            <a href="{{ route('admin.files.index') }}" class="btn btn-sm btn-primary float-end"><i class="bx bx-list-ul"></i>
                Manage files</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.files.update', $file->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Title <b>*</b></label>
                    <input type="text" class="form-control" id="title" name="title"
                        placeholder="Enter the title..." value="{{ $file->file_title }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Image <b>*</b></label>
                    <input type="file" class="form-control" id="image" name="image"
                        placeholder="Enter the image..." accept="image/*">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <a class="d-block my-2" target="_blank" href="{{ url('uploads/' . $file->file_name) }}">
                        <img src="{{ asset('uploads/' . $file->file_name) }}" alt="{{ $file->file_title }}" width="50"
                            height="50" style="object-fit: cover">
                    </a>
                </div>
                <button type="submit" class="btn btn-primary">Edit File</button>
            </form>
        </div>
    </div>
@endsection
