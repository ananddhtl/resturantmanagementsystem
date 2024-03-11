@extends('admin.layouts.main')

@section('title')
    Edit table
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Edit table</strong>
            <a href="{{ route('admin.tables.index') }}" class="btn btn-sm btn-primary float-end"><i class="bx bx-list-ul"></i>
                Manage tables</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.tables.update', $table->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name <b>*</b></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter the name..."
                        value="{{ $table->name }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Edit table</button>
            </form>
            @include('components.image-modal')
        </div>
    </div>
@endsection
