<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FileRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index()
    {
        $files = File::query()->orderBy('id', 'DESC')->paginate(10);
        return view('admin.files.index', ['files' => $files]);
    }

    public function create()
    {
        return view('admin.files.create');
    }

    public function store(FileRequest $request)
    {
        $validated_data = $request->validated();

        $name = Str::slug($validated_data['title']) . "-" . time() . "." . $validated_data['image']->extension();
        $validated_data['image']->move(public_path('uploads'), $name);

        File::query()->create([
            'file_title' => $validated_data['title'],
            'file_name' => $name,
        ]);

        return redirect()->route('admin.files.index')->with('notification', 'File has been added successfully');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(string $id)
    {
        $file = File::query()->findOrFail($id);
        return view('admin.files.edit', ['file' => $file]);
    }

    public function update(FileRequest $request, string $id)
    {
        $file = File::query()->findOrFail($id);

        $validated_data = $request->validated();
        if (isset($validated_data['image'])) {
            $name = Str::slug($validated_data['title']) . "-" . time() . "." . $validated_data['image']->extension();
            $validated_data['image']->move(public_path('uploads'), $name);
        }
        $file->update([
            'file_title' => $validated_data['title'],
            'file_name' => $name ?? $file->file_name,
        ]);

        return redirect()->route('admin.files.index')->with('notification', 'File has been updated successfully');
    }

    public function destroy(string $id)
    {
        $file = File::query()->findOrFail($id);
        FacadesFile::delete(public_path('uploads/' . $file->file_name));
        $file->delete();
        return redirect()->route('admin.files.index')->with('notification', 'File has been deleted successfully');
    }
}
