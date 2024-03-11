<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCategoryRequest;
use App\Models\File;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::query()->orderBy('id', 'DESC')->paginate(10);
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(ProductCategoryRequest $request)
    {
        $validated_data = $request->validated();
        if (isset($validated_data['image'])) {
            $file = File::query()->where('file_name', '=', $validated_data['image'])->first();
            $validated_data['image_id'] = $file->id;
            unset($validated_data['image']);
        }
        ProductCategory::query()->create($validated_data);
        return redirect()->route('admin.categories.index')->with('notification', 'Category has been added successfully!');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(string $id)
    {
        $category = ProductCategory::query()->findOrFail($id);
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(ProductCategoryRequest $request, string $id)
    {
        $category = ProductCategory::query()->findOrFail($id);
        $validated_data = $request->validated();
        if (isset($validated_data['image'])) {
            $file = File::query()->where('file_name', '=', $validated_data['image'])->first();
            $validated_data['image_id'] = $file->id;
            unset($validated_data['image']);
        }
        $category->update($validated_data);
        return redirect()->route('admin.categories.index')->with('notification', 'Category has been updated successfully!');
    }

    public function destroy(string $id)
    {
        $category = ProductCategory::query()->findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('notification', 'Category has been deleted successfully!');
    }
}
