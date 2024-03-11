@extends('admin.layouts.main')

@section('title')
    Add table
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Add table</strong>
            <a href="{{ route('admin.tables.index') }}" class="btn btn-sm btn-primary float-end"><i class="bx bx-list-ul"></i>
                Manage tables</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.tables.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name <b>*</b></label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Enter the name...">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add table</button>
            </form>
            @include('components.image-modal')
        </div>
    </div>
@endsection
